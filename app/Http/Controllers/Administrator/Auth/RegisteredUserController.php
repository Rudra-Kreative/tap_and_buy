<?php

namespace App\Http\Controllers\Administrator\Auth;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Rules\Admin\TimezoneSelect;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tzs = timezone_identifiers_list();
        return view('administrator.auth.register')->with('tzs', $tzs);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:administrators',
            'password' => 'required|string|confirmed|min:8',
            'timezone' => ['nullable', new TimezoneSelect],
            'image' =>
            'nullable|image|mimetypes:image/bmp,image/gif,image/png,image/jpeg,image/webp|max:50048'


        ]);

        $imageName = $this->getModifiedImageName($request);
        
        Auth::guard('administrator')->login($administrator = Administrator::create([
            'name' => $request->name,
            'email' => $request->email,
            'timezone' => $request->timezone,
            'password' => Hash::make($request->password),
            'image_path' => $imageName ? 'storage/admin/images/profile/'.$imageName : 'storage/admin/images/profile/no-dp.png'
        ]));

        $imageName ?
            $request->image->storePubliclyAs('admin\images\profile', $imageName, 'public') : '';

        VerifyEmail::createUrlUsing(function ($notifiable) {
            return URL::temporarySignedRoute(
                'administrator.verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
        });

        event(new Registered($administrator));

        return redirect(route('administrator.dashboard'));
    }


    private function getModifiedImageName($request)
    {

        return
            $request->hasFile('image') ?
            ('admin_'
                . time() . '_'
                . Str::random(10)
                . '.' . $request->image->extension()) : null;
    }
}
