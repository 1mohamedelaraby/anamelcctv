@extends('multiauth::adminLayouts.app')
@section('title', 'قالوا عنا')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">قالوا عنا</span>
@endsection

@section('pagetitle','قالوا عنا')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-body-title">بيانات قالوا عنا</h6>
            <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

            <form action="{{ route('admin.testimonial.update', $googleReview->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="author_name" class="form-control-label">اسم الجهة <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" id="author_name" name="author_name" value="{{ old('author_name', $googleReview->author_name) }}">
                    @if ($errors->has('author_name'))
                    <p class="text-danger">{{ $errors->first('author_name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="profile_photo_url" class="form-control-label">رابط صورة بروفايل جوجل <span class="text-danger">*</span> </label>
                    <input type="url" class="form-control" id="profile_photo_url" name="profile_photo_url" value="{{ old('profile_photo_url', $googleReview->profile_photo_url) }}">
                    @if ($errors->has('profile_photo_url'))
                    <p class="text-danger">{{ $errors->first('profile_photo_url') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="text" class="form-control-label">النص <span class="text-danger">*</span> </label>
                    <textarea rows="15" class="form-control" id="text" name="text">{{ old('text', $googleReview->text) }}</textarea>
                    @if ($errors->has('text'))
                    <p class="text-danger">{{ $errors->first('text') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="rating" class="form-control-label">التقييم <span class="rating-danger">*</span> </label>
                    <select class="form-control" id="rating" name="rating">
                        <option value="">اختر تقييم</option>
                        <option value="1" {{ old('rating', $googleReview->rating) == 2?'selected':'' }}>2</option>
                        <option value="3" {{ old('rating', $googleReview->rating) == 3?'selected':'' }}>3</option>
                        <option value="4" {{ old('rating', $googleReview->rating) == 4?'selected':'' }}>4</option>
                        <option value="5" {{ old('rating', $googleReview->rating) == 5?'selected':'' }}>5</option>
                    </select>
                    @if ($errors->has('rating'))
                    <p class="text-danger">{{ $errors->first('rating') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="status" class="form-control-label">الحالة <span class="status-danger">*</span> </label>
                    <select class="form-control" id="status" name="status">
                        <option value="0" {{ old('status', $googleReview->status) == 0?'selected':'' }}>غير منشور</option>
                        <option value="1" {{ old('status', $googleReview->status) == 1?'selected':'' }}>منشور</option>
                    </select>
                    @if ($errors->has('status'))
                    <p class="text-danger">{{ $errors->first('status') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <a href="{{ route('admin.testimonial.index') }}" class="btn btn-info pull-right">عودة</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection