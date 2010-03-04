<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("pm", "panelTickets");
include_component("pm", "panelProyectos");
include_component("pm", "panelMilestones");
include_component("gestDocumental", "panelArchivos");
//include_component("pm", "mainPanel");

//Paneles laterales
include_component("pm","panelConsulta");

?>
<script type="text/javascript">



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
                        title: "Consultas"
                    })

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
	&nbsp;&nbsp;&nbsp;Para comenzar a trabajar por favor seleccione una opci&oacute; del panel lateral.
	
	<br />
	&nbsp;&nbsp;&nbsp;<a id="hideit" href="#">Ocultar panel lateral</a>
    <br />


    <div id="cpanel" style="margin: 20px;">

        <div style="float:left;">
            <div class="icon">
                <a href="#" onClick="window.open('<?=url_for("pm/crearTicket")?>')">
                    <?=image_tag("48x48/edit_add.png")?>
                    <span>Nuevo Ticket</span>
                </a>
            </div>
        </div>

   </div>


</div>
<div id="props-panel" class="x-hide-display" style="width:200px;height:200px;overflow:hidden;">

</div>


<div style="height:100%"></div>
<script type="text/javascript">
    Ext.onReady(function(){
           /* var newComponent = new PanelCostosAduana({
                                                             closable: true,
                                                             title: 'Tarifario Aduana'
                                                            });
                    Ext.getCmp('tab-panel').add(newComponent);
                    Ext.getCmp('tab-panel').setActiveTab(newComponent);*/

        /*var newComponent = new PanelRecargosLocalesNaviera({id:'idcomponent',
                                                                  impoexpo: "Importación",
                                                                  //idtrafico: "DO-809",
                                                                  idtrafico: "MX-052",
                                                                  idlinea: 8,
                                                                  //idtrafico: "99-999",
                                                                  transporte: "Marítimo",
                                                                  modalidad: "FCL",
                                                                  title: "Recargos locales NAV",
                                                                  closable: true,
                                                                  readOnly: true });

        */

        /*var newComponent = new PanelParametros({
                                                             closable: true,
                                                             title: 'Def. de Conceptos',
                                                             readOnly: <?=$opcion=="consulta"?"true":"false"?>
                                                            });
        Ext.getCmp('tab-panel').add(newComponent);
        Ext.getCmp('tab-panel').setActiveTab(newComponent);*/

    });


</script>
