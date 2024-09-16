<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ArchiveExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsArchive');
	} 

	public function  headings():array{
		return [
			trans('data.ref_doc'),
			trans('data.code_doc'),
			trans('data.sujet_doc'),
			trans('data.type_doc'),
			trans('data.direc_id'),
			trans('data.fichier_doc'),
			trans('data.statut_doc'),
			trans('data.init_id'),
		];
	}
}
