@extends('multiauth::adminLayouts.app')
@section('css')
<link href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('title', 'جديدنا')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">جديدنا</span>
@endsection

@section('pagetitle','جديدنا')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.news.create') }}" class="btn btn-outline-success">
        <i class="fa fa-plus-circle"></i>
        أضافة خبر
    </a>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">جديدنا</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class=" bg-info">
                                <th class="fit">#</th>
                                <th>العنوان</th>
                                <th>الصورة</th>
                                <th class="noSort noSearch"></th>
                            </thead>
                            <tbody>
                                @foreach($news as $news)
                                <tr>
                                    <td class="fit">{{ $news->id }}</td>
                                    <td class="">{{ $news->title }}</td>
                                    <td class="fit">
                                        @if ($news->media->count())
                                        {{ $news->media->first()('thumb') }}
                                        @endif
                                    </td>
                                    <td class="fit">
                                        <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @permitTo('UpdateNews')
                                            <a href="{{ route('admin.news.edit',[$news->id]) }}" class="text-info">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <span class="mx-1"></span>
                                            @endpermitTo
                                            @permitTo('DeleteNews')
                                            <button type="submit" class="btn-link text-danger delete pointer" onclick="return confirm('سيتم الحذف نهائياً. للاستمرار أضغط OK')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endpermitTo
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