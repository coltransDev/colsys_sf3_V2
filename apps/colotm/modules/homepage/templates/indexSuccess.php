<div align="center">
<?

if( $sf_user->hasCredential("customer") ){
	
	$saludo = $contacto->getCaSaludo();
	if( strtolower($saludo)=="señora"||strtolower($saludo)=="doctora"||strtolower($saludo)=="doña"){
		$bienvenida  = "Bienvenida";
	}else{
		$bienvenida  = "Bienvenido";
	}	
	?>	
	<h3><?=$bienvenida?> a nuestro sistema de Tracking &amp; Tracing</h3>
	<br />	
	<form action="<?=url_for("homepage/index")?>" method="post">	
	
	<table width="52%" border="1" class="table1">
		<tr>
			<th scope="col">Por favor seleccione un cliente</th>
		</tr>
		<?
		$i=0;
		foreach( $clientes as $cliente ){	
		?>
		<tr>	
			<td align="left">
			  <div align="left">
			  	<input type="radio" name="cliente" value="<?=$cliente->getCaIdcliente()?>" <?=$i==0?'checked="checked"':''?> />
				<?=$cliente?>				
				<br />			   
	          </div>
			 </td>
		</tr>
		<?
			$i++;
		}
		?>
		<tr>
			<td>			  
			  <div align="center">
			  	<input type="submit" value="Continuar" class="button" />
		      </div></td></tr>
	</table>	
	</form>
<?
}
?>
</div>