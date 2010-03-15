<?
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
/**
 * PanelConsultaCiudades object definition
 **/
PanelConsultaCiudades = function( config ){
    Ext.apply(this, config);

    PanelConsultaCiudades.superclass.constructor.call(this, {
        split: true,
        height: 300,
        minSize: 150,
        autoScroll: true,

        // tree-specific configs:
        rootVisible: false,
        lines: false,
        singleExpand: true,
        useArrows: true,
        //iconCls:'settings',
        animate:true,

        loader: new Ext.tree.TreeLoader({
            dataUrl:'<?=url_for("pricing/datosCiudades")?>',
            baseParams : {
                impoexpo: this.impoexpo,
                transporte: this.transporte,
                modalidad: this.modalidad
            }
        }),

        root: new Ext.tree.AsyncTreeNode()
        ,
        listeners:  {
             click : this.onClick,
             contextmenu: this.onContextMenu
        }
    });
}

Ext.extend(PanelConsultaCiudades, Ext.tree.TreePanel, {
    onClick: function(n){
        //var sn = this.selModel.selNode || {}; // selNode is null on initial selection
        if( n.leaf ){  // ignore clicks on folders           
            //var nodeoptions = n.id.split("_");
            var trafico = n.attributes.trafico;
            var opcion = n.attributes.opcion;
            var impoexpo = n.attributes.impoexpo;
            var transporte = n.attributes.transporte;
            var modalidad = n.attributes.modalidad;
            var idtrafico = n.attributes.idtrafico;

            //Coloca un identificador unico para evitar que el componente se cree dos veces
            var idcomponent = opcion+"_"+impoexpo+"_"+transporte+"_"+modalidad;
            if( typeof(n.attributes.idtrafico)!="undefined" ){
                var idtrafico = n.attributes.idtrafico;
                idcomponent+="_"+idtrafico;
            }else{
                var idtrafico = "";
            }

            if( typeof(n.attributes.idciudad)!="undefined" ){                
                var idciudad = n.attributes.idciudad;
                var idlinea = "";
                idcomponent+="_"+idciudad;
            }

            if( typeof(n.attributes.idlinea)!="undefined" ){
                var idciudad = "";
                var idlinea = n.attributes.idlinea;
                idcomponent+="_"+idlinea;
            }
            
            if( impoexpo=="impo" ){
                impoexpo = "<?=Constantes::IMPO?>";
            }

            if( impoexpo=="expo" ){
                impoexpo = "<?=Constantes::EXPO?>";
            }
            
            /*
            * Todo debe quedar de esta manera
            **/
            if( Ext.getCmp('tab-panel').findById(idcomponent) ){
                Ext.getCmp('tab-panel').setActiveTab(idcomponent);
            }else{

                switch( opcion ){
                    case "files":
                        var folder = Base64.encode("Tarifario/"+impoexpo.substring(0, 1)+"_"+transporte.substring(0, 1)+"_"+modalidad+"_"+idtrafico);
                        var newComponent = new PanelArchivos({id:idcomponent,
                                                             folder:folder,
                                                             title:"Archivos "+impoexpo.substring(0, 4)+"»"+transporte+"»"+modalidad+"»"+trafico,
                                                             closable: true});
                        break;
                    case "admtraf":
                        /*
                        * Se muestran la administracion de trayectos para el pais seleccionado
                        */
                        var newComponent = new PanelTrayecto({id:idcomponent,
                                                              impoexpo: impoexpo,
                                                              idtrafico: idtrafico,
                                                              transporte:transporte,
                                                              modalidad: modalidad,
                                                              title:"Trayectos "+impoexpo.substring(0, 4)+"»"+transporte+"»"+modalidad+"»"+trafico,
                                                              closable: true,
                                                              readOnly: this.readOnly
                                                             });
                        break;
                    case "recgen":
                        /*
                        * Se muestran la administracion de trayectos para el pais seleccionado
                        */
                        if( idtrafico=="99-999"){
                            var titulo = "Recargos Locales "+impoexpo.substring(0, 4)+"»"+transporte+"»"+modalidad;
                        }else{
                            var titulo = "Recargos "+impoexpo.substring(0, 4)+"»"+transporte+"»"+modalidad+"»"+trafico;
                        }
                        var newComponent = new PanelRecargosPorCiudad({id:idcomponent,
                                                              impoexpo: impoexpo,
                                                              idtrafico: idtrafico,
                                                              transporte:transporte,
                                                              modalidad: modalidad,
                                                              title: titulo,
                                                              closable: true,
                                                              readOnly: this.readOnly
                                                             });
                        break;
                    case "reclin":
                        /*
                        * Se muestran la administracion de trayectos para el pais seleccionado
                        */
                        var newComponent = new PanelRecargosPorLinea({id:idcomponent,
                                                              impoexpo: impoexpo,
                                                              idtrafico: idtrafico,
                                                              transporte:transporte,
                                                              modalidad: modalidad,
                                                              title: "Recargos x Linea "+impoexpo.substring(0, 4)+"»"+transporte+"»"+modalidad+"»"+trafico,
                                                              closable: true,
                                                              readOnly: this.readOnly
                                                             });
                        break;
                    case "recnav":
                        /*
                        * Se muestran la administracion de trayectos para el pais seleccionado
                        */
                        var newComponent = new PanelRecargosLocalesNaviera({id:idcomponent,
                                                              impoexpo: impoexpo,
                                                              idlinea: idlinea,
                                                              transporte:transporte,
                                                              modalidad: modalidad,
                                                              title: "Recargos Locales x Linea "+impoexpo.substring(0, 4)+"»"+transporte+"»"+modalidad+"»"+n.attributes.text,
                                                              closable: true,
                                                              readOnly: this.readOnly
                                                             });
                        break;

                    case "tarifario-aduana":
                        /*
                        * Se muestran la administracion de trayectos para el pais seleccionado
                        */
                        var newComponent = new PanelTarifarioAduana({id:idcomponent,                                                             
                                                              title: "Tarifario Aduana General",
                                                              closable: true,
                                                              readOnly: this.readOnly
                                                             });
                        break;
                    case "tarifario-aduana-cliente":
                        /*
                        * Se muestran la administracion de trayectos para el pais seleccionado
                        */
                        var newComponent = new PanelTarifarioAduanaCliente({id:idcomponent,
                                                              title: "Tarifario Aduana x Cliente",
                                                              closable: true,
                                                              readOnly: this.readOnly
                                                             });
                        break;
                    default:

                        /*
                        * Se muestran la administracion de trayectos para el pais seleccionado
                        */
                        var newComponent = new PanelFletesPorTrayecto({id:idcomponent,
                                                              impoexpo: impoexpo,
                                                              idtrafico: idtrafico,
                                                              trafico: trafico,
                                                              transporte:transporte,
                                                              modalidad: modalidad,
                                                              idciudad: idciudad,
                                                              idlinea: idlinea,
                                                              title: impoexpo.substring(0, 4)+"»"+transporte+"»"+modalidad+"»"+trafico,
                                                              closable: true,
                                                              readOnly: this.readOnly
                                                             });


                        break;
                }


                Ext.getCmp('tab-panel').add(newComponent);
                Ext.getCmp('tab-panel').setActiveTab(newComponent);
            }
            return 0;
            
        }else{
            n.expand();
        }
    },

    onContextMenu: function( node,  e ) {   
        var id = node.id;        
        if( id.substring(0,4) == "traf" ){
            if( !this.readOnly ){

                if(!this.menu){ // create context menu on first right click
                    this.menu = new Ext.menu.Menu({
                    enableScrolling : false,
                    items: [{
                                text: 'Agregar trayecto',
                                iconCls: 'add',
                                scope:this,
                                handler: function(){
                                      this.crearTrayecto( node );
                                }
                            }]
                    });
                }
                e.stopEvent();
                this.menu.showAt(e.getXY());
            }
        }
    },

    crearTrayecto: function( n ){

        
        this.win = new PanelTrayectoWindow({node: n});

        this.win.show();
        var fp = Ext.getCmp("trayecto-form");
        fp.getForm().findField("impoexpo").disable();
        fp.getForm().findField("transporte").disable();
        fp.getForm().findField("modalidad").disable();
        if( n.attributes.impoexpo=="expo" ){
            fp.getForm().findField("impoexpo").setValue( '<?=Constantes::EXPO?>' );
        }else{
            fp.getForm().findField("impoexpo").setValue( '<?=Constantes::IMPO?>' );
        }
        fp.getForm().findField("transporte").setValue( n.attributes.transporte );
        fp.getForm().findField("modalidad").setValue( n.attributes.modalidad );

    }
    
});

</script>