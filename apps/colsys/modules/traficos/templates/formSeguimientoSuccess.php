<?
	$tarea = $reporte->getNotTarea();
	?>
<div class="content" align="center">

<form action="<?=url_for("traficos/formSeguimiento?modo=".$modo."&reporte=".$reporte->getCaConsecutivo() )?>" method="post" name="form1" >

<table width="60%" border="0" class="tableList">
	<tr>
		<th>&nbsp;</th>
	</tr>
	<?
	if( $form->renderGlobalErrors() ){
	?>
	<tr>
		<td >				
		 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>	
	</tr>
	<?
	}
	?>	
	<tr>
		<td id="row_seguimiento"><div align="left"><b>Fecha seguimiento:</b>
				<?
			 echo $form['fchseguimiento']->renderError();
			 if( $tarea ){
			 	$form->setDefault('fchseguimiento', $tarea->getCaFchvencimiento("Y-m-d") ); 
			 }			   
			 echo $form['fchseguimiento']->render();
			 ?>
		</div>			
		<br />
		<div align="left"><b>Recordar sobre:</b>
				<?
			 echo $form['txtseguimiento']->renderError(); 
			 if( $tarea ){
			 	$form->setDefault('txtseguimiento', $tarea->getCaTexto() ); 
			 }	
			 echo $form['txtseguimiento']->render();
			 ?>
			</div></td>
		</tr>
	<tr>
		<td ><div align="center">
			<input type="submit" value="Enviar" class="button" />&nbsp;
			
			<input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("traficos/listaStatus?modo=".$modo."&reporte=".$reporte->getCaConsecutivo())?>'" />
		</div></td>
		</tr>
</table>
</form>
</div>