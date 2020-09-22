<?php

namespace App\Exports;

use App\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanyExport implements FromCollection, WithHeadings
{
	public function headings(): array
    {
    	return [
            'Name',
            'Email',
            'Logo',
            'Website',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$base_url = asset('/');
        return Company::selectRaw('name, email, CONCAT("'.$base_url.'", logo) AS logos, website')->get();
    }
}
