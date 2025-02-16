<html>
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        @yield('title')
        <link href="{{ asset('eshopper/css/bootstrap.min.css') }} " rel="stylesheet">
        <link href="{{ asset('eshopper/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('eshopper/css/prettyPhoto.css') }}" rel="stylesheet">
        <link href="{{ asset('eshopper/css/price-range.css') }}" rel="stylesheet">
        <link href="{{ asset('eshopper/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('eshopper/css/main.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('/eshopper/images/home/logoweb.png') }}">
        @yield('css')
    </head>
    <body> 
        @include('user.components.header')
        @if(session('success'))
            <div style="text-align: center;" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="text-align: center;" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')

        @include('user.components.footer')
        
        <script src="{{ asset('eshopper/js/jquery.js') }}"></script>
        <script src="{{ asset('eshopper/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('eshopper/js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{ asset('eshopper/js/price-range.js') }}"></script>
        <script src="{{ asset('eshopper/js/jquery.prettyPhoto.js') }}"></script>
        <script src="{{ asset('eshopper/js/main.js') }}"></script>
        @yield('js')
    </body>
</html>