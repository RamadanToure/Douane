<title>{{Config('app.name') }} | Liste des menus</title>
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
			<th class="th" >{{trans('data.libelle_menu')}}</th>
			<th class="th" >{{trans('data.email')}}</th>
			<th class="th" >{{trans('data.tel_user')}}</th>
			<th class="th" >{{trans('data.other_infos_user')}}</th>
			<th class="th" >{{trans('data.id_role')}}</th>
			<th class="th" >{{trans('data.is_active')}}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td" >{{$listgiwu->name." ".$listgiwu->prenom}}</td>
					<td class="td">{{$listgiwu->email}}</td>
					<td class="td">{{$listgiwu->tel_user}}</td>
					<td class="td">{{$listgiwu->other_infos_user}}</td>
					<td class="td">{{$listgiwu->role->libelle_role}}</td>
					<td class="td">{{App\Models\User::EtatUser($listgiwu->is_active)}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif


