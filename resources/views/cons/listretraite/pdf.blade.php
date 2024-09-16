<title>{{Config('app.name') }} | Retraite</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Retraite<br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<th class="th" >{!!trans('data.matricule')!!}</th>
			<th class="th" >{!!trans('data.name')!!}</th>
			<th class="th" >{!!trans('data.prenom')!!}</th>
			<th class="th" >{!!trans('data.email')!!}</th>
			<th class="th" >{!!trans('data.grade')!!}</th>
			<th class="th" >{!!trans('data.echellon')!!}</th>
			<th class="th" >{!!trans('data.date_embauche')!!}</th>
			<th class="th" >{!!trans('data.date_nais')!!}</th>
			<th class="th" >{!!trans('data.tel_user')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td">{{$listgiwu->matricule}}</td>
					<td class="td">{{$listgiwu->name}}</td>
					<td class="td">{{$listgiwu->prenom}}</td>
					<td class="td">{{$listgiwu->email}}</td>
					<td class="td">{{$listgiwu->grade}}</td>
					<td class="td">{{$listgiwu->echellon}}</td>
					<td class="td">{{date('d/m/Y',strtotime($listgiwu->date_embauche))}}</td>
					<td class="td">{{date('d/m/Y',strtotime($listgiwu->date_nais))}}</td>
					<!-- <td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
					<td class="td">{{isset($listgiwu->service) ? $listgiwu->service->code_serv : trans('data.not_found')}}</td> -->
					<td class="td">{{$listgiwu->tel_user}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
