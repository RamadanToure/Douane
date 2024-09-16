<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CarriereExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsCarriere');
	} 

	public function  headings():array{
		return [
			trans('data.type_fonct'),
			trans('data.id_fonct'),
			trans('data.date_debut_carr'),
			trans('data.date_fin_carr'),
			trans('data.salaire_carr'),
			trans('data.id_occupant'),
		];
	}
}
