<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $data = $request->validated();
        $company = new Company($data);
        $company->logo = asset('/storage/' . $request->file('logo')->store('logos', 'public'));
        $company->save();
        return redirect()->route('companies.show', ['company' => $company]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompanyRequest $request, Company $company)
    {
        $data = $request->validated();
        // Check previous logo
        if(isset($company->logo) && isset($data['logo'])) {
            // Remove previous logo
            // http://localhost/storage/logos/DWQYwRyn7M5k3tLm6DprlkI5YS7IoV18m7EXjFg5.jpg"
            $path = explode('/storage/', $company->logo);
            Storage::disk('public')->delete($path[1]);
        }
        foreach ($data as $key => $value) {
            $company->$key = $value;
        }
        if($request->file('logo')) {
            // Store new logo
            $company->logo = asset('/storage/' . $request->file('logo')->store('logos', 'public'));
        }
        $company->save();
        return redirect()->route('companies.show', ['company' => $company]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        dd('destroy');
    }
}
