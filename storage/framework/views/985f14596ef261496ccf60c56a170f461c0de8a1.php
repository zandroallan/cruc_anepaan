<<<<<<< HEAD
<div class="md-card">
    <div class="user_heading md-bg-gob2-500">
        <div class="user_heading_avatar">
            <div class="thumbnail">
                <img src="<?php echo e(asset('public/img2/sircse.png')); ?>" class="" alt="usuario" width="100%">
            </div>
        </div>
        <div class="user_heading_content">
            <h2 class="heading_b uk-margin-bottom">
                <span class="uk-text-truncate"><?php echo e($datos->razon_social_o_nombre); ?></span>
                <span class="sub-heading"></span>
            </h2>
            <ul class="user_stats">
                <li>
                    <span class="uk-margin-right">
                        <i class="fas fa-city"></i>
                        <span class="uk-text-small"></i><?php if($datos->id_sujeto==1): ?> CONTRATISTA <?php else: ?> SUPERVISOR <?php endif; ?> </span>
                    </span>
                    <span class="uk-margin-right">
                        <i class="fas fa-people-carry"></i>
                        <span class="uk-text-small">Persona <?php if($datos->id_tipo_persona==1): ?> física <?php else: ?> moral <?php endif; ?></span>
                    </span>
                    <span class="uk-margin-right">
                        <i class="fas fa-id-card"></i>
                        <span class="uk-text-small">R.F.C. <?php echo e($datos->rfc); ?></span>
                    </span>
                    <span class="uk-margin-right">
                        <i class="fas fa-phone"></i>
                        <span class="uk-text-small">Telefono <?php echo e($datos->telefono); ?></span>
                    </span>
                    <span class="uk-margin-right">
                        <i class="far fa-envelope"></i>
                        <span class="uk-text-small">Correo <?php echo e($datos->email); ?></span>
                    </span>
                    <?php if( $datos->id_tipo_persona == 1 ): ?>

                    <span class="uk-margin-right">
                        <i class="fas fa-mars-double"></i>
                        <span class="uk-text-small">Sexo <?php if($datos->sexo==1): ?> Hombre <?php else: ?> Mujer <?php endif; ?></span>
                    </span>
                    <?php endif; ?>
                </li>
                <?php if( ($datos->id_d_domicilio_fiscal != null) ||($datos->id_d_domicilio_fiscal != '')    ): ?>
                <li>
                    <span class="uk-margin-right">
                        <span class="uk-text-small"></i>
                            Domicilio fiscal <?php echo e($datos->calle_fiscal.' Int. '.$datos->int_fiscal.', Ext. '.$datos->ext_fiscal.', '.$datos->colonia_fiscal); ?> <?php echo e('C.P. '.$datos->cp_fiscal); ?>

                            <?php echo e($datos->municipio_fiscal.', '.$datos->estado_fiscal); ?>

                        </span>
                    </span>
                </li>                   
                <?php endif; ?>
                <li>
                    <span class="uk-margin-left">
                        <h4>Únicamente se proporcionará información al interesado.</h4>
                    </span>
                </li>
            </ul>
=======
<div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-2" style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('<?php echo e(asset('public/img2/fondo_encabezado.png')); ?>');">

    <div class="card-header pt-10 pb-10">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-circle me-5">
                <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3"/>
                        <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000"/>
                    </g>
                </svg></span>
                </div>
            </div>

            <div class="d-flex flex-column">
                <h2 class="mb-1"><?php echo e($datos->razon_social_o_nombre); ?></h2>
                <div class="text-muted fw-bold">
                    <a href="#"><?php if($datos->id_sujeto==1): ?> CONTRATISTA <?php else: ?> SUPERVISOR <?php endif; ?></a> <span class="mx-3">|</span>
                    <a href="#">Persona <?php if($datos->id_tipo_persona==1): ?> física <?php else: ?> moral <?php endif; ?></a> <span class="mx-3">|</span>
                    <a href="#">R.F.C. <?php echo e($datos->rfc); ?></a> <span class="mx-3">|</span>
                    <a href="#">Telefono <?php echo e($datos->telefono); ?></a> <span class="mx-3">|</span>
                    <a href="#">Correo <?php echo e($datos->email); ?></a>
                </div> 
            </div>
>>>>>>> branch_adrian
        </div>
    </div>
</div>
<?php /**PATH C:\AppServ\www\sircse\resources\views/backend/encabezado.blade.php ENDPATH**/ ?>