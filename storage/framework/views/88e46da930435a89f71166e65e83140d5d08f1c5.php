	

		<?php $__env->startSection('styles'); ?>	

			<link href="<?php echo e(asset('public/dashlead/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet"/>

		<?php $__env->stopSection(); ?>

		<?php $__env->startSection('js'); ?>

			<script src="<?php echo e(asset('public/dashlead/plugins/jquery-ui/ui/widgets/datepicker.js')); ?>"></script>
			<script src="<?php echo e(asset('public/dashlead/plugins/select2/js/select2.min.js')); ?>"></script>
			<script src="<?php echo e(asset('public/dashlead/js/select2.js')); ?>"></script>
			<script src="<?php echo e(asset('public/js/backend/general.js')); ?>"></script>			
			<script src="<?php echo e(asset('public/js/backend/mis-tramites.js')); ?>"></script>
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
					<button class="btn ripple btn-dark" onclick="send_1(this);">
						<i class="fa fa-save"></i> <b>Guardar avance</b>
					</button>
					<button class="btn ripple btn-dark" onclick="send(this);">
						<i class="fe fe-navigation"></i> <b>Enviar trámite</b>
					</button>			
				<?php endif; ?>

			<?php } ?>

			<a href="<?php echo e(route($current_route.'.index')); ?>" class="btn ripple btn-dark">
				<i class="fa fa-arrow-left"></i> <b>Atrás</b>
			</a> 
		<?php $__env->stopSection(); ?>


		<?php $__env->startSection('title'); ?>
			<h2 class="main-content-title tx-24 mg-b-5">Nuevo trámite</h2>
		<?php $__env->stopSection(); ?>

		<?php $__env->startSection('breadcrumb'); ?>

		    <li class="breadcrumb-item"><?php echo html_entity_decode(link_to_route($current_route.'.index', $title, null, [])); ?></li>
		    <li class="breadcrumb-item active">Generando un nuevo trámite</li>

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

		    if(<?php echo e($terminos); ?>==1) {

				cargar_documentacion_requerida_legal(<?php echo $id_tipo_tramite; ?>, 2, <?php echo $datos->id; ?>)

				if(<?php echo $datos->id_sujeto; ?>==1){
					cargar_documentacion_requerida_financiera(<?php echo $id_tipo_tramite; ?>, 3, <?php echo $datos->id; ?>, <?php echo $datos->obligado_dec_isr; ?>);
				}

				cargar_documentacion_requerida_tecnica(<?php echo $id_tipo_tramite; ?>, 4, <?php echo $datos->id; ?>, <?php echo $datos->tec_acredita_tmp; ?>)

				cargar_socios_legales(<?php echo e(Auth::User()->id_registro); ?>);

				get_datos_legales(<?php echo e(Auth::User()->id_registro); ?>);
				get_acta_constitutiva(<?php echo e(Auth::User()->id_registro); ?>);
				get_acta_constitutiva_modificacion(<?php echo e(Auth::User()->id_registro); ?>);
				get_representante_legal(<?php echo e(Auth::User()->id_registro); ?>);

				cargar_rtecs(<?php echo e(Auth::User()->id_registro); ?>);	

				if(<?php echo e($id_contacto); ?>!=0)
				{
					$("#btn-guardar-contacto").html('Editar contacto');
					cargar_contacto(); 
					$('#iconContacto').show();
				}
				else
				{
					$('#iconContacto').hide();
				}
				
				tipo_persona(<?php echo $datos->id_tipo_persona; ?>);
						
				if(<?php echo $datos->id_tipo_persona; ?> != 1){
					$('#vnavSocioLegal').show();
					$('#vtabSocioLegal').show();
				}
				else {
					$('#vnavSocioLegal').hide();
					$('#vnavSocioLegal').hide();
				}
				
				//cargar_socios_legales(<?php echo e($datos->id); ?>);
			}

		<?php $__env->stopSection(); ?>

		<?php $__env->startSection('content'); ?>

			<?php echo $__env->make('backend.encabezado', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="pd-10 bg-gray-400" >
						<h5 class="text-dark main-content-label">
							Trámite en proceso de <span class="text-primary"><?php echo e($lbl_tramite_siguiente); ?></span><br />
							<strong style="color: #ed8b00"><i class="fe fe-info"></i> Advertencia!</strong> Este tramite aun no ha sido enviado.
						</h5>
					</div>
				</div>							
			</div>
			<br />			
			
			<?php if( $cierreVentanilla == 1 ): ?>			
			<div class="alert alert-warning fade show m-b-0">		
				<b>Cierre de Ventanilla:</b>
				A las y los Contratistas o Supervisores Externos, se les comunica el cierre de la ventanilla, para el trámite y expedición de las constancias de Registro de Contratistas y de Registro Supervisores Externos concluyó el día 07 de Octubre de 2022 hasta nuevo aviso.
			</div>
			<br />
			<?php endif; ?>
			
			<?php if($terminos==0): ?>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<center>
					<div class="alert alert-warning m-b-0">
						<h5><i class="fa fa-info-circle"></i> Atención</h5>
						<p>
							Para poder continuar con su tramite es necesario que lea todos los lineamientos, por ultimo debera aceptar los terminos y condiciones de lo contrario no podra continuar con el tramite correspondiente.
						</p>
						<div class="custom-control custom-switch">
						  <input type="checkbox" class="custom-control-input" id="customSwitch1" name="customSwitch1">
						  <label class="custom-control-label" for="customSwitch1"><b>Acepto todos los terminos y condiciones a los que estoy sujeto.</b></label>
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
			<div class="row">
				<div class="col-lg-12">
					<div class="card custom-card">												
						<div aria-multiselectable="true" class="accordion" id="accordion" role="tablist">
							<div class="card">
								<div class="card-header" id="headingOne" role="tab">
									<a aria-controls="collapseOne" style="background-color: #333333; color: #fff;" aria-expanded="true" data-toggle="collapse" href="#collapseOne">Información importante</a>
								</div>
								<div aria-labelledby="headingOne" class="collapse show" data-parent="#accordion" id="collapseOne" role="tabpanel">
									<div class="card-body">										
										<div class="alert alert-warning mb-0" role="alert">
										  <p>La Secretaría procederá al análisis de la documentación proporcionada, en caso de que no cumpla con los requisitos aplicables o se le requiera alguna aclaración. La Secretaría prevendrá por una sola vez, para que subsane la omisión u observaciones dentro del término de <b>cinco días hábiles</b>, contados a partir de que haya surtido efectos la notificación; transcurrido el plazo sin que el solicitante desahogue la prevención, se desechará el trámite de la solicitud, pudiendo el interesado solicitar nuevamente el trámite correspondiente.</p>
										  <hr>
										  <p class="mb-0">La Secretaría tendrá por recibida una solicitud y comenzará a correr el plazo de treinta días naturales, para que otorgue o niegue la constancia de inscripción, modificación o actualización en el registro de Contratistas o de Supervisores Externos, cuando el solicitante solvente las observaciones o presente la documentación completa con todos los requisitos.</p>
										</div>
									</div>
								</div>
							</div>								
						</div>					
					</div>
				</div>
			</div>
			<!-- Inicio del cuerpo -->
			<div class="invoice-content">
					
		        <?php echo $__env->make('backend.mis-tramites.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			</div>
			<?php endif; ?>

		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\sircse\resources\views/backend/mis-tramites/nuevo-tramite.blade.php ENDPATH**/ ?>