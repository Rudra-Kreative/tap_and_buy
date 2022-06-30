<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\View\Components\Admin\BusinessCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {

        return view('administrator.category.show');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'max:150'],
            'slug' => ['nullable', 'unique:categories,slug']
        ]);

        $res = [
            'key' => 'success',
            'msg' => 'Category has been added successfully.'
        ];


        try {
            $category = new Category();
            $category->name = $request->name;
            $category->created_id = auth()->id();
            $category->slug = !empty($request->slug) ? $request->slug : Str::slug($request->name . Str::random(5), '-');
            $category->save();
        } catch (Exception $e) {
            $res = [
                'key' => 'fail',
                'msg' => 'Category could not be added.'
            ];
        }

        return redirect()->route('administrator.category.view')->with($res['key'], $res['msg']);
    }

    public function update(Request $request, Category $category)
    {
       $this->validate($request , [
        'name' =>'required'
       ]);

       $category->name = $request->name;
       $category->save();
       
       return ['res' => TRUE, 'msg' => 'Updated successfully!!', 'data' => $this->getCategories()];

    }

    public function destroy(Category $category)
    {
        $category->delete();

        if ($category->trashed()) {
            return ['res' => TRUE, 'msg' => 'Category has been successfully deleted!!', 'data' => $this->getCategories()];
        }
        return ['res' => TRUE, 'msg' => 'Category could not be deleted!!'];
    }

    public static function getCategories($timezoneFormat = TRUE)
    {
        $categories = Category::with(['childs'])->whereNull('parent_id')->orderBy('id')->get();

        $categories->filter(
            function ($k) {

                $k->created_at = !empty(auth()->user()->timezone) ?
                    $k->created_at->setTimezone(auth()->user()->timezone)
                    : $k->created_at->setTimezone(geoip()->getLocation(request()->ip()));
            }
        );
        
        return $categories;
    }
}
