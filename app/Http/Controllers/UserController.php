<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\Roles;

class UserController extends Controller {
    public function index() {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request) {
        /* $user = new User();
        $user->fill($request->all());
        $user->save();

        return redirect()->route('users.index'); */
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = bcrypt($request->password);
        $user->role = Roles::GUEST();
        $user->save();

        return response()->json(['message' => 'User created successfully']);
    }

    public function show(User $user) {
        return view('users.show', compact('user'));
    }

    public function edit(User $user) {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        /* $user->fill($request->all());
        $user->save();

        return redirect()->route('users.show', $user); */

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'User updated successfully']);
    }

    public function destroy($id) {
        /* $user->delete();

        return redirect()->route('users.index'); */

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
