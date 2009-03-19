<div align="center">

<table width="539" border="1" class="tableList">
	<tr>
		<th width="529"  >&nbsp;</th>
	</tr>
	<tr>
		
		<td class="mostrar"><div style="padding:25px" align="center"><?=image_tag("logo_colsys_big.gif"); ?></div>		</td>
	</tr>
	<tr>
		<th width="529"><div align="center"><b>Novedades del sistema Colsys</b></div></th>
	</tr>
	<tr>
		<td >
		<?
		foreach( $novedades as $novedad ){
		?>			
			<br /><br />
			<?=image_tag("16x16/post.gif")?><b><?=$novedad->getCaFchpublicacion("Y-m-d")?> <?=$novedad->getCaAsunto()?></b>
			<br />
			<hr />
			<div class="story">
			<?=nl2br($novedad->getCaDetalle())?>
			</div>
		<?	
		}
		?>
		</td>
	</tr>	
</table>
</div>