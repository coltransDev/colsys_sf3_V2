<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("antecedentes", "widgetReporteAntecedentes");
include_component("antecedentes", "widgetHBLAntecedentes");
include_component("gestDocumental", "widgetUploadButton");
?>

<script type="text/javascript">

    PanelReportesAntecedentes = function( config ){

        Ext.apply(this, config);        

    this.checkColumn=new Ext.grid.CheckColumn({header:'Hbls Dest.', dataIndex:'sel', width:30})
        this.columns = [
            {
                header: "Reporte",
                dataIndex: 'consecutivo',
                //hideable: false,
                width: 63,
                sortable: true,
                renderer: this.formatItem,
                editor: new WidgetReporteAntecedentes({
                    linkModalidad: "modalidad",
                    linkOrigen: "origen",
                    linkDestino: "destino"
                })
            },
            {
                header: "HBL",
                dataIndex: 'hbl',
                sortable: true,
                width: 280,
                editor: new WidgetHBLAntecedentes({
                    linkModalidad: "modalidad",
                    linkOrigen: "origen",
                    linkDestino: "destino"
                })
            },
            {
                header: "Cliente",
                dataIndex: 'cliente',
                //hideable: false,
                sortable: true,
                width: 280
            }
            ,
            this.checkColumn
        ];


        this.record = Ext.data.Record.create([
            {name: 'sel', type: 'bool'},            
            {name: 'idreporte', type: 'integer', mapping: 'r_ca_idreporte'},
            {name: 'consecutivo', type: 'string', mapping: 'r_ca_consecutivo'},
            {name: 'hbl', type: 'string', mapping: 'ic_ca_hbls'},
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
        });

        this.tbar = [
           new WidgetUploadButton({
                text: "Agregar Archivo",
                iconCls: 'arrow_up',
                folder: "<?=base64_encode("tmp")?>",
                filePrefix: "",
                confirm: true,
                callback: "Ext.getCmp('reportes-antecedentes').actFile"
            })
        ];

        PanelReportesAntecedentes.superclass.constructor.call(this, {
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

    Ext.extend(PanelReportesAntecedentes, Ext.grid.EditorGridPanel, {               
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
                                hbl: '',
                                orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                            });

                            newRec.data.concepto = "";
                            
                            //Inserta una columna en blanco al final
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

            if( e.field == "hbl"){
                store.each( function( r ){
                    if( r.data.doctransporte==e.value ){

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
                                hbl: '',
                                orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                            });

                            newRec.data.concepto = "";

                            //Inserta una columna en blanco al final
                            storeReportes.addSorted(newRec);
                            storeReportes.sort("orden", "ASC");

                        }

                        e.value = r.data.doctransporte;
                        rec.set( "consecutivo",r.data.consecutivo);
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
                                            url:'<?=url_for("antecedentes/eliminarReporte")?>',
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
        },
        actFile:function (file)
        {
            Ext.MessageBox.wait('Procesando', '');

            mod=Ext.getCmp("modalidad").getValue();

            //ori=Ext.getCmp("origen").getValue();
            cmp = Ext.getCmp("origen");
            if( cmp ){
                combo=cmp.getRecord();
                ori=combo.data.idtrafico
            }

            des=Ext.getCmp("destino").getValue();

            Ext.Ajax.request(
            {
                url: '<?=url_for("antecedentes/procesarArchivohbls")?>',
                params :	{
                    archivo: file,
                    modalidad: mod,
                    origen: ori,
                    destino: des
                },
                failure:function(response,options){
                    var res = Ext.util.JSON.decode( options.response.responseText );
                    
                    Ext.Msg.hide();
                    success = false;
                    alert("Surgio un problema al procesar el archivo")
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        //alert(res.reportes.toSource());
                        //reportes=Ext.util.JSON.decode(res.reportes);
                        //alert(res.reportes.length);
                        recordReportes = Ext.getCmp('reportes-antecedentes').record;
                        storeReportes=Ext.getCmp('reportes-antecedentes').getStore();
                        for(i=0;i<res.reportes.length;i++)
                        {
                            
                         var newRec = new recordReportes({
                                idreporte: res.reportes[i].ca_idreporte,
                                consecutivo: res.reportes[i].ca_consecutivo,
                                hbl: res.reportes[i].doctransporte,
                                cliente: res.reportes[i].compania                                
                            });
                            storeReportes.addSorted(newRec);
                            storeReportes.sort("orden", "ASC");
                        }

                        alert("Se Proceso correctamente");
                        $("#resul").html("<p>Resumen:</p>"+res.resultado);
                        //location.href="/antecedentes/listadoReferencias/format/maritimo";
                    }
                }
            });
        }        
    });

</script>
