<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }


        $token = $user->createToken('MyApp')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'token' => $token
        ]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string', 
        ]);

        
        $user = Auth::user();

        
        $user->name = $request->name;
        $user->email = $request->email;

        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        
        $user->save();

        
        return response()->json(['message' => 'تم التحديث بنجاح', 'user' => $user]);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out  successfully'
        ], 200);
    }


}
