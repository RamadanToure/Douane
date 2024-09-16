
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
                    <form action="{{route('menu.store')}}" method="post" id="form" class="row g-3 needs-validation" novalidate>
                        @csrf()
                        <div class="row">
                            @if(session()->has('success') || session()->has('error'))
                                <div class="col-md-12">
                                    <div class="alert {{ session()->has('success') ? 'alert-success' : ''}} {{ session()->has('error') ? 'alert-danger' : ''}} alert-border-left alert-dismissible fade show" role="alert">
                                        <i title ="{{session()->has('errorMsg')? session()->get('errorMsg') : '' }}" class=" {{session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'}} me-3 align-middle"></i> <strong>Infos </strong> - {{session()->has('success') ? session()->get('success') : session()->get('error')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="libelle_menu" class="form-label">{{trans('data.libelle_menu')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::text('libelle_menu','',["id"=>"libelle_menu","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer le menu",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titre_page" class="form-label">{{trans('data.titre_page')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::text('titre_page','',["id"=>"titre_page","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer votre titre de la page",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="route" class="form-label">{{trans('data.route')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::text('route','',["id"=>"route","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer votre la route",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="menu_icon" class="form-label">{{trans('data.menu_icon')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::text('menu_icon','',["id"=>"menu_icon","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer votre l'îcone",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="num_ordre" class="form-label">{{trans('data.num_ordre')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::number('num_ordre','',["id"=>"num_ordre","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer le numéro d'ordre",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="topmenu_id" class="form-label">{{trans('data.topmenu_id')}}</label>
                                    <?php $addUse = array(''=>'Sélectionner un élément'); $SltEmpMenu = $addUse + $SltEmpMenu->toArray();?>
                                    {!! Form::select('topmenu_id',$SltEmpMenu ,0,["id"=>"topmenu_id","class"=>"form-control"]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="architecture" class="form-label">{{trans('data.architecture')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::text('architecture','',["id"=>"architecture","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer le numéro d'ordre",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="elmt_menu" class="form-label">{{trans('data.elmt_menu')}}<strong style='color: red;'> *</strong></label>
                                    <?php $addUse = array(''=>'Sélectionner un élément','oui'=>'Oui','non'=>'Non'); ?>
						            {!! Form::select('elmt_menu',$addUse ,null,["id"=>"elmt_menu","class"=>"form-select",'required'=>'required']) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-end">
                                    <a href="{{route('menu.index')}}" class="btn btn-outline-dark waves-effect mr-10 rounded-pill">Fermer</a>
                                    @if(in_array('add_menu',session('InfosAction')))
                                        <button type="submit" class="btn btn-primary btn-label right rounded-pill"><i class="ri-add-line label-icon align-middle fs-16 ms-2 rounded-pill"></i>Ajouter</button>
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
