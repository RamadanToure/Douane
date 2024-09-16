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

class Division extends Model {

	protected $table = 'csm_division';
	protected $primaryKey = 'id_divi';
	protected $guarded = array('*');
	public $timestamps = true;


	public function service(){return $this->belongsTo('App\Models\Service','id_serv','id_serv');}

	public function responsable(){return $this->belongsTo('App\Models\User','respo_id','id');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListDivision(Request $req){

		$query = Division::with(['service','users_g','users_g'])->orderBy('created_at','desc');

		$id_servv = $req->get('id_serv');
		if(isset($id_servv)){
			if($id_servv != null && $id_servv != '' && $id_servv != '-1'){
				Session()->put('id_servSess', intval($id_servv));
			}
			$query->where('id_serv',$req->get('id_serv'));
		}else{
			$query->where('id_serv',session('id_servSess'));
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
				$query->where('code_divi','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('lib_divi','like','%'.strtoupper(trim($recherche).'%'));
				//Recherche avancee sur service
				$query->orWhereHas('service', function ($q) use ($recherche) {
					$q->where('code_serv', 'like', '%'.strtoupper(trim($recherche).'%'));
					$q->orwhere('lib_serv', 'like', '%'.strtoupper(trim($recherche).'%'));
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

	public static function sltListDivision(){
		$query = self::all()->pluck('code_divi','id_divi');
		return $query;
	}

}

