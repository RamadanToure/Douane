<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GiwuActionacces;

class GiwuRoleAcces extends Model
{
    protected $table = 'csm_role_acces';
    protected $primaryKey = 'id_roleacces';
    protected $guarded = array('*');
    public $timestamps = true;

    
    public static function getCheckRoleAcces($id_role,$id_menu){
        
        return self::where('role_id',$id_role)
                            ->where('id_menu',$id_menu)
                            ->where('statut_role','1')
                            ->count();  
    }
    
    public static function getlistAction($id_menu){
        
        return GiwuActionacces::where('id_menu',$id_menu)->get();  
    }

    public static function getMenuParRole($id_role){
		
		return self::where('role_id',$id_role)
                    ->where('statut_role','1')
                    ->pluck('id_menu')->toArray();  
	}
	
}
