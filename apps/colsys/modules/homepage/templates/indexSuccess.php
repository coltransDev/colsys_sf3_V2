


<div align="center" class="content">
		
	<div id="manual-top"></div>
	<div id="manual">
		<ul id="manual-nav">
			
			
			<li class="group" id="li_intro"> 
				<a class="group-title" onclick="mostrarGrupo('intro')">Introducci&oacute;n</a>				
			</li>			
			<li class="group" id="li_aplicaciones"> 
				<a class="group-title" onclick="mostrarGrupo('aplicaciones')">Aplicaciones Disponibles</a>				
			</li>
			<li class="group" id="li_tareas"> 
				<a class="group-title" onclick="mostrarGrupo('tareas')">Tareas pendientes</a>				
			</li>
			<li class="group" id="li_directorio"> 
				<a class="group-title" onclick="mostrarGrupo('directorio')">Directorio</a>				
			</li>
			<li class="group" id="li_novedades"> 
				<a class="group-title" onclick="mostrarGrupo('novedades')">Novedades</a>				
			</li>
		</ul>
		<div id="content-homepage-top"></div>
		<div id="content-wrap">			
			<div id="content-homepage">											
			</div>			
		</div>
		<div id="content-homepage-bottom"></div>
		<div class="clear-fix"></div>
	</div>
	<div id="manual-bottom"></div>

</div>


<!-- Contenidos para las secciones -->

<!-- Introduccion -->

<div id="intro" style="display:none">
	<div align="center"><?=image_tag("layout/homepage/logo_colsys.gif");?></div>
</div>

<div id="aplicaciones" style="display:none">
	<h1>Aplicaciones</h1>
</div>

<div id="tareas" style="display:none">
	<h1>Tareas</h1>
</div>

<div id="directorio" style="display:none">
	<?=include_partial("homepage/directorio")?>
</div>

<div id="novedades" style="display:none">
	<?=include_component("homepage","novedades")?>
</div>


<script language="javascript" type="text/javascript">
	function mostrarGrupo( idgrupo ){
		//alert(idgrupo);
		var childs = document.getElementById("manual-nav" ).getElementsByTagName("li");
		
		for( var i = 0; i < childs.length; i++ )
		{		 
			childs[i].setAttribute("class","group");
		}
		
		document.getElementById("li_"+idgrupo ).setAttribute("class","group group-active");		
		document.getElementById("content-homepage" ).innerHTML = document.getElementById( idgrupo ).innerHTML;		
		
	}
	
	
	mostrarGrupo("intro");
</script>
