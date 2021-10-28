<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name') }} | @yield('title')</title>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('assets/vendors/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/font-awesome-4.1.0/css/font-awesome.min.css')}}">
<style>
  .navbar-default {
    background-color: #f8f8f8;
    border-color: #e7e7e7;
    padding-top: 20px;
}
ul li{
  list-style-type: none;
  /* width: 50px; */
  padding: 5px;
  font-size: 16px;
}
ul.navbar-nav{
  margin-right: 50px;
}
.img-responsive{
  width:200px;
}
</style>
@section('extra-styles')
@show
  <body>
      <div class="container">
      <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
              data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{route('home')}}">{{ config('app.name') }}</a>
            </div>
          <form action="{{route('home')}}" class="form-inline pull-right">
                <input class="form-control mr-sm-2" type="search" 
                placeholder="Search with title" aria-label="Search" name="filter">
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
          </form>
          <ul class="navbar-nav mr-auto pull-right">
            @if(isset(Auth::user()->id) && Auth::user()->id !==null)
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('categories.create')}}">Categories</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="icon-power3"></i> {{ __('Logout') }}
                      </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </li>
              @else
                  <li class="nav-item">
                      <a class="nav-link" href="login">Login</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="register">Register</a>
                  </li>
              @endif
          </ul>
          </div><!-- /.container-fluid -->
        </nav>
        @section('content')
        @show()
      </div>
<script src="{{asset('assets/vendors/js/jQuery.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/vendors/js/sweetalert/sweetalert.min.js')}}"></script>
@section('extra-js')
@show()
</body>
</html>