<?

use_helper("MimeType");
$grupo = $ticket->getHdeskGroup();
$proyecto = $ticket->getHdeskProject();

$ticket = $sf_data->getRaw("ticket");

include_component("pm","panelDetalleTicket");
include_component("gestDocumental", "panelArchivos", array("readOnly"=>$ticket->getCaAction()=="Cerrado" ));
//include_component("pm","panelTareas");

?>
<script language="javascript">
	function comentar(  ){		
		document.getElementById( "coment_status_txt" ).style.display = "inline";
		document.getElementById( "coment_status" ).style.display = "none";
	}
	function cancelar_comentar(  ){
		document.getElementById( "coment_status" ).style.display = "inline";
		document.getElementById( "coment_status_txt" ).style.display = "none";
	}
	
	function guardar_comentario(  idticket ){
		cancelar_comentar(  );
		
		var txt = document.getElementById( "coment_status_field" ).value;
		document.getElementById( "coment_status_field" ).value="";
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando...',						
				url: '<?=url_for("pm/guardarRespuestaTicket")?>',
				params : {
					idticket: idticket,					
					comentario: txt
				},
										
				callback :function(options, success, response){	
					document.getElementById("coments").innerHTML = response.responseText; 
				}	
			 }
		); 				
		
	}
		
</script>


<div class="content" >
    <div id="panel"></div>
</div>


<div id ="header" class="x-hide-display">
<table width="100%"  border="0" class="tableList">
    
  <tr>
    <td width="50%" class="listar"><b>Reportado por:</b> <?=$ticket->getUsuario()?$ticket->getUsuario()->getCaNombre():$ticket->getCaLogin()?></td>
    <td width="50%" class="listar"><b>Abierto </b> <?=Utils::fechaMes($ticket->getCaOpened())?> </td>
	</tr>
	<tr>
    <td width="50%" class="listar"><b>Contacto:</b> <?=$ticket->getUsuario()?$ticket->getUsuario()->getSucursal()->getCaNombre()." ".$ticket->getUsuario()->getCaExtension():"&nbsp;"?></td>
    <td width="50%" class="listar">&nbsp; </td>
  </tr>  
 
   <tr>
    <td class="listar"><b>Departamento:</b>
		<?
		if( $grupo ){
			$departamento = $grupo->getDepartamento();
			echo Utils::replace($departamento->getCaNombre()); 
		}
		?>
	</td>
    <td class="listar"><b>Area: </b>  
		<?
		if( $grupo ){
			echo Utils::replace($grupo->getCaName());
		}
		?>
	</td>
  </tr>
  
  <tr>
  	<td class="listar">
		<b>Proyecto: </b>
		<?
		if( $proyecto ){
			echo Utils::replace($proyecto->getCaName()); 
		}
		?>
	</td>
  	<td class="listar">&nbsp;</td>
  </tr>
   <tr>
    <td class="listar">
		<b>Prioridad: </b> 
		<?=$ticket->getCaPriority()?>
	</td>
    <td class="listar">
		<b>Asignado a:</b> 
		<?		
		if( $ticket->getCaAssignedto() ){
			$asignado = $ticket->getAssignedUser();
			if( $asignado ){
				echo $asignado->getCaNombre()."&nbsp;&nbsp;&nbsp;&nbsp;";
			}
		}else{
			if( $nivel>0 && $ticket->getCaAction()=="Abierto" ){
				echo link_to("Tomar asignaci&oacute;n" , "pm/tomarAsignacion?id=".$ticket->getCaIdticket() );
			}
		}		
		?>
	</td>
  </tr>


  <tr>
    <td class="listar">
		<b>Tipo: </b>
		<?=$ticket->getCaType()?>
	</td>
    <td class="listar">
		<b>Estado: 	</b>		
		<?=$ticket->getCaAction()?> <?=$nivel>0&&$ticket->getCaAction()=="Abierto"?link_to("Cerrar","pm/cerrarTicket?id=".$ticket->getCaIdticket() ):""?>
	</td>
  </tr>
  <tr>
    <td class="listar">
		<b>Milestone: </b>
		<?=$ticket->getHdeskMilestone()?$ticket->getHdeskMilestone()->getCaTitle():""?>
	</td>
    <td class="listar">
		<b>Estimado: 	</b>
		<?=$ticket->getHdeskMilestone()?Utils::fechaMes($ticket->getHdeskMilestone()->getCaDue()):""?>
	</td>
  </tr>
  <?
  $loginsGrupo = $sf_data->getRaw("loginsGrupo");
  if( in_array($user->getUserId(), $loginsGrupo ) ){
  ?>
   <tr>
    <td class="listar">
		<b>Seguimiento: </b> 
		<br />
		<?
		$tarea = $ticket->getTareaSeguimiento();
		
		if( $ticket->getCaAction()=="Abierto" ){
		?>
		<?=link_to($tarea&&!$tarea->getCaFchterminada()?utils::fechaMes($tarea->getCaFchvencimiento()):"Nuevo seguimiento", "pm/nuevoSeguimiento?id=".$ticket->getCaIdticket() );
		}
		?>
		
		
		<?=$tarea&&!$tarea->getCaFchterminada()?link_to(image_tag("16x16/button_cancel.gif"), "pm/eliminarSeguimiento?id=".$ticket->getCaIdticket() ):""?>
		
		
	</td>
    <td class="listar">&nbsp;
		
	</td>
  </tr>
  <?
  }
  ?>
  
</table>

</div>

<div id ="respuestas" class="x-hide-display">


    <div class="boxText">
        <div id="coments">
        <?
        include_component("helpdesk", "listaRespuestasTicket", array("idticket"=>$ticket->getCaIdticket()) );
        ?>
        </div>
        <?
        if( $ticket->getCaAction()=="Abierto" ){
        ?>
         <div class="story_coment" id="coment_status_txt" style="display:none" >
            <textarea rows="1" cols="180" id="coment_status_field" onkeyup="autoGrow(this)" onfocus="autoGrow(this)"></textarea>
            <br />

            <b><a onclick="guardar_comentario( <?=$ticket->getCaIdticket()?> )"><?=image_tag("16x16/button_ok.gif")?> Guardar</b></a> <b><a onclick="cancelar_comentar()"> <?=image_tag("16x16/button_cancel.gif")?> Cancelar</a></b>
        </div>
        <div class="story_coment" id="coment_status" onclick="comentar()">
            <b> <?=image_tag("16x16/edit_add.gif")?> Respuesta</b>
        </div>       
         <?
         }
         ?>
    </div>
</div>



<div id="descripcion" class="x-hide-display">
    <div class="boxText">
        <?=$ticket->getCaText()?>
	</div>   
</div>


<div id="usuarios" class="x-hide-display">

	<div class="boxText">
    <?
    foreach( $usuarios as $usuario ){
        echo image_tag("16x16/user_male.gif")." ".$usuario->getCaNombre()." ";
        if( $nivel>0 && $ticket->getCaAction()!="Cerrado" ){
            echo link_to(image_tag("16x16/delete.gif"), "pm/eliminarUsuario?id=".$ticket->getCaIdticket()."&usuario=".$usuario->getCaLogin()."&token=".md5(time()), array("confirm"=>"Esta seguro"));
        }
        echo "<br />";
    }

    if( $nivel>0 && $ticket->getCaAction()!="Cerrado"){
        echo link_to(image_tag("16x16/add_user.gif")." Agregar", "pm/agregarUsuario?id=".$ticket->getCaIdticket()."&token=".md5(time()))." ";
    }
	?>
    </div>
</div>


<div id="archivos" class="x-hide-display">
	<div class="boxText">
    <?
    foreach( $files as $file ){
	?>
	<a href="#" onclick='javascript:window.open("<?=url_for("pm/verArchivo?id=".$ticket->getCaIdticket()."&file=".base64_encode(basename($file)))?>")'>
		<b><?=mime_type_icon(basename($file))?> <?=basename($file)?></b>
        <?
        if( $ticket->getCaAction()!="Cerrado"){
            echo link_to(image_tag("16x16/delete.gif"), "pm/eliminarArchivo?id=".$ticket->getCaIdticket()."&file=".base64_encode(basename($file))."&token=".md5(time()), array("confirm"=>"Esta seguro"));
        }

        ?>
	</a>
	<br />
	<br />
	<?
	}
    if( $ticket->getCaAction()!="Cerrado"){
        echo link_to(image_tag("16x16/attach.gif")." Adjuntar", "pm/adjuntarArchivo?id=".$ticket->getCaIdticket()."&token=".md5(time()))." ";
    }
	?>
    </div>
</div>

<script type="text/javascript" >
    var bodyStyle = 'padding: 5px 5px 5px 5px; overflow: auto;';

    /*var panelTareas = new PanelTareas({title: 'Tareas',
                                       idticket: '<?=$ticket->getCaIdticket()?>',
                                       readOnly: false
                                       });*/


    var panelArchivos = new PanelArchivos({
                                                folder:"<?=base64_encode($ticket->getDirectorioBase())?>",
                                                closable:true,
                                                title:"Archivos",
                                                closable:false,
                                                boxMinHeight: 400
                                            });

    var mainPanel = new PanelDetalleTicket({
                                    activeTab: 0,
                                    items: [
                                            {contentEl:'descripcion', title: 'Descripción', bodyStyle: bodyStyle},
                                            {contentEl:'usuarios', title: 'Usuarios', bodyStyle: bodyStyle},
                                            panelArchivos,
                                            {contentEl:'respuestas', title: 'Respuestas', bodyStyle: bodyStyle}
                                            //,panelTareas

                                    ]
                    });



    var panel = new Ext.FormPanel({
        title: "Ticket # <?=$ticket->getCaIdticket()?>: <?=Utils::replace($ticket->getCaTitle())?>",
        items: [
            {contentEl:'header'},
            mainPanel
            
        ]
      });
    panel.render("panel");


</script>
