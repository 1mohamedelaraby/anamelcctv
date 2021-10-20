@extends('multiauth::adminLayouts.app')
@section('title', 'من نحن')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">من نحن</span>
@endsection

@section('pagetitle','من نحن')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-body-title">بيانات من نحن</h6>
            <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

            <form action="{{ route('admin.about.update') }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="about" class="form-control-label">نبذه تعريفية <span class="text-danger">*</span> </label>
                    <textarea rows="15" class="form-control" id="about" name="about">{{ old('about', @$about->about) }}</textarea>
                    @if ($errors->has('about'))
                    <p class="text-danger">{{ $errors->first('about') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="vision" class="form-control-label">رؤيتنا <span class="text-danger">*</span> </label>
                    <textarea rows="10" class="form-control" id="vision" name="vision">{{ old('vision', @$about->vision) }}</textarea>
                    @if ($errors->has('vision'))
                    <p class="text-danger">{{ $errors->first('vision') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="mession" class="form-control-label">رسالتنا <span class="text-danger">*</span> </label>
                    <textarea rows="10" class="form-control" id="mession" name="mession">{{ old('mession', @$about->mession) }}</textarea>
                    @if ($errors->has('mession'))
                    <p class="text-danger">{{ $errors->first('mession') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="maner" class="form-control-label">قيمنا <span class="text-danger">*</span> </label>
                    <textarea rows="10" class="form-control" id="maner" name="maner">{{ old('maner', @$about->maner) }}</textarea>
                    @if ($errors->has('maner'))
                    <p class="text-danger">{{ $errors->first('maner') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="goals" class="form-control-label">اهدافنا <span class="text-danger">*</span> </label>
                    <textarea rows="15" class="form-control" id="goals" name="goals">{{ old('goals', @$about->goals) }}</textarea>
                    @if ($errors->has('goals'))
                    <p class="text-danger">{{ $errors->first('goals') }}</p>
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

@section('script')
<script src="//cdn.ckeditor.com/4.9.2/basic/ckeditor.js"></script>

<script>
    let options = {
            filebrowserImageBrowseUrl: '/admin/filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/admin/filemanager?type=Files',
            filebrowserUploadUrl: '/admin/filemanager/upload?type=Files&_token={{ csrf_token() }}',
            language: '{{ app()->getLocale() }}'
        };
        CKEDITOR.replace('goals', options);
</script>
@endsection