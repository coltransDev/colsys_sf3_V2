<div align="center" class="content">
<h1>Se ha enviado una notificación a los siguientes destinatarios:</h1>
<br />

<h3><?=link_to( "<h3>haga click aca para volver</h3>","/reportes/verReporte?id=".$reporte->getCaIdreporte() );?></h3>
<br />

<table width="50%" border="0" class="tableList">

<tr>
	<th width="11%" scope="col"><b>Grupo</b></th>
	<th width="28%" scope="col"><b>Acci&oacute;n</b></th>
	<th width="31%" scope="col"><b>Usuario</b></th>
	<th width="30%" scope="col"><b>e-mail</b></th>
</tr>
<?
foreach( $grupos as $grupo=>$logins ){
	foreach( $logins as $login ){
        if(!in_array( $login ,$asignaciones ) ){
            continue;
        }
		$usuario = UsuarioPeer::retrieveByPk( $login );
	?>
	<tr>
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
	</tr>
	<?
	}
}
?>
</table>


</div>