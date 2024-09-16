<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TranfertCourierEntrant;
use Auth;

class Courrier extends Model {

	protected $table = 'csm_courrier';
	protected $primaryKey = 'id_cour';
	protected $guarded = array('*');
	public $timestamps = true;

	public function expediteur(){return $this->belongsTo('App\Models\Expediteur','expe_id','id_expe');}

	public function direction(){return $this->belongsTo('App\Models\Direction','direc_id','id_direc');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListCourrier(Request $req){

		$query = Courrier::with(['expediteur','direction','users_g'])
							->where('statut_cour','ec') //Courrier encours
							->where('init_id',Auth::id())
							->orderBy('date_rece','desc');

		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) Use ($recherche){
				$query->where('ref_cour','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('sujet_cour','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('commentaire_cour','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('piece_jointe_cour','like','%'.strtoupper(trim($recherche).'%'));
			});
			//Recherche avancee sur expediteur
			$query->orWhereHas('expediteur', function ($q) use ($recherche) {
				$q->where('nom_expe', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('type_expe', 'like', '%'.strtoupper(trim($recherche).'%'));
			});
			//Recherche avancee sur direction
			$query->orWhereHas('direction', function ($q) use ($recherche) {
				$q->where('code_direc', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('lib_direc', 'like', '%'.strtoupper(trim($recherche).'%'));
			});
			// //Recherche avancee sur users
			// $query->orWhereHas('users_g', function ($q) use ($recherche) {
			// 	$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
			// 	$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
			// });
		}
		return $query;
	}

	public function ChangerStatutCourrier($statut) {
		$this->attributes['statut_cour'] = $statut;
		$this->save();
	}
	
	public static function sltListCourrier(){
		$query = self::all()->pluck('sujet_cour','id_cour');
		return $query;
	}
	
	public static function CourrierNoSend(){
		$user = User::find(Auth::id());
		$query = self::where('statut_cour','-1');
		if($user->type_fonct == 'dr'){
			$query = self::where('statut_cour','tr')
							->where('direc_id',$user->id_fonct)
							->get();
		}
		return $query;
	}
	
	public static function CourrierNonTraite(){
		$user = User::find(Auth::id());
		$courrier = TranfertCourierEntrant::where('type_destina',$user->type_fonct)
											->where('id_desti',$user->id_fonct)
											->whereNotIn('etat_trce',['tr','en']) //Courrier en cours
											->select('courier_id')->distinct()->get()->toArray();
		
		return Courrier::with(['expediteur','direction'])
						->whereIn('id_cour',$courrier)
						->orderBy('created_at','asc')
						->get();
	}
	
	public static function CourrierTotalRecu(){
		$user = User::find(Auth::id());
		$courrier = TranfertCourierEntrant::where('type_destina',$user->type_fonct)
											->where('id_desti',$user->id_fonct)
											->whereNotIn('etat_trce',['tr','en']) //Courrier en cours
											->select('courier_id')->distinct()->get()->toArray();
		
		return Courrier::with(['expediteur','direction'])
						->whereIn('id_cour',$courrier)
						->orderBy('created_at','asc')
						->get();
	}
	
	
}