<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $title = "Perusahaan";
        $companies = Company::withCount('students')->get();

        return view('company.index', compact('title','companies'));
    }

    public function create()
    {
        $title = "Tambah Perusahaan";
        return view('company.create', compact('title'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255'
        ]);

        Company::create([
            'name' => $request->name,
            'address' => $request->address
        ]);

        return redirect('/company')->with('success', 'Perusahaan berhasil ditambahkan !');
    }
    
    // public function show(Company $company)
    // {
        // 
    // }

    public function edit(Company $company)
    {
        $title = "Edit Perusahaan";

        return view('company.edit', compact('title', 'company'));
    }
    
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255'
        ]);
        
        $company->update($request->all());

        return redirect('/company')->with('success', 'Data perusahaan berhasil diperbaharui !');
    }
    
    public function destroy(Company $company)
    {
        $company->delete();

        $companies = Company::withCount('students')->get();        
        $html = view('company.table', compact('companies'))->render();

        return response(['success' => true, 'html' => $html, 'message' => 'Data perusahaan berhasil dihapus !']);
    }
}
