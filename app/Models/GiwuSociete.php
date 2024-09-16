<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GiwuSociete extends Model {

	protected $table = 'csm_societe';
	protected $primaryKey = 'id_societe';
	protected $guarded = array('*');
	public $timestamps = true;


	public static function logoSoc()
    {
        $soc = GiwuSociete::where('id_societe',1)->first();
        return $soc->logo_soc;
    }
}
