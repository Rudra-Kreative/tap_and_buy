<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $eventCategories = EventCategory::where(['is_active'=>true])->get();

        return view('administrator.event.show',['eventCategories'=>$eventCategories]);
    }

    public function store(Request $request)
    {
        dd($request->all());

        $this->validate($request , [
            'event_category' => ['required'],
            'name' => ['required'],
            'tagline' => ['required'],
            'desc' => ['required'],
            
        ]);
    }
}
