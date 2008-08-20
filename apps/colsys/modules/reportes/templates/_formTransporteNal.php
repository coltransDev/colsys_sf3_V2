<?
$repaduana = $reporteNegocio->getRepAduana();
?>
<table cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td class="listar"><strong>Transporte Nacional</strong></td>
		<td class="listar" rowspan="3"><strong>21.3 Instrucciones Especiales para Transporte Terrestre:</strong><br />
			<?
			if($editable){
				echo textarea_tag("instrucciones", $repaduana->getCaInstrucciones(), "size=80x5 wrap=virtual");			
			}else{
				echo Utils::replace($repaduana->getCaInstrucciones());
			}
			?>										
		</td>
	</tr>
	<tr>
		<td class="listar">
			<?
			if( $reporteNegocio->getcaImpoExpo()=="Importación" ){
				?>
				<strong>21.1 Con Colmas:</strong>								
				<?
				if($editable){		
					echo select_tag("transnacarga", options_for_select(array("S&iacute;"=>"S&iacute;", "No"=>"No"), $repaduana->getCaTransnacarga() ));
				}else{
					echo "<br />".$repaduana->getCaTransnacarga();
				}
			}	
			?>										</td>
	</tr>
	<tr>
		<td class="listar"><strong>21.2 Tipo:</strong>						
			<?
			if($editable){	
				echo select_tag("transnatipo", objects_for_select( $transnatipo, "getCaValor", "getCaValor" , $repaduana->getCaTransnatipo() ));
			}else{
				echo "<br />".$repaduana->getCaTransnatipo();
			}	
			?></td>
	</tr>
</table>
			

