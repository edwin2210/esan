@extends('web.template-home.home')

@section('hcontent')
    <!--########## Section: Orders - Create ##########-->
    @push('scripts')
        <script src="{{asset('js/web/waiter/orders/create.js')}}"></script>
    @endpush
    <div class="container-fluid web-form p-0">
        <div class="row align-items-center justify-content-center mx-0 my-2 my-sm-3 my-md-4 my-lg-5 my-xl-5 my-xxl-5">
            <div class="col-1 col-sm-1 col-md-1 col-lg-2 col-xl-2 col-xxl-3 m-0 p-0 text-center">
                <a class="fw-2 fz-xxl ht-txt-title" href="{{route('web.waiter.orders.list')}}">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
            <div class="col-10 col-sm-10 col-md-10 col-lg-8 col-xl-8 col-xxl-6 m-0 p-0 text-center">
                <p class="fw-1 fz-xxl ht-txt-title m-0">
                    Crear orden
                </p>
            </div>
            <div class="col-1 col-sm-1 col-md-1 col-lg-2 col-xl-2 col-xxl-3 m-0 p-0 text-center">
            </div>
        </div>
        <form id="web-waiter-orders-create-form">
            @csrf
            <div class="row text-center justify-content-center m-0">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                    <p class="fw-1 fz-xl">
                        Mesero
                    </p>
                    <hr>
                    <input name="waiterId" type="hidden" value="{{Auth::user()->id}}" required>
                    <input class="fz-md ht-inp" name="waiterName" type="text" style="width: 80%" placeholder="Nombre del mesero" value="{{Auth::user()->names}} {{Auth::user()->last_names}}" disabled>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                    <p class="fw-1 fz-xl">
                        Mesa
                    </p>
                    <hr>
                    <select name="table" id="web-waiter-orders-create-slc-tables" class="ht-slc fz-md" style="width: 80%" required>
                        <option value="">Selecciona una mesa</option>
                        @foreach($tables as $table)
                            @php
                                $busy = false;
                            @endphp
                            @foreach($tables_busy as $table_busy)
                                @php
                                    if ($table->id == $table_busy->fk_id_table) {
                                        $busy = true;
                                        break;
                                    }
                                @endphp
                            @endforeach
                            <option value="{{$table->id}}" {{$busy ? 'disabled' : ''}}>{{$table->name}} ({{$table->capacity}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                    <p class="fw-1 fz-xl">
                        Productos
                    </p>
                    <hr>
                    @include('web.public.products.container', [
                        'name' => 'create-order',
                        'products' => $products,
                        'readOnly' => false
                    ])
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 m-0 p-2">
                    <hr>
                    <input type="submit" class="ht-btn ht-btn-lg ht-btn-orange fz-md mx-2 mx-sm-3 mx-md-3 mx-lg-4 mx-xl-4 mx-xxl-5" value="Guardar"/>
                </div>
            </div>
        </form>
    </div>
@endsection
