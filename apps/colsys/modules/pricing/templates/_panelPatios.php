<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">

PanelPatios = function( config ){

    Ext.apply(this, config);

    this.columns = [
       
        {
            header: "IdPatio",
            dataIndex: 'idpatio',
            hideable: false,
            sortable:false,
            width: 30
        },
        {
            header: "Patio",
            dataIndex: 'nombre',
            hideable: false,
            width: 170,            
            sortable: this.readOnly,
            editor: new Ext.form.TextField({
                    allowBlank: false ,
                    style: 'text-align:left'
                })
        },      
        {
          
            header: "Ciudad",
            width: 200,
            sortable: false,
            groupable: false,
            hideable: false,
            dataIndex: 'ciudad',            
            hideable: false,            
            editor: new WidgetCiudad({                    
                  tipo:"1",
                  impoexpo:"<?=constantes::EXPO?>"
            })
        },
        {
            header: "Direccion",
            dataIndex: 'direccion',
            hideable: false,
            width: 170,
            renderer: this.formatItem,
            sortable: this.readOnly,
            editor: new Ext.form.TextField({
                    allowBlank: false ,
                    style: 'text-align:left'
                })
        }
    ];

    this.record = Ext.data.Record.create([           
            {name: 'idpatio', type: 'int', mapping: 'p_ca_idpatio'},
            {name: 'nombre', type: 'string', mapping: 'p_ca_nombre'},           
            {name: 'idciudad', type: 'string', mapping: 'p_ca_idciudad'},
            {name: 'ciudad', type: 'string', mapping: 'c_ca_ciudad'},
            {name: 'direccion', type: 'string', mapping: 'p_ca_direccion'}
    ]);

    this.store = new Ext.data.Store({
        autoLoad : true,
        url: '<?=url_for("pricing/datosPanelParametrosPatios")?>',
        baseParams : {
            readOnly: this.readOnly
        },
        reader: new Ext.data.JsonReader({
                root: 'root',
                totalProperty: 'totalCount'
            },
            this.record
        ),
        sortInfo:{field: 'nombre', direction: "ASC"}
    });

    if( !this.readOnly ){
        this.tbar = [{
            text:'Guardar',
            iconCls: 'disk',
            scope:this,
            handler: this.guardarCambios
        }];
    }else{
        this.tbar = null;
    }
    
    PanelPatios.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 2,
       id: 'panel-patios',       
       view: new Ext.grid.GridView({
            forceFit:true,
            enableRowBody:true,
            showPreview:true
       }),       
       tbar: this.tbar
    });

    var storePanelPatios = this.store;
    var readOnly = this.readOnly;
};

Ext.extend(PanelPatios, Ext.grid.EditorGridPanel, {
    guardarCambios: function(){

        if( !this.readOnly ){
            var store = this.store;
            var records = store.getModifiedRecords();
            var lenght = records.length;

            for( var i=0; i< lenght; i++){
                r = records[i];

                var changes = r.getChanges();

                //Da formato a las fechas antes de enviarlas

                changes['id']=r.id;
                changes['idpatio']=r.data.idpatio;
                changes['nombre']=r.data.nombre;
                changes['idciudad']=r.data.idciudad;
                changes['direccion']=r.data.direccion;

                //envia los datos al servidor
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("pricing/guardarPanelPatios")?>', 						//method: 'POST',
                        //Solamente se envian los cambios
                        params :	changes,

                        callback :function(options, success, response){

                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.id && res.success){
                                var rec = store.getById( res.id );
                                rec.set("idpatio",res.idpatio);                                    
                                rec.commit();
                            }
                        }
                     }
                );
            }
        }
    }
    ,
    formatItem: function(value, p, record) {
        return String.format(
            '<b>{0}</b>',
            value
        );
    },
    onValidateEdit: function(e){
        var rec = e.record;
        var ed = this.colModel.getCellEditor(e.column, e.row);
        var store = ed.field.store;
        
        if( e.field == "ciudad"){
            store.each( function( r ){

                if( r.data.idciudad==e.value ){
                    e.value = r.data.ciudad;
                    rec.set( "idciudad",r.data.idciudad);
                    return true;
                }
            });   
        }
    }
});
</script>