<title>{{Config('app.name') }} | Carriere</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Carriere<br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<th class="th" >{!!trans('data.type_fonct')!!}</th>
			<th class="th" >{!!trans('data.id_fonct')!!}</th>
			<th class="th" >{!!trans('data.date_debut_carr')!!}</th>
			<th class="th" >{!!trans('data.date_fin_carr')!!}</th>
			<th class="th" >{!!trans('data.salaire_carr')!!}</th>
			<th class="th" >{!!trans('data.id_occupant')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td">{{trans('entite.type_destinataire')[$listgiwu->type_fonct]}}</td>
					<td class="td" >{{$listgiwu->fonction($listgiwu->type_fonct,$listgiwu->id_fonct)}}</td>
					<td class="td">{{date('d/m/Y',strtotime($listgiwu->date_debut_carr))}}</td>
					<td class="td">{{date('d/m/Y',strtotime($listgiwu->date_fin_carr))}}</td>
					<td class="td" >{{strrev(wordwrap(strrev(intval($listgiwu->salaire_carr)), 3, ' ', true))}}</td>
					<td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
