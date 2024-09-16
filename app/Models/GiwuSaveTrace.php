<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Providers\GiwuService;
use DB,Auth;
use DateTime;

class GiwuSaveTrace extends Model
{
    protected $table = 'csm_save_trace';
    protected $primaryKey = 'id_trace';
    protected $guarded = array('*');
    public $timestamps = true;

    
    public function users_g(){
        return $this->belongsTo('App\Models\User','id_user','id');
    }

    public static function enregistre($descr){
        if(session('InfosRole')->id_role <> 1){
            $save = new GiwuSaveTrace();
            $save->libelle_trace = $descr;
            $save->naviguateur = " ";
            $save->id_user = Auth::id();
            $save->save();
        }
    }

    public static function getListeUSerSaveTrace(){
        return self::join('csm_users','csm_users.id','csm_save_trace.id_user')
                            ->select(DB::raw("CONCAT(name,' ',prenom) AS nomprenom"),'csm_users.id')
                            // ->whereNotIn('csm_users.id',[1])
                            ->distinct()->get()->pluck('nomprenom','id');
    }

	public static function getListTraceSearch(Request $req){
        //Requetes par defaut   
        $query = GiwuSaveTrace::with(['users_g'])->orderby('created_at','desc');
        $checkAction = $req->get('id_giwu');
        if(isset($checkAction)){
            //Utilisateurs
            $query->where('id_user',$req->get('id_user'));
            //recherche simple
            $recherche = $req->get('query');
            if(isset($recherche)){
                $query->where('libelle_trace','like','%'.strtoupper(trim($recherche).'%'));
            }
            //date 
            $dateDebut = DateTime::createFromFormat('Y-m-d H:i:s', GiwuService::ChangeFormatDateY_m_d($req->get('datedebut')).' 00:00:00');
            $dateFin = DateTime::createFromFormat('Y-m-d H:i:s', GiwuService::ChangeFormatDateY_m_d($req->get('datefin')).' 23:59:59');
            if(isset($dateDebut) && isset($dateFin)){
                $query->where('created_at','>=',$dateDebut)->where('created_at','<=',$dateFin);
            }
        }else{
            //date par defaut
            $dateDebut = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d').' 00:00:00');
            $dateFin = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d').' 23:59:59');
            if(isset($dateDebut) && isset($dateFin)){
                $query->where('created_at','>=',$dateDebut)->where('created_at','<=',$dateFin);
            }
        }
        return $query;
    }

}
