    <?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
include_component("widgets", "widgetParametros",array("caso_uso"=>"CU047,CU049,CU050,CU058,CU011"));
?>
<script type="text/javascript">
    FormMercanciaPanel = function( config ){
        Ext.apply(this, config);
        FormMercanciaPanel.superclass.constructor.call(this, {
			items: [
                {
					xtype:'fieldset',
                    title: 'Información de la Mercancia',
                    autoHeight:true,
                    id:'Pmercancia',
                    items: [
                        {
                            xtype: 'textarea',
                            fieldLabel: 'Descripción',
                            hideLabel: true,
                            name: 'ca_mercancia_desc',
                            width: 600,
                            grow: true,
                            id:"ca_mercancia_desc"
                        },
                        {
                            xtype: "checkbox",
                            fieldLabel: "¿Es mercancía peligrosa?",
                            id: "ca_mcia_peligrosa",
							name: "ca_mcia_peligrosa"
                        }
						<?
						if($impoexpo==Constantes::EXPO)
						{
						?>
						,
						{                         
                                autoHeight:true,
                                layout:'column',                                
                                items :[
                                {
                                    layout:'column',
                                    border:false,
                                    title: "Piezas",
                                    columns: 2,
                                    columnWidth: .25,
                                    fieldLabel: "Piezas",
                                    items: [                                        
                                        {
                                            xtype: "numberfield",
                                            name: "npiezas",
                                            id: "npiezas",
                                            width:60
                                        }
                                        ,
                                        new WidgetParametros({
                                                    id: 'mpiezas',
                                                    name: 'mpiezas',
                                                    caso_uso: "CU047",
                                                    width:80
                                                    })


                                    ]
                                },
                                {
                                    layout: 'column',
                                    border:false,
                                    defaultType: 'textfield',
                                    columns: 2,
                                    columnWidth: .25,
                                    title: "Peso",
                                    items: [
                                    {
                                        xtype: "numberfield",
                                        name: "npeso",
                                        id: "npeso",
										width:60
                                    },
                                    new WidgetParametros({
                                                    id: 'mpeso',
                                                    name: 'mpeso',
                                                    caso_uso: "CU049",
                                                    width:80
                                                    })
                                    ]
                                },                                
                                {
                                    layout: 'column',
                                    border:false,
                                    defaultType: 'textfield',
                                    columns: 2,
                                    columnWidth: .25,
                                    title: "Volumen",
                                    items: [
										{
											xtype: "numberfield",
											name: "nvolumen",
											id: "nvolumen",
											width:60
										},
                                        new WidgetParametros({
                                                    id: 'mvolumen',
                                                    name: 'mvolumen',
                                                    caso_uso: "CU058",
                                                    width:80
                                                    })
                                    ]
                                },
								{
                                    layout: 'column',
                                    border:false,
                                    defaultType: 'textfield',
                                    columns: 4,
                                    columnWidth: .25,
                                    title: "Dimensiones",
                                    items: [
										{
											xtype: 'textarea',
											name: 'dimensiones',
											width: '80%',
											grow: true,
											id:"dimensiones"
										}
									]
								}								
                                ]
                            }						
						,
						{
							autoHeight:true,
							layout:'column',
							items :[
								{
									layout:'column',
									border:false,
									title: "Valor Carga (USD)",

									columnWidth: .15,
									items: [
									{
										xtype: "numberfield",
										name: "valor_carga",
										id: "valor_carga"
									}
									]
								},
								{
									layout:'column',
									border:false,
									title: "Agencia de Aduana",
									columnWidth: .35,
									items: [
										{
											xtype: "combo",
											name: "sia",
											id: "sia",
											mode:'local',
											width:350,
											store : [
											<?
											echo "['','...']";
											foreach( $sia as $t ){

											   echo ",";

												echo "['".$t->getCaIdsia()."','".$t->getCaNombre()."']";
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
									layout:'column',
									border:false,
									title: "Tipo Exportacion",
									columnWidth: .25,
									items: [
                                        new WidgetParametros({
                                                    id: 'tipoexpo',
                                                    name: 'tipoexpo',
                                                    caso_uso: "CU011",
                                                    width:230
                                                    })
										
									]
								},
								{
									layout:'column',
									border:false,
									title: "MotoNave/Vuelo",

									columnWidth: .25,
									items: [
									{
										xtype: "textfield",
										name: "notonave",
										id: "motonave"
									}
									]
								}
							]
						}
                        <?
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