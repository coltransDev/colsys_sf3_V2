<?
use_helper("Object");
use_helper('Validation');
// use_helper('Modalbox');
// use_helper('Javascript');
use_helper('YUICalendar');


?>
<script language="JavaScript" type="text/javascript">
	function handleSelectContacto (record, index){ 		
		document.getElementById("con_cliente").value=record.data.nombre+" "+record.data.papellido+" "+record.data.sapellido;
		document.getElementById("idconcliente").value=record.data.id;
		document.getElementById("login").value=record.data.vendedor;				
	}
</script>
<?php echo form_error('name') ?>
<h3>Sistema de Cotizaciones</h3>
<?
	echo form_tag("cotizaciones/formCotizacionGuardar", "name=cotizacionForm id=cotizacionForm");
?>
<table class="tableForm" cellspacing="1" id="mainTable">
	<tbody>
	<tr>
		<th colspan=2>Nuevos Datos para la Cotizaci&oacute;n</th>
	</tr>
	<tr>
		<td class="captura" >Datos de Control:</td>
		<td class="invertir" >
			<table class="tableForm" width="100%" cellspacing="1">		
				<tr>
					<td class="listar">Fecha de solicitud :<br />
					<center><span class="captura">
						<?=yui_calendar("fchSolicitud", date("Y-m-d"), array("size"=>"12","style"=>"vertical-align:bottom"), "2008-01-01" )?>
					</span></center></td>
					<td class="listar" >Hora de solicitud formato 24h:<br />
						<center>hh:mm:ss
						<input type='text' name='horaSolicitud' value='' onblur='CheckTime(this)' size=9 maxlength=8> 00-23hrs<?=form_error("horaSolicitud")?>
						</center>
					</td>
					<td class="listar" >Fecha de cotización :<br />
					<center><span class="captura" style="vertical-align:bottom">
						<input type='text' name='fchCotizacion' size=12 value='<?=(strlen($cotizacion->getCaFchCotizacion())==0)?date("Y-m-d"):$cotizacion->getCaFchCotizacion();?>' readonly>
					</span></center></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>  
  		<td class="titulo" style="text-align:left; vertical-align:top;">cliente:<br></td>
  		<td class="invertir" >
			<table class="tableForm" width="100%" >  				
  				<tr>
  					<td class="mostrar" colspan="2">Nombre:<br><?=include_component("clientes", "comboContactosClientes", array("idconcliente"=>$cotizacion->getCaIdContacto() ) )?></td>    
				</tr> 
			</table>
		</td>
	</tr>
	<tr>
		<td class="captura">Asunto:</td>
		<td class="mostrar"><input type='text' name='asunto' value="Cotizacion" size=60 maxlength=255></td>
	</tr>
	<tr>
		<td class="captura">Saludo:</td>
		<td class="mostrar"><input type='text' name='saludo' value="Respetados Señores:" size=82 maxlength=255></td>
	</tr>
	<tr>
		<td class="captura" style='vertical-align:top;'>Entrada:</td>
		<td class="mostrar"><textarea name='entrada' rows=5 cols=80>Nos  complace  saludarlos,  nos permitimos presentar oferta para el transporte internacional de mercancía no peligrosa ni extradimensionada así :</textarea></td>
	</tr>
	<tr>  
		<td class="captura" style='vertical-align:top;'>Despedida:</td> 
		<td class="mostrar"><textarea name='despedida' rows=5 cols=80>Esperamos que esta cotización sea de su conveniencia y quedamos a su entera disposición para atender cualquier inquietud adicional.</textarea></td>
	</tr>
	<tr>
		<td class="captura">Anexos:</td>
		<td class="mostrar"><input type='text' name='anexos' value="Notas importantes para sus importaciones y/o exportaciones." size=82 maxlength=255></td>
	</tr>
	<tr>
		<td class="captura">Rep. Comercial:</td>
  		<td class="invertir" >
			<table class="tableForm" width="100%" >
  				<tr>
					<td class="mostrar">
					<?
						$cliente = $cotizacion->getCliente();
						
						if( $cliente ){
							$vendedor = $cliente->getCaVendedor();
						}else{
							$vendedor = "";
						}	
						
						if( $user->getNivelAcceso()>0  ){
							echo select_tag("login", objects_for_select($comerciales, "getCaLogin", "getCaNombre", $cotizacion->getCaUsuario()?$cotizacion->getCaUsuario():$vendedor ) );
						}else{	
							echo $cotizacion->getCaUsuario()?$cotizacion->getCaUsuario():$vendedor;
							echo input_hidden_tag("login", $cotizacion->getCaUsuario()?$cotizacion->getCaUsuario():$vendedor  );	
						}
					?>
					</td>
					<td class="invertir">Elabora:</td>
					<td class="invertir"><strong>
						<?=$user->getUserid()?></strong>
					</td>
  				</tr>
			</table>
		</td>
	</tr>
	</tbody>
</table>
<br>
<table cellspacing="10">
	<tbody>
		<tr>
			<th><?=submit_tag("Guardar")?></th>
			<th><?=button_to("Cancelar", "cotizaciones/index")?></th>
		</tr>
	</tbody>
</table>
<?="</form>";?>