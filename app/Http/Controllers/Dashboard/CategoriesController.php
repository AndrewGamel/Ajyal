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

        /*
         SELECT a.*, b.name as parent_name
         FROM categories as a
         LEFT JOIN categories as b ON b.id = a.parent_id
         // $query = Category::query();
        */

        //$categories = $query->paginate(2);
        $categories = Category::leftjoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])
            ->filter($request->query())
            ->orderBy('categories.name')
            // ->onlyTrashed()
            //->withTrashed()
            ->paginate();

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


        $request->validate(Category::rules(), [
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

      //  $this->reAutoIncrement('categories');
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
        $path = $file->store('uploads', ['disk' => 'public']);
        return $path;
    }
    function search(Request $request)
    {
        if ($request->ajax()) {

            $data = Category::where('id', 'like', $request->search)->orWhere('name', 'like', '%' . $request->search . '%')->paginate();

            $output = '';
            if (count($data) > 0) {

                foreach ($data as $i => $row) {
                    $output .= '
                          <tr>
                           <td>' . $i + 1 . ' |
                                    <p class="badge badge-danger text-bold ml-1"> ' . $row->id . '</p> |
                            </td>


                            <td><a href="' . route('dashboard.categories.show', ['category' => $row->id]) . '">' . $row->name . '</a></td>

                            </tr>
                        ';
                }
                $output .= '


            </div>';
            } else {
                $output .= 'no Result';
            }
            return $output;
        }
    }

    public function trash(Request $request)
    {
        $categories = Category::onlyTrashed()->filter($request->query())->orderBy('categories.name')->paginate();
        return view('dashboard.categories.trash',compact('categories'));
    }
    public function restore(Request $request,$id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')->with('success', 'Category Restored!');
    }
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.trash')->with('danger', 'Category Deleted For Ever!');
    }
}