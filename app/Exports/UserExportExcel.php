<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExportExcel implements FromCollection, WithHeadings,ShouldAutoSize
{
	/**
	* @return \Illuminate\Support\Collection
	*/
	public function collection(){
		return session('xlsUser');
	} 
	public function  headings():array{
		return [
			trans('data.name'),
			trans('data.prenom'),
			trans('data.email'),
			trans('data.tel_user'),
			trans('data.other_infos_user'),
			trans('data.id_role'),
			trans('data.is_active'),
		];

	} 
}
