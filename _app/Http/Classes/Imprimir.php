<?php
namespace App\Http\Classes;

class Imprimir{

    private $right_logo;
    private $left_logo;

    public function __construct()
    {
        $this->left_logo= public_path()."/public/img/logo-shyfp.jpg";
        $this->right_logo= public_path()."/public/img/declarachiapas.png";
    }

    public function getEncabezado(){
        return $this->id_tipo_tramite;
    }

    public function getPie(){
        return $this->tipo_tramite_msg;
    }
    
    public function acuse_observaciones($contenido, $mode, $folio)
    {
        $mpdf = new \Mpdf\Mpdf([     
            'tempDir' => public_path()."/public/pdf/tmp",     
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 35,
            'margin_bottom' => 30,
            'margin_header' => 10,
            'margin_footer' => 10,
            'format' => 'Letter-L'
        ]);

        $html= $contenido;

        $stylesheet = file_get_contents(public_path()."/public/css/print.css");                
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("SIRCS. - Acuse de Envio de Observaciones");
        $mpdf->SetAuthor("Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal");
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetHTMLHeader($this->encabezado_v());
        $mpdf->SetHTMLFooter($this->pie_v());
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($html);

        $pdf= $mpdf->Output("acuse_observaciones_". $folio, $mode);     
        if($mode=='D') 
            $pdf= $pdf->setContentType('application/pdf');
        return $pdf;      
    }
	
	public function observaciones($contenido, $mode, $folio) {
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => public_path()."/public/pdf/tmp",
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 30,
            'margin_bottom' => 30,
            'margin_header' => 10,
            'margin_footer' => 10,
            'format' => 'Letter'
        ]);

        $html= $contenido;

        $stylesheet = file_get_contents(public_path()."/public/css/print.css");                
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("SIRCS. - Bitacora revision");
        $mpdf->SetAuthor("Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal");
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetHTMLHeader($this->encabezado_v());
        $mpdf->SetHTMLFooter($this->pie_v());
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        
        $pdf= $mpdf->Output("Bitacora_revision_".$folio.".pdf", $mode);
        if($mode=='D'){ $pdf= $pdf->setContentType('application/pdf'); }
        return $pdf;      
    }
	
    private function encabezado_v($titulo="") {
        $html = '			
            <table width="100%">
                <tr>
                    <td width="25%" style="text-align: left; vertical-align: middle;">
                        <img src='.$this->left_logo.' width="20%" />
                    </td>
                    <td width="50%" class="titulo">
                        Secretaría de la Honestidad y Función Pública<br>
                        Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal
                    </td>
                    <td width="25%" style="text-align: right; vertical-align: middle;">
                    
                    </td>                    
                </tr>
            </table>';
        if($titulo!="") {
            $html.= '<h4 class="titulo2">'.$titulo.'</h4>';
        }
        return $html;
    }

    private function cuerpo($encabezado) {

    }

    private function pie_v() {
        $html = '
			<p style="text-align: justify; font-size:7px; margin-bottom: 15px;">			
				<b>Aviso de privacidad</b>
			</p>
			<p style="text-align: justify; font-size:7px;">
				Los datos recabados en este formato, serán protegidos, incorporados y tratados en los términos establecidos en la Ley de Protección de Datos Personales en Posesión de Sujetos Obligados del Estado de Chiapas (LPDPPSOCHIS), así como en los Lineamientos Generales para la Custodia y Protección de Datos Personales e Información Reservada y Confidencial en posesión de los Sujetos Obligados del Estado de Chiapas y demas normatividad aplicable. Para mayor información puede consultar nuestro aviso de privacidad en la página: https://www.shyfpchiapas.gob.mx/
			</p>
			
            <table style="background-color:#333333; color:#fff; margin-left:-80px; font-size:10px;">
                <tr>
                    <td width="13%"></td>
                    <td width="72%">Blvd. Los Castillos No. 410, Fracc. Montes Azules C.P. 29056, <br>
                    Tuxtla Gutiérrez, Chiapas. <br> Conmutador: (961) 61 8 75 30 Ext. 22022 y 22232
                    <br> www.shyfpchiapas.gob.mx </td>
                </tr>
            </table>';
        return $html;
    }

    public function tramite_acuse_recepcion($contenido, $mode) {
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => public_path()."/public/pdf/tmp",
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 30,
            'margin_bottom' => 35,
            'margin_header' => 10,
            'margin_footer' => 8,
            'format' => 'Letter'
        ]);

        $html= $contenido;

        $stylesheet = file_get_contents(public_path()."/public/css/print.css");                
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("SIRCS. - Acuse de recepción de documentos");
        $mpdf->SetAuthor("Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal");
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetHTMLHeader($this->encabezado_v());
        $mpdf->SetHTMLFooter($this->pie_v());
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        
        $pdf= $mpdf->Output("Acuse de recepción de documentos.pdf", $mode);
        if($mode=='D'){ $pdf= $pdf->setContentType('application/pdf'); }
        return $pdf;      
    }
}
?>
