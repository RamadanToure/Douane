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
use App\Models\User;
use App\Models\GiwuSaveTrace;
use App\Providers\GiwuService;
use Auth,DateTime,DB;
use App\Models\Service;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Consult\listretraiteConsExportExcel;
use PDF;


class ConslistretraiteController extends Controller {

	public static function getListUsersCsm(Request $req){

		$query = User::orderBy('created_at','desc');
		
		$checkAction = $req->get('id_giwu');
		if(isset($checkAction)){
			//recherche simple
			$recherche = $req->get('query');
			if(isset($recherche)){
				$query->where(function ($query) Use ($recherche){
					$query->where('matricule','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('name','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('prenom','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('email','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('grade','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('echellon','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('other_infos_user','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('tel_user','like','%'.strtoupper(trim($recherche).'%'));
					
					//Recherche avancee sur service
					// $query->orWhereHas('service', function ($q) use ($recherche) {
					// 	$q->where('code_serv', 'like', '%'.strtoupper(trim($recherche).'%'));
					// 	$q->orwhere('lib_serv', 'like', '%'.strtoupper(trim($recherche).'%'));
					// });
				});
			}
			//Date embauche
			$dateDebut = DateTime::createFromFormat('Y-m-d H:i:s', GiwuService::ChangeFormatDateY_m_d($req->get('date_embauchedeb')).' 00:00:00');
			$dateFin = DateTime::createFromFormat('Y-m-d H:i:s', GiwuService::ChangeFormatDateY_m_d($req->get('date_embauchefin')).' 23:59:59');
			if(isset($dateDebut) && isset($dateFin)){ $query->where('date_retraite','>=',$dateDebut)->where('date_retraite','<=',$dateFin); }
			//Role
			// $id_roler = $req->get('id_role');
			// if(isset($id_roler)){ $query->where('id_role',$id_roler); }
		}else{
			//Date embauche date par defaut 
			$dateDebut = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d').' 00:00:00');
			$dateFin = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d').' 23:59:59');
			if(isset($dateDebut) && isset($dateFin)){ $query->where('date_retraite','>=',$dateDebut)->where('date_retraite','<=',$dateFin); }
		}
		return $query;
	}
		
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function listretraiteCons(Request $req) {

		$array = GiwuService::Path_Image_menu("/retraite/listretraite");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = self::getListUsersCsm($req)->paginate(20);
		$giwu['listid_role'] = Service::sltListService();
		// Graphe 
		$giwu['datas'] = DB::select("SELECT DISTINCT YEAR(u.date_retraite) AS annee, count(u.id) total
									FROM csm_users u
									GROUP BY annee;");

		if($req->ajax()) {
			return view('cons.listretraite.index-search')->with($giwu);
		}
		return view('cons.listretraite.index')->with($giwu);
	}

	public function exporterExcel(Request $req) {
		$Resultat = self::getListUsersCsm($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['matricule'] = $giw->matricule;
				$tablgiwu[$i]['name'] = $giw->name;
				$tablgiwu[$i]['prenom'] = $giw->prenom;
				$tablgiwu[$i]['email'] = $giw->email;
				$tablgiwu[$i]['grade'] = $giw->grade;
				$tablgiwu[$i]['echellon'] = $giw->echellon;
				$tablgiwu[$i]['date_embauche'] = date('d/m/Y',strtotime($giw->date_embauche));
				$tablgiwu[$i]['date_nais'] = date('d/m/Y',strtotime($giw->date_nais));
				// $tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				// $tablgiwu[$i]['service'] = isset($giw->service) ? $giw->service->code_serv : trans('data.not_found');
				$tablgiwu[$i]['other_infos_user'] = $giw->other_infos_user;
				$tablgiwu[$i]['tel_user'] = $giw->tel_user;
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlslistretraite', $Resultat);
		return Excel::download(new listretraiteConsExportExcel, 'listretraiteExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = self::getListUsersCsm($req)->get();
		$pdf = PDF::loadView('cons.listretraite.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('listretraite-'.date('Ymdhis').'.pdf');
	}

	


}

