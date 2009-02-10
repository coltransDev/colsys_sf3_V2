
<div style="display:none"><?=input_tag( "idcliente",  isset($cliente)?$cliente->getCaIdCliente():"", "size=11 readonly=readonly " )?></div>				
<?=input_tag( "cliente",  isset($cliente)?$cliente->getCaCompania():"", "size=50 autocomplete=off" )?>						