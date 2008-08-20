
				<div style="display:none"><?=input_tag( "idcliente",  isset($cliente)?$cliente->getCaIdCliente():"", "size=11 readonly=readonly " )?></div>
				<?php echo form_error('idcliente') ?>
				<?=input_tag( "cliente",  isset($cliente)?$cliente->getCaCompania():"", "size=50 autocomplete=off" )?>						