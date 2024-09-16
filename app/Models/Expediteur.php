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

class Expediteur extends Model {

	protected $table = 'csm_expediteur';
	protected $primaryKey = 'id_expe';
	protected $guarded = array('*');
	public $timestamps = true;


	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListExpediteur(Request $req){

		$query = Expediteur::with(['users_g'])->orderBy('created_at','desc');

		$type_expev = $req->get('type_expe');
		if(isset($type_expev)){
			if($type_expev != null && $type_expev != '' && $type_expev != '-1'){
				Session()->put('type_expeSess', $type_expev);
			}
			$query->where('type_expe',$req->get('type_expe'));
		}else{
			$query->where('type_expe',session('type_expeSess'));
		}

		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) Use ($recherche){
				$query->where('nom_expe','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('adres_expe','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('email_expe','like','%'.strtoupper(trim($recherche).'%'));
			});
			//Recherche avancee sur users
			$query->orWhereHas('users_g', function ($q) use ($recherche) {
				$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
			});

		}
		return $query;
	}

	public static function sltListExpediteur(){
		$query = self::all()->pluck('nom_expe','id_expe');
		return $query;
	}

}

