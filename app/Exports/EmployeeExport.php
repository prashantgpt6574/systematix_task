<?php

namespace App\Exports;

use App\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, WithHeadings
{
	public function headings(): array
    {
    	return [
            'First Name',
            'Last Name',
            'Email',
            'Phone',
            'Company',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::selectRaw('employees.first_name, employees.last_name, employees.email, employees.phone, companies.name')->leftJoin('companies', 'employees.company_id', 'companies.id')->get();
    }
}
