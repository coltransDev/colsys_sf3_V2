<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<form method='post' action="<?=url_for('adminUsers/search')?>">
    <table bgcolor="#FFFFFF" align="right">
        <tr>
            <td>
                <INPUT type='text' name='buscar' size='31' maxlength='255' value="">
            </td>
            <td>
                <INPUT type='submit' name='btn' value="Buscar en Intranet">
            </td>
        </tr>
        <tr>
            <td>
                <a href="<?=url_for("adminUsers/directory")?>">B&uacute;squeda Personalizada</a>
            </td>
        </tr>
    </table>
</form>
   