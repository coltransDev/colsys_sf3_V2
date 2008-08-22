<?
use_helper("Javascript", "Object", "Validation");
?>


<h3>Sistema de Cotizaciones</h3>
<table class="tableForm" width="700px" border="1" id="mainTable">
	<tr>
		<th class="titulo" colspan="3">Datos de la Cotización</th>
	</tr>
	<tr>
	  <td class="captura">Datos de Control:</td>
	  <td class="invertir">
		<table cellspacing="1" width="100%">
			<tr>
				<td class="listar">Fecha de Cotización :<br /><center><?=$cotizacion->getCaFchcotizacion()?></center></td>
				<td class="listar">Fecha de Solicitud :<br /><center><?=$cotizacion->getCaFchsolicitud()?></center></td>
				<td class="listar">Hora de Solicitud :<br /><center><?=$cotizacion->getCaHorasolicitud()?></center></td>
				<td class="listar">No. de Cotización :<br /><center><?=$cotizacion->getCaIdcotizacion()?></center></td>
			</tr>
		</table>
	  </td>
	  <td class="mostrar" rowspan="5">
	  </td>
	</tr>
	<?
		$concliente = $cotizacion->getContacto();
		$cliente = $concliente;
		if( $concliente ) {
			$cliente = $concliente->getCliente();
	?>
	<tr>
	  <td class="titulo" style="text-align:left; vertical-align:top;">Cliente:<br></td>
	  <td class="invertir">
		<table width="100%" cellspacing="1" width="425">
		  <tr>
		    <td class="mostrar"><b>Nombre:</b><br><?=$cliente->getCaCompania()?></td>
		    <td class="mostrar"><b>Nit:</b><br><?=$cliente->getCaIdCliente()?></td>
		  </tr>
		  <tr>
		    <td class="mostrar"><b>Contacto:</b><br><?=$concliente->getCaNombres()?></td>
		    <td class="mostrar"><b>Teléfono:</b><br><?=$concliente->getCaTelefonos()?></td>
		  </tr>
		  <tr>
		    <td class="mostrar"><b>Dirección:</b><br><?=$cliente->getCaDireccion()?></td>
		    <td class="mostrar"><b>Fax:</b><br><?=$concliente->getCaFax()?></td>
		  </tr>
		  <tr>
		    <td class="mostrar" colspan="2"><b>Correo Electr&oacute;nico:</b><br><?=$concliente->getCaEmail()?></td>
		  </tr>
		</table>
	  </td>
	</tr>
	<?
		} 
	?>
	<tr>
	  <td class=captura>Asunto:</td>
	  <td class=mostrar><?=$cotizacion->getCaAsunto()?></td>
	</tr>
	<tr>
	  <td class=captura>Saludo:</td>
	  <td class=mostrar><?=$cotizacion->getCaSaludo()?></td>
	</tr>
	<tr>
	  <td class=captura style='vertical-align:top;'>Entrada:</td>
	  <td class=mostrar><?=$cotizacion->getCaEntrada()?></td>
	</tr>
	<tr>
		<td class="invertir" colspan="2" ><div align="center"><strong>PRODUCTOS A TRANSPORTAR</strong></div></td>
		<td class="invertir"><div align="right">
			<?=$option!="productos"?link_to(image_tag("22x22/edit.gif"), "cotizaciones/consultaCotizacion?id=".$cotizacion->getCaIdcotizacion()."&editable=1&option=productos&token=".md5(time()) ):"&nbsp;"?>
		</div></td>
	</tr>
	<tr>
		<td class="invertir" colspan="7">
			<?
			if( $option=="productos" ){
				echo form_remote_tag(array("url"=>"cotizaciones/guardarProducto?cotizacionId=".$cotizacion->getCaIdcotizacion()."&editable=".TRUE."&token=".md5(time()), 
				"update"=>"producto" ,
				"script"=>true,
				"loading"  => "Element.show('indicator')",
				"complete" => "Element.hide('indicator')",
				), "name=formProductos id=formProductos");
			}
			?>
			<div align="center" id="producto">
			<?
			include_component("cotizaciones","relacionDeProductos", array( "cotizacion"=>$cotizacion, "editable"=>false, $option=="productos" ));
			?>
			</div>
			<?
			if( $option=="productos" ){
				echo "</form>";
			}
			?>			
		</td>
	</tr>

</table>