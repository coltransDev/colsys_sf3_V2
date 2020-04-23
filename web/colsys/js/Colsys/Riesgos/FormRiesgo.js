Ext.define('Colsys.Riesgos.FormRiesgo', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Riesgos.FormRiesgo',
    controller: 'form-riesgo',
    bodyPadding: 10,
    autoScroll: true,
    frame: true,
    defaults: {        
        bodyStyle:'padding:4px',
        labelWidth:100
    },
    fieldDefaults: {
        labelAlign: 'right',
        labelWidth: 90,
        msgTarget: Ext.supports.Touch ? 'side' : 'qtip'
    },
    tbar: [{ 
        xtype: 'button', 
        text: 'Guardar',
        iconCls: 'disk',
        handler: 'onSaveForm'        
    },
    { 
        xtype: 'button', 
        text: 'Expandir',        
        handler: 'onToggle'
    }],
    listeners: {        
        render: function (me, eOpts) {
            var expandir = true;
            if(this.nuevo){
                expandir = false;
            }
            this.add(
            {xtype: 'hidden', id: 'idriesgo', name: 'idriesgo', value: this.idriesgo},
            {xtype: 'hidden', id: 'ca_idproceso', name: 'ca_idproceso', value: this.idproceso},
                {
                xtype: 'container',
                id:'form-container',
                layout: {
                    type: 'vbox',
                    pack: 'start',
                    align: 'stretch'
                },                                
                style: {border : '1px solid #cfcfcf', padding: '10px'},
                defaultType: 'fieldset',
                defaults:{
                    layout: 'anchor',
                    collapsible: true,
                    collapsed: expandir,                    
                    anchor: '100%',                    
                    style: {
                        background: '#F6F6F6',
                        padding: '10px'                        
                    }
                },
                items: [{                    
                    title: 'General',                    
                    id: 'fieldset-1',
                    items: [{
                        xtype: 'container',
                        layout: 'hbox',
                        defaultType: 'textfield',                        
                        items: [{                            
                            fieldLabel: 'C\u00F3digo',
                            id:'ca_codigo',
                            name:'ca_codigo',                            
                            flex: 1,
                            allowBlank: false
                        }, {
                            xtype:'checkboxfield',
                            fieldLabel: 'LA/FT-FPADM',                            
                            width: 150,
                            id:'ca_laft',
                            name:'ca_laft'
                        },{
                            xtype:'checkboxfield',
                            fieldLabel: 'Activo',                            
                            width: 150,
                            id:'ca_activo',
                            name:'ca_activo'
                        }]
                    }]
                },
                {
                    title: 'Riesgo',                    
                    id: 'fieldset-2',
                    items:[{
                        xtype: 'htmleditor',
                        height: 100,
                        id: 'ca_riesgo',
                        name: 'ca_riesgo',
                        enableFont: false,
                        enableFontSize: false,
                        enableFormat: false,
                        enableAlignments : false,
                        enableLinks: false,
                        enableLists: false,
                        enableSourceEdit: false
                    }]
                },
                {
                    title: 'Factor Generador',
                    id: 'fieldset-3',
                    disabled: this.nuevo,
                    items:[{
                        xtype: 'container',
                        height: 300,
                        layout: {
                            type: 'hbox',
                            align: 'stretch'
                        },                        
                        items: [{                            
                            xtype: 'treepanel',
                            margin: '0 15 0 0',
                            controller: 'treepanel-list',
                            flex: 1,
                            tbar: [
                                { xtype: 'button', 'iconCls':'refresh',text: 'Refrescar', handler: 'onRefresh' }
                            ],
                            store: {
                                type: 'tree',
                                proxy: {
                                    type: 'ajax',
                                    url: '/riesgos/datosTreeFactores'                                    
                                },
                                root: {
                                    text: 'Listado',
                                    id: 'src',
                                    expanded: true
                                },
                                folderSort: true,
                                sorters: [{
                                    property: 'text',
                                    direction: 'ASC'
                                }]
                            },
                            viewConfig: {
                                plugins: {
                                    treeviewdragdrop: {
                                        ddGroup: 'two-trees-drag-drop',
                                        appendOnly: true,
                                        sortOnDrop: true,
                                        containerScroll: true
                                    }
                                }
                            }
                        },{
                            xtype: 'treepanel',
                            controller: 'treepanel-list',
                            flex: 1,
                            id: 'treeFactor',
                            //name: 'ca_factor',
                            idriesgo: this.idriesgo,
                            tbar: [
                                { xtype: 'button', 'iconCls':'refresh',text: 'Refrescar', handler: 'onRefresh' },
                                { xtype: 'button', 'iconCls':'disk',text: 'Guardar Factores', handler: 'onSave' }
                            ],
                            store: {
                                type: 'tree',
                                proxy: {
                                    type: 'ajax',
                                    url: '/riesgos/datosTreeFactorRiesgo',
                                    autoLoad: true,
                                    extraParams: {
                                        idriesgo: this.idriesgo
                                    }
                                },
                                root: {
                                    text: 'Asignados',
                                    id: 'src1',
                                    expanded: true//,
                                    //children: []
                                },
                                folderSort: true,
                                sorters: [{
                                    property: 'text',
                                    direction: 'ASC'
                                }]
                            },
                            viewConfig: {
                                plugins: {
                                    treeviewdragdrop: {
                                        ddGroup: 'two-trees-drag-drop',
                                        appendOnly: true,
                                        sortOnDrop: true,
                                        containerScroll: true,
                                        allowContainerDrops: true
                                    }
                                }
                            },
                            listeners:{                                
                                itemcontextmenu: function ( t, record, item, index, e, eOpts ){                                    
                                    e.stopEvent();                                    
                                    var idriesgo = t.up("form").idriesgo;
                                    var factor = [];
                                    var obj = new Object();
                                    
                                    obj.factor = record.data.text;
                                    factor.push(obj);
                                    var str = JSON.stringify(factor);                                    
                                    
                                    var menu = new Ext.menu.Menu({
                                        id: 'menuContextual',
                                        items: [{
                                            text: 'Eliminar Factor',
                                            iconCls: 'delete',
                                            id: 'button1-',
                                            //disabled: !permisos,
                                            handler: function() {
                                                Ext.MessageBox.confirm('Confirmaci\u00F3n de Eliminaci\u00F3n', 'Est\u00E1 seguro que desea eliminar el factor: '+ record.data.text+' ?', function (choice) {
                                                    if (choice == 'yes') {
                                                        Ext.getCmp("treeFactor").getController().onActualizarFactores(idriesgo, str, "eliminar");
                                                    }
                                                });
                                            }
                                        }]
                                    }).showAt(e.getXY());
                                }
                            }
                        }]
                    }]
                },
                {
                    title: 'Etapa del Proceso',
                    id: 'fieldset-4',
                    items:[{
                        xtype: 'htmleditor',
                        height: 100,
                        id: 'ca_etapa',
                        name: 'ca_etapa',
                        enableFont: false,
                        enableFontSize: false,
                        enableFormat: false,
                        enableAlignments : false,
                        enableLinks: false,
                        enableLists: false,
                        enableSourceEdit: false
                    }]
                },
                {
                    title: 'Factor Potenciador',
                    id: 'fieldset-5',
                    items:[{
                        xtype: 'htmleditor',
                        height: 100,
                        id: 'ca_potenciador',
                        name: 'ca_potenciador',                        
                        enableFont: false,
                        enableFontSize: false,
                        enableFormat: false,
                        enableAlignments : false,
                        enableLinks: false,
                        enableLists: false,
                        enableSourceEdit: false
                    }]
                },
                {
                    title: 'Causas',
                    id: 'fieldset-6',
                    disabled: this.nuevo,
                    items:[
                        Ext.create('Colsys.Riesgos.GridCausas',{
                            id: 'ca_causas',                            
                            name: 'ca_causas',                            
                            idriesgo: this.idriesgo,                                        
                            flex: 1                                        
                        })   
                    ]
                },
                {
                    title: 'Controles',
                    id: 'fieldset-7',
                    items:[{
                        xtype: 'htmleditor',
                        height: 300,
                        id: 'ca_controles',
                        name: 'ca_controles',                        
                        enableFont: false,
                        enableFontSize: false,
                        enableFormat: false,
                        enableAlignments : false,
                        enableLinks: false,
                        enableLists: false,
                        enableSourceEdit: false
                    }]
                },
                {
                    title: 'AP',
                    id: 'fieldset-8',
                    items:[{
                        xtype: 'htmleditor',
                        height: 300,
                        id: 'ca_ap',
                        name: 'ca_ap',                        
                        enableFont: false,
                        enableFontSize: false,
                        enableFormat: false,
                        enableAlignments : false,
                        enableLinks: false,
                        enableLists: false,
                        enableSourceEdit: false
                    }]
                },
                {
                    title: 'Contingencia',
                    id: 'fieldset-9',
                    items:[{
                        xtype: 'htmleditor',
                        height: 300,
                        id: 'ca_contingencia',
                        name: 'ca_contingencia',                        
                        enableFont: false,
                        enableFontSize: false,
                        enableFormat: false,
                        enableAlignments : false,
                        enableLinks: false,
                        enableLists: false,
                        enableSourceEdit: false
                    }]
                }]
            });
        },
        afterrender: function(me, eOpts){
            var f = Ext.getCmp('form-riesgo').getForm();            
            f.load({
                url: '/riesgos/datosFormGeneral',
                params: {
                    idriesgo : this.idriesgo
                },
                success: function () {
                    //alert("si");
                },
                failure: function(){
                    //alert("mo");
                }
            });
            
        }
    }
});

Ext.define('Colsys.view.form.FormRiesgoController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.form-riesgo',
    onSaveForm: function(t,eOpts){
        var form = t.up('form');
        var idriesgo = form.idriesgo;
        
        var data = form.getForm().getValues();
        var str = JSON.stringify(data);
        
        if (form.isValid()) {
            Ext.Ajax.request({
                waitMsg: 'Guardando cambios...',
                url: '/riesgos/guardarFormGeneral',
                params: {
                    datos: str
                },
                failure: function (response, options) {
                    var res = Ext.util.JSON.decode(response.responseText);
                    if (res.errorInfo)
                        Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                    else
                        Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                },
                success: function (response, options) {
                    var res = Ext.util.JSON.decode(response.responseText);

                    if(res.success==false){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+res.errorInfo);
                    }else{
                        if(res.nuevo){                                        
                            var tabpanel = Ext.getCmp('view-Riesgos').down('tabpanel');                                        
                            Ext.getCmp('tree-id').getStore().reload();                                        

                            indice=res.idriesgo;
                            if(!tabpanel.getChildByElement('tab-'+indice)){

                                tabpanel.add({
                                    title: res.text,
                                    id:'tab-'+indice,
                                    itemId:'tab-'+indice,                                        
                                    closable: true,
                                    items:[{
                                        xtype:'Colsys.Riesgos.PanelGeneral',                                                
                                        id:"general"+indice,
                                        name:"general"+indice,
                                        idriesgo: indice,                                                            
                                        text: res.text
                                    }]
                                }).show();
                            }
                        }else{
                            me = Ext.getCmp("subpanel-general"+idriesgo);                                
                            Ext.getCmp('general'+idriesgo).cargar(me, idriesgo);
                        }
                        Ext.getCmp('winRiesgo').close();                                
                        Ext.MessageBox.alert("Mensaje", 'Los cambios se han guardado \u00E9xitosamente');                                  
                    }                                
                }
            });                        
        }
        
    },
    onToggle: function(t,eOpts){
        
        var tipo = t.text;
        var nFieldset = 9;        
        switch(tipo){
            case "Expandir":
                for(var i=1; i<=nFieldset; i++){
                    t.up("form").child('container[id=form-container]').child('fieldset[id=fieldset-'+i+']').expand();            
                }
                t.setText("Contraer");
                break;
            case "Contraer":
                for(var i=1; i<=nFieldset; i++){
                    t.up("form").child('container[id=form-container]').child('fieldset[id=fieldset-'+i+']').collapse(); 
                }
                t.setText("Expandir");
                break;
        }
    }
});

Ext.define('Colsys.view.treepanel.TreepanelListController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.treepanel-list',
    onRefresh: function (item,event) {
        item.up("treepanel").getStore().reload();
    },
    onSave: function (item,event) {
        var storeTree = item.up("treepanel").getStore();
        var idriesgo = item.up("treepanel").idriesgo;
        
        if(idriesgo){
            x = 0;
            changes = [];
            for (var i = 0; i < storeTree.getCount(); i++) {
                var record = storeTree.getAt(i);
                if (Ext.Object.getSize(record.getChanges()) != 0) {
                    changes[x] = {factor: record.get("text")};
                    x++;
                }
            }
            var str = JSON.stringify(changes);

            this.onActualizarFactores(idriesgo, str, "agregar");
        }else{
            Ext.MessageBox.alert("Mensaje", "Por favor crear el riesgo antes de guardar los factores asociados");
        }
    },    
    onActualizarFactores(idriesgo, str, tipo){
        
        Ext.Ajax.request({
            url: '/riesgos/actualizarFactores',
            params:{
                idriesgo: idriesgo,
                factores: str,
                tipo: tipo
            },
            success: function(response, opts) {
                var obj = Ext.decode(response.responseText);
                
                if(obj.success){
                    Ext.MessageBox.alert("Mensaje", obj.mensaje);
                }else{
                    Ext.MessageBox.alert("Error", obj.errorInfo);
                }                
                Ext.getCmp("treeFactor").getStore().reload();
                me = Ext.getCmp("subpanel-general"+idriesgo);                                
                Ext.getCmp('general'+idriesgo).cargar(me, idriesgo);
            },

            failure: function(response, opts) {
                console.log('server-side failure with status code ' + response.status);
                Ext.MessageBox.alert("Error", response.status);
            }
        });        
    }
});