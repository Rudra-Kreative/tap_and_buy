<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->routeIs('administrator.user.owner.list')) {
            return view('administrator.owner.show', ['owners' => $this->getBusinessOwnerList(2)]);
        }
        if ($request->routeIs('administrator.user.client.list')) {
            return view('administrator.client.show', ['clients' => $this->getBusinessOwnerList(1)]);
        }
    }


    private function getBusinessOwnerList($role = 1)
    {
        $userLists =[];
        if ($role == 2) {
            $userLists = User::withCount(['businesses', 'products'])
                ->where([
                    'is_active' => TRUE,
                    'role' => $role
                ])
                ->orderBy('businesses_count')
                ->get();
        }
        elseif($role == 1)
        {
            $userLists = User::where(['is_active'=>TRUE,'role'=>$role])->get();
        }

        return $userLists;
    }
}
