<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("widgets", "widgetCostos",array("referencia"=>$referencia));
include_component("widgets", "widgetIds",array("referencia"=>$referencia));
?>
<script type="text/javascript">
    GridCostosPanel = function( config ){

        Ext.apply(this, config);
        this.columns = [
            {
                header: "Costo",
                dataIndex: 'costo',
                //hideable: false,
                width: 120,
                sortable: true,
                editor: new WidgetCosto()
            },
            {
                header: "Factura",
                dataIndex: 'factura',
                sortable: true,
                width: 60,
                editor: new Ext.form.TextField()
            },            
            {
                header: "Fch.Fact",
                dataIndex: 'fchfactura',
                //hideable: false,
                sortable: true,
                width: 60,
                editor: new Ext.form.DateField()
            }
            ,{
                header: "Proveedor",
                dataIndex: 'proveedor',
                //hideable: false,
                sortable: true,
                width: 100,
                editor: new WidgetIds()
            },
            {
                header: "Mon",
                dataIndex: 'moneda',
                //hideable: false,
                width: 20,
                sortable: true,                
                editor: new WidgetMoneda()
            },
            {
                header: "Neto",
                dataIndex: 'neto',
                //hideable: false,
                sortable: true,
                width: 70,
                editor: new Ext.form.TextField()
            },
            {
                header: "T.cambio",
                dataIndex: 'tcambio',
                sortable: true,
                width: 60,
                editor: new Ext.form.NumberField()
            },
            {
                header: "valor Neto",
                dataIndex: 'vneto',
                hideable: false,
                sortable: true,
                width: 80,
                align: 'right',
                renderer: Ext.util.Format.numberRenderer('0,0.00')

            },
            {
                header: "Mon",
                dataIndex: 'monedav',
                //hideable: false,
                width: 20,
                sortable: true,                
                editor: new WidgetMoneda()
            },
            {
                header: "Venta",
                dataIndex: 'venta',
                //hideable: false,
                sortable: true,
                width: 70,
                editor: new Ext.form.TextField()
            },
            {
                header: "T.cambio",
                dataIndex: 'tcambiov',
                sortable: true,
                width: 60,
                editor: new Ext.form.NumberField()
            },
            {
                header: "Valor venta",
                dataIndex: 'vventa',
                hideable: false,
                sortable: true,
                width: 80,
                align: 'right',
                renderer: Ext.util.Format.numberRenderer('0,0.00')
              }
        ];

        this.record = Ext.data.Record.create([            
            {name: 'idinocosto', type: 'integer', mapping: 'c_ca_idinocosto'},
            {name: 'idmaster', type: 'string', mapping: 'c_ca_idmaster'},
            {name: 'idcosto', type: 'string', mapping: 'c_ca_idcosto'},
            {name: 'costo', type: 'string', mapping: 'cs_ca_concepto'},
            {name: 'factura', type: 'string', mapping: 'c_ca_factura'},
            {name: 'fchfactura', type: 'string', mapping: 'c_ca_fchfactura'},
            {name: 'idproveedor', type: 'string', mapping: 'c_ca_idproveedor'},
            {name: 'proveedor', type: 'string', mapping: 'i_ca_nombre'},
            {name: 'neto', type: 'string', mapping: 'c_ca_neto'},
            {name: 'tcambio_usd', type: 'string', mapping: 'c_ca_tcambio_usd'},
            
            {name: 'venta', type: 'string', mapping: 'c_ca_venta'},
            {name: 'tcambiov_usd', type: 'string', mapping: 'c_ca_tcambiov_usd'},

            {name: 'orden', type: 'string' }
        ]);

        this.store = new Ext.data.GroupingStore({
            autoLoad : true,
            url: '<?= url_for("inoF/datosGridCostosPanel") ?>',
            baseParams : {
                idmaster: this.idmaster,
                modo: this.modo
            },
            reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record),
            sortInfo:{field: 'orden', direction: "ASC"}
        });

        this.tbar = [
           {
                text: 'Guardar',
                iconCls: 'disk',
                handler: this.guardar,
                scope: this
            },
            {
                text: 'Recargar',
                iconCls: 'refresh',
                handler : this.recargar,
                scope: this
            }
        ];

        GridCostosPanel.superclass.constructor.call(this, {
            clicksToEdit: 1,
            stripeRows: true,
            autoHeight:true,
            loadMask: {msg:'Cargando...'},
            id: 'costos-ino',
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

    Ext.extend(GridCostosPanel, Ext.grid.EditorGridPanel, {               
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

            if( e.field == "costo"){
                store.each( function( r ){
                    if( r.data.idcosto==e.value ){
                        if( !rec.data.idinocosto  ){
                            var newRec = new recordReportes({
                                costo: '+',
                                orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                            });                            
                            storeReportes.addSorted(newRec);
                            storeReportes.sort("orden", "ASC");
                        }
                        e.value = r.data.costo;
                        rec.set( "idcosto",r.data.idcosto);
                        return true;
                    }
                });
            }else if( e.field == "costo"){
                store.each( function( r ){
                    if( r.data.idcosto==e.value ){
                        if( !rec.data.idinocosto  ){
                            var newRec = new recordReportes({
                                costo: '+',
                                orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                            });

                            storeReportes.addSorted(newRec);
                            storeReportes.sort("orden", "ASC");
                        }

                        e.value = r.data.costo;
                        rec.set( "idcosto",r.data.idcosto);
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
            e.stopEvent(); //Evita que se despliegue el menu con el boton izquierdo
            var store = this.store;
                        
            if(!this.menu){
                this.menu = new Ext.menu.Menu({
                    enableScrolling : false,
                    items: [
                        {
                            text: 'Eliminar',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                                if( confirm("Esta seguro?") ){
                                    if( this.ctxRecord.data.idreporte  && this.numRef){
                                       // alert(this.ctxRecord.data.idreporte+"-"+ this.numRef);
                                       var id=this.ctxRecord.id;
                                        Ext.Ajax.request(
                                        {
                                            waitMsg: 'Guardando cambios...',
                                            url:'<?=url_for("inoF/eliminarCosto")?>',
                                            params : {
                                                referencia: this.numRef,
                                                idreporte: this.ctxRecord.data.idreporte
                                            },
                                            failure:function(response,options){
                                                alert( response.responseText );
                                                success = false;
                                            },
                                            success:function(response,options){
                                                var res = Ext.util.JSON.decode( response.responseText );
                                                //if( res.success ){
                                                    r = store.getById(id );
                                                    store.remove( r );
                                                //}
                                            }
                                        });
                                    }else
                                    {
                                        r = store.getById( this.ctxRecord.id );
                                        store.remove( r );
                                    }
                                }
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