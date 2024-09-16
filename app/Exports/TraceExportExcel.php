<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TraceExportExcel implements FromCollection, WithHeadings,ShouldAutoSize
{
	/**
	* @return \Illuminate\Support\Collection
	*/
	public function collection(){
		return session('xlsTrace');
	} 
	public function  headings():array{
		return [
			trans('data.created_at'),
			trans('data.id_user'),
			trans('data.libelle_trace'),
		];

	} 
}
