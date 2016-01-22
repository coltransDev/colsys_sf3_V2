    <?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

if($impoexpo!=Constantes::EXPO)
{
include_component("widgets","widgetContinuacion");
$usuarios = $sf_data->getRaw("usuarios");
}
else
{
include_component("widgets","widgetBodega");
}
?>
<script type="text/javascript">


    FormContinuacionPanel=function( config ){

        Ext.apply(this, config);

		<?
			if($impoexpo!=Constantes::EXPO)
			{
		?>
            this.wgContinuacion=new WidgetContinuacion({fieldLabel:'Continuación',
                                                    id:'continuacion',
                                                    name:'continuacion',
                                                    linkTransporte:"transporte",
                                                    linkImpoexpo:"impoexpo"
                                                    });

			this.wgContinuacion.addListener("select",this.onSelectContinuacion, this );
		<?
            }
			if(($modo==Constantes::MARITIMO || $modo==Constantes::TERRESTRE) && $tipo!="AG")
			{
		?>
                        this.widgetCotizacionOtm = new WidgetCotizacion({
                                              fieldLabel:"Cotización",
                                              id:"cotizacionotm",
                                              hiddenName:"idcotizacionotm",
                                              modo:"<?=constantes::OTMDTA?>",
                                              impoexpo:"<?=constantes::IMPO?>",
                                              valueField:"consecutivo"
                                              });
                this.widgetCotizacionOtm.addListener("select", this.onSelectCotizacionOtm, this );
        <?
            
			}
		?>

        FormContinuacionPanel.superclass.constructor.call(this, {

            items: [
                {
                    xtype:'fieldset',
                    title:'<?=$title?>',
                    autoHeight:true,
                    id:'Pcontinuacion',
                    items:[
						<?
						if($impoexpo!=Constantes::EXPO )
						{
							$keys=array_keys($usuarios);
							$conta=count($keys);

                            if( ($modo==Constantes::MARITIMO || $modo==Constantes::TERRESTRE ) && $tipo!="AG" )
                            {
						?>
                        this.widgetCotizacionOtm,
                        <?
                            }
                        ?>
                        this.wgContinuacion,
                        new WidgetCiudad({fieldLabel:'Destino Final',
                                                  name:'continuacion_destino',
                                                  id:'continuacion_destino',
                                                  hiddenName:'continuacion_dest',                                                  
                                                  impoexpo:"<?=constantes::TRIANGULACION?>"                                                  
                                                })
                        <?
                        if( ($modo==Constantes::MARITIMO || $modo==Constantes::TERRESTRE ) && $tipo!="AG" )
                        {
                        ?>,
                        {
                            xtype:"hidden",
                            id:"idproductootm",
                            name:"idproductootm"
                        }                        
			,
                        {
                            xtype:'fieldset',
                            title:'Informar A',
                            autoHeight:true,
                            layout:'column',
                            columns:2,
                            defaults:{
                                columnWidth:'<?=(1/$conta)?>',
                                layout:'form',
                                border:false
                            },
                            items :[
<?							
                            $i=0;

                            for($i=0;$i<$conta;$i++  )
                            {
?>
                            {
                                columnWidth:'<?=(1/$conta)?>',
                                layout:'form',
                                border:false,
                                defaultType:'textfield',
                                items: [
                                    {
                                        xtype:"radio",
                                        fieldLabel:"<?=$usuarios[$keys[$i]]?>",
                                        labelStyle:'width:150px',
                                        name:"ca_continuacion_conf",
                                        id:"ca_continuacion_conf_<?=$keys[$i]?>",
                                        inputValue:"<?=$keys[$i]?>"
                                    }
                                ]
                            },
<?
                            }
                        $i++;
?>
                                {
                                    xtype:"hidden",
                                    fieldLabel:"",
                                    name:"ss",
                                    id:"ss",
                                    value:""
                                }
                            ]
                        }
						<?
                        }
						}
						else
						{

                        if($modo==Constantes::MARITIMO && $tipo!="AG" )
                            {
						?>
                        {
                            xtype:"hidden",
                            id:"idproductootm",
                            name:"idproductootm"
                        },
                        this.widgetCotizacionOtm,
                        <?
                            }
						?>
							{
								xtype:"hidden",
								id:'continuacion',
								name:'continuacion',
								value:'DTA'
                            },
							new WidgetBodega({fieldLabel:"Origen",
                                            id:"cont-origen",
                                            hiddenName:"idcont-origen",
                                            width:600,
                                            linkTransporte:"transporte"
                                           }),
                          <?
                          if($modo==Constantes::MARITIMO && $tipo!="AG" )
                          {
                          ?>
							new WidgetBodega({fieldLabel:"Destino",
                                            id:"cont-destino",
                                            hiddenName:"idcont-destino",
                                            width:600,
                                            linkTransporte:"transporte"
                                           })
                           <?
                          }
                          else
                          {
                          ?>
                           new WidgetCiudad({fieldLabel:'Destino Final',
                              name:'continuacion_destino',
                              id:'continuacion_destino',
                              hiddenName:'continuacion_dest',
                              idtrafico:'CO-057'
                            })
                          <?
                          }
                           ?>
						<?
						}
						?>
                    ]
                }

            ]
        });
    };

    Ext.extend(FormContinuacionPanel, Ext.Panel, {
        onSelectContinuacion: function( combo, record, index){
            if(record)
            {
                 if(record.data.modalidad=="OTM")
                {
                    Ext.getCmp('idconsignatario').allowBlank=false;
                    Ext.getCmp('bodega_consignar').allowBlank=false;
                    if(Ext.getCmp('importador'))
                    {
                        Ext.getCmp('importador').setDisabled(false);
                        
                    }                    
                }
                else
                {
                    Ext.getCmp('idconsignatario').allowBlank=true;
                    Ext.getCmp('bodega_consignar').allowBlank=true;
                    if(Ext.getCmp('importador'))
                        Ext.getCmp('importador').setDisabled(true);
                }
            }
            else
            {
                Ext.getCmp('idconsignatario').allowBlank=true;
                Ext.getCmp('bodega_consignar').allowBlank=true;
                if(Ext.getCmp('importador'))
                        Ext.getCmp('importador').setDisabled(true);
            }

        },
        onSelectCotizacionOtm: function( combo, record, index){
            if(Ext.getCmp("continuacion_destino"))
            {
                if(Ext.getCmp("continuacion_destino").getValue()=="")
                {
                    Ext.getCmp("continuacion_destino").setValue(record.data.iddestino);
                    $("#continuacion_destino").val(record.data.destino);
                }
            }
            if(Ext.getCmp("continuacion"))
            {
                if(Ext.getCmp("continuacion").getValue()=="")
                {
                    Ext.getCmp("continuacion").setValue(record.data.producto);
                }
            }
            Ext.getCmp("idproductootm").setValue(record.data.idproducto);
        }
    });
</script>