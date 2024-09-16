<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
    <table class="table table-striped table-bordered table-nowrap">
        <thead>
            <tr>
                <th scope="col">{{trans('data.created_at')}}</th>
                <th scope="col">{{trans('data.id_user')}}</th>
                <th scope="col">{{trans('data.libelle_trace')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $listgiwu)
                <tr>
                    <td>{{date('d/m/Y',strtotime($listgiwu->created_at))}}</td>
                    <td>{{isset($listgiwu->users_g) ? $listgiwu->users_g->name.' '.$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
					<td>{!! $listgiwu->libelle_trace !!}</td>
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
