

<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- <?php echo Html::script('public/template/admin/assets/js/demo/timeline.demo.js');; ?> -->
    <!-- <?php echo Html::script('public/template/admin/assets/plugins/sweetalert/dist/sweetalert.min.js');; ?> -->
    <?php echo Html::script('public/js/backend/notificacion-acusar.js');; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>

    <h2 class="main-content-title tx-24 mg-b-5">Notificaciones</h2>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>

    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?php echo html_entity_decode(link_to_route('notificaciones.observaciones', "Notificaciones", null, [])); ?></h5> 
    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">Notificación</span>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="card">
        <div class="card-body">
            
            <h5 class="text-center">
                Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal
            </h5>
            <br>

            <div class="example example-basic">
                <div class="example-preview">
                    <div class="timeline timeline-justified timeline-4">
                        <div class="timeline-bar"></div>
                        <div class="timeline-items">


                            <?php $__currentLoopData = $notificaciones_forzadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notificacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="timeline-item">
                                <div class="timeline-badge">
                                    <div class="bg-danger"></div>
                                </div>
                                <div class="timeline-label">
                                    <span class="text-primary font-weight-bold">
                                        Notificación <?php echo e($notificacion->fecha); ?>

                                    </span>
                                </div>
                                <div class="timeline-content">

                                    <?php echo $notificacion->descripcion; ?>


                                    <div class="timeline-footer d-flex align-items-center flex-wrap"> 
                                        <button class="btn btn-primary f-s-12 rounded-corner" onclick="acusar(<?php echo e($notificacion->id); ?>)" type="button">
                                            Acusar de recibido
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


<?php /*

    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">                
                <div class="card-body">
                    <div class="vtimeline">

                        @foreach($notificaciones_forzadas as $notificacion)
                        <div class="timeline-wrapper timeline-wrapper-primary">
                            <div class="timeline-badge"></div>
                            <div class="timeline-panel">
                                @if($notificacion->id_c_notificacion!=5)
                                <div class="timeline-heading">
                                    <span class="userimage">{!! Html::image('img/logo-shyfp.jpg', 'alt', []) !!}</span>
                                    <h5 class="text-center">Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal</h5>
                                    <h6 class="timeline-title">Trámite {{ $notificacion->folio }}</h6>
                                    <h6 class="timeline-title">Fecha notificación {{ $notificacion->fecha }}</h6>
                                </div>
                                <div class="timeline-body">
                                    <p><b>Advertencia!</b> Se han encontrado observaciones en este tramite, las cuales puede solventar en el apartado de <b>"Observaciones"</b>.</p>
                                    <p>{!! $notificacion->descripcion !!}</p>
                                </div>
                                @else
                                    <div class="timeline-body">
                                        <p>{!! $notificacion->descripcion !!}</p>
                                    </div>
                                    
                                @endif
                                <div class="timeline-footer d-flex align-items-center flex-wrap"> 
                                    <button class="btn btn-primary f-s-12 rounded-corner" onclick="acusar({{ $notificacion->id }})" type="button">Acusar de recibido</button>
                                    <!--span class="ml-md-auto"><i class="fe fe-calendar text-muted mr-1"></i>Fecha: {{ $notificacion->fecha }}</span-->
                                </div>

                            </div>
                        </div>
                        @endforeach    
                    </div>
                </div>
            </div>
        </div>
    </div>
    */
    ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\sircse\resources\views/notificaciones-observaciones.blade.php ENDPATH**/ ?>