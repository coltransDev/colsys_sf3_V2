<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$error = $sf_data->getRaw("error");

?>
<div class="content" align="center">
    <form name="form1" method="POST" action="<?=url_for("inoparametros/genFileFact")?>" enctype="multipart/form-data">
        <table class="tableList" >
            <tr>
                <th>&nbsp;</th>
            </tr>
            <tr>
                <td>Seleccione la ruta del archivo:</td>
            </tr>
            <tr>
                <td><input type="file" name="file" /></td>
            </tr>
            <tr>
                <td align="center"><input type="submit" value="Enviar" class="button" /></td>
            </tr>
        </table>
    </form>
<?   
if($folder && $nameFile)
{
?>
    <table class="tableList" >
        <tr>
            <th>Archivo Generado</th>
        </tr>
        <tr>
            <td>
                Se cre&oacute; el alchivo de facturaci&oacute;n para descargarlo de click a continuaci&oacute;n:<br> <a href='<?=url_for("gestDocumental/verArchivo?idarchivo=").base64_encode($folder."/".$nameFile) ?>'><?=$nameFile?></a>
                <br>
                <br>
            </td>
        </tr>
        
        <tr>
            <th>
                Errores
            </th>
        </tr>
        <tr>
            <td><?=$error?></td>
        </tr>
        
    
<?
}
?>
</div>

