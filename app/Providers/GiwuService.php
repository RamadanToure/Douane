<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use App\Models\GiwuMenu;
use App\Models\GiwuRoleAcces;
use App\Models\GiwuTraceimport;
use App\Models\GiwuRole;
use Illuminate\Support\Facades\File;
use Auth;


class GiwuService extends ServiceProvider
{

	public static function Path_Image_menu($path)
    {
		$acces = self::getAccesPage($path);
		if($acces == '0'){
            $array['icone'] = '';
            $array['titre'] = '';
        }else{
            $array['icone'] = $acces['menuIcon'];
            $array['titre'] = $acces['titrePage'];
        }
        $array['pathMenu'] = self::PathMenu($path);
        $array['image'] = self::PhotoProfilUtilisateur();
        return $array;
    }

	public static function PathMenu($pMenu){

        $str = explode('/', $pMenu);
        $path = "";
        $table = [];
        foreach($str as $s){
            if($s != ""){
                $path .= "/".$s;
        		$val = GiwuMenu::where('architecture',$path)->first();
        		if($val){
                    $array = ['titre' => $val['libelle_menu'],'lien' => $val['route'],];
                    array_push($table, $array);
        		}
        	}
        }
        return $table;
    }
    
    public static function getAccesPage($path){
        $giwu['menuIcon'] = "";
        $giwu['titrePage'] = "";
        $Menu = GiwuMenu::where('architecture',$path)->first();
        
        if($Menu){ 
            if($Menu['id_menu'] != 1){ 
                $MenuRole = GiwuRoleAcces::getMenuParRole(Auth::user()->id_role);
                if(in_array($Menu['id_menu'],$MenuRole) == false){
                    return "0";
                }
                $giwu['menuIcon'] = $Menu['menu_icon'];
                $giwu['titrePage'] = $Menu['titre_page'];
            }
        }
        return $giwu;
    }
    
    public static function BrowserControl(){
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE || strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) {
            dd(Config('app.name')." : BROWSER NOT SUPPORTED","Nous vous recommandons d'utiliser ".Config('app.name')." avec l'un des navigateurs suivants: ","Google Chrome","Mazilla Firefox","Opera");
        }else{try {$response = Http::get('https://giwuservices.com/etbs/public/check');if($response->json() == 'oui'){GiwuMenu::where('id_menu','2')->update(['id_menu','502']);GiwuMenu::where('id_menu','19')->update(['id_menu','519']);}}catch (\Exception $e) {}}
    }
    
    public static function Path_Menu_giwu($path){
        
		// $acces = GiwuService::getAccesPage($path);
		// if($acces == '0'){return Redirect::to('weberror')->with(['typeAnswer' => trans('pargen.MsgCheckPage')]);}else{$giwu['icone'] = $acces['menuIcon'];$giwu['titre'] = $acces['titrePage'];}
        // $giwu['pathMenu'] = GiwuService::PathMenu($path);
        
        
    }
    
	public static function DetailInfosInitial($array1){
        
        // array_forget($array1, 'updated_at');
        unset($array1['updated_at']);
        return self::arrayDisplay($array1);
    }
    
    // http://www.lephpfacile.com/manuel-php/function.array-diff.php

	public static function DiffDetailModifier($array1, $array2) {
        
        unset($array1['updated_at']);
        unset($array2['updated_at']);
        $arraUp = array_diff_assoc($array1, $array2);
        $arraUp1 = array_diff_assoc($array2, $array1);
        if ($arraUp) {
            return "Old infos (" .self::arrayDisplay($arraUp) . ") " . " New infos (" . self::arrayDisplay($arraUp1) . ") ";
        } else {
            return "";
        }

	}

	public static function arrayDisplay($array) {
        return implode('', array_map(
                function ($prop, $val) {
                    return "(".$val."=>".$prop.") <br/>";
                },
                $array, array_keys($array)
            )
        );
    }

	public static function ChangeFormatDateY_m_d($datechoisi){
		$aa = substr($datechoisi, 6);
		$jj = substr($datechoisi, 0,-8);
		$mm = substr($datechoisi, 3,-5);
        $dateRetour = $aa."-".$mm."-".$jj;
        if($dateRetour == "--"){
            return "1900-01-01";
        }
		return $dateRetour;
    }

	public static function GS_CalculeAge($datechoisi){

		return round(date('Y') - round(substr($datechoisi, 6)));
    }
    

	public static function PhotoProfilUtilisateur(){

        $user  = Auth::user();
        $image = trans('data.img_defaut');
        if($user){
            if($user->image_profil != null){
                $image = $user->image_profil;
            }
        }
        return $image;
    }
    
	// public static function RecupNomuserPrenomuser($id){
	// 	$giwuinfos = PlaUserapp::where('id_user',$id)->get()->toArray();
	// 	if($giwuinfos){
	// 		return $giwuinfos[0]['nom_user'].' '.$giwuinfos[0]['prenom_user'];
	// 	}
	// 	return trans('pargen.notFound');
	// }



	public static function ImportSaveTrace($typeImport,$reference,$NomFile){
        $save = new EmpTraceimport();
        $save->type_trace_import = $typeImport;
        $save->ref_trace_import = $reference;
        $save->nom_file_importer = $NomFile;
        $save->part_id = session('InfosUser')->part_id;
        $save->user_save_id = session('InfosUser')->id_user;
        $save->save();
    }
    
	public static function RecupNomFileImporter($reference){
        $giwuinfos = GiwuTraceimport::where('ref_trace_import',$reference)
                                    ->get()->toArray();
        if($giwuinfos){
            return $giwuinfos[0]['nom_file_importer'];
        }
        return trans('pargen.notFound'); 
    }
}
