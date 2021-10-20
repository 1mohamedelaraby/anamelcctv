@extends('multiauth::adminLayouts.app')
@section('title', 'البراندات')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">البراندات</span>
@endsection

@section('pagetitle','البراندات')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-body-title">بيانات البراندات</h6>
            <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

            <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">اسم البراند <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description" class="form-control-label">الوصف</label>
                    <textarea rows="15" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                    <p class="text-danger">{{ $errors->first('description') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="logo" class="form-control-label">شعار البراند <span class="text-danger">*</span> </label>
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
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <a href="{{ route('admin.brand.index') }}" class="btn btn-info pull-right">عودة</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection