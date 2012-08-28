<?
$tipo= $sf_data->getRaw("tipo");
$datos= $sf_data->getRaw("datos");
$idreporte=$sf_data->getRaw("idreporte");
//print_r($datos);
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
        if($tipo=="CP")
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
        labelWidth: 75,
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
                                    {
                                        xtype:'datefield',
                                        fieldLabel: 'Fecha finalizacion',
                                        name : 'fechafinalizacion',
                                        format: "Y-m-d",
                                        value: '<?=$datos["fechafinalizacion"]?>'
                                    },
                            /*        {
                                        xtype:'textfield',
                                        fieldLabel: 'Direccion Deposito',
                                        name : 'direccion',
                                        id : 'direccion',
                                        value: '<?=$direccion?>'
                                    },*/
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'No Continuacion',
                                        name : 'continuacion',
                                        id : 'continuacion',
                                        value: '<?=$datos["nocontinuacion"]?>'
                                    }
                                ]
                            },
                            {
                                columnWidth:.5,
                                border:false,
                                items:
                                [
                                    {
                                        xtype:'datefield',
                                        fieldLabel: 'Fecha vencimiento',
                                        name : 'fechavencimiento',
                                        format: "Y-m-d",
                                        value: '<?=$datos["fechavencimiento"]?>'
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Observaciones',
                                        name : 'observaciones',
                                        id : 'Observaciones',
                                        value: '<?=$datos["observaciones"]?>'
                                    }
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
                        location.href=location.href;
                    }
                }
            });
        }
    }
</script>