@extends('layouts.main')

@section('main-content')
 <div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="text-center card-box">
            <div>
                <img src="{{auth()->user()->profile_picture ?? '/assets/images/noimage.jpeg'}}" class="rounded-circle avatar-xl img-thumbnail mb-3" alt="profile-image">
                <div class="text-left">
                    <p class="text-muted font-13"><strong>Nama Lengkap :</strong> <span class="ml-2">{{ucwords(auth()->user()->name)}}</span></p>
                    <p class="text-muted font-13"><strong>Kelas :</strong><span class="ml-2">{{auth()->user()->student->class}}</span></p>
                    <p class="text-muted font-13"><strong>Email :</strong> <span class="ml-2">{{auth()->user()->email}}</span></p>
                </div>
                <div class="text-left">
                    <p class="text-muted font-13"><strong>Perusahaan :</strong><span class="ml-2">{{auth()->user()->student->company->name}}</span></p>
                    <p class="text-muted font-13"><strong>Alamat Perusahaan :</strong> <span class="ml-2">{{auth()->user()->student->company->address}}</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-6">
        <div class="card-box">
            <div class="row">
                <div class="col-12">
                    <h5 class="mb-3">Jadwal Prakerin</h5>
                </div>
                
                <div class="col-12">Tanggal Mulai : {{auth()->user()->student->schedule ? (auth()->user()->student->schedule->start ? date('Y-m-d', strtotime(auth()->user()->student->schedule->start)) : '-') : '-'}}</div>
                <div class="col-12 mb-3">Tanggal Selesai : {{auth()->user()->student->schedule ? (auth()->user()->student->schedule->end ? date('Y-m-d', strtotime(auth()->user()->student->schedule->end)) : '-') : '-'}}</div>
                
                <div class="col-6 text-center">Jam Masuk</div>
                <div class="col-6 text-center">Jam Keluar</div>

                <div class="col-12 text-center border-top pt-2">Senin</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->monday_in ? date('H:i', strtotime(auth()->user()->student->schedule->monday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->monday_out ? date('H:i', strtotime(auth()->user()->student->schedule->monday_out)) : '-') : '-'}}</div>

                <div class="col-12 text-center border-top pt-2">Selasa</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->tuesday_in ? date('H:i', strtotime(auth()->user()->student->schedule->tuesday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->tuesday_out ? date('H:i', strtotime(auth()->user()->student->schedule->tuesday_out)) : '-') : '-'}}</div>

                <div class="col-12 text-center border-top pt-2">Rabu</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->wednesday_in ? date('H:i', strtotime(auth()->user()->student->schedule->wednesday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->wednesday_out ? date('H:i', strtotime(auth()->user()->student->schedule->wednesday_out)) : '-') : '-'}}</div>

                <div class="col-12 text-center border-top pt-2">Kamis</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->thursday_in ? date('H:i', strtotime(auth()->user()->student->schedule->thursday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->thursday_out ? date('H:i', strtotime(auth()->user()->student->schedule->thursday_out)) : '-') : '-'}}</div>

                <div class="col-12 text-center border-top pt-2">Jumat</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->friday_in ? date('H:i', strtotime(auth()->user()->student->schedule->friday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->friday_out ? date('H:i', strtotime(auth()->user()->student->schedule->friday_out)) : '-') : '-'}}</div>

                <div class="col-12 text-center border-top pt-2">Sabtu</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->saturday_in ? date('H:i', strtotime(auth()->user()->student->schedule->saturday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->saturday_out ? date('H:i', strtotime(auth()->user()->student->schedule->saturday_out)) : '-') : '-'}}</div>

                <div class="col-12 text-center border-top pt-2">Minggu</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->sunday_in ? date('H:i', strtotime(auth()->user()->student->schedule->sunday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{auth()->user()->student->schedule ? (auth()->user()->student->schedule->sunday_out ? date('H:i', strtotime(auth()->user()->student->schedule->sunday_out)) : '-') : '-'}}</div>
                
            </div>
        </div>
    </div>
 </div>
 @endsection