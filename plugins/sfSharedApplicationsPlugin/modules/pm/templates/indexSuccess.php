<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


include_component("pm", "panelTickets");
include_component("pm", "panelProyectos");
include_component("pm", "panelMilestones");
include_component("pm", "asignarMilestoneWindow");
include_component("pm", "agendarEntregasWindow");
include_component("pm", "unificarTicketsWindow");
//include_component("pm", "agendarEtapasWindow");
//include_component("pm", "gridAgendaEtapas");
//include_component("gestDocumental", "panelArchivos");
include_component("pm", "editarTicketWindow", array("nivel"=>$nivel));
//include_component("pm", "mainPanel");

//include_component("gestDocumental", "fileManagerPanel");
include_component("gestDocumental", "panelArchivos");

//Paneles laterales
include_component("pm","panelConsulta");

include_component("pm","panelReading");
include_component("pm","panelDocumentos");
include_component("pm","panelEntregas");
include_component("pm","nuevaRespuestaWindow");
include_component("pm","porcentajeTicketWindow");

include_component("users","panelUsers");

include_component("kbase", "panelCategorias");
include_component("kbase", "panelIssues");
include_component("kbase", "panelReadingKBase");
include_component("kbase", "panelCategoriaWindow");

include_component("kbase", "busquedaIssueWindow");


include_component("pm","panelBusquedaTicket");
include_component("pm","panelPreviewTicket");

include_component("pm","panelTicketsActivos");



include_component("pm", "busquedaTicketWindow");


//include_component("fileManager", "fileBrowser");
?>
<script type="text/javascript">


var crearTicket = function(){
    var win = new EditarTicketWindow();
    win.show();
}

var buscarSolucion = function(){
    var win = new BusquedaIssueWindow();
    win.show();
}


var buscarTicket = function(){
    var win = new BusquedaTicketWindow();
    win.show();
}


var newResponse = function( idticket , idresponse, vencimiento, respuesta, opener, status, status_name, idgroup, /*estimated,*/ idgrid ){
    var win = Ext.getCmp("nueva-respuesta-ticket");
    if( win ){
        win.close();
    }
    
    var win = new NuevaRespuestaWindow({idticket: idticket,
                                        idresponse: idresponse,
                                        vencimiento: vencimiento,
                                        respuesta: respuesta,
                                        idgroup: idgroup,
                                        //estimated: estimated,
                                        opener: opener,
                                        status: status,
                                        status_name: status_name,
                                        idgrid: idgrid
                                      });
    win.show();
}

var registroEventos = function(){
    

    var newComponent = new PanelBusquedaTicket({
                                             closable: true,                                             
                                             title: 'Eventos',
                                             autoload: true
                                            });
    Ext.getCmp('tab-panel').add(newComponent);
    Ext.getCmp('tab-panel').setActiveTab(newComponent);
}


Ext.onReady(function(){

    /* Inicializa los tooltips
    */
    Ext.QuickTips.init();
    Ext.apply(Ext.QuickTips.getQuickTip(), {
       dismissDelay: 200000 //permite que los tips permanezcan por mas tiempo.
    });


    new Ext.Viewport({
        layout: 'border',
        items: [
        // create instance immediately
        new Ext.BoxComponent({
            region: 'north',
            height: 30, // give north and south regions a height
            autoEl: {
                tag: 'div',
                html:''
            }
        }), {
            region: 'west',
            id: 'west-panel', // see Ext.getCmp() below
            title: 'Consultas',
            split: true,
            width: 200,
            minSize: 175,
            maxSize: 400,
            collapsible: true,
            margins: '0 0 0 5',
            layout: {
                type: 'accordion',
                animate: true
            },
            items: [
                new PanelConsulta({
                        title: "Tickets"
                    }),
                /*new PanelCategorias({
                        title: "Base Conocimiento"
                    })*/

            ]
        },
        // in this instance the TabPanel is not wrapped by another panel
        // since no title is needed, this Panel is added directly
        // as a Container
        new Ext.TabPanel({
            id:'tab-panel',
            region: 'center', // a center region is ALWAYS required for border layout
            deferredRender: false,
            activeTab: 0,     // first tab initially active
            enableTabScroll:true,
            items: [ {
                contentEl: 'center1',
                title: 'Acerca de',
                autoScroll: true
            }
           
            ]
        })]
    });
    // get a reference to the HTML element with id "hideit" and add a click listener to it
    Ext.get("hideit").on('click', function(){
        // get a reference to the Panel that was created with id = 'west-panel'
        var w = Ext.getCmp('west-panel');
        // expand or collapse that Panel based on its collapsed property state
        w.collapsed ? w.expand() : w.collapse();
    });
});



</script>

<!-- use class="x-hide-display" to prevent a brief flicker of the content -->
<div id="west" class="x-hide-display">
</div>

<div id="center1" class="x-hide-display">
    <br />
	<h3>&nbsp;&nbsp;&nbsp;Bienvenido al sistema de administracion de proyectos. </h3><br />
	<hr />
	&nbsp;&nbsp;&nbsp;Para comenzar a trabajar por favor seleccione una opci&oacute;n del panel lateral.
	
	<br />
	&nbsp;&nbsp;&nbsp;<a id="hideit" href="#">Ocultar panel lateral</a>
    <br />


    <div id="cpanel" style="margin: 20px;">

        <div style="float:left;">
            <div class="icon">
                <a href="#" onClick="crearTicket()">
                    <?=image_tag("48x48/edit_add.png")?>
                    <span>Nuevo Ticket</span>
                </a>
            </div>
        </div>
        
        <div style="float:left;">
            <div class="icon">
                <a href="#" onClick="buscarTicket()">
                    <?=image_tag("48x48/kviewshell.png")?>
                    <span>Buscar Ticket</span>
                </a>
            </div>
        </div>

        <div style="float:left;">
            <div class="icon">
                <a href="#" onClick="buscarSolucion()">
                    <?=image_tag("48x48/testbed_protocol.png")?>
                    <span>Buscar una soluci&oacute;n</span>
                </a>
            </div>
        </div>

        <div style="float:left;">
            <div class="icon">
                <a href="#" onClick="registroEventos()">
                    <?=image_tag("48x48/knode.png")?>
                    <span>Eventos</span>
                </a>
            </div>
        </div>

   </div>

    <br />
    <div style="clear:left; margin: 20px">
        <div  id="panel-activos"></div>
    </div>


</div>
<div id="props-panel" class="x-hide-display" style="width:200px;height:200px;overflow:hidden;">

</div>


<!-- Template used for ticket preview -->
<div id="preview-tpl" style="display:none;">
    <div class="post-data">

        <span class="post-date">{opened:date("M j, Y, g:i a")}</span>
        <h3 class="post-title">Ticket # {idticket} {title}</h3>
        <h4 class="post-author">by {loginName:defaultValue("Unknown")}</h4>
    </div>
    <div class="post-body">
        <table width="100%"  border="0" class="tableList">
            <tr>
            <td width="50%" ><b>Contacto:</b> {contact}</td>
            <td width="50%" >&nbsp; </td>
          </tr>

           <tr>
            <td ><b>Asignado a:</b>
                {assignedto}
            </td>
            <td ><b>Area: </b>
               {group}
            </td>
          </tr>

          <tr>
            <td >
                <b>Proyecto:</b>
                {project}
            </td>
            <td >
                <b>Prioridad:</b>
                {priority}
            </td>
          </tr>
          <tr>
            <td >
                <b>Tipo:</b> {tipo} {type}
            </td>
            <td >
                <b>Estado:</b> {action}
            </td>
          </tr>
        
        </table>        
        <br />
        {text:this.getBody}
    </div>
</div>



<!-- Template used for KB Items -->
<div id="preview-tpl-kb" style="display:none;">
    <div class="post-data">

        <span class="post-date">{pubDate:date("M j, Y, g:i a")}</span>
        <h3 class="post-title">{title}</h3>
        <h4 class="post-author">by {author:defaultValue("Unknown")}</h4>
    </div>
    <div class="post-body">{info:this.getBody}</div>
</div>


<div style="height:100%"></div>
<script type="text/javascript">
    Ext.onReady(function(){
        /*var newComponent = new PanelReading({           id: 'adad',
                                                             closable: true,
                                                             idproject: 3,
                                                             title: 'Panel prueba'
                                                            });
                    Ext.getCmp('tab-panel').add(newComponent);
                    Ext.getCmp('tab-panel').setActiveTab(newComponent);*/
        

        /*var newComponent = new PanelCronogramaUsuario({    id: 'adad',
                                                 closable: true,
                                                 idproject: 3,
                                                 title: 'Panel prueba'
                                                });
        Ext.getCmp('tab-panel').add(newComponent);
        Ext.getCmp('tab-panel').setActiveTab(newComponent);
        */

       /*var newComponent = new FileBrowser({    id: 'adad',
                                                 closable: true,
                                                 idproject: 3,
                                                 title: 'Panel prueba Archivos',
                                                 baseFolder: '<?="KB"?>'
                                                });
        Ext.getCmp('tab-panel').add(newComponent);
        Ext.getCmp('tab-panel').setActiveTab(newComponent);*/
       <?
       if( $idticket ){
       ?>
            var newComponent = new PanelPreviewTicket({
                                                closable: true,
                                                title: 'Ticket # <?=$idticket?>',
                                                idticket: <?=$idticket?>
                                              });
            Ext.getCmp('tab-panel').add(newComponent);
            Ext.getCmp('tab-panel').setActiveTab(newComponent);
       <?
       }
       ?>


       /*var panel = new PanelTicketsActivos({
           title: "Tickets Abiertos",
           width: 650,
           height: 300,
           autoload: false
       });
       panel.render("panel-activos");
       panel.store.setBaseParam("option", "misTickets");
       panel.recargar();*/
       
       


    });

</script>
