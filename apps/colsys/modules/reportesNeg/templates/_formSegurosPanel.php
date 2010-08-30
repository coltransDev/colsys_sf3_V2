<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

//include_component("widgets", "widgetContactoCliente");

?>
<script type="text/javascript">
    FormSegurosPanel = function( config ){
        Ext.apply(this, config);        
        FormSegurosPanel.superclass.constructor.call(this, {
            activeTab: 0,
            title: 'Seguros',
            buttonAlign: 'center',
            autoHeight: true,            
            items: [
                {
                    xtype:'fieldset',
                    title: 'Informaci�n de Seguros',
                    autoHeight:true,
                    //defaults: {width: 210},
                    items: [
                        {
                            xtype: "hidden",
                            name: "ca_seguro_conf",
                            id: "ca_seguro_conf",
                            value: '<?=$seguro_conf?>'

                        },
                        {
                            xtype: "hidden",
                            name: "ca_seguro",
                            id: "ca_seguro"
                        },
                        {
                        xtype:'fieldset',
                        checkboxToggle:true,
                        title: 'Seguros',
                        autoHeight:true,                        
                        //defaultType: 'textfield',
                        //collapsed: true,
                        width:'100%',
                        id:"seguros",
                        name:"seguros",
                        items: [
                            {
                                xtype:'fieldset',
                                autoHeight:true,
                                layout:'column',
                                columns: 3,
                                columnWidth: .33,
                                items :[
                                {
                                    layout:'column',
                                    border:false,
                                    title: "Valor Asegurado ",
                                    columns: 2,
                                    columnWidth: .3,
                                    fieldLabel: "Valor Asegurado ",
                                    items: [
                                    {
                                        xtype: "numberfield",                                        
                                        name: "ca_vlrasegurado",
                                        id: "ca_vlrasegurado",
                                        width:50
                                    },{
                                        xtype: "combo",                                       
                                        name: "ca_idmoneda_vlr",
                                        id: "ca_idmoneda_vlr",
                                        mode:           'local',
                                        displayField:   'name',
                                        valueField:     'value',
                                        width:          70,
                                        store : [
                                        <?
                                        echo "['','...']";
                                        $i=0;
                                        foreach( $monedas as $moneda ){

                                           echo ",";

                                            echo "['".$moneda->getCaIdmoneda()."','".$moneda->getCaIdmoneda()."']";
                                        }
                                        ?>
                                        ],
                                        typeAhead: true,
                                        forceSelection: true,
                                        triggerAction: 'all',
                                        selectOnFocus:true,
                                        lazyRender:true
                                    }
                                    ]
                                },
                                {
                                    layout: 'column',
                                    border:false,
                                    defaultType: 'textfield',
                                    columns: 3,
                                    columnWidth: .33,
                                    title: "Obtenci�n P�liza ",
                                    items: [
                                    {
                                        xtype: "numberfield",                                        
                                        name: "ca_obtencionpoliza",
                                        id: "ca_obtencionpoliza",
                                        width: 120
                                    },{
                                        xtype: "combo",                                        
                                        name: "ca_idmoneda_pol",
                                        id: "ca_idmoneda_pol",
                                        mode:           'local',
                                        displayField:   'name',
                                        valueField:     'value',
                                        width:          70,

                                        store : [
                                        <?
                                        echo "['','...']";
                                        $i=0;
                                        foreach( $monedas as $moneda ){

                                           echo ",";

                                            echo "['".$moneda->getCaIdmoneda()."','".$moneda->getCaIdmoneda()."']";
                                        }
                                        ?>
                                        ],
                                        typeAhead: true,
                                        forceSelection: true,
                                        triggerAction: 'all',
                                        selectOnFocus:true,
                                        lazyRender:true
                                    }
                                    ]
                                },
                                {
                                    layout: 'column',
                                    border:false,
                                    defaultType: 'textfield',
                                    columns:3,
                                    title:"Prima Venta",
                                    items: [
                                    {
                                        xtype: "numberfield",                                       
                                        name: "ca_primaventa",
                                        id: "ca_primaventa",
                                        width: 120
                                    }
                                    ]
                                },
                                {
                                    layout: 'column',
                                    border:false,
                                    defaultType: 'textfield',
                                    columns:2,
                                    title:"Min",
                                    items: [
                                    {
                                        xtype: "numberfield",                                        
                                        name: "ca_minimaventa",
                                        id: "ca_minimaventa",
                                        width: 120
                                    },
                                    {
                                        xtype: "combo",                                        
                                        name: "ca_idmoneda_vta",
                                        id: "ca_idmoneda_vta",
                                        mode:           'local',
                                        displayField:   'name',
                                        valueField:     'value',
                                        width:          70,

                                        store : [
                                        <?
                                        echo "['','...']";
                                        $i=0;
                                        foreach( $monedas as $moneda ){

                                           echo ",";

                                            echo "['".$moneda->getCaIdmoneda()."','".$moneda->getCaIdmoneda()."']";
                                        }
                                        ?>
                                        ],
                                        typeAhead: true,
                                        forceSelection: true,
                                        triggerAction: 'all',
                                        selectOnFocus:true,
                                        lazyRender:true
                                    }]
                                }
                                ]
                            }
                        ]
                    }]


                }
            ]
        });


    };

    Ext.extend(FormSegurosPanel, Ext.Panel, {
        onSelectContactoCliente: function( combo, record, index){ // override default onSelect to do redirect

            /*if(this.fireEvent('beforeselect', this, record, index) !== false){
                this.setValue(record.data[this.valueField || this.displayField]);
                this.collapse();
                this.fireEvent('select', this, record, index);
            }*/

//            Ext.getCmp("idconcliente").setValue(record.get("idcontacto"));
//            Ext.getCmp("contacto").setValue(record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") );

            /*Ext.getCmp("usuario").setValue(record.get("vendedor"));
            Ext.getCmp("vendedor_id").setValue(record.get("nombre_ven"));*/
            <?
            /*if( $user->getIddepartamento()!=5 ){
            ?>
                //Ext.getCmp("vendedor_id").setRawValue(record.get("nombre_ven"));
                //Ext.getCmp("vendedor_id").hiddenField.value = record.get("vendedor");
            <?
            }*/
            ?>

            //Ext.getCmp("listaclinton").setValue(record.get("listaclinton"));
            //Ext.getCmp("status").setValue(record.get("status"));

//            combo.alertaCliente(record);

        }

    });


</script>
