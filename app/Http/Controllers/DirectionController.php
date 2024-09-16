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
use App\Models\Direction;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DirectionExportExcel;
use PDF;
use App\Models\User;


class DirectionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/param/direction");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Direction::getList_Direction($req)->paginate(20);
		$giwu['listrespo_id'] = User::sltListUser();
		if($req->ajax()) {
			return view('direction.index-search')->with($giwu);
		}
		return view('direction.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/param/direction/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listrespo_id'] = User::sltListUser();
		return view('direction.create')->with($giwu);
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
				'code_direc' => 'required',
				'lib_direc' => 'required',
				'respo_id' => 'required',
			]);

			if($validator->fails()){
				return response()->json(['response' => $validator->errors()]);
			}else{
				$datas = $request->all();
				unset($datas['_token']);
				//Enregistrement des donnees 
				$newAdd = new Direction();
				$newAdd->code_direc = $datas['code_direc'];
				$newAdd->lib_direc = $datas['lib_direc'];
				$newAdd->respo_id = $datas['respo_id'];
				$newAdd->init_id = Auth::id();
				$newAdd->save(); 

				GiwuSaveTrace::enregistre('Ajout du nouveau direction : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
				
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
		$giwu['item'] = Direction::where('id_direc',$id)->first();
		return view('direction.delete')->with($giwu);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
		$array = GiwuService::Path_Image_menu("/param/direction/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listrespo_id'] = User::sltListUser();
		$giwu['item'] = Direction::where('id_direc',$id)->first();
		return view('direction.edit')->with($giwu);
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
				'code_direc' => 'required',
				'lib_direc' => 'required',
				'respo_id' => 'required',
			]);

			if($validator->fails()){
				return response()->json(['response' => $validator->errors()]);
			}else{
				$dataInitiale = Direction::where('id_direc',$id)->first()->toArray();
				$datas = $request->all();
				unset($datas['_token']);

				$newUpd=Direction::where('id_direc',$id)->first();

				$newUpd->code_direc = $datas['code_direc'];
				$newUpd->lib_direc = $datas['lib_direc'];
				$newUpd->respo_id = $datas['respo_id'];
				$newUpd->save();

				GiwuSaveTrace::enregistre("Modification direction : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
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
			$dataInitiale = Direction::find($id)->toArray();
			$affectedRows = Direction::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du direction : ".$dataSupp);
				return redirect()->route('direction.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Direction::getList_Direction($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['code_direc'] = $giw->code_direc;
				$tablgiwu[$i]['lib_direc'] = $giw->lib_direc;
				$tablgiwu[$i]['respo_id'] = isset($giw->responsable) ? $giw->responsable->name.' '.$giw->responsable->prenom : trans('data.not_found');
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsDirection', $Resultat);
		return Excel::download(new DirectionExportExcel, 'DirectionExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Direction::getList_Direction($req)->get();
		$pdf = PDF::loadView('direction.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('direction-'.date('Ymdhis').'.pdf');
	}

	


}

