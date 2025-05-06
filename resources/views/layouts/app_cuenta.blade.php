<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title>CRUC ANEPAAN | Web</title>
		<meta name="description" content="Singin page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<link rel="stylesheet" href="{{asset('public/assets/css/pages/login/login-3.css')}}">

        <link rel="stylesheet" href="{{asset('public/assets/plugins/global/plugins.bundle.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/plugins/custom/prismjs/prismjs.bundle.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/style.bundle.css')}}">

        <link rel="shortcut icon" href="{{ asset('public/assets/media/logos/favicon.ico') }}">

		@yield('styles')
		<style type="text/css">
			
			/* Asegura que el contenedor wizard-nav esté centrado en toda la página */
			.wizard-nav {
			    display: flex; /* Activa flexbox */
			    justify-content: center; /* Centra los elementos horizontalmente */
			    align-items: center; /* Centra los elementos verticalmente */
			    height: 100vh; /* Asegura que el contenedor tenga al menos la altura de la ventana */
			    flex-direction: column; /* Coloca los elementos en columna */
			}

			@media (min-width: 992px) {
			  .login.login-3 .login-aside .aside-img {
			    min-height: 550px !important;
			    background-size: 700px;
			  }
			}

			.colorinpt
            {
                color: #b1212d;
            }

            .radio-tile-group {
				 display: flex;
				 flex-wrap: wrap;
				 justify-content: center;
			}
			 .radio-tile-group .input-container {
				 position: relative;
				 height: 7rem;
				 width: 7rem;
				 margin: 0.5rem;
			}
			 .radio-tile-group .input-container .radio-button {
				 opacity: 0;
				 position: absolute;
				 top: 0;
				 left: 0;
				 height: 100%;
				 width: 100%;
				 margin: 0;
				 cursor: pointer;
			}
			 .radio-tile-group .input-container .radio-tile {
				 display: flex;
				 flex-direction: column;
				 align-items: center;
				 justify-content: center;
				 width: 100%;
				 height: 100%;
				 border: 2px solid #1d1d1b;
				 border-radius: 5px;
				 padding: 1rem;
				 transition: transform 300ms ease;
			}
			 .radio-tile-group .input-container .icon svg {
				 fill: #1d1d1b;
				 width: 3rem;
				 height: 3rem;
			}
			 .radio-tile-group .input-container .radio-tile-label {
				 text-align: center;
				 font-size: 0.75rem;
				 font-weight: 600;
				 text-transform: uppercase;
				 letter-spacing: 1px;
				 color: #1d1d1b;
			}
			 .radio-tile-group .input-container .radio-button:checked + .radio-tile {
				 background-color: #b1212d;
				 border: 2px solid #b1212d;
				 color: white;
				 transform: scale(1.1, 1.1);
			}
			 .radio-tile-group .input-container .radio-button:checked + .radio-tile .icon svg {
				 fill: white;
				 background-color: #b1212d;
			}
			 .radio-tile-group .input-container .radio-button:checked + .radio-tile .radio-tile-label {
				 color: white;
				 background-color: #b1212d;
			}
			.myshadow 
            {
                box-shadow: 0 4px 10px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            }

            .wrapper{
			  display: inline-flex;
			  /*background: #fff;*/
			  height: 100px;
			  width: 400px;
			  align-items: center;
			  justify-content: space-evenly;
			  /*border-radius: 5px;*/
			  padding: 20px 15px;
			  /*box-shadow: 5px 5px 30px rgba(0,0,0,0.2);*/
			}
			.wrapper .option{
			  /*background: #fff;*/
			  height: 100%;
			  width: 100%;
			  display: flex;
			  align-items: center;
			  justify-content: space-evenly;
			  margin: 0 10px;
			  border-radius: 5px;
			  cursor: pointer;
			  padding: 0 10px;
			  border: 2px solid #1d1d1b;
			  transition: all 0.3s ease;
			}
			.wrapper .option .dot{
			  height: 20px;
			  width: 20px;
			  background: #1d1d1b;
			  border-radius: 50%;
			  position: relative;
			}
			.wrapper .option .dot::before{
			  position: absolute;
			  content: "";
			  top: 4px;
			  left: 4px;
			  width: 12px;
			  height: 12px;
			  background: #b1212d;
			  border-radius: 50%;
			  opacity: 0;
			  transform: scale(1.5);
			  transition: all 0.3s ease;
			}
			.wrapper input[type="radio"]{
			  display: none;
			}
			#option-1:checked:checked ~ .option-1,
			#option-2:checked:checked ~ .option-2{
			  border-color: #b1212d;
			  background: #b1212d;
			}
			#option-1:checked:checked ~ .option-1 .dot,
			#option-2:checked:checked ~ .option-2 .dot{
			  background: #fff;
			}
			#option-1:checked:checked ~ .option-1 .dot::before,
			#option-2:checked:checked ~ .option-2 .dot::before{
			  opacity: 1;
			  transform: scale(1);
			}
			.wrapper .option span{
			  font-size: 20px;
			  color: #808080;
			}
			#option-1:checked:checked ~ .option-1 span,
			#option-2:checked:checked ~ .option-2 span{
			  color: #fff;
			}
		</style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid wizard" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside d-flex flex-column flex-row-auto">				
					<!--begin::Aside Bottom-->
					<div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center" style="background-image: url('{{ asset('public/img2/wizard.png') }}');">
						
						<!--begin: Wizard Nav-->
						<div class="wizard-nav mt-50 pt-5 pt-lg-30 pl-25">
							<!--begin::Wizard Steps-->
							<div class="wizard-steps">
								<!--begin::Wizard Step 1 Nav-->
								<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
									<div class="wizard-wrapper">
										<div class="wizard-icon">
											<i class="wizard-check ki ki-check"></i>
											<span class="wizard-number">1</span>
										</div>
										<div class="wizard-label">
											<h3 class="wizard-title text-white">Contratista</h3>
											<div class="wizard-desc">Información del contratista</div>
										</div>
									</div>
								</div>
								<!--end::Wizard Step 1 Nav-->
								<!--begin::Wizard Step 2 Nav-->
								<div class="wizard-step" data-wizard-type="step">
									<div class="wizard-wrapper">
										<div class="wizard-icon">
											<i class="wizard-check ki ki-check"></i>
											<span class="wizard-number">2</span>
										</div>
										<div class="wizard-label">
											<h3 class="wizard-title text-white">Domicilio</h3>
											<div class="wizard-desc">Datos domiciliares del contratista</div>
										</div>
									</div>
								</div>
								<!--end::Wizard Step 2 Nav-->
								<!--begin::Wizard Step 3 Nav-->
								<div class="wizard-step" data-wizard-type="step">
									<div class="wizard-wrapper">
										<div class="wizard-icon">
											<i class="wizard-check ki ki-check"></i>
											<span class="wizard-number">3</span>
										</div>
										<div class="wizard-label">
											<h3 class="wizard-title text-white">Cuenta</h3>
											<div class="wizard-desc">Datos de la cuenta de acceso</div>
										</div>
									</div>
								</div>
								<!--end::Wizard Step 3 Nav-->
							</div>
							<!--end::Wizard Steps-->
						</div>
						<!--end: Wizard Nav-->


					</div>
					<!--end::Aside Bottom-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="login-content flex-column-fluid d-flex flex-column p-10">
					<!--begin::Top-->
					<div class="text-right d-flex justify-content-center">
						
					</div>
					<!--end::Top-->
					<!--begin::Wrapper-->
					<div class="d-flex flex-row-fluid flex-center">
						<!--begin::Signin-->
						<div class="login-form login-form-signup">
							<!--begin::Form-->
							<form class="form" novalidate="novalidate" id="kt_login_signup_form">
								<!--begin::Title-->
								<div class="pb-10 pb-lg-15">
									<div class="row">
										<div class="col-md-8">
											<h3 class="font-weight-bolder text-dark display5">Crear cuenta</h3>
										</div>
										<div class="col-md-4 text-right pt-3">
											<a href="{{ url('/') }}" class="font-weight-bolder colorinpt font-size-h4"><i class="fa fa-arrow-left colorinpt"></i> Regresar</a>
										</div>
									</div>									
								</div>
								<!--begin: Wizard Step 1-->
								<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
									
									<!--begin::Title-->
									<div class="row mb-3">
										<div class="col-md-6">
											<div class="wizard-desc text-center font-size-h6 font-weight-bolder text-dark">Tipo de trámite</div>
											<div class="radio-tile-group">
											    <div class="input-container">
											      <input  class="radio-button" type="radio" name="id_sujeto" id="id_sujeto_1" value="1" checked  />
											      <div class="radio-tile">
											        <div class="icon walk-icon">
											          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M256 32c-17.7 0-32 14.3-32 32l0 2.3 0 99.6c0 5.6-4.5 10.1-10.1 10.1c-3.6 0-7-1.9-8.8-5.1L157.1 87C83 123.5 32 199.8 32 288l0 64 512 0 0-66.4c-.9-87.2-51.7-162.4-125.1-198.6l-48 83.9c-1.8 3.2-5.2 5.1-8.8 5.1c-5.6 0-10.1-4.5-10.1-10.1l0-99.6 0-2.3c0-17.7-14.3-32-32-32l-64 0zM16.6 384C7.4 384 0 391.4 0 400.6c0 4.7 2 9.2 5.8 11.9C27.5 428.4 111.8 480 288 480s260.5-51.6 282.2-67.5c3.8-2.8 5.8-7.2 5.8-11.9c0-9.2-7.4-16.6-16.6-16.6L16.6 384z"/></svg>
											        </div>
											        <label for="walk" class="radio-tile-label">Contratista</label>
											      </div>
											    </div>

											    <div class="input-container">
											      <input class="radio-button" type="radio" name="id_sujeto" id="id_sujeto_2" value="2"  />
											      <div class="radio-tile">
											        <div class="icon bike-icon">
											         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c1.8 0 3.5-.2 5.3-.5c-76.3-55.1-99.8-141-103.1-200.2c-16.1-4.8-33.1-7.3-50.7-7.3l-91.4 0zm308.8-78.3l-120 48C358 277.4 352 286.2 352 296c0 63.3 25.9 168.8 134.8 214.2c5.9 2.5 12.6 2.5 18.5 0C614.1 464.8 640 359.3 640 296c0-9.8-6-18.6-15.1-22.3l-120-48c-5.7-2.3-12.1-2.3-17.8 0zM591.4 312c-3.9 50.7-27.2 116.7-95.4 149.7l0-187.8L591.4 312z"/></svg>
											        </div>
											        <label for="bike" class="radio-tile-label">Supervisor</label>
											      </div>
											    </div>
											  </div>
										</div>

										<div class="col-md-6">
											<div class="wizard-desc text-center font-size-h6 font-weight-bolder text-dark">Tipo de persona</div>
											<div class="radio-tile-group">
											    <div class="input-container">
											      <input  class="radio-button" type="radio" name="id_tipo_persona" id="id_tipo_persona_1"  onclick="tipo_persona(this.value);" value="1" checked  />
											      <div class="radio-tile">
											        <div class="icon walk-icon">
											          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304l0 128c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-223.1L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6l29.7 0c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9 232 480c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-128-16 0z"/></svg>
											        </div>
											        <label for="walk" class="radio-tile-label">Física</label>
											      </div>
											    </div>

											    <div class="input-container">
											      <input class="radio-button" type="radio" name="id_tipo_persona" id="id_tipo_persona_2"  onclick="tipo_persona(this.value);" value="2"  />
											      <div class="radio-tile">
											        <div class="icon bike-icon">
											           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M48 0C21.5 0 0 21.5 0 48L0 464c0 26.5 21.5 48 48 48l96 0 0-80c0-26.5 21.5-48 48-48s48 21.5 48 48l0 80 89.9 0c-6.3-10.2-9.9-22.2-9.9-35.1c0-46.9 25.8-87.8 64-109.2l0-95.9L384 48c0-26.5-21.5-48-48-48L48 0zM64 240c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32zm112-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32zM80 96l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32zM272 96l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16zM576 272a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM352 477.1c0 19.3 15.6 34.9 34.9 34.9l218.2 0c19.3 0 34.9-15.6 34.9-34.9c0-51.4-41.7-93.1-93.1-93.1l-101.8 0c-51.4 0-93.1 41.7-93.1 93.1z"/></svg>
											        </div>
											        <label for="bike" class="radio-tile-label">Moral</label>
											      </div>
											    </div>
											  </div>
										</div>
									</div>


									<!--begin::Form Group-->
									<div class="form-group d-none moral">
										<label class="font-size-h6 font-weight-bolder text-dark">Razón social</label>
										<input type="text" class="form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6" name="razon_social_o_nombre" id="razon_social_o_nombre" placeholder="Ingrese la razon social" />
									</div>
									<!--end::Form Group-->
									<!--begin::Form Group-->
									<div class="form-group fisica">
										<label class="font-size-h6 font-weight-bolder text-dark">Nombre</label>
										<input type="text" class="form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6" name="nombre" id="nombre" placeholder="Ingrese el nombre" />
									</div>
									<!--end::Form Group-->
									<!--begin::Form Group-->
									<div class="form-group fisica">
										<label class="font-size-h6 font-weight-bolder text-dark">Apellido paterno</label>
										<input type="text" class="form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6" name="ap_paterno" id="ap_paterno" placeholder="Ingrese el apellido" />
									</div>
									<!--end::Form Group-->
									<!--begin::Form Group-->
									<div class="form-group fisica">
										<label class="font-size-h6 font-weight-bolder text-dark">Apellido materno</label>
										<input type="text" class="form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6" name="ap_materno" id="ap_materno" placeholder="Ingrese el apellido" />
									</div>
									<!--end::Form Group-->
									<!--begin::Form Group-->
									<div class="form-group fisica">
										<label class="font-size-h6 font-weight-bolder text-dark">CURP</label>
										<input type="text" class="form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6" name="curp" id="curp" placeholder="Ingrese la curp" />
									</div>
									<!--end::Form Group-->
									<!--begin::Form Group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">RFC</label>
										<input type="text" class="form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6" name="rfc" id="rfc" placeholder="Ingrese el rfc" oninput="verificar_rfc_bloqueado(this.value)" />
									</div>
									<!--end::Form Group-->
									<!--begin::Form Group-->
									<div class="form-group fisica">
										<label class="font-size-h6 font-weight-bolder text-dark">Nacionalidad</label>
										{!! Form::select('id_nacionalidad', $nacionalidades, $default_nacionalidad, ['id' => 'id_nacionalidad', 'style'=>'width: 100%;', 'class' => 'form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6']) !!}
									</div>
									<!--end::Form Group-->

									<div class="form-group row  m-b-15 fisica">
										<label class="col-form-label col-md-3 font-size-h6 font-weight-bolder text-dark mt-6">Sexo*</label>
										<div class="col-md-9">
											<div class="wrapper">
											 	<input type="radio" name="sexo" id="option-1" value="1"checked>
											 	<input type="radio" name="sexo" id="option-2" value="2">
											   	<label for="option-1" class="option option-1">
											     	<div class="dot"></div>
											      	<span>Hombre</span>
											    </label>
											   	<label for="option-2" class="option option-2">
											    	<div class="dot"></div>
											      	<span>Mujer</span>
											   	</label>
											</div>
										</div>
									</div>

								</div>
								<!--end: Wizard Step 1-->
								<!--begin: Wizard Step 2-->
								<div class="pb-5" data-wizard-type="step-content">

									<!--begin::Form Group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">Teléfono</label>
										<input type="text" class="form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6" name="telefono" id="telefono" placeholder="Ingrese el teléfono" />
									</div>
									<!--end::Form Group-->
									<!--begin::Form Group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">Correo electrónico</label>
										<input type="email" class="form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6" name="correo" id="correo" placeholder="Ingrese el correo" />
									</div>
									<!--end::Form Group-->
									<!--begin::Form Group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">Tipo identificación</label>
										{!! Form::select('id_tipo_identificacion', $tipo_identificaciones, null, ['id' => 'id_tipo_identificacion', 'style'=>'width: 100%;', 'class' => 'form-control  myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6']) !!}	
									</div>
									<!--end::Form Group-->
									<!--begin::Form Group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">Número identificación</label>
										<input type="email" class="form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6" name="numero_identificacion" id="numero_identificacion" placeholder="Ingrese el numero de identificación" />
									</div>
									<!--end::Form Group-->

								</div>
								<!--end: Wizard Step 2-->
								<!--begin: Wizard Step 3-->
								<div class="pb-5" data-wizard-type="step-content">
									<div class="row">
										<div class="col-md-12">
											<p class="text-justify font-size-h6"><b>Advertencia:</b> La contraseña deberá tener por lo menos 10 caracteres de longitud, contener por lo menos 1 número, 1 letra minúscula, 1 letra mayúscula y 1 caracter especial(@$!%*#?&.).</p>
										</div>
									</div>

									<!--begin::Form Group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">Usuario</label>
										<input type="text" class="form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6" name="nickname" id="nickname" placeholder="Ingrese el nombre de usuario" />
									</div>
									<!--end::Form Group-->

									<!--begin::Form Group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">Contraseña</label>
										<input type="password" class="form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6" name="password" id="password" placeholder="Ingrese la contraseña" />
									</div>
									<!--end::Form Group-->

									<!--begin::Form Group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">Confirmar contraseña</label>
										<input type="password" class="form-control myshadow h-auto py-3 px-6 border-0 rounded-lg font-size-h6" name="password_confirmation" id="password_confirmation" placeholder="Confirme la contraseña" />
									</div>
									<!--end::Form Group-->
								</div>
								<!--end: Wizard Step 3-->
								<!--begin: Wizard Actions-->
								<div class="d-flex justify-content-between pt-3">
									<div class="mr-2">
										<button type="button" class="btn btn-light-primary font-weight-bolder font-size-h6 pl-6 pr-8 py-4 my-3 mr-3" data-wizard-type="action-prev">
										<span class="svg-icon svg-icon-md mr-1">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Left-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000)" x="14" y="7" width="2" height="10" rx="1" />
													<path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997)" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>Anterior</button>
									</div>
									<div>
										<button class="btn btn-primary font-weight-bolder font-size-h6 pl-5 pr-8 py-4 my-3" data-wizard-type="action-submit" type="submit" id="kt_login_signup_form_submit_button">Crear cuenta
										<span class="svg-icon svg-icon-md ml-2">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
													<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span></button>
										<button type="button" class="btn btn-primary font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-3" data-wizard-type="action-next">Siguiente
										<span class="svg-icon svg-icon-md ml-1">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
													<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span></button>
									</div>
								</div>
								<!--end: Wizard Actions-->
							</form>
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
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<script src="{{asset('public/assets/plugins/global/plugins.bundle.js')}}"></script>
        <script src="{{asset('public/assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
        <script src="{{asset('public/assets/js/scripts.bundle.js')}}"></script>
		<!--begin::Page Scripts(used by this page)-->
		<!--end::Page Scripts-->

		@yield('js')

		<script type="text/javascript">
            var vuri = window.location.origin + '/cruc_anepaan';

            $(document).ready(
            	function () {
                	@yield('script')

                	// document.getElementById('rfc').addEventListener('keypress', 
                	//   	function(e) {
					    	
					// 	}
					// );

            	}
            );

            function verificar_rfc_bloqueado()
            {
            	// 
		    	$.ajax({
			        type: "GET",
			        url: vuri + '/verificar/rfc/bloqueado',
			        data: {
			        	rfc: document.getElementById('rfc').value
			        },
			        success: function(json) {
			            
			        },
			        error: function(json) {}
			    });
		    	// 
            }

        </script>
	</body>
</html>