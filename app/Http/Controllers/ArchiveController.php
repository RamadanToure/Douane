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
use App\Models\Archive;
use App\Models\Direction;
use App\Models\User;
use App\Utilities\FileStorage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArchiveExportExcel;
use PDF;
use Ramsey\Uuid\Uuid;


class ArchiveController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/archive/archive");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Archive::getListArchive($req)->paginate(20);
		$giwu['listdirec_id'] = Direction::sltListDirection();
		$giwu['listinit_id'] = User::sltListUser();
		if($req->ajax()) {
			return view('archive.index-search')->with($giwu);
		}
		return view('archive.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/archive/archive/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listdirec_id'] = Direction::sltListDirection();
		$giwu['listinit_id'] = User::sltListUser();
		return view('archive.create')->with($giwu);
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
			//Condition sur Fichier
			$datas['fichier_doc']="";
			$file1 = $request->file('fichier_doc');
			if($file1){
				$extension = strtolower($file1->getClientOriginalExtension());
				if($extension != 'pdf'){
					return Redirect::back()->withInput()->with('error',"Le fichier (Pièce jointe) doit être type (*.pdf).");
				}
				$filename=FileStorage::setFile('avatar',$file1,"","");
				$pathName = "assets/courrier/";
				$file1->move($pathName, $filename);
				$datas['fichier_doc']=$filename;
			}
			$newAdd = new Archive();
			$newAdd->ref_doc = $datas['ref_doc'];
			$newAdd->code_doc = Uuid::uuid4();
			$newAdd->sujet_doc = $datas['sujet_doc'];
			$newAdd->type_doc = $datas['type_doc'];
			$newAdd->direc_id = $datas['direc_id'];
			$newAdd->fichier_doc = $datas['fichier_doc'];
			$newAdd->statut_doc = $datas['statut_doc'];
			$newAdd->init_id = Auth::id();
			$newAdd->save(); 

			GiwuSaveTrace::enregistre('Ajout du nouveau archive : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
			
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
		$array = GiwuService::Path_Image_menu("/archive/archive/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listdirec_id'] = Direction::sltListDirection();
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['item'] = Archive::where('id_archive',$id)->first();
		return view('archive.edit')->with($giwu);
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
			$dataInitiale = Archive::where('id_archive',$id)->first()->toArray();
			$datas = $request->all();
			unset($datas['_token']);

			$newUpd=Archive::where('id_archive',$id)->first();

			//Condition de modification sur Fichier
			$datas['fichier_doc']=$newUpd->fichier_doc;
			$file1 = $request->file('fichier_doc');
			if($file1){
				!is_null($newUpd->fichier_doc) && Filestorage::deleteFile('avatar',$newUpd->fichier_doc,"");
				$extension = strtolower($file1->getClientOriginalExtension());
				if($extension != 'pdf'){
					return Redirect::back()->withInput()->with('error',"Le fichier (Pièce jointe) doit être type (*.pdf).");
				}
				$filename=FileStorage::setFile('avatar',$file1,"","");
				$pathName = "assets/courrier/";
				$file1->move($pathName, $filename);
				$datas['fichier_doc']=$filename;
			}
			$newUpd->ref_doc = $datas['ref_doc'];
			$newUpd->sujet_doc = $datas['sujet_doc'];
			$newUpd->type_doc = $datas['type_doc'];
			$newUpd->direc_id = $datas['direc_id'];
			$newUpd->fichier_doc = $datas['fichier_doc'];
			$newUpd->statut_doc = $datas['statut_doc'];
			$newUpd->save();

			GiwuSaveTrace::enregistre("Modification archive : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
			return redirect()->route('archive.index')->with('success',trans('data.infos_update'));
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
		$giwu['item'] = Archive::where('id_archive',$id)->first();
		return view('archive.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Archive::find($id)->toArray();
			$affectedRows = Archive::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du archive : ".$dataSupp);
				return redirect()->route('archive.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Archive::getListArchive($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['ref_doc'] = $giw->ref_doc;
				$tablgiwu[$i]['code_doc'] = $giw->code_doc;
				$tablgiwu[$i]['sujet_doc'] = $giw->sujet_doc;
				$tablgiwu[$i]['type_doc'] = $giw->type_doc;
				$tablgiwu[$i]['direction'] = isset($giw->direction) ? $giw->direction->code_direc : trans('data.not_found');
				$tablgiwu[$i]['fichier_doc'] = $giw->fichier_doc;
				$tablgiwu[$i]['statut_doc'] = $giw->statut_doc;
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsArchive', $Resultat);
		return Excel::download(new ArchiveExportExcel, 'ArchiveExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Archive::getListArchive($req)->get();
		$pdf = PDF::loadView('archive.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('archive-'.date('Ymdhis').'.pdf');
	}

	


}

