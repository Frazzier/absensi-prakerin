<?php

namespace App\Http\Controllers;

use App\Models\{Student, StudentPresence, StudentSchedule};
use Illuminate\Http\Request;
use Carbon\Carbon;

class StudentScheduleController extends Controller
{
    public function updateSchedule(Request $request, Student $student)
    {
        $schedule = StudentSchedule::updateOrCreate([
            'student_id' => $student->id
        ],[
            'start' => $request->start,
            'end' => $request->end,
            'sunday_in' => $request->sunday_in,
            'sunday_out' => $request->sunday_out,
            'monday_in' => $request->monday_in,
            'monday_out' => $request->monday_out,
            'tuesday_in' => $request->tuesday_in,
            'tuesday_out' => $request->tuesday_out,
            'wednesday_in' => $request->wednesday_in,
            'wednesday_out' => $request->wednesday_out,
            'thursday_in' => $request->thursday_in,
            'thursday_out' => $request->thursday_out,
            'friday_in' => $request->friday_in,
            'friday_out' => $request->friday_out,
            'saturday_in' => $request->saturday_in,
            'saturday_out' => $request->saturday_out,
        ]);

        return redirect("/student/$student->id")->with('success','Jadwal berhasil diperbaharui !');
    }

    public function schedule()
    {
        $title = 'Jadwal Prakerin';
        return view('student.schedule', compact('title'));
    }

    public function createSchedule()
    {
        $title = 'Buat Jadwal';
        $students = Student::where('mentor_id', auth()->user()->id)->get();
        return view('schedule.create', compact('title','students'));
    }

    public function storeSchedule(Request $request)
    {
        foreach ($request->student_ids as $student_id) {
            $schedule = StudentSchedule::updateOrCreate([
                'student_id' => $student_id
            ],[
                'start' => $request->start,
                'end' => $request->end,
                'sunday_in' => $request->sunday_in,
                'sunday_out' => $request->sunday_out,
                'monday_in' => $request->monday_in,
                'monday_out' => $request->monday_out,
                'tuesday_in' => $request->tuesday_in,
                'tuesday_out' => $request->tuesday_out,
                'wednesday_in' => $request->wednesday_in,
                'wednesday_out' => $request->wednesday_out,
                'thursday_in' => $request->thursday_in,
                'thursday_out' => $request->thursday_out,
                'friday_in' => $request->friday_in,
                'friday_out' => $request->friday_out,
                'saturday_in' => $request->saturday_in,
                'saturday_out' => $request->saturday_out,
            ]);
        }

        return redirect('/student')->with('success','Jadwal berhasil dibuat !');
    }

    public function freeSchedule(Student $student)
    {
        $presence = StudentPresence::where('student_id', $student->id)
                        ->whereDate('created_at', Carbon::today())
                        ->firstOrNew();

        
        $presence->schedule_time_in = null;
        $presence->schedule_time_out = null;
        $presence->in = null;
        $presence->out = null;
        $presence->coordinate_in = null;
        $presence->coordinate_out = null;
        $presence->is_free = 'yes';
        $presence->save();

        return response([
            'success' => true,
            'message' => 'Berhasil meliburkan siswa !',
        ], 200);
    }
}
