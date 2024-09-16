<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
class GiwuRole extends Model {

	protected $table = 'csm_role';
	protected $primaryKey = 'id_role';
	protected $guarded = array('*');
	public $timestamps = true;


    public function users_g()
    {
        return $this->belongsTo('App\Models\User','user_save_id','id');
    }
    public function sousrole()
    {
        return $this->belongsTo('App\Models\GiwuRole','sous_role','id_role');
    }

	//Liste des roles....
	public static function getListeRole(Request $req){
		
		if(Auth::id() == 1){ //Only Myself
			$query = GiwuRole::with(['users_g'])->orderBy('created_at','asc');
		}else{
			$query = GiwuRole::with(['users_g'])->orderBy('created_at','asc')->whereNotIn('id_role',[1]);
		}
		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where('libelle_role','like','%'.strtoupper(trim($recherche).'%'));
		}
		return $query;
	}

	public static function sltListRole(){
		$query = GiwuRole::all()->whereNotIn('id_role',[1])
						->pluck('libelle_role','id_role');
		return $query;
	}


	public static function NameRole($id){
		$query = GiwuRole::find($id);
		if($query){
			return $query->libelle_role;
		}else{
			return "";
		}
	}


}
