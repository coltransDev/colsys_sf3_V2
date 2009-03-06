
<table width="100%" border="1">
	<tr>
		<th scope="col">Nit</th>
		<th scope="col">Nombre</th>
		<th scope="col">Comercial</th>
	</tr>
	


<?
foreach($nits as  $nit ){
	
	$nit = trim( $nit );
	if( $nit ){
		$cliente = ClientePeer::retrieveByPk( $nit );			
	}else{
		$cliente = null;
	}
	?>
	<tr>
		<td><?=$nit?></td>
		<td><?=$cliente?$cliente->getCaCompania():"No encontrado"?></td>
		<td><?=$cliente?$cliente->getCaVendedor():"No encontrado"?></td>
	</tr>
	<?
			
			
}	
?>
</table>