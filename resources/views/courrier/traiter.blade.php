
<meta name="csrf-token" content="{{csrf_token()}}">

<div class="modal-content">
	<div class="modal-header card-header">
		<h5 class="modal-title" id="varyingcontentModalLabel">Traiter le courrier : {{$item->ref_cour}} </h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<strong><div class="msgAction"></div></strong>
		<form id="formAction" class="needs-validation" novalidate enctype='multipart/form-data'>
			{!! Form::hidden('id_cour',$item->id_cour,["class"=>"form-control"]) !!}
			@csrf()
			<div class="col-md-12">
				<div class="mb-3">
					<label for="fichier_reponse" class="form-label">{!!trans('data.fichier_reponse')!!} <strong style='color: red;'> *</strong></label>
					<input class="form-control" type="file" id="fichier_reponse" name="fichier_reponse" required>
					<span class="text-danger" id="fichier_reponseError"></span>
				</div>
			</div>
			<div>
				<label for="recipient-name" class="col-form-label"> {{trans('data.note_trce')}} <strong style='color: red;'>(*)</strong></label>
				{!! Form::textarea('note_trce','',["id"=>"note_trce","class"=>"form-control","style"=>"height: 100px;",'placeholder'=>"Entrer une note",'autocomplete'=>'off']) !!}
				<span class="text-danger" id="note_trceError"></span>
			</div>
			<div class="form-check form-switch form-switch-info my-2" <?php echo ($type_fonct!='dr' ? "style='display:none;'" : '')?>>
				<input class="form-check-input" type="checkbox" name="envoyer_courrier" role="switch" id="SwitchCheck6">
				<label class="form-check-label" for="SwitchCheck6">Envoyer la réponse à l'expéditeur {{isset($item->expediteur)?$item->expediteur->nom_expe:'--'}}</label>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Fermer</button>
				<button id="valider" type="button"  class="btn btn-success btn-load  rounded-pill" onclick="TraiterAction();"> 
					<span class="d-flex align-items-center">
						<span class="flex-grow-1 me-2">Traiter</span>
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

	function TraiterAction(){

		$('#valider').attr("disabled",!0);
		$('#valider .flex-shrink-0').addClass("spinner-border");
		$("div.msgAction").html('').hide(200);
		$('#note_trceError').addClass('d-none');
		$('#fichier_reponseError').addClass('d-none');
		var form = $('#formAction')[0];
		var data = new FormData(form);
		let url_ = '{{url("courrier/actionTraiter")}}';
		$.ajax({
			type: 'POST',url: url_,
			enctype:'multipart/form-data',data: data,processData: false,contentType: false,
			success: function(data) {
				$('#valider').attr("disabled",!1);
				$('#valider .flex-shrink-0').removeClass("spinner-border");
				if(data.response!=1){
					$.each(data.response, function(Key, value){var ErrorID = '#'+Key+'Error';$(ErrorID).removeClass('d-none');$(ErrorID).text(value);})
				}else{
					$("div.msgAction").html('<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Avis motivé ajouté avec succès </div>').show(200);
					window.location.reload();
				}
			},
			error: function(data) {}
		});
	}
</script>
