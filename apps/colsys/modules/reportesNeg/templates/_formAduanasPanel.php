<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
?>
<script type="text/javascript">


    FormAduanasPanel = function( config ){

        Ext.apply(this, config);
        
        FormAduanasPanel.superclass.constructor.call(this, {
            activeTab:0,
            title:'Aduanas',
            buttonAlign:'center',
            autoHeight:true,
            id:'id-form-aduanas-panel',
            items:[
                {
                    xtype:'fieldset',
                    title: 'Información de Aduanas',
                    autoHeight:true,
                    items: [{
                        xtype:'fieldset',
                        checkboxToggle:true,
                        title:'Aduanas',
                        autoHeight:true,
                        defaults:{width: 210},
                        defaultType:'textfield',
                        collapsed:true,
                        id:"aduanas",
                        name:"aduanas",
                        items:[
                            {
                                xtype:"hidden",
                                name:"ca_colmas",
                                id:"ca_colmas"
                            },
                            {
                                xtype:"combo",
                                fieldLabel:"Coordinador",                                
                                id:"id_ca_coordinador",
                                hiddenName:"ca_coordinador",
                                mode:'local',
                                displayField:'name',
                                valueField:'value',
                                store:new Ext.data.ArrayStore({
                                    fields:['value', 'name' ],
                                    data:[
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
                                typeAhead:true,
                                forceSelection:true,
                                triggerAction:'all',
                                selectOnFocus:true,
                                lazyRender:true
                            },
                            {
                                xtype:"textarea",
                                fieldLabel:"Instrucciones Especiales",
                                name:"ca_instrucciones",
                                id:"ca_instrucciones"
                            }
                        ]
                    }]
                }
            ]
        });
    };

    Ext.extend(FormAduanasPanel, Ext.Panel, {
    });


</script>