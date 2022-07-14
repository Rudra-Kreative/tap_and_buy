<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('administrator.sub-category.show',[
            'subCategories'=>$this->getSubCategories(),
            'categories' => (new CategoryController())->getCategories(true)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'parent' => ['required','exists:categories,id'],
            'name' => ['required'],
            'slug' => ['nullable','unique:categories,slug']
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
            $category->parent_id = $request->parent;
            $category->save();
        } catch (Exception $e) {
            $res = [
                'key' => 'fail',
                'msg' => 'Category could not be added.'
            ];
        }

        return redirect()->route('administrator.sub-category.view')->with($res['key'], $res['msg']);

        
    }

    public function update(Request $request, Category $category)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'parent' => 'required | exists:categories,id',
            'nothing' =>'required'
        ]);

        $category->name = $request->name;
        $category->parent_id = $request->parent;
        $category->save();

        return ['res' => TRUE, 'msg' => 'Sub Category has been updated successfully!!', 'data' => $this->getSubCategories(true)];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,Request $request )
    {
       
        $category->delete();
        $category->childs()->delete();
        if ($category->trashed()) {
            return ['res' => TRUE, 'msg' => 'Sub Category has been successfully deleted!!', 'data' => $this->getSubCategories(true)];
        }
        return ['res' => FALSE, 'msg' => 'Sub Category could not be deleted!!'];
    }


    public function deactive(Category $category)
    {
        $category->is_active = false;
        $category->save();


        return ['res' => TRUE, 'msg' => 'Selected Sub-Category has been suspended!!','data' => $this->getSubCategories(true)];
    }

    public function getSubCategories($timezoneFormat = TRUE)
    {
        $subCategories = Category::with(['parent'])->whereNotNull('parent_id')->where('is_active' , TRUE)->orderBy('created_at', 'DESC')->get();

            $subCategories->filter(function ($k) use ($timezoneFormat) {
                if ($k->created_by == 'user') {
                    $k->created_by = $k->user->name;
                    
                    if ($timezoneFormat) {
                        $k->created_at = formatTimezone($k->created_at);
                    }
                }
            });

            return $subCategories;
    }
}
