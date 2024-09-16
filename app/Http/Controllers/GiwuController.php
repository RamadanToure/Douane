<?php

	/**
	* Giwu Service (E-mail: giwuservices@gmail.com)
	* Code Genere by GENERRATE-CMS
    */
    
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\GiwuMenu; 
use App\Models\GiwuRole; 
use App\Models\GiwuSociete; 
use App\Utilities\FileStorage;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;
use Illuminate\Support\Facades\Storage;
use App\Models\GiwuSaveTrace;
use Auth,Hash;
use App\Models\User;
use Carbon\Carbon;

use App\Providers\GiwuService;


class GiwuController extends Controller
{
    public static function weberror(){
        return view('errors.pageErrors');
    }
    
	public static function AfficherAideGiwu(){

		$array = GiwuService::Path_Image_menu("/aide/manuel");
        if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
        $giwu['societe'] = GiwuSociete::where('id_societe',1)->first();
		return view('layouts.containHelp')->with($giwu);
    }

    public function UpdatePageSoc(Request $request){
        
        $infoSoc = GiwuSociete::where('id_societe',1)->first();
        $filenameLogo = $infoSoc->logo_soc;
        $filenameAide = $infoSoc->pdf_aide;

        $fileLogo=$request->file('logo');    
        $fileAide=$request->file('customFile');    

        if($fileLogo != null){
            $RecnameFileLogo = $fileLogo->getClientOriginalName();
            if($infoSoc->logo_soc != $RecnameFileLogo){
                $filenameLogo= 'Logo-'.date('Y-m-d-his').'.jpeg';
                $uploadLogo="assets/docs/logos/";
                $success = $fileLogo->move($uploadLogo,$filenameLogo);
            }else{
                $filenameLogo = $RecnameFileLogo;
            }
        }
        if($fileAide != null){
            $RecnamefileAide = $fileAide->getClientOriginalName();
            $extension = strtolower($fileAide->getClientOriginalExtension());
            if($infoSoc->logo_soc != $RecnamefileAide){
                $filenameAide= 'Aide-'.date('Y-m-d-his').'.'.$extension;
                $uploadLogo="assets/docs/logos/";
                $success=$fileAide->move($uploadLogo,$filenameAide);
            }else{
                $filenameAide = $RecnamefileAide;
            }
        }

        $dataInitiale = GiwuSociete::where('id_societe', 1)->first()->toArray();
        GiwuSociete::where('id_societe',1)->update([ 
            'nom_soc' => $request->get('nom_soc'),
            'contact_soc' => $request->get('contact_soc'),
            'mail_soc' => $request->get('mail_soc'),
            'adres_soc' => $request->get('adres_soc'),
            'anneretraite' => $request->get('anneretraite'),
            'logo_soc' => $filenameLogo,
            'pdf_aide' => $filenameAide,
            'pied_page_soc' => $request->get('pied_soc'),
        ]);
        $dataFinale = GiwuSociete::where('id_societe', 1)->first()->toArray();
        GiwuSaveTrace::enregistre('Modification des infos sociétés : '.GiwuService::DiffDetailModifier($dataInitiale,$dataFinale));
        session()->flash('infos','Les informations ont été modifiées avec succès.');
        return Redirect::to('/mysociety');
    }

    public static function AfficherProfile(){

        $array = GiwuService::Path_Image_menu("/profil");
        if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}

        $giwu['image'] = GiwuService::PhotoProfilUtilisateur();
        return view('layouts.myprofile')->with($giwu);
    }

    public static function AfficherMySociete(){

        $array = GiwuService::Path_Image_menu("/admin/societe");
        if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
        
        $giwu['societe'] = GiwuSociete::where('id_societe',1)->first();
        $giwu['image'] = GiwuService::PhotoProfilUtilisateur();
        return view('layouts.MaSociete')->with($giwu);
    }    

    public function UpdatePageProfile(Request $request){
        
        $dataInitiale = User::find(Auth::id())->toArray();
        $user=User::find(Auth::id());
        $datas=$request->all();
        $file = $request->file('image_profil');
        if($file){
            !is_null($user->image_profil) && Filestorage::deleteFile('avatar',$user->image_profil,"");
            $filename=FileStorage::setFile('avatar',$request->file("image_profil"),"","");
            $pathName = "assets/images/user/";
            $file->move($pathName, $filename);
            $datas['image_profil']=$filename;
        }
        unset($datas['_token']);
        $date = Carbon::parse($datas['date_embauche']);
        $datas['date_retraite'] = $date->addYears(GiwuSociete::where('id_societe',1)->first()->anneretraite)->format('Y-m-d');
        $updated=$user->update($datas);
        $dataFinale = User::find(Auth::id())->toArray();
        GiwuSaveTrace::enregistre('Modification des infos de l\'utilisateur : '.GiwuService::DiffDetailModifier($dataInitiale,$dataFinale));
        session()->flash('infos','Les informations ont été modifiées avec succès.');
        return Redirect::to('/myprofile');
    }  

    public function UpdatePageMotDpas(Request $request){
        
        $user=User::find(Auth::id());
        if ($request->confirm != $request->new ) {
            return back()->with('error',"Mots de passe non identique");
        }elseif (!Hash::check($request->old,$user->password)) {
            return back()->with('error',"Ancien mot de passe incorrect");
        }else{
            $user->update(['password'=>Hash::make($request->new)]);
            return back()->with('success',"Mot de passe changé avec succès");
        }
        GiwuSaveTrace::enregistre('Changement du mot de passe de : '.Auth::user()->email);
        return Redirect::to('/myprofile');
    }  

    // public function UpdatePicture(Request $request){
        
    //     $file=$request->file('photo');
	// 	$upload="assets/media/users/";
    //     // $filename=$file->getClientOriginalName();
    //     $filename=session('InfosUser')->nom_user.'-'.session('InfosUser')->prenom_user.'-'.date('Y-m-d-his').'.jpeg';
    //     $success=$file->move($upload,$filename);
    //     PlaUserapp::where('id_user',session('InfosUser')->id_user)->update([ 
    //         'image_profil' => $filename,
    //     ]);
    //     session()->flash('infos','Votre avatar a été changé avec succès.');
    //     return Redirect::to('/myprofile');
    // }  

    // public static function dashboardHome(){
    //     $giwu['image'] = GiwuService::PhotoProfilUtilisateur();
    //     return view('dashbord.dashbordapp')->with($giwu);
    // } 
}
