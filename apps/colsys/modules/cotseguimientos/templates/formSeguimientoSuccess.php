<script language="javascript" type="text/javascript">
var crearSeguimiento=function(){
	if(document.getElementById("prog_seguimiento").checked){
		document.getElementById("row_seguimiento").style.display="";
	}else{
		document.getElementById("row_seguimiento").style.display="none";
	}
}	
</script>
<div align="center" class="content">
<h3>Nuevo seguimiento cotizaci&oacute;n No <?=$cotizacion->getCaConsecutivo()?></h3>
<br>
<?
$url = "cotseguimientos/formSeguimiento?idcotizacion=".$cotizacion->getCaIdcotizacion();
if( isset($producto) && $producto ){
    $url .= "&idproducto=".$producto->getCaIdproducto();
}
?>
<form action="<?=url_for($url)?>" method="post">
<table width="50%" border="0" class="tableList">
    <?
    if( isset($producto) && $producto ){
    ?>
	<tr>
		<th ><b>Trayecto:</b> <?=Utils::replace($producto->__toString())?></th>
	</tr>
    <?
    }else{
    ?>
	<tr>
		<th ><b>Cotizaci&oacute;n:</b> <?=$cotizacion->getCaConsecutivo().Utils::replace($cotizacion->getCliente()->getCaCompania())?></th>
	</tr>
	<?
    }
    $ultSeguimiento =  null;
    foreach( $seguimientos as $seguimiento ){
    ?>
	<tr class="row0">
        <td > <?=Utils::fechaMes($seguimiento->getCaFchseguimiento())." > ".$seguimiento->getEtapa()." > ".$seguimiento->getCaSeguimiento()?></td>
	</tr>
	<?
        $ultSeguimiento = $seguimiento;
    }
	if( $form->renderGlobalErrors() ){
	?>
	<tr>
		<td >				
		 	<div align="left"><?php echo $form->renderGlobalErrors()?></div></td>	
	</tr>
	<?
	}
	?>	
	
	<tr>
		<td>
			<div align="left"><b>Etapa</b><br>
				
						<?		
		echo $form['etapa']->renderError(); 
		if( $ultSeguimiento ){
			 $form->setDefault('etapa', $ultSeguimiento->getCaEtapa() ); 	
		}
		echo $form['etapa']->render();
		?>		
				</div></td>
	</tr>
	<tr>
		<td>
			<div align="left"><b>Seguimiento</b><br>
				
						<?		
		echo $form['seguimiento']->renderError(); 
		echo $form['seguimiento']->render();
		?>		
				</div></td>
	</tr>
	
	<tr>
		<td ><div align="left"><b>recordar seguimiento:</b>
				<?
			 echo $form['prog_seguimiento']->renderError(); 
			 echo $form['prog_seguimiento']->render();
			 ?>
			
		</div></td>
	</tr>
	<tr>
		<td  id="row_seguimiento"><div align="left"><b>Fecha seguimiento:</b>
				<?
			echo $form['fchseguimiento']->renderError(); 
			echo $form['fchseguimiento']->render();
			?>
		</div></td>
		</tr>
	<tr>
		<td>		
			<div align="center">
				<input type="submit" value="Guardar" class="button" >	
				
				<input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("cotseguimientos/verSeguimiento?idcotizacion=".$cotizacion->getCaIdcotizacion())?>'" >				
			</div>		</td>
	</tr>
</table>
</form>
</div>

<script language="javascript" type="text/javascript">	
	crearSeguimiento();
</script>
