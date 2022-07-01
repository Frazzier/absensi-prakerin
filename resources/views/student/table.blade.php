<table id="student-table" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Pembimbing</th>
        <th>Perusahaan</th>
        <th>#</th>
    </tr>
    </thead>


    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{$student->user->name}}</td>
            <td>{{$student->user->email}}</td>
            <td>{{$student->mentor->name}}</td>
            <td>{{$student->company->name}}</td>
            <td>
                <a href="/student/{{$student->id}}" class="btn btn-sm waves-effect waves-light btn-info"><i class="fas fa-info-circle"></i></a>
                @if (auth()->user()->role == 'admin')
                    <a href="/student/{{$student->id}}/edit" class="btn btn-sm waves-effect waves-light btn-success"><i class="fas fa-edit"></i></a>
                    <button class="btn btn-sm waves-effect waves-light btn-danger delete-student" data-id="{{$student->id}}"><i class="fas fa-trash"></i></button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>