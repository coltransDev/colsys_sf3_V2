<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("inventory", "panelCategorias");
include_component("inventory", "panelCategoriaWindow");
include_component("inventory", "panelActivos");

include_component("inventory", "editarActivoWindow");

include_component("inventory", "panelReading");
include_component("inventory", "panelAsignaciones");

include_component("inventory", "panelProductos");

include_component("inventory", "nuevoSeguimientoWindow");
include_component("widgets", "widgetUsuario");
include_component("widgets", "widgetEquipo");
include_component("inventory", "widgetProducto");

include_component("inventory", "nuevaAnotacionWindow");
include_component("widgets", "widgetParametros",array("caso_uso"=>"CU279"));


$suc = $sf_data->getRaw( "suc" );

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
                <?
                $i=0;
                foreach( $sucursales as $sucursal ){
                    if( $i++!=0){
                        echo ",";
                    }
                    
                    $readOnly = true;
                    
                    if( $nivel==1 && $sucursal->getCaNombre()==$suc->getCaNombre() ){
                        $readOnly = false;
                    }
                    
                    if( $nivel==2 ){
                        $readOnly = false;
                    }
                    
                ?>
                
                new PanelCategorias({
                        title: "<?=$sucursal->getCaNombre()?>",                        
                        idsucursal: "<?=$sucursal->getCaIdsucursal()?>",
                        readOnly: <?=$readOnly?"true":"false"?>
                        
                    })
                <?    
                }
                ?>
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


function mostrarAnotacion(idman,idact,autoriza,activ)
    {
       var win = new NuevaAnotacionWindow({idmantenimiento: idman,idactivo: idact, autorizafirma: autoriza, activo: activ});
       win.show();    
    }
    
</script>

<!-- use class="x-hide-display" to prevent a brief flicker of the content -->
<div id="west" class="x-hide-display">
</div>

<div id="center1" class="x-hide-display">
    <br />
	<h3>&nbsp;&nbsp;&nbsp;Bienvenido a la Base de Datos de activos. </h3><br />
	<hr />
	&nbsp;&nbsp;&nbsp;Para comenzar a trabajar por favor seleccione una opci&oacute;n del panel lateral.

	<br />
	&nbsp;&nbsp;&nbsp;<a id="hideit" href="#">Ocultar panel lateral</a>
    <br />


    <div id="cpanel" style="margin: 20px;">
        
        <div style="float:left;">
            <div class="icon">
                <a href="<?=url_for("inventory/informes")?>" >
                    <?=image_tag("48x48/kspread_ksp.gif")?>
                    <span>Informes</span>
                </a>
            </div>
        </div>
        <div style="float:left;">
            <div class="icon">
                <a href="<?=url_for("inventory/informeListadoMantenimientos")?>" >
                    <?=image_tag("48x48/kgoldrunner.gif")?>
                    <span>Mantenimientos</span>
                </a>
            </div>
        </div>
        <div style="float:left;">
            <div class="icon">
                <a href="<?=url_for("inventory/informeMantenimientosRealizados")?>" target="_blank" >
                    <?=image_tag("48x48/signature.gif")?>
                    <span>Registros Mantenimiento</span>
                </a>
            </div>
        </div>
        <div style="float:left;">
            <div class="icon">
                <a href="<?=url_for("inventory/informeSeguimientosRealizados")?>" target="_blank">
                    <?=image_tag("48x48/signature.gif")?>
                    <span>Registros Seguimientos</span>
                </a>
            </div>
        </div>        
   </div>
</div>
<div id="props-panel" class="x-hide-display" style="width:200px;height:200px;overflow:hidden;">

</div>


<!-- Template used for ticket preview -->
<div id="preview-tpl" style="display:none;">
    <div class="post-data">

        <h3 class="post-title">Activo # {idactivo} {noinventario}</h3>
        <h4 class="post-author">{marca} {modelo} {version}</h4>
    </div>
    <br />
    <div class="post-body">
        <table class="tableList" align="center" width="80%">
            <tr>
                <th><b>No Inventario<b></th>
                <td>{noinventario}</td>
                <th><b>Serial</b></th>
                <td>{serial}</td>
            </tr>
            <tr>
                <th><b>Marca<b></th>
                <td>{marca}</td>
                <th><b>Modelo</b></th>
                <td>{modelo}</td>
            </tr>
            <tr>
                <th><b>Versi&oacute;n<b></th>
                <td>{version}</td>
                <th><b>Direcci&oacute;n IP</b></th>
                <td>{ipaddress}</td>
            </tr>
            <tr>
                <th><b>Procesador<b></th>
                <td>{procesador}</td>
                <th><b>Memoria</b></th>
                <td>{memoria}</td>
            </tr>
            <tr>
                <th><b>Disco</b></th>
                <td>{disco}</td>
                <th><b>Unidad Optica</b></th>
                <td>{optica}</td>
            </tr>   
            <tr>
                <th><b>Sistema Operativo</b></th>
                <td colspan="3">{so}</td>
               
            </tr>

            <tr>
                <th><b>Ubicaci&oacute;n</b></th>
                <td>{ubicacion}</td>
                <th><b>Asignado a</b></th>
                <td>{asignadoaNombre}</td>
            </tr>
            <tr>
                <th><b>Empresa</b></th>
                <td>{empresa}</td>
                <th><b>Proveedor</b></th>
                <td>{proveedor}</td>
            </tr>
            <tr>
                <th><b>Factura</b></th>
                <td>{factura}</td>
                <th><b>Vlr. Reposici&oacute;n</b></th>
                <td>{reposicion}</td>
            </tr>
            <tr>
                <th><b>Fecha de Compra</b></th>
                <td colspan="3">{fchcompra:date("M j, Y")}</td>
               
            </tr>
            <tr>
                <th><b>Contrato</b></th>            
                <td colspan="3">{contrato}</td>
            </tr>
            <tr>
                <th ><b>Observaciones</b>
                <td colspan="3">{observaciones}</td>
            </tr>
        </table>
    </div>
</div>


<div style="height:100%"></div>
<script type="text/javascript">
    Ext.onReady(function(){
        /*var newComponent = new PanelReading({
                                             id: 'asdad',
                                             closable: true,
                                             idcategory: 21,
                                             idsucursal: 'BAQ',
                                             parameter: 'Software',
                                             title: 'Panel prueba',
                                             editable: true
                                            });
        */

        /*newComponent = new PanelProductos({
                                             id: 'asdad',
                                             closable: true,
                                             idcategory: 21,
                                             idsucursal: 'BAQ',
                                             parameter: 'Software',
                                             title: 'Panel prueba',
                                             editable: true
                                            });            
                    
        Ext.getCmp('tab-panel').add(newComponent);
        Ext.getCmp('tab-panel').setActiveTab(newComponent);*/

    });


</script>

