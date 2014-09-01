<?
$tipo= $sf_data->getRaw("tipo");
$datos= $sf_data->getRaw("datos");
$adudestino= $sf_data->getRaw("adudestino");
$idreporte=$sf_data->getRaw("idreporte");

include_component("widgets", "widgetCiudad");

//echo $tipo;
//echo $url;
//echo "::".$valido;
?>
<div class="content" align="center">
	<table width='830' cellspacing="1" border="0">
        <?
        if(!$valido || $valido=="")
        {
        ?>
        <tr><td><input value="Aprobar" type="button" onclick="aprobar()"></td></tr>
        <?
        }
        if($tipo=="CP" || $tipo=="OTM")
        {
        ?>
        <tr>
            <td width="100%">                
                <div id="container"></div>
            </td>
        </tr>
        <?
        }
        ?>
		<tr>
			<td class="partir" style='text-align:center; font-weight:bold; background:#FF0000;' >Favor Imprimir en Tamaño <b>CARTA</b>. Configure su impresora 8,5 x 11 pulg. ó 216 mm x 279 mm</td>
		</tr>
	</table>	
	<iframe src ='<?=$url?>' width='830' height='650' ></iframe>
	<br />
	<br />
<script language="javascript">
    
Ext.onReady(function(){

    var tabs = new Ext.FormPanel({
        labelWidth: 90,
        border:false,
        frame:true,
        deferredRender:false,
        width: 900,
        standardSubmit: true,
        id: 'formPanel',
        items: 
                    {
                        xtype:'fieldset',
                        title: '',
                        autoHeight : true,
                        layout : 'column',
                        columns : 2,
                        defaults:{
                            columnWidth:0.5,
                            layout:'form',
                            border:false,
                            bodyStyle:'padding:4px;'
                        },
                        items :
                        [
                            {
                                xtype:'hidden',
                                name:"opcion",
                                value:"buscar"
                            },
                            {
                                columnWidth:.5,
                                border:false,
                                items:
                                [
                                <?
                                if($tipo=="OTM")
                                {
                                ?>
                                    {
                                        xtype:'datefield',
                                        fieldLabel: 'Fecha finalizacion',
                                        name : 'fechafinalizacion',
                                        format: "Y-m-d",
                                        value: '<?=$datos["fechafinalizacion"]?>'
                                    },
                                    {
                                        xtype:'datefield',
                                        fieldLabel: 'Fecha de Arribo',
                                        name : 'fcharribo',
                                        format: "Y-m-d",
                                        value: '<?=$datos["fcharribo"]?>'
                                    },
                                    new WidgetCiudad({fieldLabel: 'Administración Aduanera Destino',
                                        id: 'adudestino',
                                        idciudad:"adudestino",
                                        hiddenName:"ciu_destino",
                                        tipo:"1",
                                        impoexpo:"<?=constantes::EXPO?>",
                                        allowBlank:true,
                                        value:"<?= $adudestino ?>",
                                        hiddenValue:"<?= $ciu_destino ?>",
                                        width:219
                                    })
                                <?
                                }
                                else
                                {
                                ?>
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'No Continuacion',
                                        name : 'continuacion',
                                        id : 'continuacion',
                                        value: '<?=$datos["nocontinuacion"]?>'
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'No Factura',
                                        name : 'nofactura',
                                        id : 'nofactura',
                                        value: '<?=$datos["nofactura"]?>'
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Conse Dest Final',
                                        name : 'nodestinofinal',
                                        id : 'nodestinofinal',
                                        value: '<?=$datos["nodestinofinal"]?>'
                                    }
                                <?
                                }
                                ?>
                                    
                                ]
                            },
                            {
                                columnWidth:.5,
                                border:false,
                                items:
                                [
                                <?
                                if($tipo=="OTM")
                                {
                                ?>
                                    {
                                        xtype:'datefield',
                                        fieldLabel: 'Fecha vencimiento',
                                        name : 'fechavencimiento',
                                        format: "Y-m-d",
                                        value: '<?=$datos["fechavencimiento"]?>'
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Manifiesto No',
                                        name : 'manifiesto',
                                        id : 'manifiesto',
                                        value: '<?=$datos["manifiesto"]?>'
                                    }
                                <?
                                }
                                else
                                {
                                ?>
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Observaciones',
                                        name : 'observaciones',
                                        id : 'Observaciones',
                                        value: '<?=$datos["observaciones"]?>'
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'No Comodato',
                                        name : 'nocomodato',
                                        id : 'nocomodato',
                                        value: '<?=$datos["nocomodato"]?>'
                                    }
                                <?
                                }
                                ?>
                                ]
                            }
                        ]
        },
        buttons: [
                {
            text: 'Continuar',
            handler: function(){
                        var owner=Ext.getCmp("formPanel");                    
                        //owner.getForm().getEl().dom.action='<?=url_for("otm/guardarCP?idreporte=".$idreporte)?>';
                        owner.getForm().submit();
                }
        }]
    });
    tabs.render("container");

});
    
    function aprobar(id,tipo)
    {
        if(window.confirm("Esta seguro de Aprobar este reporte?"))
        {
            Ext.MessageBox.wait('Aprobando, Espere por favor', '');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("otm/aprobarReporte") ?>',
                params : {
                    id: '<?=$idreporte?>',
                    tipo: '<?=$tipo?>'
                },
                failure:function(response,options){
                    alert( response.responseText );
                    Ext.Msg.hide();
                    success = false;
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        alert( " El numero generado es : "+res.consecutivo );
                        location.href=location.href;
                    }
                }
            });
        }
    }
</script>