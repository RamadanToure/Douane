<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	<table class="table table-striped table-bordered table-nowrap">
		<thead><tr>
			@if(in_array('update_courriersortant',session('InfosAction')) || in_array('delete_courriersortant',session('InfosAction')) )
				<th class="text-center"> Actions</th>
			@endif
			<th scope="col" >{!!trans('data.ref_cour')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.piece_jointe')!!}</th>
			<th scope="col" >{!!trans('data.date_envoi')!!}</th>
			<th scope="col" >{!!trans('data.sujet_cour')!!}</th>
			<th scope="col" >{!!trans('data.note_cour')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.dest_id')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.direc_id')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.init_id')!!}</th>
		</tr></thead>
		<tbody>
			@foreach($list as $listgiwu)
				<tr>
					@if(in_array('update_courriersortant',session('InfosAction')) || in_array('delete_courriersortant',session('InfosAction')) )
						<td class="text-center">
							@if(in_array('update_courriersortant',session('InfosAction')))
								<a href="{{route('courriersortant.edit',$listgiwu->id_cours)}}" title='Modifier' class="btn btn-success btn-sm  waves-effect waves-light"><i class="ri-edit-2-line"></i></a>
							@endif
							@if(in_array('delete_courriersortant',session('InfosAction')))
								<button type="button"  title='Supprimer' data-id="{{$listgiwu->id_cours}}" class="btn btn-danger btn-sm  waves-effect waves-light btn-delete" data-bs-toggle="modal" ><i class="ri-delete-bin-6-line"></i></button>
							@endif
						</td>
					@endif
					<td>{!! $listgiwu->ref_cour !!}</td>
					<td class="text-center">
						@if($listgiwu->piece_jointe)
							<a href='{{"assets/courrier/".$listgiwu->piece_jointe}}' title="{!!$listgiwu->piece_jointe!!}" target="_blank" class="badge bg-success">Ouvrir</a>
						@else <span class="badge bg-danger">Aucun</a>  @endif
					</td>
					<td>{{date('d/m/Y',strtotime($listgiwu->date_envoi))}}</td>
					<td>{!! $listgiwu->sujet_cour !!}</td>
					<td> @if(strlen($listgiwu->note_cour) > 30)
						{!! substr($listgiwu->note_cour, 0, 30) !!}...
						@else  {!! $listgiwu->note_cour !!} 
						@endif 
					</td>
					<td>{!! isset($listgiwu->expediteur) ? $listgiwu->expediteur->nom_expe : trans('data.not_found') !!}</td>
					<td title="{{isset($listgiwu->direction) ? $listgiwu->direction->lib_direc : trans('data.not_found')}}">{!! isset($listgiwu->direction) ? $listgiwu->direction->code_direc : trans('data.not_found') !!}</td>
					<td>{!! isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found') !!}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{!! $list->appends(['query'=>(isset($_GET['query'])?$_GET['query']:'') ])->links() !!}
@else
	<div Class="alert alert-info"><strong>Info! </strong> {!!trans('data.AucunInfosTrouve')!!} </div>
@endif
