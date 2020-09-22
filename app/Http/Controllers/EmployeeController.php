<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Employee;
use App\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);

        return view('employee.list', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::orderBy('id', 'desc')->get();

        return view('employee.create', compact('companies'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|unique:employees,phone',
            'company_id' => 'required|exists:companies,id',
        ]);

        $query = new Employee();
        $query->first_name = $request->first_name;
        $query->last_name = $request->last_name;
        $query->email = $request->email;
        $query->phone = $request->phone;
        $query->company_id = $request->company_id;
        $query->save();

        return redirect()->route('employees.index')->with('message', 'Employee Added Successfully.');
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
        $employee = Employee::where('id', $id)->first();
        $companies = Company::orderBy('id', 'desc')->get();

        return view('employee.edit', compact('employee', 'companies'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email,'.$id,
            'phone' => 'required|unique:employees,phone,'.$id,
            'company_id' => 'required|exists:companies,id',
        ]);

        $query = Employee::where('id', $id)->first();
        if($query == null){
            return redirect()->back()->with('error', 'Employee not found');
        }
        $query->first_name = $request->first_name;
        $query->last_name = $request->last_name;
        $query->email = $request->email;
        $query->phone = $request->phone;
        $query->company_id = $request->company_id;
        $query->save();

        return redirect()->route('employees.index')->with('message', 'Employee Edited Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->delete();
        return redirect()->back()->with('messgae', 'Employee Deleted Successfully.');
    }

    public function exportEmployee(){
        return Excel::download(new EmployeeExport, 'employee.xlsx');
    }
}
