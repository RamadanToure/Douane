<title>{{Config('app.name') }} | Expediteurs</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Expediteurs<br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<!-- <th class="th" >{!!trans('data.id_expe')!!}</th> -->
			<th class="th" >{!!trans('data.nom_expe')!!}</th>
			<th class="th" >{!!trans('data.type_expe')!!}</th>
			<th class="th" >{!!trans('data.adres_expe')!!}</th>
			<th class="th" >{!!trans('data.email_expe')!!}</th>
			<th class="th" >{!!trans('data.init_id')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<!-- <td class="td">{{$listgiwu->id_expe}}</td> -->
					<td class="td">{{$listgiwu->nom_expe}}</td>
					<td class="td">{{trans('entite.type_expediteur')[$listgiwu->type_expe] }}</td>
					<td class="td">{{$listgiwu->adres_expe}}</td>
					<td class="td">{{$listgiwu->email_expe}}</td>
					<td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
