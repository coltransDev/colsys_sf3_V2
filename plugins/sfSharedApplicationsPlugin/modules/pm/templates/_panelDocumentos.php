<?
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$documentos = $sf_data->getRaw( "documentos" );
$tipos = $sf_data->getRaw("tipos");
include_component("gestDocumental", "widgetUploadButton");
?>
<script type="text/javascript">
/**
 * PanelDocumentos object definition
 **/

cantDocumentos = new Ext.Toolbar.TextItem('0');
cantRecuperacion = new Ext.Toolbar.TextItem('0');
cantPerdida = new Ext.Toolbar.TextItem('0');


PanelDocumentos = function( config ){
    Ext.apply(this, config);
    
    this.docTipos = <?=json_encode(array("root" => $tipos))?>;
    
    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30});

    this.bbar = new Ext.ux.StatusBar({
        id: 'word-status',

        // These are just the standard toolbar TextItems we created above.  They get
        // custom classes below in the render handler which is what gives them their
        // customized inset appearance.
        items: ['No. Documentos: ', cantDocumentos, 'Total Recuperación: ', cantRecuperacion, 'Total Pérdida: ', cantPerdida, '&nbsp;&nbsp;&nbsp;&nbsp;']
    });

    this.editorTipoDocumento = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        lazyRender:true,
        valueField: 'valor',
        displayField: 'valor',
        store : new Ext.data.Store({
            autoLoad : true ,
            proxy: new Ext.data.MemoryProxy( this.docTipos ),
            reader: new Ext.data.JsonReader(
            {

                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'tipo'},
                {name: 'valor'}
            ])
        )
        })
    });
    
    this.columns = [       
      this.checkColumn,
      {
        header: "Módulo/Tipo.Doc",
        dataIndex: 'tipo_documento',
        sortable:true,
        width: 150,
        editor: this.editorTipoDocumento
      },
      {
        header: "Documento/Referencia",
        dataIndex: 'documento',
        sortable:true,
        width: 250,
        editor: new Ext.form.TextField({
				allowBlank: false
			})
      },
      {
        header: "Recuperación",
        dataIndex: 'recuperacion',
        sortable:false,
        width: 150,
        align: 'right',
        renderer: 'usMoney',
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :2
			})
      },
      {
        header: "Pérdida",
        dataIndex: 'perdida',
        sortable:false,
        width: 150,
        align: 'right',
        renderer: 'usMoney',
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: true,
				style: 'text-align:left',
				decimalPrecision :2
			})
      },
      {
        header: "Observaciones",
        dataIndex: 'observaciones',
        sortable:true,
        width: 400,
        editor: new Ext.form.TextField({
				allowBlank: true
			})
      }
    ];

    this.record = Ext.data.Record.create([
            {name: 'sel', type: 'boolean'},
            {name: 'idticket', type: 'string'},
            {name: 'idauditdocs', type: 'string'},
            {name: 'tipo_documento', type: 'string'},
            {name: 'documento', type: 'string'},
            {name: 'recuperacion', type: 'string'},
            {name: 'perdida', type: 'string'},
            {name: 'observaciones', type: 'string'},
        ]);

    this.store = new Ext.data.Store({

        autoLoad : true,
        proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$documentos))?>),
        reader: new Ext.data.JsonReader(
            {
                root: 'root'
            },
            this.record
        ),
        sortInfo: {field: 'idauditdocs', direction: 'DESC'} //,
        
    });

    this.tipos = new Ext.data.Store({

        autoLoad : true,
        proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$documentos))?>),
        reader: new Ext.data.JsonReader(
            {
                root: 'root'
            },
            this.record
        ),
        sortInfo: {field: 'tipo_documento', direction: 'ASC'} //,
        
    });

    PanelDocumentos.superclass.constructor.call(this, {
       id:'panel-documentos',
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       //autoHeight: true,
       autoWidth : true,
       scroll: true,
       plugins: [this.checkColumn],
       
       tbar: [{
               text:'Guardar',
               iconCls: 'disk',
               scope:this,
               handler: this.guardarCambios
             }, new WidgetUploadButton({
                    text: "Importar Archivo",
                    iconCls: 'arrow_up',
                    folder: "<?=base64_encode("tmp")?>",
                    filePrefix: "",
                    confirm: true,
                    callback: "Ext.getCmp('panel-documentos').actFile"
                })
            ],
       listeners:{            
           rowcontextmenu: this.onRowcontextMenu,
           afterEdit: this.onAfterEdit
       }
    });
}

Ext.extend(PanelDocumentos, Ext.grid.EditorGridPanel, {
    height: 300,
    guardarCambios: function(){
        var store = this.store;
        var records = store.getModifiedRecords();

        var lenght = records.length;

        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();
            changes['id']=r.id;
            changes['idticket']=r.data.idticket;
            changes['idauditdocs']=r.data.idauditdocs;
            
            //envia los datos al servidor
            Ext.Ajax.request(
                {
                    waitMsg: 'Guardando cambios...',
                    url: '<?=url_for("pm/observeDocuments")?>',
                    //method: 'POST',
                    //Solamente se envian los cambios
                    params :	changes,

                    callback :function(options, success, response){

                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.id && res.success){
                            var rec = store.getById( res.id );

                            rec.set("sel", false); //Quita la seleccion de todas las columnas
                            rec.commit();
                        }
                    }
                 }
            );

        }
    },
    
    actFile:function (file)
    {
        var store = this.store; // Llama el store para obtener el Idticket
        var records = store.getRange();
        r = records[0];
                
        Ext.MessageBox.wait('Procesando', '');

        Ext.Ajax.request(
        {
            url: '<?=url_for("pm/procesarArchivoDocs")?>',
            params :	{
                idticket: r.data.idticket,
                archivo: file
            },
            failure:function(response,options){
                var res = Ext.util.JSON.decode( options.response.responseText );

                Ext.Msg.hide();
                success = false;
                alert("Surgio un problema al procesar el archivo")
            },
            success:function(response,options){
                var res = Ext.util.JSON.decode( response.responseText );
                if( res.success ){
                    //alert(res.reportes.toSource());
                    //reportes=Ext.util.JSON.decode(res.reportes);
                    //alert(res.reportes.length);
                    recordReportes = Ext.getCmp('panel-documentos').record;
                    storeReportes=Ext.getCmp('panel-documentos').getStore();
                    for(i=0;i<res.reportes.length;i++)
                    {

                     var newRec = new recordReportes({
                            idreporte: res.reportes[i].ca_idreporte,
                            consecutivo: res.reportes[i].ca_consecutivo,
                            hbl: res.reportes[i].doctransporte,
                            cliente: res.reportes[i].compania                                
                        });
                        storeReportes.addSorted(newRec);
                        storeReportes.sort("orden", "ASC");
                    }

                    alert("Se Proceso correctamente");
                    $("#resul").html("<p>Resumen:</p>"+res.resultado);
                    //location.href="/antecedentes/listadoReferencias/format/maritimo";
                }
            }
        });
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
        this.calcSum();
    },

    onAfterEdit : function(e) {
        this.calcSum();
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
        var grid = Ext.getCmp("panel-documentos");
        var store = grid.getStore();

        store.each( function( r ){
           r.set("sel", true);
        });
    },

    setDataUrl: function(url){
        this.dataUrl = url;
        this.store.proxy = new Ext.data.HttpProxy( {url: url});
    }

});
</script>