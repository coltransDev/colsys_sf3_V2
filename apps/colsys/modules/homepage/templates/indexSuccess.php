


<div align="center" class="content">
		
	<div id="manual-top">
		<?=image_tag("layout/homepage/corner-manual-topright.jpg", "id=corner-manual-topright")?>
		<?=image_tag("layout/homepage/corner-manual-topleft.jpg", "id=corner-manual-topleft")?>
	</div>	
	<div id="manual-wrap">	
		<div id="manual">
			<ul id="manual-nav">
				
				
				<li class="group" id="li_intro"> 
					<a class="group-title" onclick="mostrarGrupo('intro')">Introducci&oacute;n</a>				
				</li>			
				<!--<li class="group" id="li_aplicaciones"> 
					<a class="group-title" onclick="mostrarGrupo('aplicaciones')">Aplicaciones Disponibles</a>				
				</li>-->
				<li class="group" id="li_tareas"> 
					<a class="group-title" onclick="mostrarGrupo('tareas')">Tareas pendientes</a>				
				</li>
				<li class="group" id="li_directorio"> 
					<a class="group-title" onclick="mostrarGrupo('directorio')">Directorio</a>				
				</li>
			
			</ul>
			<div id="content-homepage-top">
				<?=image_tag("layout/homepage/corner-content-topright.jpg", "id=corner-content-topright")?>
				<?=image_tag("layout/homepage/corner-content-topleft.jpg", "id=corner-content-topleft")?>
			</div>
			<div id="content-wrap">			
				<div id="content-homepage">											
				</div>			
			</div>
			<div id="content-homepage-bottom">
				<?=image_tag("layout/homepage/corner-content-bottomright.jpg", "id=corner-content-bottomright")?>
				<?=image_tag("layout/homepage/corner-content-bottomleft.jpg", "id=corner-content-bottomleft")?>
			</div>
			<div class="clear-fix"></div>
		</div>
	</div>
	<div id="manual-bottom">
		<?=image_tag("layout/homepage/corner-manual-bottomright.jpg", "id=corner-manual-bottomright")?>
		<?=image_tag("layout/homepage/corner-manual-bottomleft.jpg", "id=corner-manual-bottomleft")?>
	</div>

</div>


<!-- Contenidos para las secciones -->

<!-- Introduccion -->

<div id="intro" style="display:none">
	<?=include_partial("homepage/intro")?>
	<?
	if( $numtareas>0 ){
	?>
	<a href="#" onclick="mostrarGrupo('tareas')">
		<br /><br /><b><?=image_tag("22x22/todo.gif")?> Usted tiene <?=$numtareas?> <?=($numtareas==1?"tarea pendiente":"tareas pendientes")?></b>
	</a>
	<?
		
	}
	?>
	
	<div id="novedades" >
		<?
        //include_component("homepage","novedades");
        ?>
	</div>
	
</div>

<div id="aplicaciones" style="display:none">
	<h1>Aplicaciones</h1>
</div>

<div id="tareas" style="display:none">
	<h1>Tareas</h1>
	
	<?
    //include_component("notificaciones","tareasPendientes");
    ?>
</div>

<div id="directorio" style="display:none">
	<?=include_partial("homepage/directorio")?>
</div>




<script language="javascript" type="text/javascript">
	function mostrarGrupo( idgrupo ){
		//alert(idgrupo);
		var childs = document.getElementById("manual-nav" ).getElementsByTagName("li");
		
		for( var i = 0; i < childs.length; i++ )
		{		 
			childs[i].className = "group";
		}
		
		
		document.getElementById("li_"+idgrupo ).className = "group group-active";	
		document.getElementById("content-homepage" ).innerHTML = document.getElementById( idgrupo ).innerHTML;

        if( idgrupo=="tareas" ){           
            Ext.Ajax.request(
			{
				url: '<?=url_for("homepage/getTareas" )?>',

                success: function(xhr) {                    
                    document.getElementById("content-homepage" ).innerHTML = xhr.responseText;
                },
                failure: function() {
                    Ext.Msg.alert("Error", "Server communication failure");
                }
				
			 }
            );
        }

		
	}
	
	
	mostrarGrupo("intro");
	//mostrarGrupo("tareas");
</script>
