
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
                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md">
                        <i class="{{$icone}}"></i>
                    </div>
                </div>
            </div><!-- end card header -->
            <div class="card-body">
                <p class="text-muted"></p>
                <div class="live-preview">
                <strong><div class="msgAjouter"></div></strong>
                    <form action="{{route('users.update',$user->code)}}" method="post" id="form" class="row g-3 needs-validation" novalidate  enctype="multipart/form-data">
                        @csrf()
                        @method('PATCH')
                        <div class="row">
                            @if(session()->has('success') || session()->has('error'))
                                <div class="col-md-12">
                                    <div class="alert {{ session()->has('success') ? 'alert-success' : ''}} {{ session()->has('error') ? 'alert-danger' : ''}} alert-border-left alert-dismissible fade show" role="alert">
                                        <i title ="{{session()->has('errorMsg')? session()->get('errorMsg') : '' }}" class="{{session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'}} me-3 align-middle"></i> <strong>Infos </strong> - {{session()->has('success') ? session()->get('success') : session()->get('error')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="matricule" class="form-label">{{trans('data.matricule')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::text('matricule',$user->matricule,["id"=>"matricule","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer votre grade",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{trans('data.name')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::text('name',$user->name,["id"=>"name","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer votre nom",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">{{trans('data.prenom')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::text('prenom',$user->prenom,["id"=>"prenom","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer votre prénom",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="tel_user" class="form-label">{{trans('data.tel_user')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::text('tel_user',$user->tel_user,["id"=>"tel_user","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer votre téléphone",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{trans('data.email')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::email('email',$user->email,["id"=>"email","class"=>"form-control","required"=>"required",'placeholder'=>"example@gamil.com",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_role" class="form-label">{{trans('data.libelle_role')}}<strong style='color: red;'> *</strong></label>
                                    <?php $addUse = array(''=>'Sélectionner un élément'); $sltRole = $addUse + $sltRole->toArray();?>
						            {!! Form::select('id_role',$sltRole ,$user->id_role,["id"=>"id_role","class"=>"form-select select2",'required'=>'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">{{trans('data.is_active')}}<strong style='color: red;'> *</strong></label>
                                    <?php $addUse = array(''=>'Sélectionner un élément','1'=>'Activé','0'=>'Désactivé');?>
						            {!! Form::select('is_active',$addUse ,$user->is_active,["id"=>"is_active","class"=>"form-select select2",'required'=>'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="type_fonct" class="form-label">{{trans('data.type_fonct')}}<strong style='color: red;'> *</strong></label>
						            {!! Form::select('type_destina',trans('entite.type_destinataire') ,$user->type_fonct,["id"=>"type_destina","class"=>"form-select select2",'required'=>'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_fonct" class="form-label">{{trans('data.id_fonct')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::select('id_desti',$destina,$user->id_fonct,["id"=>"id_desti","class"=>"form-select allselect","required"=>"required"]) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="grade" class="form-label">{{trans('data.grade')}}</label>
                                    {!! Form::text('grade',$user->grade,["id"=>"grade","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer votre grade",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="echellon" class="form-label">{{trans('data.echellon')}}</label>
                                    {!! Form::text('echellon',$user->echellon,["id"=>"echellon","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer votre grade",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
								<div class="mb-3">
									<label for="date_nais" class="form-label">{!!trans('data.date_nais')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::date('date_nais',$user->date_nais,["id"=>"date_nais","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Date debut" ]) !!}
								</div>
							</div>
                            <div class="col-md-4">
								<div class="mb-3">
									<label for="date_embauche" class="form-label">{!!trans('data.date_embauche')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::date('date_embauche',$user->date_embauche,["id"=>"date_embauche","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Date debut" ]) !!}
								</div>
							</div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="other_infos_user" class="form-label">{{trans('data.other_infos_user')}}</label>
                                    {!! Form::text('other_infos_user',$user->other_infos_user,["id"=>"other_infos_user","class"=>"form-control",'placeholder'=>"Entrer votre d'autre informations",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-end">
                                    <a href="{{route('users.index')}}" class="btn btn-outline-dark waves-effect mr-10 rounded-pill">Fermer</a>
                                    @if(in_array('update_user',session('InfosAction')))
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
	<script src="{{url('assets/js/jquery.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
	// Écoutez les changements dans le premier combo(combo1)
	document.getElementById("type_destina").addEventListener("change", function() {
		ChargeDestinataire();
	});

</script>
@endsection