<?

$monedas = MonedaPeer::doSelect(new Criteria());
$repseguro = $reporteNegocio->getRepSeguro();

				/*
				$tm->MoveFirst();
				 $esegu_sel = explode(',',$rs->Value('ca_seguro_conf'));
				 for($i=0; $i<round($tm->GetRowCount()-(round($tm->GetRowCount()%3))/3)/3; $i++){
					 echo "<TR>";
					 for($j=0; $j<3; $j++){
						 $esegu_mem = (!$tm->Eof() and !$tm->IsEmpty() and strlen($tm->Value('ca_email'))!=0)?$tm->Value('ca_email'):'';
						 $check_mem = (in_array($tm->Value('ca_email'),$esegu_sel))?'CHECKED':'';
						 if (strlen($esegu_mem)!=0){
							echo "<TD Class=invertir style='vertical-align:bottom;'><INPUT ID=esegu_$z TYPE='CHECKBOX' NAME='esegu[]' VALUE='$esegu_mem' WIDTH=10 $check_mem>$esegu_mem</TD>";
						 }else{
							echo "<TD Class=invertir style='vertical-align:bottom;'></TD>";
						 }
						 $tm->MoveNext();
					 }
					 echo "</TR>";
				 }*/

?>
<table width="100%" cellspacing="0" cellpadding="0">
	<!--<tr>
		<td colspan="4">20.2 Notificar Seguro:<br />
				<table cellspacing="1" width="100%" border="1">
					<tbody>
						<tr>
							<td><input id="esegu_" type="checkbox" value="seguros@coltrans.com.co" name="esegu[]" width="10" />
								seguros@coltrans.com.co</td>
							<td><input id="esegu_" type="checkbox" checked="checked" value="amquintero@coltrans.com.co" name="esegu[]" width="10" />
								amquintero@coltrans.com.co</td>
							<td><input id="esegu_" type="checkbox" value="medellin-sales@coltrans.com.co" name="esegu[]" width="10" />
								medellin-sales@coltrans.com.co</td>
						</tr>
						<tr>
							<td><input id="esegu_" type="checkbox" value="dcastano@coltrans.com.co" name="esegu[]" width="10" />
								dcastano@coltrans.com.co</td>
							<td><input id="esegu_" type="checkbox" value="lmbuitrago@coltrans.com.co" name="esegu[]" width="10" />
								lmbuitrago@coltrans.com.co</td>
							<td><input id="esegu_" type="checkbox" value="nguisao@coltrans.com.co" name="esegu[]" width="10" />
								nguisao@coltrans.com.co</td>
						</tr>
					</tbody>
				</table></td>
	</tr>-->
	<tr>
		<td class="listar"><strong>19.1 Valor Asegurado:</strong><br />
				<?
				if( $editable ){
					echo form_error("vlrasegurado");
					echo input_tag("vlrasegurado", $repseguro->getCaVlrAsegurado(), 'size="15" maxlength="15" ' );
					echo "&nbsp;";	
					echo select_tag("idmoneda_vlr", objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", $repseguro->getCaIdmonedaVlr()?$repseguro->getCaIdmonedaVlr():"USD") );
				}else{
					echo $repseguro->getCaVlrAsegurado()." ".$repseguro->getCaIdmonedaVlr();
				}
				
				
				?>				
				</td>
		<td class="listar"><strong> 19.2 Obtenci&oacute;n P&oacute;liza:</strong><br />
			<?
				if( $editable ){
					echo form_error("obtencionpoliza");
					echo input_tag("obtencionpoliza", $repseguro->getCaObtencionpoliza(), 'size="15" maxlength="15" ' );
					echo "&nbsp;";	
					echo select_tag("idmoneda_pol", objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", $repseguro->getCaIdmonedaPol()?$repseguro->getCaIdmonedaPol():"USD") );
				}else{
					echo $repseguro->getCaObtencionpoliza()." ".$repseguro->getCaIdmonedaPol();
				}
				?></td>
		<td class="listar"><strong>19.3 Prima Venta:</strong>
			<?
			if( $editable ){
				echo form_error("primaventa");
				echo input_tag("primaventa", $repseguro->getCaPrimaventa(), 'maxlength="4" size="4"')?>
				%<br />
				Min.
				<?
				echo form_error("minimaventa");
				echo input_tag("minimaventa", $repseguro->getCaMinimaventa(), 'maxlength="4" size="4"')."&nbsp;";
				echo select_tag("idmoneda_vta", objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", $repseguro->getCaIdmonedaVta()?$repseguro->getCaIdmonedaVta():"USD") );
			}else{
				echo  $repseguro->getCaPrimaventa();
				?>
				%<br />
				Min.
				<?
				echo $repseguro->getCaMinimaventa()."&nbsp;";
				echo $repseguro->getCaIdmonedaVta();
			}			
		?>		</td>
	</tr>
</table>
