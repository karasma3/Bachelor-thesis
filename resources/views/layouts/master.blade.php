<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>SH Pinec</title>
    {{--<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">--}}

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    {{--<link href="/css/blog.css" rel="stylesheet">--}}

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    {{--<link href="/css/sticky-footer-navbar.css" rel="stylesheet">--}}
</head>

<body>

@include('layouts.nav')
@if($flash = session('message'))
    <div class="alert alert-success" role="alert">
        {{ $flash }}
    </div>
@endif
@if($flash = session('fail'))
    <div class="alert alert-danger" role="alert">
        {{ $flash }}
    </div>
@endif



<div class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            @yield('content')


        </div><!-- /.blog-main -->

        @include('layouts.sidebar')

    </div><!-- /.row -->

</div><!-- /.container -->

@include('layouts.footer')

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script src="{{ mix('js/app.js') }}"></script>

@yield('scripts')

</body>
</html>
