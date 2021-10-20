@extends('multiauth::adminLayouts.app')
@section('title', 'الفيديوهات')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">الفيديوهات</span>
@endsection

@section('pagetitle','الفيديوهات')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-body-title">بيانات الفيديوهات</h6>
            <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

            <form action="{{ route('admin.videos.update', $video->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title" class="form-control-label">عنوان الفيديو <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $video->title) }}">
                    @if ($errors->has('title'))
                    <p class="text-danger">{{ $errors->first('title') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="slug" class="form-control-label">الاسم في المتصفح <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $video->slug) }}">
                    @if ($errors->has('slug'))
                    <p class="text-danger">{{ $errors->first('slug') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="video_category_id" class="form-control-label">القسم <span class="text-danger">*</span> </label>
                    <select class="form-control" id="video_category_id" name="video_category_id">
                        <option value="">اختر قسم</option>
                        @foreach ($categories as $item)
                        <option value="{{ $item->id }}" {{ old('video_category_id', $video->video_category_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('video_category_id'))
                    <p class="text-danger">{{ $errors->first('video_category_id') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description" class="form-control-label">الوصف</label>
                    <textarea rows="15" class="form-control editor" id="description" name="description">{{ old('description', $video->description) }}</textarea>
                    @if ($errors->has('description'))
                    <p class="text-danger">{{ $errors->first('description') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="url" class="form-control-label">رابط اليوتيوب <span class="text-danger">*</span> </label>
                    <input type="url" class="form-control" id="url" name="url" value="{{ old('url', $video->url) }}" />
                    @if ($errors->has('url'))
                    <p class="text-danger">{{ $errors->first('url') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <a href="{{ route('admin.videos.index') }}" class="btn btn-info pull-right">عودة</a>
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