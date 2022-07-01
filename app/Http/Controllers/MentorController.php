<?php

namespace App\Http\Controllers;

use App\Models\{User};
use Illuminate\Http\Request;
use File;
use Hash;

class MentorController extends Controller
{
    public function index()
    {
        $title = "Pembimbing";
        $users = User::withCount('students')->where('role', 'mentor')->get();

        return view('mentor.index', compact('users','title'));
    }
    public function create()
    {
        $title = "Tambah Pembimbing";

        return view('mentor.create',compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'profile_picture' => 'nullable|mimes:png,jpg,jpeg',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ],[
            'name.required' => 'Nama harus diisi !',
            'profile_picture.mimes' => 'File yang diterima adalah png, jpg dan jpeg',
            'email.required' => 'Email harus diisi !',
            'email.email' => 'Email tidak valid !',
            'email.unique' => 'Email sudah dipakai !',
            'password.required' => 'Password harus diisi !',
            'password.min' => 'Password minimal 8 karakter !',
            'password.confirmed' => 'Konfirmasi password salah !'
        ]);

        $profile_picture = null;
        if($request->profile_picture){
            $profile_picture = $request->profile_picture->store(
                'user', 'uploads'
            );
            $profile_picture = "/uploads/$profile_picture";
        }

        User::create([
            'name' => $request->name,
            'profile_picture' => $profile_picture,
            'email' => $request->email,
            'role' => 'mentor',
            'password' => Hash::make($request->password),
        ]);

        return redirect('/mentor')->with('success', 'Pembimbing berhasil ditambahkan !');
    }
    
    public function show(User $mentor)
    {
        $user = $mentor;
        $html = view('mentor.show', compact('user'))->render();

        return response(['success' => true, 'html' => $html]);
    }
    
    public function edit(User $mentor)
    {
        $title = "Edit Pembimbing";
        $user = $mentor;
        return view('mentor.edit', compact('user','title'));
    }
    
    public function update(Request $request, User $mentor)
    {
        $user = $mentor;
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
        
        return redirect('/mentor')->with('success', 'Data pembimbing berhasil diubah !');
    }
    
    public function destroy(User $mentor)
    {
        $user = $mentor;
        $file_path = public_path($user->profile_picture);

        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $user->delete();

        $users = User::withCount('students')->where('role', 'mentor')->get();
        $html = view('mentor.table', compact('users'))->render();

        return response(['success' => true, 'html' => $html, 'message' => 'Data pembimbing berhasil dihapus !']);
    }
}
