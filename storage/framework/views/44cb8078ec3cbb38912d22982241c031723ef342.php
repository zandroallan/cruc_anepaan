<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<title>Sircse | Web</title>
		<meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		
		<link rel="stylesheet" href="<?php echo e(asset('public/assets/plugins/global/plugins.bundle.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/assets/plugins/custom/prismjs/prismjs.bundle.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/assets/css/style.bundle.css')); ?>">

		<link rel="stylesheet" href="<?php echo e(asset('public/css/cssHeader.css')); ?>">

		<link rel="stylesheet" href="<?php echo e(asset('public/assets/plugins/confirm/css/jquery-confirm.css')); ?>">
		
		<link rel="shortcut icon" href="<?php echo e(asset('public/assets/media/logos/favicon.ico')); ?>">

		<?php echo $__env->yieldContent('styles'); ?>
	</head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile header-mobile-fixed">
			<div class="d-flex align-items-center">
				<!--begin::Logo-->
				<a href="#" class="mr-7">
					<img alt="Logo" src="<?php echo e(asset('public/img2/saybg_blanco.png')); ?>" class="max-h-30px" />
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
										<img alt="Logo" src="<?php echo e(asset('public/img2/saybg_blanco.png')); ?>" class="max-h-65px" />
									</a>
									<!--end::Logo-->
								</div>
								<!--end::Left-->
								<!--begin::Topbar-->
								<div class="topbar">
									<!--begin::Tablet & Mobile Search-->
									<div class="dropdown d-flex d-lg-none">
										<!--begin::Toggle-->
										<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
											<div class="btn btn-icon btn-lg btn-dropdown mr-1">
												<span class="svg-icon svg-icon-xl">
													<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
															<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>
											</div>
										</div>
										<!--end::Toggle-->
										<!--begin::Dropdown-->
										<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
											<div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
												<!--begin:Form-->
												<form method="get" class="quick-search-form">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<span class="svg-icon svg-icon-lg">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
														</div>
														<input type="text" class="form-control" placeholder="Search..." />
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="quick-search-close ki ki-close icon-sm text-muted"></i>
															</span>
														</div>
													</div>
												</form>
												<!--end::Form-->
												<!--begin::Scroll-->
												<div class="quick-search-wrapper scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
												<!--end::Scroll-->
											</div>
										</div>
										<!--end::Dropdown-->
									</div>
									<!--end::Tablet & Mobile Search-->
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
												<span class="pulse-ring"></span>
											</div>
										</div>
										<!--end::Toggle-->
										<!--begin::Dropdown-->
										<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
											<form>
												<!--begin::Header-->
												<div class="d-flex flex-column pt-12 bg-dark-o-5 rounded-top">
													<!--begin::Title-->
													<h4 class="d-flex flex-center">
														<span class="text-dark">Notificaticones</span>
														<span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">23</span>
													</h4>
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
																<!--begin::Symbol-->
																<div class="symbol symbol-40 symbol-light-success mr-5">
																	<span class="symbol-label">
																		<span class="svg-icon svg-icon-lg svg-icon-success">
																			<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24" />
																					<path d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z" fill="#000000" fill-rule="nonzero" transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
																					<path d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z" fill="#000000" opacity="0.3" />
																				</g>
																			</svg>
																			<!--end::Svg Icon-->
																		</span>
																	</span>
																</div>
																<!--end::Symbol-->
																<!--begin::Text-->
																<div class="d-flex flex-column font-weight-bold">
																	<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Financiera</a>
																	<span class="text-muted">Web Design &amp; Development</span>
																</div>
																<!--end::Text-->
															</div>
															<!--end::Item-->
														</div>
														<!--end::Scroll-->
														<!--begin::Action-->
														<div class="d-flex flex-center pt-7">
															<a href="#" class="btn btn-light-primary font-weight-bold text-center">Ver todas</a>
														</div>
														<!--end::Action-->
													</div>
													<!--end::Tabpane-->
													
													<!--begin::Tabpane-->
													<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
														<!--begin::Nav-->
														<div class="d-flex flex-center text-center text-muted min-h-200px">All caught up!
														<br />No new notifications.</div>
														<!--end::Nav-->
													</div>
													<!--end::Tabpane-->
												</div>
												<!--end::Content-->
											</form>
										</div>
										<!--end::Dropdown-->
									</div>
									<!--end::Notifications-->
								
									<!--begin::User-->
									<div class="topbar-item">
										<div class="btn btn-icon w-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
											<div class="d-flex text-right pr-3">
												<span class="text-white font-weight-bolder font-size-sm d-none d-md-inline"><?php echo e(Auth::User()->name); ?></span>
											</div>
											<span class="symbol symbol-35">
												<span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-15">S</span>
											</span>
										</div>
									</div>
									<!--end::User-->
								</div>
								<!--end::Topbar-->
							</div>
							<!--end::Container-->
						</div>
						

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


					                        <li class="menu-item menu-item-active" aria-haspopup="true">
					                            <a class="menu-link" href="<?php echo e(route('mis-tramites.index')); ?>">
					                                <span class="menu-text">
					                                	<i class="fe fe-airplay"></i> Inicio
					                                </span>
					                            </a>
					                        </li>
					                        <li class="menu-item">
					                            <a class="menu-link" href="<?php echo e(Route('tramites.seguimientos')); ?>">
					                            	<span class="menu-text">
					                            		<i class="fa fa-rch"></i> Avance Trámite
						                            </span>
					                            </a>
					                        </li>                        
					                        <li class="menu-item">
					                            <a class="menu-link" href="<?php echo e(Route('mis-observaciones.index')); ?>">
					                            	<span class="menu-text">
						                                <?php if( $count_obs!=0 && $total_obs[0]->id_c_tramites_seguimiento == 2 ): ?>
						                                	<span class="badge pull-right"><?php echo $count_obs; ?></span>
						                                <?php endif; ?>
						                                <i class="fe fe-eye"></i> Observaciones
						                            </span>
					                            </a>                                
					                        </li>
					                        <li class="menu-item">
					                            <a class="menu-link" href="<?php echo e(Route('descargas-f.index')); ?>">
					                            	<span class="menu-text">
						                            	<i class="fe fe-file-text"></i> Formatos
						                            </span>
					                            </a>                    
					                        </li>
					                        <li class="menu-item">
					                            <a class="menu-link" href="#mdlAtencion" data-toggle="modal">
					                            	<span class="menu-text">
						                            	<i class="fe fe-phone-call"></i> Atencion telefonica
						                            </span>
					                            </a>               
					                        </li>
                   
										</ul>
										<!--end::Header Nav-->
									</div>
									<!--end::Header Menu-->
								</div>
								<!--end::Header Menu Wrapper-->
								<!--begin::Desktop Search-->
								<div class="d-none d-lg-flex align-items-center">
									<div class="quick-search quick-search-inline ml-4 w-250px" id="kt_quick_search_inline">
										<!--begin::Form-->
										<form method="get" class="quick-search-form">
											<div class="input-group rounded">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<span class="svg-icon svg-icon-lg">
															<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																	<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
												<input type="text" class="form-control h-40px" placeholder="Search..." />
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="quick-search-close ki ki-close icon-sm"></i>
													</span>
												</div>
											</div>
										</form>
										<!--end::Form-->
										<!--begin::Search Toggle-->
										<div id="kt_quick_search_toggle" data-toggle="dropdown" data-offset="0px,0px"></div>
										<!--end::Search Toggle-->
										<!--begin::Dropdown-->
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-anim-up">
											<div class="quick-search-wrapper scroll" data-scroll="true" data-height="350" data-mobile-height="200"></div>
										</div>
										<!--end::Dropdown-->
									</div>
								</div>
								<!--end::Desktop Search-->
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
									<?php echo $__env->yieldContent('breadcrumb'); ?>
								</div>
								<!--end::Info-->
								<!--begin::Toolbar-->
								<div class="d-flex align-items-center flex-wrap">
									<?php echo $__env->yieldContent('buttons'); ?>
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
								<?php echo $__env->yieldContent('content'); ?>
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
		<script src="<?php echo e(asset('public/assets/plugins/global/plugins.bundle.js')); ?>"></script>
		<script src="<?php echo e(asset('public/assets/plugins/custom/prismjs/prismjs.bundle.js')); ?>"></script>
		<script src="<?php echo e(asset('public/assets/js/scripts.bundle.js')); ?>"></script>

		<script src="<?php echo e(asset('public/assets/plugins/confirm/js/jquery-confirm.js')); ?>"></script>

	
		<?php echo $__env->yieldContent('js'); ?>
      
        <script type="text/javascript">
            var project_name= "/sircse";
            var vuri = window.location.origin + '/sircse';

            $(document).ready(
            	function () {
                	<?php echo $__env->yieldContent('script'); ?>
            	}
            );
        </script>
	
	</body>
	<!--end::Body-->
</html><?php /**PATH C:\AppServ\apps\sircse\resources\views/layouts/backend.blade.php ENDPATH**/ ?>