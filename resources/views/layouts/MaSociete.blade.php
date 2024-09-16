@extends('layouts.general')

@section('path_content')
	@if(sizeof($pathMenu) != 0)
		@for($i=0; $i < count($pathMenu); $i++)
            <li class="breadcrumb-item active"><a href="{{$pathMenu[$i]['lien']}}" class="kt-subheader__breadcrumbs-link">{{$pathMenu[$i]['titre']}}</a></li>
		@endfor
	@endif
@stop

@section('content')


<!--  -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Information sur la société</h4>
                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md icon-demo-content">
                    <i class="{{$icone}}"></i>
                    </div>
                </div>
            </div><!-- end card header -->
            <div class="card-body">
                <p class="text-muted"></p>
                <div class="live-preview">
                    {!! Form::open(array('class' => 'kt-form','url' => 'mysociety/updatepage','method' => 'POST','enctype' => 'multipart/form-data','id' => 'formProfil','novalidate'=>'novalidate')) !!}
                        
                        @if(session()->has('infos'))
                            <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                <i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> - {{session()->get('infos')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <h5 class="card-title mb-0 flex-grow-1">Logo</h5>
                        <div class="text-center"> 
                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                <img src="{{'assets/docs/logos/'.$societe->logo_soc}}" id="img" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input type="file" id="profile-img-file-input" name="logo" class="profile-img-file-input">
                                    <label for="profile-img-file-input"
                                        class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="nom_soc" id="firstnamefloatingInput" value="{{$societe->nom_soc}}" placeholder="Société">
                                    <label for="firstnamefloatingInput">Société</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="text" name="contact_soc"  value="{{$societe->contact_soc}}"  class="form-control" id="lastnamefloatingInput" autocomplete="off" placeholder="Contact">
                                    <label for="lastnamefloatingInput">Contact</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="anneretraitefloatingInput"  name="anneretraite" value="{{$societe->anneretraite}}">
                                    <label for="anneretraitefloatingInput">Année de retraite</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="emailfloatingInput"  name="mail_soc" value="{{$societe->mail_soc}}">
                                    <label for="emailfloatingInput">E-mail</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="adressefloatingInput" name="adres_soc"  value="{{$societe->adres_soc}}">
                                    <label for="adressefloatingInput">Adresse</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="file" class="form-control" style="width:100%" name="customFile"  id="customFile">
                                    <label for="lastprenomfloatingInput">Manuel d'utilisation (Fichier PDF)</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <label class="form-control"> {{(isset($societe->pdf_aide) ? $societe->pdf_aide : 'Aucun fichier attaché.' )}}</label>
                                    <label for="lastprenomfloatingInput">Nom fichier :</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <textarea class="form-control"  id="otherfloatingInput" placeholder="Pieds de page" name="pied_soc" rows="5">{{$societe->pied_page_soc}}</textarea>
                                    <label for="otherfloatingInput">Pied de page</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary rounded-pill">Mettre à jour les informations</button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="center-block" style="display:none" ></button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!--  -->


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