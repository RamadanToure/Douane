<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	<table class="table table-striped table-bordered table-nowrap">
		<thead><tr>
			@if(in_array('update_carriere',session('InfosAction')) || in_array('delete_carriere',session('InfosAction')) )
				<th class="text-center"> Actions</th>
			@endif
			<th scope="col" >{!!trans('data.type_fonct')!!}</th>
			<th scope="col">{!!trans('data.id_fonct')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.date_debut_carr')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.date_fin_carr')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.salaire_carr')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.id_occupant')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.init_id')!!}</th>
		</tr></thead>
		<tbody>
			@foreach($list as $listgiwu)
				<tr>
					@if(in_array('update_carriere',session('InfosAction')) || in_array('delete_carriere',session('InfosAction')) )
						<td class="text-center">
							@if(in_array('update_carriere',session('InfosAction')))
								<a href="{{route('carriere.edit',$listgiwu->id_carr)}}" title='Modifier' class="btn btn-success btn-sm  waves-effect waves-light"><i class="ri-edit-2-line"></i></a>
							@endif
							@if(in_array('delete_carriere',session('InfosAction')))
								<button type="button"  title='Supprimer' data-id="{{$listgiwu->id_carr}}" class="btn btn-danger btn-sm  waves-effect waves-light btn-delete" data-bs-toggle="modal" ><i class="ri-delete-bin-6-line"></i></button>
							@endif
					@endif
					<td>{!! trans('entite.type_destinataire')[$listgiwu->type_fonct]!!}</td>
					<td>{{$listgiwu->fonction($listgiwu->type_fonct,$listgiwu->id_fonct) }}</td>
					<td class="text-center">{{date('d/m/Y',strtotime($listgiwu->date_debut_carr))}}</td>
					<td class="text-center">{{date('d/m/Y',strtotime($listgiwu->date_fin_carr))}}</td>
					<td style ='text-align:right' >{{strrev(wordwrap(strrev(intval($listgiwu->salaire_carr)), 3, ' ', true))}}</td>
					<td>{!! isset($listgiwu->occupant) ? $listgiwu->occupant->name." ".$listgiwu->occupant->prenom : trans('data.not_found') !!}</td>
					<td>{!! isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found') !!}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{!! $list->appends(['query'=>(isset($_GET['query'])?$_GET['query']:'') ])->links() !!}
@else
	<div Class="alert alert-info"><strong>Info! </strong> {!!trans('data.AucunInfosTrouve')!!} </div>
@endif
