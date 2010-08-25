    <?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
//echo "modo:".$modo.":::::::impoexpo:".$impoexpo;
if($impoexpo==Constantes::IMPO)
{
include_component("widgets", "widgetContinuacion");
$usuarios = $sf_data->getRaw("usuarios");
}
else
{
include_component("widgets", "widgetBodega");
}
?>
<script type="text/javascript">


    FormContinuacionPanel = function( config ){

        Ext.apply(this, config);

		<?
			if($impoexpo==Constantes::IMPO)
			{
		?>
            this.wgContinuacion=new WidgetContinuacion({fieldLabel: 'Continuación',
                                                    id: 'continuacion',
                                                    name: 'continuacion',
                                                    linkTransporte: "transporte",
                                                    linkImpoexpo: "impoexpo"
                                                    })

			this.wgContinuacion.addListener("select", this.onSelectContinuacion, this );
        <?
			}
		?>

        FormContinuacionPanel.superclass.constructor.call(this, {
			
//            deferredRender:false,
            items: [
                /*
                 *========================= Información del Proveedor =========================
                 **/
                {
                    xtype:'fieldset',
                    title: '<?=$title?>',
                    autoHeight:true,
                    id:'Pcontinuacion',
                    items: [

						<?
						if($impoexpo==Constantes::IMPO)
						{
							$keys=array_keys($usuarios);
							$conta=count($keys);
						
						?>
                        this.wgContinuacion,
                        new WidgetCiudad({fieldLabel: 'Destino Final',
                                                  name: 'continuacion_destino',
                                                  id: 'continuacion_destino',
                                                  hiddenName:'continuacion_dest',
                                                  idtrafico: 'CO-057'
                                                })
						,
                        {
                            xtype:'fieldset',
                            title: 'Informar A',
                            autoHeight:true,
                            layout:'column',
                            columns: 2,
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
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                {
                                    xtype: "radio",
                                    fieldLabel: "<?=$usuarios[$keys[$i]]?>",
                                    labelStyle: 'width:150px',
                                    name: "ca_continuacion_conf",
                                    id: "ca_continuacion_conf_<?=$i?>",
                                    inputValue:"<?=$keys[$i]?>"
                                }
                            ]
                            },
<?
                            }
                        $i++;
?>
                                {
                                    xtype: "hidden",
                                    fieldLabel: "",
                                    name: "ss",
                                    id: "ss",
                                    value:""
                                }
                            ]
                        }
						<?
						}
						else
						{
						?>
							{
								xtype:"hidden",
								id: 'continuacion',
								name: 'continuacion',
								value:'DTA'
                            },
							new WidgetBodega({fieldLabel:"Origen",
                                            id: "cont-origen",
                                            hiddenName: "idcont-origen",
                                            width: 600,
                                            linkTransporte: "transporte"
                                           }),
							new WidgetBodega({fieldLabel:"Destino",
                                            id: "cont-destino",
                                            hiddenName: "idcont-origen",
                                            width: 600,
                                            linkTransporte: "transporte"
                                           })
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
//            alert(b.toSource())
            if(record)
            {
                if(record.data.modalidad!=" " && record.data.modalidad!="")
                {
                    Ext.getCmp('idconsignatario').allowBlank=false;
                    Ext.getCmp('bodega_consignar').allowBlank=false;
                }
                else
                {
                    Ext.getCmp('idconsignatario').allowBlank=true;
                    Ext.getCmp('bodega_consignar').allowBlank=true;
                }
            }
            else
            {
                Ext.getCmp('idconsignatario').allowBlank=true;
                Ext.getCmp('bodega_consignar').allowBlank=true;
            }
/*            if(record.data.valor=="Aéreo")
                Ext.getCmp("Pca_comodato").hide();
            else
                Ext.getCmp("Pca_comodato").show();
*/
        }
    });


</script>