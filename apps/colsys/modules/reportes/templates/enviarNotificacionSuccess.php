<div align="center" class="content">
<br />
    <h1>Se enviar&aacute; una notificaci&oacute;n a los siguientes destinatarios:</h1>

<br />

<form action="<?=url_for("reportes/enviarNotificacion?idreporte=".$reporte->getCaIdreporte())?>" method="post">

<table width="50%" border="0" class="tableList">
<tr>
    <th width="3%" scope="col">&nbsp;</th>
	<th width="11%" scope="col"><b>Grupo</b></th>
	<th width="25%" scope="col"><b>Acci&oacute;n</b></th>
	<th width="31%" scope="col"><b>Usuario</b></th>
	<th width="30%" scope="col"><b>e-mail</b></th>
    <th width="30%" scope="col"><b>Sucursal</b></th>
</tr>
<?
foreach( $grupos as $grupo=>$logins ){		
	foreach( $logins as $login ){
		$usuario = Doctrine::getTable("Usuario")->find( $login );

        
	?>		
	<tr>
        <td><input type="checkbox" name="notificar[]" value="<?=$login?>" ></td>
		<td><?=ucfirst($grupo)?></td>
		<td>
            <?
            if( $grupo=="operativo" ){
                echo " Crear reporte al exterior";
            }else{
                echo "Ver reporte";
            }
            ?>
        </td>
		<td><?
				echo $usuario->getCaNombre();				
			?></td>
		<td><?
				echo $usuario->getCaEmail();				
			?></td>
        <td><?
				echo $usuario->getSucursal()->getcaNombre();
			?></td>
	</tr>
	<?
	}	
}
?>
    <tr>
        <td colspan="5">
            <div align="center">
                 <input type="submit" value="Enviar" class="button"> &nbsp;
                 <input type="button" value="Cancelar" class="button" onclick="document.location='<?=url_for("/reportes/verReporte?id=".$reporte->getCaIdreporte())?>'">

            </div>
        </td>
    </tr>
</table>
</form>
</div>