<?
if( $reporte->getCaModalidad()=="FCL" ){
?>
<div align="center" class="vigencia">F_03 Versi&oacute;n 04 Vigencia 07-11-2007 Aprobado por Sandra Camargo </div>
<?
}
if( $reporte->getCaModalidad()=="LCL" ){
?>
<div align="center" class="vigencia">F_22  Versi&oacute;n 04 Vigencia 07-11-2007 Aprobado por Sandra Camargo </div>
<?
}
if(  $reporte->getCaTransporte() == Constantes::AEREO ){
?>
<div align="center" class="vigencia">F_02 Versi&oacute;n 04 Vigencia 07-09-2007  </div>
<?
}
?>
<div class="htmlContent">
<?
$repexpo = $reporte->getRepExpo();


echo $status->getCaIntroduccion();

?>
<br />
<br />

<table width="500px" border="0" cellspacing="0" cellpadding="5" class="tableList">
	<tr>
		<td width="246"><strong>Origen:</strong></td>
		<td width="254"><?=$reporte->getOrigen()?></td>
		
	</tr>
	<tr>
		<td><strong>Destino:</strong></td>
		<td><?=$reporte->getDestino()?></td>
		
	</tr>
	<?
	if( $status->getCaEquipos() ){
	?>
	<tr>
		<td><strong>Equipos:</strong></td>
		<td><?=$status->getCaEquipos()?></td>		
	</tr>
	<?
	}
	
	if( $reporte->getCaModalidad()=="LCL" || $reporte->getCaTransporte() == "Aereo/Terrestre"  || $reporte->getCaTransporte() == "Aereo" ){
	?>
	<tr>
		<td><strong>Piezas:</strong></td>
		<td><?=str_replace("|", " ", $status->getCaPiezas())?></td>		
	</tr>
	<tr>
		<td><strong>Peso:</strong></td>
		<td><?=str_replace("|", " ",$status->getCaPeso())?></td>		
	</tr>
	<tr>
		<td><strong>Volumen:</strong></td>
		<td><?=str_replace("|", " ",$status->getCaVolumen())?></td>		
	</tr>
	<?
	
	}
	?>
	<tr>
		<td><strong><?=($reporte->getCaTransporte()==Constantes::MARITIMO )?"HBL":"Guia"?></strong></td>
		<td><?=$status->getCaDoctransporte()?></td>
	</tr>
	<tr>
		<td><strong>Producto:</strong></td>
		<td><?=$reporte->getCaMercanciaDesc()?></td>
	</tr>
	<?
	if( $reporte->getCaTransporte()==Constantes::MARITIMO ) {
	?>
	<tr>
		<td><strong>Emisi&oacute;n BLs:</strong></td>
		<td><?=$repexpo->getCaEmisionbl()?></td>		
	</tr>	
	<?
	}
	?>
</table>

<br />
<table width="500px" border="0" cellspacing="0" cellpadding="5" class="tableList">
	<tr>
		<td width="249"><strong>SALIDA:</strong></td>
		<td width="251"><?=$reporte->getOrigen()?></td>
		
	</tr>
	<tr>
		<td>
		<strong>
		<?
		if( $reporte->getCaTransporte()==Constantes::MARITIMO ){
		?>	
		M/N:
		<?
		}else{
		?>	
		Vuelo:
		<?
		}
		?>
		</strong>
		</td>
		<td><?=$status->getCaIdnave()?></td>
		
	</tr>
	<?
	if( $status->getCaFchSalida() ){
	?>
	<tr>
		<td>
			<strong>
			<?
			if( $status->getCaIdEtapa()=="EECEM" ){
				echo "Fecha estimada de salida";
			}else{
				echo "Fecha de salida";
			}
			?>
			</strong></td>
		<td><?=Utils::fechaMes( $status->getCaFchSalida() )." ".$status->getCaHorasalida()?> </td>
	</tr>
	<?
	}
	?>
	
	<?
	if( $status->getCaHoraSalida() ){
	?>
	<tr>
		<td><strong>Hora</strong><strong>:</strong></td>
		<td><?=$status->getCaHoraSalida()?></td>
	</tr>
	<?
	}
	
	if( $status->getCaFchllegada() ){
	?>
	<tr>
		<td>
			<strong>
			<?			
			echo "Fecha estimada de arribo:";			
			?>
			</strong>
		</td>
		<td><?=Utils::fechaMes( $status->getCaFchllegada() )?></td>
	</tr>
	<?
	}
	?>
</table>

<br />
<?
if( $repexpo->getCaDatosbl() && $reporte->getCaTransporte()=="Mar�timo"){
?>
	<strong>DATOS EN DESTINO PARA RECLAMAR BLs<br /></strong>	
	<?=nl2br($repexpo->getCaDatosbl())?>
	<br />	
	<br />
	
<?
}
echo $status->getCaStatus()."<br /><br />";
echo $status->getCaComentarios()?"<strong>NOTA</strong><br />".Utils::replace($status->getCaComentarios()):"";

?>	
	
	<br />
	<br />
	Cordial saludo,  
	<br />
	<br />

	
		

<?
echo $user->getFirmaHTML();
?>
</div>