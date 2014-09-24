<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>

<div style="height:100%"></div>


<div class="content" align="center">
    <form action="<?= url_for("antecedentes/buscarReferencia") ?>" method="post">
        <table class="tableList" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" >
            <tr>
                <th colspan="3" style='font-size: 12px; font-weight:bold;'>Sistema de Antecedentes</th>
            </tr>
            <tr>
                <td colspan="3" style='font-size: 10px;'>Ingrese un criterio para realizar las busqueda</td>
            </tr>
            <tr>
                <td width="88" ><b>Buscar por:</b> <br />
                    <select name="criterio" size="7" >
                        <option value="reporte" selected="selected">Reporte</option>
                        <option value="referencia">Referencia</option>
                        <option value="master">Master</option>
                        <option value="hbl">hbl</option>
                        <option value="cliente">Cliente</option>
                        <option value="motonave">Motonave</option>
                    </select>
                </td>
                <td width="337" >&nbsp;
                    <div id="visible" style=""><b>Que contenga la cadena:</b><br />
                        <div id="cadena"><input type="text" name="cadena" id="cadena" size="60" /></div>
                    </div></td>
                <td width="64"  ><input  type='submit' name='buscar' value=' Buscar' /></td>
            </tr>
        </table>
    </form>
    <br />
    <div align="center">
        <a href="<?=url_for("antecedentes/listadoReferencias")?>">Ver el listado completo</a>
    </div>

</div>

