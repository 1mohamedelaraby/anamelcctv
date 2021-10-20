@extends('multiauth::adminLayouts.app')
@section('title', 'اقسام الفيديوهات')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">اقسام الفيديوهات</span>
@endsection

@section('pagetitle','اقسام الفيديوهات')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-body-title">بيانات اقسام الفيديوهات</h6>
            <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

            <form action="{{ route('admin.videoCategory.update', $videoCategory->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="form-control-label">اسم القسم <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $videoCategory->name) }}">
                    @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">تعديل</button>
                    <a href="{{ route('admin.videoCategory.index') }}" class="btn btn-info pull-right">عودة</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection