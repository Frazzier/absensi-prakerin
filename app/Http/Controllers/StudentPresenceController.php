<?php

namespace App\Http\Controllers;

use App\Models\StudentPresence;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StudentPresenceController extends Controller
{
    public function in()
    {
        if(!auth()->user()->student->schedule 
        || (auth()->user()->student->schedule && !auth()->user()->student->schedule[strtolower(date('l')).'_in']) 
        || (auth()->user()->student->schedule && auth()->user()->student->schedule->start && strtotime(auth()->user()->student->schedule->start) > strtotime(date('Y-m-d'))))
        {
            return redirect()->back()->withErrors(['Anda tidak punya jadwal masuk hari ini !']);
        }
        $presence = StudentPresence::where('student_id', auth()->user()->student->id)
                        ->whereDate('created_at', Carbon::today())
                        ->first();
        if($presence && $presence->in){
            return redirect()->back()->withErrors(['Anda sudah absen masuk hari ini !']);
        }
        if($presence && $presence->is_free == 'yes'){
            return redirect()->back()->withErrors(['Hari ini anda libur !']);
        }
        
        $title = 'Absen Masuk';
        return view('presence.in', compact('title'));
    }

    public function out()
    {
        $presence = StudentPresence::where([
                        ['student_id', auth()->user()->student->id],
                        ['out', null],
                    ])
                    ->latest()->first();
        if(!$presence){
            return redirect()->back()->withErrors(['Anda belum absen masuk !']);
        }
        if($presence && $presence->out){
            return redirect()->back()->withErrors(['Anda sudah absen keluar hari ini !']);
        }
        if($presence && $presence->is_free == 'yes'){
            return redirect()->back()->withErrors(['Hari ini anda libur !']);
        }

        $title = 'Absen Keluar';
        return view('presence.out', compact('title'));
    }

    public function storeIn(Request $request)
    {
        $request->validate([
            'coordinate' => 'required',
        ],[
            'coordinate.required' => 'Koordinat tidak ditemukan !'
        ]);

        $presence = StudentPresence::where('student_id', auth()->user()->student->id)
                        ->whereDate('created_at', Carbon::today())
                        ->firstOrNew();
        
        $presence->student_id = auth()->user()->student->id;
        $presence->schedule_time_in = auth()->user()->student->schedule[strtolower(date('l')).'_in'];
        $presence->coordinate_in = $request->coordinate;
        $presence->in = date('H:i');
        $presence->save();

        return redirect('/dashboard')->with('success','Berhasil melakukan absensi masuk !');
    }

    public function storeOut(Request $request)
    {
        $request->validate([
            'coordinate' => 'required',
        ],[
            'coordinate.required' => 'Koordinat tidak ditemukan !'
        ]);
        
        $presence = StudentPresence::where([
                        ['student_id', auth()->user()->student->id],
                        ['out', null],
                    ])
                    ->latest()->first();
        
        $presence->student_id = auth()->user()->student->id;
        $presence->schedule_time_out = auth()->user()->student->schedule[strtolower(date('l')).'_out'];
        $presence->coordinate_out = $request->coordinate;
        $presence->out = date('H:i');
        $presence->save();

        return redirect('/dashboard')->with('success','Berhasil melakukan absensi keluar !');
    }

    public function history()
    {
        $title = 'Riwayat';
        $presences = StudentPresence::where('student_id', auth()->user()->student->id)->get();

        return view('student.history', compact('title','presences'));
    }
}
