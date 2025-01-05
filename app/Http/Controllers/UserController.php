<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class UserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {

        $this->authorize('create', User::class);
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'role'=>'user',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role'=>'user',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    public function edit(User $user)

    {
        $this->authorize('update', User::class);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', User::class);
        $request->validate([
            'name' => 'required|string|max:255',
           'role' => 'required|in:user,admin',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role'=>'user',
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'تم تحديث المستخدم بنجاح');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);
        $user->delete();
            return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
