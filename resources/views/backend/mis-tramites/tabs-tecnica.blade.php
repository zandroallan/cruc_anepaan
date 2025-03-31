
<!-- @if( $id_tipo_tramite != 1 )
<button type="button" class="btn ripple btn-outline-info" id="btnRecuperarRTEC" onclick="RecuperarRespresentantes()">
    <i class="fas fa-history"></i> Recuperar
</button>
@endif -->           
      

<div class="card card-custom gutter-b">
    <div class="card-body">
        
        <div class="example mb-10">         
            <div class="example-preview">
                <div class="row">
                    <div class="col-md-12 form-group text-right">
                        <a href="#" class="btn btn-outline-info btn-sm" data-effect="effect-scale" onclick="modal_rtec(0)">
                            <i class="fa fa-save"></i> Agregar RTEC
                        </a> 
                    </div>
                </div>

                <form id='dtrtec_frm_destroy' name='dtcnt_frm_destroy'>
                    @csrf
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
                
            </div>
        </div>
    </div>
</div>




            @include('backend.mis-tramites.mdl_rep_tec')
            @include('backend.mis-tramites.mdl_esp_rtec')