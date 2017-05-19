
<div class="topmenu" >
	
<?
if( $showMenu ){	
?>
	<ul id="nav1" >
		<li><?=link_to("Inicio", "homepage/index2", "class=mainlevel-nav")?></li>
        <li>
            <a href="#" class="mainlevel-nav">Importaciones<?//=link_to("Importaciones", "#", "class=mainlevel-nav")?></a>
            <ul>
                <li><?=link_to("Mar&iacute;timo", "maritimo/index", "class=mainlevel-nav")?></li>
                <li><?=link_to("A&eacute;reo", "aereo/index", "class=mainlevel-nav")?></li>
            </ul>
        </li>
        <li>
            <?=link_to("Exportaciones", "exportaciones/index", "class=mainlevel-nav")?>
            <ul>
                <li><a href="<?=url_for("exportaciones/index?transporte=maritimo")?>">Mar&iacute;timo</a></li>
                <li><a href="<?=url_for("exportaciones/index?transporte=aereo")?>">A&eacute;reo</a></li>
                <li><a href="<?=url_for("exportaciones/index?transporte=terrestre")?>">Terrestre</a></li>
            </ul>
        </li>
		
		<!--<li><?=link_to("Exportaciones", "exportaciones/index", "class=mainlevel-nav")?></li>-->
		<li><?=link_to("Buscar", "buscar/index", "class=mainlevel-nav")?></li>
		<li><?=link_to("Cuenta", "cuenta/index", "class=mainlevel-nav")?></li>
		<li><?=link_to("Salir", "login/signout", "class=mainlevel-nav")?></li>
	</ul>	
		
	<div id="nombreClienteTopmenu"><a href="<?=url_for("homepage/index")?>"><?=$nombre?></a></div>
<?
}
?>
</div>
