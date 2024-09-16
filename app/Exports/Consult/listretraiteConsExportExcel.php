<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports\Consult;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class listretraiteConsExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlslistretraite');
	} 

	public function  headings():array{
		return [
			trans('data.matricule'),
			trans('data.name'),
			trans('data.prenom'),
			trans('data.email'),
			trans('data.grade'),
			trans('data.echellon'),
			trans('data.date_embauche'),
			trans('data.date_nais'),
			trans('data.other_infos_user'),
			trans('data.tel_user'),
		];
	}
}
