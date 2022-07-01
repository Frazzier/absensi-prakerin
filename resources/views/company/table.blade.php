<table id="company-table" class="table table-bordered dt-responsive nowrap w-100">
    <thead>
    <tr>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Jumlah Siswa</th>
        <th>#</th>
    </tr>
    </thead>

    <tbody>
        @foreach($companies as $company)
        <tr>
            <td>{{$company->name}}</td>
            <td>{{$company->address}}</td>
            <td>{{$company->students_count}}</td>
            <td>
                <!-- <button class="btn btn-sm waves-effect waves-light btn-info detail-company" data-id="{{$company->id}}"><i class="fas fa-info-circle"></i></button> -->
                <a href="/company/{{$company->id}}/edit" class="btn btn-sm waves-effect waves-light btn-success"><i class="fas fa-edit"></i></a>
                <button class="btn btn-sm waves-effect waves-light btn-danger delete-company" data-id="{{$company->id}}"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>