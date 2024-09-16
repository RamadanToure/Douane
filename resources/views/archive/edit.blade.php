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
					<form action="{{route('archive.update',$item->id_archive)}}" method="post" id="form" class="row g-3 needs-validation" novalidate enctype='multipart/form-data'>
						@csrf()
						@method('PATCH')
							<div class="row">
							@if(session()->has('success') || session()->has('error'))<div class="col-md-12 mt-2"><div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show" role="alert"><i title ="{!!session()->has('errorMsg')? session()->get('errorMsg') : '' !!}" class=" {!!session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'!!} me-3 align-middle"></i> <strong>Infos </strong> - {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>@endif

							<div class="col-md-6">
								<div class="mb-3">
									<label for="ref_doc" class="form-label">{!!trans('data.ref_doc')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('ref_doc',$item->ref_doc,["id"=>"ref_doc","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Reference" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="sujet_doc" class="form-label">{!!trans('data.sujet_doc')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('sujet_doc',$item->sujet_doc,["id"=>"sujet_doc","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Sujet" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="type_doc" class="form-label">{!!trans('data.type_doc')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::select('type_doc',trans('entite.type_doc_Archive') ,$item->type_doc,["id"=>"type_doc","class"=>"form-select allselect" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="direc_id" class="form-label">{!!trans('data.direc_id')!!} <strong style='color: red;'> *</strong></label>
									<?php $addUse = array(''=>'S&eacute;lectionnez un &eacute;l&eacute;ment'); $listdirec_id = $addUse + $listdirec_id->toArray();?>
									{!! Form::select('direc_id',$listdirec_id ,$item->direc_id,["id"=>"direc_id","class"=>"form-select allselect" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="fichier_doc" class="form-label">{!!trans('data.fichier_doc').' '.$item->fichier_doc!!} <strong style='color: red;'> *</strong></label>
									<input class="form-control" type="file" id="fichier_doc" name="fichier_doc" <?php echo isset($item->fichier_doc) ? '' : 'required'; ?> >
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="statut_doc" class="form-label">{!!trans('data.statut_doc')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::select('statut_doc',trans('entite.statut_doc_Archive') ,$item->statut_doc,["id"=>"statut_doc","class"=>"form-select allselect" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-12">
								<div class="text-end">
									<a href="{{route('archive.index')}}" class="btn btn-outline-dark waves-effect mr-10 rounded-pill">Fermer</a>
									@if(in_array('update_archive',session('InfosAction')))
										<button type="submit" class="btn btn-success btn-label right rounded-pill"><i class="ri-edit-2-line label-icon align-middle fs-16 ms-2"></i>Modifier</button>
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