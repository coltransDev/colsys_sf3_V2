var facturaPr = null;
Ext.define('Colsys.Contabilidad.PanelFacturacionPr', {    
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Contabilidad.PanelFacturacionPr',
    autoScroll: true,
    //height: 1200,
    layout: {
        type: 'vbox',       // Arrange child items vertically
        align: 'stretch',    // Each takes up full width
        padding: 5
    },
    defaults: {
        frame: true        
    },
    listeners: {        
        render: function (me, eOpts) {
            //var me = this;
            console.log(me);
            if (this.permisos.Crear == true ) {
                tb = new Ext.toolbar.Toolbar();
                tb.add(
                        [{
                            text: 'Agregar',
                            iconCls: 'add',
                            handler: function () {
                                this.up('panel').ventanaFac(null)
                            }
                        }
                    ]);

                tb.add({
                            text: 'Recargar',
                            iconCls: 'refresh',
                            handler: function () {
                                Ext.getCmp('panel-factura-pr' + me.idpanel).getStore().reload();
                            }
                },
                Ext.create('Ext.form.ComboBox', {
                    fieldLabel: 'Opciones',
                    id:'opcion'+this.idmaster,
                    name:'opcion'+this.idmaster,
                    store: Ext.create('Ext.data.Store', {
                        fields: ['id', 'name'],
                        data : [
                            {"id":"1", "name":"Generar"},
                            {"id":"2", "name":"Duplicar"},
                            {"id":"3", "name":"Imprimir"}
                        ]
                    }),
                    width:150,
                    labelWidth:50,
                    queryMode: 'local',
                    displayField: 'name',
                    valueField: 'id'
                }),
                {
                    xtype: 'button',
                    text: 'Enviar',
                    handler: function() {

                        var box = Ext.MessageBox.wait('Procesando', 'Enviando Datos')
                        var n = $( ".checked_"+me.idmaster+":checked" );
                        dat="";
                        for(i=0;i<n.length;i++)
                        {
                            if(dat!="")
                                dat+=","
                            dat+=n[i].value;
                            //console.log(n[i].value)
                        }
                        //console.log(dat);
                        opcion=Ext.getCmp("opcion"+me.idmaster).getValue();

                        if(dat!== ""){
                            switch(opcion){
                                case "1":                            
                                    Ext.Ajax.request({
                                        url: '/inoF2/generarComprobante',
                                        params: {
                                            idcomprobante: "["+dat+"]"
                                        },                                
                                        success: function (response, opts) {
                                            box.hide();
                                            var obj = Ext.decode(response.responseText);
                                            obj=obj.resul;
                                            message = "";
                                            
                                            $.each(obj, function (key, val) {                                            
                                                if (val.Status != "0")                                                
                                                    message += "**** Factura con Errores" + val.Message + "**** | ";
                                                else
                                                    message += "Facturas y Costos registrados Ok DocEntry: " + val.DocEntry + " | ";  
                                            });
                                            
                                            Ext.MessageBox.alert("Colsys", message);

                                            Ext.getCmp('panel-factura-' + me.idmaster).getStore().reload();

                                        },
                                        failure: function (response, opts) {
                                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                            box.hide();
                                        }
                                    });
                                break;
                                case "2":
                                    Ext.Ajax.request({
                                        url: '/inoF2/duplicarComprobante',
                                        params: {
                                            idcomprobante: "["+dat+"]"
                                        },                                
                                        success: function (response, opts) {
                                            var obj = Ext.decode(response.responseText);                                    
                                            if (obj.errorInfo )
                                            {
                                                Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                            }
                                            else
                                            {
                                                Ext.getCmp('panel-factura-' + me.idmaster).getStore().reload();
                                            }
                                            box.hide();

                                        },
                                        failure: function (response, opts) {
                                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                            box.hide();
                                        }
                                    });
                                break;
                                case "3":
                                    url="/inocomprobantes/generarComprobantePDF/id/"+"["+dat+"]";
                                    window.open(url);
                                    box.hide();
                                    break;
                            }
                        }else{
                            box.hide();
                            Ext.MessageBox.alert("Colsys", "Por favor seleccione al menos una opci\u00F3n!");                        
                        }
                    }
                });
                this.addDocked(tb);
            }
            this.add(
                Ext.create('Colsys.Contabilidad.PanelFacturaPr', {
                    id: 'panel-factura-pr'+me.idpanel,
                    //title: 'Factura de Proveedores Internacionales',
                    idpanel: me.idpanel                    
                })
            )
        }
    },
    ventanaFac: function (record, tipo){
        //console.log('idpanel'+this.idpanel);
        idcomprobante = record?record.data.idcomprobante:null;
        if (facturaPr === null){
            facturaPr = Ext.create('Ext.Window', {
                title: 'Factura Proveedor Internacional',
                width: 800, 
                height: 300,
                autoHeight: true,
                closeAction: 'destroy',                
                id: "win-factura-cabecera"+this.idpanel,
                name: "win-factura-cabecera",                
                defaults: {
                    frame: true,
                    bodyPadding: 5
                },
                layout: {
                    type: 'vbox',
                    pack: 'start',
                    align: 'stretch'
                },
                bodyPadding: 5,
                items: [
                    Ext.create('Colsys.Contabilidad.FormFacturaPr', {
                        id: 'form-factura-pr'+this.idpanel,                        
                        idpanel: this.idpanel,
                    })
                ],
                listeners: {
                    close: function (win, eOpts) {
                        facturaPr = null;
                    }
                }
            });
        }
        if (record !== null)
            Ext.getCmp("form-factura-pr" + this.idpanel).cargar(idcomprobante);
        else
            Ext.getCmp("form-factura-pr" + this.idpanel).getForm().reset();            
        
        facturaPr.show();
    }
});