<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\CompanyExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id', 'desc')->paginate(10);

        return view('company.list', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:companies,email',
            'website' => 'required',
            'logo' => 'required|mimes:jpeg,jpg,png,svg|dimensions:min_width=100,min_height=100',
        ]);

        $query = new Company();
        $query->name = $request->name;
        $query->email = $request->email;
        $query->website = $request->website;
        if($request->hasFile('logo')){
            $query->logo = '/storage/'.$request->file('logo')->store('logo');
        }
        $query->save();

        return redirect()->route('companies.index')->with('message', 'Company Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:companies,email,'.$id,
            'website' => 'required',
            'logo' => 'nullable|mimes:jpeg,jpg,png,svg|dimensions:min_width=100,min_height=100',
        ]);

        $query = Company::findOrFail($id);
        $query->name = $request->name;
        $query->email = $request->email;
        $query->website = $request->website;
        if($request->hasFile('logo')){
            $query->logo = '/storage/'.$request->file('logo')->store('logo');
        }
        $query->save();

        return redirect()->route('companies.index')->with('message', 'Company Added Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::where('id', $id)->delete();

        return redirect()->back()->with('message', 'Comapny Deleted Successfully.');
    }

    public function exportCompany(){
        return Excel::download(new CompanyExport, 'company.xlsx');
    }
}
