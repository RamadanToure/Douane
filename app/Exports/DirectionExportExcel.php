<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DirectionExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsDirection');
	} 

	public function  headings():array{
		return [
			trans('data.code_direc'),
			trans('data.lib_direc'),
			trans('data.respo_id'),
			trans('data.init_id'),
		];
	}
}
