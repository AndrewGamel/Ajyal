<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $countries = Countries::getNames();
        $locales = Locales::getNames();
        return view(
            'dashboard.profile.edit',
            compact('user', 'countries', 'locales')
        );
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
        $old_image = $user->profile->image;
        $data = $request->except('image');
        $new_image = $this->uploadImage($request);


        $new_image = ($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }

        $user->profile->fill([],$data)->save();

        if ($old_image && isset($request->image)) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('dashboard.profile.edit')
            ->with('success', 'Profile Updated!');
    }
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }

        $file = $request->file('image'); // UploadedFile Object

        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        return $path;
    }

}
/* $profile =  $user->profile;
        if ($profile->user_id) {
            $profile->update($request->all());
        } else {
            /* $user->profile()->create($request->all());
            // $request->merge(['user_id' => $user->id]);
            // Profile::create($request->all());
        }
        */