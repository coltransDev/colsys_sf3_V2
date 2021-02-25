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
        labelWidth: 90/*,
        msgTarget: Ext.supports.Touch ? 'side' : 'qtip'*/
    },
    tbar: [{ 
        xtype: 'button', 
        text: 'Guardar',
        iconCls: 'fa fa-save',
        handler: 'onSaveForm'        
    },
    { 
        xtype: 'button', 
        text: 'Cerrar',
        iconCls: 'fa fa-window-close',
        handler: 'onClose'        
    },
    { 
        xtype: 'button', 
        text: 'Expandir',        
        iconCls: 'fa fa-arrows-alt-v',
        handler: 'onToggle'
    }],
    listeners: {        
        render: function (me, eOpts) {
            console.log("permisisdesdeformriesgo", me.permisos);
            var expandir = true;
            var itemId = me.itemId;
            if(this.nuevo){
                expandir = false;                
            }
            this.add(
            {xtype: 'hidden', id: 'idriesgo' + itemId, name: 'idriesgo', value: this.idriesgo},
            {xtype: 'hidden', id: 'ca_idproceso' + itemId, name: 'ca_idproceso', value: this.idproceso},
                {
                xtype: 'container',
                id:'form-container-' + itemId,
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
                    id: 'fieldset-1' + itemId,
                    items: [{
                        xtype: 'container',
                        layout: {
                            type: 'vbox', // Arrange child items vertically
                            align: 'stretch',    // Each takes up full width ,
                            pack: 'start'
                        },
                        items: [{
                            xtype: 'container',
                            layout: 'hbox',
                            defaultType: 'textfield',
                            flex:1,
                            items: [{                            
                                fieldLabel: 'C\u00F3digo',
                                id:'ca_codigo' + itemId,
                                name:'ca_codigo',                            
                                flex: 1,
                                allowBlank: false
                            },{
                                xtype:'checkboxfield',
                                fieldLabel: 'Activo',                            
                                width: 120,
                                //disabled: !me.permisos.riesgos.eliminar,
                                id:'ca_activo' + itemId,
                                name:'ca_activo'
                            }]
                        },{
                            xtype: 'Colsys.Indicadores.Internos.Widget.ComboCheckbox',
                            flex:1,
                            margin: '10 10 10 0',
                            id:'ca_clasificacion' + itemId,
                            name:'ca_clasificacion',                            
                            fieldLabel: 'Clasificaci&oacute;n',                            
                            store: Ext.create('Ext.data.Store', {
                                fields: [{type: 'string', name: 'name'},{type: 'integer',name: 'id'}],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosParametros',
                                    extraParams:{
                                        caso_uso: 'CU286'
                                    },
                                    reader: {
                                        type: 'json',
                                        rootProperty: 'root'
                                    }
                                },
                                autoLoad: true
                            })
                        }]
                    }]
                },
                {
                    title: 'Riesgo',                    
                    id: 'fieldset-2' + itemId,
                    items:[{
                        xtype: 'htmleditor',
                        height: 100,
                        id: 'ca_riesgo' + itemId,
                        name: 'ca_riesgo',
                        enableFont: false,
                        enableFontSize: false,
                        enableFormat: false,
                        enableAlignments : false,
                        enableLinks: false,
                        enableLists: false,
                        enableSourceEdit: false,
                        fontFamilies : ['Courier New'],
                        listeners: {                    
                            render:function(){                                
                                /*Oculta el botón de background color del texto*/
                                Ext.Array.each(this.getToolbar().getChildItemsToDisable(), function(name, index, countriesItSelf) {
                                    if(name.itemId === "backcolor"){                                        
                                        name.hide();                                        
                                    }   
                                });
                            },
                            afterrender: function(editor) {
                                var toolbar = editor.getToolbar();                                
                                toolbar.add({
                                    xtype: 'button',
                                    text   : 'Borrar',
                                    iconCls: 'fa fa-eraser',
                                    handler: function() {
                                        this.up("htmleditor").setHtml('<div></div>');
                                    }
                                });
                                
                                toolbar.add({
                                    xtype: 'button',
                                    text   : 'Formatear datos',
                                    iconCls: 'fa fa-eraser',
                                    handler: function() {                                        
                                        html = this.up("htmleditor").value;                                        
                                        this.up("htmleditor").setValue('<div>'+Ext.util.Format.stripTags(html)+'</div>');
                                    }
                                });
                            }
                        }
                    }]
                },
                {
                    title: 'Factor Generador',
                    id: 'fieldset-3' + itemId,
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
                            checkPropagation: 'both',
                            margin: '0 15 0 0',
                            controller: 'check-tree-factores',    
                            itemId: itemId,
                            flex: 1,
                            tbar: [
                                { xtype: 'button', 'iconCls':'fa fa-sync',text: 'Refrescar', handler: 'onRefresh' }
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
                            frame: true,
                            useArrows: true,
                            bufferedRenderer: false,
                            animate: true,
                            /*viewConfig: {
                                plugins: {
                                    treeviewdragdrop: {
                                        ddGroup: 'two-trees-drag-drop',
                                        appendOnly: true,
                                        sortOnDrop: true,
                                        containerScroll: true
                                    }
                                }
                            },*/
                            listeners: {
                                beforecheckchange: 'onBeforeCheckChange'
                            },
                            tbar: [{
                                text: 'Agregar Factores',
                                iconCls: 'fa fa-user-plus',
                                handler: 'onCheckedNodesClick'
                            }]
                        },{
                            xtype: 'treepanel',
                            controller: 'treepanel-list',
                            flex: 1,                            
                            id: 'treeFactor' + itemId,
                            itemId: 'treefactor-'+ itemId,                            
                            idriesgo: this.idriesgo,
                            tbar: [
                                { xtype: 'button', 'iconCls':'fa fa-sync',text: 'Refrescar', handler: 'onRefresh' },
                                { xtype: 'button', 'iconCls':'fa fa-save',text: 'Guardar Factores', handler: 'onSave' }
                            ],
                            store: {
                                type: 'tree',
                                clearOnLoad: true,
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
                            /*viewConfig: {
                                plugins: {
                                    treeviewdragdrop: {
                                        ddGroup: 'two-trees-drag-drop',
                                        appendOnly: true,
                                        sortOnDrop: true,
                                        containerScroll: true,
                                        allowContainerDrops: true
                                    }
                                }
                            },*/
                            listeners:{                                
                                itemcontextmenu: function ( t, record, item, index, e, eOpts ){                                    
                                    e.stopEvent();                                    
                                    var idriesgo = t.up("form").idriesgo;
                                    var factor = [];
                                    var obj = new Object();
                                    
                                    obj.factor = record.data.text;
                                    factor.push(obj);
                                    var str = JSON.stringify(factor);                                    
                                    
                                    var nuevo = record.data.nuevo;
                                    
                                    var menu = new Ext.menu.Menu({
                                        id: 'menuContextual',
                                        items: []
                                    });
                                            
                                    if(nuevo){
                                        menu.add({
                                            text: 'Quitar',
                                            iconCls: 'fa fa-trash',
                                            id: 'button-quitar',                                            
                                            handler: function() {
                                                var rootNode = Ext.getCmp('treeFactor' + itemId).getRootNode();
                                                rootNode.removeChild(record, true);
                                            }
                                        });
                                    }else{
                                        menu.add({
                                            text: 'Eliminar Factor',
                                            iconCls: 'fa fa-user-minus',
                                            id: 'button1-',
                                            //disabled: !permisos,
                                            handler: function() {
                                                Ext.MessageBox.confirm('Confirmaci\u00F3n de Eliminaci\u00F3n', 'Est\u00E1 seguro que desea eliminar el factor: '+ record.data.text+' ?', function (choice) {
                                                    if (choice == 'yes') {
                                                        Ext.getCmp("treeFactor" + itemId).getController().onActualizarFactores(idriesgo, str, "eliminar", t);
                                                    }
                                                });
                                            }
                                        });
                                    }
                                            
                                    menu.showAt(e.getXY());
                                }
                            }
                        }]
                    }]
                },
                {
                    title: 'Etapa del Proceso',
                    id: 'fieldset-4' + itemId,
                    items:[{
                        xtype: 'htmleditor',
                        height: 100,
                        id: 'ca_etapa' + itemId,
                        name: 'ca_etapa',
                        enableFont: false,
                        enableFontSize: false,
                        enableFormat: false,
                        enableAlignments : false,
                        enableLinks: false,
                        enableLists: false,
                        enableSourceEdit: false,
                        fontFamilies : ['Courier New'],
                        listeners: {                    
                            render:function(){                                
                                /*Oculta el botón de background color del texto*/
                                Ext.Array.each(this.getToolbar().getChildItemsToDisable(), function(name, index, countriesItSelf) {
                                    if(name.itemId === "backcolor"){                                        
                                        name.hide();                                        
                                    }   
                                });
                            },
                            afterrender: function(editor) {
                                var toolbar = editor.getToolbar();                                
                                toolbar.add({
                                    xtype: 'button',
                                    text   : 'Borrar',
                                    iconCls: 'fa fa-eraser',
                                    handler: function() {
                                        this.up("htmleditor").setHtml('<div></div>');
                                    }
                                });
                                
                                toolbar.add({
                                    xtype: 'button',
                                    text   : 'Formatear datos',
                                    iconCls: 'fa fa-eraser',
                                    handler: function() {                                        
                                        html = this.up("htmleditor").value;                                        
                                        this.up("htmleditor").setValue('<div>'+Ext.util.Format.stripTags(html)+'</div>');
                                    }
                                });
                            }
                        }
                    }]
                },
                {
                    title: 'Factor Potenciador',
                    id: 'fieldset-5' + itemId,
                    items:[{
                        xtype: 'htmleditor',
                        height: 100,
                        id: 'ca_potenciador' + itemId,
                        name: 'ca_potenciador',                        
                        enableFont: false,
                        enableFontSize: false,
                        enableFormat: false,
                        enableAlignments : false,
                        enableLinks: false,
                        enableLists: false,
                        enableSourceEdit: false,
                        fontFamilies : ['Courier New'],
                        listeners: {                    
                            render:function(){                                
                                /*Oculta el botón de background color del texto*/
                                Ext.Array.each(this.getToolbar().getChildItemsToDisable(), function(name, index, countriesItSelf) {
                                    if(name.itemId === "backcolor"){                                        
                                        name.hide();                                        
                                    }   
                                });
                            },
                            afterrender: function(editor) {
                                var toolbar = editor.getToolbar();                                
                                toolbar.add({
                                    xtype: 'button',
                                    text   : 'Borrar',
                                    iconCls: 'fa fa-eraser',
                                    handler: function() {
                                        this.up("htmleditor").setHtml('<div></div>');
                                    }
                                });
                                
                                toolbar.add({
                                    xtype: 'button',
                                    text   : 'Formatear datos',
                                    iconCls: 'fa fa-eraser',
                                    handler: function() {                                        
                                        html = this.up("htmleditor").value;                                        
                                        this.up("htmleditor").setValue('<div>'+Ext.util.Format.stripTags(html)+'</div>');
                                    }
                                });
                            }
                        }
                    }]
                },
                {
                    title: 'Causas',
                    id: 'fieldset-6' + itemId,
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
                    id: 'fieldset-7' + itemId,
                    items:[{
                        xtype: 'htmleditor',
                        height: 300,
                        id: 'ca_controles' + itemId,
                        name: 'ca_controles',                        
                        enableFont: false,
                        enableFontSize: false,
                        enableFormat: false,
                        enableAlignments : false,
                        enableLinks: false,
                        enableLists: false,
                        enableSourceEdit: false,
                        fontFamilies : ['Courier New'],
                        listeners: {                    
                            render:function(){                                
                                /*Oculta el botón de background color del texto*/
                                Ext.Array.each(this.getToolbar().getChildItemsToDisable(), function(name, index, countriesItSelf) {
                                    if(name.itemId === "backcolor"){                                        
                                        name.hide();                                        
                                    }   
                                });
                            },
                            afterrender: function(editor) {
                                var toolbar = editor.getToolbar();                                
                                toolbar.add({
                                    xtype: 'button',
                                    text   : 'Borrar',
                                    iconCls: 'fa fa-eraser',
                                    handler: function() {
                                        this.up("htmleditor").setHtml('<div></div>');
                                    }
                                });
                                
                                toolbar.add({
                                    xtype: 'button',
                                    text   : 'Formatear datos',
                                    iconCls: 'fa fa-eraser',
                                    handler: function() {                                        
                                        html = this.up("htmleditor").value;                                        
                                        this.up("htmleditor").setValue('<div>'+Ext.util.Format.stripTags(html)+'</div>');
                                    }
                                });
                            }
                        }
                    }]
                },
                {
                    title: 'AP',
                    id: 'fieldset-8' + itemId,
                    items:[{
                        xtype: 'htmleditor',
                        height: 300,
                        id: 'ca_ap' + itemId,
                        name: 'ca_ap',                        
                        enableFont: false,
                        enableFontSize: false,
                        enableFormat: false,
                        enableAlignments : false,
                        enableLinks: false,
                        enableLists: false,
                        enableSourceEdit: false,
                        fontFamilies : ['Courier New'],
                        listeners: {                    
                            render:function(){                                
                                /*Oculta el botón de background color del texto*/
                                Ext.Array.each(this.getToolbar().getChildItemsToDisable(), function(name, index, countriesItSelf) {
                                    if(name.itemId === "backcolor"){                                        
                                        name.hide();                                        
                                    }   
                                });
                            },
                            afterrender: function(editor) {
                                var toolbar = editor.getToolbar();                                
                                toolbar.add({
                                    xtype: 'button',
                                    text   : 'Borrar',
                                    iconCls: 'fa fa-eraser',
                                    handler: function() {
                                        this.up("htmleditor").setHtml('<div></div>');
                                    }
                                });
                                
                                toolbar.add({
                                    xtype: 'button',
                                    text   : 'Formatear datos',
                                    iconCls: 'fa fa-eraser',
                                    handler: function() {                                        
                                        html = this.up("htmleditor").value;                                        
                                        this.up("htmleditor").setValue('<div>'+Ext.util.Format.stripTags(html)+'</div>');
                                    }
                                });
                            }
                        }
                    }]
                },
                {
                    title: 'Contingencia',
                    id: 'fieldset-9' + itemId,
                    items:[{
                        xtype: 'htmleditor',
                        height: 300,
                        id: 'ca_contingencia' + itemId,
                        name: 'ca_contingencia',                        
                        enableFont: false,
                        enableFontSize: false,
                        enableFormat: false,
                        enableAlignments : false,
                        enableLinks: false,
                        enableLists: false,
                        enableSourceEdit: false,
                        fontFamilies : ['Courier New'],
                        listeners: {                    
                            render:function(){                                
                                /*Oculta el botón de background color del texto*/
                                Ext.Array.each(this.getToolbar().getChildItemsToDisable(), function(name, index, countriesItSelf) {
                                    if(name.itemId === "backcolor"){                                        
                                        name.hide();                                        
                                    }   
                                });
                            },
                            afterrender: function(editor) {
                                var toolbar = editor.getToolbar();                                
                                toolbar.add({
                                    xtype: 'button',
                                    text   : 'Borrar',
                                    iconCls: 'fa fa-eraser',
                                    handler: function() {
                                        this.up("htmleditor").setHtml('<div></div>');
                                    }
                                });
                                
                                toolbar.add({
                                    xtype: 'button',
                                    text   : 'Formatear datos',
                                    iconCls: 'fa fa-eraser',
                                    handler: function() {                                        
                                        html = this.up("htmleditor").value;                                        
                                        this.up("htmleditor").setValue('<div>'+Ext.util.Format.stripTags(html)+'</div>');
                                    }
                                });
                            }
                        }
                    }]
                }]
            });
        },
        afterrender: function(me, eOpts){           
            
            var f = me.getForm();            
            f.load({
                url: '/riesgos/datosFormRiesgo',
                params: {
                    idriesgo : this.idriesgo
                },
                success: function (response, options) {
                    var res = Ext.JSON.decode(options.response.responseText);
                    console.log("performriesgo",me.permisos);
                    if(!me.permisos.riesgos.eliminar)
                        Ext.getCmp('ca_activo' + me.itemId).setReadOnly(true);                    
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
                url: '/riesgos/guardarFormRiesgo',
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
                        form.up().close();
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
                                        text: res.text,
                                        permisos: form.permisos
                                    }]
                                }).show();
                            }
                        }else{                                                       
                            me = Ext.getCmp("subpanel-general"+idriesgo);
                            if(me)
                                Ext.getCmp('general'+idriesgo).cargar(me, idriesgo);                            
                        }
                        Ext.getCmp("tree-id").getStore().reload();
                        Ext.MessageBox.alert("Mensaje", 'Los cambios se han guardado \u00E9xitosamente');                                  
                    }                                
                }
            });                        
        }
        
    },
    onClose: function(t,eOpts){
        var form = t.up('form');               
        form.up().close();
    },
    onToggle: function(t,eOpts){
        
        //console.log("formtoggle",itemId);
        var itemId = t.up("form").itemId
        
        var tipo = t.text;
        var nFieldset = 9;        
        switch(tipo){
            case "Expandir":
                for(var i=1; i<=nFieldset; i++){
                    t.up("form").child('container[id=form-container-' + itemId + ']').child('fieldset[id=fieldset-' + i + itemId + ']').expand();            
                }
                t.setText("Contraer");                
                break;
            case "Contraer":
                for(var i=1; i<=nFieldset; i++){
                    t.up("form").child('container[id=form-container-' + itemId + ']').child('fieldset[id=fieldset-' + i + itemId + ']').collapse(); 
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
        item.up("treepanel").getStore().reload({
            callback: function(records, options, success) {
                console.log("ok");
            }            
        });
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
            this.onActualizarFactores(idriesgo, str, "agregar", item);
        }else{
            Ext.MessageBox.alert("Mensaje", "Por favor crear el riesgo antes de guardar los factores asociados");
        }
    },    
    onActualizarFactores: function(idriesgo, str, tipo, item){
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
                item.up("treepanel").getStore().reload({
                    callback: function(records, options, success) {
                        if (success) {
                            me = Ext.getCmp("subpanel-general"+idriesgo);                                
                            Ext.getCmp('general'+idriesgo).cargar(me, idriesgo);
                        }
                    }
                });
               
            },

            failure: function(response, opts) {
                console.log('server-side failure with status code ' + response.status);
                Ext.MessageBox.alert("Error", response.status);
            }
        });        
    }
});

Ext.define('Colsys.view.tree.CheckTreeFactoresController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.check-tree-factores',
    onBeforeCheckChange: function(record, checkedState, e) {
        if (record.get('text') === 'Take a nap' && !checkedState) {
            Ext.toast('No rest for the weary!', null, 't');
            return false;
        }
    },
    onCheckedNodesClick: function() {
        var recordsTree = this.getView().getChecked(),
            factores = [];
            titles = [];
            idgs = [];
            impoexpos = [];
            transportes = [];
            datos = [];            
        
        var itemId = this.getView().itemId;        
        var rootNode = Ext.getCmp('treeFactor' + itemId).getRootNode();
        
        Ext.getCmp('treeFactor' + itemId).getStore().reload({
            callback: function(records, options, success) {
                if (success) {
                    Ext.each(recordsTree, function(r, index){
                        var factor = {
                            "text": r.data.text,
                            "iconCls" : "fa fa-database",
                            "leaf":true,
                            "nuevo":true,
                        }
                        factores.push(factor);
                    });

                    Ext.each(factores, function(factor, index){
                        rootNode.insertChild(index,factor);
                    });
                }
            }            
        });
    }
});