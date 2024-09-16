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
use App\Models\Service;
use App\Models\Direction;
use App\Models\User;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ServiceExportExcel;
use PDF;


class ServiceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/param/service");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Service::getListService($req)->paginate(20);
		$giwu['listid_direc'] = Direction::sltListDirection();
		$giwu['listrespo_id'] = User::sltListUser();
		if($req->ajax()) {
			return view('service.index-search')->with($giwu);
		}
		return view('service.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/param/service/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listid_direc'] = Direction::sltListDirection();
		$giwu['listrespo_id'] = User::sltListUser();
		return view('service.create')->with($giwu);
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
			$validator = Validator::make($request->all(), [
				'code_serv' => 'required',
				'lib_serv' => 'required',
				'id_direc' => 'required',
				'respo_id' => 'required',
			]);

			if($validator->fails()){
				return response()->json(['response' => $validator->errors()]);
			}else{
				$datas = $request->all();
				unset($datas['_token']);
				//Enregistrement des donnees 
				$newAdd = new Service();
				$newAdd->code_serv = $datas['code_serv'];
				$newAdd->lib_serv = $datas['lib_serv'];
				$newAdd->id_direc = $datas['id_direc'];
				$newAdd->respo_id = $datas['respo_id'];
				$newAdd->init_id = Auth::id();
				$newAdd->save(); 

				GiwuSaveTrace::enregistre('Ajout du nouveau service : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
				
				return response()->json(['response' => 1]);
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return response()->json(['response' => 0,'message' => $e->getMessage()]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//Pop Up pour la suppression d'une ligne 
		$giwu['item'] = Service::where('id_serv',$id)->first();
		return view('service.delete')->with($giwu);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
		$array = GiwuService::Path_Image_menu("/param/service/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listid_direc'] = Direction::sltListDirection();
		$giwu['listrespo_id'] = User::sltListUser();
		$giwu['item'] = Service::where('id_serv',$id)->first();
		return view('service.edit')->with($giwu);
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
			$validator = Validator::make($request->all(), [
				'code_serv' => 'required',
				'lib_serv' => 'required',
				'id_direc' => 'required',
				'respo_id' => 'required',
			]);

			if($validator->fails()){
				return response()->json(['response' => $validator->errors()]);
			}else{
				$dataInitiale = Service::where('id_serv',$id)->first()->toArray();
				$datas = $request->all();
				unset($datas['_token']);

				$newUpd=Service::where('id_serv',$id)->first();

				$newUpd->code_serv = $datas['code_serv'];
				$newUpd->lib_serv = $datas['lib_serv'];
				$newUpd->id_direc = $datas['id_direc'];
				$newUpd->respo_id = $datas['respo_id'];
				$newUpd->save();

				GiwuSaveTrace::enregistre("Modification service : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
				return response()->json(['response' => 1]);
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return response()->json(['response' => 0,'message' => $e->getMessage()]);

		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
		try {
			$dataInitiale = Service::find($id)->toArray();
			$affectedRows = Service::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du service : ".$dataSupp);
				return redirect()->route('service.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Service::getListService($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['code_serv'] = $giw->code_serv;
				$tablgiwu[$i]['lib_serv'] = $giw->lib_serv;
				$tablgiwu[$i]['direction'] = isset($giw->direction) ? $giw->direction->code_direc : trans('data.not_found');
				$tablgiwu[$i]['respo_id'] = isset($giw->responsable) ? $giw->responsable->name.' '.$giw->responsable->prenom : trans('data.not_found');
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsService', $Resultat);
		return Excel::download(new ServiceExportExcel, 'ServiceExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Service::getListService($req)->get();
		$pdf = PDF::loadView('service.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('service-'.date('Ymdhis').'.pdf');
	}

	


}

