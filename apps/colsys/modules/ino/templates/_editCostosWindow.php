<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$conceptos = $sf_data->getRaw("conceptos");
?>

<script type="text/javascript">
    EditCostoWindow = function( config ) {
        Ext.apply(this, config);
        this.ctxRecord = null;

        this.dataConceptos = <?= json_encode(array("root" => $conceptos)) ?>;
        
        this.storeConceptos = new Ext.data.Store({
            autoLoad : true,
            proxy: new Ext.data.MemoryProxy( this.dataConceptos ),
            reader: new Ext.data.JsonReader(
            {
                id: 'idconcepto',
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'idconcepto',  mapping: 'c_ca_idconcepto'},
                {name: 'concepto',  mapping: 'c_ca_concepto'},
                {name: 'centro',  mapping: 'c_ca_idconcepto'},
                {name: 'idccosto',  mapping: 'cc_ca_idccosto'},
                {name: 'codigo'}
            ])
        )
        });

        this.editorConceptos = new Ext.form.ComboBox({

            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            selectOnFocus: true,
            mode: 'local',
            displayField: 'concepto',
            valueField: 'idconcepto',
            fieldLabel: 'Costo',
            lazyRender:true,
            listClass: 'x-combo-list-small',
            store : this.storeConceptos
        });

        this.items = [
            {
                columnWidth:.5,
                layout: 'form',
                labelAlign: "top",
                items: [{
                        xtype:'textfield',
                        fieldLabel: 'Comprobante',
                        name: 'tipo',
                        anchor:'95%',
                        allowBlank: false
                    },
                    {
                        xtype:'numberfield',
                        fieldLabel: 'Numero',
                        name: 'numero',
                        anchor:'95%',
                        allowBlank: false
                    },
                    this.editorConceptos,
                    new WidgetIds({
                        name: 'ids',
                        hiddenName: 'id',
                        fieldLabel: 'Proveedor'
                    }),
                    {
                        xtype:'numberfield',
                        fieldLabel: 'Valor',
                        name: 'valor',
                        anchor:'95%',
                        allowBlank: false,
                        allowNegative: false
                    },
                    {
                        xtype:'numberfield',
                        fieldLabel: 'Cambio',
                        name: 'valor',
                        anchor:'95%',
                        allowBlank: false,
                        allowNegative: false
                    },
                    {
                        xtype:'numberfield',
                        fieldLabel: 'Pesos',
                        name: 'valor_pesos',
                        anchor:'95%',
                        allowBlank: false,
                        allowNegative: false
                    }
                    



                    

                ]
            }
        ];

    

        this.buttons = [
            {
                text: 'Cancelar',
                handler: this.close.createDelegate(this, [])
            }
        ];



        EditCostoWindow.superclass.constructor.call(this, {
            title: "Formulario costos",
            autoHeight: true,
            width: 800,
            //height: 400,
            resizable: false,
            plain:true,
            modal: true,
            y: 100,
            autoScroll: true,
            closeAction: 'close',
            id: 'edit-auditoria-win',
            buttons: this.buttons,
            items: this.items
        
        });

        //this.addEvents({add:true});
    }

    Ext.extend(EditCostoWindow, Ext.Window, {


        show : function(){
            if(this.rendered){
                //this.feedUrl.setValue('');
            }

            //this.grid.store.setBaseParam( "idproject", this.idproject);
            //this.grid.store.load();

            EditCostoWindow.superclass.show.apply(this, arguments);
        }



    });

</script>
