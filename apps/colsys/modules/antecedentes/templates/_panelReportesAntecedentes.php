<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>

<script type="text/javascript">


    PanelReportesAntecedentes = function( config ){

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
            url: '<?= url_for("antecedentes/datosPanelReportesAntecedentes") ?>',
            enableDragDrop:true,
            baseParams : {
                idproject: this.idproject,
                idgroup: this.idgroup,
                actionTicket: this.actionTicket,
                assignedTo: this.assignedTo,
                reportedBy: this.reportedBy
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





        PanelReportesAntecedentes.superclass.constructor.call(this, {
            loadMask: {msg:'Cargando...'},
            //boxMinHeight: 300,
            id: 'reportes-antecedentes',
            enableDragDrop:true,
            view: new Ext.grid.GroupingView({
                emptyText: "No hay datos",
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

    Ext.extend(PanelReportesAntecedentes, Ext.grid.GridPanel, {
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
        ,
        getRowClass : function(record, rowIndex, p, ds){
            p.cols = p.cols-1;

            var color;
            /*if( record.data.action=="Cerrado" ){
            color = "blue";
        }else{
            if( record.data.tipo=="Defecto" ){
                color = "pink";
            }else{
                if( record.data.ultseg ){
                    switch( record.data.priority ){
                        case "Media":
                            color = "yellow";
                            break;
                        case "Alta":
                            color = "pink";
                            break;
                        default:
                            color = "";
                            break;
                    }
                }else{
                    color = "green";
                }
            }
        }
        color = "row_"+color;*/
            return this.state[record.id] ? 'x-grid3-row-expanded '+color : 'x-grid3-row-collapsed '+color;
        }


    });

</script>