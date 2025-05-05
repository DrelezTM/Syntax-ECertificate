<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUsers(Request $request) {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // default 10

        $getUsers = User::when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('created_at', 'like', "%{$search}%");
            })
            ->orderBy('created_at')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.users', [
            'users' => $getUsers,
            'search' => $search,
            'perPage' => $perPage,
        ]);
    }

    public function getAddUser(Request $request) {
        return view('admin.add-user');
    }

    public function postAddUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'password' => 'required|string|min:3',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $getUsers = User::where('name', $validate['name'])->orWhere('email', $validate['email'])->get()->first();
        if ($getUsers) return redirect()->route('users')->with('error', 'Username atau Email sudah tersedia di Database!');

        User::create([
            'name' => $validate['name'],
            'password' => Hash::make($validate['password']),
            'email' => $validate['email'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('users')->with('success', 'Users berhasil ditambahkan!');
    }

    public function getEditUser(Request $request) {
        $id = $request->query('id');

        $getUser = User::where('id', $id)->get()->first();
        if (!$id || !$getUser) return redirect()->route('users')->with('error', 'User ID tidak ada dalam database');

        return view('admin.edit-user', [ 'user' => $getUser ]);
    }

    public function postEditUser(Request $request) {
        $id = $request->query('id');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'password' => 'nullable|string|min:3',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $getUser = User::where('id', $id)->get()->first();
        if (!$id || !$getUser) return redirect()->route('users')->with('error', 'User ID tidak ada dalam database!');

        $updateData = [
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']) ?? $getUser->password,
            'updated_at' => now()
        ];

        $getUser->update($updateData);
        return redirect()->route('users')->with('success', 'User berhasil di edit!');
    }

    public function deleteUser(Request $request) {
        $validator = Validator::make($request->all(), [ 'id' => 'required|integer' ]);
        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $user = User::findOrFail($validate['id']);
        $user->delete();

        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
}
