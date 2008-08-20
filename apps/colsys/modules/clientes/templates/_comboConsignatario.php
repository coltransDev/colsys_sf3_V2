<div style="display:none">
						<?=input_tag( "idconsignatario", isset($tercero)?$tercero->getCaIdtercero():"" , "size=60 readonly=readOnly autocomplete=off" )?>
						</div>
						<?php echo form_error('idconsignatario') ?>
						<?=input_tag( "nombre_con", isset($tercero)?$tercero->getCaNombre():"" , "size=60 " )?>