<div class="modal-content">
	<div class="modal-body text-center p-4">
		<div class="mt-2">
			<h4 class="mb-3 red-g" > {{trans('data.titre_delete')}} <i class="bx bxs-trash"></i></h4>
			<p class="text-muted mb-4"> Voulez-vous vraiment supprimer {{$item->lib_divi}} ? </p>
			<form  action="{{route('division.destroy',$item->id_divi)}}" method="POST">
					@method('DELETE')
					@csrf()
				<button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Non</button>
				<button id="submit" class="btn btn-danger rounded-pill">Oui</button>
			</form>
			<div class="hstack gap-2 justify-content-center"></div>
		</div>
	</div>
</div>
