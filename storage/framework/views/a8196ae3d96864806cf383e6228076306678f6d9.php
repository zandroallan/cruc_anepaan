
<!-- <?php if( $id_tipo_tramite != 1 ): ?>
<button type="button" class="btn ripple btn-outline-info" id="btnRecuperarRTEC" onclick="RecuperarRespresentantes()">
    <i class="fas fa-history"></i> Recuperar
</button>
<?php endif; ?> -->           
      


            <div class="row">
                <div class="col-md-12 form-group text-right">
                    <a href="#" class="btn btn-outline-info btn-sm" data-effect="effect-scale" onclick="modal_rtec(0)">
                        <i class="fa fa-save"></i> Agregar RTEC
                    </a> 
                </div>
            </div>

            <form id='dtrtec_frm_destroy' name='dtcnt_frm_destroy'>
                <?php echo csrf_field(); ?>
            </form>

            <table id="dtrtec_tbl" class="table">
                <thead id="hdRTEC" class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">CURP</th>
                        <th scope="col">Colegio</th>
                        <th scope="col">Constancia</th>
                        <th scope="col">Cédula</th>
                        <th scope="col"><i class="fa fa-list"></i></th>
                    </tr>
                </thead>
                <tbody>                     
                </tbody>
            </table>
              



            <?php echo $__env->make('backend.mis-tramites.mdl_rep_tec', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('backend.mis-tramites.mdl_esp_rtec', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\apps\sircse\resources\views/backend/mis-tramites/tabs-tecnica.blade.php ENDPATH**/ ?>