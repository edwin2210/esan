@extends('web.template.main')
@section('content')
    <div class="container-fluid m-0 p-0 web-container">
        <div class="row m-0 web-container-row {{session('theme')}}">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 col-xxl-2 m-0 web-container-menu text-center">
                <!--########## Section: Menu ##########-->
                @include('web.template-home.components._menu')
            </div>
            <div class="color-bg-gray col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 col-xxl-10 m-0 web-container-content">
                <!--########## Section: Content ##########-->
                @yield('hcontent')
            </div>
        </div>
    </div>
@endsection
