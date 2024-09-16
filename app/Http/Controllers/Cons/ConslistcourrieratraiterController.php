<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Http\Controllers\Cons;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Courrier;
use App\Models\GiwuSaveTrace;
use App\Providers\GiwuService;
use Auth,DateTime,DB;
use App\Models\Direction;
use App\Models\User;
use App\Models\TranfertCourierEntrant;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Consult\listcourrieratraiterConsExportExcel;
use PDF;


class ConslistcourrieratraiterController extends Controller {

	public static function getListCourrier(Request $req){

		$query = Courrier::with(['expediteur','direction','users_g'])->orderBy('created_at','desc');
		
		$lisTypeCourv = $req->get('lisTypeCour');
		if(isset($lisTypeCourv)){
			if($lisTypeCourv != null && $lisTypeCourv != '' && $lisTypeCourv != '-1'){
				Session()->put('lisTypeCourSess', $lisTypeCourv);
			}
			if($lisTypeCourv == 'tr'){
				$query->whereIn('statut_cour',['tr','en']); //Traité ou envoyé
			}else{
				$query->whereNotIn('statut_cour',['tr','en']);
			}
		}else{
			if(session('lisTypeCourSess') == 'tr'){
				$query->whereIn('statut_cour',['tr','en']); //Traité ou envoyé
			}else{
				$query->whereNotIn('statut_cour',['tr','en']);
			}
		}
		$checkAction = $req->get('id_giwu');
		if(isset($checkAction)){
			//Recherche simple
			$recherche = $req->get('query');
			if(isset($recherche)){
				$query->where(function ($query) Use ($recherche){					
					$query->where('ref_cour','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('sujet_cour','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('commentaire_cour','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('piece_jointe_cour','like','%'.strtoupper(trim($recherche).'%'));
					//Recherche avancee sur expediteur
					$query->orWhereHas('expediteur', function ($q) use ($recherche) {
						$q->where('nom_expe', 'like', '%'.strtoupper(trim($recherche).'%'));
						$q->orwhere('type_expe', 'like', '%'.strtoupper(trim($recherche).'%'));
					});
					// Recherche avancee sur direction
					$query->orWhereHas('direction', function ($q) use ($recherche) {
						$q->where('code_direc', 'like', '%'.strtoupper(trim($recherche).'%'));
						$q->orwhere('lib_direc', 'like', '%'.strtoupper(trim($recherche).'%'));
					});
					// Recherche avancee sur users
					$query->orWhereHas('users_g', function ($q) use ($recherche) {
						$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
						$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
					});
				});
			}
			//Destinataire Principale
			// $direc_idr = $req->get('direc_id');
			// if(isset($direc_idr)){ $query->where('direc_id',$direc_idr); }
			
			//Date de création
			$dateDebut = DateTime::createFromFormat('Y-m-d H:i:s', GiwuService::ChangeFormatDateY_m_d($req->get('created_atdeb')).' 00:00:00');
			$dateFin = DateTime::createFromFormat('Y-m-d H:i:s', GiwuService::ChangeFormatDateY_m_d($req->get('created_atfin')).' 23:59:59');
			if(isset($dateDebut) && isset($dateFin)){ $query->where('date_rece','>=',$dateDebut)->where('date_rece','<=',$dateFin); }
			
		}else{
			//Date de création date par defaut 
			$dateDebut = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-01').' 00:00:00');
			$dateFin = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d').' 23:59:59');
			if(isset($dateDebut) && isset($dateFin)){ $query->where('date_rece','>=',$dateDebut)->where('date_rece','<=',$dateFin); }
		}
		//Afficher les courriers concernée : Courrier non traité
		$user = User::find(Auth::id());
		$courrier = TranfertCourierEntrant::where('type_destina',$user->type_fonct)
											->where('id_desti',$user->id_fonct)
											->whereIn('etat_trce',['ec','tr']) //Courrier en cours
											->select('courier_id')->distinct()->get()->toArray();
		$query->whereIn('id_cour',$courrier);
		return $query;
	}

		
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function listcourrieratraiterCons(Request $req) {

		$array = GiwuService::Path_Image_menu("/cour/listcourrieratraiter");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = self::getListCourrier($req)->paginate(20);
		$giwu['nbreCourrier'] = self::getListCourrier($req)->count();
		$giwu['listdirec_id'] = Direction::sltListDirection();

		if($req->ajax()) {
			return view('cons.listcourrieratraiter.index-search')->with($giwu);
		}
		return view('cons.listcourrieratraiter.index')->with($giwu);
	}

	public function exporterExcel(Request $req) {
		$Resultat = self::getListCourrier($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['ref_cour'] = $giw->ref_cour;
				$tablgiwu[$i]['code_cour'] = $giw->code_cour;
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
		Session()->put('xlslistcourrieratraiter', $Resultat);
		return Excel::download(new listcourrieratraiterConsExportExcel, 'listcourrieratraiterExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = self::getListCourrier($req)->get();
		$pdf = PDF::loadView('cons.listcourrieratraiter.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('listcourrieratraiter-'.date('Ymdhis').'.pdf');
	}

	


}

