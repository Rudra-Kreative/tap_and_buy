<?php

namespace App\View\Components\Admin;

use App\Models\Business;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\Component;

class DashboardStatSection extends Component
{
    public function render()
    {
        $stats = [
            'businessTotal' => Business::where('is_active', TRUE)->count(),
            'sellerTotal' => User::where('is_active', TRUE)->where('role', 2)->count(),
            'buyerTotal' => User::where('is_active', TRUE)->where('role', 1)->count(),
            'productTotal' => Product::where('is_active', TRUE)->count()
        ];

        return view('components.admin.dashboard-stat-section', ['stats' => $stats]);
    }
}
