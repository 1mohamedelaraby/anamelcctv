@extends('multiauth::adminLayouts.app')
@section('title', 'المدينة')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">المدينة</span>
@endsection

@section('pagetitle','المدينة')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-body-title">بيانات المدينة</h6>
            <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

            <form action="{{ route('admin.shop.city.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">اسم المدينة <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="shipping_cost" class="form-control-label">تكلفة الشحن <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="shipping_cost" name="shipping_cost" value="{{ old('shipping_cost', 0) }}">
                    @if ($errors->has('shipping_cost'))
                    <p class="text-danger">{{ $errors->first('shipping_cost') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <a href="{{ route('admin.shop.city.index') }}" class="btn btn-info pull-right">عودة</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection