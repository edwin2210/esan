@extends('web.template-home.home')

@section('hcontent')
    <!--########## Section: Users - List ##########-->
    @push('scripts')
        <script src="{{asset('js/web/admin/users/list.js')}}"></script>
    @endpush
    <div class="container-fluid web-ht-list p-0">
        <div class="row align-items-center justify-content-center mx-0 my-2 my-sm-3 my-md-4 my-lg-5 my-xl-5 my-xxl-5">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-4 col-xxl-4 m-0 p-0 text-center">
            </div>
            <div class="col-8 col-sm-8 col-md-7 col-lg-6 col-xl-4 col-xxl-4 m-0 p-0 text-center">
                <p class="fw-1 fz-xxl ht-txt-title m-0">
                    Usuarios
                </p>
            </div>
            <div class="col-4 col-sm-4 col-md-2 col-lg-3 col-xl-4 col-xxl-4 m-0 p-0 text-center">
                <a class="fw-2 fz-xxl ht-txt-title" href="{{route('web.admin.users.create-view')}}">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="row text-center justify-content-center m-0 px-1 px-sm-3 px-md-3 px-lg-3 px-xl-4 px-xxl-5">
            <table class="table align-middle">
                <thead>
                <tr>
                    <form id="web-admin-users-list-form">
                        <th scope="col" class="fw-1 fz-md">
                            @csrf
                            Id
                        </th>
                        <th scope="col" class="fw-1 fz-md">
                            <input class="fz-sm ht-inp mb-1 w-75 ht-locked" name="names" type="text" disabled/>
                            <br/><br/>
                            Nombre(s)
                        </th>
                        <th scope="col" class="fw-1 fz-md">
                            <input class="fz-sm ht-inp mb-1 w-75 ht-locked" name="last_names" type="text" disabled/>
                            <br/><br/>
                            Apellidos
                        </th>
                        <th scope="col" class="fw-1 fz-md">
                            <input class="fz-sm ht-inp mb-1 w-75 ht-locked" name="email" type="text" disabled/>
                            <br/><br/>
                            Correo electrónico
                        </th>
                        <th scope="col" class="fw-1 fz-md">
                            <input class="fz-sm ht-inp mb-1 w-75 ht-locked" name="role" type="text" disabled/>
                            <br/><br/>
                            Rol
                        </th>
                        <th scope="col" class="fw-1 fz-md" colspan="2">
                            <input type="submit" class="ht-btn ht-btn-sm ht-btn-gray fz-sm ht-locked" value="Filtrar" disabled/>
                            <br/><br/>
                            Acciones
                        </th>
                    </form>
                </tr>
                </thead>
                <tbody id="web-admin-users-list-table">
                </tbody>
            </table>
        </div>
    </div>
@endsection
