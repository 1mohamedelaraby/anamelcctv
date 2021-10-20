<!-- ##### SIDEBAR LOGO ##### -->
<div class="kt-sideleft-header">
    <div class="kt-logo"><a href="/" target="_blank">{{ config('app.name') }}</a></div>
    <div id="ktDate" class="kt-date-today"></div>
    <div class="input-group kt-input-search">
        <input type="text" class="form-control" placeholder="بحث ...">
        <span class="input-group-btn mg-0">
            <button class="btn"><i class="fa fa-search"></i></button>
        </span>
    </div><!-- input-group -->
</div><!-- kt-sideleft-header -->

<!-- ##### SIDEBAR MENU ##### -->
@php($routeName = Str::of(Route::currentRouteName())->explode('.'))
<div class="kt-sideleft">
    <label class="kt-sidebar-label">القائمة</label>
    <ul class="nav kt-sideleft-menu">
        {{--لوحة التحكم--}}
        <li class="nav-item">
            <a href="{{ route('admin.home') }}" class="nav-link {{ $routeName->contains('dashboard') ? 'active' : '' }}">
                <i class="fa fa-home"></i>
                <span>لوحة التحكم</span>
            </a>
        </li><!-- nav-item -->

        {{--ادارة المستخدمين--}}
        @admin('super')
        <li class="nav-item">
            <a href="" class="nav-link with-sub {{ $routeName->contains('roles')||$routeName->contains('role')||$routeName->contains('show') ? 'active' : '' }}">
                <i class="fa fa-users"></i>
                <span>إدارةالمستخدمين</span>
            </a>
            <ul class="nav-sub">
                <li class="nav-item"><a href="{{ route('admin.roles') }}"
                        class="nav-link {{ $routeName->contains('roles')||$routeName->contains('roles') ? 'active' : '' }}">الوظائف والصلاحيات</a></li>
                <li class="nav-item"><a href="{{ route('admin.show') }}" class="nav-link {{ $routeName->contains('show') ? 'active' : '' }} ">المستخدمين</a></li>
            </ul>
        </li><!-- nav-item -->
        @endadmin
        <li class="nav-item">
            <a href="" class="nav-link with-sub {{ $routeName->contains(LaraShop::getShopRouteName()) ? 'active' : '' }}">
                <i class="fa fa-shopping-bag"></i>
                <span>المتجر</span>
            </a>
            <ul class="nav-sub">
                @permitTo('ReadLarashopCategory')
                <li class="nav-item">
                    <a href="{{ route('admin.shop.category.index') }}" class="nav-link {{ $routeName->contains('category') ? 'active' : '' }}">
                        <i class="fa fa-bars"></i>
                        <span>الأقسام</span>
                    </a>
                </li>
                @endpermitTo
                @permitTo('ReadLarashopProduct')
                <li class="nav-item">
                    <a href="{{ route('admin.shop.product.index') }}" class="nav-link {{ $routeName->contains('product') ? 'active' : '' }}">
                        <i class="fa fa-th"></i>
                        <span>المنتجات</span>
                    </a>
                </li>
                @endpermitTo

                @permitTo('ReadCoupon')
                <li class="nav-item">
                    <a href="{{ route('admin.shop.coupon.index') }}" class="nav-link {{ $routeName->contains('coupon') ? 'active' : '' }}">
                        <i class="fa fa-gift"></i>
                        <span>كوبونات الخصم</span>
                    </a>
                </li>
                @endpermitTo

                @permitTo('ReadOrder')
                <li class="nav-item">
                    <a href="{{ route('admin.shop.order.index') }}" class="nav-link {{ $routeName->contains('order') ? 'active' : '' }}">
                        <i class="fa fa-cart-arrow-down"></i>
                        <span>طلبات الشراء</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.shop.calculator.index') }}" class="nav-link {{ $routeName->contains('calculator') ? 'active' : '' }}">
                        <i class="fa fa-cart-arrow-down"></i>
                        <span>طلبات حاسبة المشاريع</span>
                    </a>
                </li>
                @endpermitTo

                @permitTo('ReadCity')
                <li class="nav-item">
                    <a href="{{ route('admin.shop.city.index') }}" class="nav-link {{ $routeName->contains('city') ? 'active' : '' }}">
                        <i class="fa fa-truck"></i>
                        <span>المدن والشحن</span>
                    </a>
                </li>
                @endpermitTo
            </ul>
        </li><!-- nav-item -->

        @permitTo('ReadNews')
        <li class="nav-item">
            <a href="{{ route('admin.news.index') }}" class="nav-link {{ $routeName->contains('news') ? 'active' : '' }}">
                <i class="fa fa-newspaper-o"></i>
                <span>احدث الأخبار</span>
            </a>
        </li><!-- nav-item -->
        @endpermitTo

        @permitTo('ReadService')
        <li class="nav-item">
            <a href="{{ route('admin.service.index') }}" class="nav-link {{ $routeName->contains('service') ? 'active' : '' }}">
                <i class="fa fa-briefcase"></i>
                <span>مجالاتنا</span>
            </a>
        </li><!-- nav-item -->
        @endpermitTo

        @permitTo('ReadBrand')
        <li class="nav-item">
            <a href="{{ route('admin.brand.index') }}" class="nav-link {{ $routeName->contains('brand') ? 'active' : '' }}">
                <i class="fa fa-star"></i>
                <span>البراندات</span>
            </a>
        </li><!-- nav-item -->
        @endpermitTo

        @permitTo('ReadClient')
        <li class="nav-item">
            <a href="{{ route('admin.client.index') }}" class="nav-link {{ $routeName->contains('client') ? 'active' : '' }}">
                <i class="fa fa-users"></i>
                <span>عملائنا</span>
            </a>
        </li><!-- nav-item -->
        @endpermitTo

        @permitTo('ReadTestimonial')
        <li class="nav-item">
            <a href="{{ route('admin.testimonial.index') }}" class="nav-link {{ $routeName->contains('testimonial') ? 'active' : '' }}">
                <i class="fa fa-comment"></i>
                <span>قالوا عنا</span>
            </a>
        </li><!-- nav-item -->
        @endpermitTo

        @permitTo('Updateabout')
        <li class="nav-item">
            <a href="{{ route('admin.about.index') }}" class="nav-link {{ $routeName->contains('about') ? 'active' : '' }}">
                <i class="fa fa-info-circle"></i>
                <span>من نحن</span>
            </a>
        </li><!-- nav-item -->
        @endpermitTo

        <li class="nav-item">
            <a href="" class="nav-link with-sub {{ $routeName->contains('videos')||$routeName->contains('videoCategory') ? 'active' : '' }}">
                <i class="fa fa-video-camera"></i>
                <span>الفيديوهات</span>
            </a>
            <ul class="nav-sub">
                <li class="nav-item"><a href="{{ route('admin.videoCategory.index') }}" class="nav-link {{ $routeName->contains('videoCategory') ? 'active' : '' }}">اقسام
                        الفيديوهات</a></li>
                <li class="nav-item"><a href="{{ route('admin.videos.index') }}" class="nav-link {{ $routeName->contains('videos') ? 'active' : '' }} ">الفيديوهات</a></li>
            </ul>
        </li><!-- nav-item -->
        <li class="nav-item">
            <a href="{{ route('admin.adv.index') }}" class="nav-link {{ $routeName->contains('adv') ? 'active' : '' }}">
                <i class="fa fa-bullhorn"></i>
                <span>الاعلانات</span>
            </a>
        </li><!-- nav-item -->
        @permitTo('UpdateSetting')
        <li class="nav-item">
            <a href="{{ route('admin.setting.index') }}" class="nav-link {{ $routeName->contains('setting') ? 'active' : '' }}">
                <i class="fa fa-gear"></i>
                <span>الاعدادات</span>
            </a>
        </li><!-- nav-item -->
        @endpermitTo
    </ul>
</div><!-- kt-sideleft -->