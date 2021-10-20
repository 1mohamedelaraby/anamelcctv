@extends('multiauth::adminLayouts.app')
@section('title', 'مجالاتنا')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">مجالاتنا</span>
@endsection

@section('pagetitle','مجالاتنا')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-body-title">بيانات مجالاتنا</h6>
            <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

            <form action="{{ route('admin.service.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">اسم المجال <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="slug" class="form-control-label">الاسم في الرابط <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                    @if ($errors->has('slug'))
                    <p class="text-danger">{{ $errors->first('slug') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="short_desc" class="form-control-label">وصف مختصر <code>يظهر في القائمة</code> <span class="text-danger">*</span></label>
                    <textarea rows="5" class="form-control" id="short_desc" name="short_desc">{{ old('short_desc') }}</textarea>
                    @if ($errors->has('short_desc'))
                    <p class="text-danger">{{ $errors->first('short_desc') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="definition" class="form-control-label">التعريف بالمجال <span class="text-danger">*</span></label>
                    <textarea rows="5" class="editor form-control" id="definition" name="definition">{{ old('definition') }}</textarea>
                    @if ($errors->has('definition'))
                    <p class="text-danger">{{ $errors->first('definition') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="usage" class="form-control-label">مجالات الاستخدام <span class="text-danger">*</span></label>
                    <textarea rows="5" class="editor form-control" id="usage" name="usage">{{ old('usage') }}</textarea>
                    @if ($errors->has('usage'))
                    <p class="text-danger">{{ $errors->first('usage') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="images" class="form-control-label">صور المجال <span class="text-danger">*</span> </label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple />
                    <p class="mt-1 mb-0 small text-info">يمكن اختيار اكثر من صورة باستخدام زر <kbd>CTRL</kbd> او <kbd>Command</kbd>.</p>
                    <p class="mt-1 mb-0 small text-info">يفضل اختيار صور بأمتداد <code>jpg</code> وان تكون جميع الصور بأبعاد موحدة.</p>
                    @if ($errors->has('images'))
                    <p class="text-danger">{{ $errors->first('images') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="is_menu" class="form-control-label">حالة الظهور في القائمة <span class="text-danger">*</span></label>
                    <select class="form-control" id="is_menu" name="is_menu">
                        <option value="1" {{ old('is_menu') == 1 ? 'selected' : '' }}>ظاهر</option>
                        <option value="0" {{ old('is_menu') === "0" ? 'selected' : '' }}>مخفي</option>
                    </select>
                    @if ($errors->has('is_menu'))
                    <p class="text-danger">{{ $errors->first('is_menu') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="order" class="form-control-label">الترتيب <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="order" name="order" value="{{ old('order', $order) }}">
                    @if ($errors->has('order'))
                    <p class="text-danger">{{ $errors->first('order') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <a href="{{ route('admin.service.index') }}" class="btn btn-info pull-right">عودة</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
<script>
    $('#name').keyup(function(){
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