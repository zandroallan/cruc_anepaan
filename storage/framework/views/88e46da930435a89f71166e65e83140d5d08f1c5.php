	

		<?php $__env->startSection('styles'); ?>	

			<link href="<?php echo e(asset('public/css/tabs.css')); ?>" rel="stylesheet"/>

		<?php $__env->stopSection(); ?>

		<?php $__env->startSection('js'); ?>

			<script src="<?php echo e(asset('public/js/backend/general.js')); ?>"></script>			
			<script src="<?php echo e(asset('public/js/backend/nuevo-tramite.js')); ?>"></script>
			<!--Archivos para los documentos de las areas-->
			<script src="<?php echo e(asset('public/js/backend/filesDoctos/jsDocumentosTools.js')); ?>"></script>	
			<script src="<?php echo e(asset('public/js/backend/filesDoctos/jsDocumentosLegal.js')); ?>"></script>	
			<script src="<?php echo e(asset('public/js/backend/filesDoctos/jsDocumentosFinanciera.js')); ?>"></script>	
			<script src="<?php echo e(asset('public/js/backend/filesDoctos/jsDocumentosTecnica.js')); ?>"></script>	
			<!--Archivos para los formularios-->
			<script src="<?php echo e(asset('public/js/backend/filesForms/jsCombos.js')); ?>"></script>
			<script src="<?php echo e(asset('public/js/backend/filesForms/mdl_area_legal.js')); ?>"></script>	
			<script src="<?php echo e(asset('public/js/backend/filesForms/mdl_rep_tec.js')); ?>"></script>
			<script src="<?php echo e(asset('public/js/backend/filesForms/jsChecks.js')); ?>"></script>	
			<!-- Archivos para los form area legal-->
			<script src="<?php echo e(asset('public/js/backend/filesForms/jsLegal.js')); ?>"></script>
			<script src="<?php echo e(asset('public/js/backend/filesForms/jsFinanciera.js')); ?>"></script>
			<script src="<?php echo e(asset('public/js/backend/filesForms/contacto.js')); ?>"></script>
			
		<?php $__env->stopSection(); ?>

		<?php $__env->startSection('buttons'); ?>

			<?php 
				$cierreVentanilla=0;
				
				if ( count($idRegistroAutorizado) > 0 ) {
					foreach ($idRegistroAutorizado as $key => $value) {
						if ( (int)$value == (int)Auth::User()->id_registro ) {
							$cierreVentanilla = -1;
						}
					}
				}
				if ( $ventanillaCerrada && $cierreVentanilla == 0 ) {
				    $cierreVentanilla = 1;
				}
				else { 
			?>
				<?php if( $terminos != 0 ): ?>
					<button class="btn btn-outline-primary btn-sm mr-3 my-2 my-lg-0" onclick="send_1(this);">
						<i class="fa fa-save"></i> <b>Guardar avance</b>
					</button>
					<button class="btn btn-outline-success btn-sm mr-3 my-2 my-lg-0" onclick="send(this);">
						<i class="fa fa-envelope"></i> <b>Enviar trámite</b>
					</button>			
				<?php endif; ?>

			<?php } ?>

			<a href="<?php echo e(route($current_route.'.index')); ?>" class="btn btn-outline-dark btn-sm mr-3 my-2 my-lg-0">
				<i class="fa fa-arrow-left"></i> <b>Atrás</b>
			</a> 
		<?php $__env->stopSection(); ?>


		<?php $__env->startSection('title'); ?>
			<h2 class="main-content-title tx-24 mg-b-5">Nuevo trámite</h2>
		<?php $__env->stopSection(); ?>

		<?php $__env->startSection('breadcrumb'); ?>
			<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?php echo html_entity_decode(link_to_route($current_route.'.index', $title, null, [])); ?></h5>
		
			<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
			<span class="text-muted font-weight-bold mr-4">Generando un nuevo trámite</span>
		<?php $__env->stopSection(); ?>

		<?php $__env->startSection('script'); ?>
			$('.fc-datepicker').datepicker({
				dateFormat: 'dd/mm/yy',
				showOtherMonths: true,
				selectOtherMonths: true
			});

			id_tramite_global = <?php echo e(Auth::User()->id_registro); ?>;		

			$('#customSwitch1').click(function() {
			    if ($(this).is(':checked')) {
			      aceptar_terminos();
			    }
		    });

		    if ( <?php echo e($terminos); ?> == 1 ) {

				cargar_documentacion_requerida_legal(<?php echo e($id_tipo_tramite); ?>, 2, <?php echo e($datos->id); ?>);
				cargar_documentacion_requerida_tecnica(<?php echo e($id_tipo_tramite); ?>, 4, <?php echo e($datos->id); ?>, <?php echo e($datos->tec_acredita_tmp); ?>);

				if ( <?php echo e($datos->id_sujeto); ?> ==1 ) {
					cargar_documentacion_requerida_financiera(<?php echo e($id_tipo_tramite); ?>, 3, <?php echo e($datos->id); ?>, <?php echo e($datos->obligado_dec_isr); ?>);
				}

				cargar_socios_legales(<?php echo e(Auth::User()->id_registro); ?>);

				get_capital_contable();
				get_estados_financieros();
				get_datos_legales(<?php echo e(Auth::User()->id_registro); ?>);
				get_acta_constitutiva(<?php echo e(Auth::User()->id_registro); ?>);
				get_acta_constitutiva_modificacion(<?php echo e(Auth::User()->id_registro); ?>);
				get_representante_legal(<?php echo e(Auth::User()->id_registro); ?>);
				cargar_rtecs(<?php echo e(Auth::User()->id_registro); ?>);	

				if ( <?php echo e($id_contacto); ?> != 0 ) {
					$("#btn-guardar-contacto").html('Editar contacto');
					cargar_contacto(); 
					$('#iconContacto').show();
				}
				else {
					$('#iconContacto').hide();
				}
				
				tipo_persona(<?php echo e($datos->id_tipo_persona); ?>);
						
				if ( <?php echo e($datos->id_tipo_persona); ?> != 1 ) {
					$('#vnavSocioLegal').show();
					$('#vtabSocioLegal').show();
				}
				else {
					$('#vnavSocioLegal').hide();
					$('#vnavSocioLegal').hide();
				}
			}

		<?php $__env->stopSection(); ?>

		<?php $__env->startSection('content'); ?>

			<?php echo $__env->make('backend.encabezado', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			
			<?php if($terminos == 1): ?>
			<div class="alert alert-custom alert-dark fade show" role="alert">
			    <div class="alert-icon"><i class="flaticon-warning"></i></div>
			    <div class="alert-text">
			    	<h5>Trámite en proceso de <span class="text-primary"><?php echo e($lbl_tramite_siguiente); ?></span>
			    		<br />
					<strong style="color: #ed8b00"><i class="fe fe-info"></i> Advertencia!</strong> Este tramite aun no ha sido enviado.</h5>
				</div>			    
			</div>	
			<?php endif; ?>

			<?php if( $cierreVentanilla == 1 ): ?>
			<div class="alert alert-custom alert-outline-2x alert-outline-dark fade show mb-5" role="alert">
			    <div class="alert-icon"><i class="flaticon-warning"></i></div>
			    <div class="alert-text">
			    	<b>Cierre de Ventanilla:</b>
					A las y los Contratistas o Supervisores Externos, se les comunica el cierre de la ventanilla, para el trámite y expedición de las constancias de Registro de Contratistas y de Registro Supervisores Externos concluyó el día 07 de Octubre de 2022 hasta nuevo aviso.
			    </div>
			</div>
			<?php endif; ?>
			
			<?php if($terminos==0): ?>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<center>
						<div class="alert alert-custom alert-outline-2x alert-outline-dark fade show mb-5" role="alert">
						    <div class="alert-icon"><i class="flaticon-warning"></i></div>
						    <div class="alert-text">
						    	<h5><i class="fa fa-info-circle"></i> Atención</h5>
								<p>
									Para poder continuar con su tramite es necesario que lea todos los lineamientos, por ultimo debera aceptar los terminos y condiciones de lo contrario no podra continuar con el tramite correspondiente.
								</p>
								<div class="custom-control custom-switch">
								  <input type="checkbox" class="custom-control-input" id="customSwitch1" name="customSwitch1">
								  <label class="custom-control-label" for="customSwitch1"><b>Acepto todos los terminos y condiciones a los que estoy sujeto.</b></label>
								</div>
						    </div>
						</div>
					</center>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<center><embed src="<?php echo e(asset('public/descargas/LineamientosCS.pdf')); ?>" width="1000" height="550" alt="pdf" /></center>
				</div>			
			</div>
			<?php else: ?>
			<div class="card card-custom">
				<div class="card-body">
					<?php echo $__env->make('backend.mis-tramites.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			</div>
			<?php endif; ?>

		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\sircse\resources\views/backend/mis-tramites/nuevo-tramite.blade.php ENDPATH**/ ?>