<?
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$tipos = $sf_data->getRaw("tipos");
include_component("gestDocumental", "widgetUploadButton");
?>
<script type="text/javascript">
/**
 * PanelEntregas object definition
 **/

cantDocumentos = new Ext.Toolbar.TextItem('0');
cantRecuperacion = new Ext.Toolbar.TextItem('0');
cantPerdida = new Ext.Toolbar.TextItem('0');

PanelEntregas = function( config ){
    Ext.apply(this, config);
    
    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30});
    
    this.columns = [       
      //this.checkColumn,
      {
        header: "Etapa",
        dataIndex: 'stage',
        sortable:true,
        width: 150,
        editor: new Ext.form.TextField({
                allowBlank: false
        })
      },
      {
        header: "Detalles",
        dataIndex: 'detail',
        sortable:true,
        width: 250,
        editor: new Ext.form.TextField({
                allowBlank: false
        })
      },
      {
            header: "Fch. Estimada Entrega",
            dataIndex: 'estimated',
            //hideable: false,
            sortable: true,
            width: 130,
            //hidden: true,
            renderer: Ext.util.Format.dateRenderer('Y-m-d'),
            editor: new Ext.form.DateField({
                    format: 'Y-m-d'
            })
        },
        {
            header: "Fch. Entrega",
            dataIndex: 'delivery',
            //hideable: false,
            sortable: true,
            width: 130,
            editable: false,
            //hidden: true,
            renderer: Ext.util.Format.dateRenderer('Y-m-d H:i:s'),
            editor: new Ext.form.DateField({
                    format: 'Y-m-d H:i:s'
            })
        }
    ];

    this.record = Ext.data.Record.create([
        {name: 'sel', type: 'boolean'},
        {name: 'idticket', type: 'integer'},
        {name: 'idstage', type: 'string'},
        {name: 'stage', type: 'string'},
        {name: 'detail', type: 'string'},
        {name: 'estimated', type: 'date', dateFormat:'Y-m-d'},
        {name: 'delivery', type: 'date', dateFormat:'Y-m-d H:i:s'}
    ]);

    this.store = new Ext.data.Store({
        autoLoad : false,
        url: '<?=url_for("pm/datosEntregasTicket")?>',
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record
        ),
        sortInfo: {field: 'idstage', direction: 'ASC'} //,
        
    });

    PanelEntregas.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       autoHeight: true,
       autoWidth : true,
       scroll: true,
       plugins: [this.checkColumn],
       
       tbar: [
           {
               text:'Nuevo Registro',
               iconCls: 'add',
               scope:this,
               handler: this.nuevoRegistro
           }, {
               text:'Recargar',
               iconCls: 'refresh',
               scope:this,
               handler: this.recargar
           }, {
               text:'Guardar',
               iconCls: 'disk',
               scope:this,
               handler: this.guardarCambios
           }
       ],
       listeners:{            
           rowcontextmenu: this.onRowcontextMenu,
           afterEdit: this.onAfterEdit,
           beforeedit: this.onBeforeEdit,
           validateedit: this.onValidateEdit       
       }
    });
}

Ext.extend(PanelEntregas, Ext.grid.EditorGridPanel, {
    height: 300,
    nuevoRegistro: function(){
        var recordFile = this.record;
        var store = this.store;
        var record = new recordFile({
            sel:false,
            idticket: this.idticket,
            stage: '',
            details: '',
            estimated: '',
            delivery: ''
        });
        records = [];
        records.push( record );
        store.insert( 0, records );
    },
    recargar: function(){

        if(this.store.getModifiedRecords().length>0){
            if(!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
                return 0;
            }
        }
        this.store.reload();
    },
    guardarCambios: function(){
        var store = this.store;
        var records = store.getModifiedRecords();
        var entrega = "<b><i>PROGRAMACION DE ENTREGAS:</i></b><br/>";
        var lenght = records.length;
        
        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();
            changes['id']=r.id;
            changes['idticket']=r.data.idticket;
            changes['idstage']=r.data.idstage;
            
            //envia los datos al servidor
            Ext.Ajax.request({
                waitMsg: 'Guardando cambios...',
                url: '<?=url_for("pm/guardarEntregas")?>',
                //method: 'POST',
                //Solamente se envian los cambios
                params :	changes,

                callback :function(options, success, response){

                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.id && res.success!="false"){
                        var rec = store.getById( res.id );

                        rec.set("sel", false); //Quita la seleccion de todas las columnas
                        rec.commit();
                        
                        var d = new Date(res.data.estimated); 
                        d_string = d.format("Y-m-d");
                        
                        entrega+= "<b>" + res.data.stage.toUpperCase()+"</b><br/>";
                        entrega+= "<i>Fecha Estimada de Entrega</i>: <b>"+d_string+"</b><br/>";
                        entrega+= "<i>Detalles:</i><ul><li>" + res.data.detail + "</li></ul><br/><br/>";
                        Ext.MessageBox.alert('Etapas','Se ha(n) creado el(los) registro(s) correctamente.');
                        
                    }else{
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+" "+(res.errorInfo?"\n Codigo HTTP "+res.errorInfo:""));
                    }
                }
            });
        }
        var win = Ext.getCmp("crear-entregas-win");
        if(win){
            win.close();
        }
        var panel = Ext.getCmp("respuesta-ticket-panel");
        if(panel){            
            var res = panel.getForm().findField("respuesta").getValue();
            panel.getForm().findField("respuesta").setValue(res + "\n<br />"+entrega);
        }
    },    
    onRowcontextMenu: function(grid, index, e){
        rec = this.store.getAt(index);

        if(!this.menu){ // create context menu on first right click

            this.menu = new Ext.menu.Menu({
            id:'grid_productos-ctx',
            enableScrolling : false,
            items: [                   
                    {
                        text: 'Seleccionar todo',
                        iconCls: 'arrow_left',
                        scope:this,
                        handler: this.seleccionarTodo
                    },{
                        text: 'Duplicar item',
                        iconCls: 'add',
                        scope:this,
                        handler: this.duplicarItem
                    }
                    ]
            });
            this.menu.on('hide', this.onContextHide , this);
        }
        e.stopEvent();
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
        this.ctxRecord = rec;
        this.ctxRow = this.view.getRow(index);
        Ext.fly(this.ctxRow).addClass('x-node-ctx');
        this.menu.showAt(e.getXY());
    },

    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    },

    duplicarItem : function(){
        
    },

    formatItem: function(value, p, record) {
        return String.format(
            '<b>{0}</b>',
            value
        );
    },

    onAfterLoad : function(e) {
        //this.calcSum();
    },

    onAfterEdit : function(e) {
        //this.calcSum();
        if(e.record.data.sel){
            var records = this.store.getModifiedRecords();
            var lenght = records.length;
            var field = e.field;

            for( var i=0; i< lenght; i++){
                r = records[i];
                if(r.data.sel){
                    if( (r.data.tipo=="concepto"||r.data.tipo=="recargo") ){
                        continue;
                    }
                    r.set(field,e.value);
                }
            }
        }
    },

    calcSum: function() {
        var records = this.store.getRange();
        var lenght = records.length;
        var cant_doc = 0;
        var cant_rec = 0;
        var cant_per = 0;
        for( var i=0; i< lenght; i++){
            r = records[i];
            if (isNaN(r.get("documento"))){
                cant_doc+= 1;
            }
            cant_rec+= Number(r.get("recuperacion"));
            cant_per+= Number(r.get("perdida"));
        }
        Ext.fly(cantDocumentos.getEl()).update(cant_doc);
        Ext.fly(cantRecuperacion.getEl()).update(cant_rec);
        Ext.fly(cantPerdida.getEl()).update(cant_per);
    },

    seleccionarTodo: function() {
        var grid = Ext.getCmp(this.id);
        var store = grid.getStore();

        store.each( function( r ){
           r.set("sel", true);
        });
    },

    setDataUrl: function(url){
        this.dataUrl = url;
        this.store.proxy = new Ext.data.HttpProxy( {url: url});
    },
            
    onValidateEdit: function(e){
      //  alert( e.field + e.value);
        /*if( e.field == "starred"){
            alert("OK");

        }*/
    },
    onBeforeEdit: function(e){
        //dalert( e.field + e.value);
        if(e.value != "" && e.value != null){
            return false;
        }
    }

});
</script>