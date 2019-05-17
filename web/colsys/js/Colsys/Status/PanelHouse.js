Ext.define('Colsys.Status.PanelHouse', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Status.PanelHouse',
    autoScroll: true,
    bodyCls: 'app-dashboard1',
    layout: {
        type: 'table',
        columns: 2,
        tableAttrs: {
            style: {
                width: '100%'
            }
        },
        tdAttrs:{
            style: {
                verticalAlign: 'top'                
            }
        }
    },
    scrollable: true,
    defaults: {
        bodyPadding: '10 10',
        border: true,
        frame: true
    },    
    listeners: {
        render: function (me, eOpts) {
            var data = Ext.getCmp('header-panel-' + this.idhouse).data;
            
            this.add(
                {
                    xtype: 'form',
                    manageHeight : true,
                    title: 'Datos Hijo <span style="font-size: 8px;">'+data.cliente+'</span>',
                    colspan: 2,
                    id: 'panel-hijo-' + this.idhouse,
                    margin: '0 10 10 0',
                    layout: {
                        type: 'hbox',
                        pack: 'start',
                        align: 'stretch'
                    },
                    defaults: {
                        frame: true,
                        bodyPadding: 10
                    },
                    items: [{
                            xtype: 'fieldset',
                            border: true,
                            flex: 2,
                            margin: '0 10 0 0',
                            title: 'Mensaje exclusivo para este cliente',
                            items: [{
                                xtype: 'label',
                                id: 'mensaje' + this.idhouse,
                                name: 'mensaje'
                            },{
                                xtype: 'textareafield',
                                id: 'mensaje_cliente' + this.idhouse,
                                name: 'mensaje_cliente',
                                grow: true,
                                anchor: '100%'
                            }]
                        },
                        {
                            xtype: 'fieldset',
                            border: true,
                            flex: 1,
                            margin: '0 0 0 0',
                            title: 'Indicadores de Gesti\u00F3n',                            
                            items: [{
                                xtype: 'datefield',
                                fieldLabel: 'Fecha Recibido Status:',
                                id: 'fchstatus' + this.idhouse,
                                name: 'fchstatus',
                                allowBlank: false,
                                format: "Y-m-d",
                                altFormat: "Y-m-d",
                                maxValue: new Date(),
                                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                submitFormat: 'Y-m-d'
                            },
                            {
                                xtype: 'timefield',
                                id: 'horastatus' + this.idhouse,
                                name: 'horastatus',
                                allowBlank: false,
                                fieldLabel: 'Hora Recibido Status:',
                                minValue: '00:00:01',
                                maxValue: '23:59:59',
                                increment: 30,
                                format: 'H:i:s',
                                submitFormat: 'H:i:s'
                            },
                            {
                                xtype: 'textareafield',                                
                                id: 'juststatus' + this.idhouse,
                                name: 'juststatus',
                                fieldLabel: 'Justificaci\u00F3n IDG',
                                allowBlank: false,
                                grow: true,
                                anchor: '100%'
                            },
                            {
                                xtype: 'Colsys.Widgets.WgExclusionesIdg',
                                id: 'excstatus' + this.idhouse,
                                name: 'excstatus',
                                fieldLabel: 'Exclusiones Idg',
                                //allowBlank: false,
                                impoexpo: 'Importaci�n',
                                transporte: 'Mar�timo'
                            }]
                        }]
                },                    
                Ext.create('Colsys.Status.GridFotos', {
                    id: 'grid-fotos-' + this.idhouse,
                    name: 'grid-fotos-' + this.idhouse,
                    title: 'Fotos Aver\u00EDas <span style="font-size: 8px;">'+data.cliente+'</span>',
                    margin: '0 10 10 0',
                    idmaster: data.idmaster,
                    idhouse: this.idhouse,
                    doctransporte: data.doctransporte,
                    hidden: true
                }),
                Ext.create('Colsys.Status.GridConcliente', {
                    id: 'grid-concliente-' + this.idhouse,
                    name: 'grid-concliente-' + this.idhouse,
                    title: 'Contactos <span style="font-size: 8px;">'+data.cliente+'</span>',
                    flex: 1,
                    margin: '0 10 10 0',
                    idhouse: data.idhouse,
                    idcliente: data.idcliente,
                    idreporte: data.idreporte,
                    referencia: data.referencia
                }),
                Ext.create('Colsys.Status.GridArchivos', {
                    id: 'grid-archivos-' + this.idhouse,
                    name: 'grid-archivos-' + this.idhouse,
                    title: 'Documentos <span style="font-size: 8px;">'+data.cliente+'</span>',
                    flex: 1,
                    margin: '0 10 10 0',
                    idmaster: data.idmaster,
                    idhouse: this.idhouse,
                    doctransporte: data.doctransporte
                })
            );
            
            if (data.continuacion !== "N/A" && data.continuacion !== null && data.continuacion !== "") {
                var destinofinal = data.destinofinal;
                var textos = this.up("panel").up("panel").permisos.llegada?this.up("panel").up("panel").permisos.llegada.textotm:null;
                
                if(textos){
                    if (textos[destinofinal]) {
                        Ext.getCmp('mensaje_cliente' + this.idhouse).setValue(textos[destinofinal]);
                    } else {
                        Ext.getCmp('mensaje_cliente' + this.idhouse).setValue(textos["COL-0000"]);
                    }
                }
            }
            
        }
    }
});