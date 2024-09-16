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
use App\Models\Courriersortant;
use App\Models\Expediteur;
use App\Models\Direction;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CourriersortantExportExcel;
use PDF;
use App\Utilities\FileStorage;
use Ramsey\Uuid\Uuid;


class CourriersortantController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/cour/courriersortant");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Courriersortant::getListCourrierSortant($req)->paginate(20);
		$giwu['listdest_id'] = Expediteur::sltListExpediteur();
		$giwu['listdirec_id'] = Direction::sltListDirection();
		$giwu['listinit_id'] = User::sltListUser();
		if($req->ajax()) {
			return view('courriersortant.index-search')->with($giwu);
		}
		return view('courriersortant.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/cour/courriersortant/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listdest_id'] = Expediteur::sltListExpediteur();
		$giwu['listdirec_id'] = Direction::sltListDirection();
		$giwu['listinit_id'] = User::sltListUser();
		return view('courriersortant.create')->with($giwu);
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
			//Condition sur Piece jointe
			$datas['piece_jointe']="";
			$file1 = $request->file('piece_jointe');
			if($file1){
				$extension = strtolower($file1->getClientOriginalExtension());
				if($extension != 'pdf'){
					return Redirect::back()->withInput()->with('error',"Le fichier (Pièce jointe) doit être type (*.pdf).");
				}
				$filename=FileStorage::setFile('avatar',$file1,"","");
				$pathName = "assets/courrier/";
				$file1->move($pathName, $filename);
				$datas['piece_jointe']=$filename;
			}
			$newAdd = new Courriersortant();
			$newAdd->ref_cour = $datas['ref_cour'];
			$newAdd->code_cour = Uuid::uuid4();
			$newAdd->date_envoi = $datas['date_envoi'];
			$newAdd->sujet_cour = $datas['sujet_cour'];
			$newAdd->note_cour = $datas['note_cour'];
			$newAdd->piece_jointe = $datas['piece_jointe'];
			$newAdd->dest_id = $datas['dest_id'];
			$newAdd->direc_id = $datas['direc_id'];
			$newAdd->init_id = Auth::id();
			$newAdd->save(); 

			GiwuSaveTrace::enregistre('Ajout du nouveau courriersortant : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
			
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
		$array = GiwuService::Path_Image_menu("/cour/courriersortant/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listdest_id'] = Expediteur::sltListExpediteur();
		$giwu['listdirec_id'] = Direction::sltListDirection();
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['item'] = Courriersortant::where('id_cours',$id)->first();
		return view('courriersortant.edit')->with($giwu);
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
			$dataInitiale = Courriersortant::where('id_cours',$id)->first()->toArray();
			$datas = $request->all();
			unset($datas['_token']);

			$newUpd=Courriersortant::where('id_cours',$id)->first();

			//Condition de modification sur Piece jointe
			$datas['piece_jointe']=$newUpd->piece_jointe;
			$file1 = $request->file('piece_jointe');
			if($file1){
				!is_null($newUpd->piece_jointe) && Filestorage::deleteFile('avatar',$newUpd->piece_jointe,"");
				$extension = strtolower($file1->getClientOriginalExtension());
				if($extension != 'pdf'){
					return Redirect::back()->withInput()->with('error',"Le fichier (Pièce jointe) doit être type (*.pdf).");
				}
				$filename=FileStorage::setFile('avatar',$file1,"","");
				$pathName = "assets/courrier/";
				$file1->move($pathName, $filename);
				$datas['piece_jointe']=$filename;
			}
			$newUpd->ref_cour = $datas['ref_cour'];
			$newUpd->date_envoi = $datas['date_envoi'];
			$newUpd->sujet_cour = $datas['sujet_cour'];
			$newUpd->note_cour = $datas['note_cour'];
			$newUpd->piece_jointe = $datas['piece_jointe'];
			$newUpd->dest_id = $datas['dest_id'];
			$newUpd->direc_id = $datas['direc_id'];
			$newUpd->save();

			GiwuSaveTrace::enregistre("Modification courriersortant : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
			return redirect()->route('courriersortant.index')->with('success',trans('data.infos_update'));
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
		$giwu['item'] = Courriersortant::where('id_cours',$id)->first();
		return view('courriersortant.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Courriersortant::find($id)->toArray();
			$affectedRows = Courriersortant::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du courriersortant : ".$dataSupp);
				return redirect()->route('courriersortant.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Courriersortant::getListCourrierSortant($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['ref_cour'] = $giw->ref_cour;
				$tablgiwu[$i]['code_cour'] = $giw->code_cour;
				$tablgiwu[$i]['date_envoi'] = $giw->date_envoi;
				$tablgiwu[$i]['sujet_cour'] = $giw->sujet_cour;
				$tablgiwu[$i]['note_cour'] = $giw->note_cour;
				$tablgiwu[$i]['piece_jointe'] = $giw->piece_jointe;
				$tablgiwu[$i]['expediteur'] = isset($giw->expediteur) ? $giw->expediteur->nom_expe : trans('data.not_found');
				$tablgiwu[$i]['direction'] = isset($giw->direction) ? $giw->direction->code_direc : trans('data.not_found');
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsCourriersortant', $Resultat);
		return Excel::download(new CourriersortantExportExcel, 'CourriersortantExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Courriersortant::getListCourrierSortant($req)->get();
		$pdf = PDF::loadView('courriersortant.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('courriersortant-'.date('Ymdhis').'.pdf');
	}

	


}

