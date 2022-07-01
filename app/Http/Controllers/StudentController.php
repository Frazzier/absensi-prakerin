<?php

namespace App\Http\Controllers;

use App\Models\{Company, Student, StudentPresence, StudentSchedule, User};
use Illuminate\Http\Request;
use File;
use Hash;

class StudentController extends Controller
{
    public function index()
    {
        $title = 'Murid';
        switch (auth()->user()->role) {
            case 'admin':
                $students = Student::all();
                break;
            
            case 'mentor':
                $students = Student::where('mentor_id', auth()->user()->id)->get();
                break;
        }

        return view('student.index', compact('title','students'));
    }
    
    public function create()
    {
        $title = 'Tambah Murid';
        $companies = Company::all();
        $mentors = User::where('role','mentor')->get();

        return view('student.create', compact('title','companies','mentors'));

    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'class' => 'required',
            'profile_picture' => 'nullable|mimes:png,jpg,jpeg',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'company_id' => 'required|exists:companies,id',
            'mentor_id' => 'required|exists:users,id',
        ]);

        $profile_picture = null;
        if($request->profile_picture){
            $profile_picture = $request->profile_picture->store(
                'user', 'uploads'
            );
            $profile_picture = "/uploads/$profile_picture";
        }

        $user = User::create([
            'name' => $request->name,
            'profile_picture' => $profile_picture,
            'email' => $request->email,
            'role' => 'student',
            'password' => Hash::make($request->password),
        ]);

        Student::create([
            'user_id' => $user->id,
            'mentor_id' => $request->mentor_id,
            'company_id' => $request->company_id,
            'class' => $request->class,
        ]);

        return redirect('/student')->with('success', 'Murid berhasil ditambahkan !');
    }
    
    public function show(Student $student)
    {
        $title = ucwords($student->user->name);
        $presences = StudentPresence::where('student_id', $student->id)->get();
        return view('student.show', compact('title','student','presences'));
    }
    
    public function edit(Student $student)
    {
        $title = 'Edit Murid';
        $companies = Company::all();
        $mentors = User::where('role','mentor')->get();

        return view('student.edit', compact('title','companies','mentors','student'));
    }
    
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'profile_picture' => 'nullable|mimes:png,jpg,jpeg',
            'email' => 'required|email|unique:users,email,'.$student->user->id,
            'password' => 'nullable|min:8|confirmed',
            'company_id' => 'required|exists:companies,id',
            'mentor_id' => 'required|exists:users,id',
        ]);

        if($request->profile_picture){
            $profile_picture = $request->profile_picture->store(
                'user', 'uploads'
            );
            $profile_picture = "/uploads/$profile_picture";

            $file_path = public_path($student->user->profile_picture);

            if (File::exists($file_path)) {
                File::delete($file_path);
            }
        }

        $student->user->name = $request->name;
        if($request->profile_picture){
            $student->user->profile_picture = $profile_picture;
        }
        $student->user->email = $request->email;
        if($request->password){
            $student->user->password = Hash::make($request->password);
        }
        $student->user->save();

        $student->class = $request->class;
        $student->mentor_id = $request->mentor_id;
        $student->company_id = $request->company_id;
        $student->save();

        return redirect('/student')->with('success', 'Data murid berhasil diperbaharui !');
    }
    
    public function destroy(Student $student)
    {
        $file_path = public_path($student->user->profile_picture);

        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $student->user->delete();

        $students = Student::all();
        $html = view('student.table', compact('students'))->render();

        return response(['success' => true, 'html' => $html, 'message' => 'Data murid berhasil dihapus !']);
    }
}
