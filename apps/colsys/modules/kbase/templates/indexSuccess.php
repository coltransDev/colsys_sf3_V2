<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("kbase", "panelCategorias");
include_component("kbase", "panelIssues");
include_component("kbase", "panelReadingKBase");
include_component("kbase", "panelCategoriaWindow");

include_component("kbase", "busquedaIssueWindow");

include_component("gestDocumental", "panelArchivos", array("readOnly"=>false) );
include_component("users","panelUsers");

?>
<script type="text/javascript">

var buscarSolucion = function(){
    var win = new BusquedaIssueWindow();
    win.show();
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
                new PanelCategorias({
                        title: "Documentos"
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
        }),
        new Ext.Panel({
            id: 'preview',
            region: 'south',
            
            autoScroll: true
        })

    ]
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
	<h3>&nbsp;&nbsp;&nbsp;Bienvenido a la Base de Datos de conocimiento. </h3><br />
	<hr />
	&nbsp;&nbsp;&nbsp;Para comenzar a trabajar por favor seleccione una opci&oacute;n del panel lateral.

	<br />
	&nbsp;&nbsp;&nbsp;<a id="hideit" href="#">Ocultar panel lateral</a>
    <br />


    <div id="cpanel" style="margin: 20px;">
        <div style="float:left;">
            <div class="icon">
                <a href="#" onClick="buscarSolucion()">
                    <?=image_tag("48x48/testbed_protocol.png")?>
                    <span>Buscar una soluci&oacute;n</span>
                </a>
            </div>
        </div>
   </div>


</div>
<div id="props-panel" class="x-hide-display" style="width:200px;height:200px;overflow:hidden;">

</div>

<!-- Template used for Feed Items -->
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
    /*Ext.onReady(function(){
            var newComponent = new PanelReading({
                                                             closable: true,
                                                             idcategory: 17,
                                                             title: 'Panel prueba'
                                                            });
                    Ext.getCmp('tab-panel').add(newComponent);
                    Ext.getCmp('tab-panel').setActiveTab(newComponent);


        Ext.getCmp('tab-panel').add(newComponent);
        Ext.getCmp('tab-panel').setActiveTab(newComponent);

    });*/


</script>
