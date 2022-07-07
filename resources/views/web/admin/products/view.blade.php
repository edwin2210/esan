@extends('web.template-home.home')

@section('hcontent')
    <!--########## Section: Products - View ##########-->
    @if($product->deleted_at == null)
        @push('scripts')
            <script src="{{asset('js/web/admin/products/view.js')}}"></script>
        @endpush
        <div class="container-fluid web-ht-view p-0">
            <div class="row align-items-center justify-content-center mx-0 my-2 my-sm-3 my-md-4 my-lg-5 my-xl-5 my-xxl-5">
                <div class="col-1 col-sm-1 col-md-1 col-lg-2 col-xl-2 col-xxl-3 m-0 p-0 text-center">
                    <a class="fw-2 fz-xxl ht-txt-title" href="{{route('web.admin.products.list')}}">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col-10 col-sm-10 col-md-10 col-lg-7 col-xl-7 col-xxl-6 m-0 p-0 text-center">
                    <p class="fw-1 fz-xxl ht-txt-title m-0">
                        Detalle del producto
                    </p>
                </div>
                <div class="col-1 col-sm-1 col-md-1 col-lg-3 col-xl-3 col-xxl-3 m-0 p-0 text-center">
                    <a class="fw-2 fz-xxl ht-txt-title mx-md-2 mx-lg-3 mx-xl-4 mx-xxl-5" href="{{route('web.admin.products.edit-view', ['id' => $product->id])}}">
                        <i class="fa fa-pen" aria-hidden="true"></i>
                    </a>
                    <br class="d-lg-none"><br class="d-lg-none">
                    <a id="web-admin-products-view-delete" class="fw-2 fz-xxl ht-txt-error mx-md-2 mx-lg-3 mx-xl-4 mx-xxl-5" href="#">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="row text-center justify-content-center m-0">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                    <p class="fw-1 fz-xl">
                        General
                        <input type="hidden" id="web-admin-products-view-id" value="{{$product->id}}">
                    </p>
                    <hr>
                    <div class="web-ht-view-row text-center">
                        <p class="fw-2 fz-md m-0">
                            Nombre:
                        </p>
                        <p class="fw-0 fz-md m-0">
                            {{$product->name}}
                        </p>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                    <p class="fw-1 fz-xl">
                        Económico
                    </p>
                    <hr>
                    <div class="web-ht-view-row text-center">
                        <p class="fw-2 fz-md m-0">
                            Precio:
                        </p>
                        <p class="fw-0 fz-md m-0">
                            ${{$product->price}}
                        </p>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                    <p class="fw-1 fz-xl">
                        Extras
                    </p>
                    <hr>
                    <div class="web-ht-view-row text-center">
                        <p class="fw-2 fz-md m-0">
                            Descripción:
                        </p>
                        <p class="fw-0 fz-md m-0">
                            {{$product->description}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('web.template.components._error_page', [
           'message' => 'Producto eliminado'
       ])
    @endif
@endsection
