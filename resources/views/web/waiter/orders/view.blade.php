@extends('web.template-home.home')

@section('hcontent')
    <!--########## Section: Orders - View ##########-->
    @if($order->deleted_at == null)
        <div class="container-fluid web-ht-view p-0">
            <div class="row align-items-center justify-content-center mx-0 my-2 my-sm-3 my-md-4 my-lg-5 my-xl-5 my-xxl-5">
                <div class="col-1 col-sm-1 col-md-1 col-lg-2 col-xl-2 col-xxl-3 m-0 p-0 text-center">
                    <a class="fw-2 fz-xxl ht-txt-title" href="{{route('web.waiter.orders.list')}}">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col-10 col-sm-10 col-md-10 col-lg-7 col-xl-7 col-xxl-6 m-0 p-0 text-center">
                    <p class="fw-1 fz-xxl ht-txt-title m-0">
                        Detalle de la orden
                    </p>
                </div>
                <div class="col-1 col-sm-1 col-md-1 col-lg-3 col-xl-3 col-xxl-3 m-0 p-0 text-center">
                </div>
            </div>
            <div class="row text-center justify-content-center m-0">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                    <p class="fw-1 fz-xl">
                        Mesero
                    </p>
                    <hr>
                    <div class="web-ht-view-row text-center">
                        <p class="fw-2 fz-md m-0">
                            Nombre(s):
                        </p>
                        <p class="fw-0 fz-md m-0">
                            {{$order->creator->names}}
                        </p>
                    </div>
                    <div class="web-ht-view-row text-center">
                        <p class="fw-2 fz-md m-0">
                            Apellidos:
                        </p>
                        <p class="fw-0 fz-md m-0">
                            {{$order->creator->last_names}}
                        </p>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                    <p class="fw-1 fz-xl">
                        Mesa
                    </p>
                    <hr>
                    <div class="web-ht-view-row text-center">
                        <p class="fw-2 fz-md m-0">
                            Nombre:
                        </p>
                        <p class="fw-0 fz-md m-0">
                            {{$order->table->name}}
                        </p>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                    <p class="fw-1 fz-xl">
                        Productos
                    </p>
                    <hr>
                    <div class="web-ht-view-row text-center">
                        @include('web.public.products.container', [
                            'name' => 'view-order',
                            'products' => $products,
                            'readOnly' => true,
                            'orderProducts' => $order->products
                        ])
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('web.template.components._error_page', [
           'message' => 'Orden eliminada'
       ])
    @endif
@endsection
