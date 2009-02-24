<div style="margin:30px;">
<?
foreach( $categorias as $categoria ){
	$c = new Criteria();
	$c->add( HdeskKBasePeer::CA_PRIVATE, false );
	$kbases = $categoria->getHdeskKBases( $c );
	if( count($kbases)>0 ){
?>
	<table width="100%" border="1" class="tableList">
	<tr>
		<th colspan="2" ><b><?=$categoria->getCaName()?></b></th>
	</tr>
	<tr>
		<th width="80%">Titulo</th>
		<th width="20%">Creado</th>	
	</tr>
	<?
	foreach( $kbases as $kbase ){
	?>
	<tr>
		<td width="80%"><?=link_to($kbase->getCaTitle(),"kbase/verContenido?id=".$kbase->getCaIdkbase())?></td>
		<td width="20%"><?=$kbase->getCaCreatedAt("Y-m-d")?></td>	
	</tr>
	<?
	}
	?>
	</table>
	<br />
<?
	}
}
?>
</div>