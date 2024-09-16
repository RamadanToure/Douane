<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExpediteurExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsExpediteur');
	} 

	public function  headings():array{
		return [
			trans('data.id_expe'),
			trans('data.nom_expe'),
			trans('data.type_expe'),
			trans('data.adres_expe'),
			trans('data.email_expe'),
			trans('data.init_id'),
		];
	}
}
