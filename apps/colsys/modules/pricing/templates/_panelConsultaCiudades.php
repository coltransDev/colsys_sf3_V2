<script type="text/javascript">

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
            dataUrl:'<?=url_for("pricing/datosCiudades")?>?transporte='+this.transporte+'&impoexpo='+this.impoexpo
        }),

        root: new Ext.tree.AsyncTreeNode()
        ,
        listeners:  {
             click : this.onClickHandler
        }
    });




}

Ext.extend(PanelConsultaCiudades, Ext.tree.TreePanel, {
    onClickHandler: function(n){
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

                var folder = Base64.encode("Tarifario/"+impoexpo.substring(0, 1)+"_"+transporte.substring(0, 1)+"_"+modalidad+"_"+idtrafico);


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
    
});

</script>