<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!--<script src="{{ asset('public/js/app.js') }}" defer></script>-->
	<script src="{{URL::asset('public/js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/js/moment.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/js/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/js/fabric.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/js/datatable/jquery.dataTables.min.js')}}" type="text/javascript"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- fontawesome icon-->
    <link href="{{ URL::asset('public/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="{{ URL::asset('public/js/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/css/bootstrap-panel.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/css/simple-sidebar.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
	
        <!--<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> -->
		
		<div class="d-flex" id="wrapper">

			<!-- Sidebar -->
			<div class="bg-light border-right" id="sidebar-wrapper">
			  <div class="sidebar-heading">Badge Design </div>
			  <div class="list-group list-group-flush">
				<a href="{{ route('eventList') }}" class="list-group-item list-group-item-action bg-light">Events</a>
				<a href="{{ route('userTypes') }}" class="list-group-item list-group-item-action bg-light">User Types</a>
				<a href="{{ route('custom_fields_view') }}" class="list-group-item list-group-item-action bg-light">Custom Fields</a>
				<a href="{{ route('attendeeList') }}" class="list-group-item list-group-item-action bg-light">Attendees</a>
				<a href="{{ route('templateList') }}" class="list-group-item list-group-item-action bg-light">Templates</a>
			  </div>
			</div>
			<!-- /#sidebar-wrapper -->

			<!-- Page Content -->
			<div id="page-content-wrapper">

		<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
		<button class="" id="menu-toggle"><img src="{{ URL::asset('public/menubar.png')}}" height="30px" width="30px" /></button>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		  <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
			<!--<li class="nav-item active">
			  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="#">Link</a>
			</li>-->
			<li class="nav-item dropdown">
			  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Admin
			  </a>
			  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<!--<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>-->
				<a class="dropdown-item" href="{{ route('logout') }}"
			   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
										{{ __('Logout') }}
									</a>
				<!--<a class="dropdown-item" href="#">Another action</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">Something else here</a>-->
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
			  </div>
			</li>
		  </ul>
		</div>
		</nav>

				<div class="container-fluid">
					<main class="py-4">
						@include('flash-message')
						@yield('css')
						@yield('content')
					</main>
					@yield('page-script')
					</div>
				</div>
			<!-- /#page-content-wrapper -->

		</div>
		<!-- /#wrapper -->
    </div>
	<!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
</body>
</html>
