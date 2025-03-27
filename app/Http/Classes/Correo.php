<?php
namespace App\Http\Classes;
use PHPMailer\PHPMailer;
class Correo
{
    public static function sendEmail($vdatosEnviarEmail, $status, $attachment=null, $nameAttachment=null)
    {
        $mail=new PHPMailer\PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->SMTPOptions = array (
                'ssl' => array (
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            //$mail->SMTPDebug = false;
            $mail->CharSet="utf-8";
            $mail->SMTPAuth=true;
            $mail->SMTPSecure="tls";
            $mail->Host="smtp.gmail.com"; // host gmail
            //$mail->Host="mail.shyfpchiapas.gob.mx"; // host gmail smtp.office365.com
            $mail->Port=587; // port gmail            
            
            // $mail->Username="contratistas.supervisores@gmail.com";
            // $mail->Password="CntrtasSupvsr";
            // $mail->setFrom("contratistas.supervisores@gmail.com", "Contratistas y Supervisores");
            
            $mail->Username="srcse.shyfpchiapas@gmail.com";
            //$mail->Password="srcseSHYFP.2020";
            $mail->Password="ixwhzhbxicrnyxcn";
            $mail->setFrom("srcse.shyfpchiapas@gmail.com", "SHYFP");

            // $mail->Username="srcse.shyfpchiapas@gmail.com";
            // $mail->Password="srcseSHYFP.2020";
            // $mail->setFrom("srcse.shyfpchiapas@gmail.com", "Contratistas y Supervisores");

            // $mail->Username="notificacion.shyfp@outlook.com";
            // $mail->Password="9n2WJSXORvLm";
            // $mail->setFrom("notificacion.shyfp@outlook.com", "Contratistas y Supervisores");

            // $mail->Username="notificaciones_shyfp@shyfpchiapas.gob.mx";
            // $mail->Password="Noti2022@.-";
            // $mail->setFrom("notificaciones_shyfp@shyfpchiapas.gob.mx", "Contratistas y Supervisores");
            // $mail->addBCC("notificaciones_shyfp@shyfpchiapas.gob.mx");
            
            $mail->Subject=$vdatosEnviarEmail['asunto'];
            $mail->MsgHTML($vdatosEnviarEmail['cuerpo']);
            if($status==1) {
                foreach($vdatosEnviarEmail['correo_destinatario'] as $correo) {
                    $mail->addAddress($correo, $vdatosEnviarEmail['nombre_destinatario']);
                } 
            }
            else {
                $mail->addAddress($vdatosEnviarEmail['correo_destinatario'], $vdatosEnviarEmail['nombre_destinatario']);           
            }

            if($attachment!=null) {
                $_nameAttachment="pdf.pdf";
                if( $nameAttachment!=null) 
                    $_nameAttachment=$nameAttachment;
                $mail->addStringAttachment($attachment, $_nameAttachment, 'base64', 'application/pdf');
            }
           
            if (!$mail->send())
                return 0;
            else
                return 1;
        } 
        catch (phpmailerException $e) {
            return 0;
        } 
        catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
        return 0;
    }    
}
