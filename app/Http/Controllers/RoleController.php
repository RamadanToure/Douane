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
use App\Models\GiwuMenu;
use App\Models\GiwuRoleAcces;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Exports\MenuExportExcel;
use Ramsey\Uuid\Uuid;
use Validator;
use Auth,Hash,PDF;

class RoleController extends Controller
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
        $array = GiwuService::Path_Image_menu("/admin/role");
        if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
        $giwu['list'] = GiwuRole::getListeRole($req)->paginate(20);
        if($req->ajax()) {
            return view('role.index-search')->with($giwu);
		}
        return view('role.index')->with($giwu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $array = GiwuService::Path_Image_menu("/admin/role/create");
        foreach($array as $name => $data){$giwu[$name] = $data;}
        // if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
        $giwu['listMenu'] = GiwuMenu::where('id_menu','<>',3)->get();
        return view('role.create')->with($giwu);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        try {
            $datas = $request->all();
            $gwEmp = new GiwuRole();
			$gwEmp->libelle_role = $request->get('libelle_role');
			$gwEmp->user_save_id = Auth::id();
			$gwEmp->save();

			///Charger tous les menus et affecte les valeurs choisie
			$giwuAllMenu = GiwuMenu::all();
			$stat = 0;
			foreach ($giwuAllMenu as $KeyMenu) {
				$stat = 0;
				foreach ($request->all() as $key => $value) {
					if(substr($key,0,6) == "cocher" && $value == $KeyMenu->id_menu){
						$stat = 1;
					}
				}
				$RoleAcces = new GiwuRoleAcces();
				$RoleAcces->role_id = $gwEmp->id_role;
				$RoleAcces->id_menu = $KeyMenu->id_menu;
				$RoleAcces->statut_role = $stat;
				$RoleAcces->save(); 
			}

			///Charger tous les actions et affecte les valeurs choisies
			$giwuAllAction = GiwuActionacces::all();
			$stat = 0;
			foreach ($giwuAllAction as $KeyAction) {
				$stat = 0;
				foreach ($request->all() as $key => $value) {
					if(substr($key,0,6) == "action" && $value == $KeyAction->id_action){
						$stat = 1;
					}
				}
				$addActMenu = new GiwuActionmenuacces();
				$addActMenu->statut_action = $stat;
				$addActMenu->action_id = $KeyAction->id_action;
				$addActMenu->id_menu = $KeyAction->id_menu;
				$addActMenu->role_id = $gwEmp->id_role;
				$addActMenu->save();
			}
            GiwuSaveTrace::enregistre('Ajout du role : '.GiwuService::DetailInfosInitial($gwEmp->toArray()));
            return Redirect::back()->with('success',trans('data.infos_add'));

        } catch (\Illuminate\Database\QueryException $e) {
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
        //
        $array = GiwuService::Path_Image_menu("/admin/role/edit");
        if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}

        $giwu['OneAcces'] = GiwuRole::find($id);  
		$giwu['item'] = GiwuRole::find($id);
		$giwu['listMenu'] = GiwuMenu::where('id_menu','<>',3)->get();
        return view('role.edit')->with($giwu);
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
            $dataInitiale = GiwuRole::where('id_role', $id)->first()->toArray();
			GiwuRole::where('id_role',$id)->update([ 
					'libelle_role' => $request->get('libelle_role'),
			]);
			//Charger tous les menus et affecte les valeurs choisies
			$giwuAllMenu = GiwuMenu::all();
			$stat = 0;
			foreach ($giwuAllMenu as $KeyMenu) {
				$stat = 0;
				foreach ($request->all() as $key => $value) {
					if(substr($key,0,6) == "cocher" && $value == $KeyMenu->id_menu){
						$stat = 1;
					}
				}
                $checkRole = GiwuRoleAcces::where('role_id',$id)->where('id_menu',$KeyMenu->id_menu)->first();
                if(!isset($checkRole)){
                    $RoleAcces = new GiwuRoleAcces();
                    $RoleAcces->role_id = $dataInitiale['id_role'];
                    $RoleAcces->id_menu = $KeyMenu->id_menu;
                    $RoleAcces->statut_role = $stat;
                    $RoleAcces->save(); 
                }else{
                    $checkRole->statut_role = $stat;
                    $checkRole->save();
                }
			}
			//Charger tous les actions et affecte les valeurs choisies
			$giwuAllAction = GiwuActionacces::all();
			$stat = 0;
			foreach ($giwuAllAction as $KeyAction) {
				$stat = 0;
				foreach ($request->all() as $key => $value) {
					if(substr($key,0,6) == "action" && $value == $KeyAction->id_action){
                        $stat = 1;
                    }
				}
                $checkAct = GiwuActionmenuacces::where('role_id',$id)->where('id_menu',$KeyAction->id_menu)->where('action_id',$KeyAction->id_action)->first();
                if(!isset($checkAct)){
                    $addActMenu = new GiwuActionmenuacces();
                    $addActMenu->statut_action = $stat;
                    $addActMenu->action_id = $KeyAction->id_action;
                    $addActMenu->id_menu = $KeyAction->id_menu;
                    $addActMenu->role_id = $dataInitiale['id_role'];
                    $addActMenu->save();
                }else{
                    $checkAct->statut_action = $stat;
                    $checkAct->save();
                }
			}
			GiwuSaveTrace::enregistre('Modification du rôle : '.GiwuService::DiffDetailModifier($dataInitiale,$request->toArray()));
            return redirect()->route('role.index')->with('success',trans('data.infos_update'));
        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
        }
    }
    public function AffichePopDelete($id)
    {
        $giwu['item'] = GiwuRole::whereId_role($id)->first();
		return view('role.delete')->with($giwu);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $dataInitiale = GiwuRole::where('id_role', $id)->first()->toArray();
            GiwuRoleAcces::where('role_id', $id)->delete(); 
            GiwuActionmenuacces::where('role_id', $id)->delete(); 
            $affectedRows = GiwuRole::where('id_role', $id)->delete(); 
            if ($affectedRows) {
                $dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
                GiwuSaveTrace::enregistre("Suppression de rôle :" .$dataSupp);
                return redirect()->route('role.index')->with('success',trans('data.infos_delete'));
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
        }
    }
}
