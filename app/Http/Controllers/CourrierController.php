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
use App\Models\Courrier;
use App\Models\Expediteur;
use App\Models\Direction;
use App\Models\Service;
use App\Models\Division;
use App\Models\TranfertCourierEntrant;
use App\Models\User;
use App\Utilities\FileStorage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CourrierExportExcel;
use PDF;
use Validator;
use Ramsey\Uuid\Uuid;

class CourrierController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {
		// foreach(Courrier::all() as $cour){
		// 	$re = Courrier::where('id_cour',$cour->id_cour)->first();
		// 	$re->code_check = random_int(1000000,9999999);
		// 	$re->save();
		// }
		$array = GiwuService::Path_Image_menu("/cour/courrier");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Courrier::getListCourrier($req)->paginate(20);
		$giwu['nbreCourrier'] = Courrier::getListCourrier($req)->count();

		$giwu['listexpe_id'] = Expediteur::sltListExpediteur();
		$giwu['listdirec_id'] = Direction::sltListDirection();
		$giwu['listinit_id'] = User::sltListUser();
		if($req->ajax()) {
			return view('courrier.index-search')->with($giwu);
		}
		return view('courrier.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/cour/courrier/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listexpe_id'] = Expediteur::sltListExpediteur();
		$giwu['listdirec_id'] = Direction::sltListDirection();
		$giwu['listinit_id'] = User::sltListUser();
		return view('courrier.create')->with($giwu);
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
			$datas['piece_jointe_cour']="";
			$file1 = $request->file('piece_jointe_cour');
			if($file1){
				$extension = strtolower($file1->getClientOriginalExtension());
				if($extension != 'pdf'){
					return Redirect::back()->withInput()->with('error',"Le fichier (Pièce jointe) doit être type (*.pdf).");
				}
				$filename=FileStorage::setFile('avatar',$file1,"","");
				$pathName = "assets/courrier/";
				$file1->move($pathName, $filename);
				$datas['piece_jointe_cour']=$filename;
			}
			$newAdd = new Courrier();
			$newAdd->ref_cour = $datas['ref_cour'];
			$newAdd->code_cour = Uuid::uuid4();
			$newAdd->date_rece = $datas['date_rece'];
			$newAdd->date_limite = $datas['date_limite'];
			$newAdd->expe_id = $datas['expe_id'];
			$newAdd->sujet_cour = $datas['sujet_cour'];
			$newAdd->type_cour = 'e';
			$newAdd->statut_cour = 'ec';
			$newAdd->priorite_cour = $datas['priorite_cour'];
			$newAdd->direc_id = $datas['direc_id'];
			$newAdd->commentaire_cour = $datas['commentaire_cour'];
			$newAdd->piece_jointe_cour = $datas['piece_jointe_cour'];
			$newAdd->code_check = random_int(1000000,9999999);
			$newAdd->init_id = Auth::id();
			$newAdd->save();

			GiwuSaveTrace::enregistre('Ajout du nouveau courrier : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
			
			return Redirect::back()->with('success',trans('data.infos_add').' Le code de suivi est : '.$newAdd->code_check);
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
		$array = GiwuService::Path_Image_menu("/cour/courrier/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listexpe_id'] = Expediteur::sltListExpediteur();
		$giwu['listdirec_id'] = Direction::sltListDirection();
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['item'] = Courrier::where('id_cour',$id)->first();
		return view('courrier.edit')->with($giwu);
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
			$dataInitiale = Courrier::where('id_cour',$id)->first()->toArray();
			$datas = $request->all();
			unset($datas['_token']);

			$newUpd=Courrier::where('id_cour',$id)->first();

			//Condition de modification sur Piece jointe
			$datas['piece_jointe_cour']=$newUpd->piece_jointe_cour;
			$file1 = $request->file('piece_jointe_cour');
			if($file1){
				!is_null($newUpd->piece_jointe_cour) && Filestorage::deleteFile('avatar',$newUpd->piece_jointe_cour,"");
				$extension = strtolower($file1->getClientOriginalExtension());
				if($extension != 'pdf'){
					return Redirect::back()->withInput()->with('error',"Le fichier (Pièce jointe) doit être type (*.pdf).");
				}
				$filename=FileStorage::setFile('avatar',$file1,"","");
				$pathName = "assets/courrier/";
				$file1->move($pathName, $filename);
				$datas['piece_jointe_cour']=$filename;
			}
			$newUpd->ref_cour = $datas['ref_cour'];
			$newUpd->date_rece = $datas['date_rece'];
			$newUpd->date_limite = $datas['date_limite'];
			$newUpd->expe_id = $datas['expe_id'];
			$newUpd->sujet_cour = $datas['sujet_cour'];
			// $newUpd->type_cour = $datas['type_cour'];
			// $newUpd->statut_cour = $datas['statut_cour'];
			$newUpd->priorite_cour = $datas['priorite_cour'];
			$newUpd->direc_id = $datas['direc_id'];
			$newUpd->commentaire_cour = $datas['commentaire_cour'];
			$newUpd->piece_jointe_cour = $datas['piece_jointe_cour'];
			$newUpd->save();

			GiwuSaveTrace::enregistre("Modification courrier : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
			return redirect()->route('courrier.index')->with('success',trans('data.infos_update'));
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
		$giwu['item'] = Courrier::where('id_cour',$id)->first();
		return view('courrier.delete')->with($giwu);
	}

	public function AffichePopConfirmerExpe($id) {

		$giwu['item'] = Courrier::with(['expediteur'])->whereCode_cour($id)->first();
		$giwu['expediteur'] = "";
		if($giwu['item']->expediteur){
			$giwu['expediteur'] = $giwu['item']->expediteur->nom_expe;
		}
		return view('courrier.confirmer')->with($giwu);
	}

	public function ConfirmerCourrier($id) {
		try {

			$affectedRows = Courrier::find($id)->first();
			if ($affectedRows) {
				$affectedRows->statut_cour = 'en';
				$affectedRows->save();
				//Mettre à jour les tranfertCourrier 
				$user = User::find(Auth::id());
				TranfertCourierEntrant::where('type_destina',$user->type_fonct)
										->where('id_desti',$user->id_fonct)
										->where('courier_id',$affectedRows->id_cour)
										->update(['etat_trce'=>'en']);
				return Redirect::back()->withInput()->with('success',trans('data.infos_transmise'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Courrier::find($id)->toArray();
			$affectedRows = Courrier::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du courrier : ".$dataSupp);
				return redirect()->route('courrier.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Courrier::getListCourrier($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['id_cour'] = $giw->id_cour;
				$tablgiwu[$i]['ref_cour'] = $giw->ref_cour;
				// $tablgiwu[$i]['code_cour'] = $giw->code_cour;
				$tablgiwu[$i]['date_rece'] = date('d/m/Y',strtotime($giw->date_rece));
				$tablgiwu[$i]['date_limite'] = date('d/m/Y',strtotime($giw->date_limite));
				$tablgiwu[$i]['expediteur'] = isset($giw->expediteur) ? $giw->expediteur->nom_expe : trans('data.not_found');
				$tablgiwu[$i]['sujet_cour'] = $giw->sujet_cour;
				$tablgiwu[$i]['type_cour'] = $giw->type_cour;
				$tablgiwu[$i]['statut_cour'] = $giw->statut_cour;
				$tablgiwu[$i]['priorite_cour'] = $giw->priorite_cour;
				$tablgiwu[$i]['direction'] = isset($giw->direction) ? $giw->direction->code_direc : trans('data.not_found');
				$tablgiwu[$i]['commentaire_cour'] = $giw->commentaire_cour;
				$tablgiwu[$i]['piece_jointe_cour'] = $giw->piece_jointe_cour;
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsCourrier', $Resultat);
		return Excel::download(new CourrierExportExcel, 'CourrierExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Courrier::getListCourrier($req)->get();
		$pdf = PDF::loadView('courrier.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('courrier-'.date('Ymdhis').'.pdf');
	}

    public static function AffichePopTransfert($id){

        $giwu['item'] = Courrier::where('id_cour',$id)->first();
		if(Auth::id() == $giwu['item']->init_id){
			$giwu['disabled'] = 'disabled';
			$giwu['priorite'] = $giwu['item']->priorite_cour;
			$giwu['idDest'] = $giwu['item']->direc_id;
			$giwu['typeDest'] = 'dr';
			$giwu['destina'] = Direction::sltListDirection();
		}else{
			$giwu['disabled'] = 'enable';
			$giwu['idDest'] = null;
			$giwu['priorite'] = '';
			$giwu['typeDest'] = '';
			$giwu['destina'] = [];
		}
		return view('courrier.transfert')->with($giwu);
    }

    public static function AffichePopTraiter($id){

        $giwu['item'] = Courrier::with(['expediteur'])->where('id_cour',$id)->first();
		$user = User::find(Auth::id());
		$giwu['type_fonct'] = '';
		if($user){
			$giwu['type_fonct'] = $user->type_fonct;
		}
		return view('courrier.traiter')->with($giwu);
    }

    public static function NiveauExecution($codesuivi){
		if(trim($codesuivi) == ''){
			return response()->json(['response' => array('refCourrier' => 'Le champs est obligatoire.')]);
		}
        $check = Courrier::where('code_check',$codesuivi)->first();
		if(!$check){
			return response()->json(['response' => array('refCourrier' => 'Ce code n\'existe pas.')]);
		}

		$tran = TranfertCourierEntrant::where('courier_id',$check->id_cour)
										->latest()->first();
		if(!$tran){
			return response()->json(['response' => array('refCourrier' => 'Courrier toujours en attente de transmission')]);
		}
		$msg = 	'Position : '.$tran->fonction($tran->type_destina, $tran->id_desti).'<br>'.
				'Etat : '.trans('entite.statut_courrier')[$check->statut_cour];
		$file = "";
		if($tran->fichier_reponse){
			$val 	= 'assets/courrier/'.$tran->fichier_reponse;
			$file 	= '<br>Fichier réponse : <a href="'.$val.'" target="_blank" class="badge bg-success">Télécharger</a>';
			// $file 	.= '<br>Note : '.$tran->note_trce;
		}
		return response()->json(['response' => 1, 'message' => $msg, 'fichier' => $file]);
    }

    public static function ListeDestinataires($idtype)
    {
		// 	'dr' => 'Direction',
		// 	'se' => 'Service',
		// 	'di' => 'Division',
		if($idtype == 'dr'){
			$query = Direction::orderBy('lib_direc','asc')->get();
		}else if($idtype == 'se'){
			$query = Service::orderBy('lib_serv','asc')->get();
		}else if($idtype == 'di'){
			$query = Division::orderBy('lib_divi','asc')->get();
		}
		return response()->json($query);
    }

	public function TransfertCourier(Request $request){
		
		$validator = Validator::make($request->all(), [
			'note_trce' => 'required',
			'priorite_cour' => 'required',
			'type_destina' => 'required',
			'id_desti' => 'required',
		]);
		if($validator->fails()){
			return response()->json(['response' => $validator->errors()]);
		}else{
			//etat_trce
			// 'ec' => 'Encours',
			// 'tf' => 'Transferé',
			// 'tr' => 'Traité',
			$datas = $request->all();

			//Mettre à jour le statut de la ligne du courrier recu 
			$user = User::find(Auth::id());
			if($user){
				TranfertCourierEntrant::where('type_destina',$user->type_fonct)
										->where('id_desti',$user->id_fonct)
										->where('courier_id',$datas['id_cour'])
										->update(['etat_trce'=>'tf']); 
			}
			$newAdd = new TranfertCourierEntrant();
			$newAdd->type_destina = $datas['type_destina'];
			$newAdd->id_desti 	= $datas['id_desti'];
			$newAdd->note_trce 	= $datas['note_trce'];
			$newAdd->etat_trce 	= 'ec'; // => 'Encours',
			$newAdd->en_copie 	= 'non';
			$newAdd->id_initi 	= Auth::id();
			$newAdd->courier_id = $datas['id_cour'];
			$newAdd->save();

			//Mettre a jour le statut du courrier
			$courrier = Courrier::where('id_cour',$datas['id_cour'])->first();
			if($courrier){
				$courrier->ChangerStatutCourrier('tf');
			}
            return response()->json(['response' => 1]);
        }
	}
	
	public function  TraiterCourier(Request $request) {
		
		$validator = Validator::make($request->all(), [
			'fichier_reponse' => 'required',
			'note_trce' => 'required',
		]);
		if($validator->fails()){
			return response()->json(['response' => $validator->errors()]);
		}else{
			$getFil = $request->file('fichier_reponse');
			if(!isset($getFil)){
				return response()->json(['response' => array('fichier_reponse' => 'Le champs est obligatoire.')]);
			}
			$fichierAvi="";
			$datas = $request->all();
			$file1 = $request->file('fichier_reponse');
			if($file1){
				$extension = strtolower($file1->getClientOriginalExtension());
				if($extension != 'pdf'){
					return response()->json(['response' => array('fichier_reponse'=>'Le fichier doit être de type (*.pdf).')]);
				}
				$filename = FileStorage::setFile('avatar',$file1,"","");
				$pathName = "assets/courrier/";
				$file1->move($pathName, $filename);
				$fichierAvi=$filename;
			}
			//Mettre a jour le statut du courrier
			$user = User::find(Auth::id());
			$courrier = Courrier::where('id_cour',$datas['id_cour'])->first();
			if($courrier){
				$courrier->ChangerStatutCourrier('tr');
			}
			if($user->type_fonct != 'dr'){
				//Si celui qui traite le courrier est different d'une direction alors renvoyer
				//réponse à la dernière direction qui à envoyé le courrier
				$direc = TranfertCourierEntrant::where('type_destina','dr')
												->where('courier_id',$datas['id_cour'])
												->orderBy('id_trce','desc')
												->first();
				if($direc){
					$newAdd = new TranfertCourierEntrant();
					$newAdd->type_destina = 'dr';
					$newAdd->id_desti 	= $direc->id_desti;
					$newAdd->note_trce 	= $datas['note_trce'];
					$newAdd->etat_trce 	= 'ec'; // => 'Encours',
					$newAdd->en_copie 	= 'non';
					$newAdd->fichier_reponse = $fichierAvi;
					$newAdd->id_initi 	= Auth::id();
					$newAdd->courier_id = $datas['id_cour'];
					$newAdd->save();
				}
			}else{ //Direction
				$send = '';
				if($request->get('envoyer_courrier')){
					//Envoyer un mail à l'expéditeur
					$send = 'en';// 'en' => 'Envoyé',
					$courrier->ChangerStatutCourrier('en');
				}else{
					$send = 'tr';// 'tr' => 'Traité',
				}
				TranfertCourierEntrant::where('type_destina',$user->type_fonct)
										->where('id_desti',$user->id_fonct)
										->where('courier_id',$datas['id_cour'])
										->update(['etat_trce'=>$send]);
				//Mettre à jour rejoindre le fichier réponse au courrier
				$courrier->fichier_reponse= $fichierAvi;
				$courrier->save();
			}
			return response()->json(['response' => 1]);
		}
	}

	public function ConsulterCourrier($code) {
		
		$array = GiwuService::Path_Image_menu("/cour/courrier/consulter");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$allinfos = Courrier::with(['expediteur'])->whereCode_cour($code)->first();
		if($allinfos){
			$giwu['item'] = $allinfos;
			$giwu['traceCourrier'] = TranfertCourierEntrant::where('courier_id',$giwu['item']->id_cour)
														->orderBy('id_trce','asc')
														->get();
			return view('courrier.consulter')->with($giwu);
		}else{
			$giwu['item'] = $allinfos;
			$giwu['traceCourrier'] = '';
		}
	}

}

