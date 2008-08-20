<script language="javascript" type="text/javascript">

</script>
<table width="677" cellpadding="0" cellspacing="0">
	<tr>
		<td width="188">
	
				3.1 Nombre:<br />
				<div style="display:none"><?=input_tag( "idconcliente",  isset($contacto)?$contacto->getCaIdcontacto():"", "size=11 readonly=readonly" )?></div>
				<?php echo form_error('idconcliente') ?>
				<?=input_tag( "cliente",  isset($contacto)?$contacto->getCliente():"", "size=50 " )?>						</td>
		<td width="186">3.2 Contacto:<br />
			<?=input_tag( "con_cliente", isset($contacto)?$contacto->getNombre():"", "size=50 readonly=readonly autocomplete=off" )?></td>					
	</tr>
	
</table>