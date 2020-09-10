var win_comodato = null;
var contextMenu=null;



Ext.define('Colsys.Ino.GridContenedores', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridContenedores',
    plugins: [{
            ptype: 'cellediting',
            clicksToEdit: 1
        }
    ],
    width: 640,
    height: 500,
    listeners: {
        beforerender: function (ct, position) {
            this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
        },
        afterrender: function (ct, position) {
            idmaster=this.idmaster;
            this.getStore().reload({
                params: {
                    idmaster: this.idmaster
                },
                callback: function (records, operation, success) {
                    
                    for (i = 0; i < records.length; i++) {
                        rec = records[i];
                        //console.log(rec.data);

                        if (Ext.ComponentManager.get("conceptocontenedores" + idmaster))
                        {
                            Ext.getCmp("conceptocontenedores" + idmaster).setValue(rec.data.idconcepto);                            
                        }
                    }
                    //store.commitChanges();
                }
            });
            if (this.idimpoexpo == "Importaci\u00F3n" && this.idtransporte == "Mar\u00EDtimo") {
                me = this;
                Ext.Ajax.request({
                    url: '/inoF2/datosComodato',
                    params: {
                        idmaster: this.idmaster
                    },
                    success: function (response, opts) {
                        var res = Ext.decode(response.responseText);
                        
                        if (res.root.length>0 && res.success) {
                            var lib = res.root;
                            view = me.getView();
                            view.tip = Ext.create('Ext.tip.ToolTip', {
                                target: view.el,
                                delegate: view.itemSelector,
                                trackMouse: true,
                                renderTo: Ext.getBody(),
                                listeners: {
                                    beforeshow: function updateTipBody(tip) {
                                        var tipGridView = tip.target.component;
                                        var record = tipGridView.getRecord(tip.triggerElement);
                                        console.log(record);
                                        var html="";
                                        
                                        html = "<table>";
                                        html+= "<tr>";
                                        html+= "    <td colspan= '2'>Patio: " + lib[record.get('idequipo')]["patio"] + "</td>";
                                        html+= "</tr>";
                                        html+= "<tr>";
                                        html+= "    <td>D\u00EDas Libres: " + lib[record.get('idequipo')]["dias_libres"] + "</td>";
                                        html+= "    <td>L\u00EDmite Dev.: " + lib[record.get('idequipo')]["limite_devolucion"] + "</td>";
                                        html+= "</tr>";
                                        html+= "<tr>";
                                        html+= "    <td>Entrega Comodato: " + lib[record.get('idequipo')]["fecha_entrega"] + "</td>";
                                        html+= "    <td>Fecha Devolucion: " + lib[record.get('idequipo')]["devolucion_fch"] + "</td>";
                                        html+= "</tr>";
                                        html+= "<tr>";
                                        html+= "    <td colspan= '2'>Observaciones: " + lib[record.get('idequipo')]["observaciones"] + "</td>";
                                        html+= "</tr>";
                                        html+= "</table>";
                                        tip.update(html);

                                    }
                                }
                            });
                        }
                    },
                    failure: function (response, opts) {
                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                        box.hide();
                    }
                });
            }
        },
        render: function (ct, position) {
            me = this;
            columns = new Array();
            //console.log(this.idmodalidad);
            if (this.idtransporte == "Terrestre" && this.idimpoexpo == "INTERNO") {
                columns.push({
                    header: "Vehiculo",
                    dataIndex: 'idvehiculo' + this.idmaster,
                    //width: 150,
                    editor: Ext.create('Colsys.Widgets.WgParametros', {
                        //style: 'display:inline-block;text-align:center;font-weight:bold;',
                        caso_uso: 'CU020',
                        id: 'tipovehiculo1' + this.idmaster,
                        idmaster: this.idmaster,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo
                    }),
                    renderer: comboBoxRenderer(Ext.getCmp('tipovehiculo1' + this.idmaster))
                });
            }
            columns.push({
                header: "equipo",
                dataIndex: 'idequipo' + this.idmaster,
                hidden: true
            }, {
                header: "Concepto",
                dataIndex: 'concepto' + this.idmaster,
                width: 150,
                editor: Ext.create('Colsys.Widgets.wgConceptosContenedores', {
                    id: 'conceptocontenedores' + this.idmaster,
                    name: 'conceptocontenedores' + this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    idmodalidad: this.idmodalidad,
                    tipo: "ino"
                }),
                renderer: comboBoxRenderer(Ext.getCmp('conceptocontenedores' + this.idmaster))
            }, {
                header: "Cantidad",
                dataIndex: 'cantidad' + this.idmaster,
                width: 90,
                editor: {
                    xtype: 'numberfield'
                },
                hidden: this.idmodalidad==="FCL"?true:false
            }, {
                header: "N\u00FAmero del Contenedor",
                dataIndex: 'serial' + this.idmaster,
                width: 158,
                editor: {
                    xtype: 'textfield',
                    maxLength: 11,
                    maxLengthText: 'Tama\u00F1o m\u00E1ximo 11'
                }                
            }, {
                header: "Sello",
                dataIndex: 'precinto' + this.idmaster,
                width: 158,
                editor: {
                    xtype: 'textfield',
                    maxLength: 30,
                    maxLengthText: 'Tama\u00F1o m\u00E1ximo 30'
                }
            }, {
                header: "Observaciones",
                dataIndex: 'observaciones' + this.idmaster,
                width: 550,
                editor: {
                    xtype: 'textfield'
                }
            }, {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 41,
                items: [{
                    iconCls: 'report_edit',
                    tooltip: 'Comodato',
                    isDisabled: function (view, rowIndex, colIndex, item, record) {
                        return !me.permisos.Comodatos;
                    },
                    handler: function (grid, rowIndex, colIndex) {
                        var store = grid.getStore();
                        var record = store.getAt(rowIndex);

                        if (win_comodato == null) {
                            win_comodato = new Ext.Window({
                                id: 'winControlComodato',
                                title: 'Control Comodatos',
                                width: 800,
                                height: 310,
                                closeAction: 'destroy',
                                listeners: {
                                    destroy: function (obj, eOpts)
                                    {
                                        win_comodato = null;
                                    }
                                },
                                items: {
                                    xtype: 'Colsys.Ino.FormControlComodato',
                                    id: 'formControlComodato',
                                    idequipo: record.get("idequipo")
                                }
                            });
                        }
                        win_comodato.show();
                    }                        
                }, {
                    iconCls: 'delete',
                    tooltip: 'Eliminar el Equipo',
                    isDisabled: function (view, rowIndex, colIndex, item, record) {
                        return !me.permisos.Anular;
                    },
                    handler: function (grid, rowIndex, colIndex) {
                        var store = grid.getStore();
                        var record = store.getAt(rowIndex);
                        
                        Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea anular el registro?', function (choice) {
                            if (choice == 'yes') {
                                Ext.Ajax.request({
                                    waitMsg: 'Eliminando...',
                                    url: '/inoF2/eliminarContenedor',
                                    params: {
                                        idequipo: record.get("idequipo"),
                                    },
                                    failure: function (response, options) {
                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error Eliminando el registro.<br>' + response.errorInfo);
                                        success = false;
                                    },
                                    success: function (response, options) {
                                        var res = Ext.JSON.decode(response.responseText);
                                        if (res.success) {
                                            store.reload();
                                        } else {
                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.errorInfo);
                                        }
                                    }
                                });
                            }
                        });
                    }                        
                }]
            });

            this.reconfigure(
                    //     this.superclass.onRender.call(this, ct, position),
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'idvehiculo' + this.idmaster, type: 'string', mapping: 'idvehiculo'},
                            {name: 'idequipo' + this.idmaster, type: 'string', mapping: 'idequipo'},
                            {name: 'idconcepto' + this.idmaster, type: 'integer', mapping: 'idconcepto'},
                            {name: 'concepto' + this.idmaster, type: 'string', mapping: 'concepto'},
                            {name: 'serial' + this.idmaster, type: 'string', mapping: 'serial'},
                            {name: 'precinto' + this.idmaster, type: 'string', mapping: 'precinto'},
                            {name: 'observaciones' + this.idmaster, type: 'string', mapping: 'observaciones'},
                            {name: 'cantidad' + this.idmaster, type: 'string', mapping: 'cantidad'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/inoF2/datosContenedores',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        }
                    }),
                    columns
                    );


            tb = new Ext.toolbar.Toolbar();

            if (this.permisos.Crear == true) {
                tb.add({
                    xtype: 'button',
                    text: 'Nuevo Contenedor',
                    height: 30,
                    iconCls: 'add',
                    handler: function () {
                        var store = this.up('grid').store;
                        var r = Ext.create(store.model);
                        r.set('idmaster' + this.up('grid').idmaster, this.up('grid').idmaster);
                        store.insert(0, r);
                    }
                });
            }

            if (this.permisos.Editar == true) {
                tb.add({
                    xtype: 'button',
                    text: 'Guardar',
                    height: 30,
                    iconCls: 'disk',
                    handler: function () {
                        var me = this;
                        idmaster = me.up('grid').idmaster;
                        var store = me.up('grid').getStore();
                        x = 0;
                        changes = [];

                        var records = store.getModifiedRecords();

                        var r = Ext.create(store.getModel());
                        fields = new Array();
                        for (i = 0; i < r.fields.length; i++) {
                            fields.push(r.fields[i].name.replace(idmaster, ""));
                        }

                        for (var i = 0; i < records.length; i++) {
                            r = records[i];
                            records[i].data.id = r.id
                            row = new Object();
                            for (j = 0; j < fields.length; j++)
                            {
                                eval("row." + fields[j] + "=records[i].data." + fields[j] + idmaster + ";")
                            }
                            row.id = r.id
                            changes[i] = row;
                        }
                        console.log(changes);

                        var gridContenedores = JSON.stringify(changes);

                        Ext.Ajax.request({
                            waitMsg: 'Guardando cambios...',
                            url: '/inoF2/guardarContenedores',
                            params: {
                                gridContenedores: gridContenedores,
                                idmaster: idmaster
                            },
                            failure: function (response, options) {
                                var res = Ext.util.JSON.decode(response.responseText);
                                if (res.errorInfo)
                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                                else
                                    Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                            },
                            success: function (response, options) {
                                var res = Ext.decode(response.responseText);
                                ids = res.ids;
                                if (res.ids) {
                                    for (i = 0; i < ids.length; i++) {
                                        var rec = store.getById(ids[i]);
                                        rec.data.idequipo = res.idequipos[i];
                                        rec.commit();
                                    }
                                    Ext.MessageBox.alert("Mensaje", 'Informaci\u00F3n almacenada correctamente<br>');
                                }
                            }
                        });
                    }
                });
            }

            tb.add({
                xtype: 'button',
                text: 'Refrescar',
                height: 30,
                iconCls: 'refresh',
                handler: function () {
                    var store = this.up('grid').getStore();
                    store.reload();
                }
            });

            this.addDocked(tb);

            Ext.getCmp('conceptocontenedores' + this.idmaster).getStore().reload({
                params: {
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    idmaster: this.idmaster
                }
            });
        }
    },
    viewConfig: {
        stripeRows: true,
        listeners: {
            beforeitemcontextmenu: function (view, record, item, index, e) {
                if(contextMenu!=null)
                    contextMenu.removeAll();
                
                var contextMenu = Ext.create('Ext.menu.Menu');
                permisos = this.up('grid').permisos;
                if (permisos.Comodatos) {
                    var comodato = Ext.create('Ext.menu.Item', {
                        text: 'Comodato',
                        iconCls: 'report_edit',
                        tooltip: 'Contrato de Comodato',
                        handler: function (item, e) {
                            if (win_comodato == null) {
                                win_comodato = new Ext.Window({
                                    id: 'winControlComodato',
                                    title: 'Control Comodatos',
                                    width: 800,
                                    height: 310,
                                    closeAction: 'destroy',
                                    listeners: {
                                        destroy: function (obj, eOpts)
                                        {
                                            win_comodato = null;
                                        }
                                    },
                                    items: {
                                        xtype: 'Colsys.Ino.FormControlComodato',
                                        id: 'formControlComodato',
                                        idequipo: record.get("idequipo")
                                    }
                                });
                            }
                            win_comodato.show();
                        }
                    });
                    contextMenu.add(comodato);
                }
                if (permisos.Anular) {
                    var eliminar = Ext.create('Ext.menu.Item', {
                        text: 'Eliminar',
                        iconCls: 'delete',
                        tooltip: 'Eliminar el Equipo',
                        handler: function (grid, rowIndex, colIndex) {
                            Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea anular el registro?', function (choice) {
                                if (choice == 'yes') {
                                    Ext.Ajax.request({
                                        waitMsg: 'Eliminando...',
                                        url: '/inoF2/eliminarContenedor',
                                        params: {
                                            idequipo: record.get("idequipo"),
                                        },
                                        failure: function (response, options) {
                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error Eliminando el registro.<br>' + response.errorInfo);
                                            success = false;
                                        },
                                        success: function (response, options) {
                                            var res = Ext.JSON.decode(response.responseText);
                                            if (res.success) {
                                                store.reload();
                                            } else {
                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.responseInfo);
                                            }
                                        }
                                    });
                                }
                            });
                        }
                    });
                    contextMenu.add(eliminar);
                }
            },
            itemcontextmenu: function (view, rec, node, index, e) {
                e.stopEvent();
                contextMenu.showAt(e.getXY());
                return false;
            }
        }
    }
});
