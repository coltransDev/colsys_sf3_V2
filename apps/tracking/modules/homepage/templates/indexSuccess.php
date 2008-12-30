<div align="center">
<?

if( $sf_user->hasCredential("customer") ){


	
	$saludo = $contacto->getCaSaludo();
	if( strtolower($saludo)=="señora"||strtolower($saludo)=="doctora"){
		$bienvenida  = "Bienvenida";
	}else{
		$bienvenida  = "Bienvenido";
	}
	
	?>
	
	<h3><?=$bienvenida?> <?=$contacto->getCaSaludo()." ".ucfirst($contacto->getCaNombres())." ".ucfirst($contacto->getCaPApellido())." ".ucfirst($contacto->getCaSApellido())?></h3>
	<br />
	
	<?=form_tag("homepage/index")?>
	
	
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
			    <?=radiobutton_tag("cliente", $cliente->getCaIdcliente(), $i==0)." ".$cliente."<br />"?>	
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
			    <?=submit_tag("Continuar", "class=button")?>
		      </div></td></tr>
	</table>
	
	
	
	</form>
<?
}
?>
</div>