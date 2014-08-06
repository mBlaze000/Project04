<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title','Task Manager')</title>
    
        <!-- Bootstrap core CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ URL::asset('styles/justified-nav.css') }}" type="text/css">
    
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="navbar-brand">Task Manager</span>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li id="home"><a href="/">Home</a></li>
                    <li id="all"><a href="/list/all">All Tasks</a></li>
                    <li id="completed"><a href="/list/completed">Complete</a></li>
                    <li id="open"><a href="/list/open">Open</a></li>
                    <li id="login">
                        @if(Auth::check())
                            <a href='/logout'>Logout {{ Auth::user()->name; }}</a>
                        @else 
                            <a href='/login'>Login</a>
                        @endif
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
    
    <div class="container">
        @if(Session::get('flash_message'))
        
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                {{ Session::get('flash_message') }}
            </div>        
        @endif

        <h1>@yield('title','Task Manager')</h1>
        @yield('body')
        
        <!-- Site footer -->
        <div class="footer">
            <p>&copy; James Burke - Project 04 - Dynamic Web Applications - Summer 2014</p>
        </div>
        
    </div><!-- /.container -->
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  
      <!-- Additional JavaScript
    ================================================== -->
  @yield('footer')
	<script type="text/javascript" src="{{ URL::asset('scripts/menu.js') }}"></script>

</body>
</html>
