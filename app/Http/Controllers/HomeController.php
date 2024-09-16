<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\GiwuService;
use Auth;
use App\Models\GiwuSociete;
use App\Models\Courrier;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if(session('InfosRole')->id_role == 6){
		// 	return redirect()->route('materiel.index');
		// }
        
        $giwu['pathMenu'] = GiwuService::PathMenu('/');
        //Espace admin
        $giwu['image'] = GiwuService::PhotoProfilUtilisateur();

        $giwu['courrierNonTraiteCount'] = Courrier::CourrierNonTraite()->count();
        $giwu['courrierNonTraiteData'] = Courrier::CourrierNonTraite();
        $giwu['courrierNonTranmis'] = Courrier::CourrierNoSend()->count();
        $giwu['CourrierTotalRecu'] = Courrier::CourrierTotalRecu()->count();
        return view('home')->with($giwu);
    }


}
