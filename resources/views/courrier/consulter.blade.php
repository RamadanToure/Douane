
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
            <div class="m-2">
                @if(session()->has('success') || session()->has('error'))<div class="col-md-12 mt-2"><div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show" role="alert"><i title ="{!!session()->has('errorMsg')? session()->get('errorMsg') : '' !!}" class=" {!!session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'!!} me-3 align-middle"></i> <strong>Infos </strong> - {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>@endif
            </div>

            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{$titre}} ** Réf : {{$item->ref_cour}} ** Date de réception : {{date('d/m/Y à H:i:s',strtotime($item->date_rece))}}</h4>
                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md">
                        @if($item->statut_cour=='tr')
                            <button type="button"  title='Transmettre le courrier au destinataire' data-id="{{$item->code_cour}}" class="btn btn-warning btn-sm rounded-pill btn-confirmer" data-bs-toggle="modal" ><i class=" bx bx-share"></i> Transmettre le courrier</button>
                        @endif
                        <a type="button" href="{{url('listcourrieratraiter')}}" class="btn btn-dark btn-sm rounded-pill">Retour</a>
                    </div>
                </div>
            </div><!-- end card header -->
            <!-- Danger Alert -->
                <!-- <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label fade show" role="alert">
                    <i class="ri-error-warning-line label-icon"></i><strong>Rejet </strong> - Motif : --
                </div> -->
            <!-- Secondary Alert -->
            <div class="alert alert-success alert-dismissible alert-label-icon rounded-label fade show" role="alert">
                <i class="ri-notification-off-line label-icon"></i><strong>Information sur l'expédteur </strong> - {{$item->expediteur->nom_expe .' ** Type : '.trans('entite.type_expediteur')[$item->expediteur->type_expe]}}
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <!--end col-->
                    <!--end col-->
                    <div class="col-lg-4 col-6">
                        <p class="text-muted mb-2 text-uppercase fw-semibold">{{trans('data.email_expe')}}</p>
                        <h5 class="fs-14 mb-0"><span id="invoice-no">{{$item->expediteur->email_expe}}</span></h5>
                    </div>
                    <!--end col-->
                    <div class="col-lg-8 col-6">
                        <p class="text-muted mb-2 text-uppercase fw-semibold">{{trans('data.adres_expe')}}</p>
                        <span class="badge badge-soft-success fs-11" id="payment-status">{{$item->expediteur->adres_expe}}</span>
                    </div>
                </div>
            </div>
            
            <!-- Pièce jointes -->
            <div class="alert alert-primary alert-dismissible alert-label-icon rounded-label fade show" role="alert">
                <i class="ri-file-line label-icon"></i><strong>Détail sur le Courrier </strong> 
            </div>
            <div class=" align-items-center m-2 d-flex">
                <h4 class="card-title flex-grow-1">{{trans('data.sujet_cour')}} {{$item->sujet_cour}}</h4>
                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md">
                        <button class="btn btn-primary btn-sm rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="ri-eye-line"></i> Voir le courrier</button>
                    </div>
                </div>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row">
                    <!--end col-->
                    <div class="col-lg-6 col-12">
                        <p class="text-muted mb-2 text-uppercase fw-semibold">{{trans('data.commentaire_cour')}}</p>
                        <h5 class="fs-14 mb-0"><span id="total-amount">{{$item->commentaire_cour}}</span></h5>
                    </div>
                    <!--end col-->
                </div>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="card mb-0">
                    <div class="card-body">
                        <iframe style="width:100%;height: 600px;" src="{{url('/assets/courrier/'.$item->piece_jointe_cour.'#zoom=100%&navpanes=0')}}"></iframe>
                    </div>
                </div>
            </div>
            <!-- Info Alert -->
            <div class="alert alert-info alert-dismissible alert-label-icon rounded-label fade show" role="alert">
                <i class="ri-file-list-3-line label-icon"></i><strong>Parcours de traitement</strong>
            </div>
            @if(count($traceCourrier) != 0)
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                            <thead>
                                <tr class="table-active">
                                    <th scope="col" style="width: 50px;">N°</th>
                                    <th class="text-start">Transféré à</th>
                                    <th class="text-start">Par</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Fichier réponse</th>
                                </tr>
                            </thead>
                            <?php $i=0; ?>
                            <tbody id="products-list">
                                @foreach($traceCourrier as $line)
                                <?php $i++; ?>
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <td class="text-start">{{trans('entite.type_destinataire')[$line->type_destina].' : '.$line->fonction($line->type_destina,$line->id_desti)}}</td>
                                    <td class="text-start">{{isset($line->users_g) ? $line->users_g->name : '--'}}</td>
                                    <td>{{trans('entite.statut_courrier')[$line->etat_trce]}}</td>
                                    <td>
                                        @if($line->fichier_reponse)
                                            <button class="btn btn-primary btn-sm rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{$line->id_trce}}" aria-expanded="false" aria-controls="collapseExample{{$line->id_trce}}"><i class="ri-eye-line"></i> Voir la réponse</button>
                                        @else -- @endif
                                    </td>
                                </tr>
                                <div class="collapse" id="collapseExample{{$line->id_trce}}">
                                    {{trans('data.note_trce')}} : {{$line->note_trce}}
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <iframe style="width:100%;height: 600px;" src="{{url('/assets/courrier/'.$line->fichier_reponse.'#zoom=100%&navpanes=0')}}"></iframe>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                </div>
            @else 
                <div Class="alert alert-info m-4"><strong>Info! </strong> Aucun parcours tracé</div>
            @endif
        </div>
    </div>
	<div><div class="modal fade bs-example-modal-center" id="kt_confirmer_4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog" >
		<div class="modal-dialog modal-dialog-centered"></div>
	</div></div>
@endsection

@section('JS_content')
	<script src="{{url('assets/js/jquery.min.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
		
		$(document).on('click', '.btn-confirmer', function () {
			id = $(this).data("id");
			$.ajax({url : '{{ url("courrier/AffichePopConfirmerExp/") }}/'+id,type : 'GET',dataType : 'html',
				success : function(code_html, statut){$("#kt_confirmer_4 .modal-dialog").html(code_html);$("#kt_confirmer_4").modal('show');}
			});
		});
	</script>

@endsection
