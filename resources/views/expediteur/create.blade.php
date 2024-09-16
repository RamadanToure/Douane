<meta name='csrf-token' content='{{csrf_token()}}'>

<div class="modal-content">
	<div class="modal-header card-header"><h5 class="modal-title" id="varyingcontentModalLabel"><i class="{{$icone}}"></i>  {{$titre}}</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
		<div class="modal-body"><strong><div class="msgAction"></div></strong>
			<form id="formAction" class="needs-validation"  method="post" novalidate >
				@csrf()
				<div class="row">
					<div class="col-md-6">
						<div class="mb-3">
							<label for="type_expe" class="form-label">{!!trans('data.type_expe')!!} <strong style='color: red;'> *</strong></label>
							{!! Form::select('type_expe',trans('entite.type_expediteur') ,session('type_expeSess'),["id"=>"type_expe","class"=>"form-select allselect"]) !!}
							<span class="text-danger" id="type_expeError"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label for="nom_expe" class="form-label">{!!trans('data.nom_expe')!!} <strong style='color: red;'> *</strong></label>
							{!! Form::text('nom_expe','',["id"=>"nom_expe","class"=>"form-control" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Nom" ]) !!}
							<span class="text-danger" id="nom_expeError"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label for="adres_expe" class="form-label">{!!trans('data.adres_expe')!!} </label>
							{!! Form::text('adres_expe','',["id"=>"adres_expe","class"=>"form-control" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Adresse" ]) !!}
							<span class="text-danger" id="adres_expeError"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label for="email_expe" class="form-label">{!!trans('data.email_expe')!!} <strong style='color: red;'> *</strong></label>
							{!! Form::text('email_expe','',["id"=>"email_expe","class"=>"form-control" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer E-mail" ]) !!}
							<span class="text-danger" id="email_expeError"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark waves-effect waves-light rounded-pill" data-bs-dismiss="modal">Femer</button>
					@if(in_array('add_expediteur',session('InfosAction')))
						<button id="valider" type="button"  class="btn btn-primary btn-label right btn-load rounded-pill" onclick="addAction();">
							<span class="d-flex align-items-center"><span class="flex-grow-1 me-2">Ajouter</span><span class="flex-shrink-0" role="status"></span></span>
							<i class="ri-add-line label-icon align-middle fs-16 ms-2"></i>
						</button>
					@endif
				</div>
			</form>
		</div>
	</div>

<script type="text/javascript"> $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); </script>

<script type="text/javascript">
	function addAction(){

		$('#valider').attr("disabled",!0);
		$('#valider .flex-shrink-0').addClass("spinner-border");
		$("div.msgAction").html('').hide(200);
		$('#type_expeError').addClass('d-none');
		$('#nom_expeError').addClass('d-none');
		$('#adres_expeError').addClass('d-none');
		$('#email_expeError').addClass('d-none');
		var form = $('#formAction')[0];
		var data = new FormData(form);
		$.ajax({
			type: 'POST',url: '{{ url("/expediteur/")}}',
			enctype:'multipart/form-data',data: data,processData: false,contentType: false,
			success: function(data) {
				$('#valider').attr("disabled",!1);
				$('#valider .flex-shrink-0').removeClass("spinner-border");
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

