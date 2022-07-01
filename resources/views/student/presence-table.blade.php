<h5>Keterangan :</h5>
<span class="text-warning">*) Libur</span>
<div class="mb-3"></div>
<table id="presence-table" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
    <tr>
        <th>Tanggal</th>
        <th>Jadwal Masuk</th>
        <th>Absen Masuk</th>
        <th>Lokasi</th>
        <th>Jadwal Keluar</th>
        <th>Absen Keluar</th>
        <th>Lokasi</th>
    </tr>
    </thead>


    <tbody>
        @foreach($presences as $presence)
        <tr>
            <td>{{date('d-m-Y', strtotime($presence->created_at))}}</td>
            @if($presence->is_free != 'yes')
            <td>{{date('H:i', strtotime($presence->schedule_time_in))}}</td>
            <td>{{date('H:i', strtotime($presence->in))}}</td>
            <td><a href="/location?coordinate={{$presence->coordinate_in}}">{{$presence->coordinate_in}}</a></td>
            <td>{{date('H:i', strtotime($presence->schedule_time_out))}}</td>
            <td>{{date('H:i', strtotime($presence->out))}}</td>
            <td><a href="/location?coordinate={{$presence->coordinate_out}}">{{$presence->coordinate_out}}</a></td>
            @else
            <td class="text-center bg-warning"></td>
            <td class="text-center bg-warning"></td>
            <td class="text-center bg-warning"></td>
            <td class="text-center bg-warning"></td>
            <td class="text-center bg-warning"></td>
            <td class="text-center bg-warning"></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>