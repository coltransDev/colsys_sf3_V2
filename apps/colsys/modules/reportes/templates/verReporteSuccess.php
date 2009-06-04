<div class="content" align="center">	
	

	<table width='830' cellspacing="1" border="0">
		<tr>
			<td class="partir" style='text-align:center; font-weight:bold; background:#FF0000;' >Favor Imprimir en Tamaño <b>CARTA</b>. Configure su impresora 8,5 x 11 pulg. ó 216 mm x 279 mm</td>
		</tr>
	</table>
	
	<iframe src ='/colsys_php/reporteneg.php?id=<?=$reporte->getCaIdreporte()?>' width='830' height='650' ></iframe>
	<br />
	<br />
	<?
	if( $reporte->getCaIdreporte()>$ultimoReporte  ){
	?>
	<table width='1072' cellspacing="1" border="0" class="tableList">
		<tr>
			<th width="311" >Usuario </th>
			<th width="270" >Le&iacute;do</th>
			<th width="239" >Le&iacute;do Por</th>
			<th width="239" >Fecha Le&iacute;do </th>
		</tr>
		<?		
		foreach( $asignaciones as $asignacion ){
			$tarea = $asignacion->getNotTarea();
			$usuarios = $tarea->getUsuarios(); 
		?>
		<tr>
			<td > 
				<?
				foreach( $usuarios as $usuario ){
					echo Utils::replace($usuario->getCaNombre())."<br />";
				}
				?>			</td>
			<td > 
				<?=$tarea->getCaFchterminada()?image_tag("16x16/button_ok.gif")." Si":image_tag("16x16/button_cancel.gif")." No"?>			</td>
			<td ><?=$tarea->getCaUsuterminada()?$tarea->getCaUsuterminada():"&nbsp;"?></td>
			<td ><?=$tarea->getCaFchterminada()?Utils::fechaMes($tarea->getCaFchterminada("Y-m-d"))." ".$tarea->getCaFchterminada("H:i:s"):"&nbsp;"?></td>
		</tr>
		<?
		}
		?>
	</table>
	<?
	}
	?>
	<br>
	
</div>