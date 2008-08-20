<?


?>
<table width="600">	
	<tr>
		<td class="listar" colspan="2"><strong>Valor de Carga (USD):</strong><br />
			<?
			if( $editable ){
				echo form_error("valorCarga");			
				echo input_tag("valorCarga", $repexpo->getCaValorcarga(), "size=12" );
			}else{
				echo Utils::formatNumber( $repexpo->getCaValorcarga() );
			}	
			
			?></td>
		<td width="131" class="listar"><strong>Peso:</strong> <br />			
		<?
			$pesoExp = explode("|",  $repexpo->getCaPeso() );
			if(!isset($pesoExp[1])){
				$pesoExp[1]="";
			}
			if( $editable ){
				echo form_error("peso");
				echo input_tag( "peso", $pesoExp[0], "size=8");
				echo select_tag("tipo_peso",  objects_for_select($tipo_pesos, "getCavalor","getCavalor", $pesoExp[1]));
			}else{
				echo Utils::formatNumber( $repexpo->getCaPeso() )." ".$pesoExp[1];
			}	
			?>		</td>
		<td width="115" class="listar"><strong>Volumen: </strong><br>
		<?
			$volumenExp = explode("|",  $repexpo->getCaVolumen() );
			if(!isset($volumenExp[1])){
				$volumenExp[1]="";
			}
			if( $editable ){
				echo form_error("volumen");
				echo input_tag( "volumen", $volumenExp[0], "size=8");
				echo select_tag("tipo_volumen",  objects_for_select($tipo_volumen, "getCavalor","getCavalor",$volumenExp[1]));
			}else{
				echo Utils::formatNumber( $repexpo->getCaVolumen() )." ".$volumenExp[1];
			}	
			?></td>
		<td width="151" class="listar"><strong>Piezas:</strong><br>
		<?
			$piezasExp = explode("|",  $repexpo->getCaPiezas() );
			if( $editable ){
				echo form_error("piezas");
				echo input_tag( "piezas",$piezasExp[0], "size=8");
				echo select_tag("tipo_piezas",  objects_for_select($tipo_piezas, "getCavalor","getCavalor", isset($piezasExp[1])?$piezasExp[1]:""));
			}else{
				echo Utils::formatNumber( $piezasExp[0] )." ".$piezasExp[1];
			}	
			?>			</td>
	</tr>
	<tr>
		<td class="listar" colspan="3"> <strong>Dimensiones:</strong>			<?
			$dimensiones = explode("|", $repexpo->getCaDimensiones() );
			if( !isset($dimensiones[1]) ){
				$dimensiones[1]='';
			}
			if( !isset($dimensiones[2]) ){
				$dimensiones[2]='';
			}
			?>		</td>
		<td colspan="2" rowspan="2" class="listar" valign="top"><strong>SIA:</strong><br />
			<?
			if( $editable ){
				echo select_tag("sia", objects_for_select($sias, "getId", "getCaNombre" , $repexpo->getCaIdsia()) );
			}else{
				echo $repexpo->getSia();
			}
			?></td>
	</tr>
	<tr>
		<td width="113" class="listar"><strong>Largo(mt.):</strong><br />			
		<?
			if( $editable ){
				echo form_error("dim_largo");
				echo input_tag( "dim_largo", $dimensiones[0], "size=12");
			}else{
				echo Utils::formatNumber( $dimensiones[0] );
			}
			?>		</td>
		<td width="66" class="listar"><strong>Ancho(mt.):</strong><br />
		<?
			if( $editable ){
				echo form_error("dim_ancho");
				echo input_tag( "dim_ancho", $dimensiones[1], "size=12");
			}else{
				echo Utils::formatNumber( $dimensiones[1] );
			}
			?>		</td>
		<td class="listar"><strong>Alto(mt.):</strong><br />
		<?
			if( $editable ){
				echo form_error("dim_alto");
				echo input_tag( "dim_alto", $dimensiones[2], "size=12");
			}else{
				echo Utils::formatNumber( $dimensiones[2] );
			}
			?>		</td>
	</tr>
	<tr>
		<td colspan="2" class="listar" ><strong>Lugar de emisi&oacute;n BL</strong><br />			
			<?
			if( $editable ){
				echo select_tag("emisionbl", options_for_select(array(""=>"","Origen"=>"Origen", "Destino"=>"Destino"), $repexpo->getCaEmisionbl()));
			}else{
				echo $repexpo->getCaEmisionbl();
			}				
			?></td>
		<td class="listar"><strong>Cuantos BL? </strong><br />
			<?
			if( $editable ){
				echo input_tag("numbl", $repexpo->getCaNumbl());
			}else{
				echo $repexpo->getCaNumbl();
			}
			?>
		</td>
		<td class="listar" colspan="2"><strong>Tipo de exportaci&oacute;n: </strong><br>
			<?
			if( $editable ){	
				echo select_tag("tipoexpo", objects_for_select($tiposexpo, "getCaIdentificacion","getCavalor", $repexpo->getCaTipoexpo()));
			}else{
				echo $repexpo->getTipoExpo();
			}
			?></td>
	</tr>
	<tr>
		<td colspan="2" class="listar" >
			<strong>Motonave/Vuelo</strong><br />
		<?
			if( $editable ){
				echo input_tag("motonave", $repexpo->getCaMotonave(), "size=30" );
			}else{
				echo $repexpo->getCaMotonave();
			}
				
			?>		</td>
		<td class="listar"><strong>Solicitud anticipo</strong><br />
			<?
			if( $editable ){
				echo radiobutton_tag("anticipo" , "Si" , $repexpo->getCaAnticipo()?$repexpo->getCaAnticipo()=="S&iacute;":true );
			?>
S&iacute;&nbsp;&nbsp;&nbsp;&nbsp;
<?=radiobutton_tag("anticipo" , "No" , $repexpo->getCaAnticipo()=="No" )?>
No
<?	
			}else{
				echo $repexpo->getCaAnticipo();
			}	
			?></td>
		<td class="listar" colspan="2">&nbsp;</td>
	</tr>
</table>
