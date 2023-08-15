<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Tag;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'store'])
            ->paginate();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories =  Category::all();
        $tags = new Tag();
        $product = new Product();
        return view('dashboard.products.create', compact('product', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Product $product)
    {
        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);

        $data = $request->except(['image', 'tags']);
        $data['image'] = $this->uploadImage($request);
        // $request->merge([
        //     'product_id' => $request->id,
        // ]);
        $product->create($data);



        $tags = json_decode( $request->post('tags'));
        $tag_ids = [];
        $saved_Tag = Tag::all();
        foreach ($tags as $t_name) {
            $slug = Str::slug($t_name->value);
            $tag = $saved_Tag->where('slug', $slug)->first();
            // $tag = Tag::where('slug', $slug)->first();

            if (!$tag) {
                $tag = Tag::create([
                    'name' => $t_name->value,
                    'slug' => $slug
                ]);
            }
            $tag_ids[] = $tag->id;

        }
 $request->merge([
            'product_id' => $product->id,
        ]);
        $product->tags()->sync($tag_ids);

        return Redirect::route('dashboard.products.index')
            ->with('success', 'Product Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $product = Product::findOrFail($id);
        } catch (\Throwable $th) {
            return Redirect::route('dashboard.products.index')
                ->with('info', 'product Not Found!');
        }
        $categories = Category::all();
        $tags = implode(',',$product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit', compact('categories', 'product', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {


        $old_image = $product->image;

        $data = $request->except(['image', 'tags']);
// dd($request->post('tags','image'));
        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }

        $product->update($data);
        /**
         * Using Tagify that use string json
         */
        // $tags = explode(',', $request->post('tags'));
        $tags = json_decode( $request->post('tags'));
        $tag_ids = [];
        $saved_Tag = Tag::all();
        foreach ($tags as $t_name) {
            $slug = Str::slug($t_name->value);
            $tag = $saved_Tag->where('slug', $slug)->first();
            // $tag = Tag::where('slug', $slug)->first();

            if (!$tag) {
                $tag = Tag::create([
                    'name' => $t_name->value,
                    'slug' => $slug
                ]);
            }
            $tag_ids[] = $tag->id;
        }
        $product->tags()->sync($tag_ids);
        if ($old_image && isset($new_image)) {
            Storage::disk('public')->delete($old_image);
        }


        return Redirect::route('dashboard.products.index')
            ->with('success', 'Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        //  $this->reAutoIncrement('categories');
        return Redirect::route('dashboard.products.index')
            ->with('success', 'Product Deleted!');
    }
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }

        $file = $request->file('image'); // UploadedFile Object

        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        return $path;
    }
}