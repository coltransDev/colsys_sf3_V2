<?
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
/**
 * PanelDirectorios object definition
 **/
PanelDirectorios = function( config ){
    Ext.apply(this, config);

    this.loader = new Ext.tree.TreeLoader({
        dataUrl:'<?=url_for("gestDocumental/datosPanelDirectorios")?>',
        baseParams: {folder: this.folder}
    });



    PanelDirectorios.superclass.constructor.call(this, {
        split: true,
        height: 300,
        minSize: 150,
        autoScroll: true,

        // tree-specific configs:
        rootVisible: false,
        lines: false,
        singleExpand: false,
        useArrows: true,
        //iconCls:'settings',
        animate:true,

        loader: this.loader,

        root: new Ext.tree.AsyncTreeNode()
        ,
        listeners:  {
             click : this.onClick
             
        }
    });

   
}

Ext.extend(PanelDirectorios, Ext.tree.TreePanel, {
    onClick: function(n){
        //var sn = this.selModel.selNode || {}; // selNode is null on initial selection
        if( n.leaf ){  // ignore clicks on folders           
            //var nodeoptions = n.id.split("_");
            
            var action = n.attributes.action;
            var idgroup = n.attributes.idgroup;
            var idproject = n.attributes.idproject;
            var actionTicket = n.attributes.actionTicket;
            var assignedTo = n.attributes.assignedTo;
            var reportedBy = n.attributes.reportedBy;
            

            //Coloca un identificador unico para evitar que el componente se cree dos veces
            var idcomponent = action;

            var title = "";
            if( typeof(n.attributes.idgroup)!="undefined" ){
                idcomponent+="_A"+idgroup;
                title += "Area  "+ n.attributes.group;
            }

            if( typeof(n.attributes.idproject)!="undefined" ){
                idcomponent+="_P"+idproject;
                if( typeof(n.attributes.idgroup)!="undefined" ){
                    title += " ? ";
                }
                title += "Proyecto  "+ n.attributes.project;
            }

            

            if( typeof(n.attributes.assignedTo)!="undefined" ){
                idcomponent+="_AS"+assignedTo;
                title += " ? Asignados a  "+assignedTo;
            }

            if( typeof(n.attributes.reportedBy)!="undefined" ){
                idcomponent+="_R"+reportedBy;

                title += " ? Reportador por  "+reportedBy;
            }


            if( typeof(n.attributes.actionTicket)!="undefined" ){
                idcomponent+="_E"+actionTicket;
                title+=" ? Estado  "+actionTicket;
            }


           
            
            /*
            * Todo debe quedar de esta manera
            **/
            if( Ext.getCmp('tab-panel').findById(idcomponent) ){
                Ext.getCmp('tab-panel').setActiveTab(idcomponent);
            }else{
                //alert( action );
                switch( action ){
                    case "adminProject":
                        /*
                        * Se muestran la administracion de proyectos
                        */
                        var newComponent = new PanelProyectos({id:idcomponent,
                                                              idgroup: idgroup,
                                                              idproject: idproject,
                                                              actionTicket: actionTicket,
                                                              assignedTo: assignedTo,
                                                              reportedBy: reportedBy,
                                                              title: "Admin "+title,
                                                              closable: true,
                                                              readOnly: this.readOnly
                                                             });
                        break;
                    case "calendar":
                        /*
                        * Se muestran la administracion de proyectos
                        */
                        var newComponent = new PanelProyectos({id:idcomponent,
                                                              idgroup: idgroup,
                                                              idproject: idproject,
                                                              actionTicket: actionTicket,
                                                              assignedTo: assignedTo,
                                                              reportedBy: reportedBy,
                                                              title: "Admin "+title,
                                                              closable: true,
                                                              readOnly: this.readOnly
                                                             });
                        break;
                    default:

                        /*
                        * Se muestran el panel de tickets de acuerdop al criterio
                        */
                        var newComponent = new PanelReading({id:idcomponent,
                                                              idgroup: idgroup,
                                                              idproject: idproject,
                                                              actionTicket: actionTicket,
                                                              assignedTo: assignedTo,
                                                              reportedBy: reportedBy,
                                                              title: title,
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
    }
    
});

</script>