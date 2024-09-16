<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class Service extends Model {

	protected $table = 'csm_service';
	protected $primaryKey = 'id_serv';
	protected $guarded = array('*');
	public $timestamps = true;


	public function direction(){return $this->belongsTo('App\Models\Direction','id_direc','id_direc');}

	public function responsable(){return $this->belongsTo('App\Models\User','respo_id','id');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListService(Request $req){

		$query = Service::with(['direction','users_g','users_g'])->orderBy('created_at','desc');

		$id_direcv = $req->get('id_direc');
		if(isset($id_direcv)){
			if($id_direcv != null && $id_direcv != '' && $id_direcv != '-1'){
				Session()->put('id_direcSess', intval($id_direcv));
			}
			$query->where('id_direc',$req->get('id_direc'));
		}else{
			$query->where('id_direc',session('id_direcSess'));
		}

		// $respo_idv = $req->get('respo_id');
		// if(isset($respo_idv)){
		// 	if($respo_idv != null && $respo_idv != '' && $respo_idv != '-1'){
		// 		Session()->put('respo_idSess', intval($respo_idv));
		// 	}
		// 	$query->where('respo_id',$req->get('respo_id'));
		// }else{
		// 	$query->where('respo_id',session('respo_idSess'));
		// }

		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) Use ($recherche){
				$query->where('code_serv','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('lib_serv','like','%'.strtoupper(trim($recherche).'%'));
				//Recherche avancee sur direction
				$query->orWhereHas('direction', function ($q) use ($recherche) {
					$q->where('code_direc', 'like', '%'.strtoupper(trim($recherche).'%'));
					$q->orwhere('lib_direc', 'like', '%'.strtoupper(trim($recherche).'%'));
				});
	
				//Recherche avancee sur users
				$query->orWhereHas('responsable', function ($q) use ($recherche) {
					$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
					$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
				});
			});
		}
		return $query;
	}

	public static function sltListService(){
		$query = self::all()->pluck('lib_serv','id_serv');
		return $query;
	}

}

