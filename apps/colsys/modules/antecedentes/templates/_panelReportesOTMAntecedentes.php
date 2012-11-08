<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("antecedentes", "widgetReporteAntecedentes");
include_component("antecedentes", "widgetHBLAntecedentes");
?>

<script type="text/javascript">

    PanelReportesOTMAntecedentes = function( config ){

        Ext.apply(this, config);        

    this.checkColumn=new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30});
    this.checkColumn.on('click', this.onClickCH);
    //this.checkColumn.fireEvent('click', this.onClickCH, this);
        this.columns = [
            {
                header: "Reporte",
                dataIndex: 'consecutivo',
                //hideable: false,
                width: 63,
                sortable: true                
            },
            {
                header: "HBL",
                dataIndex: 'hbl',
                sortable: true,
                width: 280
            },
            {
                header: "Cliente",
                dataIndex: 'cliente',
                //hideable: false,
                sortable: true,
                width: 280
            },
            {
                header: "Origen",
                dataIndex: 'origen',
                sortable: true,
                width: 280
            }
            ,
            {
                header: "Fecha Arribo",
                dataIndex: 'fecha_arribo',
                //hideable: false,
                sortable: true
            },
            {
                header: "Bodega",
                dataIndex: 'bodega',
                //hideable: false,
                sortable: true
            },
            {
                header: "muelle",
                dataIndex: 'muelle',
                //hideable: false,
                sortable: true
            },
            {
                header: "Piezas",
                dataIndex: 'piezas',            
                sortable: true
            },
            {
                header: "Volumen",
                dataIndex: 'volumen',            
                sortable: true
            },
            {
                header: "Peso",
                dataIndex: 'peso',            
                sortable: true
            }
            ,
            this.checkColumn
        ];

        this.record = Ext.data.Record.create([
            {name: 'sel', type: 'bool'},
            {name: 'idreporte', type: 'integer', mapping: 'r_ca_idreporte'},
            {name: 'consecutivo', type: 'string', mapping: 'ca_consecutivo'},
            {name: 'cliente', type: 'string', mapping: 'cl_ca_compania'},
            {name: 'origen', type: 'string', mapping: 'r_ca_origen'},            
            {name: 'piezas', type: 'numeric', mapping: 'ca_numpiezas'},
            {name: 'volumen', type: 'string', mapping: 'ca_volumen'},
            {name: 'peso', type: 'string', mapping: 'ca_peso'},
            {name: 'hbl', type: 'string', mapping: 'ca_hbl'},
            {name: 'fecha_arribo', type: 'string', mapping: 'ca_fcharribo'},
            {name: 'bodega', type: 'string', mapping: 'ca_bodega'},
            {name: 'muelle', type: 'string'},
            {name: 'hbl', type: 'string', mapping: 'ca_hbl'},
            {name: 'orden', type: 'string' }
        ]);

        this.store = new Ext.data.GroupingStore({
            autoLoad : false,
            url: '<?= url_for("antecedentes/datosPanelReportesAntecedentesOTM") ?>',            
            reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record),
            sortInfo:{field: 'orden', direction: "ASC"},
            groupField:'origen'
        });

        PanelReportesOTMAntecedentes.superclass.constructor.call(this, {
            clicksToEdit: 1,
            stripeRows: true,
            loadMask: {msg:'Cargando...'},            
            id: 'reportes-antecedentes',
            plugins: [this.checkColumn],
            view: new Ext.grid.GroupingView({
                emptyText: "No hay datos",
                forceFit:true,
                enableRowBody:true,
                hideGroupedColumn: true
            }),
            listeners:{
                rowcontextmenu: this.onRowContextMenu,
                validateedit: this.onValidateEdit
            }
        });
        this.getView().getRowClass = this.getRowClass;
    };

    Ext.extend(PanelReportesOTMAntecedentes, Ext.grid.EditorGridPanel, {
        onClickCH:function(a,b,record)
        {
            var grid = Ext.getCmp("reportes-antecedentes");
            
            var records = grid.getStore().getRange();            
            peso=piezas=volumen=0;
            //alert(records.length);
            for( var i=0; i< records.length; i++ ){
                
                if(  records[i].data.sel=="true" || records[i].data.sel==true ){
                    //alert(records[i].data.toSource());
                    peso+=parseFloat(records[i].data.peso);
                    piezas+=parseFloat(records[i].data.piezas);
                    volumen+=parseFloat(records[i].data.volumen);
                }
            }
            //alert(peso);
            $("#ele_peso").html(peso);
            $("#ele_piezas").html(piezas);
            $("#ele_volumen").html(volumen);
            //alert(record.data.toSource());
        },
        recargar: function(){
            if(this.store.getModifiedRecords().length>0){
                if(!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
                    return 0;
                }
            }
            this.store.reload();
        },
        getRowClass : function(record, rowIndex, p, ds){
            p.cols = p.cols-1;
            var color;
            return this.state[record.id] ? 'x-grid3-row-expanded '+color : 'x-grid3-row-collapsed '+color;
        },

        /*
         * Cambia el valor que se toma de los combobox y copia el valor em otra columna,
         * tambien inserta otra columna en blanco para que el usuario continue digitando
         */
        onValidateEdit: function(e){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;
            storeReportes = this.store;
            recordReportes = this.record;
            alert(e.field);
            if( e.field == "consecutivo"){               
                store.each( function( r ){
                    if( r.data.idreporte==e.value ){
                        
                        if( r.data.referencia ){
                            alert("El reporte que esta asociado a la referencia "+r.data.referencia);
                            e.value = "";
                            return false;
                        }

                        if( !rec.data.idreporte  ){
                            var newRec = new recordReportes({
                                consecutivo: '+',
                                hbl: '',
                                orden: 'Z'
                            });

                            newRec.data.concepto = "";
                            storeReportes.addSorted(newRec);
                            storeReportes.sort("orden", "ASC");
                        }
                        
                        e.value = r.data.consecutivo;
                        rec.set( "idreporte",r.data.idreporte);
                        rec.set( "cliente",r.data.compania);
                        rec.set( "hbl",r.data.doctransporte);
                        return true;
                    }
                });
            }
        },
        /*
        * Menu contextual que se despliega sobre una fila con el boton derecho
        */
        onContextHide: function(){
            if(this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
        },
        onRowContextMenu: function(grid, index, e){
            rec = grid.store.getAt(index);
            e.stopEvent();
            var store = this.store;
            if(!this.menu){
                this.menu = new Ext.menu.Menu({
                    enableScrolling : false,
                    items: [                        
                        {
                            text: 'Ver Reporte',
                            iconCls: 'page_white_acrobat',
                            scope:this,
                            handler: function(){
                                window.open("/reportesNeg/verReporte/id/"+this.ctxRecord.data.idreporte);
                            }
                        }
                    ]
                });
            }
            this.menu.on('hide', this.onContextHide, this);
            if(this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
            this.ctxRecord = rec;
            this.ctxRow = this.view.getRow(index);
            Ext.fly(this.ctxRow).addClass('x-node-ctx');
            this.menu.showAt(e.getXY());
        }
        
    });
</script>