<div class="card">
    <div class="card-body">
        <h6 class="card-body-title">بيانات الكوبون</h6>
        <p class="mg-b-20 mg-sm-b-30">برجاء التحقق من البيانات قبل الحفظ</p>

        <form action="{{ route('admin.shop.coupon.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="code" class="form-control-label">كود الكوبون <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" id="code" name="coupon[code]" value="{{ old('coupon.code') }}" wire:model="coupon.code">
                @if ($errors->has('coupon.code'))
                <p class="text-danger">{{ $errors->first('coupon.code') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="once" class="form-control-label">تكرار الكود <span class="text-danger">*</span> </label>
                <select class="form-control" id="once" name="coupon[once]" wire:model="coupon.once">
                    <option value="0" {{ old('coupon.once') == 0 ? 'selected' : '' }}>يمكن الاستخدام اكثر من مرة</option>
                    <option value="1" {{ old('coupon.once') == 1 ? 'selected' : '' }}>يستخدم مرة واحدة للمستخدم</option>
                </select>
                @if ($errors->has('coupon.once'))
                <p class="text-danger">{{ $errors->first('coupon.once') }}</p>
                @endif
            </div>

            @if (!$editCoupon)
            <div class="form-group">
                <label for="type" class="form-control-label">نوع الخصم <span class="text-danger">*</span> </label>
                <select class="form-control" id="type" name="coupon[type]" wire:model="coupon.type">
                    <option value="FixedCoupon" {{ old('coupon.type') == 'FixedCoupon' ? 'selected' : '' }}>خصم على اجمالي الطلب</option>
                    <option value="ShippingCoupon" {{ old('coupon.type') == 'ShippingDiscount' ? 'selected': '' }}>خصم على مصاريف الشحن</option>
                    <option value="CategoryCoupon" {{ old('coupon.type') == 'CategoryCoupon' ? 'selected' :'' }}>خصم على الاقسام</option>
                </select>
                @if ($errors->has('coupon.type'))
                <p class="text-danger">{{ $errors->first('coupon.type') }}</p>
                @endif
            </div>
            @endif

            @if ($coupon['type'] == 'FixedCoupon')
            <div class="form-group">
                <label for="value" class="form-control-label">الخصم <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" id="value" name="FixedCoupon[value]" wire:model="FixedCoupon.value">
                @if ($errors->has('FixedCoupon.value'))
                <p class="text-danger">{{ $errors->first('FixedCoupon.value') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="percent" class="form-control-label">نوع الخصم <span class="text-danger">*</span> </label>
                <select class="form-control" id="percent" name="FixedCoupon[percent]" wire:model="FixedCoupon.percent">
                    <option value="1">نسبة مئوية</option>
                    <option value="0">بالريال</option>
                </select>
                @if ($errors->has('FixedCoupon.percent'))
                <p class="text-danger">{{ $errors->first('FixedCoupon.percent') }}</p>
                @endif
            </div>
            @endif

            @if ($coupon['type'] == 'ShippingCoupon')
            <div class="form-group">
                <label for="value" class="form-control-label">نسبة الخصم <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" id="value" wire:model="ShippingCoupon.value">
                @if ($errors->has('ShippingCoupon.value'))
                <p class="text-danger">{{ $errors->first('ShippingCoupon.value') }}</p>
                @endif
            </div>
            @endif

            @if ($coupon['type'] == 'CategoryCoupon')
            <div class="form-group">
                <label for="value" class="form-control-label">الخصم <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" id="value" wire:model="CategoryCoupon.value">
                @if ($errors->has('CategoryCoupon.value'))
                <p class="text-danger">{{ $errors->first('CategoryCoupon.value') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="percent" class="form-control-label">نوع الخصم <span class="text-danger">*</span> </label>
                <select class="form-control" id="percent" name="CategoryCoupon[percent]" wire:model="CategoryCoupon.percent">
                    <option value="1">نسبة مئوية</option>
                    <option value="0">بالريال</option>
                </select>
                @if ($errors->has('CategoryCoupon.percent'))
                <p class="text-danger">{{ $errors->first('CategoryCoupon.percent') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="categoryType" class="form-control-label">يطبق الخصم على <span class="text-danger">*</span> </label>
                <select class="form-control" id="categoryType" name="CategoryCoupon[type]" wire:model="CategoryCoupon.type">
                    <option value="all">كل الاقسام</option>
                    <option value="in">اختيار اقسام محددة</option>
                    <option value="notIn">كل الأقسام ماعدا</option>
                </select>
                @if ($errors->has('CategoryCoupon.type'))
                <p class="text-danger">{{ $errors->first('CategoryCoupon.type') }}</p>
                @endif
            </div>

            @if ($CategoryCoupon['type'] != 'all')
            <div class="form-group">
                <label for="categoreiesSelect" class="form-control-label">اختار الاقسام <span class="text-danger">*</span> </label>
                <div wire:ignore>
                    <select class="select2 form-control" id="categoreiesSelect" wire:model="CategoryCoupon.categories" multiple>
                        <option value="" disabled readinly>اختر قسم</option>
                        {{ LaraShop::getCategoriesSelect() }}
                    </select>
                </div>
                @if ($errors->has('CategoryCoupon.categories'))
                <p class="text-danger">{{ $errors->first('CategoryCoupon.categories') }}</p>
                @endif
                @if ($editCoupon)
                @push('js')
                <script>
                    $(function(){
                        $('.select2').select2();
                        $('.select2').on('change', function (e) {
                            var data = $(this).select2("val");
                            @this.set('CategoryCoupon.categories', data);
                        });
                    })
                </script>
                @endpush
                @else
                <script>
                    $('.select2').select2();
                        $('.select2').on('change', function (e) {
                            var data = $(this).select2("val");
                            @this.set('CategoryCoupon.categories', data);
                        });
                </script>
                @endif
            </div>
            @endif
            @endif

            <div class="form-group mt-5">
                <hr>
                <button type="submit" class="btn btn-success" wire:click.prevent="save">حفظ</button>
                <a href="{{ route('admin.shop.coupon.index') }}" class="btn btn-info pull-right">عودة</a>
            </div>
        </form>
    </div>
</div>