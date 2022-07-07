@extends('web.template-home.home')

@section('hcontent')
    <!--########## Section: Tables - Edit ##########-->
    @if($table->deleted_at == null)
        @push('scripts')
            <script src="{{asset('js/web/admin/tables/edit.js')}}"></script>
        @endpush
        <div class="container-fluid web-form p-0">
            <div class="row align-items-center justify-content-center mx-0 my-2 my-sm-3 my-md-4 my-lg-5 my-xl-5 my-xxl-5">
                <div class="col-1 col-sm-1 col-md-1 col-lg-2 col-xl-2 col-xxl-3 m-0 p-0 text-center">
                    <a class="fw-2 fz-xxl ht-txt-title" href="{{route('web.admin.tables.view', ['id' => $table->id])}}">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col-10 col-sm-10 col-md-10 col-lg-8 col-xl-8 col-xxl-6 m-0 p-0 text-center">
                    <p class="fw-1 fz-xxl ht-txt-title m-0">
                        Editar mesa
                    </p>
                </div>
                <div class="col-1 col-sm-1 col-md-1 col-lg-2 col-xl-2 col-xxl-3 m-0 p-0 text-center">
                </div>
            </div>
            <form id="web-admin-tables-edit-form">
                @csrf
                <input type="hidden" name="id" value="{{$table->id}}">
                <div class="row text-center justify-content-center m-0">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                        <p class="fw-1 fz-xl">
                            General
                        </p>
                        <hr>
                        <input id="web-admin-tables-edit-inp-name" class="fz-md ht-inp" name="name" type="text" style="width: 80%" placeholder="Nombre" value="{{$table->name}}" required>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                        <p class="fw-1 fz-xl">
                            Tamaño
                        </p>
                        <hr>
                        <input id="web-admin-tables-edit-inp-capacity" class="fz-md ht-inp" name="capacity" type="number" style="width: 50%" placeholder="Capacidad" value="{{$table->capacity}}" required>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                        <p class="fw-1 fz-xl">
                            Ubicación
                        </p>
                        <hr>
                        <textarea id="web-admin-tables-edit-inp-description" name="description" cols="20" rows="10" class="fz-md ht-inp" placeholder="Descripción" required>{{$table->description}}</textarea>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 m-0 p-2">
                        <hr>
                        <input type="submit" class="ht-btn ht-btn-lg ht-btn-orange fz-md mx-2 mx-sm-3 mx-md-3 mx-lg-4 mx-xl-4 mx-xxl-5" value="Guardar"/>
                    </div>
                </div>
            </form>
        </div>
    @else
        @include('web.template.components._error_page', [
           'message' => 'Mesa eliminada'
       ])
    @endif
@endsection
