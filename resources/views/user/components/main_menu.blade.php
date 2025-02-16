<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li><a href="{{ route('home') }}" class="active">Home</a></li>
        @if(isset($categorysLimit) && count($categorysLimit) > 0)
            @foreach($categorysLimit as $categoryParent)
                <li class="dropdown">
                    <a href="#">{{ $categoryParent->name }}
                        <i class="fa fa-angle-down"></i>
                    </a>
                    @include('user.components.child_menu', ['categoryParent' => $categoryParent])
                </li>
            @endforeach
        @endif 
        <!-- loi xóa if  -->
        <li><a href="contact-us.html">Contact</a></li>
    </ul>
</div> 