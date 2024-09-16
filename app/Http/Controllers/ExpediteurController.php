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
use App\Models\Expediteur;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExpediteurExportExcel;
use PDF;


class ExpediteurController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/cour/expediteur");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Expediteur::getListExpediteur($req)->paginate(20);
		if($req->ajax()) {
			return view('expediteur.index-search')->with($giwu);
		}
		return view('expediteur.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/cour/expediteur/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		return view('expediteur.create')->with($giwu);
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
				'type_expe' => 'required',
				'nom_expe' => 'required',
				'email_expe' => 'required',
			]);

			if($validator->fails()){
				return response()->json(['response' => $validator->errors()]);
			}else{
				$datas = $request->all();
				$email = $datas['email_expe'];

				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
					return response()->json(['response' => array('email_expe' =>'E-mail incorrecte.')]);
				}
				unset($datas['_token']);
				//Enregistrement des donnees 
				$newAdd = new Expediteur();
				$newAdd->type_expe = $datas['type_expe'];
				$newAdd->nom_expe = $datas['nom_expe'];
				$newAdd->adres_expe = $datas['adres_expe'];
				$newAdd->email_expe = $email;
				$newAdd->init_id = Auth::id();
				$newAdd->save(); 

				GiwuSaveTrace::enregistre('Ajout du nouveau expediteur : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
				
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
		$giwu['item'] = Expediteur::where('id_expe',$id)->first();
		return view('expediteur.delete')->with($giwu);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
		$array = GiwuService::Path_Image_menu("/cour/expediteur/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['item'] = Expediteur::where('id_expe',$id)->first();
		return view('expediteur.edit')->with($giwu);
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
				'type_expe' => 'required',
				'nom_expe' => 'required',
				'email_expe' => 'required',
			]);

			if($validator->fails()){
				return response()->json(['response' => $validator->errors()]);
			}else{
				$dataInitiale = Expediteur::where('id_expe',$id)->first()->toArray();
				$datas = $request->all();
				unset($datas['_token']);

				//Condition de modification sur E-mail
				$email = $datas['email_expe'];
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
					return response()->json(['response' => array('email_expe' =>'E-mail incorrecte.')]);
				}
				$newUpd=Expediteur::where('id_expe',$id)->first();
				$newUpd->type_expe = $datas['type_expe'];
				$newUpd->nom_expe = $datas['nom_expe'];
				$newUpd->adres_expe = $datas['adres_expe'];
				$newUpd->email_expe = $email ;
				$newUpd->save();

				GiwuSaveTrace::enregistre("Modification expediteur : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
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
			$dataInitiale = Expediteur::find($id)->toArray();
			$affectedRows = Expediteur::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du expediteur : ".$dataSupp);
				return redirect()->route('expediteur.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Expediteur::getListExpediteur($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['id_expe'] = $giw->id_expe;
				$tablgiwu[$i]['nom_expe'] = $giw->nom_expe;
				$tablgiwu[$i]['type_expe'] = trans('entite.type_expediteur')[$giw->type_expe];
				$tablgiwu[$i]['adres_expe'] = $giw->adres_expe;
				$tablgiwu[$i]['email_expe'] = $giw->email_expe;
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsExpediteur', $Resultat);
		return Excel::download(new ExpediteurExportExcel, 'ExpediteurExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Expediteur::getListExpediteur($req)->get();
		$pdf = PDF::loadView('expediteur.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('expediteur-'.date('Ymdhis').'.pdf');
	}

	


}

