<style>
    .cart-badge {
    background-color: #f39c12;
    color: white;
    border-radius: 50%;
    padding: 3px 7px; /* Giảm kích thước padding để badge nhỏ hơn */
    font-size: 12px; /* Giảm kích thước chữ */
    position: absolute;
    top: -10px; /* Nhích lên trên 10px */
    right: -18px; /* Canh sang bên phải một chút */
    z-index: 10;
}

</style>

<header id="header">
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> {{ getConfigValueFromSettingTable('phone') }}</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> {{ getConfigValueFromSettingTable('email') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ getConfigValueFromSettingTable('fb_link') }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ getConfigValueFromSettingTable('x_link') }}"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="header-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="/"><img src="/eshopper/images/home/logoweb.png" style="width: 70px; height: auto;" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ route('user.orders') }}" role="button">
                                    <i class="fa fa-crosshairs"></i> Hóa đơn
                                </a>
                            </li>
                            @auth
                                <li><a href="#"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a></li>
                            @endauth
                            <li>
                                <a href="{{ route('showCart') }}" style="position: relative;">
                                    <i class="fa fa-shopping-cart"></i> Giỏ hàng 
                                    <span class="badge cart-badge">
                                        @if(Auth::check())
                                            {{ Auth::user()->cartItems->sum('quantity') }}  <!-- Hiển thị số lượng từ cơ sở dữ liệu -->
                                        @else
                                            0  <!-- Nếu chưa đăng nhập, hiển thị 0 -->
                                        @endif
                                    </span>
                                </a>
                            </li>
                            @if(Auth::check())
                                <!-- Nếu đã đăng nhập, hiển thị "Logout" -->
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#" role="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                            @else
                                <!-- Nếu chưa đăng nhập, hiển thị "Login" -->
                                <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    @include('user.components.main_menu')
                </div>
                
            </div>
        </div>
    </div>
</header>

@section('js')
<script src="{{ asset('users/cart/cart.js') }}"></script>
@endsection