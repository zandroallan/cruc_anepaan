@extends('layouts.app_valida')

@section('styles')	
@endsection

@section('content')

<style type="text/css">
	.form-input{
	    width: 100%;
	    padding: 12px;
	    border-radius: 8px;
	    border: 1px solid #ddd;
	    transition: border-color 0.3s, transform 0.3s;
	}
	.form-input:focus{
	    border-color: #6f6df4;
	    outline: none;
	    transform: scale(1.02);
	}

	.input-inset{
	  font-size: 16px;
	  line-height: 1.5;
	  background: #FFFFFF;  
	  background-position: 10px 10px;
	  background-size: 20px 20px;
	  border: 1px solid #C5CBD5;
	  box-shadow: 0 4px 8px 0 #CACACA, 0 3px 10px 0 #D8D8D8;
	  border-radius: 8px;
	  width: 100%;
	} 

	.button {
	  display: inline-block;
	  background: #C90166;
	  color: #fff;
	  text-transform: uppercase;
	  padding: 15px 25px;
	  border-radius: 5px;
	  box-shadow: 0 17px 10px -10px rgba(0, 0, 0, 0.4);
	  cursor: pointer;
	  transition: all ease-in-out 300ms; 
	}
	.button:hover {
	    box-shadow: 0 37px 20px -20px rgba(0, 0, 0, 0.2);
	    transform: translate(0, -10px);
	    color: #fff;
	}

</style>
	<p class="text-justify">
        La Secretaría Anticorrupción y Buen Gobierno, para asegurar la confiabilidad y certeza del servicio de expedición del certificado de <b>Contratistas</b> otorgado a través de la <b>Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal</b>, pone a disposición el “Validador digital” para aquellos certificados impresos, cuya finalidad es verificar la autenticidad de dicho documento emitido.
    </p>
   
   	<form id="my-form">
    <div class="row pt-3">
        <div class="col-md-6">
            <div class="form-group text-left">
                <label><b>Folio del certificado</b></label>
                <input id="folio" name="folio" class="form-control input-inset form-input removeIsInvalid" placeholder="Ej: 0001-C-2025" type="text" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-left">
                <label><b>RFC de la Empresa</b></label>
                <input id="rfc" name="rfc" class="form-control input-inset form-input removeIsInvalid" placeholder="Ej: GOR780901S21" type="text" required>
            </div>
        </div>
    </div>
    </form>
    
    <div class="row" id="NoEncontrado" style="display: none;">
    	<div class="col-md-12">
    		<div class="alert-danger mb-3">                                                    
		      	<h3 class="pt-2">
		      		<img src="{{asset('img/error.png')}}" style="width: 35px; margin-right:15px;"/>
		      		CERTIFICADO NO VALIDO</strong>
		  		</h3>
		    </div>

		    <p style="color: #721c24;">
			  <b>Advertencia:</b> No se encontro registro alguno en nuestra base de datos con el folio <span id="spFolio"></span>. Asegurese de haber escrito correctamente los datos solicitados.
			</p>
			
    	</div>
    </div>
    
    <div class="row pt-2">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <button class="btn button btn-block btn-consulta"><b>Consultar certificado</b></button>
        </div>
    </div>

    <div id="dvEncontrado" name="dvEncontrado" style="display: none;">            
    	<div class="row pt-4">
    		<div class="col-md-12">
    			<div class="alert-success">                                                    
		          	<h3 class="pt-2">
		          		<img src="{{asset('img/accept.png')}}" style="width: 35px; margin-right:15px;"/>
		          		CERTIFICADO VALIDO</strong>
		      		</h3>
		        </div>
		               
		        <div class="row">							
			        <div class="col-lg-12">
		                <br />
		                <div class="row pb-3">
		                	<div class="col-md-12">
		                		<div class="card">
								    <div class="card-header d-flex justify-content-between">
								        <h4 class="m-2"><strong>Informaci&oacute;n del tr&aacute;mite</strong></h4>
								        <div class="pt-2">
								          	<button type="button" id="btnTerminar" class="btn btn-outline-dark"><i class="far fa-times-circle"></i> Terminar</button>
								  			<a href="#" id="lnkCertificado" class="btn btn-outline-info" target="_blank"><i class="fa fa-print"></i> Ver certificado</a>
								        </div>
								    </div>
								</div>
		                	</div>		                	
		                </div>
				        
				        <div class="row pb-2">
				        	<div class="col-md-12">
				        		<h4 class="pl-3"><span id="spEmpresa"></span> - <span class="badge badge-info spRfc"></span></h4>
				        	</div>
				        </div>

				        <div class="row">
				        	<div class="col-md-6">
				        		<ul class="list">
							        <li>Folio del certificado: <b> <span id="lblFolio"></span></b></li>																		
							        <li>Formato valorado: <b><span id="lblFormatoV"></span></b></li>
							        <li>Folio de pago: <b><span id="lblFolioPago"></span></b></li>																		
							        <li>Fecha de expedici&oacute;n: <b><span id="lblFecha"></span></b></li>							        
				        		</ul>
				        	</div>

				        	<div class="col-md-6">
				        		<ul class="list">
							        <li>Tipo persona: <b> <span id="lblTipoPersona"></span></b></li>																		
							        <li>Tipo trámite: <b><span id="lblTipoTramite"></span></b></li>
							        <li>Responsable emisión: <b><span id="lblResponsable"></span></b></li>																		
							        <li>Inicio trámite: <b><span id="lblInicio"></span></b></li>																		
							        <li>Fin trámite: <b><span id="lblFin"></span></b></li>																		
				        		</ul>
				        	</div>
				        </div>
				        

		                <p style="text-align:justify;">
					        La Secretar&iacute;a Anticorrupci&oacute;n y Buen Gobierno en cumplimiento a lo ordenado en los art&iacute;culos 59, de
					        la Ley General de Responsabilidades, 27, parr&aacute;fo cuarto y quinto de la Ley de Responsabilidades Administrativas para el Estado de Chiapas, 55, Fracci&oacute;n
					        IX del Reglamento Interior de la Secretar&iacute;a Anticorrupci&oacute;n y Buen Gobierno y 45 fracci&oacute;n I, de la Ley de Derechos del Estado de Chiapas.
				        </p>
		             </div>
		        </div>
    		</div>
    	</div>
        
 
   </div>    

@endsection

@section('js')
	<script src="{{ asset('js/validar/index.js') }}"></script>
@endsection

@section('script')
@endsection
