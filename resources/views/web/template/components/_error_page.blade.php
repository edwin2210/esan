@extends('web.template.main')

@section('content')
    <!--########## Section: Error ##########-->
    <div class="row m-0">
        <div class="col-12 text-center mt-2 mt-sm-3 mt-md-4 mt-lg-4 mt-xl-5 mt-xxl-5">
            <p class="fw-1 fz-xxl m-0">
                {{$message}}
                <br>
                <i class="fas fa-exclamation-triangle"></i>
            </p>
        </div>
    </div>
@endsection

