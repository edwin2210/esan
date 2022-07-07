<div class="row mx-0 p-0">
    <div class="col-12 m-0 my-2 p-0">
        <img src="{{asset('img/web/logo.png')}}" alt="Sabor a naranja">
    </div>
</div>
<div class="row m-0 p-0">
    <div class="col-12 m-0 p-0">
        <div class="dropdown fw-0 fz-md">
            <button class="btn ht-btn-trans dropdown-toggle" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                {{Auth::user()->names}}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownUser">
                <li>
                    <a class="dropdown-item text-center" href="{{route('web.public.login.out')}}">
                        Cerrar sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="row m-0 p-0 justify-content-center">
    @php
        $role = Auth::user()->role->name
    @endphp
    @if($role == 'Administrador')
        @include('web.template-home.components._menu_option', [
            'route' => route('web.admin.home'),
            'name' => 'Inicio',
            'icon' => 'fa-home'
        ])
        @include('web.template-home.components._menu_option', [
            'route' => route('web.admin.users'),
            'name' => 'Usuarios',
            'icon' => 'fa-user'
        ])
        @include('web.template-home.components._menu_option', [
            'route' => route('web.admin.products'),
            'name' => 'Productos',
            'icon' => 'fa-utensils'
        ])
        @include('web.template-home.components._menu_option', [
            'route' => route('web.admin.tables'),
            'name' => 'Mesas',
            'icon' => 'fa-square'
        ])
    @elseif($role == 'Gerente')
        @include('web.template-home.components._menu_option', [
            'route' => route('web.manager.home'),
            'name' => 'Inicio',
            'icon' => 'fa-home'
        ])
        @include('web.template-home.components._menu_option', [
            'route' => route('web.manager.orders'),
            'name' => 'Ordenes',
            'icon' => 'fa-clipboard-check'
        ])
    @elseif($role == 'Mesero')
        @include('web.template-home.components._menu_option', [
            'route' => route('web.waiter.home'),
            'name' => 'Inicio',
            'icon' => 'fa-home'
        ])
        @include('web.template-home.components._menu_option', [
            'route' => route('web.waiter.orders'),
            'name' => 'Ordenes',
            'icon' => 'fa-clipboard-check'
        ])
    @endif
</div>
