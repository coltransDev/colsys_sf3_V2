<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
?>

<br />
<br />
<table border="1" class="tableList">
<?php
foreach ($usuarios as $usuario) {
?>
	<tr>
        <td><b><a href="<?=url_for('users/viewUser?login='.$usuario->getCaLogin()) ?>"><?=($usuario->getCaNombre())?></a></b></td>
		<td><?=($usuario->getSucursal()->getCaNombre())?></td>
        <td><?=($usuario->getCaDepartamento())?></td>
	</tr>
<?
}
?>
</table>