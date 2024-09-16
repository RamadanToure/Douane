
<div class="modal-content">
    <div class="modal-body text-center p-4">
        <div class="mt-2">
            <h4 class="mb-3 red-g" > {{trans('data.libelle_menu')}} <i class="bx bxs-trash"></i></h4>
            <p class="text-muted mb-4"> Voulez-vous vraiment supprimer {{$item->libelle_menu}} ? </p>
            <form  action="{{route('menu.destroy',$item->id_menu)}}" method="POST">
                    @method('DELETE')
                    @csrf()
                <button type="button" class="btn btn-light  rounded-pill" data-bs-dismiss="modal">Non</button>
                <button id="submit" class="btn btn-danger rounded-pill">Oui</button>
            </form>
            <div class="hstack gap-2 justify-content-center">
            </div>
        </div>
    </div>

</div>

