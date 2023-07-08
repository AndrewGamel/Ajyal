<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }
    public function update(Request $request)
    {

        $request->validate([
            'first_name' => ['required', 'string', 'min:3', 'max:10'],
            'last_name' => ['required', 'string', 'min:3', 'max:10'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => ['in:male,female'],
            'image' => 'nullable|mimes:png,jpg|max:1048576|dimensions:min_width=100,max_width= 1000',
            'country' => ['required', 'string', 'size:2'],
            'locale' => ['string', 'size:2']
        ]);
        $user = $request->user();
        $user->profile->fill($request->all())->save();
        /* $profile =  $user->profile;
        if ($profile->user_id) {
            $profile->update($request->all());
        } else {
            /* $user->profile()->create($request->all());
            // $request->merge(['user_id' => $user->id]);
            // Profile::create($request->all()); 
        }
        */
    }
}
