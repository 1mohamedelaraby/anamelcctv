@extends('multiauth::adminLayouts.app')
@section('css')
<link href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('title', 'الاعلانات')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">الاعلانات</span>
@endsection

@section('pagetitle','الاعلانات')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.adv.create') }}" class="btn btn-outline-success">
        <i class="fa fa-plus-circle"></i>
        أضافة اعلان
    </a>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">الاعلانات</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class=" bg-info">
                                <th class="fit">#</th>
                                <th>الاسم</th>
                                <th>النوع</th>
                                <th>الرابط</th>
                                <th class="noSort noSearch"></th>
                            </thead>
                            <tbody>
                                @foreach($advs as $adv)
                                <tr>
                                    <td class="fit">{{ $adv->id }}</td>
                                    <td class="">{{ $adv->title }}</td>
                                    <td class="">{{ $adv->type ? 'يسار' : 'يمين' }}</td>
                                    <td class="">{{ $adv->url }}</td>
                                    <td class="fit">
                                        <form action="{{ route('admin.adv.destroy', $adv->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('admin.adv.edit',[$adv->id]) }}" class="text-info">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <span class="mx-1"></span>
                                            <button type="submit" class="btn-link text-danger delete pointer" onclick="return confirm('سيتم الحذف نهائياً. للاستمرار أضغط OK')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function(){
            $('.table').DataTable( {
                "order": [[ 0, "desc" ]],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "iDisplayLength": 25,
                "stateSave": true,
                "autoWidth": false,
                "language": {
                    "url": '{{ asset('lang/ar/DataTable.json') }}'
                },
                "columnDefs": [
                    { sortable: false, targets: ['noSort'] },
                    { searchable: false, targets: ['noSearch'] },
                ]
            } );
        });


</script>
@endsection