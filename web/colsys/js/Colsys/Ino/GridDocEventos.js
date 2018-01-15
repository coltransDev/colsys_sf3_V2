/**
    * @autor Felipe Nariño
        Administración de eventos
        para referencias en INO
   
       @comment Muestra una Grilla con la cual se gestionan los documentos para los eventos
                SAE y DEX (ingresar nuevos eventos y modificar eventos ya existentes)
    */
    
Ext.define('Colsys.Ino.GridDocEventos', {
extend: 'Ext.grid.Panel',
  alias: 'widget.Colsys.Ino.GridDocEventos',
    
    
    stripeRows: true,
    height: 400,
    width: 525,
        
        tbar:[{
            text: 'Agregar',
            iconCls: 'add',
            handler: function () {
                
                var st = this.up('grid').getStore();
                
                var r = Ext.create(st.model);
                st.insert(0, r);
            }
        }],
        plugins: [
            {
                ptype : 'cellediting',
                clicksToEdit: 1
            }
        ],
        buttons:[{
            text: 'Guardar',
          
            handler: function () {
                var idevento = this.up('window').idevento;
                var storeDEX = this.up('grid').getStore();
                x = 0;
                changes = [];
                var datosincompletos = false;
                var tamexcedido =false;
                for (var i = 0; i < storeDEX.getCount(); i++) {
                    var record = storeDEX.getAt(i);
                    if (record.get('documento') == "" || record.get('fchelaboracion') == "" ||record.get('fchremision') == ""){
                        datosincompletos = true;
                    }
                    
                    if (record.get('documento').toString().length > 20){
                        tamexcedido = true;
                    }
                    
                    if (Ext.Object.getSize(record.getChanges()) != 0) {
                        record.data.id = record.id
                        record.data.idevento = idevento;
                        changes[x] = record.data;
                        x++;
                    }
                }
                var strDEX = JSON.stringify(changes);
                if (!datosincompletos  &&  !tamexcedido){
                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '/inoF2/guardarEventosSAEDEX',
                        params: {
                            datos: strDEX,
                            referencia: this.up('grid').idreferencia
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
                            if (res.errorInfo){
                                Ext.MessageBox.alert("Mensaje", ' Error<br>'+res.errorInfo);
                            }
                            else{
                                Ext.MessageBox.alert("Mensaje", ' Datos almacenados correctamente<br>');
                                storeDEX.reload();
                            }
                        }
                    });
            }
            else{
                if(datosincompletos){
                   Ext.MessageBox.alert("Mensaje", ' Datos Incompletos<br>');
                }
                if(tamexcedido){
                   Ext.MessageBox.alert("Mensaje", ' Los documentos no pueden exceder 20 caracteres<br>');
                }
            }
        }
            
        }],
    cargar:function(idevento,tipoespecial)
    {
       

        a=new Array({
        header: 'No. Documentos',
        width: 250,
        dataIndex: 'documento',
        editor: {
            xtype: "textfield"
        }
    },{
        header: "Fecha",
        dataIndex: 'fchelaboracion',
        sortable: true,
        width: 120,
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
                return y + "-" + m + "-" + d;
            }
        },
        editor:{xtype:'datefield'}
      });
        
        
        if (tipoespecial == "DEX"){
       a.push({
        header: "Fecha Rem",
        id:'fecharem',
        dataIndex: 'fchremision',
        sortable: true,
        width: 120,        
        
        
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
                return y + "-" + m + "-" + d;
            }
        },
        editor:{xtype:'datefield'}
      });
         }
         
         a.push({
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 25,
                items: [{
                        iconCls: 'delete',
                        tooltip: 'Eliminar documento',
                        handler: function (grid, rowIndex, colIndex) {
                            var idevento = this.up('window').idevento;
                            var ref = this.up('grid').idreferencia;
                            var rec = grid.getStore().getAt(rowIndex);
                            Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea anular el registro?', function (choice) {
                                if (choice == 'yes') {
                                    if(rec.get('documento')!="" && rec.get('fchelaboracion')!="" &&rec.get('fchremision')!=""){
                                        Ext.Ajax.request({
                                        waitMsg: 'Guardando cambios...',
                                        url: '/inoF2/eliminardocumentosSAEDEX',
                                        params: {
                                            documento: rec.get('documento'),
                                            fecha: rec.get('fchelaboracion'),
                                            idevento: idevento,
                                            referencia: ref,
                                            fecharemision: rec.get('fchremision')
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
                                            Ext.MessageBox.alert("Mensaje", 'Registro Eliminado<br>');                                                    
                                        }
                                    }); 
                                    }
                                    grid.getStore().remove(rec);
                                }
                            });

                        }
                    }]
            })
         this.reconfigure(Ext.create('Ext.data.Store', {
            
            autoLoad: true,
                fields: [
                {name: 'documento', type: 'string'},
                {name: 'fchelaboracion'},
                {name: 'fchremision'}
            ],
            proxy: {
                type: 'ajax',
                url: '/inoF2/datosEventosSAEDEX',                
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                },
                extraParams:{"referencia":this.idreferencia,'idevento': idevento},
                filterParam: 'query'
                
            }
        }),a);
    }
    
})