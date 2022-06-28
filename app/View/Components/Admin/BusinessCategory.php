<?php

namespace App\View\Components\Admin;

use App\Models\Category;
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
        $categories = Category::with(['childs'])->orderBy('created_at','DESC')->get();
        
        return view('components.admin.business-category')->withCategories($categories);
    }
}
