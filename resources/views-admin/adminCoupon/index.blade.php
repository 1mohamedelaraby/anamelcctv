@extends('multiauth::adminLayouts.app')
@section('css')
<link href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('title', 'كوبونات الخصم')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">كوبونات الخصم</span>
@endsection

@section('pagetitle','كوبونات الخصم')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.shop.coupon.create') }}" class="btn btn-outline-success">
        <i class="fa fa-plus-circle"></i>
        أضافة كوبون
    </a>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">كوبونات الخصم</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class=" bg-info">
                                <th class="fit">#</th>
                                <th>الكود</th>
                                <th class="">النوع</th>
                                <th class="">الخصم</th>
                                <th class="noSort noSearch"></th>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                <tr>
                                    <td class="fit">{{ $coupon->id }}</td>
                                    <td class="">{{ $coupon->code }}</td>
                                    <td class="">{{ $coupon->getType() }}</td>
                                    <td class="">{{ $coupon->coupon->value }} {{ $coupon->coupon->discountType }}</td>
                                    <td class="fit">
                                        <form action="{{ route('admin.shop.coupon.destroy', $coupon->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @permitTo('UpdateCoupon')
                                            <a href="{{ route('admin.shop.coupon.edit',[$coupon->id]) }}" class="text-info">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <span class="mx-1"></span>
                                            @endpermitTo
                                            @permitTo('DeleteCoupon')
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