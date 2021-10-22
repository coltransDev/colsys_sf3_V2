<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$reporte = $sf_data->getRaw("reporte");

//echo $reporte->getCaConsecutivo();
?>

    <div id="emailForm" align="center">

        <form name="form1" id="form1" method="post" action="<?=url_for("reportesNeg2/enviarEmailSolicitud?idreporte=".str_replace(".","|",$reporte->getCaIdreporte()))?>" >
            <input type="hidden" name="checkObservaciones" id="checkObservaciones" value="" />
<?
        $asunto  = "Solicitud de Servicio Id: ".$reporte->getCaConsecutivo()." / ". $reporte->getCliente()->getCaCompania() ."/ ".$reporte->getDatosJson("do")." / ".$reporte->getCaOrdenClie() ;
        
        
        $mensaje = "
            
            Nota Importante:
Tener en cuenta que la responsabilidad de la verificación del cumplimiento de los requisitos de seguridad y control, sobre conductores y terceros que sean utilizados para la prestación del servicio, sera de cada uno de ustedes como proveedores  aprobados de nuestra compañía.";//"Señores ".$ref->getCaReferencia();
        include_component("email", "formEmail", array("subject"=>$asunto,"message"=>$mensaje, "contacts"=>$contactos));

        ?>
        <br />
         <table class="tableList alignLeft" width="60%">         
         <tr>
            <th>Archivos Adjuntados</th>
         </tr>
         <tr><td>
<?
    
        include_component("gestDocumental", "returnFiles",array("idsserie"=>"19","view"=>"email","ref1"=>$reporte->getCaConsecutivo(),"ref2"=>"","ref3"=>"","format"=>"coloader"));

?>
        </td></tr>
        </table>
        <input type="submit" value="Enviar" class="button" />
        <br />
        <br />
        </form>
    </div>