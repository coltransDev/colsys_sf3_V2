<?
	foreach ($usuarios as $usuario) {
?>		
		<b><a href="<?=url_for('adminUsers/viewUser?login='.$usuario->getCaLogin()) ?>"><?=$usuario->getCaNombre()?></a></b> 
		<small>
			<?=$usuario->getSucursal()->getCa_Nombre()?><br />
			&nbsp;&nbsp;&nbsp;<?=$usuario->getCaCargo()?>
		</small><br />
<?	
	}
?>