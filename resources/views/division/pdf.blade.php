<title>{{Config('app.name') }} | Divisions</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Divisions<br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<th class="th" >{!!trans('data.code_divi')!!}</th>
			<th class="th" >{!!trans('data.lib_divi')!!}</th>
			<th class="th" >{!!trans('data.id_serv')!!}</th>
			<th class="th" >{!!trans('data.respo_id')!!}</th>
			<th class="th" >{!!trans('data.init_id')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td">{{$listgiwu->code_divi}}</td>
					<td class="td">{{$listgiwu->lib_divi}}</td>
					<td class="td">{{isset($listgiwu->service) ? $listgiwu->service->code_serv : trans('data.not_found')}}</td>
					<td class="td">{{isset($listgiwu->responsable) ? $listgiwu->responsable->name." ".$listgiwu->responsable->prenom : trans('data.not_found')}}</td>
					<td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
