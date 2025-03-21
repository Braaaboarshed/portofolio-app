<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show()
    {
        $profile = Profile::first();

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        return response()->json($profile);
    }

    
    public function update(Request $request)
    {
        dd($request->name);
        $profile = Auth::user()->profile;
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'email',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);


        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $validatedData['image'] = $imagePath; 
        }

        
        $profile->update($validatedData);

        return response()->json(['message' => 'Profile updated successfully', 'profile' => $profile]);
    }
}
