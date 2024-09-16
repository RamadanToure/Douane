<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	<table class="table table-striped table-bordered table-nowrap">
		<thead><tr>
			@if(in_array('update_archive',session('InfosAction')) || in_array('delete_archive',session('InfosAction')) )
				<th class="text-center"> Actions</th>
			@endif
			<th scope="col" >{!!trans('data.ref_doc')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.fichier_doc')!!}</th>
			<!-- <th scope="col" >{!!trans('data.code_doc')!!}</th> -->
			<th scope="col" >{!!trans('data.sujet_doc')!!}</th>
			<th scope="col" >{!!trans('data.type_doc')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.direc_id')!!}</th>
			<th scope="col" >{!!trans('data.statut_doc')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.init_id')!!}</th>
		</tr></thead>
		<tbody>
			@foreach($list as $listgiwu)
				<tr>
					@if(in_array('update_archive',session('InfosAction')) || in_array('delete_archive',session('InfosAction')) )
						<td class="text-center">
							@if(in_array('update_archive',session('InfosAction')))
								<a href="{{route('archive.edit',$listgiwu->id_archive)}}" title='Modifier' class="btn btn-success btn-sm  waves-effect waves-light"><i class="ri-edit-2-line"></i></a>
							@endif
							@if(in_array('delete_archive',session('InfosAction')))
								<button type="button"  title='Supprimer' data-id="{{$listgiwu->id_archive}}" class="btn btn-danger btn-sm  waves-effect waves-light btn-delete" data-bs-toggle="modal" ><i class="ri-delete-bin-6-line"></i></button>
							@endif
						</td>
					@endif
					<td>{!! $listgiwu->ref_doc !!}</td>
					<td class="text-center">
						@if($listgiwu->fichier_doc)
							<a href='{{"assets/courrier/".$listgiwu->fichier_doc}}' title="{!!$listgiwu->fichier_doc!!}" target="_blank" class="badge bg-success">Ouvrir</a>
						@else <span class="badge bg-danger">Aucun</a>  @endif
					</td>
					<!-- <td>{!! $listgiwu->code_doc !!}</td> -->
					<td>{!! $listgiwu->sujet_doc !!}</td>
					<td>{!! trans('entite.type_doc_Archive')[$listgiwu->type_doc] !!}</td>
					<td title="{{isset($listgiwu->direction) ? $listgiwu->direction->lib_direc : trans('data.not_found')}}">{!! isset($listgiwu->direction) ? $listgiwu->direction->code_direc : trans('data.not_found') !!}</td>
					<td>{!! trans('entite.statut_doc_Archive')[$listgiwu->statut_doc] !!}</td>
					<td>{!! isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found') !!}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{!! $list->appends(['query'=>(isset($_GET['query'])?$_GET['query']:'') ])->links() !!}
@else
	<div Class="alert alert-info"><strong>Info! </strong> {!!trans('data.AucunInfosTrouve')!!} </div>
@endif
