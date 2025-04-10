<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>CRUC ANEPAAN | Web</title>
        <meta name="description" content="Singin page example" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="canonical" href="https://keenthemes.com/metronic" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

        <link rel="stylesheet" href="{{asset('public/assets/css/pages/login/login-3.css')}}">

        <link rel="stylesheet" href="{{asset('public/assets/plugins/global/plugins.bundle.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/plugins/custom/prismjs/prismjs.bundle.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/style.bundle.css')}}">

        <link rel="shortcut icon" href="{{ asset('public/assets/media/logos/favicon.ico') }}">
        <style type="text/css">
            /* Estilo cuando el cursor pasa sobre el botón */
            .btn:hover {
                background-color: #0056b3; /* Color de fondo al hacer hover */
                color: #fff; /* Cambiar el color del texto si lo deseas */
                transform: scale(1.05); /* Aumentar el tamaño del botón ligeramente */
            }

            /* Estilo base para la imagen de fondo */
            .aside-img {
                background-size: cover;
                background-position: center center;
                height: 100vh; /* La imagen debe ocupar al menos toda la altura de la ventana */
                min-height: 100vh; /* Asegura que siempre ocupe al menos la altura de la ventana */
            }

            /* Ajustes para pantallas grandes */
            @media (max-width: 1448px) {
                .aside-img {
                    height: 80vh; /* Ajusta la altura al 80% de la ventana en pantallas medianas */
                }
            }

            /* Ajustes para pantallas de tabletas (1025px - 1448px) */
            @media (max-width: 1024px) {
                .aside-img {
                    height: 70vh; /* Ajusta la altura al 70% de la ventana */
                }
            }

            /* Ajustes para pantallas móviles (hasta 768px) */
            @media (max-width: 768px) {
                .aside-img {
                    height: 50vh; /* Ajusta la altura al 50% de la ventana */
                    background-size: contain; /* Cambia a 'contain' para mostrar la imagen completa */
                }
            }

            .myshadow 
            {
                box-shadow: 0 3px 5px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            }

            .sizeinput
            {
                font-size: 15px;
                font-weight: bold;
            }
            .colorinpt
            {
                color: #b1212d;
            }

            .img {
              filter: drop-shadow(0 1px 1px rgba(0, 0, 0, 0.7)); 
            }

            .marca-agua {
                position: relative;
                background-color: rgba(0, 0, 0, 0); /* si quieres fondo transparente o ajustarlo */
                width: 100%;
                padding: 20px;
            }

            .marca-agua::before {
                content: "";
                position: absolute;
                top: 0; left: 0;
                width: 100%;
                height: 100%;
                background-image: url('{{ asset('public/img2/jaguar.png') }}');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                opacity: 0.1; /* Aquí controlas qué tan visible es la marca de agua */
                z-index: 0;
            }

            .marca-agua > * {
                position: relative;
                z-index: 1;
            }
        </style>
    </head>

    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Login-->
            <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
                <!--begin::Aside-->
                <div class="login-aside d-flex flex-column flex-row-auto"  style="background-color: #E2E2E2">                    
                    <!--begin::Aside Bottom-->
                    <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center">
                        <img src="{{ asset('public/img2/rtec.png') }}">
                    </div>
                    <!--end::Aside Bottom-->
                </div>
                <!--begin::Aside-->
                <!--begin::Content-->
                <div class="login-content flex-row-fluid d-flex flex-column p-10" style="background-color: #E2E2E2">                 
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-row-fluid flex-center">
                        <!--begin::Signin-->
                        <div class="login-form">
                            <!--begin::Form-->
                            {!! Form::open(['url' => 'login', 'method' => 'POST', 'class'=>'form']) !!}
                                <!--begin::Title-->
                                <div class="pb-1 pb-lg-5 text-center">
                                    <img alt="Logo" src="{{asset('public/img2/cruc.png')}}" class="img" width="80%" />                                   
                                </div>
                                <!--begin::Title-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Ingresar usuario</label>
                                    <input class="form-control img h-auto py-7 px-6 rounded-lg border-0 myshadow sizeinput" type="text" name="nickname" id="nickname" autocomplete="off" />
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div class="d-flex justify-content-between mt-n5">
                                        <label class="font-size-h6 font-weight-bolder text-dark pt-5">Ingresar contraseña</label>
                                        <a href="#" class="colorinpt font-size-h6 font-weight-bolder text-hover-primary pt-5"  data-toggle="modal" data-target="#mdlrecuperar">Olvidaste tu contraseña ?</a>
                                    </div>
                                    <input class="form-control img input-password h-auto py-7 px-6 rounded-lg border-0 myshadow sizeinput" type="password" id="password" name="password" autocomplete="off" />
                                </div>
                                <!--end::Form group-->

                                <div class="pb-1 pb-lg-5">
                                    <div class="text-dark font-weight-bold font-size-h4">Eres nuevo?
                                    <a href="{{ url('crear-cuenta/registro') }}" class="colorinpt font-weight-bolder">Crea tu cuenta</a></div>
                                </div>

                                <!--begin::Action-->
                                <div class="pb-lg-0 pb-5">
                                    <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 img myshadow" style="background-color: #1d1d1b; border-color: #1d1d1b;">Accesar</button>
                                </div>
                                <!--end::Action-->
                            {!! Form::close() !!}
                            <!--end::Form-->
                        </div>
                        <!--end::Signin-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Login-->
        </div>
        <!--end::Main-->

        <!-- Modal-->
        <div class="modal fade" id="mdlrecuperar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: black;">
                        <h5 class="modal-title text-white">Recuperar contraseña</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body bgi-no-repeat marca-agua">
                        <form id="frmRecuperarPass" name="frmRecuperarPass" class="frmRecuperarPass">
                        @csrf 
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-justify font-size-h6 font-weight-bolder text-dark"><b><span style="color: #b11f29;">Nota:</span></b> Los datos requeridos son obligatorios porque a traves de ellos se realizara la busqueda en el padron, de no ser asi se omitira. </p>
                                </div>
                            </div>

                            <!--begin::Form group-->
                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-dark">RFC</label>
                                <input class="form-control img h-auto py-2 px-6 rounded-lg border-0 myshadow sizeinput" type="text" name="txtRfc" id="txtRfc" autocomplete="off" />
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-dark">Correo electrónico</label>
                                <input class="form-control img h-auto py-2 px-6 rounded-lg border-0 myshadow sizeinput" type="text" name="txtCorreo" id="txtCorreo" autocomplete="off" />
                                <code class="font-size-h6 font-weight-bolder" style="color: #b11f29;"><b>Poner la direccion completa del correo.</b></code>
                            </div>
                            <!--end::Form group-->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary font-weight-bold" onclick="recuperarPass()" id="btnAceptPass" style="background-color: #1d1d1b; border-color: #1d1d1b;">Recuperar contraseña</button>
                    </div>
                </div>
            </div>
        </div>


        <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
        <!--begin::Global Config(global config for global JS scripts)-->
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
        <!--end::Global Config-->
        <script src="{{asset('public/assets/plugins/global/plugins.bundle.js')}}"></script>
        <script src="{{asset('public/assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
        <script src="{{asset('public/assets/js/scripts.bundle.js')}}"></script>
        <script src="{{asset('public/js/backend/recuperar_password.js')}}"></script>

        <script type="text/javascript">
            var vuri = window.location.origin + '/cruc_anepaan';

            $(document).ready(
                function () {
                    @yield('script')
                }
            );
        </script>
    </body>
    <!--end::Body-->
</html>