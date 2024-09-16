<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CourrierExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsCourrier');
	} 

	public function  headings():array{
		return [
			trans('data.id_cour'),
			trans('data.ref_cour'),
			// trans('data.code_cour'),
			trans('data.date_rece'),
			trans('data.date_limite'),
			trans('data.expe_id'),
			trans('data.sujet_cour'),
			trans('data.type_cour'),
			trans('data.statut_cour'),
			trans('data.priorite_cour'),
			trans('data.direc_id'),
			trans('data.commentaire_cour'),
			trans('data.piece_jointe_cour'),
			trans('data.init_id'),
		];
	}
}
