<?php

namespace App\Http\Controllers;

use App\Models\{User};
use Illuminate\Http\Request;
use File;
use Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'profile_picture' => 'nullable|mimes:png,jpg,jpeg',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8|confirmed'
        ],[
            'name.required' => 'Nama harus diisi !',
            'profile_picture.mimes' => 'File yang diterima adalah png, jpg dan jpeg',
            'email.required' => 'Email harus diisi !',
            'email.email' => 'Email tidak valid !',
            'email.unique' => 'Email sudah dipakai !',
            'password.min' => 'Password minimal 8 karakter !',
            'password.confirmed' => 'Konfirmasi password salah !'
        ]);

        if($request->profile_picture){
            $profile_picture = $request->profile_picture->store(
                'user', 'uploads'
            );
            $profile_picture = "/uploads/$profile_picture";

            $file_path = public_path($user->profile_picture);

            if (File::exists($file_path)) {
                File::delete($file_path);
            }
        }

        $user->name = $request->name;
        if($request->profile_picture){
            $user->profile_picture = $profile_picture;
        }
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('/profile')->with('success', 'Profil berhasil diupdate !');
    }
}
