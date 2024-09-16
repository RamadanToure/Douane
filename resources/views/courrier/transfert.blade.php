
<meta name="csrf-token" content="{{csrf_token()}}">

<div class="modal-content">
	<div class="modal-header card-header">
		<h5 class="modal-title" id="varyingcontentModalLabel">
			Transferer le courrier : {{$item->ref_cour}}
			<div <?php echo ($disabled=='enable' ? "style='display:none;'" : '')?>>
				vers {{$item->direction->lib_direc}}
			</div>
		</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<strong><div class="msgAction"></div></strong>
		<form id="formAction" class="needs-validation" novalidate>
			{!! Form::hidden('id_cour',$item->id_cour,["class"=>"form-control"]) !!}
			@csrf()
				<div <?php echo ($disabled!='enable' ? "style='display:none;'" : '')?>>
					<div class="row mb-3">
						<div class="col-6">
							<label for="priorite_cour" class="form-label">{!!trans('data.priorite_cour')!!} <strong style='color: red;'> *</strong></label>
							{!! Form::select('priorite_cour',trans('entite.priorite_courrier'),$priorite,["id"=>"priorite_cour","class"=>"form-select"]) !!}
							<span class="text-danger" id="priorite_courError"></span>
						</div>
						<div class="col-6">
							<label for="type_destina" class="form-label">{!!trans('data.type_destina')!!} <strong style='color: red;'> *</strong></label>
							{!! Form::select('type_destina',trans('entite.type_destinataire') ,$typeDest,["id"=>"type_destina","class"=>"form-select"]) !!}
							<span class="text-danger" id="type_destinaError"></span>
						</div>
					</div>
					<div>
						<label for="id_desti" class="form-label">{!!trans('data.id_desti')!!} <strong style='color: red;'> *</strong></label>
						{!! Form::select('id_desti',$destina,$idDest,["id"=>"id_desti","class"=>"form-select allselect","required"=>"required"]) !!}
						<span class="text-danger" id="id_destiError"></span>
					</div>
				</div>
			
			<div>
				<label for="recipient-name" class="col-form-label"> {{trans('data.note_trce')}} <strong style='color: red;'>(*)</strong></label>
				{!! Form::textarea('note_trce','',["id"=>"note_trce","class"=>"form-control","style"=>"height: 100px;",'placeholder'=>"Entrer une note",'autocomplete'=>'off']) !!}
				<span class="text-danger" id="note_trceError"></span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Fermer</button>
				
					<button id="valider" type="button"  class="btn btn-warning btn-load  rounded-pill" onclick="addAction();"> 
						<span class="d-flex align-items-center">
							<span class="flex-grow-1 me-2">Transferer</span>
							<span class="flex-shrink-0" role="status"></span>
						</span>
					</button>
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

	// Écoutez les changements dans le premier combo(combo1)
	document.getElementById("type_destina").addEventListener("change", function() {
		ChargeDestinataire();
	});

	function addAction(){

		$('#valider').attr("disabled",!0);
		$('#valider .flex-shrink-0').addClass("spinner-border");
		$("div.msgAction").html('').hide(200);

		$('#note_trceError').addClass('d-none');
		$('#priorite_courError').addClass('d-none');
		$('#type_destinaError').addClass('d-none');
		$('#id_destiError').addClass('d-none');
		$.ajax({
			type: 'POST',
			url: '{{ url("/courrier/actionTransfert/")}}',
			data: $('#formAction').serialize(),
			success: function(data) {
				$('#valider').attr("disabled",!1);
				$('#valider .flex-shrink-0').removeClass("spinner-border");
				if(data.response != 1){
					$.each(data.response, function(Key, value){
						var ErrorID = '#'+Key+'Error';
						$(ErrorID).removeClass('d-none');
						$(ErrorID).text(value);
					})
				}else{
					$("div.msgAction").html('<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Courrier transféré avec succès</div>').show(200);
					window.location.reload();
				}
			},
			error: function(data) {}
		});
	}
</script>
