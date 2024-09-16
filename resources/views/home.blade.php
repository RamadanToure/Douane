@extends('layouts.general')

@section('content')
<div class="">
    <div class="container-fluid">
        <div class="row project-wrapper">
            <div class="col-xxl-12">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                            <i class="ri-file-line text-white"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                            Courrier non traité</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                    data-target="{{$courrierNonTraiteCount}}">0</span></h4>
                                        </div>
                                        <!-- <p class="text-muted text-truncate mb-0">Projects this month</p> -->
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
                                            <i class="ri-file-line text-white"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-medium text-muted mb-3">Courrier non tranmis</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                    data-target="{{$courrierNonTranmis}}">0</span></h4>
                                        </div>
                                        <!-- <p class="text-muted mb-0">Leads this month</p> -->
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info text-info rounded-2 fs-2">
                                            <i class="ri-file-line text-white"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                            Total courrier</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                    data-target="{{$CourrierTotalRecu}}">0</span></h4>
                                        </div>
                                        <!-- <p class="text-muted text-truncate mb-0">Work this month</p> -->
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->

            </div><!-- end col -->


            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="card-title mb-0">Liste des courriers non traités</h4>
                    </div><!-- end cardheader -->
                    <div class="card-body pt-0">
                        <div class="upcoming-scheduled">
                            <input type="text" class="form-control" data-provider="flatpickr"
                                data-date-format="d M, Y" data-deafult-date="today" data-inline-date="true">
                        </div>
                        @if(count($courrierNonTraiteData) != 0)

                            <?php $i=0;?>
                            <h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted">Statistiques </h6>
                            @foreach($courrierNonTraiteData as $list)
                                <?php $i++; ?>
                                <div class="mini-stats-wid d-flex align-items-center mt-3">
                                    <div class="flex-shrink-0 avatar-sm">
                                        <span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4">
                                            {{$i}}
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Sujet : {{$list->sujet_cour.' Réf :'.$list->ref_cour.' '.date('d/m/Y',strtotime($list->date_rece))}} </h6>
                                        <p class="text-muted mb-0">{{isset($list->expediteur) ? $list->expediteur->nom_expe : trans('data.not_found')}}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        Ajouté le <p class="text-muted mb-0">{{date('d/m/Y',strtotime($list->created_at))}} <span class="text-uppercase"></span></p>
                                    </div>
                                </div><!-- end -->
                            @endforeach
                            <div class="mt-3 text-center">
                                <a href="{{url('listcourrieratraiter')}}" class="text-muted text-decoration-underline">Voir tous les courriers non traités</a>
                            </div>
                        @else
                            <div Class="alert alert-info"><strong>Info! </strong> {!!trans('data.AucunInfosTrouve')!!} </div>
                        @endif
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
@endsection
