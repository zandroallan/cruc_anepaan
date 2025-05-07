<?php
namespace App\Http\Classes;

class CorreoPlantillas
{
    public static function acuse_observaciones($vdatos)
    {
        return '<table>
                    <tbody>
                        <tr height="16"></tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#333">
                                    <tbody>
                                        <tr>
                                            <td width="32px"></td>
                                            <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:24px;color:#ffffff;line-height:1.25">
                                                Acuse Observaciones
                                            </td>
                                            <td width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" height="18px"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #f0f0f0;border-bottom:1px solid #c0c0c0;border-top:0;border-bottom-left-radius:3px;border-bottom-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FAFAFA">
                                    <tbody>
                                        <tr height="16px">
                                            <td rowspan="3" width="32px"></td>
                                            <td></td>
                                            <td rowspan="3" width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>'. $vdatos['name'] .' </strong>, 
                                                    </p>
                                                    <p style="text-align:justify">
                                                        Le notificamos que sus archivos de sus observaciones del trámite de <b>'. $vdatos['tipo_tramite'] .'</b> con folio <b>'. $vdatos['folio'] .'</b> se han enviado para su revisión, la Secretaría procederá al análisis de la documentación proporcionada.
                                                    </p>
                                                    <p style="text-align:justify">
                                                        La Secretaría comenzará a correr el plazo de treinta días naturales, para que otorgue o niegue la constancia de inscripción y, modificación o actualización en el registro de contratistas o de Supervisores Externos, cuando el solicitante solvente las observaciones o presente la documentación completa con todos los requisitos.
                                                    </p>                                                    
                                                    <p style="text-align:justify">
                                                        Todos los seguimientos al trámite se le notificarán a travéz del Sistema de Registro de Contratistas y Supervisores Externos (SIRCSE) y a éste correo  electrónico.
                                                    </p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Atentamente</strong>.<br />
                                                        Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal<br />
                                                        Secretaría Anticorrupción y Buen Gobierno
                                                    </p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <br />
                                                        Este correo electrónico es confidencial y/o puede contener información privilegiada.
                                                        <br /><br />
                                                        Si usted no es su destinatario o no es alguna persona autorizada por este para recibir sus correos electrónicos, NO deberá utilizar,
                                                        copiar, revelar, o tomar ninguna acción basada en este correo electrónico o cualquier otra información incluida en el, favor de notificar
                                                        a los teléfonos proporcionados y borrar a continuación totalmente este mensaje.
                                                        <br /><br />
                                                        Conmutador: (961) 61 8 75 30 Ext. 22022 y 22232

                                                        <br /><br />
                                                        Este correo se genera automaticamente, no responder.

                                                        

                                                    </p>
                                                    <br /><br />
                                                    <p>                                                 
                                                        Aviso de privacidad
                                                    </p><br /><br />
                                                    <p>
                                                        Los datos recabados en este formato, serán protegidos, incorporados y tratados en los términos establecidos en la Ley de Protección de Datos Personales en Posesión de Sujetos Obligados del Estado de Chiapas (LPDPPSOCHIS), así como en los Lineamientos Generales para la Custodia y Protección de Datos Personales e Información Reservada y Confidencial en posesión de los Sujetos Obligados del Estado de Chiapas y demas normatividad aplicable. Para mayor información puede consultar nuestro aviso de privacidad en la página: https://www.anticorrupcionybg.gob.mx/
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr height="32px"></tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr height="16"></tr>
                        <tr>
                            <td style="max-width:600px;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#bcbcbc;line-height:1.5">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#666666;line-height:18px;padding-bottom:10px">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <strong>No se pueden enviar respuestas a esta dirección de correo electrónico</strong>.<br />
                                                                © Secretaría Anticorrupción y Buen Gobierno., Blvd. Los Castillos No. 410, Fracc. Montes Azules Tuxtla Gutiérrez; Chiapas, CP 29056 Conmutador: (961) 61 8 75 30
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>';
    }
    
    public static function notificacionEntrega($datos)
    {
        return '<table>
                    <tbody>
                        <tr height="16"></tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#333">
                                    <tbody>
                                        <tr>
                                            <td width="32px"></td>
                                            <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:24px;color:#ffffff;line-height:1.25">
                                                Trámite SIRCSE
                                            </td>
                                            <td width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" height="18px"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #f0f0f0;border-bottom:1px solid #c0c0c0;border-top:0;border-bottom-left-radius:3px;border-bottom-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FAFAFA">
                                    <tbody>
                                        <tr height="16px">
                                            <td rowspan="3" width="32px"></td>
                                            <td></td>
                                            <td rowspan="3" width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>'. $datos->razon_social_o_nombre .' </strong>, 
                                                    </p>                                                    
                                                    
                                                    <p class="text-right">Asunto: Notificación del SIRCSE.<br />
                                                     '. $datos->razon_social_o_nombre .'<br />
                                                     '. $datos->folio .'</p>
                                                    
                                                     <p class="text-justify">Sistema de Registro de Contratistas y Supervisores Externos
                                                     Usted tiene una cita, el día <b>'. $datos->fecha .'</b> a las <b>'. $datos->hora .'</b>, en la
                                                     Mesa <b>'. $datos->mesa .'</b>. En las oficinas de la Secretaría Anticorrupción y Buen Gobierno, ubicadas en: Boulevard Los Castillos #410, planta baja,
                                                     Fraccionamiento Montes Azules.</p>
                                                    
                                                     <p class="text-justify">Para la expedición y obtención de su Constancia por Actualización de
                                                     Registro de Contratistas 2020 (prorrogada 2019). Con el fin de agilizar
                                                     su trámite, deberá presentarse personalmente*, con los siguientes
                                                     requisitos:</p>
                                                    
                                                     <p class="text-justify">1. Original y copia de Identificación Oficial INE o IFE, Cedula Profesional y/o Pasaporte.<br />
                                                     2. Copia del Certificado de Registro de Contratistas 2019.<br />
                                                     3. Impresión del presente documento.<br />
                                                     4. Impresión de la Boleta de Pago de Derechos, de la Secretaría de Hacienda.</p>
                                                    
                                                     <p class="text-justify"><b>*En los casos de personas morales, en que exista cambio de
                                                     Administrador único o Representante legal, el interesado deberá
                                                     presentar original del instrumento público notarial, donde se
                                                     acredite la personalidad jurídica del solicitante.</b></p>
                                                    
                                                     <p class="text-justify">Como medida de seguridad sanitaria, para evitar aglomeración de
                                                     personas, se recomienda su puntualidad, no antes ni después del
                                                     horario indicado.</p>
                                                    
                                                     <p class="text-justify">Se pone a su disposición para dudas el teléfono 01(961) 61 8 75 30, Extensiones:</p>
                                                    
                                                     <p class="text-justify">22232.- Área Técnica <br />
                                                     22351.- Área Financiera <br />
                                                     22022.- Área Legal</p>
                                                    
                                                     <p class="text-justify"> Coordinación de Verificación de la Supervisión Externa de la Obra
                                                     Pública Estatal, de la Secretaría Anticorrupción y Buen Gobierno.</p>

                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Atentamente</strong>.<br />
                                                        Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal<br />
                                                        Secretaría Anticorrupción y Buen Gobierno
                                                    </p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <br />
                                                        Este correo electrónico es confidencial y/o puede contener información privilegiada.
                                                        <br /><br />
                                                        Si usted no es su destinatario o no es alguna persona autorizada por este para recibir sus correos electrónicos, NO deberá utilizar,
                                                        copiar, revelar, o tomar ninguna acción basada en este correo electrónico o cualquier otra información incluida en el, favor de notificar
                                                        a los teléfonos proporcionados y borrar a continuación totalmente este mensaje.
                                                        <br /><br />
                                                        Conmutador: (961) 61 8 75 30 Ext. 22022 y 22232

                                                        <br /><br />
                                                        Este correo se genera automaticamente, no responder.
                                                    </p>
                                                </div>                                                
                                            </td>
                                        </tr>
                                        <tr height="32px"></tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr height="16"></tr>
                        <tr>
                            <td style="max-width:600px;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#bcbcbc;line-height:1.5">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#666666;line-height:18px;padding-bottom:10px">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <strong>No se pueden enviar respuestas a esta dirección de correo electrónico</strong>.<br />
                                                                © Secretaría Anticorrupción y Buen Gobierno., Blvd. Los Castillos No. 410, Fracc. Montes Azules Tuxtla Gutiérrez; Chiapas, CP 29056 Conmutador: (961) 61 8 75 30
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>';
    }
    
    public static function notificacionCron($vdatos, $tipoTramite)
    {
        return '<table>
                    <tbody>
                        <tr height="16"></tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#333">
                                    <tbody>
                                        <tr>
                                            <td width="32px"></td>
                                            <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:24px;color:#ffffff;line-height:1.25">
                                                Trámite Observado
                                            </td>
                                            <td width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" height="18px"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #f0f0f0;border-bottom:1px solid #c0c0c0;border-top:0;border-bottom-left-radius:3px;border-bottom-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FAFAFA">
                                    <tbody>
                                        <tr height="16px">
                                            <td rowspan="3" width="32px"></td>
                                            <td></td>
                                            <td rowspan="3" width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>'. $vdatos->razon_social_o_nombre .' </strong>, 
                                                    </p>
													<p style="text-align:justify">
														su trámite de <b>'. $tipoTramite .'</b> con el folio <b>'. $vdatos->folio .' presenta observaciones.
                                                    </p>
                                                    <p style="text-align:justify">
														<b>Aviso:</b> El plazo para solventar las observaciones vence el '. $vdatos->fecha_limite .', en caso de no cumplirse con este, se cerrará el tramite.
													</p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Atentamente</strong>.<br />
                                                        Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal<br />
                                                        Secretaría Anticorrupción y Buen Gobierno
                                                    </p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <br />
                                                        Este correo electrónico es confidencial y/o puede contener información privilegiada.
                                                        <br /><br />
                                                        Si usted no es su destinatario o no es alguna persona autorizada por este para recibir sus correos electrónicos, NO deberá utilizar,
                                                        copiar, revelar, o tomar ninguna acción basada en este correo electrónico o cualquier otra información incluida en el, favor de notificar
                                                        a los teléfonos proporcionados y borrar a continuación totalmente este mensaje.
                                                        <br /><br />
                                                        Conmutador: (961) 61 8 75 30 Ext. 22022 y 22232

                                                        <br /><br />
                                                        Este correo se genera automaticamente, no responder.

                                                        

                                                    </p>
                                                </div>                                                
                                            </td>
                                        </tr>
                                        <tr height="32px"></tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr height="16"></tr>
                        <tr>
                            <td style="max-width:600px;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#bcbcbc;line-height:1.5">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#666666;line-height:18px;padding-bottom:10px">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <strong>No se pueden enviar respuestas a esta dirección de correo electrónico</strong>.<br />
                                                                © Secretaría Anticorrupción y Buen Gobierno., Blvd. Los Castillos No. 410, Fracc. Montes Azules Tuxtla Gutiérrez; Chiapas, CP 29056 Conmutador: (961) 61 8 75 30
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>';
    }
	
    public static function creacion_cuenta($vdatos)
    {
        return '<table>
                    <tbody>
                        <tr height="16"></tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#333">
                                    <tbody>
                                        <tr>
                                            <td width="32px"></td>
                                            <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:24px;color:#ffffff;line-height:1.25">
                                                Creación de cuenta
                                            </td>
                                            <td width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" height="18px"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #f0f0f0;border-bottom:1px solid #c0c0c0;border-top:0;border-bottom-left-radius:3px;border-bottom-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FAFAFA">
                                    <tbody>
                                        <tr height="16px">
                                            <td rowspan="3" width="32px"></td>
                                            <td></td>
                                            <td rowspan="3" width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Estimado(a): C. '. $vdatos['name'] .' </strong>, 
                                                    </p>
                                                    <p>
                                                        Usted ha finalizado <b>exitosamente<b/> el proceso de <b>Creación de cuenta</b>. Su <b>clave de consulta electrónica</b>, para que obtenga información sobre el avance del mismo, son las siguientes:
                                                    </p>
                                                </div>                                               

                                                <div style="text-align:center">
                                                    <p>
                                                        Usuario<br />
                                                        <strong style="text-align:center;font-size:24px;font-weight:bold">'. $vdatos['nickname'] .'</strong>
                                                    </p>
                                                   <p>
                                                        Contraseña<br />
                                                        <strong style="text-align:center;font-size:24px;font-weight:bold">'. $vdatos['password'] .'</strong>
                                                    </p>                                                    

                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Advertencia: </strong> El uso de la cuenta, así como el accesar al Sistema de Registro de Contrastas y Supervisores Externos, por medio del usuario y contraseña es responsabilidad de la persona a la que le fue otorgada; se recomienda cambiar su contraseña periodicamente para aumentar la seguridad de su cuenta, ni compartir con terceros.<br><br>Link para ingresar al sistema: https://apps.anticorrupcionybg.gob.mx/cruc_balam
                                                    </p>
                                                </div>                                                
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Atentamente</strong>.<br />
                                                        Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal<br />
                                                        Secretaría Anticorrupción y Buen Gobierno
                                                    </p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <br />
                                                        Este correo electrónico es confidencial y/o puede contener información privilegiada.
                                                        <br />
                                                        Si usted no es su destinatario o no es alguna persona autorizada por este para recibir sus correos electrónicos, NO deberá utilizar,
                                                        copiar, revelar, o tomar ninguna acción basada en este correo electrónico o cualquier otra información incluida en el, favor de notificar
                                                        a los teléfonos proporcionados y borrar a continuación totalmente este mensaje.
                                                        <br />
                                                        Conmutador: (961) 61 8 75 30 Ext. 22022 y 22232

                                                        <br />
                                                        Este correo se genera automaticamente, no responder.

                                                    </p>
                                               </div>                                                
                                            </td>
                                        </tr>
                                        <tr height="32px"></tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr height="16"></tr>
                        <tr>
                            <td style="max-width:600px;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#bcbcbc;line-height:1.5">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#666666;line-height:18px;padding-bottom:10px">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <strong>No se pueden enviar respuestas a esta dirección de correo electrónico</strong>.<br />
                                                                © Secretaría Anticorrupción y Buen Gobierno., Blvd. Los Castillos No. 410, Fracc. Montes Azules Tuxtla Gutiérrez; Chiapas, CP 29056 Conmutador: (961) 61 8 75 30
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>';
    } 

    public static function solicitud_enviada($vdatos)
    {
        return '<table>
                    <tbody>
                        <tr height="16"></tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#333">
                                    <tbody>
                                        <tr>
                                            <td width="32px"></td>
                                            <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:24px;color:#ffffff;line-height:1.25">
                                                Trámite iniciado
                                            </td>
                                            <td width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" height="18px"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #f0f0f0;border-bottom:1px solid #c0c0c0;border-top:0;border-bottom-left-radius:3px;border-bottom-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FAFAFA">
                                    <tbody>
                                        <tr height="16px">
                                            <td rowspan="3" width="32px"></td>
                                            <td></td>
                                            <td rowspan="3" width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>'. $vdatos['name'] .' </strong>, 
                                                    </p>
                                                    <p style="text-align:justify">
														Con esta fecha se ha recibido su solicitud de trámite de <b>'. $vdatos['tipo_tramite'] .'</b> con el folio <b>'. $vdatos['folio'] .'</b> y con fecha de inicio <b>'. $vdatos['fecha_inicio'] .'</b>.
                                                    </p>
                                                    <p style="text-align:justify">
                                                        La Secretaría procederá al análisis de la documentación proporcionada. Cuando el
                                                        solicitante no cumpla con los requisitos aplicables o se le requiera alguna aclaración, la
                                                        Secretaría realizará por una sola ocasión la prevención para subsanar la informaciónfaltante,
                                                        misma que se dará a conocer mediante un Aviso Electrónico, para que solvente las
                                                        observaciones;la cual surtirá efectos a partir del cuarto día hábil siguiente.
                                                    </p>
                                                    <p style="text-align:justify">
                                                        Una vez que surta efectos la notificación del Aviso Electrónico de prevención, el Interesado
                                                        tendrá un plazo de cinco días hábiles, para realizar las solventaciones correspondientes;
                                                        transcurrido el plazo sin que el solicitante desahogue la prevención, se desechará el trámite
                                                        de la solicitud, pudiendo el Interesado solicitar nuevamente el trámite correspondiente.
                                                    </p>

                                                    <p style="text-align:justify">
                                                        La Secretaría, a partir de que se tengan solventadas las observaciones y/o el Interesado
                                                        presente la documentación completa con todos los requisitos; tendrá un plazo de treinta días
                                                        naturales para otorgar o negar la constancia de inscripción, y de quince días naturales en los
                                                        casos de modificación o actualización en el Registro de Contratistas o de Supervisores
                                                        Externos, para el otorgamiento o negación de la constancia.
                                                    </p>
                                                    
                                                    <p style="text-align:justify">Todos los seguimientos al trámite se le notificarán a su cuenta a través del <b>Sistema de Registro de Contratistas y de Supervisores Externos (SIRCSE)</b> y a este correo  electrónico.</p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Atentamente</strong>.<br />
                                                        Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal<br />
                                                        Secretaría Anticorrupción y Buen Gobierno
                                                    </p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <br />
                                                        Este correo electrónico es confidencial y/o puede contener información privilegiada.
                                                        <br /><br />
                                                        Si usted no es su destinatario o no es alguna persona autorizada por este para recibir sus correos electrónicos, NO deberá utilizar,
                                                        copiar, revelar, o tomar ninguna acción basada en este correo electrónico o cualquier otra información incluida en el, favor de notificar
                                                        a los teléfonos proporcionados y borrar a continuación totalmente este mensaje.
                                                        <br /><br />
                                                        Conmutador: (961) 61 8 75 30 Ext. 22022 y 22232

                                                        <br /><br />
                                                        Este correo se genera automaticamente, no responder.

                                                        

                                                    </p>
                                                </div>                                                
                                            </td>
                                        </tr>
                                        <tr height="32px"></tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr height="16"></tr>
                        <tr>
                            <td style="max-width:600px;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#bcbcbc;line-height:1.5">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#666666;line-height:18px;padding-bottom:10px">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <strong>No se pueden enviar respuestas a esta dirección de correo electrónico</strong>.<br />
                                                                © Secretaría Anticorrupción y Buen Gobierno., Blvd. Los Castillos No. 410, Fracc. Montes Azules Tuxtla Gutiérrez; Chiapas, CP 29056 Conmutador: (961) 61 8 75 30
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>';
    }

    public static function reasignacion_folio($vdatos)
    {
        return '<table>
                    <tbody>
                        <tr height="16"></tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#333">
                                    <tbody>
                                        <tr>
                                            <td width="32px"></td>
                                            <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:24px;color:#ffffff;line-height:1.25">
                                                Reasignación de Folio
                                            </td>
                                            <td width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" height="18px"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #f0f0f0;border-bottom:1px solid #c0c0c0;border-top:0;border-bottom-left-radius:3px;border-bottom-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FAFAFA">
                                    <tbody>
                                        <tr height="16px">
                                            <td rowspan="3" width="32px"></td>
                                            <td></td>
                                            <td rowspan="3" width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>'. $vdatos['name'] .' </strong>, 
                                                    </p>
                                                    <p style="text-align:justify">
                                                        Derivado del aviso de cierre de ventanilla, programado para el día 30 de septiembre de 2022.
                                                    </p>
                                                    <p style="text-align:justify">
                                                        Me permito comunicarle, que existió saturación de ingresos de solicitudes en el sistema, dentro de los primeros minutos de la fecha antes referida. Como consecuencia, el SIRCSE, no asignó de manera cronológica los folios correspondientes; por tal motivo, con el objetivo de brindar un mejor servicio y control de las solicitudes, se efectuó el reordenamiento correspondiente, otorgándole a su registro el presente número correcto y definitivo mediante el cual podrá usted darle seguimiento.
                                                    </p>
                                                    <p style="text-align:justify">
                                                        Artículo 30, fracción IX, del Reglamento Interior de la Secretaría Anticorrupción y Buen Gobierno, y artículo 2, de los Lineamientos para el Trámite y Expedición de Constancias de Registro de Contratistas y de Supervisores Externos.
                                                    </p>
                                                    <p style="text-align:justify">
                                                        Su solicitud de trámite de <b>'. $vdatos['tipo_tramite'] .'</b> se le reasigno un nuevo folio el cual es  <b>'. $vdatos['folio'] .'</b> que inicio con fecha  <b>'. $vdatos['fecha_inicio'] .'</b>.
                                                    </p>
                                                    <p style="text-align:justify">
                                                    La Secretaría procederá al análisis de la documentación proporcionada, en caso de que no cumpla con los requisitos aplicables o se le requiera alguna aclaración. La Secretaría prevendrá por una sola vez, para que subsane la omisión u observaciones dentro del término de <b>cinco días hábiles</b>, contados a partir de que haya surtido efectos la notificación; transcurrido el plazo sin que el solicitante desahogue la prevención, se desechará el trámite de la solicitud, pudiendo interesado solicitar nuevamente el trámite correspondiente.
                                                    </p>
                                                    <p style="text-align:justify">
                                                    La Secretaría tendrá por recibida una solicitud y comenzará a correr el plazo de treinta días naturales, para que otorgue o niegue la constancia de inscripción, modificación o actualización en el registro de Contratistas o de Supervisores Externos, cuando el solicitante solvente las observaciones o presente la documentación completa con todos los requisitos
                                                    </p>
                                                    
                                                    <p style="text-align:justify">Todos los seguimientos al trámite se le notificarán a su cuenta a través del <b>Sistema de Registro de Contratistas y de Supervisores Externos (SIRCSE)</b> y a este correo  electrónico.</p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Atentamente</strong>.<br />
                                                        Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal<br />
                                                        Secretaría Anticorrupción y Buen Gobierno
                                                    </p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <br />
                                                        Este correo electrónico es confidencial y/o puede contener información privilegiada.
                                                        <br /><br />
                                                        Si usted no es su destinatario o no es alguna persona autorizada por este para recibir sus correos electrónicos, NO deberá utilizar,
                                                        copiar, revelar, o tomar ninguna acción basada en este correo electrónico o cualquier otra información incluida en el, favor de notificar
                                                        a los teléfonos proporcionados y borrar a continuación totalmente este mensaje.
                                                        <br /><br />
                                                        Conmutador: (961) 61 8 75 30 Ext. 22022 y 22232

                                                        <br /><br />
                                                        Este correo se genera automaticamente, no responder.

                                                        

                                                    </p>
                                                </div>                                                
                                            </td>
                                        </tr>
                                        <tr height="32px"></tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr height="16"></tr>
                        <tr>
                            <td style="max-width:600px;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#bcbcbc;line-height:1.5">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#666666;line-height:18px;padding-bottom:10px">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <strong>No se pueden enviar respuestas a esta dirección de correo electrónico</strong>.<br />
                                                                © Secretaría Anticorrupción y Buen Gobierno., Blvd. Los Castillos No. 410, Fracc. Montes Azules Tuxtla Gutiérrez; Chiapas, CP 29056 Conmutador: (961) 61 8 75 30
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>';
    }

    public static function recuperar_contrasenia($vdatos)
    {
        return '<table>
                    <tbody>
                        <tr height="16"></tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#333">
                                    <tbody>
                                        <tr>
                                            <td width="32px"></td>
                                            <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:24px;color:#ffffff;line-height:1.25">
                                                Restablecer contraseña
                                            </td>
                                            <td width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" height="18px"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #f0f0f0;border-bottom:1px solid #c0c0c0;border-top:0;border-bottom-left-radius:3px;border-bottom-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FAFAFA">
                                    <tbody>
                                        <tr height="16px">
                                            <td rowspan="3" width="32px"></td>
                                            <td></td>
                                            <td rowspan="3" width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Estimado(a): C. '. $vdatos['name'] .' </strong>, 
                                                    </p>
                                                    <p>
                                                        Se ha generado una nueva <b>contraseña<b/> para poder accesar al sistema, las credenciales con las que podra accesar al sistema son las siguiente:
                                                    </p>
                                                </div>                                               

                                                <div style="text-align:center">
                                                    <p>
                                                        Usuario<br />
                                                        <strong style="text-align:center;font-size:24px;font-weight:bold">'. $vdatos['nickname'] .'</strong>
                                                    </p>
                                                   <p>
                                                        Contraseña<br />
                                                        <strong style="text-align:center;font-size:24px;font-weight:bold">'. $vdatos['password'] .'</strong>
                                                    </p>                                                    

                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Advertencia: </strong> El uso de la cuenta, así como el accesar al Sistema de Registro de Contrastas y Supervisores Externos, por medio del usuario y contraseña es responsabilidad de la persona a la que le fue otorgada; se recomienda cambiar su contraseña periodicamente para aumentar la seguridad de su cuenta, ni compartir con terceros.<br><br>Link para ingresar al sistema: https://apps.anticorrupcionybg.gob.mx/cruc_balam
                                                    </p>
                                                </div>                                                
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Atentamente</strong>.<br />
                                                        Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal<br />
                                                        Secretaría Anticorrupción y Buen Gobierno
                                                    </p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <br />
                                                        Este correo electrónico es confidencial y/o puede contener información privilegiada.
                                                        <br />
                                                        Si usted no es su destinatario o no es alguna persona autorizada por este para recibir sus correos electrónicos, NO deberá utilizar,
                                                        copiar, revelar, o tomar ninguna acción basada en este correo electrónico o cualquier otra información incluida en el, favor de notificar
                                                        a los teléfonos proporcionados y borrar a continuación totalmente este mensaje.
                                                        <br />
                                                        Conmutador: (961) 61 8 75 30 Ext. 22022 y 22232

                                                        <br />
                                                        Este correo se genera automaticamente, no responder.

                                                        

                                                    </p>
                                               </div>                                                
                                            </td>
                                        </tr>
                                        <tr height="32px"></tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr height="16"></tr>
                        <tr>
                            <td style="max-width:600px;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#bcbcbc;line-height:1.5">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#666666;line-height:18px;padding-bottom:10px">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <strong>No se pueden enviar respuestas a esta dirección de correo electrónico</strong>.<br />
                                                                © Secretaría Anticorrupción y Buen Gobierno., Blvd. Los Castillos No. 410, Fracc. Montes Azules Tuxtla Gutiérrez; Chiapas, CP 29056 Conmutador: (961) 61 8 75 30
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>';
    }     

    public static function tramite_finalizado($vdatos)
    {
        return '<table>
                    <tbody>
                        <tr height="16"></tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#333">
                                    <tbody>
                                        <tr>
                                            <td width="32px"></td>
                                            <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:24px;color:#ffffff;line-height:1.25">
                                                Trámite concluido
                                            </td>
                                            <td width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" height="18px"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #f0f0f0;border-bottom:1px solid #c0c0c0;border-top:0;border-bottom-left-radius:3px;border-bottom-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FAFAFA">
                                    <tbody>
                                        <tr height="16px">
                                            <td rowspan="3" width="32px"></td>
                                            <td></td>
                                            <td rowspan="3" width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>'. $vdatos['name'] .' </strong>, 
                                                    </p>
                                                    <p style="text-align:justify">                                                      
                                                        Se le notifica que su trámite de <b>'. $vdatos['tipo_tramite'] .'</b> con folio <b>'. $vdatos['folio'] .'</b> ha finalizado, y le ha sido agendada una cita para la entrega de su Constancia de Registro de Contratistas, para el día <b>'.\App\Http\Classes\FormatDate::dia_mes_anio($vdatos['fecha_cita'],1).'</b> a las <b>'.$vdatos['hora_cita'].'</b>, conforme a lo siguiente:
                                                    </p>
                                                    
                                                    <p style="text-align:justify">
                                                        <b>
                                                        SR. CONTRATISTA, EN CASO DE QUE NO PUEDA ASISTIR A SU CITA, DEBERÁ NOTIFICARLO INMEDIATAMENTE AL TELEFONO 961 61 8 75 30, EXT. 22012, CON EL LIC. MANLIO FAVIO CHACON SOL.
                                                        </b>
                                                    </p>

                                                    <p style="text-align:justify">
                                                        <b>
                                                        Para dar cumplimiento y celeridad en la atención a su cotejo, se solicita muy atentamente, de conformidad con los artículos 3, fracción V; 5, fracciones VII, VIII y IX; 6 y 9 de los Lineamientos para el Trámite y Expedición de Constancias de Registro de Contratistas y de Supervisores Externos, presente en su cotejo, la documentación que le corresponda de conformidad con su tipo de trámite, siendo la siguiente:
                                                        </b>
                                                    </p>                
                                                    
                                                    <p style="text-align:justify">
                                                        <ul style="list-style:none;">
                                                            <li>
                                                                Presentar la documentación original y copias correspondientes en: carpeta color blanca, tipo esquela, tamaño carta, de tres arillos, con carátula, especificando según corresponda: “Inscripción”,“Actualización” o “Modificación”, número de folio asignado y los datos generales de la persona física o moral solicitante.
                                                            </li>
                                                            <br /><br />

                                                            <li>
                                                                <b>Legal:</b> (Formato F-1), recibo oficial de pago de derechos, constancia de Representante Técnico, escrito de designación yaceptación de cargo de Representante Técnico (Formato F-2), comprobante de domicilio, constancia de situación fiscal, registro estatal de contribuyentesFormato FR-1, constancia de no adeudo de obligaciones fiscales estatal, registro de afiliación al instituto mexicano del seguro social u opinión de cumplimiento de obligaciones, CURP de representante y socios, credencial para votar vigente de representante y socios, acta constitutiva y sus modificaciones y registro público de la propiedad y del comercio.
                                                            </li>
                                                            <br /><br />

                                                            <li>
                                                                <b>Financiero:</b> SISCONT, declaraciones, designación del contador público (Formato F-3), asimismo, relaciones analíticas y documentación soporte en original; y, su contraseña correspondiente para que el contratista descargue de manera presencial la Declaración Anual del Impuesto Sobre la Renta.
                                                            </li>
                                                            <br /><br />
                                                            
                                                            <li>
                                                                <b>Técnico:</b> Currículum vitae de empresa y RTEC, contratos (Únicamente de los contratos que haya subido al sistema SIRCSE), actas de entrega-recepción y finiquito de obra, constancia vigente emitida por el colegio de profesionistas, cédula profesional del RTEC, credencial para votar vigente y CURP de representante técnico, constancia vigente y de años anteriores emitidos por esta Secretaria.
                                                            </li>    
                                                        </ul>                                               
                                                    </p>
                                                    
                                                    <p style="text-align:justify">
                                                        <b>
                                                            Cuando el Interesado acuda a la cita y no presente la documentación completa en original o en su caso no asista el Interesado y/o su Representante Técnico a la cita para Cotejo de la documentación, se reagendará por única ocasión una nueva cita, en caso de reincidencia la Coordinación podrá desechar el trámite.
                                                        </b>
                                                    </p>
                                                    
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Atentamente</strong>.<br />
                                                        Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal, de la Secretaría Anticorrupción y Buen Gobierno.<br />
                                                        Cita en Boulevard Los Castillos 410, Fraccionamiento Montes Azules, Tuxtla Gutiérrez, Chiapas. C.P. 29056.<br />
                                                        Teléfono 961 61 8 75 30.<br />
                                                        Extensión 22022.- Área Legal<br />
                                                        Extensión 22351.- Área Financiera <br />
                                                        Extensión 22232.- Área Técnica 

                                                    </p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <br />
                                                        Este correo electrónico es confidencial y/o puede contener información privilegiada.
                                                        <br /><br />
                                                        Si usted no es su destinatario o no es alguna persona autorizada por este para recibir sus correos electrónicos, NO deberá utilizar,
                                                        copiar, revelar, o tomar ninguna acción basada en este correo electrónico o cualquier otra información incluida en el, favor de notificar
                                                        a los teléfonos proporcionados y borrar a continuación totalmente este mensaje.
                                                       
                                                        <br /><br />
                                                        Este correo se genera automaticamente, no responder.                                                       

                                                    </p>
                                                </div>                                                
                                            </td>
                                        </tr>
                                        <tr height="32px"></tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr height="16"></tr>
                        <tr>
                            <td style="max-width:600px;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#bcbcbc;line-height:1.5">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#666666;line-height:18px;padding-bottom:10px">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <strong>No se pueden enviar respuestas a esta dirección de correo electrónico</strong>.<br />
                                                                © Secretaría Anticorrupción y Buen Gobierno., Blvd. Los Castillos No. 410, Fracc. Montes Azules Tuxtla Gutiérrez; Chiapas, CP 29056 Conmutador: (961) 61 8 75 30
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>';
    }

    public static function tramite_rechazado($vdatos)
    {
        return '<table>
                    <tbody>
                        <tr height="16"></tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#333">
                                    <tbody>
                                        <tr>
                                            <td width="32px"></td>
                                            <td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:24px;color:#ffffff;line-height:1.25">
                                                Trámite Negado
                                            </td>
                                            <td width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" height="18px"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="min-width:332px;max-width:680px;border:1px solid #f0f0f0;border-bottom:1px solid #c0c0c0;border-top:0;border-bottom-left-radius:3px;border-bottom-right-radius:3px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FAFAFA">
                                    <tbody>
                                        <tr height="16px">
                                            <td rowspan="3" width="32px"></td>
                                            <td></td>
                                            <td rowspan="3" width="32px"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="text-align:justify">
                            <p style="text-align:justify">
                                Con fundamento en los artículos 14 y 16, de la Constitución Política de los Estados Unidos Mexicanos; 31, fracción XXXI, de la Ley Orgánica de la Administración Pública del Estado de Chiapas; 25 último párrafo, de la Ley de Obra Pública del Estado de Chiapas; 26 primer párrafo; 18 fracción III, del Reglamento de la Ley de Obra Pública; y 30 fracción XIII, del Reglamento Interior de esta Secretaría; se le notifica: 
                            </p>
                                                    <p>
                                                        <strong>'. $vdatos['razon_social_o_nombre'] .' </strong>, 
                                                    </p>
                                                    <p style="text-align:justify">
                                                        Su trámite de <b>'. $vdatos['tipo_tramite'] .'</b> con folio <b>'. $vdatos['folio'] .'</b> ha sido <b>Negado/Desechado</b> por el siguiente motivo:
                                                    </p>
                                                    <p>
                                                        '. $vdatos['motivo'] .'
                                                    </p>                                              
                                                    
                                                    <p style="text-align:justify">Todos los seguimientos al trámite se le notificarán a travéz del Sistema de Registro de Contratistas y Supervisores Externos (SIRCSE) y a éste correo  electrónico.</p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <strong>Atentamente</strong>.<br />
                                                        Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal<br />
                                                        Secretaría Anticorrupción y Buen Gobierno
                                                    </p>
                                                </div>
                                                <div style="text-align:justify">
                                                    <p>
                                                        <br />
                                                        Este correo electrónico es confidencial y/o puede contener información privilegiada.
                                                        <br /><br />
                                                        Si usted no es su destinatario o no es alguna persona autorizada por este para recibir sus correos electrónicos, NO deberá utilizar,
                                                        copiar, revelar, o tomar ninguna acción basada en este correo electrónico o cualquier otra información incluida en el, favor de notificar
                                                        a los teléfonos proporcionados y borrar a continuación totalmente este mensaje.
                                                        <br /><br />
                                                        Conmutador: (961) 61 8 75 30 Ext. 22022 y 22232

                                                        <br /><br />
                                                        Este correo se genera automaticamente, no responder.
                                                    </p>
                                                </div>                                                
                                            </td>
                                        </tr>
                                        <tr height="32px"></tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr height="16"></tr>
                        <tr>
                            <td style="max-width:600px;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#bcbcbc;line-height:1.5">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#666666;line-height:18px;padding-bottom:10px">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <strong>No se pueden enviar respuestas a esta dirección de correo electrónico</strong>.<br />
                                                                © Secretaría Anticorrupción y Buen Gobierno., Blvd. Los Castillos No. 410, Fracc. Montes Azules Tuxtla Gutiérrez; Chiapas, CP 29056 Conmutador: (961) 61 8 75 30
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>';
    } 
}
