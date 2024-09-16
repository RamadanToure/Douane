
<meta name="csrf-token" content="{{csrf_token()}}">

<div class="modal-content">
	<div class="modal-header card-header">
		<h5 class="modal-title" id="varyingcontentModalLabel">Gérer les actions : {{$item->libelle_menu}}</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<strong><div class="msgAction"></div></strong>
		<form id="formAction" class="needs-validation" novalidate>
			{!! Form::hidden('id_menu',$item->id_menu,["class"=>"form-control"]) !!}
			@csrf()
			<div >
				<label for="recipient-name" class="col-form-label"> {{trans('data.libelle_action')}} <strong style='color: red;'>(*)</strong></label>
				{!! Form::text('libelle_action','',["id"=>"libelle_action","class"=>"form-control",'placeholder'=>"Entrer le libelle de l'action",'autocomplete'=>'off']) !!}
				<span class="text-danger" id="libelle_actionError"></span>
			</div>
			<div >
				<label for="recipient-name" class="col-form-label"> {{trans('data.dev_action')}} <strong style='color: red;'>(*)</strong></label>
				{!! Form::text('dev_action','',["id"=>"dev_action","class"=>"form-control",'placeholder'=>'Entrer le dev. action.','autocomplete'=>'off']) !!}
				<span class="text-danger" id="dev_actionError"></span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Femer</button>
				@if(in_array('add_action',session('InfosAction')))
					<button id="valider" type="button"  class="btn btn-warning btn-load  rounded-pill" onclick="addAction();"> 
						<span class="d-flex align-items-center">
							<span class="flex-grow-1 me-2">Ajouter</span>
							<span class="flex-shrink-0" role="status"></span>
						</span>
					</button>
					
				@endif
			</div>
			<!--  type="submit" -->
			<div class="form-group row">
				<h5 class="modal-title" id="exampleModalLabel">Liste des actions</h5>
			</div>
			<div class="form-group row">
				@if(count($listAction)!= 0)
					<table class="table table-nowrap table-striped">
						<thead>
							<tr>
								<th scope="col">{{trans('data.libelle_action')}}</th>
								<th scope="col">{{trans('data.dev_action')}}</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($listAction as $list)
							<tr class='tr-{{$list->id_action}}'>
								<td>{{$list->libelle_action}}</td>
								<td>{{$list->dev_action}}</td>
								<td>
									@if(in_array('delete_action',session('InfosAction')))
										<button type="button" class="close btn btn-danger btn-sm  waves-effect waves-light" data-id="{{$list->id_action}}" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true"><i class="ri-delete-bin-6-line"></i></span>
										</button>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				@else 
					<div class="alert alert-solid-dark alert-bold col-sm-12" role="alert">
						<div class="alert-text">Aucune action ajoutée à ce menu. </div>
					</div>
				@endif
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$.ajaxSetup({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
</script>
<script type="text/javascript">
	
	function addAction(){

		$('#valider').attr("disabled",!0);
		$('#valider .flex-shrink-0').addClass("spinner-border");
		$("div.msgAction").html('').hide(200);

		$('#libelle_actionError').addClass('d-none');
		$('#dev_actionError').addClass('d-none');
		$.ajax({
			type: 'POST',
			url: '{{ url("/menu/actionUpdate/")}}',
			data: $('#formAction').serialize(),
			success: function(data) {
				$('#valider').attr("disabled",!1);
				$('#valider .flex-shrink-0').removeClass("spinner-border");
				if(data.response!=1){
					$.each(data.response, function(Key, value){
						var ErrorID = '#'+Key+'Error';
						$(ErrorID).removeClass('d-none');
						$(ErrorID).text(value);
					})
				}else{
					$("div.msgAction").html('<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Enregistrement réussi. </div>').show(200);
					window.location.reload();
				}
			},
			error: function(data) {}
		});
	}
	
	$(document).on('click', '.close', function () {
		id = $(this).data('id');
		$("div.msgAction").html('').hide(200);
		$.ajax({
			url : '{{ url("menu/actionDelete")}}',
			dataType:"json", 
			type : 'POST',
			data: {id_action: id},
			success : function(data){
				if(data.response == 1){
					$('.tr-'+id).addClass('d-none');
					$("#varyingcontentModalLabel").animate({ scrollTop: 0 }, "fast");
					$("div.msgAction").html('<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Suppression réussie. </div>').show(200);
				}else{
					$("div.msgAction").html('<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Echec de suppression. </div>').hide(200);
				}
			},
			errors: function(){
				$("div.msgAction").html('<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Echec de suppression. </div>').hide(200);
			}
		});
	});
</script>
