<?php

namespace App\View\Components;

use App\Models\Business;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\Component;

class DashboardStatSection extends Component
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
        $stats = [
            'businessTotal' => Business::count(),
            'sellerTotal' => User::where('role' , 2)->count(),
            'buyerTotal' => User::where('role' , 1)->count(),
            'productTotal' => Product::count()
        ];
        
        return view('components.dashboard-stat-section')->withStats($stats);
    }
}
