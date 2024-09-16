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
use App\Models\Division;
use App\Models\Service;
use App\Models\User;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DivisionExportExcel;
use PDF;


class DivisionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/param/division");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Division::getListDivision($req)->paginate(20);
		$giwu['listid_serv'] = Service::sltListService();
		$giwu['listrespo_id'] = User::sltListUser();
		if($req->ajax()) {
			return view('division.index-search')->with($giwu);
		}
		return view('division.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/param/division/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listid_serv'] = Service::sltListService();
		$giwu['listrespo_id'] = User::sltListUser();
		return view('division.create')->with($giwu);
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
				'code_divi' => 'required',
				'lib_divi' => 'required',
				'id_serv' => 'required',
				'respo_id' => 'required',
			]);

			if($validator->fails()){
				return response()->json(['response' => $validator->errors()]);
			}else{
				$datas = $request->all();
				unset($datas['_token']);
				//Enregistrement des donnees 
				$newAdd = new Division();
				$newAdd->code_divi = $datas['code_divi'];
				$newAdd->lib_divi = $datas['lib_divi'];
				$newAdd->id_serv = $datas['id_serv'];
				$newAdd->respo_id = $datas['respo_id'];
				$newAdd->init_id = Auth::id();
				$newAdd->save(); 

				GiwuSaveTrace::enregistre('Ajout du nouveau division : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
				
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
		$giwu['item'] = Division::where('id_divi',$id)->first();
		return view('division.delete')->with($giwu);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
		$array = GiwuService::Path_Image_menu("/param/division/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listid_serv'] = Service::sltListService();
		$giwu['listrespo_id'] = User::sltListUser();
		$giwu['item'] = Division::where('id_divi',$id)->first();
		return view('division.edit')->with($giwu);
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
				'code_divi' => 'required',
				'lib_divi' => 'required',
				'id_serv' => 'required',
				'respo_id' => 'required',
			]);

			if($validator->fails()){
				return response()->json(['response' => $validator->errors()]);
			}else{
				$dataInitiale = Division::where('id_divi',$id)->first()->toArray();
				$datas = $request->all();
				unset($datas['_token']);

				$newUpd=Division::where('id_divi',$id)->first();

				$newUpd->code_divi = $datas['code_divi'];
				$newUpd->lib_divi = $datas['lib_divi'];
				$newUpd->id_serv = $datas['id_serv'];
				$newUpd->respo_id = $datas['respo_id'];
				$newUpd->save();

				GiwuSaveTrace::enregistre("Modification division : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
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
			$dataInitiale = Division::find($id)->toArray();
			$affectedRows = Division::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du division : ".$dataSupp);
				return redirect()->route('division.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Division::getListDivision($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['code_divi'] = $giw->code_divi;
				$tablgiwu[$i]['lib_divi'] = $giw->lib_divi;
				$tablgiwu[$i]['service'] = isset($giw->service) ? $giw->service->code_serv : trans('data.not_found');
				$tablgiwu[$i]['respo_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsDivision', $Resultat);
		return Excel::download(new DivisionExportExcel, 'DivisionExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Division::getListDivision($req)->get();
		$pdf = PDF::loadView('division.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('division-'.date('Ymdhis').'.pdf');
	}

	


}

