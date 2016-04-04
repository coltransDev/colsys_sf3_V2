<?
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
/*
include_component("pricing", "panelCostosAduanaRecargos", array("nivel"=>$nivel));
include_component("pricing", "panelCostosAduanaWindow", array("nivel"=>$nivel));
include_component("pricing", "panelCostosAduana", array("nivel"=>$nivel));
*/
include_component("gestDocumental", "panelArchivos", array("readOnly"=>$opcion=="consulta") );
include_component("pricing", "panelNoticias");


include_component("pricing", "panelTrayectoWindow");
include_component("pricing", "panelTrayecto", array("readOnly"=>$opcion=="consulta"));
include_component("pricing", "panelFletesPorTrayecto",array("nivel"=>$nivel));
include_component("pricing", "panelRecargosPorCiudad");
include_component("pricing", "panelRecargosPorLinea");

include_component("pricing", "panelRecargosLocalesParametros");
include_component("pricing", "panelRecargosLocalesPatios");
include_component("pricing", "panelRecargosLocalesNaviera");

//Paneles laterales
include_component("pricing","panelConsultaCiudades");


//Panel de parametros

include_component("conceptos","panelParametros" );
include_component("pricing","panelPatios" );
include_component("conceptos","modalidadWindow" );
include_component("conceptos","modalidadGrid");

include_component("conceptos","AKAWindow" );
include_component("conceptos","AKAGrid");


//Tarifario Colmas
include_component("pricing","panelTarifarioAduana");
//include_component("pricing","panelTarifarioAduanaCliente");

//Tarifario Coldepositos
include_component("pricing","panelTarifarioDeposito");
?>
<script type="text/javascript">



Ext.onReady(function(){

/*     window.alert = function(texto,titulo)
     {
        titulo=(titulo!="undefined")?titulo:'Alerta';
        Ext.MessageBox.alert(titulo, texto );
     }
*/
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
                    new PanelConsultaCiudades({
                        title: "Importaciones Marítimas",
                        "impoexpo": "<?=(Constantes::IMPO)?>",
                        "transporte": "<?=(Constantes::MARITIMO)?>",
                        "readOnly": <?=$opcion=="consulta"?"true":"false"?>
                    }),

                    new PanelConsultaCiudades({
                        title: "Importaciones Aéreas",
                        "impoexpo": "<?=(Constantes::IMPO)?>",
                        "transporte": "<?=(Constantes::AEREO)?>",
                        "readOnly": <?=$opcion=="consulta"?"true":"false"?>
                    }),
                    new PanelConsultaCiudades({
                        title: "Exportaciones Marítimas",
                        "impoexpo": "<?=(Constantes::EXPO)?>",
                        "transporte": "<?=(Constantes::MARITIMO)?>",
                        "readOnly": <?=$opcion=="consulta"?"true":"false"?>
                    }),
                    new PanelConsultaCiudades({
                        title: "Exportaciones Aéreas",
                        "impoexpo": "<?=(Constantes::EXPO)?>",
                        "transporte": "<?=(Constantes::AEREO)?>",
                        "readOnly": <?=$opcion=="consulta"?"true":"false"?>
                    }),
                    new PanelConsultaCiudades({
                        title: "OTM Marítimo",
                        "impoexpo": "<?=(Constantes::IMPO)?>",
                        "transporte": "<?=(Constantes::OTMDTA)?>",
                        "readOnly": <?=$opcion=="consulta"?"true":"false"?>
                    }),
                    new PanelConsultaCiudades({
                        title: "OTM Aéreo",
                        "impoexpo": "<?=(Constantes::IMPO)?>",
                        "transporte": "<?=(Constantes::OTMAIR)?>",
                        "readOnly": <?=$opcion=="consulta"?"true":"false"?>
                    }),
                    new PanelConsultaCiudades({
                        title: "Transporte Terrestre",
                        "impoexpo": "<?=(Constantes::INTERNO)?>",
                        "transporte": "<?=(Constantes::TERRESTRE)?>",
                        "readOnly": <?=$opcion=="consulta"?"true":"false"?>
                    }),
                    new PanelConsultaCiudades({
                        title: "Aduana Importación",
                        "impoexpo": "<?=(Constantes::ADUANAS)?>",
                        "modalidad": "<?=(Constantes::ADUANA)?>",
                        "readOnly": <?=$opcion=="consulta"?"true":"false"?>
                    }),
                    new PanelConsultaCiudades({
                        title: "Aduana Exportación",
                        "impoexpo": "<?=(Constantes::EXPO)?>",
                        "modalidad": "<?=(Constantes::ADUANA)?>",
                        "readOnly": <?=$opcion=="consulta"?"true":"false"?>
                    }),
                    new PanelConsultaCiudades({
                        title: "Depósitos",
                        "impoexpo": "<?=(Constantes::DEPOSITOS)?>",
                        "readOnly": <?=$opcion=="consulta"?"true":"false"?>
                    }),
                
                <?
                include_partial("formSeguros", array("opcion"=>$opcion));
                ?>
                ,
                <?
                include_partial("formParametros", array("opcion"=>$opcion));
                ?>
                ,
                new PanelArchivos({
                    folder: "<?=base64_encode("Tarifario".DIRECTORY_SEPARATOR."ArchivosAdicionales")?>",
                    closable: true,
                    title: "Archivos",
                    height: 200
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
            activeTab: 1,     // first tab initially active
            enableTabScroll:true,
            items: [ {
                contentEl: 'center1',
                title: 'Acerca de',
                autoScroll: true
            },
            new PanelNoticias()
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
	<h3>&nbsp;&nbsp;&nbsp;Bienvenido al sistema de administracion del tarifario. </h3><br />
	<hr />
	&nbsp;&nbsp;&nbsp;Para comenzar a trabajar por favor seleccione una ciudad del panel de traficos.
	<br />
	&nbsp;&nbsp;&nbsp;Por favor tenga en cuenta las observaciones.
	
	<br />
	&nbsp;&nbsp;&nbsp;<a id="hideit" href="#">Ocultar panel lateral</a>
    <br />
	<div id="panel-noticias-wrap" >
		<div id="panel-noticias" ></div>
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

        /*var newComponent = new PanelFletesPorTrayecto({
                                                             closable: true,
                                                             title: 'OTM',
                                                             readOnly: <?=$opcion=="consulta"?"true":"false"?>,
                                                             impoexpo: "<?=Constantes::IMPO?>",
                                                             transporte: "<?=Constantes::OTMDTA?>",
                                                             modalidad: "FCL",
                                                             idtrafico: "CO-057"
                                                         });
        Ext.getCmp('tab-panel').add(newComponent);    
        Ext.getCmp('tab-panel').setActiveTab(newComponent);*/

        /*var newComponent = new PanelParametros({
                                                             closable: true,
                                                             title: 'Parametros'

                                                         });
        Ext.getCmp('tab-panel').add(newComponent);
        Ext.getCmp('tab-panel').setActiveTab(newComponent);*/

    });


</script>
