<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style type="text/css">
    /*    body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        @media  screen and (max-width: 480px) {
            .mobile-hide {
                display: none !important;
            }

            .mobile-center {
                text-align: center !important;
            }
        }

        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

         .p_firma {		 
		  /* BOTH of the following are required for text-overflow */
		 /* white-space: nowrap;
		  overflow: hidden;
		}

		.overflow-visible {
		  white-space: initial;
		}
		    
		    .divS {
				min-height: 300px;
				width:300px;
				word-wrap: break-word;
			}

            .button {
              background-color: #4CAF50; /* Green */
              /*border: none;
              color: white;
              padding: 16px 32px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
              margin: 4px 2px;
              transition-duration: 0.4s;
              cursor: pointer;
            }
            .button2 {
              background-color: white; 
              color: black; 
              border: 2px solid #008CBA;
            }

            .button2:hover {
              background-color: #008CBA;
              color: white;
            }

            a:link, a:visited, a:active {
                text-decoration:none;
            }*/



             body {
            margin-top:10px;
            background-color:#E4E4E4;
        }
        .container-arb {
            border: 4px solid #ffffff;
            border-radius: 10px;
            margin-top: 15px;
            margin-bottom: 15px;
            background-color: #fff;   
        }
     
        .table_font-certificado-v
        {
            font-size: 16px;
        }

        .mytable {
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .mytable tr { 
          padding: .35em;
        }

        .mytable td {
          padding: .625em;
          text-align: center;
        }


        @media  screen and (max-width: 600px) {
          .mytable {
            border: 0;
          }

          .mytable tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: .625em;
          }
          .mytable td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .8em;
            text-align: right;
          }
          .mytable td:before {
            content: attr(data-label);
            
            font-weight: bold;
            text-transform: uppercase;
          }
          .mytable td:last-child {
            border-bottom: 0;
          }
        }

        .left {
          text-align: left;
        }
</style>

<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">

    <?php
        $_myfecha = '2024-12-17';
        $certificado= \App\Http\Models\Backend\T_Registro::certificado($datos->id, $datos->id_sujeto)->first();
        $sujeto= ($datos->id_sujeto==1) ? "Contratista" : "SUPERVISORES";
        $especialidades= \App\Http\Models\Catalogos\C_Especialidad::general(['id_sujeto'=>$datos->id_sujeto])->get();
        $tipo_persona= ($datos->id_tipo_persona==1) ? "Fisica" : "Moral";
        $tipo_tramite= $datos->tipo_tramite;
        $razon_social_o_nombre= $datos->razon_social_o_nombre;

        $a_fundamentoL='';
        if(\App\Http\Classes\FormatDate::anio($datos->created_at,1) >= (int)2023) {
            $a_fundamentoL = '30 fracción XI';
        }
        else {
            $a_fundamentoL = '16 fracción XVI';
        }

        $primer_parrafo='';
        if($datos->fecha_certificado >= $_myfecha )
        {
            if($datos->id_tipo_persona==1) {
                $primer_parrafo='El encargado de la Coordinación  de Verificación de la Supervisión Externa de la Obra Pública Estatal, de la Secretaría Anticorrupción y Buen Gobierno, con fundamento en lo dispuesto por los artículos 33, fracción XXXI de la Ley Orgánica de la Administración Pública del Estado de Chiapas; 23 y 26 de la Ley de Obra Pública del Estado de Chiapas; y '.$a_fundamentoL.' del Reglamento Interior vigente de esta Secretaría, hace constar que la persona '.mb_strtoupper($tipo_persona).':'; 
            }
            if($datos->id_tipo_persona==2) {
                $primer_parrafo='El encargado de la Coordinación  de Verificación de la Supervisión Externa de la Obra Pública Estatal, de la Secretaría Anticorrupción y Buen Gobierno, con fundamento en lo dispuesto por los artículos 33, fracción XXXI de la Ley Orgánica de la Administración Pública del Estado de Chiapas; 23 y 26 de la Ley de Obra Pública del Estado de Chiapas; y '.$a_fundamentoL.' del Reglamento Interior de esta Secretaría, hace constar que la persona '.mb_strtoupper($tipo_persona).':'; 
            }
        }
        else
        {
            if($datos->id_tipo_persona==1) {
                $primer_parrafo='La encargada de la Coordinación  de Verificación de la Supervisión Externa de la Obra Pública Estatal, de la Secretaría de la Honestidad y Función Pública, con fundamento en lo dispuesto por los artículos 31, fracción XXXI de la Ley Orgánica de la Administración Pública del Estado de Chiapas; 23 y 26 de la Ley de Obra Pública del Estado de Chiapas; y '.$a_fundamentoL.' del Reglamento Interior vigente de esta Secretaría, hace constar que la persona '.mb_strtoupper($tipo_persona).':'; 
            }
            if($datos->id_tipo_persona==2) {
                $primer_parrafo='La encargada de la Coordinación  de Verificación de la Supervisión Externa de la Obra Pública Estatal, de la Secretaría de la Honestidad y Función Pública, con fundamento en lo dispuesto por los artículos 31, fracción XXXI de la Ley Orgánica de la Administración Pública del Estado de Chiapas; 23 y 26 de la Ley de Obra Pública del Estado de Chiapas; y '.$a_fundamentoL.' del Reglamento Interior de esta Secretaría, hace constar que la persona '.mb_strtoupper($tipo_persona).':'; 
            }
        }



        $fecha_padron =\App\Http\Classes\FormatDate::anio($datos->fecha_inicio,1);
        $rec=\App\Http\Classes\FormatDate::longDateFormat_day($certificado->rec);
        $imss=$certificado->imss;

        $interior ="";
        if($datos->int_fiscal!="")
            $interior=", Int. ".$datos->int_fiscal;

        $domicilio_fiscal= $datos->calle_fiscal." Ext.".$datos->ext_fiscal.$interior.", ".$datos->colonia_fiscal.", ". $datos->municipio_fiscal.", ". $datos->estado_fiscal . ", C.P. ".$datos->cp_fiscal;

        $txt_c_contable='';
        if($datos->id_sujeto==1)
        { 
            $txt_c_contable='CAPITAL CONTABLE:'; 
            if(isset($certificado->capital)){ 
            $capital_contable='$ '.number_format($certificado->capital, 2);            
            }
        }
        if($datos->id_sujeto==2){ $txt_c_contable=''; $capital_contable=''; }

        $acta_c=\App\Http\Models\Backend\T_Tramite_Acta_Instrumento::general(["id_tramite"=>$datos->id])->get();

        $parrafo_acta='';
        foreach($acta_c as $res) {
            $parrafo_acta.='<p class="text-justify pt-2"><b>Acta constitutiva:</b> Escritura pública No. '.$res->num_escritura.', de fecha '.mb_strtoupper(\App\Http\Classes\FormatDate::longDateFormat_day($res->fecha_escritura)).', pasada ante la fe del Lic. '.$res->notario_nombre.', Notario Público No. '.$res->notario_numero.' del estado de '.mb_strtoupper($res->estado_escritura).'; Registrada bajo el folio mercantil '.$res->num_registro_publico.', sección '.$res->seccion.' del registro público de la propiedad y del comercio del Distrito Judicial de '.mb_strtoupper($res->estado_regpub).'; con fecha '.mb_strtoupper(\App\Http\Classes\FormatDate::longDateFormat_day($res->fecha_registro_publico)).'.</p>';
        
        }  

        //modificaciones
        $acta_m= \App\Http\Models\Backend\T_Tramite_Acta_Instrumento_Modificacion::edit($datos->id, 1);

        $acta_m_parrafo='';
        if ( !empty($acta_m) ) {
            $acta_m_parrafo.='<p class="text-justify"><b>Modificaciones al Acta constitutiva:</b> Escritura pública No. '.$acta_m->num_escritura.', de fecha '.mb_strtoupper(\App\Http\Classes\FormatDate::longDateFormat_day($acta_m->fecha_escritura)).', pasada ante la fe del Lic. '.$acta_m->notario_nombre.', Notario Público No. '.$acta_m->notario_numero.' del estado de '.mb_strtoupper($acta_m->estado_escritura).'; Registrada bajo el folio mercantil '.$acta_m->num_registro_publico.', sección '.$acta_m->seccion.' del registro público de la propiedad y del comercio del Distrito Judicial de '.mb_strtoupper($acta_m->estado_regpub).'; con fecha '.mb_strtoupper(\App\Http\Classes\FormatDate::longDateFormat_day($acta_m->fecha_registro_publico)).'.</p>';
        } 

        //Insercion representantres legales
        $r_legales = \App\Http\Models\Backend\T_Tramite_Rep_Legal::general(["id_tramite"=>$datos->id])->get();         
        $parrafo_legales = '';
        if ( isset($r_legales) ) {
            foreach($r_legales as $resultado_l){
                $parrafo_legales.='<p class="text-justify"><b>'.$resultado_l->tipo_rep_legal.':</b> '.$resultado_l->nombre.' '.$resultado_l->ap_paterno.' '.$resultado_l->ap_materno.', Escritura Pública No. '.$resultado_l->num_escritura.', de fecha '.\App\Http\Classes\FormatDate::longDateFormat_day($resultado_l->fecha_escritura).', pasada ante la fe del Lic. '.$resultado_l->notario_nombre.', Notario Público No. '.$resultado_l->notario_numero.', del estado de '.$resultado_l->estado1.'; Registrada bajo el folio mercantil '.$resultado_l->num_registro_publico.', sección '.$resultado_l->seccion.' del registro público de la propiedad y del comercio del Distrito Judicial de '.$resultado_l->ciudad.', '.$resultado_l->estado2.'; con fecha '.\App\Http\Classes\FormatDate::longDateFormat_day($resultado_l->fecha_registro_publico).'. </p>';
            }                 
        } 


        //Se obtiene las especialidades del contratista y se asigna a una variable
        $lstEspecialidades='';
        $json_string1 =  json_decode($datos->especialidades_tecnicas);
        //sort($json_string1);
        if(!isset($json_string1)){ $json_string1=[]; }

        $array_especialidades=array();
        foreach($especialidades as $resultado){
            if(in_array($resultado->id,$json_string1 )) {
                // $lstEspecialidades =   $lstEspecialidades .' '. $resultado->clave.',';
                array_push($array_especialidades, $resultado->clave);
            }
        }
        sort($array_especialidades);
        foreach($array_especialidades as $array_esp => $valor){
            $lstEspecialidades=$lstEspecialidades.' '.$valor.',';
        }
        $especialidades_contratista=$lstEspecialidades;
               
        $rt='';   
        $parrafo_espc_constratista='';                         
        $parrafo_espc_constratista.='<p class="text-justify"><b>Especialidades acreditadas por el '.$sujeto.':</b> ' .substr($especialidades_contratista, 0, -1). '. '.$rt .'</p>';

        //se obtienen los representantes tecnicos del contratista
        $rt='';
        $rt2='';        
        $r_tecnicos= \App\Http\Models\Backend\T_Tramite_Rep_Tecnico::datos_generales(["id_tramite"=>$datos->id])->get();
        $parrafo_esp_tecnicos='';
        if(isset($r_tecnicos)) {
            foreach($r_tecnicos as $resultado){
                
                $lstEspecialidades_rt='';
                $json_string_esR =  json_decode($resultado->especialidades);
                if( !isset($json_string_esR) ) $json_string_esR=[]; 

                $array_push_esR=array();
                foreach($especialidades as $especialidad_rtec){
                    if(in_array($especialidad_rtec->id, $json_string_esR )) 
                        array_push($array_push_esR, $especialidad_rtec->clave);
                }

                sort($array_push_esR);
                foreach( $array_push_esR as $array_esR => $valor ) {
                    $lstEspecialidades_rt=$lstEspecialidades_rt.' '.$valor.',';
                }
                $especialidades_esR_contratista=$lstEspecialidades_rt;
                
                $parrafo_esp_tecnicos.='<p class="text-content-certificado-v"><b> Especialidades acreditadas por el Representante Técnico de Empresas '.$sujeto.' (RTEC) :</b> '.$resultado->nombre.' '.$resultado->ap_paterno.' '.$resultado->ap_materno.', '.'<b>Profesión:</b> '.$resultado->profesion.', '.'<b>Cédula Profesional:</b> '.$resultado->cedula.', '.'<b>Fecha Expedición:</b> '.$resultado->fecha_cedula.'<br>'. substr($especialidades_esR_contratista, 0, - 1).'. </p>';                       
            }
        } 

        $rep_legal = \App\Http\Models\Backend\T_Tramite_Rep_Legal::general(["id_tramite"=>$datos->id])->first();
        $firmas='';
        $firmas.='<table width="100%" class="table_font-certificado-v">';
        $firmas.='    <tr>';

        if(isset($rep_legal)) {       
            $firmas.='    <td width="50%" class="text-center">';
            $firmas.=         $rep_legal->nombre.' '.$rep_legal->ap_paterno.' '.$rep_legal->ap_materno.'<br />'.$rep_legal->tipo_rep_legal .'<br />';
            $firmas.='    </td>';                
        }
        else {
            $firmas.='    <td width="50%" class="text-center">'.$razon_social_o_nombre.'</td>';
            
        }
       
        if ( isset($r_tecnicos) ) {
            if ( count($r_tecnicos) > 1 ) {
                foreach($r_tecnicos as $resultado){
                    $firmas.='<td width="33%" class="text-center;">';
                    $firmas.=     $resultado->nombre.' '.$resultado->ap_paterno.' '.$resultado->ap_materno .'<br />';
                    $firmas.='    <b>Representante Técnico</b>';
                    $firmas.='</td>';
                }
            }
            else {
                $firmas.='<td width="50%" class="text-center">';
                $firmas.=     $resultado->nombre.' '.$resultado->ap_paterno.' '.$resultado->ap_materno .'<br />';
                $firmas.='    <b>Representante Técnico</b>';
                $firmas.='</td>';
            }
        }  
        $firmas.='    </tr>';
        $firmas.='</table>';
    ?>


    <div class="container">          
           <div class="container-arb" style="box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);">
            <footer>
                <div class="footer-top border-top-arb">
                    <div class="container">
                        <div class="col-md-112 col-lg-112  col-sm-112 col-xs-112 text-center">
                            <img src="<?php echo e(asset('img/SAyBG.png')); ?>" class="img-responsive pt-3 pb-3" width="30%" />
                        </div>
                    </div>
                </div>
                <!--/.footer-top--> 

                <div class="footer" id="footer">
                    <div class=" container">                        
                        <div class="row">                           
                            <div class="col-md-12 col-lg-12  col-sm-12 col-xs-12">

                                <p class="text-center text-gral-certificado-v">
                                    <b class="text-negrita">Padrón de Contratistas <?php echo $fecha_padron; ?></b>
                                </p>

                                <p class="text-center text-gral-certificado-v">
                                    Forma Valorada: <b class="text-red"><?php echo $datos->forma_valorada; ?></b>,
                                    Recibo oficial: <b class="text-negrita"><?php echo $datos->boleta_pago_alegal; ?></b>,
                                    pago de derechos por <b><?php echo $tipo_tramite; ?></b>
                                </p>
                                <p class="text-justify pt-2"><?php echo e($primer_parrafo); ?></p> 
                                
                                <p><h4 class="text-center"><?php echo $razon_social_o_nombre; ?></h4></p>

                                <?php if($datos->fecha_certificado >= $_myfecha ): ?>
                                    <p class="text-justify pb-3">Se encuentra inscrito en el Registro de Contratistas, que tiene a cargo esta Secretaría Anticorrupción y Buen Gobierno, con los siguientes datos:</p>
                                <?php else: ?>
                                    <p class="text-justify pb-3">Se encuentra inscrito en el Registro de Contratistas, que tiene a cargo esta Secretaría de la Honestidad y Función Pública, con los siguientes datos:</p>
                                <?php endif; ?>
                            
                                <table class="mytable">   
                                    <tbody>
                                        <tr>
                                            <td style="text-align: left;"><b>RFC</b></td>
                                            <td style="text-align: left;"><?php echo $datos->rfc; ?></td>
                                            <td style="text-align: left;"><b>DOMICILIO</b></td> 
                                            <td style="text-align: left;"><?php echo $domicilio_fiscal; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left;"><b>R.E.C.:</b></td>
                                            <td style="text-align: left;"><?php echo $rec; ?></td>
                                            <td style="text-align: left;"><b><?php echo $txt_c_contable; ?></b></td>  
                                            <td style="text-align: left;"><?php echo $capital_contable; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left;"><b>IMSS: </b></td>
                                            <td colspan="3" style="text-align: left;"><?php echo $imss; ?></td>
                                        </tr>    
                                    </tbody>
                                </table>
                                
                                <?php echo $parrafo_acta; ?>

                                <?php echo $acta_m_parrafo; ?>

                                <?php echo $parrafo_legales; ?>

                                <?php echo $parrafo_espc_constratista; ?>

                                <?php echo $parrafo_esp_tecnicos; ?>

                                <p class="pt-3"><?php echo $firmas; ?></p>

                                <p class="text-center pt-5">Se expide en la ciudad de Tuxtla Gutiérrez, Chiapas, el día <?php echo \App\Http\Classes\FormatDate::longDateFormat_day($datos->fecha_certificado); ?></p> 
        

                                <p class="text-center pt-3"><br /> 
                                <b>CP. <?php echo $datos->coordinador; ?></b><br />Titular de la Coordinación</p>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p style="font-weight: 800;" class="text-center">Certificado generado</p>
                                        <p class="text-center"><a href="https://apps.anticorrupcionybg.gob.mx/sircse-admin/impresion/certificado/<?php echo e($tramite->id); ?>/validado" class="btn btn-info" target="_blank">Ver certificado</a></p>
                            </div>
                        </div>
                      
                    </div>
                    <!--/.container--> 
                </div>
                <!--/.footer-->
    
                <div class="footer-bottom border-bottom-arb">
                    <div class="container">
                        <p class="text-center"><strong> © Secretaría Anticorrupción y Buen Gobierno - Unidad de Informatica y Desarrollo Digital.</strong><br />
                            <br />Blvd. Los castillos No.410, Fracc. Villa Montes Azules
                            <br />Tuxtla Gutiérrez, CP 29056
                            <br />https://apps.anticorrupcionybg.gob.mx
                            <br />+52(961) 61 8-7530</p>
         
                    </div>
                </div>
                <!--/.footer-bottom--> 
            </footer>            
            </div>
        </div>
         
   
</body>

</html><?php /**PATH /var/cores/c-sircse/resources/views/validaciones/constancia.blade.php ENDPATH**/ ?>