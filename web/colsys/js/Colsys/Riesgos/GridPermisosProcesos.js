Ext.define('Colsys.Riesgos.GridPermisosProcesos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Riesgos.GridPermisosProcesos',    
//    enableLocking: true,
//    //layout: 'border',
//    //split: true,
//    lockedGridConfig: {
//        emptyText: '',
//        collapsible: false//,
//        //forceFit: true,//<-this doesn't work
//        //flex: 1/4
//    },
    //autoHeight: true,
    //autoScroll: true,
    selModel: {
        type: 'cellmodel'
    },
    plugins:{
        cellediting: true
    },    
    listeners: {        
        beforerender: function(ct, position){            
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {
                    fields: [
                            //{name: 'sel' + this.idgrid},
                            {name: 'ca_idproceso' + this.idgrid, mapping: 'ca_idproceso', type: 'integer'},
                            {name: 'ca_proceso' + this.idgrid, mapping: 'ca_proceso', type: 'string'},
                            {name: 'ca_idempresa' + this.idgrid, mapping: 'ca_idempresa', type: 'integer'},
                            {name: 'ca_empresa' + this.idgrid, mapping: 'ca_empresa', type: 'string'},
                            {name: 'ca_sucursal' + this.idgrid, mapping: 'ca_sucursal', type: 'string'},
                            {name: 'ca_login' + this.idgrid, mapping: 'ca_login', type: 'string'},
                            {name: 'ca_nombre' + this.idgrid, mapping: 'ca_nombre', type: 'string'},
                            {name: 'ca_idperfil' + this.idgrid, mapping: 'ca_idperfil', type: 'integer'},
                            {name: 'ca_perfil' + this.idgrid, mapping: 'ca_perfil', type: 'string'},
                            {name: 'ca_riesgos_view' + this.idgrid, mapping: 'ca_riesgos_view', type: 'boolean'},
                            {name: 'ca_riesgos_new' + this.idgrid, mapping: 'ca_riesgos_new', type: 'boolean'},
                            {name: 'ca_riesgos_edit' + this.idgrid, mapping: 'ca_riesgos_edit', type: 'boolean'},
                            {name: 'ca_riesgos_delete' + this.idgrid, mapping: 'ca_riesgos_delete', type: 'boolean'},
                            {name: 'ca_riesgos_approval' + this.idgrid, mapping: 'ca_riesgos_approval', type: 'boolean'},
                            {name: 'ca_valoracion_view' + this.idgrid, mapping: 'ca_valoracion_view', type: 'boolean'},
                            {name: 'ca_valoracion_new' + this.idgrid, mapping: 'ca_valoracion_new', type: 'boolean'},
                            {name: 'ca_valoracion_edit' + this.idgrid, mapping: 'ca_valoracion_edit', type: 'boolean'},
                            {name: 'ca_valoracion_delete' + this.idgrid, mapping: 'ca_valoracion_delete', type: 'boolean'},
                            {name: 'ca_eventos_view' + this.idgrid, mapping: 'ca_eventos_view', type: 'boolean'},
                            {name: 'ca_eventos_new' + this.idgrid, mapping: 'ca_eventos_new', type: 'boolean'},
                            {name: 'ca_eventos_edit' + this.idgrid, mapping: 'ca_eventos_edit', type: 'boolean'},
                            {name: 'ca_eventos_delete' + this.idgrid, mapping: 'ca_eventos_delete', type: 'boolean'},
                            {name: 'ca_informes_view' + this.idgrid, mapping: 'ca_informes_view', type: 'boolean'},
                            {name: 'ca_informes_new' + this.idgrid, mapping: 'ca_informes_new', type: 'boolean'},
                            {name: 'ca_auditor' + this.idgrid, mapping: 'ca_auditor', type: 'boolean'},
                            {name: 'ca_admin' + this.idgrid, mapping: 'ca_admin', type: 'boolean'},
                            {name: 'ca_usucreado' + this.idgrid, mapping: 'ca_usucreado', type: 'string'},
                            {name: 'ca_fchcreado' + this.idgrid, mapping: 'ca_fchcreado', type: 'date', dateFormat: 'Y-m-d H:i:s'},
                            {name: 'ca_usuactualizado' + this.idgrid, mapping: 'ca_usuactualizado', type: 'string'},
                            {name: 'ca_fchusuactualizado' + this.idgrid, mapping: 'ca_fchactualizado', type: 'date', dateFormat: 'Y-m-d H:i:s'}
                    ],
                    autoLoad:true,
                    remoteSort: false,
                    proxy: {
                        type: 'ajax',
                        url: '/riesgos/datosGridPermisos',
//                        extraParams:{
//                            idproceso: this.idproceso
//                        },
                        reader: {
                            type: 'json',
                            rootProperty: 'root'
                        }
                    }/*,
                    sorters: [
                        {property: 'empresa',direction: 'ASC'},
                        {property: 'sucursal',direction: 'ASC'},
                        {property: 'nombre',direction: 'ASC'}
                    ],*/
                }),
                [
                    //{text: '', dataIndex: 'sel' + this.idgrid, xtype: 'checkcolumn', width: 30},
//                    {
//                        dataIndex: 'ca_auditor' + this.idgrid,
//                        width: 30,                        
//                        locked: true,
//                        renderer: function(value, metaData, record, rowIndex, colIndex, store) {
//                            var admin = record.data.ca_admin;
//                            return admin?'<img src="/images/16x16/user_admin.png':(value?'<img src="/images/16x16/user_audit.png"/>':"");
//                        }
//                    },
                    {text: "Proceso", dataIndex: 'ca_proceso' + this.idgrid, sortable: true, hidden:true, width: 250},
                    {text: "Empresa", dataIndex: 'ca_empresa' + this.idgrid, sortable: true},
                    {text: "Sucursal", dataIndex: 'ca_sucursal' + this.idgrid, sortable: true},
                    //{dataIndex: 'ca_login' + this.idgrid, hidden: true},
                    {
                        text: "Colaborador", 
                        dataIndex: 'ca_nombre' + this.idgrid,
                        sortable: true,                         
                        width: 200,                        
                        editor: Ext.create('Colsys.Widgets.wgUsuario', {
                            id: "ca_nombre" + this.idgrid,
                            valueField:'login',
                            displayField:'nombre',
                            listeners:{
                                select: function (a, record, idx){
                                    var selected = this.up('grid').getSelectionModel().getSelection()[0];
                                    var row = this.up('grid').store.indexOf(selected);
                                    var store = this.up('grid').getStore();
                                    store.data.items[row].set('ca_login' + this.up('grid').idgrid, record.data.login);
                                }
                            }
                        }),
                        renderer: comboBoxRenderer(Ext.getCmp('ca_nombre' + this.idgrid))
                    },
                    {
                        text: "Perfil", 
                        dataIndex: 'ca_perfil' + this.idgrid,
                        sortable: true,                                                
                        width: 200,
                        editor: Ext.create('Colsys.Widgets.WgParametros', {
                            id: "ca_perfil" + this.idgrid,
                            caso_uso: 'CU285',                                                        
                            listeners:{
                                select: function (a, record, idx){
                                    console.log("recordselectperfil", record);
                                    var idgrid = this.up('grid').idgrid;                                    
                                    var valByPerfil = Ext.JSON.decode(record.data.valor2);
                                    
                                    var selected = this.up('grid').getSelectionModel().getSelection()[0];
                                    var row = this.up('grid').store.indexOf(selected);                                    
                                    var store = this.up('grid').getStore();                                    
                                    for (const property in valByPerfil) {
                                        eval("store.data.items[row].set('" + property + idgrid +"'," + valByPerfil[property] + ");");
                                    }
                                    store.data.items[row].set('ca_idperfil' + idgrid, record.data.id);                                    
                                    console.log("storedataselect",store.data);
                                }
                            }
                        }),
                        renderer: comboBoxRenderer(Ext.getCmp('ca_perfil' + this.idgrid))
                    },
                    {text: 'Riesgos',                        
                        columns: [
                            {text: "Ver", dataIndex: 'ca_riesgos_view' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                            {text: "Crear", dataIndex: 'ca_riesgos_new' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                            {text: "Editar", dataIndex: 'ca_riesgos_edit' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                            {text: "Eliminar", dataIndex: 'ca_riesgos_delete' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                            {text: "Aprobar", dataIndex: 'ca_riesgos_approval' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false}
                        ]
                    },
                    {text: 'Valoracion',
                        columns: [
                            {text: "Ver", dataIndex: 'ca_valoracion_view' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                            {text: "Crear", dataIndex: 'ca_valoracion_new' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                            {text: "Editar", dataIndex: 'ca_valoracion_edit' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                            {text: "Eliminar", dataIndex: 'ca_valoracion_delete' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                        ]
                    },
                    {text: 'Eventos',
                        columns: [
                            {text: "Ver", dataIndex: 'ca_eventos_view' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                            {text: "Crear", dataIndex: 'ca_eventos_new' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                            {text: "Editar", dataIndex: 'ca_eventos_edit' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                            {text: "Eliminar", dataIndex: 'ca_eventos_delete' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                        ]
                    },
                    {text: 'Informes',
                        columns: [
                            {text: "Ver", dataIndex: 'ca_informes_view' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false},
                            {text: "Crear Version", dataIndex: 'ca_informes_new' + this.idgrid, xtype: 'checkcolumn', sortable: true, cls: 'grid-maestra', ignoreExport: false}
                        ]
                    }                    
                ]
            )
    
            tb = new Ext.toolbar.Toolbar({
                dock: 'top',                    
                id: 'bar-grid-detalle-'+this.idgrid
            });
            
//            if(permisosC.Crear){
                tb.add({
                        text: 'Agregar Permisos',
                        id: 'button-add-permisos',
                        iconCls: 'add',
                        disabled: true,
                        handler: function () {
                            //var view = this.getView();
                            var store = this.up('grid').store;                            
                            var r = Ext.create(store.model);                                                       
                            r.set('idgrid', this.up('grid').idgrid);
                            r.set('ca_idproceso'+this.up('grid').idgrid, this.up('grid').idpadre);                                                                                
                            store.insert(0, r);                            
                            this.up('grid').getView().focusRow(0);
                            
                            
//                            rec = new KitchenSink.model.Plant({
//                                common: '',
//                                light: 'Mostly Shady',
//                                price: 0,
//                                availDate: Ext.Date.clearTime(new Date()),
//                                indoor: false
//                            });

                            //view.store.insert(0, r);
                            //view.findPlugin('cellediting').startEdit(r, 0);
                            
                            
                            
                            
                            
                        }
                    },{
                        text: 'Guardar',
                        id: 'button-save-permisos',
                        disabled: true,
                        iconCls: 'disk',
                        handler: function () {                        
                            var store = this.up('grid').getStore();
                            var idgrid = this.up('grid').idgrid;
                            var records = store.getModifiedRecords();                        
                            var str = "";
                            var r = Ext.create(store.getModel());
                            
                            fields = new Array();
                            for (i = 0; i < r.fields.length; i++){
                                fields.push(r.fields[i].name.replace(idgrid, ""));
                            }

                            changes = [];                        
                            for (var i = 0; i < records.length; i++) {
                                r = records[i];
                                records[i].data.id = r.id                            
                                row = new Object();
                                for (j = 0; j < fields.length; j++){
                                    eval("row." + fields[j] + "=records[i].data." + fields[j] + idgrid + ";")
                                }                                
                                row.id = r.id
                                changes[i] = row;
                            }                        
                            var str = JSON.stringify(changes);

                            if (str.length > 5){
                                Ext.Ajax.request({
                                    url: '/riesgos/guardarPermisosProcesos',
                                    params: {
                                        datos: str
                                    },
                                    callback: function (options, success, response) {
                                        var res = Ext.util.JSON.decode(response.responseText);
                                        if (success) {
                                            var res = Ext.decode(response.responseText);
                                            ids = res.ids;
                                            if (res.ids && res.idsprocesos) {
                                                for (i = 0; i < ids.length; i++) {
                                                    var rec = store.getById(ids[i]);
                                                    rec.set(("ca_idproceso" + idgrid), res.idsprocesos[i]);
                                                    rec.commit();
                                                    store.reload();                                                
                                                }
                                                Ext.MessageBox.alert("Mensaje", 'Informaci\u00F3n almacenada correctamente<br>');
                                            }
                                        } else {
                                            Ext.MessageBox.alert("Error", 'Error al guardar<br>' + res.errorInfo);
                                        }
                                    }
                                });
                            }
                        }
                    });
//                }
//                
                tb.add({
                    text: 'Recargar',
                    iconCls: 'refresh',
                    id:'btn-guardarrecarga',
                    handler : function(){
                        this.up("grid").getStore().reload();
                    }
                },{
                    text: 'Auditores',
                    iconCls: 'fa fa-user-tie',
                    id:'btn-auditores',
                    handler : function(){
                        
                    }
                },{
                    xtype: 'button',
                    id:'btn-exp-xlsx',
                    text: 'Exportar CSV',
                    iconCls: 'csv',
                    cfg: {
                        type: 'csv',
                        ext: 'csv'
                    },
                    handler: function(){
                        var grid = this.up("grid");
                        var cfg = Ext.merge({
                            title: 'Detalle de Permisos',
                            fileName: 'Detalle de Permisos' + '.' + (this.cfg.ext || this.cfg.type)
                        }, this.cfg);

                        var myMask = new Ext.LoadMask({
                            msg    : 'Generando archivo, por favor espere...',
                            target : grid
                        });
                        myMask.show(); 

                        Ext.syncRequire(['Ext.grid.plugin.Exporter','Ext.view.grid.ExporterController'], function() {

                            myMask.hide();
                            grid.addPlugin({
                                ptype: 'gridexporter'
                            });
                            grid.saveDocumentAs(cfg);
                            
                        }, {prop: 'value'});         
                    }
                },{
                    xtype: "textfield",
                    id:'btn-search',
                    fieldLabel: 'Buscar',
                    listeners:{
                        change:function( obj, newValue, oldValue, eOpts ){
                            var idgrid = this.up("grid").idgrid;                            
                            var store=this.up("grid").getStore();
                            store.clearFilter();
                            if(newValue!=""){
                                store.filterBy(function(record, id){                                    
                                    var str=record.get("ca_proceso"+idgrid);
                                    var str1=record.get("ca_empresa"+idgrid);
                                    var str2=record.get("ca_sucursal"+idgrid);
                                    var str3=record.get("ca_nombre"+idgrid);
                                    var str4=record.get("ca_login"+idgrid);
                                    
                                    var txt=new RegExp(newValue,"ig");
                                    if(str.search(txt) == -1 && str1.toString().search(txt) == -1 && str2.toString().search(txt) == -1 && str3.toString().search(txt) == -1 && str4.toString().search(txt) == -1)
                                        return false;
                                    else
                                        return true;
                                });
                            }
                        }
                    }
                });
            
            this.addDocked(tb);
        },
        beforeitemcontextmenu: function(view, record, item, index, e){
            e.stopEvent();
            var me = this;
            
            //console.log("idriedgo2233",idriesgo);
                var record = this.store.getAt(index);    
                var auditor = record.data.ca_auditor;
                console.log("recorditemcontextmenu",record);
                var menu = new Ext.menu.Menu({
                    items: [/*{
                        text: auditor?"Quitar como auditor":"Asignar como auditor",
                        //disabled: !permisos,
                        iconCls: 'fa fa-user-shield',
                        handler: function() {
                            Ext.MessageBox.confirm('Confirmacion', 'Est&aacute; seguro que desea cambiar el rol de auditor para ' + record.data.ca_nombre + ' ?',function (e) {
                                if (e == 'yes') {
                                    var box = Ext.MessageBox.wait('Procesando', 'Modificando rol de auditor');
                                    Ext.Ajax.request({
                                        url: '/riesgos/modificarAuditor',
                                        params: {
                                            login: record.data.ca_login,
                                            idproceso: record.data.ca_idproceso
                                        },
                                        success: function (response, opts) {
                                            var res = Ext.util.JSON.decode(response.responseText);

                                            if(res.success){
                                                Ext.MessageBox.alert("Mensaje", res.mensaje);
                                            }else{
                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error modificando<br>' + res.errorInfo);   
                                            }
                                            me.getStore().reload();                                                
                                            Ext.getCmp("tree-id").getStore().reload();
                                        },
                                        failure: function (response, opts) {
                                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                            box.hide();
                                        }
                                    });
                                }
                            })                            
                        }
                    },*/{
                        text: 'Eliminar Permiso',
                        //disabled: !permisos,
                        iconCls: 'fa fa-trash-alt',
                        handler: function() {
                            Ext.MessageBox.confirm('Confirmacion', 'Est&aacute; seguro que desea eliminar el permiso de '+record.data.ca_nombre+' para el proceso '+ record.data.ca_proceso +' ?',function (e) {
                                if (e == 'yes') {
                                    var box = Ext.MessageBox.wait('Procesando', 'Eliminando Permiso');
                                    Ext.Ajax.request({
                                        url: '/riesgos/eliminarPermiso',
                                        params: {
                                            login: record.data.ca_login,
                                            idproceso: record.data.ca_idproceso
                                        },
                                        success: function (response, opts) {
                                            var res = Ext.util.JSON.decode(response.responseText);

                                            if(res.success){
                                                Ext.MessageBox.alert("Mensaje", res.mensaje);
                                            }else{
                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error eliminando<br>' + res.errorInfo);   
                                            }
                                            me.getStore().reload();                                                
                                            Ext.getCmp("tree-id").getStore().reload();
                                        },
                                        failure: function (response, opts) {
                                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                            box.hide();
                                        }
                                    });
                                }
                            })                            
                        }
                    }]
                }).showAt(e.getXY());
            
        }
    },  
    addPlugin: function(p) {
        //constructPlugin is private.
        //it handles the various types of acceptable forms for
        //a plugin
        var plugin = this.constructPlugin(p);
        this.plugins = Ext.Array.from(this.plugins);

        this.plugins.push(plugin);
        
        //pluginInit could get called here but
        //the less use of private methods the better
        plugin.init(this);

        return plugin;
    }
});