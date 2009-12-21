<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

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
    /*
var storeTipos = new Ext.data.Store({
    autoload: true,
    proxy: new Ext.data.MemoryProxy(<?=json_encode($tipos)?>),
    reader: new Ext.data.JsonReader({
                        root: 'root',
                        totalProperty: 'total'
                    },
                    new Ext.data.Record.create([
                            {name: 'idtipo', type: 'string'},
                            {name: 'tipo', type: 'string'}
                    ])
                )
});*/

    var storeTiposTpl = new Ext.XTemplate(
    '<tpl for="."><div class="search-item"><b>{tipo}</b></div></tpl>'
);

    MainPanel = function(){

        this.comboReferencia = new Ext.form.ComboBox({
            fieldLabel: 'Referencia',
            valueField:'referencia',
            displayField:'referencia',
            typeAhead: true,
            width: 200,
            emptyText:'',
            value: '<?=$fala_header->getCaReferencia();?>',
            forceSelection:true,
            selectOnFocus:true,
            allowBlank:false,
            name:'referencia',
            id:'referencia',
            triggerAction: 'all',
            store: new Ext.data.Store({
                autoLoad : true,
                url: '<?=url_for("widgets/datosComboReferenciaAduana")?>',
                reader: new Ext.data.JsonReader(
                {
                    root: 'root',
                    totalProperty: 'total'
                },
                Ext.data.Record.create([
                    {name: 'referencia', mapping:'ca_referencia', type: 'string'}

                ])
            )

            })           
           
        });

        this.preview = new Ext.Panel({
            id: 'preview',

            defaults:{autoHeight:true, bodyStyle:'padding:5px'},

            items: [{
                            layout: 'form',
                            
                            items: [
                                this.comboReferencia
                            ]
                        }

                    ]

        });

        MainPanel.superclass.constructor.call(this, {
            id:'main-tabs',
            labelAlign: 'top',
            bodyStyle:'padding:1px',
            //fileUpload: true,
            items: [
                this.preview
            ],
             tbar: [{
                text:'Guardar',
                iconCls: 'disk',
                scope:this,
                handler: this.guardarCambios
            }]

        });

    };

    Ext.extend(MainPanel, Ext.FormPanel, {

        guardarCambios: function(){
            var referencia = Ext.getCmp("referencia").getValue();
            Ext.Ajax.request({
                        waitMsg: 'Guardando Cambios...',
                        url: '<?=url_for("falabellaAdu/observeHeader?iddoc=".base64_encode($fala_header->getCaIddoc()))?>', 						//method: 'POST',
                        //Solamente se envian los cambios
                        params : { referencia:referencia },

                        callback :function(options, success, response){

                                var res = Ext.util.JSON.decode( response.responseText );
                                if( res.success ){
                                    //alert("se ha actualizado");

                                }
                        }
                     }
            );

            var grid = Ext.getCmp("panel-detalle");
            grid.guardarCambios();

        }



    });

</script>