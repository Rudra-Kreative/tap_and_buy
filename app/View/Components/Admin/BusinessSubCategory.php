<?php

namespace App\View\Components\Admin;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\Component;

class BusinessSubCategory extends Component
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
        $subCategories = Category::whereHas('parent', function (Builder $query) {
            $query->whereNull('deleted_at');
        })
            ->whereNotNull('parent_id')->orderBy('created_at', 'DESC')->get();

        $subCategories->filter(
            function ($k) {

                $k->created_at = !empty(auth()->user()->timezone) ?
                    $k->created_at->setTimezone(auth()->user()->timezone)
                    : $k->created_at->setTimezone(geoip()->getLocation(request()->ip()));
            }
        );

        return view('components.admin.business-sub-category')->withSubCategories($subCategories);
    }
}
