@extends('multiauth::adminLayouts.app')
@section('title', 'احدث الأخبار')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">احدث الأخبار</span>
@endsection

@section('pagetitle','احدث الأخبار')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-body-title">بيانات احدث الأخبار</h6>
            <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

            <form action="{{ route('admin.news.update', $news->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title" class="form-control-label">اسم البراند <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $news->title) }}">
                    @if ($errors->has('title'))
                    <p class="text-danger">{{ $errors->first('title') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="slug" class="form-control-label">الاسم في الرابط <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $news->slug) }}">
                    @if ($errors->has('slug'))
                    <p class="text-danger">{{ $errors->first('slug') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <p class="col-6">
                        @if ($news->getMedia('image')->count())
                        {{ $news->getMedia('image')[0]()->lazy() }}
                        @endif
                    </p>
                    <label for="image" class="form-control-label">صورة المقال <span class="text-danger">*</span> </label>
                    <input type="file" class="form-control" id="image" name="image" />
                    @if ($errors->has('image'))
                    <p class="text-danger">{{ $errors->first('image') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="body" class="form-control-label">نص المقال <span class="text-danger">*</span> </label>
                    <textarea type="text" class="editor form-control" id="body" name="body">{{ old('body', $news->body) }}</textarea>
                    @if ($errors->has('body'))
                    <p class="text-danger">{{ $errors->first('body') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="featured" class="form-control-label">موضوع مميز <code>عند الاختيار سيظهر هذا الموضوع كعرض تقديمي لصفحة جديدنا</code></label>
                    <select name="featured" id="featured" class="form-control">
                        <option value="">اختر حالة</option>
                        <option value="0" {{ old('featured', $news->featured) == 0?'selected':'' }}>غير مميز</option>
                        <option value="1" {{ old('featured', $news->featured) == 1?'selected':'' }}>مميز</option>
                    </select>
                    @if ($errors->has('featured'))
                    <p class="text-danger">{{ $errors->first('featured') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-info pull-right">عودة</a>
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