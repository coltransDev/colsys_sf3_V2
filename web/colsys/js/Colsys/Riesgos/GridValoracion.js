var currentTime = new Date();
var now = currentTime.getFullYear()+1;
var years = [];
var y = 2012;
while(y<=now){
    years.push([y]);
    y++;
}

winEscala = null;
var html = 
        '<table class="tabla_escala">'+
        '<tr><th class="row_purple" colspan="4">ESCALA</th></tr>'+
        '<tr><th class="row_purple" colspan="2">POSIBILIDAD DE OCURRENCIA DE UN EVENTO DE RIESGO</th>'+
        '<th class="row_purple" colspan="2">IMPACTO QUE PUEDE GENERAR UN EVENTO DE RIESGO</th></tr>'+
        '<tr><td><p class="parrafo" >MUY ELEVADA</p><p class="descripcion">ES SEGURO QUE EL EVENTO SE PRODUCIR&Aacute; FRECUENTEMENTE</p></td>'+
        '<td><p class="valor">5</p></td>'+
        '<td><p class="parrafo">MUY ELEVADO</p><p class="descripcion">IMPLICA PROBLEMAS GRAVES AFECTANDO CALIDAD Y SEGURIDAD / P&Eacute;RDIDAS MAYORES</p></td>'+
        '<td><p class="valor">20</p></td></tr>'+
        '<tr><td><p class="parrafo" >ELEVADA</p><p class="descripcion">EN CIRCUNSTANCIAS SIMILARES ANTERIORES EL EVENTO SE HA PRESENTADO  CON CIERTA FRECUENCIA</p></td>'+
        '<td><p class="valor">4</p></td>'+
        '<td><p class="parrafo">ELEVADO</p><p class="descripcion">EL RIESGO ES CR&Iacute;TICO PARA LA EMPRESA / AFECTA RENTABILIDAD</p></td>'+
        '<td><p class="valor">15</p></td></tr>'+
        '<tr><td><p class="parrafo" >MODERADA</p><p class="descripcion">EL EVENTO PUEDE PRESENTARSE OCASIONALMENTE</p></td>'+
        '<td><p class="valor">3</p></td>'+
        '<td><p class="parrafo">MODERADO</p><p class="descripcion">PRODUCE DISGUSTO E INSATISFACCI&Oacute;N EN LA EMPRESA</p></td>'+
        '<td><p class="valor">10</p></td></tr>'+
        '<tr><td><p class="parrafo" >ESCASA</p><p class="descripcion">PUEDE LLEGAR A PRESENTARSE PERO ES M&Iacute;NIMA LA POSIBILIDAD</p></td>'+
        '<td><p class="valor">2</p></td>'+
        '<td><p class="parrafo">BAJO</p><p class="descripcion">NIVEL LEVE DE P&Eacute;RDIDA</p></td>'+
        '<td><p class="valor">5</p></td></tr>'+
        '<tr><td><p class="parrafo" >MUY ESCASA</p><p class="descripcion">EVENTO INEXISTENTE EN EL PASADO / NO SE CONTEMPLA SU OCURRENCIA </p></td>'+
        '<td><p class="valor">1</p></td>'+
        '<td><p class="parrafo">INFIMO</p><p class="descripcion">ES IMPERCEPTIBLE POR LA EMPRESA / PROCESO</p></td>'+
        '<td><p class="valor">1</p></td></tr>'+        
        '</table>';
    
Ext.define('Colsys.Riesgos.GridValoracion', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Riesgos.GridValoracion',
    //width: 600,    
    autoHeight: true,    
    frame: true,    
    selModel: {
        selType: 'cellmodel'
    },
    features: [{
        id: 'feature-valoracion',
        ftype: 'groupingsummary',
        startCollapsed: true,
        hideGroupedHeader: true
    }],    
    viewConfig: {
        enableTextSelection: true,        
        listeners : {
            cellclick : function(view, cell, cellIndex, record,row, rowIndex, e) {                
                var clickedDataIndex = view.panel.headerCt.getHeaderAtIndex(cellIndex).dataIndex;                
                if(clickedDataIndex.indexOf("score")>-1){
                    view.up("grid").actualizarGrafico(record.get("idriesgo"),record.get("idvaloracion"),record.get("ano"));
                }
            }
        }    
    },
    listeners: {
        activate: function(ct, position){
           if(this.load==false || this.load=="undefined" || !this.load){

                this.store.proxy.extraParams = {
                    idriesgo: this.idriesgo
                }
                this.store.reload();
                this.load=true;
            }           
        },
        afterrender: function(ct, position){
            this.getStore().reload();            
            var idriesgo = this.idriesgo;
            var permisos = this.permisos;
            
            console.log("gridvaloracion",this);
            console.log("permisosvaloracion",permisos);
            
            this.getView().getFeature('feature-valoracion').setConfig({
                groupHeaderTpl: [
                    '{columnName}: {name} Score: <span style="color:blue;"><b>{[values.children[0].data["\promedioscorexano'+idriesgo+'\"]]}</b></span>'                                        
                ]
            });
            
            this.getView().getFeature('feature-valoracion').disable();
            
            //if(this.permisos === true){
                tbar = [{
                    xtype: 'toolbar',
                    dock: 'top',
                    id: 'bar-val-'+idriesgo,                                    
                    items: [{
                        text: 'Ver Anual',                        
                        iconCls: 'switch',                    
                        id: 'btn-anual-'+idriesgo,
                        handler : function(t){
                            var me = t;                        
                            t.up('grid').onToggle(me);
                        }
                    },{
                        text: 'Agregar',
                        iconCls: 'add',
                        id: 'btn-add-'+idriesgo,
                        disabled: !permisos.valoracion.crear,
                        handler : function(){                            
                            this.up('grid').getView().getFeature('feature-valoracion').disable();
                            var store = this.up("grid").getStore();
                            var r = Ext.create(store.getModel());            
                            r.set('nuevo', true);
                            store.insert(0, r);
                            Ext.getCmp('btn-save-'+idriesgo).enable();
                        }
                    },{
                        text: 'Guardar',
                        id: 'btn-save-'+idriesgo,
                        iconCls: 'disk',
                        disabled: !permisos.valoracion.editar,
                        handler : function(){
                            
                            error = 0;
                            var store = this.up('grid').getStore();
                            var idriesgo = this.up('grid').idriesgo;
                            
                            var records = store.getModifiedRecords();
                            var str = "";
                            var r = Ext.create(store.getModel());
                            var fields = new Array();

                            for (i = 0; i < r.fields.length; i++){                
                                fields.push(r.fields[i].name.replace(idriesgo, ""));
                            }

                            changes = [];
                            changes1 = [];
                            for (var i = 0; i < records.length; i++) {
                                r = records[i];                                
                                if(r.data.nuevo || permisos.valoracion.editar){
                                    records[i].data.id = r.id
                                    changes1[i] = records[i].data;
                                    row = new Object();
                                    for (j = 0; j < fields.length; j++){                    
                                        eval("row." + fields[j] + "=records[i].data." + fields[j] + idriesgo + ";")                    
                                    }
                                    row.id = r.id;
                                    row.idriesgo = idriesgo;
                                    changes[i] = row;
                                }else{                                    
                                    error++;
                                }
                            }
                            //exit;

                            if (error == 0) {
                                var str = JSON.stringify(changes);                
                                if (str.length > 5)
                                {
                                    Ext.Ajax.request({
                                        url: '/riesgos/guardarGridValoracion',
                                        params: {
                                            datos: str
                                        },
                                        callback: function (options, success, response) {
                                            var res = Ext.util.JSON.decode(response.responseText);
                                            if (success) {
                                                var res = Ext.decode(response.responseText);
                                                ids = res.ids;
                                                if (res.ids && res.idvals) {
                                                    for (i = 0; i < ids.length; i++) {
                                                        var rec = store.getById(ids[i]);
                                                        rec.set(("idvaloracion" + idriesgo), res.idvals[i]);
                                                        rec.commit();                                        
                                                    }
                                                    
                                                    Ext.MessageBox.alert("Mensaje", res.mensaje);
                                                    Ext.getCmp("grid-val"+idriesgo).getStore().reload();
                                                    Ext.getCmp("grafica"+idriesgo).getStore().reload();
                                                }
                                            } else {
                                                Ext.MessageBox.alert("Error", 'Error al guardar<br>' + res.errorInfo);
                                            }
                                        }
                                    });
                                }
                            }else{
                                Ext.MessageBox.alert("Error", 'Usted no tiene permisos para editar valoraciones previas. Por favor comun&iacute;quese con el Administrador del m&oacute;dulo de riesgos.');
                            }
                        }
                    },
                    {
                        text: 'Recargar',
                        iconCls: 'refresh',                        
                        handler: function () {
                            this.up("grid").getStore().reload();
                        }
                    },
                    {
                        text: 'Ver Escala',
                        iconCls: 'table',
                        handler: function () {
                            if(winEscala == null){
                                winEscala = Ext.create('Ext.window.Window',{
                                    width: 800,
                                    height: 370,
                                    id:'winEscala',                    
                                    name:'winEscala',                        
                                    title: 'Escala de Valoraci&oacute;n',
                                    layout: 'anchor',
                                    html: html,
                                    closeAction: 'hide',
                                    listeners: {
                                        afterrender: function(ct, position){                                            
                                            $(".parrafo").css({'font-weight': 'bold','font-size': '10px', 'text-align':'center'});
                                            $(".descripcion").css({'text-align':'center'});
                                            $(".valor").css({'min-width':'80px','font-size': '10px','text-align':'center'});                                
                                            $(".tabla_escala").css({'border-radius':'5px','border':'1px solid #CCCCCC', 'border-collapse': 'collapse'});                                
                                            $(".tabla_escala tr td").css({'border':'1px solid #CCCCCC','line-height':'10px'});
                                        }
                                    }
                               })
                            }
                            winEscala.show(); 
                        }
                    }]
                }];
                this.addDocked(tbar);
            //}
        },
        beforeitemcontextmenu: function(view, record, item, index, e){
            e.stopEvent();
            var idriesgo = this.idriesgo;
            var idval = eval('record.data.idvaloracion'+idriesgo);
            
            if(idval){
                var menu = new Ext.menu.Menu({
                    items: [
                        {
                            text: 'Impacto',
                            iconCls: 'application_form',
                            handler: function() {
                                Ext.create('Ext.window.Window', {
                                    title: 'Datos Generales Impacto',
                                    height: 280,
                                    width: 400,
                                    id: 'winImpacto',
                                    layout: 'fit',
                                    items: [  // Let's put an empty grid in just to illustrate fit layout
                                        Ext.create('Colsys.Riesgos.FormImpacto', {
                                            id: 'impacto' + idval,
                                            name: 'impacto' + idval,
                                            idriesgo: idriesgo,
                                            idval: idval
                                        })
                                    ]
                                }).show();                            
                                Ext.getCmp("impacto"+idval).cargar(idval);
                            }
                        }
                    ]
                }).showAt(e.getXY());
            }
        },
        beforerender: function(ct, position){
            
            var me = this;
            
            comboBoxRenderer = function (combo) {
                return function (value) {
                    var idx = combo.store.find(combo.valueField, value);
                    var rec = combo.store.getAt(idx);
                    return (rec === null ? value : rec.get(combo.displayField));
                };
            };
            this.reconfigure(
                store =  Ext.create('Ext.data.Store', {
                fields: [
                    {name: 'idriesgo' + this.idriesgo, type: 'int', mapping: 'idriesgo'},
                    {name: 'idvaloracion' + this.idriesgo, type: 'int', mapping: 'idvaloracion'},
                    {name: 'idsucursal' + this.idriesgo, type: 'string', mapping: 'idsucursal'},
                    {name: 'sucursal' + this.idriesgo, type: 'string', mapping: 'sucursal'},
                    {name: 'ano' + this.idriesgo, type: 'int', mapping: 'ano'},
                    {name: 'peso' + this.idriesgo, type: 'integer', mapping: 'peso'},
                    {name: 'operativo' + this.idriesgo, type: 'integer', mapping: 'operativo'},
                    {name: 'legal' + this.idriesgo, type: 'string', mapping: 'legal'},
                    {name: 'economico' + this.idriesgo, type: 'integer', mapping: 'economico'},
                    {name: 'comercial' + this.idriesgo, type: 'string', mapping: 'comercial'},
                    {name: 'impacto' + this.idriesgo, type: 'float', mapping: 'impacto'},
                    {name: 'score' + this.idriesgo, type: 'float', mapping: 'score'},
                    {name: 'promedioscorexano' + this.idriesgo, type: 'float', mapping: 'promedioscorexano'},
                    {name: 'porcentajexsucursal' + this.idriesgo, type: 'float', mapping: 'porcentajexsucursal'},
                    {name: 'porcentajepromedioanual' + this.idriesgo, type: 'float', mapping: 'porcentajepromedioanual'}                   
                ],
                proxy: {
                    type: 'ajax',
                    url: '/riesgos/datosGridValoracion',
                    extraParams:{
                        idriesgo: this.idriesgo
                    },
                    reader: {
                        type: 'json',
                        rootProperty: 'root',
                        totalProperty: 'total'
                    }
                },   
                remoteSort: true,
                groupField: 'ano'+this.idriesgo,
                sorters: [{
                    property: 'ano',
                    direction: 'DESC'
                }],
                autoLoad: false
            }),
            [
                {
                    xtype: 'hidden',
                    dataIndex: 'idriesgo'+this.idriesgo
                },
                {
                    xtype: 'hidden',
                    dataIndex: 'idvaloracion'+this.idriesgo
                },
                {
                    header: "A\u00F1o",
                    dataIndex: 'ano'+this.idriesgo,                    
                    sortable: true,
                    flex: 1,
                    editor: new Ext.form.ComboBox({
                        xtype: 'combo',
                        typeAhead: false,
                        selectOnFocus: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        allowBlank: false,
                        editable: false,
                        store: new Ext.data.SimpleStore({
                            fields: [ 'ca_ano' ],        
                            data: years
                        }),
                        displayField: 'ca_ano',
                        valueField: 'ca_ano',
                        forceSelection: true,                        
                        mode: 'local',
                        listClass: 'x-combo-list-small'
                    })                    
                },
                {
                    header: "Sucursal",
                    dataIndex: 'sucursal' + this.idriesgo,                    
                    sortable: true,
                    flex: 1,
                    editor: Ext.create('Colsys.Widgets.WgSucursalesEmpresa',{
                        id: 'sucursal' + this.idriesgo,                        
                        empresa: me.idempresa?me.idempresa:2,
                        listeners:{
                            select: function (a, record, idx){                                
                                var selected = this.up('grid').getSelectionModel().getSelection()[0];
                                var row = this.up('grid').store.indexOf(selected);
                                var store = this.up('grid').getStore();
                                store.data.items[row].set('idsucursal' + this.up('grid').idriesgo, record.data.id);
                            }
                        }
                    }),
                    renderer: comboBoxRenderer(Ext.getCmp('sucursal' + this.idriesgo))
                }, 
                {
                    header: "Probabilidad",
                    dataIndex: 'peso'+this.idriesgo,                    
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    editor: {
                        xtype: 'numberfield',
                        minValue: 1,
                        maxValue: 5
                    }
                },
                {
                    header: "Operativo 10%",
                    dataIndex: 'operativo'+this.idriesgo,
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    editor: {
                        xtype: 'numberfield',
                        minValue: 1,
                        maxValue: 20,
                        validator: this.validarEscala
                    }
                },
                {
                    header: "Legal 30%",
                    dataIndex: 'legal'+this.idriesgo,
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    editor: {
                        xtype: 'numberfield',
                        minValue: 1,
                        maxValue: 20,
                        validator: this.validarEscala
                    }
                },
                {
                    header: "Econ\u00F3mico 40%",
                    dataIndex: 'economico'+this.idriesgo,
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    editor: {
                        xtype: 'numberfield',
                        minValue: 1,
                        maxValue: 20,
                        validator: this.validarEscala
                    }
                },
                {
                    header: "Comercial 20%",
                    dataIndex: 'comercial'+this.idriesgo,
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    align: 'left',
                    editor: {
                        xtype: 'numberfield',
                        minValue: 1,
                        maxValue: 20,
                        validator: this.validarEscala
                    }
                },        
                {
                    header: "Impacto",
                    dataIndex: 'impacto'+this.idriesgo,
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    align: 'right',
                    renderer: Ext.util.Format.numberRenderer('0,0.00')
                },
                {
                    header: "Score",
                    dataIndex: 'score'+this.idriesgo,
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    align: 'right',
//                    renderer: Ext.util.Format.numberRenderer('0,0.00'),
                    summaryType: 'average',
                    summaryRenderer: function(value){
                        return "<span style='font-weight: bold;'> "+value+"</span>";
                    },
                    renderer: function(value){
                        return "<span style='font-weight: bold;'>"+Ext.util.Format.number(value,'0,0.00')+"</span>  <img src='/images/fam/chart_bar.png'/>";
                    }
                },
                {
                    header: "Var(%)",
                    dataIndex: 'porcentajexsucursal'+this.idriesgo,                    
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    align: 'right',
                    renderer: Ext.util.Format.numberRenderer('0.##%')                    ,
                    summaryType: function(records){
                        var totals = records.reduce(function(sums, record){
                            console.log("procentajepromedioanual",record.data.porcentajepromedioanual);
                            return record.data.porcentajepromedioanual;
                        }, [0,0]);
                        var color = totals> 0?"red":"green";
                        return "<span style='font-weight: bold;color:"+color+"'> "+totals+"%</span>";
                    }
                }
            ])  
        }        
    },
    validarEscala: function(val){            
        if(val == 1 || val%5 == 0){
            return true;
        }else{
            return "El valor debe ser una escala v\u00e1lida";
        }            
    },
    onToggle: function(t,eOpts){
         
        var tipo = t.text;        
        switch(tipo){
            case "Ver Anual":                
                t.setText("Ver General");                
                t.up('grid').getView().getFeature('feature-valoracion').enable();                
                t.up("grid").actualizarGrafico(t.up("grid").idriesgo);
                break;
            case "Ver General":         
                t.setText("Ver Anual");
                t.up('grid').getView().getFeature('feature-valoracion').disable();
                break;
        }
    },
    actualizarGrafico: function(idriesgo,idvaloracion, ano){
        eval('var graficaRiesgo = Ext.getCmp("grafica'+idriesgo+'");');
        graficaRiesgo.ano = ano;
        if(idvaloracion){
            graficaRiesgo.store.load({
                params: {
                    idvaloracion: idvaloracion,
                    ano: ano
                }
            });
        }else{
            graficaRiesgo.store.load({
                params: {
                    idriesgo: idriesgo
                }
            });
        }
    }
});