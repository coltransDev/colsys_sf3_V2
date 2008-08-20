<div style="display:none">
						<?=input_tag( "idnotify", isset($tercero)?$tercero->getCaIdtercero():"" , "size=60 readonly=readOnly" )?>
						</div>
						<?php echo form_error('idnotify') ?>
						<?=input_tag( "nombre_not", isset($tercero)?$tercero->getCaNombre():"" , "size=60 autocomplete=off" )?>