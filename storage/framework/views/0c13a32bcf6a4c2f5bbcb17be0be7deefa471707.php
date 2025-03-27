

<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <?php echo Html::script('template/admin/assets/js/demo/timeline.demo.js');; ?>

    <?php echo Html::script('template/admin/assets/plugins/sweetalert/dist/sweetalert.min.js');; ?>

    <?php echo Html::script('js/backend/notificacion-acusar.js');; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <h2 class="main-content-title tx-24 mg-b-5">Notificaciones</h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><?php echo html_entity_decode(link_to_route('notificaciones.observaciones', "Notificaciones", null, [])); ?></li>
    <li class="breadcrumb-item active">Nuevo trámite</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">                
                <div class="card-body">
                    <div class="vtimeline">

                        <?php $__currentLoopData = $notificaciones_forzadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notificacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="timeline-wrapper timeline-wrapper-primary">
                            <div class="timeline-badge"></div>
                            <div class="timeline-panel">
                                <?php if($notificacion->id_c_notificacion!=5): ?>
                                <div class="timeline-heading">
                                    <span class="userimage"><?php echo Html::image('img/logo-shyfp.jpg', 'alt', []); ?></span>
                                    <h5 class="text-center">Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal</h5>
                                    <h6 class="timeline-title">Trámite <?php echo e($notificacion->folio); ?></h6>
                                    <h6 class="timeline-title">Fecha notificación <?php echo e($notificacion->fecha); ?></h6>
                                </div>
                                <div class="timeline-body">
                                    <p><b>Advertencia!</b> Se han encontrado observaciones en este tramite, las cuales puede solventar en el apartado de <b>"Observaciones"</b>.</p>
                                    <p><?php echo $notificacion->descripcion; ?></p>
                                </div>
                                <?php else: ?>
                                    <div class="timeline-body">
                                        <p><?php echo $notificacion->descripcion; ?></p>
                                    </div>
                                    
                                <?php endif; ?>
                                <div class="timeline-footer d-flex align-items-center flex-wrap"> 
                                    <button class="btn btn-primary f-s-12 rounded-corner" onclick="acusar(<?php echo e($notificacion->id); ?>)" type="button">Acusar de recibido</button>
                                    <!--span class="ml-md-auto"><i class="fe fe-calendar text-muted mr-1"></i>Fecha: <?php echo e($notificacion->fecha); ?></span-->
                                </div>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/cores/c-sircse/resources/views/notificaciones-observaciones.blade.php ENDPATH**/ ?>