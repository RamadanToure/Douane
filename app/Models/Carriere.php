<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Direction;
use App\Models\Service;
use App\Models\Division;
use Auth;

class Carriere extends Model {

	protected $table = 'csm_carriere';
	protected $primaryKey = 'id_carr';
	protected $guarded = array('*');
	public $timestamps = true;


	public function occupant(){return $this->belongsTo('App\Models\User','id_occupant','id');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListCarriere(Request $req){

		$query = Carriere::with(['users_g','users_g'])->orderBy('created_at','desc');

		$recherche = $req->get('query');
		if(isset($recherche)){
				$query->where(function ($query) Use ($recherche){					$query->where('date_debut_carr','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('salaire_carr','like','%'.strtoupper(trim($recherche).'%'));
				});			//Recherche avancee sur users
			$query->orWhereHas('users_g', function ($q) use ($recherche) {
				$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
			});

			//Recherche avancee sur users
			$query->orWhereHas('users_g', function ($q) use ($recherche) {
				$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
			});

		}
		return $query;
	}

	public static function sltListCarriere(){
		$query = self::all()->pluck('type_fonct','id_carr');
		return $query;
	}
	
	public function fonction($type, $idFonc){
        if($type == 'dr'){
            $query = Direction::find($idFonc);
            if($query){return $query->lib_direc;}
        }else if($type == 'se'){
            $query = Service::find($idFonc);
            if($query){return $query->lib_serv;}
        }else if($type== 'di'){
            $query = Division::find($idFonc);
            if($query){return $query->lib_divi;}
        }else{
            return '';
        }
    }
}

