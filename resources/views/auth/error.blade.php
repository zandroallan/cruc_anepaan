<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<meta charset="utf-8" />
		<title>Error Page - 6 | Keenthemes</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/pages/error/error-5.css') }}" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/plugins/global/plugins.bundle.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/plugins/custom/prismjs/prismjs.bundle.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.bundle.css') }}" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
    <!-- <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
		<div class="d-flex flex-column flex-root">
			<div class="error error-6 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url('{{ asset('public/assets/media/error/bg6.jpg') }}');">
				<div class="d-flex flex-column flex-row-fluid text-center">
                <div class="row">
                <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h1 class="error-title font-weight-boldest text-white mb-12" style="margin-top: 12rem;">Oops...</h1>
                        <p class="font-weight-boldest display-4">
                            Estimado/a [Nombre del destinatario]:
                        </p>
                        <p class="font-size-h2" style="text-align: justify;">
                            Se le comunica de manera oficial que su acceso ha sido bloqueado, por lo que, a partir de este momento, no podrá efectuar ningún tipo de trámite. Esta medida permanecerá vigente hasta que se resuelva la situación que la originó.
                        </p>
                        <p class="font-size-h2" style="text-align: justify;">
                            Para cualquier aclaración o gestión relacionada, deberá comunicarse directamente con el área correspondiente, siguiendo los canales oficiales establecidos.
                        </p>
                        <p class="font-size-h2" style="text-align: justify;">
                            Agradecemos su atención a la presente notificación.
                        </p>
                    </div>
                    <div class="col-md-3"></div>
				</div>
			</div>
		</div> -->


	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
        <div class="error error-5 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url('{{ asset('public/assets/media/error/bg5.jpg') }}');">
            <div class="container d-flex flex-row-fluid flex-column justify-content-md-center p-12">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="error-title font-weight-boldest text-info mt-10 mt-md-0 mb-12">
                            Oops!
                        </h1>
                        <p class="font-weight-boldest display-4">
                            Estimado/a {{ $data->razon_social_o_nombre }}.
                        </p>
                        <p class="font-size-h2" style="text-align: justify;">
                            Se le comunica de manera oficial que su acceso ha sido bloqueado, por lo que, a partir de este momento, no podrá efectuar ningún tipo de trámite. Esta medida permanecerá vigente hasta que se resuelva la situación que la originó.
                        </p>
                        <p class="font-size-h2" style="text-align: justify;">
                            Para cualquier aclaración o gestión relacionada, deberá comunicarse directamente con el área correspondiente, siguiendo los canales oficiales establecidos.
                        </p>
                        <p class="font-size-h2" style="text-align: justify;">
                            Agradecemos su atención a la presente notificación.
                        </p>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>

        <!--end::Error-->
		<!--end::Main-->
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{ asset('public/assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('public/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
		<script src="{{ asset('public/assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Theme Bundle-->
	</body>
</html>