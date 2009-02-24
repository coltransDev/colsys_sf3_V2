<div style="margin:30px;">
<table width="100%" border="1" class="tableList">
	<tr>
		<th ><?=$kbase->getCaTitle()?></th>
	</tr>
	<tr>
		<td class="listar"><b>Reportado por:</b> <?=$kbase->getCaLogin()?></td>
	</tr>
	<tr>
		<td class="listar"><b>Creado:</b> <?=$kbase->getCaCreatedat("Y-m-d")?></td>
	</tr>
	<tr>
		<td class="listar"><b>Descripci&oacute;n:</b> </td>
	</tr>
	<tr>
		<td class="listar">
			<div class="boxText">
	
			<?=$kbase->getCaText()?>
			</div>
		</td>
	</tr>
</table>
</div>