<?php

namespace App\Imports;

use App\Models\{Company, Student, User};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class DataImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $company = Company::updateOrCreate([
                'name' => $row['nama_perusahaan']
            ],[
                'address' => $row['alamat_perusahaan']
            ]);

            if($company){
                $mentor = User::updateOrCreate([
                    'email' => $row['email_pembimbing']
                ],[
                    'name' => $row['nama_pembimbing'],
                    'role' => 'mentor',
                    'password' => Hash::make('password'),
                ]);

                if($mentor){
                    $user = User::updateOrCreate([
                        'email' => $row['email_siswa']
                    ],[
                        'name' => $row['nama_siswa'],
                        'role' => 'student',
                        'password' => Hash::make('password'),
                    ]);

                    if($user){
                        Student::updateOrCreate([
                            'user_id' => $user->id
                        ],[
                            'company_id' => $company->id,
                            'mentor_id' => $mentor->id,
                            'class' => $row['kelas_siswa']
                        ]);
                    }
                }
            }
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}