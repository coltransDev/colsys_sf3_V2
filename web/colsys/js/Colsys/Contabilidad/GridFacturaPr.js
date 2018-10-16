var comboBoxRenderer = function(combo) {
    return function(value) {   
    var idx = combo.store.find(combo.valueField, value);
    var rec = combo.store.getAt(idx);
    return (rec === null ? value : rec.get(combo.displayField) );

    };
}
Ext.define('Colsys.Contabilidad.GridFacturaPr', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Contabilidad.GridFacturaPr',
    autoHeight: true,
    autoScroll: true,
    //height: 600,
    frame: true,
    features: [{
            ftype: 'summary',
            dock: 'bottom'
        }],
    plugins: [{
        ptype : 'cellediting',
        clicksToEdit: 1,
        id: 'myplugin'
    }],
    selModel: {
         selType: 'cellmodel'
    },
    listeners: {
        beforerender: function (ct, position) { 
            
            
            var me = this;
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        model: Ext.define('modelStatus', {
                            extend: 'Ext.data.Model',
                            id: 'modelStatus',
                            fields: [
                                {name: 'iddetalle'+ this.idgrid, mapping: 'ca_iddetalle', type: 'int'},
                                {name: 'idconcepto' + this.idgrid, type: 'integer', mapping: 'ca_idconcepto'},
                                {name: 'concepto' + this.idgrid, type: 'string', mapping: 'ca_concepto'},
                                {name: 'idcomprobante' + this.idgrid, mapping: 'idcomprobante', type: 'integer'},
                                {name: 'comprobante' + this.idgrid, mapping: 'comprobante', type: 'string'},
                                {name: 'idmaster' + this.idgrid, type: 'integer', mapping: 'ca_idmaster'},
                                {name: 'referencia' + this.idgrid, type: 'string', mapping: 'ca_referencia'},
                                {name: 'idhouse' + this.idgrid, type: 'integer', mapping: 'ca_idhouse'},
                                {name: 'hbl' + this.idgrid, type: 'string', mapping: 'ca_hbl'},
                                {name: 'neto' + this.idgrid, type: 'float', mapping: 'ca_valor'},
                                {name: 'active'+this.idgrid, type: 'bool'}
                            ]
                        }),                        
                        proxy: {
                            type: 'ajax',
                            url: '/contabilidad/datosConceptosFactPr',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        },
                        autoLoad: false
                    }),
                    [
                        {
                            xtype: 'checkcolumn',
                            header: '',
                            dataIndex: 'active'+this.idgrid,
                            width: 40,
                            editor: {
                                xtype: 'checkbox',
                                cls: 'x-grid-checkheader-editor'
                            }
                        },
                        {
                            id: 'comprobante',
                            dataIndex: 'comprobante'+this.idgrid,
                            //header: 'No factura',
                            dataIndex: 'comprobante',
                            flex: 1,
                            hidden: true

                        },
                        {
                            header: "Concepto",
                            dataIndex: 'concepto' + this.idgrid,                            
                            sortable: false,
                            flex: 1,
                            editor: Ext.create('Colsys.Widgets.wgConceptosMaestra', {
                                id: 'comboConceptos'+me.idgrid,
                                name: 'comboConceptos',
                                compraventa: "ca_compra",
                                selectOnFocus: true,
                                idcomprobante: me.idcomprobante
                            }),
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<span style='font-weight: bold;'>Total</span>";
                            },
                            renderer: comboBoxRenderer(Ext.getCmp('comboConceptos'+me.idgrid))
                        },
                        /*{
                            header: 'Concepto',
                            dataIndex: 'concepto',
                            width: 250,
                            editor:
                                    Ext.create('Colsys.Widgets.wgConceptosMaestra', {
                                        id: 'combo-conceptos'+this.idmaster,
                                        name: 'combo-conceptos',
                                        selectOnFocus: true,
                                        idtransporte: this.idtransporte,
                                        idimpoexpo: this.idim   poexpo,
                                        idcomprobante:this.idcomprobante,
                                        compraventa:"ca_venta",
                                        selectOnFocus: true,                                               
                                    }),
                            renderer: comboBoxRenderer(Ext.getCmp('combo-conceptos'+this.idmaster)),
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<b>Total</b>";
                            }
                        },*/
                        {
                            header: "Referencia",
                            hideable: false,
                            dataIndex: 'referencia' + this.idgrid,
                            flex: 1,
                            sortable: false,
                            editor: Ext.create('Colsys.Widgets.WgReferencias', {
                                id: 'comboReferencia'+this.idgrid,
                                name: 'comboReferencia',
                                allowBlank: false,
                                idimpoexpo: this.idimpoexpo,
                                idtransporte: this.idtransporte,
                                forceSelection: true
                            }),
                            renderer: comboBoxRenderer(Ext.getCmp('comboReferencia'+this.idgrid))
                        },
                        {
                            header: "House",
                            hideable: false,
                            dataIndex: 'hbl' + this.idgrid,
                            flex: 1,
                            sortable: false,
                            editor: Ext.create('Colsys.Widgets.wgHouse', {
                                id: 'comboHouse'+this.idgrid,
                                name: 'comboHouse',
                                queryMode: 'local',
                                displayField: 'name',
                                valueField: 'id'
                            }),
                            renderer: comboBoxRenderer(Ext.getCmp('comboHouse'+this.idgrid))
                        },
                        {
                            header: "Valor",
                            dataIndex: 'neto' + this.idgrid,
                            hideable: false,
                            sortable: false,
                            flex: 1,
                            align: 'right',
                            renderer: Ext.util.Format.usMoney,
                            editor: {
                                xtype: 'numberfield',
                                allowBlank: false,
                                //minValue: 0,
                                selectOnFocus: true,
                                listeners: {
                                    blur: function (me, event, eOpts) {

                                    }
                                }
                            },
                            renderer: function (value, metaData, record, rowIdx, colIdx, store, view) {
                                return Ext.util.Format.usMoney(record.get('neto'+this.idgrid));
                            },
                            summaryType: 'sum',              
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
                            }
                        }
                    ]
                    );
        },
        afterrender: function (ct, position){
            var me = this;
            
            if (this.load == false || this.load == "undefined" || !this.load){
                
                idcompr = this.idcomprobante;
                this.store.proxy.extraParams = {
                    idcomprobante: idcompr
                }
                   
                   
                this.store.reload({
                    callback: function (options, success, response) {
                        var res = Ext.util.JSON.decode(response.responseText);
                        
                        if (Ext.getCmp('comboConceptos'+me.idgrid)) {
                            //alert("load:"+this.load)
                            Ext.getCmp('comboConceptos'+me.idgrid).getStore().reload({
                                params: {
                                    transporte: me.idtransporte,
                                    impoexpo: me.idimpoexpo,
                                    idcomprobante: idcompr
                                }
                            });
                        }
                        
                        if (Ext.getCmp('comboReferencia'+me.idgrid)) {
                            //alert("load:"+this.load)
                            Ext.getCmp('comboReferencia'+me.idgrid).getStore().reload({
                                params: {
                                    transporte: me.idtransporte,
                                    impoexpo: me.idimpoexpo
                                }
                            });
                        }
                    }
                });
                this.load = true;
            }
            if(this.estado!="5"){
                tb = new Ext.toolbar.Toolbar();
                tb.add(
                    [    
                        {
                            text: 'Nuevo Concepto',
                            iconCls: 'add',
                            id: 'btn-nvo-concepto' + this.idcomprobante,
                            hidden:(this.idcomprobante=="0")?true:false,
                            handler: function () {
                                var me = this.up('grid');
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
                            text: 'Guardar',
                            iconCls: 'disk',
                            id: 'btn-guardar' + this.idgrid,
                            hidden:(this.idcomprobante=="0")?true:false,
                            handler: function () {
                                
                                var store = this.up('grid').getStore();
                                var idcomprobante = this.up('grid').idcomprobante;
                                var idgrid = this.up('grid').idgrid;
                                var collect = this.up('grid').collect;
                                
                                var r = Ext.create(store.getModel());
                                var fields = new Array();

                                for (i = 0; i < r.fields.length; i++) {
                                    fields.push(r.fields[i].name.replace(idgrid, ""));
                                }

                                changes = [];
                                error = [];
                                arrayConceptos = [];
                                var records = store.getRange();
                                for (var i = 0; i < records.length; i++) {
                                    
                                    r = records[i];

                                    row = new Object();
                                    for (j = 0; j < fields.length; j++) {
                                        eval("row." + fields[j] + "=records[i].data." + fields[j] + idgrid + ";");
                                    }
                                    

                                    if(arrayConceptos.indexOf(row.idconcepto+"."+row.idmaster+"."+row.idhouse) > -1){
                                        error.push("Por favor verificar el ingreso de conceptos repetidos para la misma referencia y house!");
                                    }

                                    if(me.idempresa !== 11 && row.idmaster === 0 && row.idconcepto > 0){
                                        error.push("Por favor asignar una referencia a cada concepto!");
                                    }
                                    
                                    if(r.get("idconcepto"+idgrid)>0 && collect=="on")
                                    {
                                        if( ( r.get("idhouse"+idgrid)=="" || r.get("idhouse"+idgrid)=="0" || r.get("idhouse"+idgrid)=="null" || r.get("idhouse"+idgrid)==null))
                                            error.push("Se debe ingresar un house para los comprobantes collect de la ref:"+ r.get("referencia"+idgrid) );
                                    }

                                    arrayConceptos.push(row.idconcepto+"."+row.idmaster+"."+row.idhouse);
                                    
                                    if (r.isValid() && error.length<1) {                                            
                                        row.id = r.id;
                                        row.idcomprobante = idcomprobante;
                                        row.idempresa = me.idempresa;                                            
                                        changes[i] = row;
                                    }                                    
                                }

                                var str = JSON.stringify(changes);  

                                if(changes.length > 0){
                                    if (error.length < 1) {
                                        var box = Ext.MessageBox.wait('Procesando', 'Guardando Informacion')
                                        Ext.Ajax.request({
                                            url: '/contabilidad/guardarGridFacturaPr',
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
                                                    
                                                    Ext.getCmp('windowFacPr'+res.idcomprobante).close();
                                                    Ext.getCmp('panel-factura-pr'+idgrid).getStore().reload();
                                                }
                                                if (res.errorInfo){
                                                    alert('Se presento el siguiente error: ' + res.errorInfo);                                                    
                                                }
                                                box.hide();                                            

                                            },
                                            failure: function (response, opts) {
                                                Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                box.hide();
                                            }
                                        });
                                    } else {                                        
                                        Ext.MessageBox.alert("Colsys", "Errores: "+error.toSource());
                                    }
                                }else{
                                    Ext.MessageBox.alert("Colsys", error.length<1?"No existen datos para guardar!":error);
                                }
                            }
                        },
                        {
                            text: 'Eliminar',
                            iconCls: 'delete',
                            hidden:(this.idcomprobante=="0")?true:false,
                            id: 'btn-eliminar' + this.idcomprobante,
                            handler: function () {
                                arrayeliminar = [];
                                var store = this.up('grid').getStore();
                                var idgrid = this.up('grid').idgrid;
                                var r = Ext.create(store.getModel());
                                var fields = new Array();

                                for (i = 0; i < r.fields.length; i++) {
                                    fields.push(r.fields[i].name.replace(idgrid, ""));
                                }

                                for (var i = 0; i < store.getCount(); i++) {
                                    record = store.getAt(i);
                                    row = new Object();
                                    for (j = 0; j < fields.length; j++) {
                                        eval("row." + fields[j] + "=record.get('"+ fields[j] + idgrid+"');");
                                    }

                                    if (row.active === true) {
                                        arrayeliminar.push(row);
                                    }
                                }
                                if (arrayeliminar.length > 0) {
                                    var str = JSON.stringify(arrayeliminar);
                                    Ext.Ajax.request({
                                        url: '/inoF2/eliminarGridFacturacion',
                                        params: {
                                            datos: str
                                        },
                                        success: function (response, opts) {
                                            var res = Ext.decode(response.responseText);
                                            if (res.success){
                                                Ext.MessageBox.alert("Colsys", "Conceptos Eliminados Correctamente");
                                                store.reload();
                                            } else {
                                                Ext.MessageBox.alert("Colsys", "Error al eliminar");
                                            }
                                        },
                                        failure: function (response, opts) {
                                            Ext.MessageBox.alert("Colsys", "Error al eliminar");
                                        }
                                    });
                                }
                            }
                        },
                        {
                            text: 'Recargar',
                            iconCls: 'refresh',
                            id:'btn-guardarrecarga'+this.idgrid,
                            handler : function(){
                                this.up("grid").getStore().reload();
                            }
                        }
                    ]);
                this.addDocked(tb);
            }
        },
        edit: function (editor, e, eOpts) {
            var store = this.getStore();
            record = e.record;

            var records = store.getRange();
            error=false;
            nreg=records.length;
            recordLast = records[records.length - 1];
            if (e.field === "concepto" +this.idgrid){
                store.data.items[e.rowIdx].set('idconcepto'+this.idgrid, e.value);
                record = e.record;
                var records = store.getRange();
                recordLast = records[records.length - 1];
                if (recordLast.get("concepto") != 0){
                    var r = Ext.create(store.getModel());
                    r.set('comprobante', record.get('comprobante'));
                    r.set('idcomprobante', record.get('idcomprobante'));
                    r.set('idhouse', record.get('idhouse'));
                    r.set('idccosto', record.get('idccosto'));
                }
            }
            if (e.field === 'neto' + this.idgrid) {
                eval("var idconcepto = record.data.idconcepto"+this.idgrid+";");
                eval("var neto = record.data.neto"+this.idgrid+";");
                if(idconcepto>0 && neto != 0)
                {
                    for (var j = 1; j < nreg; j++) {
                        var recordcurrent = records[j];
                        eval("var idconceptoCurr = recordcurrent.data.idconcepto"+this.idgrid+";");
                        eval("var netoCurr = recordcurrent.data.idconcepto"+this.idgrid+";");

                        if (idconceptoCurr!=="" || netoCurr!=="") {
                            error=true;
                        }
                    }
                    if(error==false){
                        var r = Ext.create(store.getModel());
                        r.set('comprobante', record.get('comprobante'));
                        r.set('idcomprobante', record.get('idcomprobante'));
                        r.set('idhouse', record.get('idhouse'));
                        r.set('idccosto', record.get('idccosto'));
                        store.insert(store.count(),r);
                        var rowIdx = this.getSelectionModel().getPosition().rowIdx;
                        this.getSelectionModel().select({
                            row: rowIdx+1,
                            column: 1
                        });
                        cellEditing = this.getPlugin('myplugin');
                        cellEditing.startEditByPosition({
                            row: rowIdx+1,
                            column: 1
                        });
                    }
                }
            }
            if (e.field === 'referencia'+ this.idgrid) {
                store.data.items[e.rowIdx].set('idmaster'+this.idgrid, e.value);
                eval("var idmaster = e.record.data.referencia" + this.idgrid + ";");
                Ext.getCmp("comboHouse"+this.idgrid).idmaster = idmaster;
                Ext.getCmp("comboHouse"+this.idgrid).getStore().load({
                    params: {
                        idmaster: idmaster
                    }
                });
            }
            if (e.field === 'hbl'+ this.idgrid) {
                store.data.items[e.rowIdx].set('idhouse'+this.idgrid, e.value);
            }
        },
        validateedit: function(editor, e, eOpts){
                }
            }
});