<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("antecedentes", "widgetReporteAntecedentes");
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
                sortable: false,
                renderer: this.formatItem,
                editor: new WidgetReporteAntecedentes({
                    linkModalidad: "modalidad",
                    linkOrigen: "origen",
                    linkDestino: "destino"
                })

            },
            {
                header: "Cliente",
                dataIndex: 'cliente',
                //hideable: false,
                sortable: false,
                width: 280

            }

        ];


        this.record = Ext.data.Record.create([
            {name: 'sel', type: 'bool'},
            {name: 'idreporte', type: 'integer', mapping: 'r_ca_idreporte'},
            {name: 'consecutivo', type: 'string', mapping: 'r_ca_consecutivo'},
            {name: 'cliente', type: 'string', mapping: 'cl_ca_compania'},
            {name: 'orden', type: 'string' }
            

        ]);

        this.store = new Ext.data.GroupingStore({

            autoLoad : true,
            url: '<?= url_for("antecedentes/datosPanelReportesAntecedentes") ?>',            
            baseParams : {
                numRef: this.numRef
            },
            reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record),

            sortInfo:{field: 'orden', direction: "ASC"}
            //groupOnSort: true,
            //groupField: 'action'


        });

        PanelReportesAntecedentes.superclass.constructor.call(this, {
            loadMask: {msg:'Cargando...'},
            //boxMinHeight: 300,
            id: 'reportes-antecedentes',            
            view: new Ext.grid.GroupingView({
                emptyText: "No hay datos",
                forceFit:true,
                enableRowBody:true,
                hideGroupedColumn: true
                //showPreview:true,
                //hideGroupedColumn: true,


            }),
            listeners:{
                rowcontextmenu: this.onRowContextMenu,
                validateedit: this.onValidateEdit,
                rowdblclick : this.onRowDblclick
            }

        });
        this.getView().getRowClass = this.getRowClass;

    };

    Ext.extend(PanelReportesAntecedentes, Ext.grid.EditorGridPanel, {
               
        recargar: function(){

            if(this.store.getModifiedRecords().length>0){
                if(!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
                    return 0;
                }
            }
            this.store.reload();
        },
        

        onRowDblclick: function( grid , rowIndex, e ){
            
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
                      
           
            if( e.field == "consecutivo"){               
                store.each( function( r ){
                    if( r.data.idreporte==e.value ){

                       
                        
                        if( r.data.referencia ){
                            alert("El reporte que esta asociado a la referencia "+r.data.referencia);
                            e.value = "";
                            return false;
                        }

                        /*if( r.data.idetapa == "99999" ){
                            alert("El reporte que esta seleccionando se encuentra cerrado");
                            e.value = "";
                            return false;
                        }*/

                        if( !rec.data.idreporte  ){
                            var newRec = new recordReportes({
                                consecutivo: '+',
                                orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                            });

                            newRec.data.concepto = "";
                            
                            //Inserta una columna en blanco al final
                            storeReportes.addSorted(newRec);
                            storeReportes.sort("orden", "ASC");

                        }

                        e.value = r.data.consecutivo;
                        rec.set( "cliente",r.data.compania);

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
            var store = this.store
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
                                    r = store.getById( this.ctxRecord.id );
                                    store.remove( r );
                                }
                            }
                        },
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