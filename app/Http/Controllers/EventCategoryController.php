<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\EventCategory;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventCategoryController extends Controller
{
    public function index(Request $request)
    {
        $eventCategories = EventCategory::with(['creatable']);

        if($request->has('creatable_type') && in_array($request->creatable_type,['admin','seller','all']))
        {
            switch ($request->creatable_type) {
                case 'admin':
                    $eventCategories->where('creatable_type','App\Models\Administrator');
                    break;
                case 'seller':
                    $eventCategories->where('creatable_type','App\Models\User');
                    break;
                
            }
            return ['res'=>true,'data'=>$eventCategories->orderBy('id','DESC')->get(),'authorisedId'=>auth()->id(),'authType'=>(auth()->guard('administrator')->check() ? 'admin' : 'user')];
        }

        $eventCategories = $eventCategories->orderBy('id','DESC')->get();
        
        return view('administrator.event.category.show',['eventCategories'=>$eventCategories]);
    }

    public function store(Request $request)
    {

        $this->authorize('create',EventCategory::class);
        
        $this->validate($request, [
            'name' => ['required', 'max:150'],
            'slug' => ['nullable', 'unique:categories,slug']
        ]);

        $res = [
            'key' => 'success',
            'msg' => 'Event Category has been added successfully.'
        ];

        try {

            $currentUser = [];

            if (auth()->guard('administrator')->check()) {

                $currentUser = Administrator::find(auth()->id());
            } else {

                $currentUser = User::find(auth()->id());
            }

            if (!empty($currentUser)) {

                $eventCategory = new EventCategory();
                $eventCategory->name = $request->name;
                $eventCategory->slug = !empty($request->slug) ? $request->slug : Str::slug($request->name . Str::random(10), '-');

                $currentUser->eventCategories()->save($eventCategory);
            }
        } catch (Exception $e) {

            $res = [
                'key' => 'fail',
                'msg' => 'Event Category could not be added.'
            ];
        }

        return redirect()->route('administrator.event.category.view')->with($res['key'], $res['msg']);
    }


    public function update(EventCategory $eventCategory , Request $request)
    {
       $this->authorize('update',$eventCategory);

    }

    public function deactive(EventCategory $eventCategory,Request $request)
    {
        $eventCategory->is_active = false;
        $eventCategory->save();

        return [    
            'res' => TRUE, 
            'msg' => 'Selected Category has been suspended!!', 
            'data' => $this->getAllEventCategories(),
            'authorisedId'=>auth()->id(),
            'authType'=>(auth()->guard('administrator')->check() ? 'admin' : 'user')
        ];
    }

    public function getAllEventCategories()
    {
       return EventCategory::with(['creatable'])->orderBy('id','DESC')->get();
    }
}
