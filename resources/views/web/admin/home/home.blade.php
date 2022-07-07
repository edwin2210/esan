@extends('web.template-home.home')

@section('hcontent')
    <!--########## Section: Home ##########-->
    @push('scripts')
        <script src="{{asset('js/web/admin/home/graphics.js')}}"></script>
    @endpush
    <div class="row m-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 text-center">
            <div class="row m-0">
                <div class="col-4 m-0 p-0 text-center">
                    <p class="fw-0 fz-sm m-0">
                        Rango: Fecha inicial
                    </p>
                    <input id="web-admin-home-graphics-adate" class="ht-inp ht-inp-date fz-sm" type="date" value="{{$aDate}}">
                </div>
                <div class="col-4 m-0 p-0 text-center d-flex flex-column">
                    <p id="web-admin-home-graphics-title" class="fw-1 fz-lg color-ft-orange my-auto">
                    </p>
                </div>
                <div class="col-4 m-0 p-0 text-center">
                    <p class="fw-0 fz-sm m-0">
                        Rango: Fecha final
                    </p>
                    <input id="web-admin-home-graphics-bdate" class="ht-inp ht-inp-date fz-sm" type="date" value="{{$bDate}}">
                </div>
            </div>
        </div>
    </div>
    <div class="row mx-0 my-2 p-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 m-0 p-4 text-center">
            <p id="web-admin-home-graphics-total_earned" class="fw-1 fz-md">
            </p>
            <ul id="web-admin-home-graphics-time" class="fw-1 fz-sm">
            </ul>
            <hr>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 m-0 p-2 text-center">
            <canvas id="web-admin-home-graphics-top_days" class="ht-container">
            </canvas>
            <hr>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 m-0 p-2 text-center">
            <canvas id="web-admin-home-graphics-top_products" class="ht-container">
            </canvas>
            <hr>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 m-0 p-2 text-center">
            <canvas id="web-admin-home-graphics-top_tables" class="ht-container">
            </canvas>
            <hr>
        </div>
    </div>
@endsection
