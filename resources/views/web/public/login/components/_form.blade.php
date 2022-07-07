@push('scripts')
    <script src="{{asset('js/web/public/login/login.js')}}"></script>
@endpush
<div class="container-fluid web-public-login p-0">
    <div class="row web-public-login-row m-0 p-0 align-items-center justify-content-center">
        <div class="col-11 col-sm-7 col-md-5 col-lg-5 col-xl-4 col-xxl-3 web-public-login-image shadow-lg" style="background-image: url({{asset('img/web/logo.png')}})">
        </div>
        <div class="col-11 col-sm-7 col-md-5 col-lg-5 col-xl-4 col-xxl-3 web-public-login-form text-center shadow-lg">
            <p class="fw-1 fz-xl ht-txt-title">
                Iniciar sesión
            </p>
            <form id="web-public-login-form">
                @csrf
                <div>
                    <input class="fz-md ht-inp" name="email" type="email" placeholder="Correo electrónico" required/>
                </div>
                <div>
                    <input class="fz-md ht-inp" name="password" type="password" placeholder="Contraseña" required/>
                </div>
                <input type="submit" class="ht-btn ht-btn-lg ht-btn-orange fz-md" value="Acceder"/>
            </form>
        </div>
    </div>
</div>
