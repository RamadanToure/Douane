<div class="modal-content">
	<div class="modal-body text-center p-4">
		<div class="mt-2">
			<h4 class="mb-3" >Voulez-vous vraiment transmettre le courrier à l'expéditeur {{$expediteur}} ?</h4>
			<br>
			<form action="{{url('courrier/confirmer/'.$item->id_cour)}}" method="POST">
				@csrf()
				<button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Non</button>
				<button id="submit" class="btn btn-warning rounded-pill">Oui</button>
			</form>
			<div class="hstack gap-2 justify-content-center"></div>
		</div>
	</div>
</div>
