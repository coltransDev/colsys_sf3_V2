comboBoxRenderer = function (combo) {
    return function (value) {

        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};

Ext.define('Colsys.Indicadores.Internos.GridIndicadores', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Indicadores.Internos.GridIndicadores',
    frame: true,    
    multiSelect: true,
    stateId: 'stateGrid',
    selModel: 'cellmodel',
    viewConfig: {
        enableTextSelection: true,
        getRowClass: function (record, rowIndex, rowParams, store) {
            return "row_"+record.get('ca_color'); 
        }
    },
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    listeners:{
        render: function (me, eOpts){
            
            var me = this;
            
            var datos = this.datos.headers;
            var editable = this.datos.editar?this.datos.editar:false;
            var fields = [];
                columns = [];                
                
                        
            columns.push({xtype: 'rownumberer', width: 40, sortable: false,locked: true});            
            
            var comboExclusion = Ext.create('Colsys.Widgets.WgExclusionesIdg',{                
                impoexpo: me.impoexpo,
                transporte: me.transporte
            });
            
            //var editor = {completeOnEnter: false,fimeeld:{xtype: 'textfield',allowBlank: false}};
            
            Ext.Array.each(datos, function(val, key){
                editor = val["editor"]?val["editor"]:(val["editorExclusion"]?comboExclusion:null);
                renderer = val["editorExclusion"]?comboBoxRenderer(comboExclusion):null;
                fields.push(val["header"]);
                columns.push({"header":val["header"],"dataIndex":val["dataIndex"], "align":"rigth", "width": val["width"], "editor": editor, "renderer":renderer});
                
            });
            
            
            fields.push("ca_color");
            
            var myMask = new Ext.LoadMask({
                msg    : 'El informe se est\u00e1 generando...',
                target : me
            });
            myMask.show();
            
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {
                    fields: fields,                    
                    proxy: {
                        type: 'ajax',
                        url: '/indicadores/datosIdg',
                        timeout: '120000',
                        extraParams:{
                            mes: this.mes,
                            ano: this.ano,
                            sucursal: this.sucursal,
                            origen: this.origen,
                            cliente: this.cliente,
                            usuario: this.usuario,
                            idg: idg,
                            indice: this.indice
                        },
                        reader: {
                            type: 'json',
                            rootProperty: 'root',
                            totalProperty: 'total',
                            summaryRootProperty: 'summaryRoot',
                            graficaRootProperty: 'graficaRoot'
                        }
                    },                   
                    autoLoad: true,
                    listeners:{
                        load: function(records){
                            /*Si la consulta tiene resultados*/
                            if(records.data.items.length > 0){
                                var data = records.summaryRecord.data;
                                myMask.hide();
                            
                                me.up().add({
                                   xtype: "panel",
                                   bodyPadding: 5,
                                   id: 'second-panel-'+me.indice,
                                   flex: 3/8,
                                   html:'Error al cargar los datos de resumen.'
                                }).updateLayout();

                                Ext.Ajax.request({
                                    url: '/indicadores/verHtmlResumen',
                                    params: {
                                        idg: me.idg,
                                        mes: me.mes,
                                        ano: me.ano,
                                        sucursal: me.sucursal,
                                        origen: me.origen,
                                        cliente: me.cliente,
                                        usuario: me.usuario                                        
                                    },                                
                                    method: 'POST',
                                    waitTitle: 'Connecting',
                                    waitMsg: 'Cargando Archivo...',
                                    scope: me,
                                    success: function (response, options) {                                                        
                                        var html = response.responseText;                                    
                                        for(var i in data){                                        
                                            html = html.replace("{"+i+"}", data[i], "gi");
                                        }                                    
                                        Ext.getCmp('second-panel-'+me.indice).setHtml(html);                                    
                                    },
                                    failure: function () {
                                       console.log('failure');
                                    }
                                });
                                
                                var tabIndicador = Ext.getCmp('tabpanel-periodo-'+me.indice);
                            
                                tabIndicador.add({
                                    xtype: 'panel',
                                    title: "Gr\u00e1fica",
                                    titleAlign: 'center',
                                    id:'tabgrafica-'+me.indice, 
                                    /*layout: {
                                        type: 'vbox', // Arrange child items vertically
                                        align: 'stretch',    // Each takes up full width ,
                                        pack: 'start'
                                    },*/
                                    layout: 'accordion',
                                    bodyPadding: 5,
                                    defaults: {
                                        frame: true,                                    
                                    },
                                    scrollable: true,
                                    items:[
                                        Ext.create('Ext.panel.Panel', {
                                            title: 'GRAFICA DE PROMEDIO',
                                            layout: {
                                                type: 'vbox', // Arrange child items vertically
                                                align: 'stretch',    // Each takes up full width ,
                                                pack: 'start'
                                            },
                                            bodyPadding: 5,
                                            margin: '0 5 5 0',
                                            flex:1,
                                            id: 'panel-grafica-usuario-'+me.indice,
                                            style: {
                                                border: 'solid',
                                                borderColor: '#157FCC',
                                                borderRadius: '10px',
                                                padding: '5px',
                                                borderWidth: '2px',
                                                boxShadow: '5px 5px 5px #888888'
                                            },
                                            items: [
                                                Ext.create('Colsys.Indicadores.Internos.ChartColumn3D',{
                                                    captions: {
                                                        title: {
                                                            text: data.datosGrafica.infoGrafica.title,
                                                            alignTo: 'chart'
                                                        },
                                                        subtitle: {
                                                            text: data.datosGrafica.infoGrafica.subtitle,
                                                            alignTo: 'chart'
                                                        }
                                                    },
                                                    flex:1,
                                                    id: 'grafica-usuario-'+me.indice,
                                                    usuarios: data.datosGrafica.usuarios,
                                                    info: data.datosGrafica.infoGrafica,
                                                    listeners:{
                                                        beforerender: function (ct, position) {
                                                            this.setStore(
                                                                Ext.create('Ext.data.Store', {
                                                                    id: "store-column-"+me.indice,
                                                                    autoLoad: true,
                                                                    fields: data.datosGrafica.fieldsGr,
                                                                    data: data.datosGrafica.datosIdg                                                                    
                                                                })
                                                            );
                                                            
                                                            var tipodiff = data.datosGrafica.infoGrafica.tipodiff;
                                                            
                                                            switch(tipodiff){
                                                                case "H:i:s":                                                            
                                                                    this.setAxes([
                                                                        {
                                                                            type: 'numeric',
                                                                            position: 'right',            
                                                                            minimum: 0,
                                                                            maximum: 120,
                                                                            title: {
                                                                                text: '% De Cumplimiento',
                                                                                fontSize: 15
                                                                            },            
                                                                            fields: ['porcentaje']
                                                                        },{
                                                                            type: 'time',
                                                                            position: 'left',
                                                                            dateFormat: 'H:i:s',
                                                                            fromDate : new Date('1/10/2007 00:00:00'),
                                                                            grid: true,
                                                                            title: {
                                                                                text: 'Tiempo (horas)',
                                                                                fontSize: 15
                                                                            },
                                                                            fields: data.datosGrafica.usuarios
                                                                        }, {
                                                                            type: 'category3d',
                                                                            position: 'bottom',
                                                                                grid: true,
                                                                            title: {
                                                                                    text: 'Mes',
                                                                                    fontSize: 15
                                                                            },
                                                                            fields: 'mes'
                                                                        }] 
                                                                    );

                                                                    this.addSeries([{
                                                                        type: 'line',
                                                                        title: '% de Cumplimiento',
                                                                        axis: 'right',
                                                                        xField: 'mes',
                                                                        yField: ['porcentaje'],
                                                                        stacked: false,
                                                                        marker: true,
                                                                        label: {
                                                                            field: ['porcentaje'],
                                                                            display: 'over',
                                                                            font: '10px Helvetica',
                                                                            renderer: function (text, label, labelCfg, data, index) {
                                                                                var record = data.store.getAt(index);
                                                                                return record.get('porcentaje') + '%';
                                                                            }
                                                                        },
                                                                        tooltip: {
                                                                            trackMouse: true,
                                                                            width: 140,
                                                                            height: 28,
                                                                            renderer: function (toolTip, record, ctx) {
                                                                                toolTip.setHtml("<b>" + ctx.field + "</b>" + ': ' + record.get(ctx.field) + "%");
                                                                            }
                                                                        }
                                                                    }]);
                                                                break;
                                                                case "d":
                                                                    this.setAxes([
                                                                        {
                                                                            type: 'numeric',
                                                                            position: 'right',            
                                                                            minimum: 0,
                                                                            maximum: 120,
                                                                            title: {
                                                                                text: '% De Cumplimiento',
                                                                                fontSize: 15
                                                                            },            
                                                                            fields: ['porcentaje']
                                                                        },{
                                                                            type: 'numeric3d',
                                                                            position: 'left',                                                                            
                                                                            adjustByMajorUnit: true,                                                                            
                                                                            grid: true,
                                                                            increment: 1,
                                                                            majorTickSteps : 5,            
                                                                            title: {
                                                                                text: 'Tiempo (d\u00edas)',
                                                                                fontSize: 15
                                                                            },
                                                                            fields: data.datosGrafica.usuarios                                                                            
                                                                        }, {
                                                                            type: 'category3d',
                                                                            position: 'bottom',
                                                                                grid: true,
                                                                            title: {
                                                                                    text: 'Mes',
                                                                                    fontSize: 15
                                                                            },
                                                                            fields: 'mes'
                                                                        }] 
                                                                    );

                                                                    this.addSeries([{
                                                                        type: 'line',
                                                                        title: '% de Cumplimiento',
                                                                        axis: 'right',
                                                                        xField: 'mes',
                                                                        yField: ['porcentaje'],
                                                                        stacked: false,
                                                                        marker: true,
                                                                        label: {
                                                                            field: ['porcentaje'],
                                                                            display: 'over',
                                                                            font: '10px Helvetica',
                                                                            renderer: function (text, label, labelCfg, data, index) {
                                                                                var record = data.store.getAt(index);
                                                                                return record.get('porcentaje') + '%';
                                                                            }
                                                                        },
                                                                        tooltip: {
                                                                            trackMouse: true,
                                                                            width: 140,
                                                                            height: 28,
                                                                            renderer: function (toolTip, record, ctx) {
                                                                                toolTip.setHtml("<b>" + ctx.field + "</b>" + ': ' + record.get(ctx.field) + "%");
                                                                            }
                                                                        }
                                                                    }])
                                                                    break;
                                                            }
                                                            
                                                        }                                                        
                                                    }
                                                })
                                            ],
                                            listeners: {
                                                afterrender: function (ct, position) {
                                                    $('#panel-grafica-usuario-' + indice + " div").css({border: 'none'});
                                                }
                                            }
                                        }),
                                        Ext.create('Ext.panel.Panel', {                                        
                                            title: 'GRAFICA DE CONSOLIDADO DE CASOS',
                                            layout: {
                                                type: 'vbox', // Arrange child items vertically
                                                align: 'stretch',    // Each takes up full width ,
                                                pack: 'start'
                                            },
                                            bodyPadding: 5,
                                            margin: '10',
                                            flex:1,
                                            id: 'panel-grafica-casos-'+me.indice,
                                            style: {
                                                border: 'solid',
                                                borderColor: '#157FCC',
                                                borderRadius: '10px',
                                                padding: '5px',
                                                borderWidth: '2px',
                                                boxShadow: '5px 5px 5px #888888'
                                            },
                                            items: [
                                                Ext.create('Colsys.Indicadores.Internos.ChartPie3D',{
                                                    flex:1,                                                    
                                                    id: 'grafica-casos-'+me.indice,
                                                    captions: {
                                                        title: {
                                                            text: data.datosGrafica.infoGrafica.title,
                                                            alignTo: 'chart'
                                                        },
                                                        subtitle: {
                                                            text: data.datosGrafica.infoGrafica.subtitle,
                                                            alignTo: 'chart'
                                                        }
                                                    },
                                                    listeners:{
                                                        beforerender: function (ct, position) {
                                                            this.setStore(
                                                                Ext.create('Ext.data.Store', {
                                                                    id: "store-pie-"+me.indice,
                                                                    autoLoad: true,
                                                                    fields: data.datosGrafica.fieldsGr,
                                                                    data: data.datosGrafica.datosUsuario
                                                                })
                                                            );
                                                        }
                                                    }
                                                })
                                            ],
                                            listeners: {
                                                afterrender: function (ct, position) {
                                                    $('#panel-grafica-casos-' + indice + " div").css({border: 'none'});
                                                }
                                            }
                                        })                            
                                    ],
                                    listeners:{
                                        beforerender: function (ct, position) {                                        
                                            this.setHeight(this.up('tabpanel').up("tabpanel").getHeight() - 130);
                                        }
                                    }
                                });
                            } else {
                                Ext.Msg.alert('Consulta sin Resultados', 'La consulta no tiene resultados!');
                                Ext.getCmp('tab-' + me.indice).close();
                            }
                        }
                    }
                }),
                columns
            );
    
            tbar = [{
                xtype: 'toolbar',                
                dock: 'top',
                id: 'bar-eve-'+this.indice,                
                items: [
                {
                    ui: 'default-toolbar',                    
                    xtype: 'button',
                    iconCls: 'pdf',
                    text: 'Generar PDF',  
                    handler: function(){
                        
                        var grid = this.up("grid");
                        
                        var html = Ext.getCmp('second-panel-'+me.indice).html        
                        var htmlPdf = htmlToPdfmake(html);
                        var title = this.up("tabpanel").up().title;                        
                        var titlePdf = htmlToPdfmake(title);                        
                        
                        var cfg = Ext.merge({
                            title: titlePdf[0],                            
                            data2: htmlPdf[0]                            
                        }, this.cfg);        
                        
                        var myMask = new Ext.LoadMask({
                            msg    : 'Construyendo el archivo PDF, este proceso puede tardar un poco dependiendo de la cantidad de datos...',
                            target : me
                        });
                        myMask.show(); 
                        
                        Ext.syncRequire(['Ext.grid.plugin.Exporter','Ext.view.grid.ExporterController'], function() {

                            grid.addPlugin({
                                ptype: 'gridexporter'
                            });

                            var docDefinition = grid.saveDocumentPdfAs(cfg);
                            var data = JSON.stringify(docDefinition);

                            /*Este código permite enviar una función en segundo plano para que el navegador no la detecte como un script lento*/
                            const myWorker = new Worker("/js/Colsys/Functions/worker.js");
                            myWorker.postMessage(data);                        
                            console.log('Message posted to worker');                        

                            myWorker.onmessage = function(e) {

                                myMask.hide();
                                src = e.data;
                                var pdf64 = src.substring(28);

                                var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                    id: 'window-pdf-idg-'+me.indice,
                                    title: 'Generar PDF',                               
                                    sorc: src
                                });

                                windowpdf.insertDocked(0, {
                                    xtype: 'toolbar',
                                    dock: 'top',
                                    items: [{ 
                                        xtype: 'button', 
                                        text: 'Guardar en repositorio',
                                        iconCls: 'disk',
                                        handler: function(){
                                            Ext.create('Colsys.Indicadores.Internos.WindowVersion',{
                                                title: 'Guardar como:',
                                                id: 'winversion-'+me.indice,
                                                width: 500,
                                                heigth: 500,
                                                pdf: pdf64,
                                                indice: me.indice,
                                                ano: me.ano,
                                                mes: me.mes,
                                                idg: me.idg
                                            }).show();
                                        }
                                    }]
                                });      

                                windowpdf.show();
                            }
                            console.log(this);
                        }, {prop: 'value'});
                    }
                },
                {
                    xtype: 'button',
                    text: 'Exportar XLXS',
                    iconCls: 'csv',
                    cfg: {
                        type: 'excel07',
                        ext: 'xlsx'
                    },
                    handler: function(){
                        var grid = this.up("grid");
                        var cfg = Ext.merge({
                            title: 'Indicador de Gestión',
                            fileName: 'Indicador de Gesti\u00f3n' + '.' + (this.cfg.ext || this.cfg.type)
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
                            console.log(this);
                        }, {prop: 'value'});
                    }
                },
                /*{
                    text:   'Excel',
                    iconCls: 'csv',
                    cfg: {
                        type: 'excel07',
                        ext: 'xlsx'
                    },
                    handler: function(){
                        var cfg = Ext.merge({
                            title: 'Indicador de Gestión',
                            fileName: 'Indicador de Gesti\u00f3n' + '.' + (this.cfg.ext || this.cfg.type)
                        }, this.cfg);                        
                        this.up("grid").saveDocumentAs(cfg);
                    }
                },{
                    text: 'Generar PDF',
                    iconCls: 'pdf',
                    id: 'button2-'+me.indice,
                    handler: function () {
                        
                        var linkSucursal = me.sucursal?"&sucursal="+me.sucursal:"";
                        var linkOrigen = me.origen?"&origen="+me.origen:"";
                        var linkCliente = me.cliente?"&cliente="+me.cliente:"";
                        var linkUsuario = me.usuario?"&usuario="+me.usuario:"";
                        
                        var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                            id: 'window-pdf-idg-'+me.indice,
                            title: 'Generar PDF',                               
                            sorc: "/indicadores/generarPdf?idg="+me.idg+"&mes="+me.mes+"&ano="+me.ano+linkSucursal+linkOrigen+linkCliente+linkUsuario+"&tipo=pdf&indice="+me.indice,
                            listeners:{
                                close: function (panel, eOpts){
//                                    alert("cerrar");
                                    Ext.Ajax.request({
                                        url: '/indicadores/borrarReposTemp',
                                        params: {
                                            indice: me.indice
                                        },
                                        success: function (response, opts) {
//                                            Ext.Msg.alert('Mensaje', 'Ok');

                                        },
                                        failure: function (response, opts) {
                                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                            box.hide();
                                        }
                                    })

                                }
                            }
                        });
                        
                        windowpdf.insertDocked(0, {
                            xtype: 'toolbar',
                            dock: 'top',
                            items: [{ 
                                xtype: 'button', 
                                text: 'Guardar en repositorio',
                                iconCls: 'disk',
                                handler: function(){
                                    Ext.create('Colsys.Indicadores.Internos.WindowVersion',{
                                        title: 'Guardar como:',
                                        id: 'winversion-'+me.indice,
                                        width: 500,
                                        heigth: 500,
                                        indice: me.indice,
                                        ano: me.ano,
                                        mes: me.mes,
                                        idg: me.idg
                                    }).show();
                                }
                            }]
                        });                                                    
                        windowpdf.show();                        
                    }                                          
                },*/{
                    xtype: "textfield",
                    fieldLabel: 'Buscar',
                    listeners:{
                        change:function( obj, newValue, oldValue, eOpts ){
                            var idgrid = this.up("grid").idgrid;                            
                            var store=this.up("grid").getStore();
                            store.clearFilter();
                            if(newValue!=""){
                                store.filterBy(function(record, id){
                                    
                                    var str=record.get("ca_consecutivo");
                                    var str1=record.get("ca_referencia");                                    
                                    
                                    var txt=new RegExp(newValue,"ig");
                                    
                                    if(str.search(txt) == -1 && str1.search(txt) == -1)
                                        return false;
                                    else
                                        return true;
                                });
                            }
                        }
                    }
                },{
                    text:   'Guardar Observaciones',
                    iconCls: 'disk',
                    disabled: !editable,
                    handler: function(){                         
                        this.up("grid").saveComments();
                    }
                }]
            }];
            this.addDocked(tbar);    
        },
        beforeedit ( editor, context, eOpts ){            
            var record = context.record;
            console.log(record);
            if(record.data.ca_id > 0 && record.data.ca_color == "pink")
                return true;
            else
                return false;
        }
    },
    saveComments(){
        var store = this.getStore();
        var me = this;
        //console.log(store)
        var r = Ext.create(store.getModel());
        var fields = new Array();

        changes = [];
        var records = store.getModifiedRecords();
        
        
        for (var i = 0; i < records.length; i++) {
            r = records[i];
            console.log(r);
            row = new Object();
            if (r.isValid()) {
                row.id = r.data.ca_id;
                row.observaciones = r.data.ca_observaciones;
                row.idexclusion = r.data.ca_exclusion;
                changes[i] = row;
            }
        }

        var str = JSON.stringify(changes);
        console.log(changes);

        if (changes.length > 0) {

            Ext.Ajax.request({
                url: '/inoF2/registrarObservacionIdg',
                params: {
                    datos: str
                },
                success: function (response, opts) {
                    var obj = Ext.decode(response.responseText);

                    if (obj.errorInfo != "")
                        Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                    else {
                        me.getStore().reload();
                        Ext.MessageBox.alert("Colsys", "Registros guardados correctamente. Favor verificar");                        
                    }
                },
                failure: function (response, opts) {
                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                    box.hide();
                }
            });
        
        }else {
            Ext.Msg.alert('Verificación', "No existen cambios pendientes por guardar!");
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