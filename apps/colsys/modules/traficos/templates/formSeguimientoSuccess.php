<?
$url = "traficos/formSeguimiento?modo=".$modo."&reporte=".$reporte->getCaConsecutivo();
if( $tarea ){
    $url  .= "&idtarea=".$tarea->getCaIdtarea();
}
?>
<div class="content" align="center">

<form action="<?=url_for( $url )?>" method="post" name="form1" >

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
		<td id="row_seguimiento"><div align="left"><b>Fecha recordatorio:</b>
            <?
			 echo $form['fchseguimiento']->renderError();
			 if( $tarea ){
			 	$form->setDefault('fchseguimiento', Utils::parseDate($tarea->getCaFchvencimiento(),"Y-m-d") ); 
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
            <?
            if( $tarea && !$tarea->getCaFchterminada() ){
            ?>
			<input type="submit" value="Guardar" class="button" />&nbsp;
            <?
            }
            ?>
			<input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("traficos/listaStatus?modo=".$modo."&reporte=".$reporte->getCaConsecutivo())?>'" />&nbsp;
			<?
            if( $tarea && $tarea->getCaIdtarea() && !$tarea->getCaFchterminada() ){
            ?>
            <input type="button" value="Terminar" class="button" onClick="document.location='<?=url_for("traficos/terminarSeguimiento?modo=".$modo."&reporte=".$reporte->getCaConsecutivo()."&idtarea=".$tarea->getCaIdtarea())?>'" />
            <?
            }
            ?>
		</div></td>
		</tr>
</table>
</form>
</div>