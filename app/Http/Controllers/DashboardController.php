<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        // $count['athlete'] = Athlete::where('post_status', 'aktif')->count();
        // $count['infrastructure'] = Infrastructure::where('post_status', 'aktif')->count();
        // $count['sport_club'] = SportClub::where('post_status', 'aktif')->count();
        // $count['pioneer'] = Pioneer::where('post_status', 'aktif')->count();
        // $count['young_business'] = YoungBusiness::where('post_status', 'aktif')->count();
        // $count['youth_organization'] = YouthOrganization::where('post_status', 'aktif')->count();
        
        // $bg = [
        //     ['progress-bar-alt-primary', 'bg-primary'],
        //     ['progress-bar-alt-pink', 'bg-pink'],
        //     ['progress-bar-alt-info', 'bg-info'],
        //     ['progress-bar-alt-warning', 'bg-warning'],
        //     ['progress-bar-alt-danger', 'bg-danger'],
        //     ['progress-bar-alt-success', 'bg-success']
        // ];

        // $sports = Sport::orderBy('name')->get();

        // return view('dashboard', compact('title', 'count','bg','sports'));
        return view('dashboard', compact('title'));
    }

    public function location(Request $request)
    {
        $title = "Lokasi";
        return view('map.location', compact('title'));
    }
}
