@extends('multiauth::adminLayouts.app')
@section('title', 'اضافة مستخدم')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<a class="breadcrumb-item" href="">المستخدمين</a>
<span class="breadcrumb-item active">اضافة مستخدم</span>
@endsection

@section('pagetitle','أضافة مستخدم')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-body-title">بيانات المستخدم</h6>
            <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

            <form action="{{ route('admin.register.submit') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">الاسم كامل <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                    @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email" class="form-control-label">البريد الألكتروني <span class="text-danger">*</span> </label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                    @if ($errors->has('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password" class="form-control-label">كلمة المرور <span class="text-danger">*</span> </label>
                    <input type="password" class="form-control" id="password" name="password" />
                    @if ($errors->has('password'))
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-control-label">تكرار كلمة المرور <span class="text-danger">*</span> </label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
                    @if ($errors->has('password_confirmation'))
                    <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">أضافة مستخدم</button>
                    <a href="" class="btn btn-info pull-right">عودة</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection