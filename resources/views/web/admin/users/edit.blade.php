@extends('web.template-home.home')

@section('hcontent')
    <!--########## Section: Users - Edit ##########-->
    @if($user->deleted_at == null)
        @push('scripts')
            <script src="{{asset('js/web/admin/users/edit.js')}}"></script>
        @endpush
        <div class="container-fluid web-form p-0">
            <div class="row align-items-center justify-content-center mx-0 my-2 my-sm-3 my-md-4 my-lg-5 my-xl-5 my-xxl-5">
                <div class="col-1 col-sm-1 col-md-1 col-lg-2 col-xl-2 col-xxl-3 m-0 p-0 text-center">
                    <a class="fw-2 fz-xxl ht-txt-title" href="{{route('web.admin.users.view', ['id' => $user->id])}}">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col-10 col-sm-10 col-md-10 col-lg-8 col-xl-8 col-xxl-6 m-0 p-0 text-center">
                    <p class="fw-1 fz-xxl ht-txt-title m-0">
                        Editar usuario
                    </p>
                </div>
                <div class="col-1 col-sm-1 col-md-1 col-lg-2 col-xl-2 col-xxl-3 m-0 p-0 text-center">
                </div>
            </div>
            <form id="web-admin-users-edit-form">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="row text-center justify-content-center m-0">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                        <p class="fw-1 fz-xl">
                            Persona
                        </p>
                        <hr>
                        <input id="web-admin-users-edit-inp-names" class="fz-md ht-inp" name="names" type="text" style="width: 80%" placeholder="Nombre(s)" value="{{$user->names}}" required>
                        <br>
                        <input id="web-admin-users-edit-inp-lastnames" class="fz-md ht-inp" name="last_names" type="text" style="width: 80%" placeholder="Apellidos" value="{{$user->last_names}}" required>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                        <p class="fw-1 fz-xl">
                            Cuenta
                        </p>
                        <hr>
                        <input id="web-admin-users-edit-inp-email" class="fz-md ht-inp" name="email" type="email" style="width: 80%" placeholder="Correo electrónico" value="{{$user->email}}" required>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 m-0 p-2">
                        <p class="fw-1 fz-xl">
                            Tipo de cuenta
                        </p>
                        <hr>
                        <select name="role" id="web-admin-users-edit-slc-role" class="ht-slc fz-md" style="width: 60%" required>
                            <option value="">Selecciona un rol</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" {{$role->id == $user->fk_id_role ? 'selected' : ''}}>{{$role->name}}</option>
                            @endforeach
                        </select>
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
           'message' => 'Usuario eliminado'
       ])
    @endif
@endsection
