<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

//include_component("widgets", "widgetContactoCliente");

?>
<script type="text/javascript">


    FormAduanasPanel = function( config ){

        Ext.apply(this, config);

        
        FormAduanasPanel.superclass.constructor.call(this, {
            activeTab: 0,
            title: 'Aduanas',
            buttonAlign: 'center',
            autoHeight: true,
            id:'id-form-aduanas-panel',
            items: [
                {

                    xtype:'fieldset',
                    title: 'Información de Aduanas',
                    autoHeight:true,
                    //defaults: {width: 210},

                items: [{
                        xtype:'fieldset',
                        checkboxToggle:true,
                        title: 'Aduanas',
                        autoHeight:true,
                        defaults: {width: 210},
                        defaultType: 'textfield',
                        collapsed: true,
                        id:"aduanas",
                        name:"aduanas",
                        items :[
                            {
                                xtype: "hidden",
                                name: "ca_colmas",
                                id: "ca_colmas"
                            },
                            {
                                xtype: "combo",
                                fieldLabel: "Coordinador",
                                //name: "ca_coordinador",
                                id: "id_ca_coordinador",
                                hiddenName: "ca_coordinador",
                                mode:           'local',
                                displayField:   'name',
                                valueField:     'value',
                                store:  new Ext.data.ArrayStore({
                                    fields: ['value', 'name' ],
                                    data : [
                                    <?
                                        $i=0;
                                        foreach( $usuarios as $usuario ){
                                            if($i++!=0){
                                                echo ",";
                                            }
                                            echo "['".$usuario->getCaLogin()."','".$usuario->getCaNombre()."']";
                                        }
                                    ?>
                                    ]
                                }),
                                typeAhead: true,
                                forceSelection: true,
                                triggerAction: 'all',
                                selectOnFocus:true,
                                lazyRender:true
                            },                            
                            {
                                xtype: "textarea",
                                fieldLabel: "Instrucciones Especiales",
                                name: "ca_instrucciones",
                                id: "ca_instrucciones"
                            }
                        ]
                    }]
                }

            ]
        });


    };

    Ext.extend(FormAduanasPanel, Ext.Panel, {
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