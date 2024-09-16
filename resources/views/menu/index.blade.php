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
        <div class="card"  id="ticketsList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1"><i class="{{$icone}} m-2"></i>{{$titre}}</h5>
                    <div class="flex-shrink-0"> 
                        @if(in_array('add_menu',session('InfosAction')))
                            <a class="btn btn-primary btn-label right rounded-pill" href="{{route('menu.create')}}"><i class="ri-add-line label-icon align-middle fs-16 ms-2 rounded-pill"></i>Ajouter</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                {!! Form::open(array('id' => 'formSearch','class' => '', 'method' => 'GET')) !!}
                    <div class="row g-3">
                        <div class="d-flex justify-content-sm-end">
                            <div class="search-box">
                                {!! Form::text('query','',["id"=>"SearchUSer","class"=>"form-control search bg-light border-light",'onkeyup'=>"funcRecher()",'autocomplete'=>'off','placeholder'=>"Rechercher..."]) !!}
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
                    @if(session()->has('success') || session()->has('error'))
                        <div class="col-md-12 mt-2">
                            <div class="alert {{ session()->has('success') ? 'alert-success' : ''}} {{ session()->has('error') ? 'alert-danger' : ''}} alert-border-left alert-dismissible fade show" role="alert">
                                <i title ="{{session()->has('errorMsg')? session()->get('errorMsg') : '' }}"  class=" {{session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'}} me-3 align-middle"></i> <strong>Infos </strong> - {{session()->has('success') ? session()->get('success') : session()->get('error')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
            </div>
            
            <div class="card-body">
                <div id='dataRefresh' class="table-responsive table-card mb-4 m-2 giwuRefresh">
                    @include('menu.index-search')
                </div>
            </div>
        </div><!--end card-->
    </div><!--end col-->
    <!-- delete  -->
    <div>
        <div class="modal fade bs-example-modal-center" id="kt_delete_4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog" >
            <div class="modal-dialog modal-dialog-centered">
                
            </div>
        </div>
    </div>
    <!-- delete -->
    <!-- action -->
    <div>
        <div class="modal fade bs-example-modal-center" data-bs-backdrop="static" id="kt_action_4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog" >
            <div class="modal-dialog modal-dialog-scrollable"> <!-- modal-dialog-scrollable -->
                
            </div>
        </div>
    </div>
    <!-- action data-bs-backdrop="static" -->

@endsection

@section('JS_content')
    <script src="{{url('assets/js/jquery.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // $("body").on("click",".pagination a",function(event){
            //     event.preventDefault();
            //     if ( $(this).attr('href') != '#' ) {$("html, body").animate({ scrollTop: 0 }, "fast");$('div#dataRefresh').load($(this).attr('href'));}
            // });
            // Pagination
            $(document).on("click",".pagination a",function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_page(page);
            });
            function fetch_page(page){
                var dr = $("#formSearch").serialize();
                $.ajax({
                    url:"menu?page="+page,
                    data: dr,
                    type: 'GET',
                    success:function (data) {
                        $('#dataRefresh').html(data);
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                    }
                });
            }
        });

        //Fonction sur la recherche
        function funcRecher(){
            var filtreData = $("#formSearch").serialize();
            var SearchUSer = document.getElementById('SearchUSer').value;
            $("div#dataRefresh").html('<h3 class="col-xs-12 text-center kt-subheader__title" style="padding-top: 3em;">' +
                                        '<span class="spinner-border flex-shrink-0" role="status"> <span class="visually-hidden"></span></span></h3>');
            return $.ajax({
                url: '{{ url("/menu/")}}',data: filtreData,type: 'GET',
                success: function (e) {$('#dataRefresh').html(e);},
                error: function (data) {$('#dataRefresh').html('<div class="alert alert-danger" role="alert">Erreur dans la recherche!</div>');},
            });
        };
        $(document).on('click', '.btn-delete', function () {
			id = $(this).data("id");
			$.ajax({url : '{{ url("menu/AffichePopDelete/") }}/'+id,type : 'GET',dataType : 'html',
				success : function(code_html, statut){$("#kt_delete_4 .modal-dialog").html(code_html);$("#kt_delete_4").modal('show');}
			});
		});
        $(document).on('click', '.btn-action', function () {
			id = $(this).data("id");
			$.ajax({url : '{{ url("menu/AffichePopAction/") }}/'+id,type : 'GET',dataType : 'html',
				success : function(code_html, statut){$("#kt_action_4 .modal-dialog").html(code_html);$("#kt_action_4").modal('show');}
			});
		});
    </script>

@endsection