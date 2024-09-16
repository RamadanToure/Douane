<title>{{Config('app.name') }} | Liste des Traces</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer">
<i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i>
</div>
@if(count($list) != 0)
<div><h3 style="text-align:center;">
Liste des menus<br>
	@if(!empty($_GET['query']))
		Recherche : {{$_GET['query']}}<br>
	@endif 
</h3></div>
<style>
	
</style>
	<table class="table" style="font-size:13px; width:100%;">
		<tr>
			<th class="th">{{trans('data.created_at')}}</th>
			<th class="th">{{trans('data.id_user')}}</th>
			<th class="th">{{trans('data.libelle_trace')}}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td">{{date('d/m/Y',strtotime($listgiwu->created_at))}}</td>
                    <td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name.' '.$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
					<td class="td">{!! $listgiwu->libelle_trace !!}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif


