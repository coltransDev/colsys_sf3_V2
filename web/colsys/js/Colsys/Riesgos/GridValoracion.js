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
            
            if(this.permisos === true){
                tbar = [{
                    xtype: 'toolbar',
                    dock: 'top',
                    id: 'bar-val-'+idriesgo,                
                    items: [{
                        text: 'Agregar',
                        iconCls: 'add',
                        handler : function(){
                            var store = this.up("grid").getStore();
                            var r = Ext.create(store.getModel());            
                            store.insert(0, r);
                        }
                    },{
                        text: 'Guardar',
                        iconCls: 'disk',
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
                                records[i].data.id = r.id
                                changes1[i] = records[i].data;
                                row = new Object();
                                for (j = 0; j < fields.length; j++){                    
                                    eval("row." + fields[j] + "=records[i].data." + fields[j] + idriesgo + ";")                    
                                }
                                row.id = r.id;
                                row.idriesgo = idriesgo;
                                changes[i] = row;
                            }

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
                                                    Ext.MessageBox.alert("Mensaje", 'Informaci\u00F3n almacenada correctamente<br>');
                                                    Ext.getCmp("grid-val"+idriesgo).getStore().reload();
                                                    Ext.getCmp("grafica"+idriesgo).getStore().reload();
                                                }
                                            } else {
                                                Ext.MessageBox.alert("Error", 'Error al guardar<br>' + res.errorInfo);
                                            }
                                        }
                                    });
                                }
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
            }
        },
        beforeitemcontextmenu: function(view, record, item, index, e){
            e.stopEvent();
            var idriesgo = this.idriesgo;
            var idval = eval('record.data.idvaloracion'+idriesgo);
            var record = this.store.getAt(index);            
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
        },
        beforerender: function(ct, position){
            this.reconfigure(
                store =  Ext.create('Ext.data.Store', {
                fields: [
                   {name: 'idvaloracion'+this.idriesgo, type: 'int',        mapping: 'idvaloracion'},
                   {name: 'ano'+this.idriesgo,          type: 'int',        mapping: 'ano'},
                   {name: 'peso'+this.idriesgo,         type: 'integer',    mapping: 'peso'},
                   {name: 'operativo'+this.idriesgo,    type: 'integer',    mapping: 'operativo'},
                   {name: 'legal'+this.idriesgo,        type: 'string',     mapping: 'legal'},
                   {name: 'economico'+this.idriesgo,    type: 'integer',    mapping: 'economico'},
                   {name: 'comercial'+this.idriesgo,    type: 'string',     mapping: 'comercial'},
                   {name: 'impacto'+this.idriesgo,      type: 'float',      mapping: 'impacto'},
                   {name: 'score'+this.idriesgo,        type: 'float',      mapping: 'score'}                   
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
                sorters: [{
                    property: 'ano',
                    direction: 'ASC'
                }],
                autoLoad: false
            }),
            [
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
                    header: "Probabilidad",
                    dataIndex: 'peso'+this.idriesgo,                    
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    editor: {
                        xtype: 'numberfield'
                    }
                },
                {
                    header: "Operativo 10%",
                    dataIndex: 'operativo'+this.idriesgo,
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    editor: {
                        xtype: 'numberfield'
                    }
                },
                {
                    header: "Legal 30%",
                    dataIndex: 'legal'+this.idriesgo,
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    editor: {
                        xtype: 'numberfield'
                    }
                },
                {
                    header: "Econ\u00F3mico 40%",
                    dataIndex: 'economico'+this.idriesgo,
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    editor: {
                        xtype: 'numberfield'
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
                        xtype: 'numberfield'
                    }
                },        
                {
                    header: "Impacto",
                    dataIndex: 'impacto'+this.idriesgo,
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    align: 'right',
                    renderer: Ext.util.Format.numberRenderer('0,0.00'),        
                    summaryType: 'sum',
                    summaryRenderer: function(value, summaryData, dataIndex) {
                            return "<span style='font-weight: bold;'> "+Ext.util.Format.usMoney(value)+"</span>";
                        }

                },
                {
                    header: "Score",
                    dataIndex: 'score'+this.idriesgo,
                    hideable: false,
                    sortable: true,
                    flex: 1,
                    align: 'right',
                    renderer: Ext.util.Format.numberRenderer('0,0.00'),        
                    summaryType: 'sum',
                    summaryRenderer: function(value, summaryData, dataIndex) {
                            return "<span style='font-weight: bold;'> "+Ext.util.Format.usMoney(value)+"</span>";
                        }

                }
            ])
        }
    }
});