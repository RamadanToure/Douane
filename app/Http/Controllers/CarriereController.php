<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\GiwuSaveTrace;
use App\Providers\GiwuService;
use Auth;
use App\Models\Carriere;
use App\Models\Direction;
use App\Models\Service;
use App\Models\Division;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CarriereExportExcel;
use PDF;


class CarriereController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/carriere/carriere");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Carriere::getListCarriere($req)->paginate(20);
		$giwu['listid_occupant'] = User::sltListUser();
		$giwu['listinit_id'] = User::sltListUser();
		if($req->ajax()) {
			return view('carriere.index-search')->with($giwu);
		}
		return view('carriere.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/carriere/carriere/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listid_occupant'] = User::sltListUser();
		$giwu['listinit_id'] = User::sltListUser();
		return view('carriere.create')->with($giwu);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
		try {
			$datas = $request->all();
			unset($datas['_token']);
			if ($datas['date_debut_carr'] >= $datas['date_fin_carr']) {
				return Redirect::back()->withInput()->with('error', "La date de début doit être inférieure à la date de fin.");
			}
			$existingPeriod = Carriere::where('type_fonct',$datas['type_fonct'])
										->where('id_fonct',$datas['id_fonct'])
										->where('id_occupant',$datas['id_occupant'])
										->where(function ($query) use ($datas) {
				$query->where('date_debut_carr', '<=', $datas['date_debut_carr'])->where('date_fin_carr', '>=', $datas['date_debut_carr']);
			})->orWhere(function ($query) use ($datas) {
				$query->where('date_debut_carr', '<=', $datas['date_fin_carr'])->where('date_fin_carr', '>=', $datas['date_fin_carr']);
			})->first();
			if ($existingPeriod) {
				return Redirect::back()->withInput()->with('error', "La période choisie est déjà ajoutée pour ce compte de cet occupant.");
			}
			$newAdd = new Carriere();
			$newAdd->type_fonct = $datas['type_fonct'];
			$newAdd->id_fonct = $datas['id_fonct'];
			$newAdd->date_debut_carr = $datas['date_debut_carr'];
			$newAdd->date_fin_carr = $datas['date_fin_carr'];
			$newAdd->salaire_carr = $datas['salaire_carr'];
			$newAdd->id_occupant = $datas['id_occupant'];
			$newAdd->init_id = Auth::id();
			$newAdd->save(); 

			GiwuSaveTrace::enregistre('Ajout du nouveau carriere : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
			
			return Redirect::back()->with('success',trans('data.infos_add'));
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
		$array = GiwuService::Path_Image_menu("/carriere/carriere/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listid_occupant'] = User::sltListUser();
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['item'] = Carriere::where('id_carr',$id)->first();
		if($giwu['item']){
			if($giwu['item']->type_fonct =='dr'){
				$giwu['destina'] = Direction::sltListDirection();
			}else if($giwu['item']->type_fonct =='se'){
				$giwu['destina'] = Service::sltListService();
			}else if($giwu['item']->type_fonct =='di'){
				$giwu['destina'] = Division::sltListDivision();
			}
		}
		return view('carriere.edit')->with($giwu);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
		try {
			$dataInitiale = Carriere::where('id_carr',$id)->first()->toArray();
			$datas = $request->all();
			unset($datas['_token']);

			$newUpd=Carriere::where('id_carr',$id)->first();
			if ($datas['date_debut_carr'] >= $datas['date_fin_carr']) {
				return Redirect::back()->withInput()->with('error', "La date de début doit être inférieure à la date de fin.");
			}
			$existingPeriod = Carriere::where('type_fonct',$datas['type_fonct'])
										->where('id_fonct',$datas['id_fonct'])
										->where('id_occupant',$datas['id_occupant'])
										->where(function ($query) use ($datas) {
				$query->where('date_debut_carr', '<=', $datas['date_debut_carr'])->where('date_fin_carr', '>=', $datas['date_debut_carr']);
			})->orWhere(function ($query) use ($datas) {
				$query->where('date_debut_carr', '<=', $datas['date_fin_carr'])->where('date_fin_carr', '>=', $datas['date_fin_carr']);
			})->first();
			if ($existingPeriod && $existingPeriod->id_carr != $id) {
				return Redirect::back()->withInput()->with('error', "La période choisie est déjà ajoutée pour ce compte de cet occupant.");
			}
			$newUpd->type_fonct = $datas['type_fonct'];
			$newUpd->id_fonct = $datas['id_fonct'];
			$newUpd->date_debut_carr = $datas['date_debut_carr'];
			$newUpd->date_fin_carr = $datas['date_fin_carr'];
			$newUpd->salaire_carr = $datas['salaire_carr'];
			$newUpd->id_occupant = $datas['id_occupant'];
			$newUpd->save();

			GiwuSaveTrace::enregistre("Modification carriere : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
			return redirect()->route('carriere.index')->with('success',trans('data.infos_update'));
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function AffichePopDelete($id) {
		$giwu['item'] = Carriere::where('id_carr',$id)->first();
		return view('carriere.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Carriere::find($id)->toArray();
			$affectedRows = Carriere::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du carriere : ".$dataSupp);
				return redirect()->route('carriere.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Carriere::getListCarriere($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['type_fonct'] = trans('entite.type_destinataire')[$giw->type_fonct];
				$tablgiwu[$i]['id_fonct'] = $giw->fonction($giw->type_fonct,$giw->id_fonct);
				$tablgiwu[$i]['date_debut_carr'] = date('d/m/Y',strtotime($giw->date_debut_carr));
				$tablgiwu[$i]['date_fin_carr'] = date('d/m/Y',strtotime($giw->date_fin_carr));
				$tablgiwu[$i]['salaire_carr'] = $giw->salaire_carr;
				$tablgiwu[$i]['id_occupant'] = isset($giw->occupant) ? $giw->occupant->name.' '.$giw->occupant->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsCarriere', $Resultat);
		return Excel::download(new CarriereExportExcel, 'CarriereExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Carriere::getListCarriere($req)->get();
		$pdf = PDF::loadView('carriere.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('carriere-'.date('Ymdhis').'.pdf');
	}

	


}

