<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ServiceExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsService');
	} 

	public function  headings():array{
		return [
			trans('data.code_serv'),
			trans('data.lib_serv'),
			trans('data.id_direc'),
			trans('data.respo_id'),
			trans('data.init_id'),
		];
	}
}
