<?


?>
<table width="100%">	
	<tr>
		<td width="213" class="listar">
			<b>Piezas:</b><br>
			<?
			$piezasExp = explode("|",  $repexpo->getCaPiezas() );
			if( $editable ){
				echo form_error("piezas");
				echo input_tag( "piezas",$piezasExp[0], "size=8");
				echo select_tag("tipo_piezas",  objects_for_select($tipo_piezas, "getCavalor","getCavalor", isset($piezasExp[1])?$piezasExp[1]:""));
			}else{
				echo Utils::formatNumber( $piezasExp[0] )." ".$piezasExp[1];
			}	
			?>		
		</td>
		<td width="201" class="listar"><b>Peso:</b> <br />			
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
		<td width="283" class="listar"><b>Volumen: </b><br>
		<?
			$volumenExp = explode("|",  $repexpo->getCaVolumen() );
			if(!isset($volumenExp[1])){
				$volumenExp[1]="";
			}
			if( $editable ){
				echo form_error("volumen");
				echo input_tag( "volumen", $volumenExp[0], "size=8");
				?>
				<div id="tipo_volumen_maritimo">
				<?
				echo select_tag("tipo_volumen_maritimo",  objects_for_select($tipo_volumen_maritimo, "getCavalor","getCavalor",$volumenExp[1]));
				?>
				</div>				
				<div id="tipo_volumen_aereo">
				<?
				echo select_tag("tipo_volumen_aereo",  objects_for_select($tipo_volumen_aereo, "getCavalor","getCavalor",$volumenExp[1]));
				?>
				</div>
		<?
			}else{
				echo Utils::formatNumber( $repexpo->getCaVolumen() )." ".$volumenExp[1];
			}	
			?></td>
		<td width="167" class="listar">
			
			<b>Dimensiones:</b> (cant;largoxanchoxalto en metros) <br />	
			<?
			if( $editable ){
				echo form_error("dimensiones");
				echo textarea_tag( "dimensiones", $repexpo->getCaDimensiones(), "size=22x3");
			}else{
				echo nl2br($repexpo->getCaDimensiones());
			}
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="listar"> 
			<b>Valor de Carga (USD):</b><br />
			<?
			if( $editable ){
				echo form_error("valorCarga");			
				echo input_tag("valorCarga", $repexpo->getCaValorcarga(), "size=12" );
			}else{
				echo Utils::formatNumber( $repexpo->getCaValorcarga() );
			}	
			
			?>
		
		</td>
		<td colspan="2" class="listar" valign="top"><b>SIA:</b><br />
			<?
			if( $editable ){
				echo select_tag("sia", objects_for_select($sias, "getId", "getCaNombre" , $repexpo->getCaIdsia()) );
			}else{
				echo $repexpo->getSia();
			}
			?></td>
	</tr>
	
	<tr>
		<td class="listar" >
			<div id="emisionbl">
			<b>Lugar de emisi&oacute;n BL</b><br />			
			<?
			if( $editable ){
				echo select_tag("emisionbl", options_for_select(array(""=>"","Origen"=>"Origen", "Destino"=>"Destino"), $repexpo->getCaEmisionbl()));
			}else{
				echo $repexpo->getCaEmisionbl();
			}				
			?>
			</div>			</td>
		<td class="listar">
			<div id="cuantosbl">
			<b>Cuantos BL? </b><br />			
			<?
			if( $editable ){
				echo input_tag("numbl", $repexpo->getCaNumbl());
			}else{
				echo $repexpo->getCaNumbl();
			}
			?>
			</div>		</td>
		<td class="listar" colspan="2"><b>Tipo de exportaci&oacute;n: </b><br>
			<?
			if( $editable ){	
				echo select_tag("tipoexpo", objects_for_select($tiposexpo, "getCaIdentificacion","getCavalor", $repexpo->getCaTipoexpo()));
			}else{
				echo $repexpo->getTipoExpo();
			}
			?></td>
	</tr>
	<tr>
		<td class="listar" >
			<b>Motonave/Vuelo</b><br />
		<?
			if( $editable ){
				echo input_tag("motonave", $repexpo->getCaMotonave(), "size=30" );
			}else{
				echo $repexpo->getCaMotonave();
			}
				
			?>		</td>
		<td class="listar"><b>Solicitud anticipo</b><br />
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
