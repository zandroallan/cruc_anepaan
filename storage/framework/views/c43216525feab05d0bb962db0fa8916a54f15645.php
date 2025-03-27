<div class="md-card">
    <div class="user_heading md-bg-gob2-500">
        <div class="user_heading_avatar">
            <div class="thumbnail">
                <img src="<?php echo e(asset('public/img2/sircse.png')); ?>" class="" alt="usuario">
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
        </div>
    </div>
</div>
<?php /**PATH C:\AppServ\apps\sircse\resources\views/backend/encabezado.blade.php ENDPATH**/ ?>