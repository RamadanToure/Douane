<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	<table class="table table-striped table-bordered table-nowrap">
		<thead><tr>
			<th scope="col" >{!!trans('data.matricule')!!}</th>
			<th scope="col" >{!!trans('data.name')!!}</th>
			<th scope="col" >{!!trans('data.prenom')!!}</th>
			<th scope="col" >{!!trans('data.email')!!}</th>
			<th scope="col" >{!!trans('data.grade')!!}</th>
			<th scope="col" >{!!trans('data.echellon')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.date_embauche')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.date_nais')!!}</th>
			<!-- <th scope="col" >{!!trans('data.init_id')!!}</th> -->
		</tr></thead>
		<tbody>
			@foreach($list as $listgiwu)
				<tr>
					<td>{!! $listgiwu->matricule !!}</td>
					<td>{!! $listgiwu->name !!}</td>
					<td>{!! $listgiwu->prenom !!}</td>
					<td>{!! $listgiwu->email !!}</td>
					<td>{!! $listgiwu->grade !!}</td>
					<td>{!! $listgiwu->echellon !!}</td>
					<td class="text-center">{{date('d/m/Y',strtotime($listgiwu->date_embauche))}}</td>
					<td class="text-center">{{date('d/m/Y',strtotime($listgiwu->date_nais))}}</td>
					<!-- <td>{!! isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found') !!}</td> -->
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{!! $list->appends(['query'=>(isset($_GET['query'])?$_GET['query']:'') ])->links() !!}
@else
	<div Class="alert alert-info"><strong>Info! </strong> {!!trans('data.AucunInfosTrouve')!!} </div>
@endif
