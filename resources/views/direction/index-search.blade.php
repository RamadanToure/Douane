<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	@if(in_array('update_direction',session('InfosAction')) || in_array('delete_direction',session('InfosAction')) )
		@if(in_array('update_direction',session('InfosAction')))
			<button type='button' class='btn btn-success btn-label right waves-light rounded-pill' id='btn-modifier'><i class='ri-check-double-line label-icon align-middle fs-16 ms-2 rounded-pill'></i> Modifier</button>
		@endif
		@if(in_array('delete_direction',session('InfosAction')))
			<button type='button' class='btn btn-danger btn-label right waves-light rounded-pill' id='btn-supprimer'><i class='ri-delete-bin-6-line label-icon align-middle fs-16 ms-2 rounded-pill'></i> Supprimer</button>
		@endif
	@endif
	<table class="table table-striped table-bordered table-nowrap mt-4">
		<thead><tr>
			<th scope='col'></th>
			<th scope="col" >{!!trans('data.code_direc')!!}</th>
			<th scope="col" >{!!trans('data.lib_direc')!!}</th>
			@if(in_array('init_giwu',session('InfosAction')))
			<th scope="col" class="text-center">{!!trans('data.respo_id')!!}</th>
			@endif
			@if(in_array('init_giwu',session('InfosAction')))
			<th scope="col" class="text-center">{!!trans('data.init_id')!!}</th>
			@endif
		</tr></thead>
		<tbody>
			@foreach($list as $listgiwu)
				<tr>
					<td class='text-center'><input class='form-check-input checkradio' data-id='{{$listgiwu->id_direc}}'  type='radio' name='formradiocolor9' id='formradioRight13'></td>
					<td>{!! $listgiwu->code_direc !!}</td>
					<td>{!! $listgiwu->lib_direc !!}</td>
					<td>{!! isset($listgiwu->responsable) ? $listgiwu->responsable->name." ".$listgiwu->responsable->prenom : trans('data.not_found') !!}</td>
					@if(in_array('init_giwu',session('InfosAction')))
						<td>{!! isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found') !!}</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{!! $list->appends(['query'=>(isset($_GET['query'])?$_GET['query']:'') ])->links() !!}
@else
	<div Class="alert alert-info"><strong>Info! </strong> {!!trans('data.AucunInfosTrouve')!!} </div>
@endif
