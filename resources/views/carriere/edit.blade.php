@extends('layouts.general')

@section('path_content')
	@if(sizeof($pathMenu) != 0)
		@for($i=0; $i < count($pathMenu); $i++)
			<li class="breadcrumb-item active"><a href="{{$pathMenu[$i]['lien']}}" class="kt-subheader__breadcrumbs-link">{{$pathMenu[$i]['titre']}}</a></li>
		@endfor
	@endif
@stop

@section('content')

	<div class="col-lg-12">
		<div class="card">
			<div class="card-header align-items-center d-flex">
				<h4 class="card-title mb-0 flex-grow-1">{{$titre}}</h4>
				<div class="flex-shrink-0"><div class="form-check form-switch form-switch-right form-switch-md"><i class="{{$icone}}"></i></div></div>
			</div><!-- end card header -->
			<div class="card-body"><p class="text-muted"></p>
				<div class="live-preview"><strong><div class="msgAjouter"></div></strong>
					<form action="{{route('carriere.update',$item->id_carr)}}" method="post" id="form" class="row g-3 needs-validation" novalidate >
						@csrf()
						@method('PATCH')
							<div class="row">
							@if(session()->has('success') || session()->has('error'))<div class="col-md-12 mt-2"><div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show" role="alert"><i title ="{!!session()->has('errorMsg')? session()->get('errorMsg') : '' !!}" class=" {!!session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'!!} me-3 align-middle"></i> <strong>Infos </strong> - {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>@endif

							<div class="col-md-6">
								<div class="mb-3">
									<label for="type_fonct" class="form-label">{!!trans('data.type_fonct')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::select('type_fonct',trans('entite.type_destinataire') ,$item->type_fonct,["id"=>"type_destina","class"=>"form-select" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="id_fonct" class="form-label">{!!trans('data.id_fonct')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::select('id_fonct',$destina,$item->id_fonct,["id"=>"id_desti","class"=>"form-select allselect","required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="date_debut_carr" class="form-label">{!!trans('data.date_debut_carr')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::date('date_debut_carr',$item->date_debut_carr,["id"=>"date_debut_carr","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Date debut" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="date_fin_carr" class="form-label">{!!trans('data.date_fin_carr')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::date('date_fin_carr',$item->date_fin_carr,["id"=>"date_fin_carr","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Date fin" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="salaire_carr" class="form-label">{!!trans('data.salaire_carr')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::number('salaire_carr',$item->salaire_carr,["id"=>"salaire_carr","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Salaire" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="id_occupant" class="form-label">{!!trans('data.id_occupant')!!} <strong style='color: red;'> *</strong></label>
									<?php $addUse = array(''=>'S&eacute;lectionnez un &eacute;l&eacute;ment'); $listid_occupant = $addUse + $listid_occupant->toArray();?>
									{!! Form::select('id_occupant',$listid_occupant ,$item->id_occupant,["id"=>"id_occupant","class"=>"form-select allselect" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-12">
								<div class="text-end">
									<a href="{{route('carriere.index')}}" class="btn btn-outline-dark waves-effect mr-10 rounded-pill">Fermer</a>
									@if(in_array('update_carriere',session('InfosAction')))
										<button type="submit" class="btn btn-success btn-label right rounded-pill"><i class="ri-edit-2-line label-icon align-middle fs-16 ms-2 rounded-pill"></i>Modifier</button>
									@endif
								</div>
							</div>
						</div><!--end row-->
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('JS_content')
	<script src="{{ url('assets/js/jquery.min.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		// Écoutez les changements dans le premier combo(combo1)
		document.getElementById("type_destina").addEventListener("change", function() {
			ChargeDestinataire();
		});
	</script>
@endsection