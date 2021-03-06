<?
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
/**
 * PanelConsulta object definition
 **/
PanelConsulta = function( config ){
    Ext.apply(this, config);

    PanelConsulta.superclass.constructor.call(this, {
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
            dataUrl:'<?=url_for("tasks/datosPanelConsulta")?>'
        }),

        root: new Ext.tree.AsyncTreeNode()
        ,
        listeners:  {
             click : this.onClick
             
        }
    });
}

Ext.extend(PanelConsulta, Ext.tree.TreePanel, {
    onClick: function(n){
        //var sn = this.selModel.selNode || {}; // selNode is null on initial selection
        if( n.leaf ){  // ignore clicks on folders           
            //var nodeoptions = n.id.split("_");
            
            var action = n.attributes.action;
            var idlista = n.attributes.idlista;
         

            //Coloca un identificador unico para evitar que el componente se cree dos veces
            var idcomponent = action;
            var title = "Tareas";
            /*
            * Todo debe quedar de esta manera
            **/
            if( Ext.getCmp('tab-panel').findById(idcomponent) ){
                Ext.getCmp('tab-panel').setActiveTab(idcomponent);
            }else{
                //alert( action );
                switch( action ){                   
                    default:

                        /*
                        * Se muestran el panel de tickets de acuerdop al criterio
                        */
                        var newComponent = new PanelTareas({id:idcomponent,
                                                              title: title,
                                                              idlista: idlista,
                                                              closable: true                                                              
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