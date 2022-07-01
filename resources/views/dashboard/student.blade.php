<div class="row">
    <div class="col-12 col-md-4">
        <div class="card-box">
            <h5 class="mb-3">Selamat Datang {{ucwords(auth()->user()->name)}} !</h5>
            <div>
                <div class="text-center">
                    <img src="{{auth()->user()->profile_picture ?? '/assets/images/noimage.jpeg'}}" class="rounded-circle avatar-xl img-thumbnail mb-3" alt="profile-image">
                </div>
                <div class="text-left">
                    <p class="text-muted font-13">Jadwal Mulai : {{auth()->user()->student->schedule ? (auth()->user()->student->schedule->start ? date('Y-m-d', strtotime(auth()->user()->student->schedule->start)) : '-') : '-'}}</p>
                    <p class="text-muted font-13 mb-3">Jadwal Selesai : {{auth()->user()->student->schedule ? (auth()->user()->student->schedule->end ? date('Y-m-d', strtotime(auth()->user()->student->schedule->end)) : '-') : '-'}}</p>
                    <p class="text-muted font-13">Jadwal anda hari ini :</p>
                    <p class="text-muted font-13">Jam Masuk : 
                        @if (auth()->user()->student->schedule && auth()->user()->student->schedule[strtolower(date('l')).'_in'])
                            {{date('H:i', strtotime(auth()->user()->student->schedule[strtolower(date('l')).'_in']))}}
                        @else
                            -
                        @endif
                    </p>
                    <p class="text-muted font-13">Jam Keluar : 
                        @if (auth()->user()->student->schedule && auth()->user()->student->schedule[strtolower(date('l')).'_out'])
                            {{date('H:i', strtotime(auth()->user()->student->schedule[strtolower(date('l')).'_out']))}}
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card-box">
            <h5 class="text-center">Lakukan absen masuk</h5>
            <a href="presence/in" class="btn btn-success btn-block">Klik disini !</a>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card-box">
            <h5 class="text-center">Lakukan absen keluar</h5>
            <a href="presence/out" class="btn btn-danger btn-block">Klik disini !</a>
        </div></div>
</div>