<?
$i=0;
foreach( $clientes as $cliente ){	
?>
<table class="table1" width="100%">
<tr class="row1">	
	<td align="left">
	<?=radiobutton_tag("cliente", $cliente->getCaIdcliente(), $i==0)." ".$cliente."<br />"?>			</td>
</tr>
</table>
<?
	$i++;
}
?>
