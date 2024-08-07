<?php

namespace App\Http\Controllers;

use App\User;
use App\data_user;
use Illuminate\Http\Request;

class data_userController extends Controller
{
    public function index()
    {
        $users = User::all(); // Mengambil semua data user
        return view('data_user.index', compact('users'));
    }

    public function create()
    {
        return view('data_user.create');
    }

    public function save(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);

    return redirect('/data_user')->with(['success' => 'User <strong>' . $request->name . '</strong> Berhasil Ditambahkan']);
}



    public function edit($id)
    {
        $data_user = User::find($id);
        return view('data_user.edit', compact('data_user'));
    }

    public function update(Request $request, $id)
{
    $data_user = User::find($id);

    // Reset all roles to 0
    $data_user->is_admin = 0;
    $data_user->is_keuangan = 0;
    $data_user->is_direktur = 0;

    // Set the selected role to 1
    switch ($request->role) {
        case 'admin':
            $data_user->is_admin = 1;
            break;
        case 'keuangan':
            $data_user->is_keuangan = 1;
            break;
        case 'direktur':
            $data_user->is_direktur = 1;
            break;
    }

    $data_user->update([
        'name' => $request->name,
        'email' => $request->email,
        'is_admin' => $data_user->is_admin,
        'is_keuangan' => $data_user->is_keuangan,
        'is_direktur' => $data_user->is_direktur
    ]);

    return redirect('/data_user')->with(['success' => '<strong>' . $data_user->name . '</strong> Diperbaharui']);
}


    public function destroy($id)
    {
        $data_user = User::find($id);

        $data_user->delete();
        return redirect('/data_user')->with(['success' => '<strong>'.$data_user->name.'</strong> Dihapus']);
    }
}
