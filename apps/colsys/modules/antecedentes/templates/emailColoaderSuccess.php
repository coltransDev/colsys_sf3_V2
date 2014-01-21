<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
    <div id="emailForm" align="center">

        <form name="form1" id="form1" method="post" action="<?=url_for("antecedentes/enviarEmailColoader?ref=".str_replace(".","|",$ref->getCaReferencia()))?>" >
            <input type="hidden" name="checkObservaciones" id="checkObservaciones" value="" />
<?
        $asunto  = "radicacion Coltrans ref: ".$ref->getCaReferencia()."-MBL:".$ref->getCaMbls()."-Mn:".$ref->getCaMotonave()."-ETA:".$ref->getCaFcharribo();
        $mensaje = "";//"Señores ".$ref->getCaReferencia();
        include_component("email", "formEmail", array("subject"=>$asunto,"message"=>$mensaje, "contacts"=>$contactos));

        ?>
        <br />
         <table class="tableList alignLeft" width="60%">         
         <tr>
            <th>Archivos Adjuntados</th>
         </tr>
         <tr><td>
<?
    //include_component("antecedentes", "fileManager", array("ref"=>$ref,"format"=>"coloader"));
        include_component("gestDocumental", "returnFiles",array("idsserie"=>"2","view"=>"email","ref1"=>$ref->getCaReferencia(),"ref2"=>"","ref3"=>"","format"=>"coloader"));
/*        foreach($filenames as $file)
        {
            echo $file["file"]."<br>";
        }*/
?>
        </td></tr>
        </table>
        <input type="submit" value="Enviar" class="button" />
        <br />
        <br />
        </form>
    </div>