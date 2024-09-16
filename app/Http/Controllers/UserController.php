<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\GiwuSaveTrace;
use App\Providers\GiwuService;
use App\Models\User;
use App\Models\GiwuRole;
use App\Models\GiwuSociete;
use App\Models\Division;
use App\Models\Direction;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Exports\UserExportExcel;
use Ramsey\Uuid\Uuid;
use Auth, Hash, PDF;
use Carbon\Carbon;

class UserController extends Controller
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
        $array = GiwuService::Path_Image_menu("/admin/user");
        if ($array['titre'] == "") {
            return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);
        } else {
            foreach ($array as $name => $data) {
                $giwu[$name] = $data;
            }
        }
        $giwu['list'] = User::getListeUsers($req)->paginate(20);
        if ($req->ajax()) {
            return view('users.index-search')->with($giwu);
        }
        return view('users.index')->with($giwu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array = GiwuService::Path_Image_menu("/admin/user/create");
        if ($array['titre'] == "") {
            return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);
        } else {
            foreach ($array as $name => $data) {
                $giwu[$name] = $data;
            }
        }
        $giwu['sltRole'] = GiwuRole::sltListRole();
        return view('users.create')->with($giwu);
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
            $email = $datas['email'];
            if (User::where('email', $email)->exists()) {
                return Redirect::back()->withInput()->with('error', "Ce mail existe déjà.");
            }
            if (User::where('matricule', $datas['matricule'])->exists()) {
                return Redirect::back()->withInput()->with('error', "Ce matricule existe déjà.");
            }

            unset($datas['_token']);
            $datas['password'] = Hash::make('123');
            $datas['id_ini'] = Auth::id();
            $datas['code'] = Uuid::uuid4();
            $datas['type_fonct'] = $datas['type_destina'];
            $datas['id_fonct'] = $datas['id_desti'];
            $datas['image_profil'] = trans('data.img_defaut');

            $date = Carbon::parse($datas['date_embauche']);
            $datas['date_retraite'] = $date->addYears(GiwuSociete::where('id_societe', 1)->first()->anneretraite)->format('Y-m-d');

            unset($datas['id_desti']);
            unset($datas['type_destina']);

            $new = User::create($datas);
            GiwuSaveTrace::enregistre('Ajout du nouveau utilisateur : ' . GiwuService::DetailInfosInitial($new->toArray()));
            return Redirect::back()->with('success', trans('data.infos_add'));

        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withInput()->with('error', trans('data.infos_error'))->with("errorMsg", $e->getMessage());
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
    public function edit($code)
    {
        $array = GiwuService::Path_Image_menu("/admin/user");
        if ($array['titre'] == "") {
            return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);
        } else {
            foreach ($array as $name => $data) {
                $giwu[$name] = $data;
            }
        }
        $giwu['sltRole'] = GiwuRole::sltListRole();
        $giwu['user'] = User::whereCode($code)->first();

        if (!$giwu['user']) {
            return Redirect::to('weberror')->with(['typeAnswer' => 'Utilisateur non trouvé.']);
        }

        if ($giwu['user']->type_fonct == 'dr') {
            $giwu['destina'] = Direction::sltListDirection();
        } elseif ($giwu['user']->type_fonct == 'se') {
            $giwu['destina'] = Service::sltListService();
        } elseif ($giwu['user']->type_fonct == 'di') {
            $giwu['destina'] = Division::sltListDivision();
        }

        return view('users.edit')->with($giwu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        try {
            $dataInitiale = User::where('code', $code)->first()->toArray();
            $user = User::whereCode($code)->first();
            $datas = $request->all();
            $email = $datas['email'];

            $count = User::where('email', $email)->get();
            if ($count->count() != 0) {
                if ($count->first()->code != $code) {
                    return Redirect::back()->withInput()->with('error', "Ce mail existe déjà.");
                }
            }

            $count = User::where('matricule', $datas['matricule'])->get();
            if ($count->count() != 0) {
                if ($count->first()->code != $code) {
                    return Redirect::back()->withInput()->with('error', "Ce matricule existe déjà.");
                }
            }

            unset($datas['_token']);
            $date = Carbon::parse($datas['date_embauche']);
            $datas['date_retraite'] = $date->addYears(GiwuSociete::where('id_societe', 1)->first()->anneretraite)->format('Y-m-d');

            $datas['type_fonct'] = $datas['type_destina'];
            $datas['id_fonct'] = $datas['id_desti'];
            unset($datas['id_desti']);
            unset($datas['type_destina']);

            $updated = $user->update($datas);
            GiwuSaveTrace::enregistre("Modification de l'utilisateur : " . GiwuService::DiffDetailModifier($dataInitiale, $user->toArray()));
            return redirect()->route('users.index')->with('success', trans('data.infos_update'));

        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withInput()->with('error', trans('data.infos_error'))->with("errorMsg", $e->getMessage());
        }
    }

    public function AffichePopDelete($code)
    {
        $giwu['item'] = User::whereCode($code)->first();
        return view('users.delete')->with($giwu);
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
            $dataInitiale = User::find($id)->toArray();
            $affectedRows = User::find($id)->delete();
            if ($affectedRows) {
                $dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
                GiwuSaveTrace::enregistre("Suppression d'utilisateur : " . $dataSupp);
                return redirect()->route('users.index')->with('success', trans('data.infos_delete'));
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withInput()->with('error', trans('data.infos_error'))->with("errorMsg", $e->getMessage());
        }
    }

    public function exporterExcel(Request $request)
    {
        $Resultat = User::getListeUsers($request)->get();
        if ($Resultat->count() != 0) {
            $tablgiwu = $Resultat->map(function ($giw) {
                return [
                    'name' => $giw->name,
                    'prenom' => $giw->prenom,
                    'email' => $giw->email,
                    'tel_user' => $giw->tel_user,
                    'other_infos_user' => $giw->other_infos_user,
                    'id_role' => $giw->role->libelle_role,
                    'is_active' => User::EtatUser($giw->is_active),
                ];
            });
            Session()->put('xlsUser', new Collection($tablgiwu));
        }
        return Excel::download(new UserExportExcel, 'UserExportExcel_' . date('Y-m-d-H-i-s') . '.xls');
    }

    public static function exporterPdf(Request $request)
    {
        $Resultat = User::getListeUsers($request)->get();
        $pdf = PDF::loadView('users.pdf', ['list' => $Resultat])->setPaper('a4', 'landscape');
        return $pdf->stream('users-' . date('YmdHis') . '.pdf');
    }
}
