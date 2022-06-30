<?php

namespace App\View\Components\Admin;

use App\Http\Controllers\Administrator\CategoryController;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\View\Component;

class BusinessCategory extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = CategoryController::getCategories();

        return view('components.admin.business-category',['categories'=>$categories]);
    }
    
}
