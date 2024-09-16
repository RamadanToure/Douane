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

class Archive extends Model {

	protected $table = 'csm_archive';
	protected $primaryKey = 'id_archive';
	protected $guarded = array('*');
	public $timestamps = true;


	public function direction(){return $this->belongsTo('App\Models\Direction','direc_id','id_direc');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListArchive(Request $req){

		$query = Archive::with(['direction','users_g'])->orderBy('created_at','desc');

		$direc_idv = $req->get('direc_id');
		if(isset($direc_idv)){
			if($direc_idv != null && $direc_idv != '' && $direc_idv != '-1'){
				Session()->put('direc_idSess', intval($direc_idv));
			}
			$query->where('direc_id',$req->get('direc_id'));
		}else{
			$query->where('direc_id',session('direc_idSess'));
		}
		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) Use ($recherche){					
				$query->where('ref_doc','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('sujet_doc','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('fichier_doc','like','%'.strtoupper(trim($recherche).'%'));
				//Recherche avancee sur direction
				$query->orWhereHas('direction', function ($q) use ($recherche) {
					$q->where('code_direc', 'like', '%'.strtoupper(trim($recherche).'%'));
					$q->orwhere('lib_direc', 'like', '%'.strtoupper(trim($recherche).'%'));
				});
				//Recherche avancee sur users
				$query->orWhereHas('users_g', function ($q) use ($recherche) {
					$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
					$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
				});
			});
		}
		return $query;
	}

	public static function sltListArchive(){
		$query = self::all()->pluck('ref_doc','id_archive');
		return $query;
	}

}

