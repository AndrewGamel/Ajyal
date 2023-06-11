<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // if ($request->ajax()) {

        //     $data =
        // }

        $query = Category::query();

       if ($name = $request->query('name')) {
        $query->where('name','LIKE',"%{$name}%");
       }
       if ($status = $request->query('status')) {
        $query->where('status','=',$status);
       }

        $categories = $query->paginate(2);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate(Category::rules(),[
            'name.unique' => 'this name already Found !'
        ]);
        //dd($request);
        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);

        $category = Category::create($data);
        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (\Throwable $th) {
            return Redirect::route('dashboard.categories.index')
                ->with('info', 'Category Not Found!');
        }

        // SELECT * FROM categories WHERE id <> $id
        // AND (parent_id IS NULL OR parent_id <> $id)
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(CategoryRequest $request, string $id)
    {
        /*
        Don't Need To Define Validation it Define in CategoryRequest
            $request->validate(Category::rules($id));
        */

        $category = Category::findOrFail($id);

        $old_image = $category->image;

        $data = $request->except('image');

        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }

        $category->update($data);

        if ($old_image && isset($new_image)) {
            Storage::disk('public')->delete($old_image);
        }


        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $category->delete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $this->reAutoIncrement('categories');
        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Deleted!');
    }

    public function reAutoIncrement($table)
    {
        DB::statement("SET @count = 0;");
        DB::statement("UPDATE `$table` SET `$table`.`id` = @count:= @count + 1;");
        DB::statement(("ALTER TABLE `$table` AUTO_INCREMENT = 1;"));
    }

    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads',['disk' => 'public']);
        return $path;
    }

}