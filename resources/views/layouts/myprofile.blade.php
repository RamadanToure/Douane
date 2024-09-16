
@extends('layouts.general')

@section('path_content')
	@if(sizeof($pathMenu) != 0)
		@for($i=0; $i < count($pathMenu); $i++)
            <li class="breadcrumb-item active"><a href="{{$pathMenu[$i]['lien']}}" class="kt-subheader__breadcrumbs-link">{{$pathMenu[$i]['titre']}}</a></li>
		@endfor
	@endif
@stop

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Mise à jour profil</h4>
                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md icon-demo-content">
                    <i class="{{$icone}}"></i>
                    </div>
                </div>
            </div><!-- end card header -->
            <div class="card-body">
                <p class="text-muted"></p>
                <div class="live-preview">
                    {!! Form::open(array('url' => 'updateprofil','method' => 'POST','enctype' => 'multipart/form-data','novalidate'=>'novalidate','id' => 'formProfil')) !!}
                        @if(session()->has('infos'))
                            <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                <i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> - {{session()->get('infos')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                        <img src="{{'assets/images/user/'.$image}}" id="img" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                            <input type="file" id="profile-img-file-input" name="image_profil" class="profile-img-file-input">
                                            <label for="profile-img-file-input"
                                                class="profile-photo-edit avatar-xs">
                                                <span class="avatar-title rounded-circle bg-light text-body">
                                                    <i class="ri-camera-fill"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" readonly class="form-control" id="firstnamefloatingInput" value ="{{App\Models\GiwuRole::NameRole(Auth::user()->id_role)}}" placeholder="Rôle">
                                    <label for="firstnamefloatingInput">Rôle</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="matriculefloatingInput" readonly value ="{{Auth::user()->matricule}}">
                                    <label for="matriculefloatingInput">Matricule</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="emailfloatingInput" readonly value ="{{Auth::user()->email}}">
                                    <label for="emailfloatingInput">E-mail</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="text" name ="name" class="form-control" id="lastnamefloatingInput" autocomplete="off" placeholder="Entrer votre nom" value ="{{Auth::user()->name}}">
                                    <label for="lastnamefloatingInput">Nom <strong style='color: red;'> *</strong></label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="text"  name ="prenom" class="form-control" id="lastprenomfloatingInput" autocomplete="off" placeholder="Entrer votre prénom(s)" value ="{{Auth::user()->prenom}}">
                                    <label for="lastprenomfloatingInput">Prénom(s) <strong style='color: red;'> *</strong></label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="text"  name ="tel_user" class="form-control" id="telephonefloatingInput" autocomplete="off" placeholder="Entrer votre téléphone" value ="{{Auth::user()->tel_user}}">
                                    <label for="telephonefloatingInput">Téléphone <strong style='color: red;'> *</strong></label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="text"  name ="grade" class="form-control" id="gradefloatingInput" autocomplete="off" placeholder="Entrer votre grade" value ="{{Auth::user()->grade}}">
                                    <label for="gradefloatingInput">Grade <strong style='color: red;'> *</strong></label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="text"  name ="echellon" class="form-control" id="echellonfloatingInput" autocomplete="off" placeholder="Entrer votre échellon" value ="{{Auth::user()->echellon}}">
                                    <label for="echellonfloatingInput">Echellon <strong style='color: red;'> *</strong></label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="date"  name ="date_nais" class="form-control" id="telephonefloatingInput" autocomplete="off" placeholder="Entrer votre date de naissaance" value ="{{Auth::user()->date_nais}}">
                                    <label for="date_naisfloatingInput">Date de naissance <strong style='color: red;'> *</strong></label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="date"  name ="date_embauche" class="form-control" id="date_embauchefloatingInput" autocomplete="off" placeholder="Entrer votre date d'embauche" value ="{{Auth::user()->date_embauche}}">
                                    <label for="date_embauchefloatingInput">Date d'embauche <strong style='color: red;'> *</strong></label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="date" name ="date_retraite" class="form-control" id="date_retraitefloatingInput" readonly autocomplete="off" value ="{{Auth::user()->date_retraite}}">
                                    <label for="date_retraitefloatingInput">Date de retraite</label>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-floating">
                                    <input type="text"  name ="other_infos_user" class="form-control" id="otherfloatingInput" autocomplete="off" placeholder="Pourrions-nous avoir autre informations sur votre personne" value ="{{Auth::user()->other_infos_user}}">
                                    <label for="otherfloatingInput">Autres informations <strong style='color: red;'> *</strong></label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary rounded-pill">Mise à jour profil</button>
                                </div>
                            </div>
                        </div>
                        <button  type="submit" class="  center-block" style="display:none" ></button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Changement du mot de passe</h4>
                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md icon-demo-content">
                    <i class=" ri-lock-password-fill"></i>
                    </div>
                </div>
            </div><!-- end card header -->
            <div class="card-body">
                <p class="text-muted"></p>
                <div class="live-preview">
                    {!! Form::open(array('url' => 'updatemdp','method' => 'POST','enctype' => 'multipart/form-data','id' => 'formProfil','novalidate'=>'novalidate')) !!}
                        @if(session()->has('error'))
                            <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                                <strong>Erreur</strong> - {{session()->get('error')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session()->has('success'))
                            <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                <strong>Infos</strong> - {{session()->get('success')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="password" name ="old"  autocomplete="off" class="form-control" id="passwordfloatingInput" placeholder="Enter your password">
                                    <label for="passwordfloatingInput">Ancien mot de passe</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="password" name ="new" autocomplete="off" class="form-control" id="passwordfloatingInput" placeholder="Enter your password">
                                    <label for="passwordfloatingInput">Nouveau mot de passe</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="password" name ="confirm" autocomplete="off" class="form-control" id="passwordfloatingInput1" placeholder="Confirm password">
                                    <label for="passwordfloatingInput1">Confirmer le mot de passe</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary rounded-pill">Mise à jour du mot de passe</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('JS_content')

<script src="{{url('assets/js/jquery.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
</script>

<script type="text/javascript">

    $(function() {
        
        $('#profile-img-file-input').on('change',function(){
            var fileInput=this;
            if(fileInput.files[0]){
                var reader=new FileReader();
                reader.onload = function(e){
                    $('#img').attr('src',e.target.result);
                }
                reader.readAsDataURL(fileInput.files[0]);
                $('.center-block').click();
            }
        });
    });
</script>
@endsection