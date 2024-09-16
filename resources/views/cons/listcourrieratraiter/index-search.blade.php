<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	<table class="table table-striped table-bordered table-nowrap">
		<thead><tr>
			@if(in_array('transfert_courriertraiter',session('InfosAction')) || in_array('traiter_courriertraiter',session('InfosAction')) || in_array('rejet_courriertraiter',session('InfosAction')) )
				<th class="text-center"> Actions</th>
			@endif
			<th scope="col" >{!!trans('data.ref_cour')!!}</th>
			<th scope="col" >{!!trans('data.code_check')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.piece_jointe_cour')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.date_rece')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.date_limite')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.expe_id')!!}</th>
			<th scope="col" >{!!trans('data.sujet_cour')!!}</th>
			<th scope="col" >{!!trans('data.priorite_cour')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.direc_id')!!}</th>
			<th scope="col" >{!!trans('data.commentaire_cour')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.init_id')!!}</th>
		</tr></thead>
		<tbody>
			@foreach($list as $listgiwu)
				<tr>
					@if(in_array('transfert_courriertraiter',session('InfosAction')) || in_array('traiter_courriertraiter',session('InfosAction')) || in_array('rejet_courriertraiter',session('InfosAction')) )
						<td class="text-center">
							@if(session('lisTypeCourSess') != 'tr')
								@if(in_array('transfert_courriertraiter',session('InfosAction')))
									<button type="button" title='Transférer le courrier' data-id="{{$listgiwu->id_cour}}" class="btn btn-sm btn-warning waves-effect waves-light btn-transfert"  data-toggle="modal"><i class="ri-share-line"></i></button>
								@endif
								@if(in_array('traiter_courriertraiter',session('InfosAction')))
									<button type="button" title='Traiter le courrier' data-id="{{$listgiwu->id_cour}}" class="btn btn-sm btn-success waves-effect waves-light btn-traiter"  data-toggle="modal"><i class="ri-task-line"></i></button>
								@endif
								@if(in_array('rejet_courriertraiter',session('InfosAction')))
									<!-- <button type="button" title='Rejeter le courrier' data-id="{{$listgiwu->id_cour}}" class="btn btn-sm btn-danger waves-effect waves-light btn-retourner"  data-toggle="modal"><i class="ri-arrow-go-back-fill"></i></button> -->
								@endif
							@endif
							@if(in_array('Consult_courriertraiter',session('InfosAction')))
								<a href='{{"courrier/consulter/".$listgiwu->code_cour}}' title='Consulter le courrier'  class='btn btn-sm btn-primary waves-effect waves-light btn-consulter' id='btn-consulter'><i class='ri-eye-line'></i></a>
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
					<td>{!! trans('entite.priorite_courrier')[$listgiwu->priorite_cour] !!}</td>
					<td>{!! isset($listgiwu->direction) ? $listgiwu->direction->code_direc : trans('data.not_found') !!}</td>
					<td> @if(strlen($listgiwu->commentaire_cour) > 30)
						{!! substr($listgiwu->commentaire_cour, 0, 30) !!}...
						@else  {!! $listgiwu->commentaire_cour !!} 
						@endif 
					</td>
					<td>{!! isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found') !!}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{!! $list->appends(['query'=>(isset($_GET['query'])?$_GET['query']:'') ])->links() !!}
@else
	<div Class="alert alert-info"><strong>Info! </strong> {!!trans('data.AucunInfosTrouve')!!} </div>
@endif
