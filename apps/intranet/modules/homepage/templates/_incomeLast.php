<?
if( count( $usuarios )>0 ){
?>
<h1>Nuevos Colaboradores</h1>
<?
	foreach ($usuarios as $usuario) {
?>		
		<b><a href="<?=url_for('adminUsers/viewUser?login='.$usuario->getCaLogin()) ?>"><?=$usuario->getCaNombre()?></a></b> 
		
			<small><?=$usuario->getSucursal()->getEmpresa()->getCaNombre()?> - <?=$usuario->getSucursal()->getCaNombre()?><br />
			&nbsp;&nbsp;&nbsp;<?=$usuario->getCaCargo()?></small>
		<br />
<?	
	}
}
?>