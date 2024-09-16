<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
    <table class="table table-striped table-bordered table-nowrap">
        <thead>
            <tr>
                <th scope="col">{{trans('data.matricule')}}</th>
                <th scope="col">{{trans('data.name')." ".trans('data.prenom')}}</th>
                <th scope="col">{{trans('data.email')}}</th>
                <th scope="col">{{trans('data.tel_user')}}</th>
                <th scope="col">{{trans('data.lib_role')}}</th>
                <th scope="col">{{trans('data.id_fonct')}}</th>
                <th scope="col" class="text-center">{{trans('data.is_active')}}</th>
                @if(in_array('update_user',session('InfosAction')) || in_array('delete_user',session('InfosAction')))
                    <th class="text-center"> Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($list as $listgiwu)
                <tr>
                    <td>{{$listgiwu->matricule}}</td>
                    <td>{{$listgiwu->name." ".$listgiwu->prenom}}</td>
                    <td>{{$listgiwu->email}}</td>
                    <td>{{$listgiwu->tel_user}}</td>
                    <td>{{isset($listgiwu->role) ? $listgiwu->role->libelle_role : trans('data.not_found')}}</td>
                    <td>{{trans('entite.type_destinataire')[$listgiwu->type_fonct].' : '.$listgiwu->fonction($listgiwu->type_fonct,$listgiwu->id_fonct)}}</td>
                    <td class="text-center">
                        @if($listgiwu->is_active == 1)<span class="badge bg-success">Activé</span> @else <span class="badge bg-danger">Désactivé</span> @endif
                    </td>
                    @if(in_array('update_user',session('InfosAction')) || in_array('delete_user',session('InfosAction')))
                        <td class="text-center">
                            @if(in_array('update_user',session('InfosAction')))
                            <a href="{{route('users.edit', $listgiwu->id)}}" title='Modifier' class="btn btn-success btn-sm  waves-effect waves-light"><i class="ri-edit-2-line"></i></a>

                            @endif
                            @if(in_array('delete_user',session('InfosAction')))
                                <button type="button"  title='Supprimer' data-id="{{$listgiwu->code}}" class="btn btn-danger btn-sm  waves-effect waves-light btn-delete" data-bs-toggle="modal" ><i class="ri-delete-bin-6-line"></i></button>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach

        </tbody>
    </table>
    {!! $list->appends([
        'query'=>(isset($_GET['query'])?$_GET['query']:'')
        ])->links() !!}
@else
	<div class="alert alert-info"><strong>Info! </strong> {!!trans('data.AucunInfosTrouve')!!} </div>
@endif
