<?
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

$idreporte=$sf_data->getRaw("idreporte");
$emails=$sf_data->getRaw("emails");
//$fecha_aprobacion=$sf_data->getRaw("fecha_aprobacion");



?>
<div class="content" align="center">
	<table width='100%' cellspacing="1" border="0">

        <tr><td>
<?

        //if($fchAprobacion=="")
        {
?>
                <input value="Aprobar" type="button" onclick="aprobar()">
<?

        }
        //else
        if($fchAprobacion!=""){
            echo "Usuario Aprobacion : ".$usuAprobacion."  Fecha Aprobacion : ".$fchAprobacion;
            ?>
                <br><input value="Notificar" type="button" onclick="notificar()">
            <?
        }
?>
            </td>
        </tr>
        
	</table>	
	<iframe src ='/reportesNeg2/generarServicioPDF/id/<?=$idreporte?>' width='100%' height='650' ></iframe>
	<br />
	<br />
        
        <?
    /*if( ($idantecedente!="" && $idantecedente>0) && $reporte->getCaVersion()>1  )
    {
        echo '<div class="x-panel-header x-unselectable" id="ext-gen7" style="-moz-user-select: none;"><span class="x-panel-header-text" id="ext-gen9">Control de Cambios</span></div>';
        echo $html;
    }*/
	if( count($emails)>0 ){
	?>
    <br />
    <br />
    
	<table width="80%" border="0" class="tableList">
            <tr>
                <th width="28%" scope="col"><b>Fecha<b></th>
                <th width="31%" scope="col"><b>Usuario</b></th>
                <th width="30%" scope="col"><b>Asunto</b></th>
                <th width="30%" scope="col"><b>e-mail</b></th>
            </tr>
	<?			
        foreach( $emails as $e ){
        ?>
            <tr>
                <td ><a href="/email/verEmail/id/<?=$e->getCaIdemail() ?>"><?=$e->getCaFchenvio() ?></a></td>
                <td ><?=$e->getCaUsuenvio()?></td>
                <td ><?=$e->getCaSubject()?></td>
                <td ><?=$e->getCaAddress()?></td>
                
            </tr>
        </table>
        <?
	}
        }
    ?>
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
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Placa',
                                        name : 'placa',
                                        id : 'placa',
                                        value: '<?=$datos["placa"]?>'
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
    
    
    
function aprobar(id,tipo)
{
    if(window.confirm("Esta seguro de Aprobar este reporte?"))
    {
        Ext.MessageBox.wait('Aprobando, Espere por favor', '');
        Ext.Ajax.request(
        {
            waitMsg: 'Guardando cambios...',
            url: '<?= url_for("reportesNeg2/aprobarReporte") ?>',
            params : {
                id: '<?=$idreporte?>'
            },
            failure:function(response,options){
                alert( response.responseText );
                Ext.Msg.hide();
                success = false;
            },
            success:function(response,options){
                var res = Ext.util.JSON.decode( response.responseText );
                if( res.success ){
                    alert( " Reporte Aprobado " );
                    location.href=location.href;
                }
            }
        });
    }
}

function notificar()
{
    window.location.replace("/reportesNeg2/emailSolicitud/idreporte/<?=$idreporte?>");
}
    
    
</script>


