<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\GiwuService;
use App\Models\GiwuSaveTrace;
use App\Exports\TraceExportExcel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class SaveTraceController extends Controller
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
        $array = GiwuService::Path_Image_menu("/admin/trace");
        if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
        $giwu['list'] = GiwuSaveTrace::getListTraceSearch($req)->paginate(20);
        $giwu['listUser'] = GiwuSaveTrace::getListeUSerSaveTrace();
        if($req->ajax()) {
            return view('trace.index-search')->with($giwu);
		}
        return view('trace.index')->with($giwu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
	public function exporterExcel(Request $request){
		$Resultat = GiwuSaveTrace::getListTraceSearch($request)->get();

		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['created_at'] = date('d/m/Y',strtotime($giw->created_at));
                $tablgiwu[$i]['id_user'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
                $tablgiwu[$i]['libelle_trace'] = $giw->libelle_trace;
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsTrace', $Resultat);
		return Excel::download(new TraceExportExcel, 'TraceExportExcel_'.date('Y-m-d-h-i-s').'.xls');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public static function exporterPdf(Request $request){

		$Resultat = GiwuSaveTrace::getListTraceSearch($request)->get();
        $pdf = PDF::loadView('trace.pdf',['list' => $Resultat])->setPaper('a4','landscape');
        return $pdf->stream('Trace-'.date('Ymdhis').'.pdf');
	}
}
