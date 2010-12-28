<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


?>

<div style="height:100%"></div>


<div class="content" align="center">
    <form action="<?= url_for("antecedentes/asignacionMaster") ?>">
        <table width="50%" class="tableList" >
            <tr>
                <th colspan="2" >Asignación de Master</th>

            </tr>
            <tr>
                <td>Crear un nuevo numero master</td>
                <td><input type="text" name="master" /></td>
            </tr>
            <tr>
                <td>Usar un numero de master existente</td>
                <td><input type="text" name="master2" /></td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" value="Continuar">
                </td>
            </tr>
        </table>
    </form>
</div>

