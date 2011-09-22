<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form id="form1" name="form1" action="<?=url_for("gestDocumental/subirArchivo")?>" method="post" enctype="multipart/form-data" >
<input type="hidden" name="folder" id="folder" value="<?=base64_encode("reportes/".$year."/".$reporte->getCaConsecutivo()."/instrucciones/")?>"  />
<input type="hidden" name="template" id="template" value="responseUpload" />
<input type="hidden" name="namefiletype" id="namefiletype" value="static" />
<input type="hidden" name="referer" id="template" value="<?=base64_encode(url_for("ordenes/formOrden?id=".$reporte->getCaIdreporte()))?>"  />
<table class="tableList" width="60%" id="archivos" align="center">
    <tr>
       <th colspan="2">
           Archivos
       </th>
    </tr>
    <tr>
        <td>HBL original</td><td><input type="file" name="hbl"/><?=($hblold!="")? link_to(basename($folder."/".$hblold), "gestDocumental/verArchivo?idarchivo=".base64_encode($folder."/".$hblold)):""?><input type="hidden" name="hblold" value="<?=$hblold?>"/></td>
    </tr>    
    
    <tr>
        <td>Factura comercial</td><td><input type="file" name="factura"/><?=($facturaold!="")? link_to(basename($folder."/".$facturaold), "gestDocumental/verArchivo?idarchivo=".base64_encode($folder."/".$facturaold)):""?><input type="hidden" name="facturaold" value="<?=$facturaold?>"/></td>
    </tr>
    
    <tr>
        <td>Lista de empaque </td><td><input type="file" name="empaque"/><?=($empaqueold!="")? link_to(basename($folder."/".$empaqueold), "gestDocumental/verArchivo?idarchivo=".base64_encode($folder."/".$empaqueold)):""?><input type="hidden" name="empaqueold" value="<?=$empaqueold?>"/></td>
    </tr>    
    
    <tr>
        <td>Poliza de seguros </td><td><input type="file" name="poliza"/><?=($polizaold!="")? link_to(basename($folder."/".$polizaold), "gestDocumental/verArchivo?idarchivo=".base64_encode($folder."/".$polizaold)):""?><input type="hidden" name="polizaold" value="<?=$polizaold?>"/></td>
    </tr>    
    
    <tr>
        <td>Documentos INVIMA</td><td><input type="file" name="invima"/><?=($invimaold!="")? link_to(basename($folder."/".$invimaold), "gestDocumental/verArchivo?idarchivo=".base64_encode($folder."/".$invimaold)):""?><input type="hidden" name="invimaold" value="<?=$invimaold?>"/></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input type="submit" value="Enviar" /></td>
    </tr>
</table>
</form>