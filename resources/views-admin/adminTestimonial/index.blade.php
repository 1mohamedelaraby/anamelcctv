@extends('multiauth::adminLayouts.app')
@section('css')
<link href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('title', 'قالوا عنا')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">قالوا عنا</span>
@endsection

@section('pagetitle','قالوا عنا')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.testimonial.create') }}" class="btn btn-outline-success">
        <i class="fa fa-plus-circle"></i>
        أضافة مقولة
    </a>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">قالوا عنا</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class=" bg-info">
                                <th class="fit">#</th>
                                <th>الاسم</th>
                                <th>اللوجو</th>
                                <th>التقييم</th>
                                <th>الحالة</th>
                                <th class="noSort noSearch"></th>
                            </thead>
                            <tbody>
                                @foreach($googleReviews as $testimonial)
                                <tr class="{{ ! $testimonial->status ? 'bg-warning' : '' }}">
                                    <td class="fit">{{ $testimonial->id }}</td>
                                    <td class="">{{ $testimonial->author_name }}</td>
                                    <td class="fit"><img src="{{ $testimonial->profile_photo_url }}" alt="" height="50px"></td>
                                    <td class="fit">{{ $testimonial->rating }}</td>
                                    <td class="fit">{{ $testimonial->status ? 'منشور' : 'مخفي' }}</td>
                                    <td class="fit">
                                        <form action="{{ route('admin.testimonial.destroy', $testimonial->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @permitTo('UpdateTestimonial')
                                            <a href="{{ route('admin.testimonial.edit',[$testimonial->id]) }}" class="text-info">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <span class="mx-1"></span>
                                            @endpermitTo
                                            @permitTo('DeleteTestimonial')
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