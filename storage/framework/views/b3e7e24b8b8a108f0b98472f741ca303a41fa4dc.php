
            <div class="row">
                <div class="col-md-12 form-group text-right">
                    <!-- <?php if( $id_tipo_tramite != 1 ): ?>
                    <button type="button" class="btn ripple btn-outline-info" id="btnRecuperarRTEC" onclick="RecuperarRespresentantes()">
                        <i class="fas fa-history"></i> Recuperar
                    </button>
                    <?php endif; ?> -->
                    <a href="#" class="btn ripple btn-outline-success" onclick="modal_rtec(0)">Agregar RTEC</a> 
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form id='dtrtec_frm_destroy' name='dtcnt_frm_destroy'>
                        <?php echo csrf_field(); ?>
                    </form>
                    <div class="table-responsive">
                        <table id="dtrtec_tbl" class="table table-hover">
                            <thead id="hdRTEC" class=" head-dark">
                                <tr>
                                    <th style="padding: 15px 15px; color: #fff">Nombre</th>
                                    <!-- <th style="padding: 15px 15px; color: #fff" class="text-center">RFC</th> -->
                                    <th style="padding: 15px 15px; color: #fff" class="text-center">CURP</th>
                                    <th style="padding: 15px 15px; color: #fff">Colegio</th>
                                    <th style="padding: 15px 15px; color: #fff">Constancia</th>
                                    <th style="padding: 15px 15px; color: #fff" class="text-center">Cédula</th>
                                    <th style="padding: 15px 15px; color: #fff" class="text-center"><i class="fa fa-list"></i></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>      
                </div>
            </div>

            <?php echo $__env->make('backend.mis-tramites.mdl_rep_tec', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('backend.mis-tramites.mdl_esp_rtec', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/cores/c-sircse/resources/views/backend/mis-tramites/tabs-tecnica.blade.php ENDPATH**/ ?>