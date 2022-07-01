<?php

namespace App\Http\Controllers;

use App\Imports\{DataImport};
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function data(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new DataImport, $request->file('file'));
        return redirect('/dashboard')->with('success', 'Data Berhasil Diimport');
    }
}
