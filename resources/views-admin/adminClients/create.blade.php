@extends('multiauth::adminLayouts.app')
@section('title', 'عملائنا')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">عملائنا</span>
@endsection

@section('pagetitle','عملائنا')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-body-title">بيانات عملائنا</h6>
            <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

            <form action="{{ route('admin.client.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">اسم العميل <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="url" class="form-control-label">رابط العميل</label>
                    <input type="url" class="form-control" id="url" name="url" value="{{ old('url') }}">
                    @if ($errors->has('url'))
                    <p class="text-danger">{{ $errors->first('url') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="logo" class="form-control-label">شعار العميل </label>
                    <input type="file" class="form-control" id="logo" name="logo" />
                    @if ($errors->has('logo'))
                    <p class="text-danger">{{ $errors->first('logo') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="order" class="form-control-label">ترتيب الظهور <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="order" name="order" value="{{ old('order', $order) }}">
                    @if ($errors->has('order'))
                    <p class="text-danger">{{ $errors->first('order') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="is_menu" class="form-control-label">يظهر في الرئيسة <span class="text-danger">*</span> </label>
                    <select class="form-control" id="is_menu" name="is_menu">
                        <option value="1" {{ old('is_menu') == 1 ? 'selected' : '' }}>ظاهر</option>
                        <option value="0" {{ old('is_menu') === '0' ? 'selected' : '' }}>مخفي</option>
                    </select>
                    @if ($errors->has('is_menu'))
                    <p class="text-danger">{{ $errors->first('is_menu') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <a href="{{ route('admin.client.index') }}" class="btn btn-info pull-right">عودة</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection