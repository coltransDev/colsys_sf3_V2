<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>

<script type="text/javascript">


    PanelMasterAntecedentes = function( config ){

        Ext.apply(this, config);

    

        this.columns = [
            {
                header: "Reporte",
                dataIndex: 'consecutivo',
                //hideable: false,
                width: 63,
                sortable: true,
                renderer: this.formatItem

            },
            {
                header: "Cliente",
                dataIndex: 'cliente',
                //hideable: false,
                sortable: true,
                width: 280

            },
            {
                header: "Proveedor",
                dataIndex: 'login',
                hideable: false,
                sortable: true,
                width: 80
            }


        ];


        this.record = Ext.data.Record.create([
            {name: 'sel', type: 'bool'},
            {name: 'idreporte', type: 'integer', mapping: 'r_ca_idreporte'},
            {name: 'consecutivo', type: 'string', mapping: 'r_ca_consecutivo'},
            {name: 'cliente', type: 'string', mapping: 'cl_ca_compania'}
            

        ]);

        this.store = new Ext.data.GroupingStore({
            autoLoad : true,
            url: '<?= url_for("antecedentes/datosPanelMasterAntecedentes?master=".$master) ?>',
            baseParams : {              
            },
            reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record
        ),
            sortInfo:{field: 'consecutivo', direction: "ASC"}
            //groupOnSort: true,
            //groupField: 'action'
        });


        /*
        this.tbar = [
           
        ];*/

        PanelMasterAntecedentes.superclass.constructor.call(this, {
            loadMask: {msg:'Cargando...'},
            //boxMinHeight: 300,
            enableDragDrop:true,
            id: 'master-antecedentes',
            //tbar: this.tbar,
            view: new Ext.grid.GroupingView({
                emptyText: "Arrastre un reporte aca para asignarlo a este master",
                forceFit:true,
                enableRowBody:true,
                hideGroupedColumn: true
                //showPreview:true,
                //hideGroupedColumn: true,


            }),
            listeners:{
                //rowcontextmenu: this.onRowcontextMenu,
                rowdblclick : this.onRowDblclick
            }

        });
        this.getView().getRowClass = this.getRowClass;

    };

    Ext.extend(PanelMasterAntecedentes, Ext.grid.GridPanel, {
        onRender:function() {
            PanelReportesAntecedentes.superclass.onRender.apply(this, arguments);

            this.dz = new GridDropZone(this, {ddGroup:this.ddGroup || 'GridDD'});
        }, // eo function onRender

        onRecordsDrop:Ext.emptyFn,

        
        recargar: function(){

            if(this.store.getModifiedRecords().length>0){
                if(!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
                    return 0;
                }
            }
            this.store.reload();
        },

        formatItem: function(value, p, record) {
            return String.format(
            '<b>{0}</b>',
            value
        );
        },
        

        onRowDblclick: function( grid , rowIndex, e ){
            record =  this.store.getAt( rowIndex );
            if( typeof(record)!="undefined" ){
                var win = Ext.getCmp("editar-ticket-win");
                if( win ){
                    win.close();
                }
                var win = new EditarTicketWindow({idticket: record.data.idticket
                });
                win.show();
            }
        }
       

    });

</script>