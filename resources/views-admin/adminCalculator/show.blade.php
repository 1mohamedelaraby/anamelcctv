@extends('multiauth::adminLayouts.app')
@section('title', 'طلب شراء')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">طلب شراء</span>
@endsection

@section('pagetitle','طلب شراء')

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.shop.calculator.update', $calculator->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">البيانات الاساسية</h5>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th class="fit">رقم الطلب</th>
                                    <td>{{ $calculator->id }}</td>
                                </tr>
                                <tr>
                                    <th class="fit">تاريخ الطلب</th>
                                    <td>{{ $calculator->created_at }}</td>
                                </tr>
                                <tr>
                                    <th class="fit">الاسم</th>
                                    <td>{{ $calculator->first_name .' '. $calculator->last_name }}</td>
                                </tr>
                                <tr>
                                    <th class="fit">البريد الإلكتروني</th>
                                    <td>{{ $calculator->email }}</td>
                                </tr>
                                <tr>
                                    <th class="fit">حالة الطلب</th>
                                    <td>{{ $calculator->status }}</td>
                                </tr>
                                <tr>
                                    <th class="fit">حالة السداد</th>
                                    <td>{{ $calculator->paid ? 'مسدد' : 'غير مسدد' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">بيانات الشحن</h5>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th class="fit">المدينة</th>
                                    <td colspan="3">{{ $calculator->city }}</td>
                                </tr>
                                <tr>
                                    <th class="fit">رقم الجوال</th>
                                    <td colspan="3">{{ $calculator->phone }}</td>
                                </tr>
                                <tr>
                                    <th class="fit">العنوان</th>
                                    <td colspan="3">{{ $calculator->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="mb-3">تفاصيل الطلب</h5>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>اسم الصنف</th>
                                    <th>السعر</th>
                                    <th>الكمية</th>
                                    <th>الاجمالي</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($calculator->details as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->qty * $item->price }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>التركيب</th>
                                    <td colspan="3">{{ $calculator->installment_method }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="mb-3">بيانات الفاتورة</h5>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>مصاريف الشحن</th>
                                    <td>{{ $calculator->shipping_cost }}</td>
                                </tr>
                                <tr>
                                    <th>مصاريف السداد</th>
                                    <td>{{ $calculator->payment_fee }}</td>
                                </tr>
                                <tr>
                                    <th>مصاريف التركيب</th>
                                    <td>{{ $calculator->installment_cost }}</td>
                                </tr>
                                <tr>
                                    <th>خصم</th>
                                    <td>{{ $calculator->discount }}</td>
                                </tr>
                                <tr class="bg-info text-white">
                                    <th class="text-white">الإجمالي</th>
                                    <td class="text-white">{{ $calculator->totalPrice }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('css')
<style>
    .fit {
        width: 1%;
        white-space: nowrap;
    }
</style>
@endsection