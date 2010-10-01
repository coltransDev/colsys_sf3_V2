<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<div class="content" align="center">
    <form name="form1" method="POST" action="<?=url_for("inoparametros/importarCuentas")?>" enctype="multipart/form-data">
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
</div>

