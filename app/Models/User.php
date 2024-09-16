<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use App\Models\Direction;
use App\Models\Service;
use App\Models\Division;
use DB,Auth;
use Carbon\Carbon;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'csm_users';
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Models\GiwuRole','id_role','id_role');
    }

	// public function getDateretraiteAttribute() {
    //     return $this->attributes['date_embauche'];
    // }
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
    
	public static function getListeUsers(Request $req){

		$query = self::with(['role'])->orderBy('name','asc')
                                    ->orderBy('prenom','asc');

        $query->WhereHas('role', function ($q) { $q->where('id_role', '<>', '1');});

        // $entite_idv = $req->get('entite_id');
		// if(isset($entite_idv)){
		// 	if($entite_idv != null && $entite_idv != '' && $entite_idv != '-1'){
		// 		Session()->put('entite_idSess', intval($entite_idv));
		// 	}
		// 	$query->where('entite_id',$req->get('entite_id'));
		// }else{
		// 	$query->where('entite_id',session('entite_idSess'));
		// }

		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) use ($recherche){
				$query->orwhere('name','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('prenom','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('email','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('tel_user','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('other_infos_user','like','%'.strtoupper(trim($recherche).'%'));
			});
		}
		return $query;
	}
	public static function sltListUser(){
		// $query = self::all()->pluck('name','id');
        $query =  self::select(DB::raw("CONCAT(name,' ',prenom) AS nomprenom"),'csm_users.id')
                            ->whereNotIn('csm_users.id',[1])
                            ->distinct()
                            ->orderBy('nomprenom','asc')
                            ->get()->pluck('nomprenom','id');
		return $query;
	}
    
    public static function EtatUser($id){
        if($id == "1"){
            return "Activé";
        }else{
            return "Désactivé";
        }
    }

}
