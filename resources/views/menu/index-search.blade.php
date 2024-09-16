<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
    <table class="table table-striped table-bordered table-nowrap">
        <thead>
            <tr>
                <th scope="col">{{trans('data.menu_icon')}}</th>
                <th scope="col">{{trans('data.libelle_menu')}}</th>
                <th scope="col">{{trans('data.titre_page')}}</th>
                <th scope="col">{{trans('data.route')}}</th>
                <th scope="col">{{trans('data.architecture')}}</th>
                @if(in_array('update_menu',session('InfosAction')) || in_array('delete_menu',session('InfosAction')) || in_array('add_action',session('InfosAction')))
                    <th class="text-center"> Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($list as $listgiwu)
                <tr>
                    <td class="text-center icon-demo-content"><i class="{{$listgiwu->menu_icon}}"></i></td>
                    <td>{{$listgiwu->libelle_menu}}</td>
                    <td>{{$listgiwu->titre_page}}</td>
                    <td>{{$listgiwu->route}}</td>
                    <td>{{$listgiwu->architecture}}</td>
                    @if(in_array('update_menu',session('InfosAction')) || in_array('delete_menu',session('InfosAction')) || in_array('add_action',session('InfosAction')))
                        <td class="text-center">
                            @if(in_array('update_menu',session('InfosAction')))
                                <a href="{{route('menu.edit',$listgiwu->id_menu)}}" title='Modifier' class="btn btn-success btn-sm  waves-effect waves-light"><i class="ri-edit-2-line"></i></a>
                            @endif
                            @if(in_array('delete_menu',session('InfosAction')))
                                <button type="button"  title='Supprimer' data-id="{{$listgiwu->id_menu}}" class="btn btn-danger btn-sm  waves-effect waves-light btn-delete" data-bs-toggle="modal" ><i class="ri-delete-bin-6-line"></i></button>
                            @endif
                            @if(in_array('add_action',session('InfosAction')))
                                <button type="button" title='Actions' data-id="{{$listgiwu->id_menu}}" class="btn btn-sm btn-warning waves-effect waves-light btn-action"  data-toggle="modal"><i class="ri-add-line"></i></button>
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
