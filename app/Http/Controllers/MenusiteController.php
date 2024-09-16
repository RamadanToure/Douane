<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by CMS-LARAVEL
	*/
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\GiwuSaveTrace;
use App\Providers\GiwuService;
use Auth;
use App\Models\Menusite;
use App\Models\User;
use Validator;

class MenusiteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		//Changer du contenu si base de donnée vide 
		$array = GiwuService::Path_Image_menu("/param/menusite");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Menusite::getListMenuSite($req)->paginate(20);
		$giwu['listinit_id'] = User::sltListUser();
		if($req->ajax()) {
			return view('menusite.index-search')->with($giwu);
		}
		return view('menusite.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//Pop Up pour la suppression d'une ligne 
	}

	//Methode pop up de validation 
	public function show_Validation($type,$id) {
		$giwu['type'] = $type;
		$giwu['item'] = Menusite::where('id_menusite',$id)->first();
		return view('menusite.transmettre')->with($giwu);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
		$array = GiwuService::Path_Image_menu("/param/menusite/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['item'] = Menusite::where('id_menusite',$id)->first();
		return view('menusite.edit')->with($giwu);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
		try {
			$validator = Validator::make($request->all(), [
				'titre_menu' => 'required',
			]);

			if($validator->fails()){
				return response()->json(['response' => $validator->errors()]);
			}else{
				$dataInitiale = Menusite::where('id_menusite',$id)->first()->toArray();
				$datas = $request->all();
				unset($datas['_token']);

				$newUpd=Menusite::where('id_menusite',$id)->first();

				$newUpd->titre_menu = $datas['titre_menu'];
				$newUpd->contenu_menu = $datas['contenu_menu'];
				$newUpd->save();

				GiwuSaveTrace::enregistre("Modification menusite : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
				return response()->json(['response' => 1]);
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return response()->json(['response' => 0,'message' => $e->getMessage()]);

		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}

	//M�thode de transmission : Change Etat
	public function Validation($type,$id) {
		try {
			$info = ''; $gSave = '';
			$dataInitiale = Menusite::find($id)->toArray();
			$affectedRows = Menusite::find($id);
			if ($affectedRows) {
				if($type == 'trans'){
					$info = trans('data.infos_trans');
					$affectedRows->etat_menu = 't';
					$gSave = 'Transmission';
				}else if($type == 'go'){
					$info = trans('data.infos_go');
					$affectedRows->etat_menu = 'p';
					$gSave = 'Publication';
				}else if($type == 'stop'){
					$info = trans('data.infos_stop');
					$affectedRows->etat_menu = 't';
					$gSave = 'Arr�t de publication';
				}
				$affectedRows->save();
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre($gSave.' menusite : '.$dataSupp);
				return redirect()->route('menusite.index')->with('success',$info);
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with('errorMsg',$e->getMessage());
		}
	}

	


}

