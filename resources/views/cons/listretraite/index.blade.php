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
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<ul class="nav nav-pills nav-customs nav-danger mb-3" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#border-navs-home" role="tab">Consulter la liste</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#border-navs-profile" role="tab">Consulter le graphe</a>
					</li>
				</ul><!-- Tab panes -->
				<div class="tab-content text-muted">
					<div class="tab-pane active" id="border-navs-home" role="tabpanel">
						<!--  -->
						<div class="col-lg-12">
							<div class="card"  id="ticketsList">
								<div class="card-header border-0">
									<div class="d-flex align-items-center"><h5 class="card-title mb-0 flex-grow-1"><i class="{{$icone}} m-2"></i>{{$titre}}</h5>
										<div class="flex-shrink-0">
											<div class="btn-group"><button type="button" class="btn btn-primary">Exporter</button>
												<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent"><span class="visually-hidden">Toggle Dropdown</span></button>
												<ul class="dropdown-menu" aria-labelledby="dropdownMenuReference">
													<li><a class="dropdown-item exporterXls" target="_blank" href="#">Excel</a></li>
													<li><a class="dropdown-item exporterPdf" target="_blank" href="#">PDF</a></li>
												</ul>
											</div>
												
										</div></div></div>
								<div class="card-body border border-dashed border-end-0 border-start-0">
									{!! Form::open(array('id' => 'formSearch','class' => '', 'method' => 'GET')) !!}
										{!! Form::hidden('id_giwu','4ver') !!}
										<div class="row gy-4">
											<!--end col Date-->
											<div class="col-xxl-3 col-md-4"> 
												<div><label for="labelInput" class="form-label">Date retraite d&eacute;but et fin</label>
													<div class='input-group'>
														{!! Form::text('date_embauchedeb',date('d/m/Y'),['id'=>'date_embauchedeb','onchange'=>'funcRecher()','class'=>'form-control','autocomplete'=>'off']) !!}
														<span class='input-group-text'> &agrave; </span>
														{!! Form::text('date_embauchefin',date('d/m/Y'),['id'=>'date_embauchefin','onchange'=>'funcRecher()','class'=>'form-control','autocomplete'=>'off']) !!}
													</div>
												</div>
											</div>
											<!--end col-->
											
											<!--end Recherche par defaut col-->
											<div class="col-xxl-3 col-md-4">
												<div><label for="placeholderInput" class="form-label">Rechercher </label>
													{!! Form::text('query','',["id"=>"SearchUSer","class"=>"form-control search ",'onkeyup'=>"funcRecher()",'autocomplete'=>'off','placeholder'=>"Rechercher..."]) !!}
												</div>
											</div>
										</div>
									{!! Form::close() !!}
									@if(session()->has('success') || session()->has('error'))<div class="col-md-12 mt-2"><div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show" role="alert"><i title ="{!!session()->has('errorMsg')? session()->get('errorMsg') : '' !!}" class=" {!!session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'!!} me-3 align-middle"></i> <strong>Infos </strong> - {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>@endif
								</div>
								<div class="card-body"><div id='dataRefresh' class="table-responsive table-card mb-4 m-2 giwuRefresh">@include('cons.listretraite.index-search')</div></div>
							</div><!--end card-->
						</div><!--end col-->
						<!--  -->
					</div>
					<div class="tab-pane" id="border-navs-profile" role="tabpanel">
						<!--  -->
						<!-- <div class="row"> -->
							<div class="col-12 col-sm-12">
								<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"> </script>
								<script type="text/javascript">
									google.charts.load("current", {packages:['corechart']});
									google.charts.setOnLoadCallback(drawChart);
									function drawChart() {
										var data = google.visualization.arrayToDataTable([
											["Titre", "Totals magistras", { role: 'annotation' }],
											@foreach($datas as $dat)
												['{{$dat->annee}}', {{$dat->total}},''],
											@endforeach
										]);
										var view = new google.visualization.DataView(data);
										view.setColumns([0, 1,
															{ calc: "stringify",
															sourceColumn: 1,
															type: "string",
															role: "annotation" },
															2,
															{ calc: "stringify",
															sourceColumn: 2,
															type: "string",
															role: "annotation" }
														]);
										var options = {
											title: "Statistique des magistras qui doivent aller à la retraite",
											height: 470,
											bar: {groupWidth: "50%"},
											legend: { position: "top" },
										};
										var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
										chart.draw(view, options);
									}
								</script>
								@if($datas)
									<div id="columnchart_values" class="chart" ></div>
								@else
									<div Class="alert alert-info"><strong>Info! </strong> {!!trans('data.AucunInfosTrouve')!!} pour afficher le graphe </div>
								@endif
								<br>
								<br>
							</div>
						<!-- </div> -->
						<!--  -->
					</div>
				</div>
			</div><!-- end card-body -->
		</div>
	</div>
	<!--end col-->
</div>


@endsection

@section('JS_content')
	<script src="{{url('assets/js/jquery.min.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".exporterXls").attr('href','{{url("listretraite/exporterExcel")}}');
			$(".exporterPdf").attr('href','{{url("listretraite/exporterPdf")}}');
			// Pagination
			$(document).on("click",".pagination a",function(event){
				event.preventDefault(); var page = $(this).attr('href').split('page=')[1]; fetch_page(page);
			});
			function fetch_page(page){
				var dr = $("#formSearch").serialize();
				$.ajax({ url:"listretraite?page="+page, data: dr, type: 'GET',
					success:function (data) { $('#dataRefresh').html(data); $("html, body").animate({ scrollTop: 0 }, "fast"); }
				});
			}
		});

		//Fonction sur la recherche
		function funcRecher(){
			window.idVar = '';
			var filtreData = $("#formSearch").serialize();
			$(".exporterXls").attr('href','{{url("listretraite/exporterExcel")}}?'+filtreData);
			$(".exporterPdf").attr('href','{{url("listretraite/exporterPdf")}}?'+filtreData);
			$("div#dataRefresh").html('<h3 class="col-xs-12 text-center kt-subheader__title" style="padding-top: 3em;">' +
										'<span class="spinner-border flex-shrink-0" role="status"> <span class="visually-hidden"></span></span></h3>');
			return $.ajax({
				url: '{{ url("/listretraite/")}}',data: filtreData,type: 'GET',
				success: function (e) {$('#dataRefresh').html(e);},
				error: function (data) {$('#dataRefresh').html('<div class="alert alert-danger" role="alert">Erreur dans la recherche!</div>');},
			});
		};
	</script>

@endsection

