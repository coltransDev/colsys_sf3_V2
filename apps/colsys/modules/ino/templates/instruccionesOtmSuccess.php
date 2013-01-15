<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
    <div id="emailForm" align="center">

        <form name="form1" id="form1" method="post" action="<?=url_for("ino/enviarInstruccionesOtm?idmaster=".$idmaster)?>" >
            <input type="hidden" name="checkObservaciones" id="checkObservaciones" value="" />
<?
        $asunto  = "Instrucciones de cargue para la referencia: ".$master->getCaReferencia();        
        $mensaje = "Buen Dia 

Favor instruccionar cargue de una TURBO por SPRC para Jueves XX/XX/XX. 

FAVOR LIQUIDAR BODEGAJES HASTA EL DIA Jueves XX/XX/XX. 

IMPORTANTE: LA CARGA DE AMAREY NO SE PUEDE REMONTAR 

Tener en cuenta las fechas de vencimiento para la entrega y recibo de los tránsitos. 

Tomar registro fotográfico del cargue de la mercancía. 

VERIFICAR LOS CARGUES CONTRA DOCUMENTO DE TRANSPORTE-HBL. 

El cargue se debe efectuar en presencia del funcionario de Coltrans XXXXXX. cel:XXXXXXX 

Cualquier información adicional favor preguntar.

cordial saludo,";
        include_component("email", "formEmail", array("subject"=>$asunto,"message"=>$mensaje, "contacts"=>$contactos));

        ?>
        <br />

        <input type="submit" value="Enviar" class="button" />
        <br />
        <br />
        </form>
    </div>