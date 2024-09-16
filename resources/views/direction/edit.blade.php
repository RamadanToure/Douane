<meta name='csrf-token' content='{{csrf_token()}}'>

<div class="modal-content">
	<div class="modal-header card-header"><h5 class="modal-title" id="varyingcontentModalLabel"><i class="{{$icone}}"></i>  {{$titre}}</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
		<div class="modal-body"><strong><div class="msgAction"></div></strong>
			<form id="formaActionUp" class="needs-validation"  method="post" novalidate >
				@csrf()
				@method('PATCH')
				{!! Form::hidden('id_direc',$item->id_direc,['id'=>'id_direc']) !!}
				<div class="row">
					<div class="col-md-6">
						<div class="mb-3">
							<label for="code_direc" class="form-label">{!!trans('data.code_direc')!!} <strong style='color: red;'> *</strong></label>
							{!! Form::text('code_direc',$item->code_direc,["id"=>"code_direc","class"=>"form-control" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Sigle" ]) !!}
							<span class="text-danger" id="code_direcError"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label for="lib_direc" class="form-label">{!!trans('data.lib_direc')!!} <strong style='color: red;'> *</strong></label>
							{!! Form::text('lib_direc',$item->lib_direc,["id"=>"lib_direc","class"=>"form-control" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Direction" ]) !!}
							<span class="text-danger" id="lib_direcError"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label for="respo_id" class="form-label">{!!trans('data.respo_id')!!} <strong style='color: red;'> *</strong></label>
							<?php $addUse = array(''=>'S&eacute;lectionnez un &eacute;l&eacute;ment'); $listrespo_id = $addUse + $listrespo_id->toArray();?>
							{!! Form::select('respo_id',$listrespo_id ,$item->respo_id,["id"=>"respo_id","class"=>"form-select allselect"]) !!}
							<span class="text-danger" id="respo_idError"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark waves-effect waves-light rounded-pill" data-bs-dismiss="modal">Femer</button>
					@if(in_array('update_direction',session('InfosAction')))
						<button id="validerup" type="button"  class="btn btn-primary btn-label right btn-load rounded-pill" onclick="UpdateAction();">
							<span class="d-flex align-items-center"><span class="flex-grow-1 me-2">Modifier</span><span class="flex-shrink-0" role="status"></span></span>
							<i class="ri-add-line label-icon align-middle fs-16 ms-2"></i>
						</button>
					@endif
				</div>
			</form>
		</div>
	</div>

<script type="text/javascript"> $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); </script>

<script type="text/javascript">
	function UpdateAction(){

		$('#validerup').attr("disabled",!0);
		$('#validerup .flex-shrink-0').addClass("spinner-border");
		$("div.msgAction").html('').hide(200);
		$('#code_direcError').addClass('d-none');
		$('#lib_direcError').addClass('d-none');
		$('#respo_idError').addClass('d-none');
		var formup = $('#formaActionUp')[0];
		var id_direc = $('#id_direc').val();
		var data = new FormData(formup);
		let url_ = "{{route('direction.update',':id')}}";
		url_ = url_.replace(':id',id_direc);

		$.ajax({
			type: 'POST',url: url_,
			enctype:'multipart/form-data',data: data,processData: false,contentType: false,
			success: function(data) {
				$('#validerup').attr("disabled",!1);
				$('#validerup .flex-shrink-0').removeClass("spinner-border");
				if(data.response==1){
					$("div.msgAction").html('<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Enregistrement r&eacute;ussi. </div>').show(200);
					window.location.reload();
				}else if(data.response==0){
					$("div.msgAction").html('<div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Echec de l\'enregistrement</strong> '+data.message+'</div>').show(200);
				}else{
					$.each(data.response, function(Key, value){
						var ErrorID = '#'+Key+'Error';
						$(ErrorID).removeClass('d-none');
						$(ErrorID).text(value);
					})
				}
			},error: function(data) {}
		});
	}
</script>

