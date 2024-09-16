<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CourriersortantExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsCourriersortant');
	} 

	public function  headings():array{
		return [
			trans('data.ref_cour'),
			trans('data.code_cour'),
			trans('data.date_envoi'),
			trans('data.sujet_cour'),
			trans('data.note_cour'),
			trans('data.piece_jointe'),
			trans('data.dest_id'),
			trans('data.direc_id'),
			trans('data.init_id'),
		];
	}
}
