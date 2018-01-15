winrepgastos = null;

Ext.define('Colsys.Ino.GridConceptosFact', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridConceptosFact',
    width: 840,
    autoHeight: true,
    selModel: {
        selType: 'cellmodel'
    },
    features: [/*{
            id: 'comprobante',
            ftype: 'groupingsummary',
            collapseTip: 'Click para minimizar',
            expandTip: 'Click para expandir',
            //hideGroupedHeader: true,
            totalSummary: 'fixed', // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true, // Default: true
            totalSummaryColumnLines: true // Default: false


        }*/{ftype: 'summary',
            dock: 'bottom'}
    ],
    plugins: [
        {
            ptype : 'cellediting',
            clicksToEdit: 1
        }
    ],
    frame: true,
    listeners: {        
        afterrender: function (ct, position) {            
            me=this;
            
            if (this.load == false || this.load == "undefined" || !this.load)
            {
                
                idcompr = this.idcomprobante;
                this.store.proxy.extraParams = {
                    idcomprobante: idcompr
                }
                
                this.store.reload({
                    callback: function (options, success, response) {
                        var res = Ext.util.JSON.decode(response.responseText);
                        if (Ext.getCmp('combo-conceptos'+me.idmaster)) {
                            //alert("load:"+this.load)
                            Ext.getCmp('combo-conceptos'+me.idmaster).getStore().reload({
                                params: {
                                    transporte: this.idtransporte,
                                    impoexpo: this.idimpoexpo,
                                    idcomprobante: idcompr
                                }
                            });
                        }
                    }
                });
                this.load = true;
            }
            if(this.estado!="5" && this.estado!="8")
            {
                tb = new Ext.toolbar.Toolbar();
                tb.add(
                    [
                        {
                            text: 'Guardar',
                            iconCls: 'add',
                            id: 'btn-guardar' + this.idcomprobante,
                            hidden:(this.idcomprobante=="0")?true:false,
                            handler: function () {
                                
                                error = 0;
                                //alert(error);
                                b = this;
                                b.disable();

                                var grid=this.up('grid');
                                var store =grid.getStore();
                                idmaster =grid.idmaster;
                                
                                


                                var recordsAll = this.up('grid').getStore().getModifiedRecords();
                                var records = this.up('grid').getStore().getRange();
                                var lenght = records.length;
                                changes = [];
                                nreg=records.length;
                                //console.log("nreg: "+nreg)
                                for (var i = 0; i < nreg; i++) {
                                    r=store.findRecord("idconcepto",records[i].data.idconcepto);
                                    if(r)
                                    {
                                        if(r.data.iddetalle!= records[i].data.iddetalle)
                                        {
                                            error++;
                                        }
                                    }
                                    if(grid.idcomprobantegrid)
                                    {                                        
                                        records[i].data.idcomprobante=grid.idcomprobantegrid;
                                        //alert(records[i].data.idcomprobante);
                                        //console.log("ino");
                                    }
                                    //console.log(grid)
                                    //else
                                     //   records[i].data.idcomprobante=grid.idcomprobante
                                    changes[i] = records[i].data;
                                    //console.log(changes[i]);
                                }
                                var str = JSON.stringify(changes);
                                //console.log(error);
                                if (error == 0 || !grid.ino)
                                {
                                    var box = Ext.MessageBox.wait('Procesando', 'Guardando Informacion')
                                    Ext.Ajax.request({
                                        url: '/inoF2/guardarGridFacturacion',
                                        params: {
                                            datos: str
                                        },
                                        success: function (response, opts) {
                                            var res = Ext.decode(response.responseText);

                                            if (res.id && res.success)
                                            {
                                                id = res.id.split(",");
                                                idreg = res.idreg.split(",");
                                                for (i = 0; i < id.length; i++)
                                                {
                                                    var rec = store.getById(id[i]);
                                                    rec.set("iddetalle" + this.idcomprobante, idreg[i]);
                                                    rec.commit();
                                                }
                                                alert('Se guardo Correctamente la informacion');
                                                store.reload();
                                            }
                                            if (res.errorInfo != "")
                                            {
                                                alert('No fue posible el guardar la fila <br>' + res.errorInfo);
                                            }

                                            if(Ext.getCmp('panel-factura-'+idmaster))
                                            {
                                                Ext.getCmp('panel-factura-'+idmaster).getStore().reload();
                                                store.reload();
                                            }else
                                            {
                                                Ext.Ajax.request({
                                                    url: '/inoF2/generarComprobante',
                                                    params: {                            
                                                        "idcomprobante":grid.idcomprobantegrid
                                                    },
                                                    success: function(response, opts) {

                                                        var res = Ext.decode(response.responseText);
                                                        alert("Se genero la Factura con el consecutivo No. "+res.consecutivo);

                                                        var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                                            sorc: "/inocomprobantes/generarComprobantePDF/id/" + grid.idcomprobantegrid
                                                        });
                                                        windowpdf.show();

                                                        var tabpanel = Ext.getCmp('tabpanel1');
                                                        tabpanel.getChildByElement('tab5').close();

                                                         obj = [/*{xtype: 'Colsys.Contabilidad.FormComprobantes', id: 'form-comprobantes', name: 'form-comprobantes', frame: true}
                                                                    ,
                                                                    {xtype: 'Colsys.Contabilidad.GridMovimientosComprobantes', id: 'grid-movimientosComprobantes', name: 'grid-movimientosComprobantes'}
                                                                */
                                                               {
                                                                    xtype: 'Colsys.Ino.FormFactura',
                                                                    id: 'form-panel' + this.idmaster,
                                                                    name: 'form-panel' + this.idmaster,
                                                                    idmaster: this.idmaster,
                                                                    height: 330,
                                                                    width: 800,
                                                                    ino:false
                                                                },
                                                                {
                                                                    xtype: 'Colsys.Ino.GridConceptosFact',
                                                                    id:'id-grid-comprobante',
                                                                    name:'id-grid-comprobante'
                                                                    /*idcomprobante: idcomprobante,
                                                                    idmaster: idmaster*/
                                                                }
                                                                ];

                                                                tabpanel.add(
                                                                    {
                                                                        title: record.data.text,
                                                                        id: 'tab' + record.data.id,
                                                                        itemId: 'tab' + record.data.id,
                                                                        autoScroll: true,
                                                                        items: [
                                                                            {
                                                                                //autoScroll:true,
                                                                                items: [
                                                                                    Ext.create('Ext.panel.Panel', {
                                                                                        //title: 'Registro de Incidente',    
                                                                                        bodyPadding: 10,
                                                                                        //width: 350,
                                                                                        //autoScroll:true,
                                                                                        id: 'tab-form' + record.data.id,
                                                                                        items: obj
                                                                                    })
                                                                                ]
                                                                            }
                                                                        ]
                                                                    }
                                                            ).show();
                                                            tabpanel.setActiveTab('tab' + record.data.id);
                                                    }
                                                });

                                                /*$request->setParameter("idcomprobante", $idcomprobante);
                                                $request->setParameter("info", $info);
                                                $this->executeEnviarSiigoConect($request);*/
                                            }
                                            
                                            box.hide();
                                            b.enable();

                                        },
                                        failure: function (response, opts) {
                                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                            box.hide();

                                            b.enable();
                                        }
                                    });
                                } else {
                                    b.enable();
                                    if (error != 0)
                                        Ext.MessageBox.alert("Colsys", "No se deben repetir conceptos, imposible guardar");

                                }
                            }
                        },    
                        {
                            text: 'Nuevo Concepto',
                            iconCls: 'add',
                            id: 'btn-nvo-concepto' + this.idcomprobante,
                            hidden:(this.idcomprobante=="0")?true:false,
                            handler: function () {
                                 
                                var store = me.getStore();//this.up('grid').getStore();
                                record=me.getStore().getRange(0,0);                                
                                var r = Ext.create(me.getStore().getModel(), {
                                   comprobante: record[0].data.comprobante,
                                   idcomprobante: record[0].data.idcomprobante,
                                   idhouse: record[0].data.idhouse,
                                   idccosto: record[0].data.idccosto
                                   });
                                   store.insert(store.count(),r);
                               }                            
                        },
                        {
                            text: 'Importar',
                            iconCls: 'import',
                            id: 'btn-importar' + this.idcomprobante,
                            hidden:(this.idcomprobante=="0")?true:false,
                            handler: function () {
                                house = this.up('grid').idhouse;
                                master = this.up('grid').idmaster;
                                idcomprobante = this.up('grid').idcomprobante;
                                if (winrepgastos == null) {
                                    winrepgastos = Ext.create('Ext.Window',{
                                        //title: 'Deducciones',
                                        width: 670,
                                        id: 'repgastos' + house,
                                        height: 400,
                                        items: {
                                            xtype: 'Colsys.Ino.GridRepGastos',
                                            idhouse: house,
                                            idmaster: master,
                                            idcomprobante: idcomprobante
                                        },
                                        listeners: {
                                            close: function (win, eOpts) {
                                                winrepgastos = null;
                                            }
                                        }
                                    })
                                }
                                winrepgastos.show();
                            }
                        }, {
                            text: 'Eliminar',
                            iconCls: 'delete',
                            hidden:(this.idcomprobante=="0")?true:false,
                            id: 'btn-eliminar' + this.idcomprobante,
                            handler: function () {
                                arrayeliminar = [];
                                var store = this.up('grid').getStore();
                                for (var i = 0; i < store.getCount(); i++) {
                                    record = store.getAt(i);
                                    if (record.get('active') == true) {
                                        arrayeliminar[i] = record.data;
                                    }
                                }
                                //console.log(arrayeliminar);
                                if (arrayeliminar.length > 0) {
                                    var str = JSON.stringify(arrayeliminar);
                                    //console.log(str)
                                    Ext.Ajax.request({
                                        url: '/inoF2/eliminarGridFacturacion',
                                        params: {
                                            datos: str
                                        },
                                        success: function (response, opts) {
                                            var res = Ext.decode(response.responseText);

                                            if (res.success)
                                            {
                                                Ext.MessageBox.alert("Colsys", "Conceptos Eliminados Correctamente");
                                                store.reload();
                                            } else {
                                                Ext.MessageBox.alert("Colsys", "Error al eliminar");
                                            }

                                            Ext.getCmp('panel-factura-' + idmaster).getStore().reload();

                                        },
                                        failure: function (response, opts) {
                                            Ext.MessageBox.alert("Colsys", "Error al eliminar");
                                        }
                                    });
                                }
                            }
                        }
                    ]
                );
                this.addDocked(tb);
            }
        },
        validateedit: function (editor, e, eOpts)
        {
            var store = this.getStore();            
            record = e.record;                        
            var records = store.getRange();            
            nreg=records.length;
            
            if (e.field == "concepto")
            {   
                
               
                //console.log(isNaN(e.value))
                //console.log(!isNaN(e.value))
                if(isNaN(e.value))
                {
                    alert("Por favor seleccione un concepto");
                    Ext.getCmp('combo-conceptos'+this.idmaster).setValue("");
                    return false;
                }
                else
                {    
                    //console.log("357")
                    for(i=0;i<nreg-1;i++)
                    {   

                        if(e.value==records[i].data.idconcepto)
                        {
                            Ext.getCmp('combo-conceptos'+this.idmaster).setValue("");
                            alert("Este Concepto ya se encuentra registrado, por favor cambielo");
                            return false;
                        }
                    }
                }
                //else
                {
                  /*  console.log("371")
                    Ext.getCmp('combo-conceptos'+this.idmaster).setValue("");
                    //alert("Este Concepto ya se encuentra registrado, por favor cambielo");
                    return false;*/
                }
            }
        }
        ,
        edit: function (editor, e, eOpts)
        {
            var store = this.getStore();            
            record = e.record;            
            error=false;            
            var records = store.getRange();            
            nreg=records.length;
            
            if (e.field == "valor")
            {
                
                if(record.data.idconcepto>0 && record.data.valor>0)
                {   
                    for (var j = 1; j < nreg; j++) {
                        var recordcurrent = records[j];
                        //console.log(recordcurrent);
                        if (recordcurrent.data.idconcepto=="" || recordcurrent.data.valor=="") {                            
                            error=true;
                        }
                    }
                    if(error==false)
                    {
                    
                        var r = Ext.create(store.getModel());
                        r.set('comprobante', record.get('comprobante'));
                        r.set('idcomprobante', record.get('idcomprobante'));
                        r.set('idhouse', record.get('idhouse'));
                        r.set('idccosto', record.get('idccosto'));                    
                        store.insert(store.count(),r);
                    }
                }
            }
            if (e.field == "concepto")
            {            
                store.data.items[e.rowIdx].set('idconcepto', e.value);
                record = e.record;
                //console.log(e);

                recordLast = records[records.length - 1];                
                if (recordLast.get("concepto") != 0)
                {
                    var r = Ext.create(store.getModel());
                    r.set('comprobante', record.get('comprobante'));
                    r.set('idcomprobante', record.get('idcomprobante'));
                    r.set('idhouse', record.get('idhouse'));
                    r.set('idccosto', record.get('idccosto'));
                }               
            
            }            
        },        
        beforerender: function (ct, position) {
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {
                    fields: [
                        {name: 'iddetalle', mapping: 'iddetalle', type: 'int'},
                        {name: 'idhouse', mapping: 'idhouse', type: 'int'},
                        {name: 'idcomprobante', mapping: 'idcomprobante', type: 'int'},
                        {name: 'comprobante', mapping: 'comprobante', type: 'string'},
                        {name: 'fchcomprobante', mapping: 'fchcomprobante', type: 'date', dateFormat: 'Y-m-d'},
                        {name: 'cliente', mapping: 'cliente', type: 'string'},
                        {name: 'doctransporte', mapping: 'doctransporte', type: 'string'},
                        {name: 'idmoneda', mapping: 'idmoneda', type: 'int'},
                        {name: 'moneda', mapping: 'moneda', type: 'string'},
                        {name: 'valor', mapping: 'valor', type: 'float'},
                        {name: 'idconcepto', mapping: 'idconcepto', type: 'int'},
                        {name: 'concepto', mapping: 'concepto', type: 'string'},
                        {name: 'cuentapago', mapping: 'cuentapago', type: 'string'},
                        {name: 'estado', mapping: 'estado', type: 'int'},
                        {name: 'idccosto', mapping: 'idccosto', type: 'int'},
                        {name: 'active', type: 'bool'}
                    ],
                    proxy: {
                        type: 'ajax',
                        url: '/inoF2/datosConceptosFact',                            
                        reader: {
                            type: 'json',
                            rootProperty: 'root'
                        }
                    },
                    groupField: 'comprobante',
                    sorters: [{
                            property: 'comprobante',
                            direction: 'ASC'
                        }],
                    autoLoad: false
                }),
                [
                    {
                        id: 'comprobante',
                        //header: 'No factura',
                        dataIndex: 'comprobante',
                        flex: 1,
                        hidden: true

                    },
                    {
                        xtype: 'checkcolumn',
                        header: '',
                        dataIndex: 'active',
                        width: 40,
                        editor: {
                            xtype: 'checkbox',
                            cls: 'x-grid-checkheader-editor'
                        }
                    },                        
                    {
                        header: 'Concepto',
                        dataIndex: 'concepto',
                        width: 250,
                        editor:
                                Ext.create('Colsys.Widgets.wgConceptosMaestra', {
                                    id: 'combo-conceptos'+this.idmaster,
                                    name: 'combo-conceptos',
                                    selectOnFocus: true,
                                    idtransporte: this.idtransporte,
                                    idimpoexpo: this.idimpoexpo,
                                    idcomprobante:this.idcomprobante,
                                    compraventa:"ca_venta",
                                    //selectOnFocus: true,
                                    //forceSelection: true
                                    //listeners
                                }),
                        renderer: comboBoxRenderer(Ext.getCmp('combo-conceptos'+this.idmaster)),
                        summaryRenderer: function (value, summaryData, dataIndex) {
                            return "<b>Total</b>";
                        }
                    },
                    {
                        header: 'Valor',
                        dataIndex: 'valor',
                        width: 120,
                        align: 'right',
                        renderer: Ext.util.Format.usMoney,
                        editor: {
                            xtype: 'numberfield',
                            allowBlank: false,
                            minValue: 0,
                            selectOnFocus: true,
                            listeners: {
                                blur: function (me, event, eOpts) {

                                }
                            }
                        },
                        renderer: function (value, metaData, record, rowIdx, colIdx, store, view) {
                            return Ext.util.Format.usMoney(record.get('valor'));
                        },
                                summaryType: function (records, values) {
                                    var i = 0,
                                            length = records.length,
                                            total = 0,
                                            record;
                                    for (; i < length; ++i) {
                                        record = records[i];
                                        total += record.get('valor');
                                    }
                                    return total;
                                },
                        summaryRenderer: Ext.util.Format.usMoney
                    }
                ]
            );
        },
        beforeitemcontextmenu: function(view, record, item, index, e)                                       
        {
            e.stopEvent();
            idcomprobante=this.idcomprobante;
            var store=this.store;            
            itemCm = new Array();
            if(record.data.estado<=1)
            {
                itemCm.push(                
                {
                    text: 'Agregar Concepto',
                    iconCls: 'add',
                    handler: function() {
                        
                            var r = Ext.create(store.getModel());
                            r.set('comprobante',record.get('comprobante'));
                            r.set('idcomprobante',record.get('idcomprobante'));
                            r.set('idhouse',record.get('idhouse'));
                            r.set('idccosto',record.get('idccosto'));
                            store.insert(0, r);                         
                    }
                },
                {
                    text: 'Eliminar Concepto',
                    iconCls: 'delete',
                    handler: function() {
                        Ext.MessageBox.confirm('Confirmacion', 'esta seguro de eliminar el concepto', 
                        function(e){
                            if(e == 'yes'){
                               var box = Ext.MessageBox.wait('Procesando', 'Eliminando Concepto')
                               Ext.Ajax.request({
                                   url: '/inoF2/EliminarGridFacturacionPanel',
                                   params: {                            
                                       iddetalle: record.get('iddetalle')
                                   },
                                   success: function(response, opts) {
                                        var obj = Ext.decode(response.responseText);

                                        if(obj.errorInfo!="")
                                            Ext.MessageBox.alert("Colsys", "Se genero el Comprobante No. " + obj.errorInfo);
                                        else
                                            ///Ext.getCmp("grid-facturacion").getStore().reload();
                                            store.reload();
                                        
                                        box.hide();

                                   },
                                   failure: function(response, opts) {
                                       Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                       box.hide();
                                   }
                              });
                            }
                        }
                    )}
                });
            }

            var menu = new Ext.menu.Menu({
                items: itemCm
            }).showAt(e.getXY());
        }
    },
    setIdCc : function (idcc)
    {
        if(this.idcc==idcc)
            this.reloadCombo=false;
        else
            this.reloadCombo=true;
        this.idcc=idcc;
        //Ext.getCmp("combo-conceptos").getStore().reload({params:{"idcc":this.idcc  }});
    },
    setIdComprobante : function (idcomprobante)
    {
//        alert(idcomprobante);
        this.idcomprobantegrid=idcomprobante;
            //alert(this.idcomprobantegrid);
        //Ext.getCmp("combo-conceptos").getStore().reload({params:{"idcc":this.idcc  }});
    }
});