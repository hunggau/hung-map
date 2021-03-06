<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ isset($title) ? $title . ' | ' : 'Trang chủ  | ' }}{{ config('myproject.sitename') }}</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="{{ url('/') }}/themes/clean-blog/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="{{ url('/') }}/themes/clean-blog/css/clean-blog.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/css/styles.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="{{ url('/') }}/themes/clean-blog/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <!--<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>-->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
<!--                <a class="navbar-brand" href="{{ url('/') }}">{{ config('myproject.sitename') }}</a>               
                <a class="navbar-brand small"><em>{{ config('myproject.slogan') }}</em></a>-->
                
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ url('/') }}">Blog</a>
                    </li>
<!--                    <li>
                        <a href="{{ url('/post/about.29') }}">About</a>
                    </li>                    -->
<!--                    <li>
                        <a href="{{ url('/contact') }}">Contact</a>
                    </li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{ url('/') }}/themes/clean-blog/img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1 class="mb-hilight mb-heading-name">{{ config('myproject.sitename') }}</h1>
                        <hr class="small">
                        <span class="subheading mb-hilight mb-heading-slogan">{{ config('myproject.slogan') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @yield('content')
            </div>
            
            @include('layouts.sidebar')
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; Your Website 2016</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ url('/') }}/themes/clean-blog/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('/') }}/themes/clean-blog/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="{{ url('/') }}/themes/clean-blog/js/jqBootstrapValidation.js"></script>
    <script src="{{ url('/') }}/themes/clean-blog/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="{{ url('/') }}/themes/clean-blog/js/clean-blog.min.js"></script>
    <script> BASE_URL = '{{url("/")}}';</script>
    @yield('script')
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script>
        $(document).ready(function(){
            $('img').addClass('img-responsive').addClass('mb-img');
        });
        
    </script>
</body>

</html>
