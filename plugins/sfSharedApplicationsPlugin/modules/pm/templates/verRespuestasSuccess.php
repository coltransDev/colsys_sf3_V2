<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


if(count($childrens)>0){
    echo "<br/><span style='color:blue;'><b>Ticket unificado con el (los) tickets: </b></span>";
    foreach($childrens as $children ){        
        ?>        
        <a style="color:green;" href="#" onClick="openTab(<?=$children->getCaIdticket()?>)"><b><?=$children->getCaIdticket()?></b></a>
        <?  
    }
}
include_component("pm", "listaRespuestasTicket", array("idticket"=>$ticket->getCaIdticket(), "opener"=>$opener, "format"=>$format));
?>