
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
                    <form action="{{route('role.store')}}" method="post" id="form" class="row g-3 needs-validation" novalidate>
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
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="libelle_role" class="form-label">{{trans('data.libelle_role')}}<strong style='color: red;'> *</strong></label>
                                    {!! Form::text('libelle_role','',["id"=>"libelle_role","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer le role",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_2" role="grid" aria-describedby="sample_2_info">
                                    <thead>
                                        <tr role="row" >
                                            <th>Choisir le menu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listMenu as $list)
                                            <tr role="row">
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked{{$list->id_menu}}" name ="cocher{{$list->id_menu}}" value="{{$list->id_menu}}">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked{{$list->id_menu}}">Menu : {{$list->libelle_menu}} / {{$list->titre_page}}</label>
                                                    </div>
                                                </td>
                                            </tr>  
                                            <?php $cheActio = \App\Models\GiwuRoleAcces::getlistAction($list->id_menu);?>
                                            @if(sizeof($cheActio) != 0)
                                                @foreach($cheActio as $listAct)
                                                    <tr role="row" style="color:#61a7a3;">
                                                        <td style="padding-left:70px;">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" name ="action{{$listAct->id_action}}"  value="{{$listAct->id_action}}" id="flexSwitchCheck{{$listAct->id_action}}" >
                                                                <label class="form-check-label" for="flexSwitchCheck{{$listAct->id_action}}">Actions : {{$listAct->libelle_action}}</label>
                                                            </div>
                                                        </td>
                                                    </tr>  
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <div class="text-end">
                                    <a href="{{route('role.index')}}" class="btn btn-outline-dark waves-effect mr-10 rounded-pill">Fermer</a>
                                    @if(in_array('add_role',session('InfosAction')))
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
