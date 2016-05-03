Ext.define('Colsys.Ino.GridSobreventa', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridSobreventa',
    autoHeight:true,
    width: 525,        
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    buttons:[{
        text: 'Guardar',
        handler: function () {
            var store = this.up('grid').getStore();
            var records = store.getModifiedRecords();
            var lenght = records.length;

            changes=[];
            for( var i=0; i< lenght; i++){
                r = records[i];

                 if( r.data.iditem!="" && r.getChanges())
                 {                
                    records[i].data.id=r.id                    
                    changes[i]=records[i].data;               
                 }
            }
            var str= JSON.stringify(changes);
            if(str.length>5)
            {
                
                Ext.Ajax.request({
                    url: '/inoF2/guardarGridSobreventa',
                    params: {                            
                        datos:str                            
                    },
                    success:function(response,options){
                        var res = Ext.util.JSON.decode(response.responseText);
                        Ext.Msg.alert("Success", "Se guardaron correctamente los datos");
                        store.reload();
                    }
                });
             }

        }
    }],
    onRender: function(ct, position)
    {
         this.reconfigure(Ext.create('Ext.data.Store', {            
            autoLoad: true,
                fields: [
                {name: 'doctransporte', mapping:'h_ca_doctransporte'},
                {name: 'idhouse',       mapping:'h_ca_idhouse'},
                {name: 'idutilidad',    mapping:'u_ca_idutilidad'},
                {name: 'idinocosto',    mapping:'c_ca_idinocosto'},
                {name: 'valor',         mapping:'u_ca_valor'}
            ],
            proxy: {
                type: 'ajax',
                url: '/inoF2/datosSobreventa',
                reader: {
                    type: 'json',
                    root: 'root'
                },
                extraParams:{"idmaster":this.idmaster,"idinocosto":this.idinocosto},
                filterParam: 'query'
            }
        }),
        [   {
                header: 'House',
                width: 250,
                dataIndex: 'doctransporte',
                editor: {
                    xtype: "textfield"
                }
            },
            {
                header: 'Valor',
                width: 250,
                dataIndex: 'valor',
                editor: {
                    xtype: "numberfield"
                }
            }
        ]);
        this.superclass.onRender.call(this, ct, position);
    }
});