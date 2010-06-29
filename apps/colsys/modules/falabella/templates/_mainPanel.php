<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$header = $sf_data->getRaw( "header" );
$container = $sf_data->getRaw( "container" );

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

        this.editorReporte = new Ext.form.ComboBox({
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            selectOnFocus: true,
            lazyRender:true,
            displayField: 'reporte',
            valueField: 'reporte',
            minChars: 3,
            store: new Ext.data.Store({
                autoLoad : true,
                url: '<?=url_for("widgets/datosComboReporteNegocios")?>',
                reader: new Ext.data.JsonReader(
                    {
                        root: 'root',
                        totalProperty: 'total'
                    },
                    Ext.data.Record.create([
                        {name: 'reporte', mapping:'ca_reporte', type: 'string'},
                    ])
                )
            })
        });

        this.editorContainerMode = new Ext.form.ComboBox({
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            selectOnFocus: true,
            mode: 'local',
            lazyRender:true,
            store :
                [
                <?
                    $i=0;
                    foreach($container as $mode){
                        if($i++!=0){
                            echo ",";
                        }
                        echo "[\"".$mode->getCaValor2()."\",\"".$mode->getCaValor()."\"]";
                    }
                ?>
                ]
        });


        this.columns = [
          {
            header: "Reporte",
            dataIndex: 'reporte',
            sortable:false,
            width: 150,
            editor: this.editorReporte
          },
          {
            header: "N�mero del Viaje",
            dataIndex: 'num_viaje',
            sortable:false,
            width: 100,
            editor: new Ext.form.TextField({
                                    allowBlank: false
                            })
          },
          {
            header: "C�digo Estandard Transportista",
            dataIndex: 'cod_carrier',
            sortable:false,
            width: 170,
            editor: new Ext.form.TextField({
                                    allowBlank: false
                            })
          },
          {
            header: "Container Mode",
            dataIndex: 'container_mode',
            sortable:false,
            width: 150,
            editor: this.editorContainerMode
          },
          {
            header: "Numero de Factura",
            dataIndex: 'numero_invoice',
            sortable:false,
            width: 150,
            editor: new Ext.form.TextField({
                                    allowBlank: false
                            })
          },
          {
            header: "Monto de Factura",
            dataIndex: 'monto_invoice_miles',
            sortable:false,
            width: 180,
            align: 'right',
            renderer: 'usMoney',
            editor: new Ext.form.NumberField({
                                    allowBlank: false ,
                                    allowNegative: false,
                                    style: 'text-align:left',
                                    decimalPrecision :2
                            })
          }
        ];

        this.record = Ext.data.Record.create([
                {name: 'iddoc', type: 'string', mapping: 'd_ca_iddoc'},
                {name: 'reporte', type: 'string', mapping: 'd_ca_reporte'},
                {name: 'num_viaje', type: 'string', mapping: 'd_ca_num_viaje'},
                {name: 'cod_carrier', type: 'string', mapping: 'd_ca_cod_carrier'},
                {name: 'container_mode', type: 'string', mapping: 'd_ca_container_mode'},
                {name: 'numero_invoice', type: 'string', mapping: 'd_ca_numero_invoice'},
                {name: 'monto_invoice_miles', type: 'string', mapping: 'd_ca_monto_invoice_miles'}
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
        height: 90,
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
                        url: '<?=url_for("falabella/observeHeader")?>',
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