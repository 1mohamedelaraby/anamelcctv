@extends('multiauth::adminLayouts.app')
@section('title', 'الاعلانات')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">الاعلانات</span>
@endsection

@section('pagetitle','الاعلانات')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-body-title">بيانات الاعلانات</h6>
            <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

            <form action="{{ route('admin.adv.update', $adv->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title" class="form-control-label">العنوان</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $adv->title) }}">
                    @if ($errors->has('title'))
                    <p class="text-danger">{{ $errors->first('title') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="url" class="form-control-label">الرابط <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $adv->url) }}">
                    @if ($errors->has('url'))
                    <p class="text-danger">{{ $errors->first('url') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <p class="col-6">
                        <img src="{{ Storage::url('advs/'. $adv->type.'.jpg') }}" alt="" height="300">
                    </p>
                    <label for="img" class="form-control-label">صورة الاعلان <span class="text-danger">*</span> </label>
                    <input type="file" class="form-control" id="img" name="img" />
                    <p class="text-info">مقاس الاعلان:عرض 300px والارتفاع 570px</p>
                    @if ($errors->has('img'))
                    <p class="text-danger">{{ $errors->first('img') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="type" class="form-control-label">مكان الاعلان</label>
                    <select name="type" id="type" class="form-control">
                        <option value="0" {{ old('type', $adv->type) == 0?'selected':'' }}>يمين</option>
                        <option value="1" {{ old('type', $adv->type) == 1?'selected':'' }}>يسار</option>
                    </select>
                    @if ($errors->has('type'))
                    <p class="text-danger">{{ $errors->first('type') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <a href="{{ route('admin.adv.index') }}" class="btn btn-info pull-right">عودة</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('script')
<script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
<script>
    $('#title').keyup(function(){
        let value = $(this).val();
        let slug = getSlug(value);
        $('#slug').val(slug);
    });

    let options = {
        filebrowserImageBrowseUrl: '/admin/filemanager?type=Images',
        filebrowserImageUploadUrl: '/admin/filemanager/upload?type=Images&_token={{ csrf_token() }}',
        filebrowserBrowseUrl: '/admin/filemanager?type=Files',
        filebrowserUploadUrl: '/admin/filemanager/upload?type=Files&_token={{ csrf_token() }}',
        language: '{{ app()->getLocale() }}'
    };

    $('.editor').each(function(e){
        CKEDITOR.replace( this.id, options);
    });
</script>
@endsection