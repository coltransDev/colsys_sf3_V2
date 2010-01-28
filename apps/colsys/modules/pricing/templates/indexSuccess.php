<?
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("pricing", "panelCostosAduanaRecargos", array("nivel"=>$nivel));
include_component("pricing", "panelCostosAduanaWindow", array("nivel"=>$nivel));
include_component("pricing", "panelCostosAduana", array("nivel"=>$nivel));

include_component("gestDocumental", "panelArchivos", array("readOnly"=>$opcion=="consulta") );


?>
<script type="text/javascript">
Ext.onReady(function(){
        
        <?
        include_component("pricing", "panelNoticias");

        
        ?>
        var treePanelOnclickHandler = function(n){
		//var sn = this.selModel.selNode || {}; // selNode is null on initial selection
		if( n.leaf ){  // ignore clicks on folders
			var nodeoptions = n.id.split("_");
			var opcion = nodeoptions[0];
			var impoexpo = nodeoptions[1];
			var transporte = nodeoptions[2];
			var modalidad = nodeoptions[3];

			if( impoexpo=="impo" ){
				impoexpo = "<?=Constantes::IMPO?>";
			}

			if( impoexpo=="expo" ){
				impoexpo = "<?=Constantes::EXPO?>";
			}

            if( nodeoptions[4] ){
                idtrafico = nodeoptions[4];
                idcomponent+="_"+idtrafico;
            }else{
                    idtrafico = "";
            }

            if( opcion=="files" ){

                var folder = "Tarifario/"+impoexpo.substring(0, 1)+"_"+transporte.substring(0, 1)+"_"+modalidad+"_"+idtrafico;


                var newComponent = new PanelArchivos({folder:folder,
                                                     title:"Archivos "+impoexpo.substring(0, 4)+"»"+transporte+"»"+modalidad+"»"+idtrafico,
                                                     closable: true});
                                              

                Ext.getCmp('tab-panel').add(newComponent);
                Ext.getCmp('tab-panel').setActiveTab(newComponent);
            }else{

                switch( opcion ){
                    case "recgen":
                        /*
                        * Se muestran los recargos generales para el pais seleccionado
                        */
                        <?
                        $url = "pricing/recargosGenerales";

                        ?>
                        var url = '<?=url_for( $url )?>';
                        break;

                    case "reclin":
                        /*
                        * Se muestran los recargos generales para el pais seleccionado
                        */
                        <?
                        $url = "pricing/recargosPorLinea";

                        ?>
                        var url = '<?=url_for( $url )?>';
                        break;
                    case "admtraf":
                        /*
                        * Se muestran la administracion de trayectos para el pais seleccionado
                        */
                        <?
                        $url = "pricing/adminTrayectos";

                        ?>
                        var url = '<?=url_for( $url )?>';
                        break;
                    case "files":
                        /*
                        * Se muestran la administracion de trayectos para el pais seleccionado
                        */
                        <?
                        $url = "pricing/archivosPais";

                        ?>
                        var url = '<?=url_for( $url )?>';
                        break;
                    default:
                        /*
                        *  Se muestra una grilla con la información de fletes
                        *  del trafico seleccionado
                        */
                        <?
                        $url = "pricing/grillaPorTrafico";

                        ?>
                        var url = '<?=url_for( $url )?>';
                        break;
                }

                var idcomponent = opcion+"_"+impoexpo+"_"+transporte+"_"+modalidad



                if( nodeoptions[5] ){
                    if( opcion=="fletesciudad" ){
                        var idciudad = nodeoptions[5];
                        var idlinea = "";
                    }

                    if( opcion=="fleteslinea" || opcion=="reclin" ){
                        var idciudad = "";
                        var idlinea = nodeoptions[5];
                    }

                    idcomponent+="_"+nodeoptions[5];

                }


                if( Ext.getCmp('tab-panel').findById(idcomponent)!=null ){
                    Ext.getCmp('tab-panel').activate(idcomponent);
                    //Ext.getCmp('tab-panel').show();
                    return 0;
                }

                Ext.Ajax.request({
                    url: url,
                    params: {
                        impoexpo: impoexpo,
                        idtrafico: idtrafico,
                        transporte:transporte,
                        modalidad: modalidad,
                        idlinea: idlinea,
                        idciudad: idciudad
                    },
                    success: function(xhr) {
                        //alert( xhr.responseText );
                        var newComponent = eval(xhr.responseText);
                        Ext.getCmp('tab-panel').add(newComponent);
                        Ext.getCmp('tab-panel').setActiveTab(newComponent);

                    },
                    failure: function() {
                        Ext.Msg.alert("Tab creation failed", "Server communication failure");
                    }
                });
           }
		}else{
			n.expand();
		}
	}


    var archivosMugre = new PanelArchivos({
        folder: "<?=base64_encode("Tarifario".DIRECTORY_SEPARATOR."ArchivosAdicionales")?>",
        closable: true,
        title: "Archivos",
        height: 200
    });

        // NOTE: This is an example showing simple state management. During development,
        // it is generally best to disable state management as dynamically-generated ids
        // can change across page loads, leading to unpredictable results.  The developer
        // should ensure that stable state ids are set for stateful components in real apps.
        Ext.state.Manager.setProvider(new Ext.state.CookieProvider());

        var viewport = new Ext.Viewport({
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
            }),/* {
                region: 'east',
                title: 'East Side',
                collapsible: true,
                split: true,
                width: 225, // give east and west regions a width
                minSize: 175,
                maxSize: 400,
                margins: '0 5 0 0',
                layout: 'fit', // specify layout manager for items
                items:            // this TabPanel is wrapped by another Panel so the title will be applied
                new Ext.TabPanel({
                    border: false, // already wrapped so don't add another border
                    activeTab: 1, // second tab initially active
                    tabPosition: 'bottom',
                    items: [{
                        html: '<p>A TabPanel component can be a region.</p>',
                        title: 'A Tab',
                        autoScroll: true
                    }, new Ext.grid.PropertyGrid({
                        title: 'Property Grid',
                        closable: true,
                        source: {
                            "(name)": "Properties Grid",
                            "grouping": false,
                            "autoFitColumns": true,
                            "productionQuality": false,
                            "created": new Date(Date.parse('10/15/2006')),
                            "tested": false,
                            "version": 0.01,
                            "borderWidth": 1
                        }
                    })]
                })
            },*/ {
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
					include_component("pricing","panelConsultaCiudades", array( "impoexpo"=>Constantes::IMPO, "transporte"=>Constantes::MARITIMO, "titulo"=>"Importaciones Marítimas"));
					?>
                    ,
					<?						
					include_component("pricing","panelConsultaCiudades", array( "impoexpo"=>Constantes::IMPO, "transporte"=>Constantes::AEREO, "titulo"=>"Importaciones Aéreas"));				
					?>								
					,
					<?						
					include_component("pricing","panelConsultaCiudades", array( "impoexpo"=>Constantes::EXPO, "transporte"=>Constantes::MARITIMO, "titulo"=>"Exportaciones Marítimas"));
					?>								
					,
					<?						
					include_component("pricing","panelConsultaCiudades", array( "impoexpo"=>Constantes::EXPO, "transporte"=>Constantes::AEREO, "titulo"=>"Exportaciones Aéreas"));				
					?>
                    ,
                    <?
                    include_partial("formAduana", array("opcion"=>$opcion));
                    ?>
                    ,
                    <?
                    include_partial("formSeguros", array("opcion"=>$opcion));
                    ?>
                    ,
                    archivosMugre

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
                },
                gridNoticias
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
    });


</script>