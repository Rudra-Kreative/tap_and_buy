<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }
    public function index(Request $request)
    {

        if (!empty($request->onlyData)) {
            return ['res' => true, 'categories' => $this->getCategories(true)];
        }

        return view('administrator.category.show', ['categories' => $this->getCategories(true)]);
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
            $category->created_by = 'administrator';
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
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category->name = $request->name;
        $category->save();

        return ['res' => TRUE, 'msg' => 'Updated successfully!!', 'data' => $this->getCategories(true)];
    }

    public function destroy(Category $category)
    {
        $category->delete();
        $category->childs()->delete();
        $category->businesses()->delete();

        if ($category->trashed()) {
            return ['res' => TRUE, 'msg' => 'Category has been successfully deleted!!', 'data' => $this->getCategories(true)];
        }
        return ['res' => TRUE, 'msg' => 'Category could not be deleted!!'];
    }

    public function deactive(Category $category)
    {
        $category->is_active = false;
        $category->save();

        $category->childs()->update(['is_active' => false]);
        $category->businesses()->update(['is_active' => false]);

        return ['res' => TRUE, 'msg' => 'Selected Category has been suspended!!', 'data' => $this->getCategories(true)];
    }

    public static function getCategories($timezoneFormat = TRUE)
    {
        $categories = Category::with(['childs', 'user', 'administrator'])->where(['is_active' => true])->whereNull('parent_id')->orderBy('id', 'DESC')->get();

        $categories->filter(function ($k) use ($timezoneFormat) {
            if ($k->created_by == 'user') {
                $k->created_by = $k->user->name;

                if ($timezoneFormat) {
                    $k->created_at = formatTimezone($k->created_at);
                }
            }
        });

        return $categories;
    }
}
