<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	<table class="table table-striped table-bordered table-nowrap">
		<thead><tr>
			@if(in_array('update_courrier',session('InfosAction')) || in_array('delete_courrier',session('InfosAction')) || in_array('transfert_courrier',session('InfosAction')) )
				<th class="text-center"> Actions</th>
			@endif
			<th scope="col" >{!!trans('data.ref_cour')!!}</th>
			<th scope="col" >{!!trans('data.code_check')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.piece_jointe_cour')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.date_rece')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.date_limite')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.expe_id')!!}</th>
			<th scope="col" >{!!trans('data.sujet_cour')!!}</th>
			<th scope="col" >{!!trans('data.statut_cour')!!}</th>
			<th scope="col" >{!!trans('data.priorite_cour')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.direc_id')!!}</th>
			<!-- <th scope="col" >{!!trans('data.commentaire_cour')!!}</th> -->
			@if(in_array('init_giwu',session('InfosAction')))
			<th scope="col" class="text-center">{!!trans('data.init_id')!!}</th>
			@endif
		</tr></thead>
		<tbody>
			@foreach($list as $listgiwu)
				<tr>
					@if(in_array('update_courrier',session('InfosAction')) || in_array('delete_courrier',session('InfosAction')) )
						<td class="text-center">
							@if(in_array('update_courrier',session('InfosAction')))
								<a href="{{route('courrier.edit',$listgiwu->id_cour)}}" title='Modifier' class="btn btn-success btn-sm  waves-effect waves-light"><i class="ri-edit-2-line"></i></a>
							@endif
							@if(in_array('delete_courrier',session('InfosAction')))
								<button type="button"  title='Supprimer' data-id="{{$listgiwu->id_cour}}" class="btn btn-danger btn-sm  waves-effect waves-light btn-delete" data-bs-toggle="modal" ><i class="ri-delete-bin-6-line"></i></button>
							@endif
							@if(in_array('transfert_courrier',session('InfosAction')))
                                <button type="button" title='Envoyer le courrier au destinataire' data-id="{{$listgiwu->id_cour}}" class="btn btn-sm btn-warning waves-effect waves-light btn-transfert"  data-toggle="modal"><i class="ri-share-line"></i></button>
                            @endif
						</td>
					@endif
					<td>{!! $listgiwu->ref_cour !!}</td>
					<td>{!! $listgiwu->code_check !!}</td>
					<td class="text-center">
						@if($listgiwu->piece_jointe_cour)
							<a href='{{"assets/courrier/".$listgiwu->piece_jointe_cour}}' title="{!!$listgiwu->piece_jointe_cour!!}" target="_blank" class="badge bg-success">Ouvrir</a>
						@else <span class="badge bg-danger">Aucun</a>  @endif
					</td>
					<td class="text-center">{{date('d/m/Y',strtotime($listgiwu->date_rece))}}</td>
					<td class="text-center">{{date('d/m/Y',strtotime($listgiwu->date_limite))}}</td>
					<td>{!! isset($listgiwu->expediteur) ? $listgiwu->expediteur->nom_expe : trans('data.not_found') !!}</td>
					<td>{!! $listgiwu->sujet_cour !!}</td>
					<td>{!! trans('entite.statut_courrier')[$listgiwu->statut_cour] !!}</td>
					<td>{!! trans('entite.priorite_courrier')[$listgiwu->priorite_cour] !!}</td>
					<td title="{{isset($listgiwu->direction) ? $listgiwu->direction->lib_direc : trans('data.not_found')}}">{!! isset($listgiwu->direction) ? $listgiwu->direction->code_direc : trans('data.not_found') !!}</td>
					<!-- <td>{!! $listgiwu->commentaire_cour !!}</td> -->
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
