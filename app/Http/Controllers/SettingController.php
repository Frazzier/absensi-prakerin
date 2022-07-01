<?php

namespace App\Http\Controllers;

use App\Models\{Setting};
use Illuminate\Http\Request;
use File;

class SettingController extends Controller
{
    public function index()
    {
        $title = "Pengaturan";
        return view('setting.index', compact('title'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required',
            'logo' => 'nullable|mimes:png,jpg,jpeg',
            'small_logo' => 'nullable|mimes:png,jpg,jpeg',
            'login_background' => 'nullable|mimes:png,jpg,jpeg',
       ],[
           'app_name.required' => 'Mohon isi nama aplikasi !',
           'logo.required' => 'Mohon masukan file',
           'logo.mimes' => 'File yang diterima adalah png, jpg dan jpeg',
       ]);

       $setting = Setting::find(1);
       $setting->app_name = $request->app_name;
       
       if($request->logo){
            $file = $request->logo->storeAs(
                'setting', 'logo.'.$request->logo->getClientOriginalExtension(), 'uploads'
            );
            $file = "uploads/$file";

            $file_path = public_path($setting->logo);

            if (File::exists($file_path)) {
                File::delete($file_path);
            }
            $setting->logo = $file;
        }

        if($request->small_logo){
            $file = $request->small_logo->storeAs(
                'setting', 'small_logo.'.$request->small_logo->getClientOriginalExtension(), 'uploads'
            );
            $file = "uploads/$file";
            
            $file_path = public_path($setting->small_logo);
            
            if (File::exists($file_path)) {
                File::delete($file_path);
            }
            $setting->small_logo = $file;
         }

        if($request->login_background){
           $file = $request->login_background->storeAs(
               'setting', 'login_background.'.$request->login_background->getClientOriginalExtension(), 'uploads'
           );
           $file = "uploads/$file";
           
           $file_path = public_path($setting->login_background);
           
           if (File::exists($file_path)) {
               File::delete($file_path);
            }
            $setting->login_background = $file;
        }

        $setting->save();
        return redirect('/setting')->with('success', 'Pengaturan berhasil diperbaharui !');
    }
}
