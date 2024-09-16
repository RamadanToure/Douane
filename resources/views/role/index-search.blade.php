<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
    <table class="table table-striped table-bordered table-nowrap">
        <thead>
            <tr>
                <th scope="col">{{trans('data.id_role')}}</th>
                <th scope="col">{{trans('data.libelle_role')}}</th>
                <th scope="col">{{trans('data.user_save_id')}}</th>
                @if(in_array('update_role',session('InfosAction')) || in_array('delete_role',session('InfosAction')) || in_array('add_action',session('InfosAction')))
                    <th class="text-center"> Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($list as $listgiwu)
                <tr>
                    <td>{{$listgiwu->id_role}}</td>
                    <td>{{$listgiwu->libelle_role}}</td>
                    <td>{{isset($listgiwu->users_g) ? $listgiwu->users_g->name.' '.$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
                    @if(in_array('update_role',session('InfosAction')) || in_array('delete_role',session('InfosAction')) || in_array('add_action',session('InfosAction')))
                        <td class="text-center">
                            @if(in_array('update_role',session('InfosAction')))
                                <a href="{{route('role.edit',$listgiwu->id_role)}}" title='Modifier' class="btn btn-success btn-sm  waves-effect waves-light"><i class="ri-edit-2-line"></i></a>
                            @endif
                            @if(in_array('delete_role',session('InfosAction')))
                                <button type="button"  title='Supprimer' data-id="{{$listgiwu->id_role}}" class="btn btn-danger btn-sm  waves-effect waves-light btn-delete" data-bs-toggle="modal" ><i class="ri-delete-bin-6-line"></i></button>
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
