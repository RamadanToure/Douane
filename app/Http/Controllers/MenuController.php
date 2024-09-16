<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\GiwuSaveTrace;
use App\Models\GiwuActionacces;
use App\Providers\GiwuService;
use App\Models\User;
use App\Models\GiwuActionmenuacces;
use App\Models\GiwuRole;
use App\Models\GiwuRoleAcces;
use App\Models\GiwuMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Exports\MenuExportExcel;
use Ramsey\Uuid\Uuid;
use Validator;
use Auth,Hash,PDF;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        //
        $array = GiwuService::Path_Image_menu("/admin/menu");
        if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
        $giwu['list'] = GiwuMenu::getListMenuSearch($req)->paginate(20);
        if($req->ajax()) {
            return view('menu.index-search')->with($giwu);
		}
        return view('menu.index')->with($giwu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $array = GiwuService::Path_Image_menu("/admin/menu/create");
        if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
        $giwu['SltEmpMenu'] = GiwuMenu::getSltEmpMenu();
        return view('menu.create')->with($giwu);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $datas = $request->all();
            unset($datas['_token']);
            $datas['user_id']=Auth::id();
            $new = GiwuMenu::create($datas);

            //Affecter à l'admin inputer 
            $RoleAcces = new GiwuRoleAcces();
            $RoleAcces->role_id = 1; //
            $RoleAcces->id_menu = $new->id_menu;
            $RoleAcces->statut_role = 1;
            $RoleAcces->save(); 

            GiwuSaveTrace::enregistre('Ajout du nouveau menu : '.GiwuService::DetailInfosInitial($new->toArray()));
            return Redirect::back()->with('success',trans('data.infos_add'));
        } catch (\Illuminate\Database\QueryException $e) {
            // dd($e->getMessage());
            return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $array = GiwuService::Path_Image_menu("/admin/menu/edit");
        if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
        $giwu['SltEmpMenu'] = GiwuMenu::getSltEmpMenu();
        $giwu['menu'] = GiwuMenu::whereId_menu($id)->first();
        return view('menu.edit')->with($giwu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $dataInitiale = GiwuMenu::whereId_menu($id)->first()->toArray();
            $menu=GiwuMenu::whereId_menu($id)->first();
            $datas = $request->all();
            unset($datas['_token']);
            $updated=$menu->update($datas);
            GiwuSaveTrace::enregistre("Modification du menu : ".GiwuService::DiffDetailModifier($dataInitiale,$menu->toArray()));
            return redirect()->route('menu.index')->with('success',trans('data.infos_update'));
        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AffichePopDelete($id)  {

        $giwu['item'] = GiwuMenu::whereId_menu($id)->first();
		return view('menu.delete')->with($giwu);
    }

    public static function AffichePopAction($id)
    {
        $giwu['item'] = GiwuMenu::find($id);
        $giwu['listAction'] = GiwuActionacces::whereId_menu($id)->get();
		return view('menu.action')->with($giwu);
    }

	public function AjouterGiwuAction(Request $request){

        $validator = Validator::make($request->all(), [
			'libelle_action' => 'required',
			'dev_action' => 'required',
		]);
		if($validator->fails()){
			return response()->json(['response' => $validator->errors()]);
		}else{
            $gwEmp = new GiwuActionacces();
			$gwEmp->id_menu = $request->get('id_menu');
			$gwEmp->libelle_action = $request->get('libelle_action');
			$gwEmp->dev_action = $request->get('dev_action');
			$gwEmp->save();
			///Charger tous les rôles
			$giwuAllRole = GiwuRole::all();
			foreach ($giwuAllRole as $KeyRole) {
				$ActionAcces = new GiwuActionmenuacces();
				$ActionAcces->role_id = $KeyRole->id_role;
				$ActionAcces->action_id = $gwEmp->id_action;
				$ActionAcces->id_menu = $gwEmp->id_menu;
				if($KeyRole->id_role == 1){
					$ActionAcces->statut_action = 1;
				}else{
					$ActionAcces->statut_action = 0;
				}
				$ActionAcces->save();
            }
            return response()->json(['response' => 1]);
        }
	}

	public function DeleteGiwuAction(Request $request){

		$id = $request->input('id_action');
		$dataInitiale = GiwuActionacces::where('id_action', $id)->first()->toArray();
		GiwuActionmenuacces::where('action_id', $id)->delete();
		$affectedRows = GiwuActionacces::where('id_action', $id)->delete(); 
		if ($affectedRows){
			$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
			GiwuSaveTrace::enregistre("Suppression d'une action :" .$dataSupp);
			return response()->json(['response' => 1]);
		} else {
			return response()->json(['response' => 0]);
		}
	}

    public function destroy($id){
        try {
            $dataInitiale = GiwuMenu::find($id)->toArray();
            //Delete les fils
            $giwActAcc = GiwuActionmenuacces::where('id_menu',$id)->delete();
            $giwAct = GiwuActionacces::where('id_menu',$id)->delete();
            $giwRole = GiwuRoleAcces::where('id_menu',$id)->delete();
            //Delete fils
            $affectedRows = GiwuMenu::find($id)->delete();
            if ($affectedRows) {
                $dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
                GiwuSaveTrace::enregistre("Suppression du menu : ".$dataSupp);
                return redirect()->route('menu.index')->with('success',trans('data.infos_delete'));
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
        }
    }

}
