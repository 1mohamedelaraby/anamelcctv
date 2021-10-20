@extends('multiauth::adminLayouts.app')
@section('title', 'الاعدادت')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">الاعدادت</span>
@endsection

@section('pagetitle','الاعدادت')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-body-title">بيانات الاعدادت</h6>
            <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

            <form action="{{ route('admin.setting.update') }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name" class="form-control-label">اسم الموقع <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', @$setting->name) }}">
                    @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description" class="form-control-label">الوصف <span class="text-danger">*</span> </label>
                    <textarea rows="10" maxlength="1000" class="form-control" id="description" name="description">{{ old('description', @$setting->description) }}</textarea>
                    @if ($errors->has('description'))
                    <p class="text-danger">{{ $errors->first('description') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email" class="form-control-label">بريد التواصل <span class="text-danger">*</span> </label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', @$setting->email) }}">
                    @if ($errors->has('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="phone" class="form-control-label">رقم الهاتف <span class="text-danger">*</span> </label>
                    <input type="phone" class="form-control" id="phone" name="phone" value="{{ old('phone', @$setting->phone) }}">
                    @if ($errors->has('phone'))
                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="whatsApp" class="form-control-label">رقم الواتس <span class="text-danger">*</span> </label>
                    <input type="whatsApp" class="form-control" id="whatsApp" name="whatsApp" value="{{ old('whatsApp', @$setting->whatsApp) }}">
                    @if ($errors->has('whatsApp'))
                    <p class="text-danger">{{ $errors->first('whatsApp') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="facebook" class="form-control-label">فيسبوك <span class="text-danger">*</span> </label>
                    <input type="facebook" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', @$setting->facebook) }}">
                    @if ($errors->has('facebook'))
                    <p class="text-danger">{{ $errors->first('facebook') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="twitter" class="form-control-label">تويتر <span class="text-danger">*</span> </label>
                    <input type="twitter" class="form-control" id="twitter" name="twitter" value="{{ old('twitter', @$setting->twitter) }}">
                    @if ($errors->has('twitter'))
                    <p class="text-danger">{{ $errors->first('twitter') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="youtube" class="form-control-label">يوتيوب <span class="text-danger">*</span> </label>
                    <input type="youtube" class="form-control" id="youtube" name="youtube" value="{{ old('youtube', @$setting->youtube) }}">
                    @if ($errors->has('youtube'))
                    <p class="text-danger">{{ $errors->first('youtube') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="instagram" class="form-control-label">انستجرام <span class="text-danger">*</span> </label>
                    <input type="instagram" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', @$setting->instagram) }}">
                    @if ($errors->has('instagram'))
                    <p class="text-danger">{{ $errors->first('instagram') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="visits" class="form-control-label">عداد الزيارات ({{ @Storage::get('visits.txt') }}) </label>
                    <input type="visits" class="form-control" id="visits" name="visits" value="{{ old('visits') }}">
                    @if ($errors->has('visits'))
                    <p class="text-danger">{{ $errors->first('visits') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <a href="/" class="btn btn-info pull-right">عودة</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection