<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
include_component("widgets", "widgetParametros",array("caso_uso"=>"CU047,CU049,CU050,CU058,CU011,CU089,CU092,CU227"));
?>
<script type="text/javascript">
    FormMercanciaPanel = function( config ){
        Ext.apply(this, config);
        FormMercanciaPanel.superclass.constructor.call(this, {
			items:[
                {
					xtype:'fieldset',
                    title:'Información de la Mercancia',
                    autoHeight:true,
                    id:'Pmercancia',
                    items:[
                        {
                            xtype:'textarea',
                            fieldLabel:'Descripción',
                            name:'ca_mercancia_desc',
                            width:500,
                            grow:true,
                            id:"ca_mercancia_desc",
                            tabIndex:this.tabIndex
                        },
                        {
                            xtype:"checkbox",
                            fieldLabel:"¿Es mercancía peligrosa?",
                            id:"ca_mcia_peligrosa",
							name:"ca_mcia_peligrosa",
                            tabIndex:this.tabIndex++
                        }<?
                        
						if($impoexpo!=Constantes::EXPO )
						{
						?>,
                        {
                            xtype:"checkbox",
                            fieldLabel:"Declaración Anticipada",
                            id:"ca_declaracionant",
							name:"ca_declaracionant",
                            tabIndex:this.tabIndex++,
                            listeners:{
                                "check": function(inCheckbox, inChecked){
                                    var subarancelaria = Ext.getCmp("ca_subarancelaria");                                    
                                    if(inChecked){
                                        subarancelaria.show();
                                    }else{
                                        subarancelaria.hide();
                                    }
                                }
                            }
                        },
                        {
                            xtype:"textfield",
                            fieldLabel:"Subpartida Arancelaria",
                            name:"ca_subarancelaria",
                            id:"ca_subarancelaria",
                            width:120,
                            hidden: true,
                            minLength:4
                        }
						<?
                        }
						if($impoexpo==Constantes::EXPO || $tipo=="4")
						{
						?>
						,
						{                         
                            autoHeight:true,
                            layout:'column',                                
                            items:[
                            {
                                layout:'column',
                                border:false,
                                title:"Piezas",
                                columns:2,
                                columnWidth:.25,
                                fieldLabel:"Piezas",
                                items:[
                                    {
                                        xtype:"numberfield",
                                        name:"npiezas",
                                        id:"npiezas",
                                        width:60
                                    },
                                    new WidgetParametros({
                                                id:'mpiezas',
                                                name:'mpiezas',
                                                caso_uso:"CU047",
                                                width:80,
                                                idvalor:"valor"
                                                })
                                ]
                            },
                            {
                                layout:'column',
                                border:false,
                                defaultType:'textfield',
                                columns:2,
                                columnWidth:.25,
                                title:"Peso",
                                items:[
                                {
                                    xtype:"numberfield",
                                    name:"npeso",
                                    id:"npeso",
                                    width:60
                                },
                                new WidgetParametros({
                                                id:'mpeso',
                                                name:'mpeso',
                                                caso_uso:"CU049",
                                                width:80,
                                                idvalor:"valor"
                                                })
                                ]
                            },                                
                            {
                                layout:'column',
                                border:false,
                                defaultType:'textfield',
                                columns:2,
                                columnWidth:.25,
                                title:"Volumen",
                                items:[
                                    {
                                        xtype:"numberfield",
                                        name:"nvolumen",
                                        id:"nvolumen",
                                        width:60
                                    },
                                    new WidgetParametros({
                                                id:'mvolumen',
                                                name:'mvolumen',
                                                caso_uso:"<?=($modo==Constantes::AEREO)?"CU058":"CU050"?>",
                                                width:80,
                                                idvalor:"valor"
                                                })
                                ]
                            },
                            <?
                            if($impoexpo==Constantes::EXPO)
                            {
                            ?>
                            {
                                layout:'column',
                                border:false,
                                defaultType:'textfield',
                                columns:4,
                                columnWidth:.25,
                                title:"Dimensiones",
                                items:[
                                    {
                                        xtype:'textarea',
                                        name:'dimensiones',
                                        width:'80%',
                                        grow:true,
                                        id:"dimensiones"
                                    }
                                ]
                            }
                            <?
                            }
                            else
                            {
                            ?>
                                                            {
                                layout:'column',
                                border:false,
                                defaultType:'textfield',
                                columns:4,
                                columnWidth:.25,
                                title:"Valor Fob (USD)",
                                items:[
                                    {
                                        xtype:'numberfield',
                                        name:'valor_fob',
                                        width:'80%',                                        
                                        id:"valor_fob"
                                    }
                                ]
                            }                                
                            <?
                            }
                            ?>
                            ]
                        }						
						,
                        <? 
                        if($impoexpo==Constantes::EXPO)
                        {
                        ?>
						{
							autoHeight:true,
							layout:'column',
							items:[
								{
									layout:'column',
									border:false,
									title:"Valor Carga (USD)",

									columnWidth:.15,
									items:[
									{
										xtype:"numberfield",
										name:"valor_carga",
										id:"valor_carga"
									}
									]
								},
								{
									layout:'column',
									border:false,
									title:"Agencia de Aduana",
									columnWidth:.35,
									items:[
										{
											xtype:"combo",
											id:"sia",
                                            hiddenName:"idsia",
											mode:'local',
											width:350,
											store:[
											<?
											echo "['','...']";
											foreach( $sia as $t ){

											   echo ",";

												echo "['".$t->getCaIdsia()."','".$t->getCaNombre()."']";
											}
											?>
											],
											typeAhead:true,
											forceSelection:true,
											triggerAction:'all',
											selectOnFocus:true,
											lazyRender:true
										}
									]
								},

								{
									layout:'column',
									border:false,
									title:"Tipo Exportacion",
									columnWidth:.25,
									items:[
                                        new WidgetParametros({
                                                    id:'tipoexpo',
                                                    caso_uso:"CU011",
                                                    width:230,
                                                    hiddenName:"idtipoexpo"
                                                    })
										
									]
								},
								{
									layout:'column',
									border:false,
									title:"<?=$nave?>",

									columnWidth:.25,
									items:[
									{
										xtype:"textfield",
										name:"motonave",
										id:"motonave"
									}
									]
								}
							]
						}
                        <?
                        if($modo==constantes::MARITIMO)
                        {
                        ?>,
                        {
							autoHeight:true,
							layout:'column',
							items:[
                            {
									layout:'column',
									border:false,
									title:"Lugar de emisión BL",
									columnWidth:.25,
									items:[
                                        new WidgetParametros({
                                                    id:'emisionbl',
                                                    name:'emisionbl',
                                                    hiddenName:'idemisionbl',
                                                    caso_uso:"CU089",
                                                    width:150,                                                    
                                                    idvalor:"valor"
                                                    })

									]
								},
								{
									layout:'column',
									border:false,
									title:"Cuantos BL?",
									columnWidth:.75,
									items:[
									{
										xtype:"numberfield",
										name:"ca_numbl",
										id:"ca_numbl"
									}
									]
								}
							]
						}
                        <?
                        }
						}
                        }
						?>
						
                    ]
				}
			]
        });
    };

    Ext.extend(FormMercanciaPanel, Ext.Panel, {

    });
</script>