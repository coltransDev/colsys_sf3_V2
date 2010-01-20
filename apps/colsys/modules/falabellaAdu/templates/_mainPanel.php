<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$header = $sf_data->getRaw( "header" );

?>
<script type="text/javascript">

    var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for('widgets/listaIdsJSON')?>'
        }),
        reader: new Ext.data.JsonReader({
            root: 'root',
            totalProperty: 'totalCount'
        }, [
            {name: 'id', mapping: 'ca_id'},
            {name: 'nombre', mapping: 'ca_nombre'}
        ])
    });



    var resultTpl = new Ext.XTemplate(
    '<tpl for="."><div class="search-item"><b>{nombre}</b></div></tpl>'
);
    var storeTiposTpl = new Ext.XTemplate(
    '<tpl for="."><div class="search-item"><b>{tipo}</b></div></tpl>'
);

    MainPanel = function(){

        this.editorReferencia = new Ext.form.ComboBox({
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            selectOnFocus: true,
            lazyRender:true,
            displayField: 'referencia',
            valueField: 'referencia',
            minChars: 10,
            store: new Ext.data.Store({
                autoLoad : true,
                url: '<?=url_for("widgets/datosComboReferenciaAduana")?>',
                reader: new Ext.data.JsonReader(
                    {
                        root: 'root',
                        totalProperty: 'total'
                    },
                    Ext.data.Record.create([
                        {name: 'referencia', mapping:'ca_referencia', type: 'string'},
                    ])
                )
            })
        });

        this.columns = [
          {
            header: "Referencia",
            dataIndex: 'referencia',
            sortable:false,
            width: 150,
            editor: this.editorReferencia
          },
          {
            header: "Fch.Llegada",
            dataIndex: 'reqd_delivery',
            sortable:false,
            width: 96,
            renderer: Ext.util.Format.dateRenderer('Y-m-d'),
            editor: new Ext.form.DateField({
                format: 'Y-m-d',
                allowBlank: false
            })
          }
        ];

        this.record = Ext.data.Record.create([
                {name: 'iddoc', type: 'string', mapping: 'd_ca_iddoc'},
                {name: 'referencia', type: 'string', mapping: 'd_ca_referencia'},
                {name: 'reqd_delivery', type: 'date', mapping: 'd_ca_reqd_delivery' , dateFormat:'Y-m-d'}
        ]);

        this.store = new Ext.data.Store({

            autoLoad : true,
            proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$header))?>),
            reader: new Ext.data.JsonReader(
                {
                    root: 'root'
                },
                this.record
            )
        });


        MainPanel.superclass.constructor.call(this, {
           id:'main-tabs',
           loadMask: {msg:'Cargando...'},
           clicksToEdit: 1,
           // stripeRows: true,
           // labelAlign: 'top',
           // bodyStyle:'padding:1px',

           view: new Ext.grid.GridView({
                // forceFit:true,
                // enableRowBody:true,
                // showPreview:true,
                getRowClass:this.applyRowClass
            }),

            tbar: [{
                text:'Guardar',
                iconCls: 'disk',
                scope:this,
                handler: this.guardarCambios
            }]

        });

    };

    Ext.extend(MainPanel, Ext.grid.EditorGridPanel, {
        height: 80
        ,
        guardarCambios: function(){
            var store = this.store;
            var records = store.getModifiedRecords();

            var lenght = records.length;

            for( var i=0; i< lenght; i++){
                r = records[i];

                var changes = r.getChanges();

                //Carga un arreglo con los cambios
                changes['id']=r.id;
                changes['iddoc']=r.data.iddoc;

                //envia los datos al servidor
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("falabellaAdu/observeHeader")?>',
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

            var grid = Ext.getCmp("panel-detalle");
            grid.guardarCambios();

        }

    });

</script>