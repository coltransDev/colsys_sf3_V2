<?
use_helper("Javascript");	

if( count($referencias) ){
?>
<table width="90%" border="1" class="table1">
	<tr>
		<th width="84"><strong>Referencia</strong>: </th>
		<th width="153" align="center" valign="top">Origen</th>
	    <th width="163" align="center" valign="top">Destino</th>
	    <th width="163" align="center" valign="top">Proveedor</th>
	    <th width="194" align="center" valign="top">Pedido</th>
	    <th width="194" align="center" valign="top">Mercancia</th>
    </tr>
	<?
	foreach( $referencias as $referencia ){
	?>
	<tr>
		<td width="84" align="center" valign="top">
		<?=$referencia->getCaReferencia()?>		</td>
	    <td width="153" align="center" valign="top"><div align="left">
	      <?=$referencia->getOrigen()?>
        </div></td>
	    <td width="163" align="center" valign="top"><div align="left">
	      <?=$referencia->getDestino()?>
        </div></td>
	    <td width="163" align="center" valign="top"><div align="left">
	      <?=$referencia->getCaProveedor()?>
        </div></td>
	    <td width="194" align="center" valign="top"><div align="left">
	      <?=$referencia->getCaPedido()?>
	    </div></td>
	    <td width="194" align="center" valign="top"><div align="left">
	      <?=$referencia->getCaMercancia()?>
	    </div></td>
    </tr>
	<?
	}
	?>
</table>
<?
}else{
?>
	<br />
	<br />

	<h3>Usted no ha contratado los servicios de aduana con Colmas SAS.</h3>
	
	
	
	
<?
}
?>