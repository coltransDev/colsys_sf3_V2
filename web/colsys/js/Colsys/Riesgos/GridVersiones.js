/**
 * @autor Andrea Ramírez
 Administración de Causas de los Riesgos
 
 @comment Muestra una Grilla con las causas de cada Riesgo definidas independientemente ya que se deben asociar con los eventos que
surgen en cada riesgo
 */
//var winCausa = null;
Ext.define('Colsys.Riesgos.GridVersiones', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Riesgos.GridVersiones',    
    autoHeight: true,
    autoScroll: true,
    frame: true,
    controller: 'cell-editing',
    selModel: {
        selType: 'cellmodel'
    },
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {
            if (record.data.nueva)
                return "row_pink";                            
        }
    },
    listeners:{                
        beforerender: function(ct, position){
            
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {
                    fields: [
                        {name: 'idversion'+this.idgrid,     type: 'integer', mapping: 'idversion'},
                        {name: 'idempresa'+this.idgrid,     type: 'integer', mapping: 'idempresa'},
                        {name: 'empresa'+this.idgrid,     type: 'string', mapping: 'empresa'},
                        {name: 'idproceso'+this.idgrid,     type: 'integer', mapping: 'idproceso'},
                        {name: 'proceso'+this.idgrid,     type: 'string', mapping: 'proceso'},
                        {name: 'version'+this.idgrid,     type: 'integer', mapping: 'version'},
                        {name: 'nombre'+this.idgrid,     type: 'string', mapping: 'nombre'},
                        {name: 'observaciones'+this.idgrid,     type: 'string', mapping: 'observaciones'},
                        {name: 'fchcreado'+this.idgrid,    type: 'date',      mapping: 'fchcreado',  dateFormat: 'Y-m-d H:i:s'},
                        {name: 'usucreado'+this.idgrid,     type: 'string', mapping: 'usucreado'}                        
                    ],
                    proxy: {
                        type: 'ajax',
                        url: '/riesgos/datosGridVersiones',
                        extraParams:{
                            idproceso: this.idproceso,
                            idempresa: this.idempresa,
                            tipo: this.tipo
                        },
                        reader: {
                            type: 'json',
                            rootProperty: 'root',
                            totalProperty: 'total'
                        }
                    },        
                    sorters: [{
                        property: 'empresa'+this.idgrid,
                        direction: 'ASC'
                    },{
                        property: 'proceso'+this.idgrid,
                        direction: 'ASC'
                    },{
                        property: 'version'+this.idgrid,
                        direction: 'ASC'
                    }],
                    autoLoad: true
                }),
                [
                    {dataIndex: 'idversion'+this.idgrid, hidden: true},        
                    {dataIndex: 'idproceso'+this.idgrid, hidden: true},
                    {header: "Empresa", dataIndex: 'empresa'+this.idgrid, flex:1, hidden:!this.idproceso?(!this.idempresa?false:true):true },
                    {header: "Proceso", dataIndex: 'proceso'+this.idgrid, flex:2, hidden:this.idproceso?true:false },                    
                    {header: "Version", dataIndex: 'version'+this.idgrid},
                    {header: "Nombre", dataIndex: 'nombre'+this.idgrid, flex:3 },
                    {header: "Observaciones", dataIndex: 'observaciones'+this.idgrid, flex:3 },                    
                    {
                        header: "Usu. Creado",
                        dataIndex: 'usucreado'+this.idgrid,                    
                        hideable: true,
                        sortable: true,                        
                        flex: 1,
                        cellWrap: true
                    },
                    {
                        header: "Fch. Creado",
                        dataIndex: 'fchcreado'+this.idgrid,                    
                        sortable: true,                         
                        flex: 1,                        
                        renderer: function (a, b, c, d){
                            if (a) {
                                var formattedDate = new Date(a);
                                var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                var d = formattedDate.getDate();                                
                                if (d < 10) {
                                    d = "0" + d;
                        }
                                var m = formattedDate.getMonth();
                                m += 1;  
                                if (m < 10) {
                                    m = "0" + m;
                                }
                                var y = formattedDate.getFullYear();
                                return y + "-" + m + "-" + d +' '+ formattedDate.getHours() +':' +formattedDate.getMinutes() +':' +formattedDate.getSeconds();
                            }
                        }
                    },
                    {xtype: 'actioncolumn',
                        width: 50,
                        sortable: false,
                        menuDisabled: true,
                        items: [{
                            iconCls: 'pdf',
                            tooltip: 'Ver Archivo',
                            handler: 'onVerArchivo'
                        }]
                    }
                ]
            );
    
            tbar = [{
                    xtype: 'toolbar',
                    dock: 'top',
                    id: 'bar-cau-'+this.idgrid,                                    
                    items: [/*{
                        text: 'Agregar',
                        iconCls: 'add',
                        handler : 'onAddClick'
                    },*/{
                        text: 'Refrescar',
                        iconCls: 'refresh',
                        handler : function(){
                            this.up("grid").getStore().reload();
                        }
                    }
                ]
            }]
            this.addDocked(tbar);   
            
            
        }       
    }
});

Ext.define('Colsys.view.grid.CellEditingController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.cell-editing',    
    onVerArchivo: function (view, recIndex, cellIndex, item, e, record) {        
        
        var idarchivo = utf8Decode(record.data.nombre)+".pdf";
        var archivo = Base64.encode("Procesos/"+record.data.idproceso+"/versiones/"+idarchivo);
        window.open("/gestDocumental/verArchivo?idarchivo="+archivo);        
    }
})