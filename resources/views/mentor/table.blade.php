<table id="user-table" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Siswa Dibimbing</th>
        <th>#</th>
    </tr>
    </thead>


    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->students_count}}</td>
            <td>
                <button class="btn btn-sm waves-effect waves-light btn-info detail-user" data-id="{{$user->id}}"><i class="fas fa-info-circle"></i></button>
                <a href="/mentor/{{$user->id}}/edit" class="btn btn-sm waves-effect waves-light btn-success"><i class="fas fa-edit"></i></a>
                @if($user->id != auth()->user()->id)
                <button class="btn btn-sm waves-effect waves-light btn-danger delete-user" data-id="{{$user->id}}"><i class="fas fa-trash"></i></button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>