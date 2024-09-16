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

class Direction extends Model {

	protected $table = 'csm_direction';
	protected $primaryKey = 'id_direc';
	protected $guarded = array('*');
	public $timestamps = true;


	public function responsable(){return $this->belongsTo('App\Models\User','respo_id','id');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getList_Direction(Request $req){

		$query = Direction::with(['users_g','responsable'])->orderBy('created_at','desc');

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
				$query->where('code_direc','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('lib_direc','like','%'.strtoupper(trim($recherche).'%'));
			});
			//Recherche avancee sur users
			$query->orWhereHas('responsable', function ($q) use ($recherche) {
				$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
			});
		}
		return $query;
	}

	public static function sltListDirection(){
		$query = self::all()->pluck('lib_direc','id_direc');
		return $query;
	}

}

