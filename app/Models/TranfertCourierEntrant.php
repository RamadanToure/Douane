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

class TranfertCourierEntrant extends Model {

	protected $table = 'csm_transfert_courrierentrant';
	protected $primaryKey = 'id_trce';
	protected $guarded = array('*');
	public $timestamps = true;


	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}
	
	public function courrier(){return $this->belongsTo('App\Models\Courrier','courier_id','id_cour');}
	
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

