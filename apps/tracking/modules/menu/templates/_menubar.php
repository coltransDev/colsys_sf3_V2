
<div class="topmenu" >
	
<?
if( $showMenu ){	
?>
	<ul id="mainlevel-nav" >
		<li><?=link_to("Inicio", "homepage/index2", "class=mainlevel-nav")?></li>
		<li><?=link_to("Mar&iacute;timo", "maritimo/index", "class=mainlevel-nav")?></li>
		<li><?=link_to("A&eacute;reo", "aereo/index", "class=mainlevel-nav")?></li>
		<li><?=link_to("Aduana", "aduana/index", "class=mainlevel-nav")?></li>
		<li><?=link_to("Buscar", "buscar/index", "class=mainlevel-nav")?></li>
		<li><?=link_to("Cuenta", "cuenta/index", "class=mainlevel-nav")?></li>
		<li><?=link_to("Salir", "login/signout", "class=mainlevel-nav")?></li>
	</ul>	
		
	<div id="nombreClienteTopmenu"><a href="<?=url_for("homepage/index")?>"><?=$nombre?></a></div>
<?
}
?>
</div>
