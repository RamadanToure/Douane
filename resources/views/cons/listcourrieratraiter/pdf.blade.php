<title>{{Config('app.name') }} | Courrier a traiter</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Courrier a traiter<br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<th class="th" >{!!trans('data.ref_cour')!!}</th>
			<th class="th" >{!!trans('data.code_cour')!!}</th>
			<th class="th" >{!!trans('data.date_rece')!!}</th>
			<th class="th" >{!!trans('data.date_limite')!!}</th>
			<th class="th" >{!!trans('data.expe_id')!!}</th>
			<th class="th" >{!!trans('data.sujet_cour')!!}</th>
			<th class="th" >{!!trans('data.type_cour')!!}</th>
			<th class="th" >{!!trans('data.statut_cour')!!}</th>
			<th class="th" >{!!trans('data.priorite_cour')!!}</th>
			<th class="th" >{!!trans('data.direc_id')!!}</th>
			<th class="th" >{!!trans('data.commentaire_cour')!!}</th>
			<th class="th" >{!!trans('data.piece_jointe_cour')!!}</th>
			<th class="th" >{!!trans('data.init_id')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td">{{$listgiwu->ref_cour}}</td>
					<td class="td">{{$listgiwu->code_cour}}</td>
					<td class="td">{{date('d/m/Y',strtotime($listgiwu->date_rece))}}</td>
					<td class="td">{{date('d/m/Y',strtotime($listgiwu->date_limite))}}</td>
					<td class="td">{{isset($listgiwu->expediteur) ? $listgiwu->expediteur->nom_expe : trans('data.not_found')}}</td>
					<td class="td">{{$listgiwu->sujet_cour}}</td>
					<td class="td">{{$listgiwu->type_cour}}</td>
					<td class="td">{{$listgiwu->statut_cour}}</td>
					<td class="td">{{$listgiwu->priorite_cour}}</td>
					<td class="td">{{isset($listgiwu->direction) ? $listgiwu->direction->code_direc : trans('data.not_found')}}</td>
					<td class="td">{{$listgiwu->commentaire_cour}}</td>
					<td class="td">{!! $listgiwu->piece_jointe_cour !!}</td>
					<td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
