<?php

namespace App\Http\Controllers\Administrator;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Mail\UserRegisterMessage;
use App\Models\User;
use App\Rules\Admin\TimezoneSelect;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminOwnerController extends Controller
{


    public function index()
    {
        $ownerLists =  $this->getAllOwners();
        $tzs = timezone_identifiers_list();

        return view('administrator.owner.show', ['ownerLists' => $ownerLists, 'tzs' => $tzs]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'image' =>
            'nullable|mimetypes:image/bmp,image/gif,image/png,image/jpeg,image/webp|max:50048',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required',
            'location' => 'required | max:255',
            'occupation' => 'required | max:255',
            'timezone' => ['nullable', new TimezoneSelect]

        ]);
        $request->hasFile('image') ? $imageName = $this->getModifiedImageName($request) : '';
        $tempPass = generateTempPasscode();

        $res = [
            'key' => 'success',
            'msg' => 'Business owner has been added successfully.'
        ];
        try {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'image_path' => $imageName ? 'storage/user/images/owner/profile/' . $imageName : NULL,
                'phone' => $request->phone,
                'location' => $request->location,
                'occupation' => $request->occupation,
                'role' => 2,
                'timezone' => $request->timezone,
                'password' => Hash::make($tempPass)
            ]);

            $imageName ?
                $request->image->storePubliclyAs('user\images\owner\profile', $imageName, 'public') : '';

            $payload = [
                'email' => $request->email,
                'name' => $request->name,
                'password' => $tempPass
            ];

            event(new UserRegistered($payload));
        } catch (Exception $e) {
            $res = [
                'key' => 'fail',
                'msg' => 'Category could not be added.'
            ];
        }

        return redirect()->route('administrator.owner.view')->with($res['key'], $res['msg']);
    }


    public function edit(User $user)
    {
        if (!empty($user)) {
            return ['success' => TRUE, 'msg' => '', 'data' => $user];
        }

        return ['success' => FALSE, 'msg' => 'Something went wrong! Please try again later', 'data' => []];
    }



    public function update(User $user, Request $request)
    {

        
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'image' =>
            'nullable|mimetypes:image/bmp,image/gif,image/png,image/jpeg,image/webp|max:50048',
            'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($user->id)],
            'phone' => 'required',
            'location' => 'required | max:255',
            'occupation' => 'required | max:255',
            'timezone' => ['nullable', new TimezoneSelect]
        ]);


        $request->hasFile('image') ? $imageName = $this->getModifiedImageName($request) : '';


        $res = [
            'key' => 'success',
            'msg' => 'Business owner has been added successfully.'
        ];

        try {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->location = $request->location;
            $user->occupation = $request->occupation;
            $user->timezone = $request->timezone;

            if (!empty($imageName)) {
                
                $user->image_path = $imageName ? 'storage/user/images/owner/profile/' . $imageName : NULL;
                $imageName ?
                    $request->image->storePubliclyAs('user\images\owner\profile', $imageName, 'public') : '';
                Storage::delete(asset($user->image_path));
            }

            $user->save();

            $res['data'] = $this->getAllOwners();

        } catch (Exception $e) {
            dd($e);
            $res = [
                'key' => 'fail',
                'msg' => 'Category could not be added.'
            ];
        }

        return $res;
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


    private function getModifiedImageName($request)
    {

        return
            $request->hasFile('image') ?
            ('business_owner_'
                . time() . '_'
                . Str::random(10)
                . '.' . $request->image->extension()) : null;
    }
}
