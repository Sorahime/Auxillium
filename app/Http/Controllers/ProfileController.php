<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['nullable','string','max:100'],
            'username'  => ['nullable','string','max:50'],
            'email'     => ['nullable','email','max:100'],
            'gender'    => ['nullable','string','max:20'],
            'phone'     => ['nullable','string','max:20'],
            'address'   => ['nullable','string','max:200'],
            'avatar'    => ['nullable','image','mimes:jpg,jpeg,png','max:4096'],
        ]);

        $profile = Profile::firstOrCreate(
            ['user_id' => auth()->id()],
            [
                'full_name' => auth()->user()->name,
                'username'  => auth()->user()->name,
                'email'     => auth()->user()->email,
            ]
        );

        // upload avatar (optional)
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $path;
        }

        $profile->full_name = $validated['full_name'] ?? $profile->full_name;
        $profile->username  = $validated['username']  ?? $profile->username;
        $profile->email     = $validated['email']     ?? $profile->email;
        $profile->gender    = $validated['gender']    ?? $profile->gender;
        $profile->phone     = $validated['phone']     ?? $profile->phone;
        $profile->address   = $validated['address']   ?? $profile->address;

        $profile->save();

        return back()->with('success', 'Profile berhasil disimpan ✅');
    }
}
