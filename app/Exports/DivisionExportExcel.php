<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DivisionExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsDivision');
	} 

	public function  headings():array{
		return [
			trans('data.code_divi'),
			trans('data.lib_divi'),
			trans('data.id_serv'),
			trans('data.respo_id'),
			trans('data.init_id'),
		];
	}
}
