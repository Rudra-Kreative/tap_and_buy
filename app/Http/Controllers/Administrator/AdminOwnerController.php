<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminOwnerController extends Controller
{
    public function index()
    {
        $ownerLists =  $this->getAllOwners();
        $tzs = timezone_identifiers_list();

        return view('administrator.owner.show',['ownerLists'=>$ownerLists,'tzs'=>$tzs]);
    }


    public function getAllOwners()
    {
        return User::withCount(['businesses', 'products'])
            ->where([
                'is_active' => TRUE,
                'role' => 2
            ])
            ->orderBy('businesses_count')
            ->get();
    }
}
