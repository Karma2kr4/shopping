<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="/home" class="brand-link">
    <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Administration</span>
</a>

<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('adminlte/dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div> 
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @can('category-list')
            <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Danh mục sản phẩm</p>
                </a>
            </li>
            @endcan

            <!-- <li class="nav-item">
                <a href="{{ route('menus.index') }}" class="nav-link {{ request()->routeIs('menus.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Menu</p>
                </a>
            </li> -->
            @can('product-list')
            <li class="nav-item">
                <a href="{{ route('product.index') }}" class="nav-link {{ request()->routeIs('product.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Sản phẩm</p>
                </a>
            </li>
            @endcan
            @can('slider-list')
            <li class="nav-item">
                <a href="{{ route('slider.index') }}" class="nav-link {{ request()->routeIs('slider.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Slider</p>
                </a>
            </li>
            @endcan
            @can('setting-list')
            <li class="nav-item">
                <a href="{{ route('settings.index') }}" class="nav-link {{ request()->routeIs('settings.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Settings</p>
                </a>
            </li>
            @endcan
            @can('user-list')
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Danh sách nhân viên</p>
                </a>
            </li>
            @endcan
            @can('role-list')
            <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Danh sách vai trò</p>
                </a>
            </li>
            @endcan
            <!-- cứng dữ liệu phân quyền -->
            @if(Auth::check() && (Auth::user()->id == 1 || Auth::user()->id == 2))
            <li class="nav-item">
                <a href="{{ route('orders.index') }}" class="nav-link {{ request()->routeIs('orders.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Quản lý hóa đơn</p>
                </a>
            </li>
            @endif

            @if(Auth::check() && (Auth::user()->id == 1))
            <li class="nav-item">
                <a href="{{ route('permissions.create') }}" class="nav-link {{ request()->routeIs('permissions.create') ? 'active' : '' }}">
                    <p>Tạo dữ liệu phân quyền</p>
                </a>
            </li>
            @endif

        </ul>
    </nav>
</div>
</aside>