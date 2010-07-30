
<div >
    <div id="touch" class="product">

        <h3 id="producttitle">
            <a href="#"><?=image_tag("logo_colsys_small.gif");?></a>
            
        </h3>


        <div class="productnav" id="manual-nav">
            <ul>
                <li id="li_intro"><a id="a_intro" href="#" onclick="mostrarGrupo('intro')">Introducci&oacute;n</a></li>

                <li id="li_tareas"><a id="a_tareas" href="#" onclick="mostrarGrupo('tareas')">Tareas pendientes</a></li>
               
                <li id="li_directorio"><a id="a_directorio" href="#" onclick="mostrarGrupo('directorio')">Directorio</a></li>
                <!--<li id="li_programas"><a id="a_programas" href="#" onclick="mostrarGrupo('programas')">Programas</a></li>-->
                <li id="li_blog"><a id="a_blog" href="#" onclick="mostrarGrupo('blog')">Blog</a></li>
            </ul>
        </div>

        <div id="content-homepage" class="testimonials">
            
        </div>

    </div>
</div>




<div id="intro" style="display:none" >



            <div id="widgetbox" class="section">
                
                                
                <blockquote>
                    <p>Las politicas, normas y procedimientos sobre el manejo de la información establecen que el responsable de la información es la persona que la genera y la usa, y es responsabilidad de quien produce la información clasificarla de acuerdo con su valor, teniendo en cuenta su confidencialidad, integridad y disponibilidad.


        Para mas información consulte el documento POLITICAS GENERALES SOBRE MANEJO DE LA INFORMACION EN COLTRANS S.A. y AGENCIA DE ADUANAS COLMAS LTDA. en ISO Q.C.S.</p>

                    <cite>  </cite>
                </blockquote>
            </div>
        
    


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

<div id="programas" style="display:none">
	<h1>Programas</h1>
    <? //include_component("homepage","programas")?>
	
</div>

<div id="blog" style="display:none">
	<h1>Blog</h1>


</div>

<script language="javascript" type="text/javascript">
	function mostrarGrupo( idgrupo ){
		//alert(idgrupo);
		var childs = document.getElementById("manual-nav" ).getElementsByTagName("li");

		for( var i = 0; i < childs.length; i++ )
		{
			childs[i].className = "group";            
		}

        var childs = document.getElementById("manual-nav" ).getElementsByTagName("a");

		for( var i = 0; i < childs.length; i++ )
		{
			childs[i].className = "";
		}


		document.getElementById("li_"+idgrupo ).className = "group group-active";
        document.getElementById("a_"+idgrupo ).className = "active";
		document.getElementById("content-homepage" ).innerHTML = document.getElementById( idgrupo ).innerHTML;

        if( idgrupo=="tareas" ){
            Ext.Ajax.request(
			{
				url: '<?=url_for("homepage/getTareas" )?>',

                success: function(xhr) {
                    document.getElementById("content-homepage" ).innerHTML = xhr.responseText;
                    $('.qtip').tooltip();
                },
                failure: function() {
                    Ext.Msg.alert("Error", "Server communication failure");
                }

			 }
            );
        }
	}
    
	mostrarGrupo("intro");
	//mostrarGrupo("programas");
</script>