<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<title>Cruc Anepaan | Web</title>
		<meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />

		<!-- CSRF Token -->
    	<meta name="csrf-token" content="{{ csrf_token() }}">
    	<link rel="shortcut icon" href="{{ asset('public/assets/media/logos/favicon.ico') }}">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		
		<link rel="stylesheet" href="{{asset('public/assets/plugins/global/plugins.bundle.css')}}">
		<link rel="stylesheet" href="{{asset('public/assets/plugins/custom/prismjs/prismjs.bundle.css')}}">
		<link rel="stylesheet" href="{{asset('public/assets/css/style.bundle.css')}}">
		<link rel="stylesheet" href="{{asset('public/css/cssHeader.css')}}">
		<link rel="stylesheet" href="{{asset('public/assets/plugins/confirm/css/jquery-confirm.css')}}">

		@yield('styles')

		<style type="text/css">
			.input-file {
				background-color: #D1D3E0;
				border: 1px solid #181824;
				border-radius: 6px;
				height: 40px;
				width: 100%;
				color: #111833;
				box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); /* Sombra más intensa y grande */
				transition: all 0.3s ease-in-out; /* Suaviza las transiciones */
			}
			.input-file::file-selector-button {
				font-size: 14px;          
				border: 1px solid #181824;
				border-radius-left-top: 6px;
				border-radius-left-bottom: 6px;
				color: white;
				background-color: #181824;  
				border: 1px solid #181824;
				height: 40px;
				cursor: pointer;
				transition: all .25s ease-in;
				width: 150px;
				box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra más notoria para el botón */
			}
			.input-file::file-selector-button:hover {
				background-color: #1F1E2E;
				color: #fff;
				box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Sombra más destacada en hover */
				transition: all .25s ease-in;
			}
			.input-file:hover {
				box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4); /* Sombra más fuerte al pasar el ratón */
			}
			    
		</style>

	</head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile header-mobile-fixed">
			<div class="d-flex align-items-center">
				<!--begin::Logo-->
				<a href="#" class="mr-7">
					<img alt="Logo" src="{{asset('public/img2/saybg_blanco.png')}}" class="max-h-30px" />
				</a>
				<!--end::Logo-->				
			</div>
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
			</div>
			<!--end::Toolbar-->
		</div>
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header flex-column header-fixed">
						<!--begin::Top-->
						<div class="header-top">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Left-->
								<div class="d-none d-lg-flex align-items-center mr-3">
									<!--begin::Logo-->
									<a href="#" class="mr-10">
										<img alt="Logo" src="{{asset('public/img2/saybg_blanco.png')}}" class="max-h-65px" />
									</a>
									<!--end::Logo-->
								</div>
								<!--end::Left-->

								<?php 
		                            $id_registro=Auth::User()->id_registro;                     
		                            $count_obs=0;                                                       
		                            $ult_tramite=\App\Http\Models\Backend\T_Registro::find($id_registro);
		                            if($ult_tramite->id_ultimo_tramite!=0)
		                            {
		                                $array_o=[];
		                                $array_o['id_tramite']=$ult_tramite->id_ultimo_tramite;
		                                $array_o['status_t']=1;
		                                $total_obs=\App\Http\Models\Backend\T_Tramite_Observacion::totalObservaciones($array_o);
		                                $count_obs=count($total_obs);
		                            }
		                        ?>

								<!--begin::Topbar-->
								<div class="topbar">									
									<!--begin::Notifications-->
									<div class="dropdown">
										<!--begin::Toggle-->
										<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
											<div class="btn btn-icon btn-dropdown btn-lg mr-1 pulse pulse-white">
												<span class="svg-icon svg-icon-xl svg-icon-primary">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
															<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>
												@if( $count_obs!=0 && $total_obs[0]->id_c_tramites_seguimiento == 2 )
												<span class="pulse-ring"></span>
												@endif
											</div>
										</div>
										<!--end::Toggle-->
										<!--begin::Dropdown-->
										<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
											<form>		
												<!--begin::Header-->
												<div class="d-flex flex-column p-6 rounded-top" style="color: #1f5c01; background-color: #ced7df; border-color: #ced7df;">
													<!--begin::Title-->
													<h3 class="d-flex flex-center">
														<span class="text-dark">Notificaciones</span>
														<hr>
													</h3>
													<!--end::Title-->
													
												</div>
												<!--end::Header-->
												<!--begin::Content-->
												<div class="tab-content">
													<!--begin::Tabpane-->
													<div class="tab-pane active show p-8" id="topbar_notifications_notifications" role="tabpanel">
														<!--begin::Scroll-->
														<div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300" data-mobile-height="200">
															
															<!--begin::Item-->
															<div class="d-flex align-items-center mb-6">
																<!--begin::Text-->
																<div class="d-flex flex-column font-weight-bold">
																	<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Información importante:</a>
																	<p class="text-muted text-justify">
						                                                @if( $count_obs!=0 && $total_obs[0]->id_c_tramites_seguimiento == 2 )
						                                                    Le informamos que su trámite presenta <strong>{!! $count_obs !!} observaciones</strong>, las cuales requieren de su atención inmediata. Es imprescindible que estas observaciones sean atendidas a la mayor brevedad posible, ya que de no ser así, podría verse afectado el progreso de su trámite. Agradecemos su comprensión y colaboración para asegurar la correcta continuación del proceso.
						                                                @else
						                                                    En este momento, no se han generado notificaciones relacionadas con su trámite. Le informaremos de cualquier actualización o avance relevante en cuanto se disponga de nueva información.
						                                                @endif
						                                            </p>
																</div>
																<!--end::Text-->
															</div>
															<!--end::Item-->
														</div>
														<!--end::Scroll-->
														<!--begin::Action-->
														<div class="d-flex flex-center pt-7">
															@if( $count_obs!=0 && $total_obs[0]->id_c_tramites_seguimiento == 2 )
															<a href="{{ Route('mis-observaciones.index')}}" class="btn btn-light-primary font-weight-bold text-center">Ver observaciones</a>
															@endif
														</div>
														<!--end::Action-->
													</div>
													<!--end::Tabpane-->
												</div>
												<!--end::Content-->
											</form>
										</div>
										<!--end::Dropdown-->
									</div>
									<!--end::Notifications-->
								
									<div class="topbar-item">
										<div class="btn btn-icon w-auto d-flex align-items-center btn-lg px-2" data-toggle="dropdown" data-offset="0px,1px" aria-haspopup="true" aria-expanded="false">
											<div class="d-flex text-right pr-3">
												<span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">{{ Auth::User()->name }}</span>
											</div>
											<span class="symbol symbol-35">
												<span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-15">{{ substr(Auth::user()->name, 0, 1) }}</span>
											</span>
										</div>

										<div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-left">
											<ul class="navi navi-hover py-5">
												<li class="navi-item">
													<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="navi-link">
														<span class="navi-icon">
															<span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															        <mask fill="white">
															            <use xlink:href="#path-1"/>
															        </mask>
															        <g/>
															        <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"/>
															    </g>
															</svg></span>
														</span>
														<span class="navi-text pl-3">Cerrar sesión</span>
													</a>

													<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									                    @csrf
									                </form>
												</li>																								
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="header-bottom">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Header Menu Wrapper-->
								<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
									<!--begin::Header Menu-->
									<div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
										<!--begin::Header Nav-->
										<ul class="menu-nav">
											<!-- <li class="menu-item menu-item-active" aria-haspopup="true">
												<a href="index.html" class="menu-link">
													<span class="menu-text">Dashboard</span>
												</a>
											</li> -->


					                        <li class="menu-item _inicio" aria-haspopup="true">
					                            <a class="menu-link" href="{{ route('mis-tramites.index') }}">
					                                <span class="menu-text">
					                                	<i class="fe fe-airplay"></i> Inicio
					                                </span>
					                            </a>
					                        </li>
					                        <li class="menu-item _avance_tramite">
					                            <a class="menu-link" href="{{ Route('tramites.seguimientos')}}">
					                            	<span class="menu-text">
					                            		<i class="fa fa-rch"></i> Avance del trámite
						                            </span>
					                            </a>
					                        </li>                        
					                        <li class="menu-item _observaciones">
					                            <a class="menu-link" href="{{ Route('mis-observaciones.index')}}">
					                            	<span class="menu-text">
						                                @if( $count_obs!=0 && $total_obs[0]->id_c_tramites_seguimiento == 2 )
						                                	<span class="badge pull-right">{!! $count_obs !!}</span>
						                                @endif
						                                <i class="fe fe-eye"></i> Observaciones
						                            </span>
					                            </a>                                
					                        </li>
					                        <li class="menu-item _formatos">
					                            <a class="menu-link" href="{{ Route('descargas-f.index')}}">
					                            	<span class="menu-text">
						                            	<i class="fe fe-file-text"></i> Formatos
						                            </span>
					                            </a>                    
					                        </li>
					                        <li class="menu-item">
					                            <a class="menu-link" href="#mdlAtencion" data-toggle="modal">
					                            	<span class="menu-text">
						                            	<i class="fe fe-phone-call"></i> Atención teléfonica
						                            </span>
					                            </a>               
					                        </li>
                   
										</ul>
										<!--end::Header Nav-->
									</div>
									<!--end::Header Menu-->
								</div>
								<!--end::Header Menu Wrapper-->								
							</div>
							<!--end::Container-->
						</div>
						<!--end::Bottom-->
					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-2">
									@yield('breadcrumb')
								</div>
								<!--end::Info-->
								<!--begin::Toolbar-->
								<div class="d-flex align-items-center flex-wrap">
									@yield('buttons')
								</div>
								<!--end::Toolbar-->
							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::content-->
								@yield('content')
								<!--end::content-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted font-weight-bold mr-2">2025©</span>
								<a href="https://anticorrupcionybg.gob.mx" target="_blank" class="text-dark-75 text-hover-primary">Secretar&iacute;a Anticorrupci&oacute;n y Buen Gobierno</a>
							</div>
							<!--end::Copyright-->
							<!--begin::Nav-->
							<div class="nav nav-dark order-1 order-md-2">
								<a href="#" target="_blank" class="nav-link pr-3 pl-0">Aviso de privacidad</a>
								<a href="#" target="_blank" class="nav-link px-3">Terminos</a>
								<a href="#" target="_blank" class="nav-link pl-3 pr-0">Contactos</a>
							</div>
							<!--end::Nav-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->

			<div class="modal fade" id="mdlAtencion">
                <div class="modal-dialog">
                    <div class="modal-content" style="width: 640px;">
                        <div class="modal-header"  style="color: #1f5c01; background-color: #ced7df; border-color: #ced7df;">
                            <h4 class="modal-title">Atenci&oacute;n Telef&oacute;nica</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">
                                <b style="font-size: 18px;">Secretaría Anticorrupción y Buen Gobierno</b><br>
                                Blvd. los Castillos No. 410, Fracc. Montes Azules, C.P. 29056 Tuxtla Gutiérrez, Chiapas.
                            </p>

                            <p class="text-center">
                                <b style="font-size: 15px;">Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal</b>                       
                            </p>

                            <p class="text-center">
                                <b style="font-size: 18px;">SIRCSE</b><br>
                                Servicio de Informaci&oacute;n Telef&oacute;nica
                            </p>
                            <hr>
                            <p class="text-center">
                                <b style="font-size: 15px;">&Aacute;rea Legal</b><br>
                                Conmutador: 961 61 87530, ext. 22022
                            </p>

                            <p class="text-center">
                                <b style="font-size: 15px;">&Aacute;rea Financiera</b><br>
                                Conmutador: 961 61 87530, ext. 22351
                            </p>

                            <p class="text-center">
                                <b style="font-size: 15px;">&Aacute;rea T&eacute;cnica</b><br>
                                Conmutador: 961 61 87530, ext. 22232
                            </p>                        
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<!--end::Main-->
		
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</div>
		<!--end::Scrolltop-->
		
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->

		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{asset('public/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('public/assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
		<script src="{{asset('public/assets/js/scripts.bundle.js')}}"></script>

		<script src="{{asset('public/assets/plugins/confirm/js/jquery-confirm.js')}}"></script>

	
		@yield('js')
      
        <script type="text/javascript">
            var project_name= "/cruc_anepaan";
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