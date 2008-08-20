<div id="menubar">
	<?
	if( $showMenu ){
	?>
	<table width="100%" border="0">
		<tr height="25px">
			<td width="7%" class="menuRight"><?=link_to("Home", "homepage/index2")?></td>
			<td width="7%" class="menuRight"><?=link_to("Mar&iacute;timo", "maritimo/index")?></td>
			<td width="7%" class="menuRight"><?=link_to("A&eacute;reo", "aereo/index")?></td>
			<td width="7%" class="menuRight"><?=link_to("Aduana", "aduana/index")?></td>
			<td width="7%" class="menuRight"><?=link_to("Buscar", "buscar/index")?></td>	
			<td width="52%" class="menuRight">
			<div id="indicator"><?=image_tag("ajax-loader-snake.gif")?></div>			
			<strong><?=$nombre?></strong>
			
			</td>
			<!--			
			<td width="6%" class="menuRight">Ayuda</td>
				-->	
			<td width="7%" class="menuRight"><?=link_to("Cuenta", "cuenta/index")?></td>
		
			<td width="6%" class="menuRight"><?=link_to("Salir", "login/signout")?></td>
		</tr>
	</table>
	<?
	}
	?>
</div>
<div id="menubar_btm">
	&nbsp;
</div>
<br />




