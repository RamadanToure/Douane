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
					<form action="{{route('courrier.store')}}" method="post" id="form" class="row g-3 needs-validation" novalidate enctype='multipart/form-data'>
						@csrf()
							<div class="row">
							@if(session()->has('success') || session()->has('error'))<div class="col-md-12 mt-2"><div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show" role="alert"><i title ="{!!session()->has('errorMsg')? session()->get('errorMsg') : '' !!}" class=" {!!session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'!!} me-3 align-middle"></i> <strong>Infos </strong> - {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>@endif

							<div class="col-md-6">
								<div class="mb-3">
									<label for="ref_cour" class="form-label">{!!trans('data.ref_cour')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('ref_cour','',["id"=>"ref_cour","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Reference" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="date_rece" class="form-label">{!!trans('data.date_rece')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::date('date_rece',date('d/m/Y'),["id"=>"date_rece","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Date Reception" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="date_limite" class="form-label">{!!trans('data.date_limite')!!} </label>
									{!! Form::date('date_limite',date('d/m/Y'),["id"=>"date_limite","class"=>"form-control"  ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Date limite" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="expe_id" class="form-label">{!!trans('data.expe_id')!!} <strong style='color: red;'> *</strong></label>
									<?php $addUse = array(''=>'S&eacute;lectionnez un &eacute;l&eacute;ment'); $listexpe_id = $addUse + $listexpe_id->toArray();?>
									{!! Form::select('expe_id',$listexpe_id ,null,["id"=>"expe_id","class"=>"form-select allselect" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="sujet_cour" class="form-label">{!!trans('data.sujet_cour')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('sujet_cour','',["id"=>"sujet_cour","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Sujet" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="priorite_cour" class="form-label">{!!trans('data.priorite_cour')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::select('priorite_cour',trans('entite.priorite_courrier'),null,["id"=>"priorite_cour","class"=>"form-select allselect" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="direc_id" class="form-label">{!!trans('data.direc_id')!!} <strong style='color: red;'> *</strong></label>
									<?php $addUse = array(''=>'S&eacute;lectionnez un &eacute;l&eacute;ment'); $listdirec_id = $addUse + $listdirec_id->toArray();?>
									{!! Form::select('direc_id',$listdirec_id ,null,["id"=>"direc_id","class"=>"form-select allselect" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="piece_jointe_cour" class="form-label">{!!trans('data.piece_jointe_cour')!!} <strong style='color: red;'> *</strong></label>
									<input class="form-control" type="file" id="piece_jointe_cour" name="piece_jointe_cour" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-3">
									<label for="commentaire_cour" class="form-label">{!!trans('data.commentaire_cour')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::textarea('commentaire_cour','',["id"=>"commentaire_cour","class"=>"form-control","style"=>"height: 100px;" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Commentaires" ]) !!}
								</div>
							</div>
							<div class="col-12">
								<div class="text-end">
									<a href="{{route('courrier.index')}}" class="btn btn-outline-dark waves-effect mr-10 rounded-pill">Fermer</a>
									@if(in_array('add_courrier',session('InfosAction')))
										<button type="submit" class="btn btn-primary btn-label right rounded-pill"><i class="ri-add-line label-icon align-middle fs-16 ms-2"></i>Ajouter</button>
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
@endsection