<?php
    include_component("reportesGer","formMenuImpresionblPanel");
?>

<div align="center" id="container" ></div>

<?
if($opcion){
?>
    <table width="80%" border="1" class="tableList" align="center">
        <tr>
            <th colspan="6" scope="col" style=" text-align: center"><b>IMPRESION BL'S EN DESTINO</b></th>
        </tr>    
        <tr>
            <th scope="col" style=" text-align: center">Fecha de Arribo</th>
            <th scope="col" style=" text-align: center">Cliente</th>
            <th scope="col" style=" text-align: center">BL</th>
            <th scope="col" style=" text-align: center">Agente</th>
            <th scope="col" style=" text-align: center">Origen</th>
            <th scope="col" style=" text-align: center">Sucursal</th>
        </tr>
<?
    foreach($bls as $bl){
?>
        <tr>
            <tr>
            <td><?=$bl["im_ca_fcharribo"]?></td>
            <td><?=$bl["cl_ca_compania"]?></td>
            <td><?=$bl["ic_ca_hbls"]?></td>
            <td><div align="left"><?=$bl["d_ca_nombre"]?></div></td>
            <td><?=$bl["c_ca_ciudad"]?></td>
            <td><?=$bl["s_ca_nombre"]?></td>
            </tr>
        </tr>
<?
        $array[] = $bl;
        $cuantos = count($array);
    }
?>
    </table>

    <br/>
    <br/>
    <table class="tableList" align="center" width="30%">
        <tr>
            <th colspan="3" style="text-align: center"><b>RESUMEN IMPRESION BL'S EN DESTINO</b></th>
        </tr>
        <tr>
            <th colspan="1"><b>Periodo:</b></th>
            <td colspan="2"><b><?=$fechaInicial?></b> al <b><?=$fechaFinal?></b></td>
        </tr>
        <tr>
            <th colspan="1"><b>Origen:</b></th>
            <td colspan="2"><?echo $origen?$origen:"Todas las Ciudades";?></td>
        </tr>
        <tr>
            <th colspan="1"><b>Agente:</b></th>
            <td colspan="2"><?echo $agente?$agente:"Todos los Agentes";?></td>
        </tr>
        <tr>
            <th colspan="1"><b>Sucursal:</b></th>
            <td colspan="2"><?echo $idsucursal?$idsucursal:"Todas las Sucursales";?></td>
        </tr>

            <th colspan="2"><b>Total BL's impresos en destino:</b></th>
            <td colspan="1"><font color="red"><b><?=$cuantos?></b></font></td>

    </table>

<?
}
?>

<script language="javascript">
   
var tabs = new Ext.FormPanel({
	labelWidth: 75,
	border:true,
	fame:true,
	width: 600,    
	standardSubmit: true,  
        id: 'formPanel',
	items: {
		xtype: 'tabpanel',
		activeTab: 0,
		defaults:{autoHeight:true, bodyStyle:'padding:10px'},
		id: 'tab-panel', 
		items:[
                new FormMenuImpresionblPanel()              
        ]
	},
	buttons: [
            {
                text: 'Continuar',
                handler: function(){
                            var tp = Ext.getCmp("tab-panel");

                            var owner=Ext.getCmp("formPanel");
                            if( tp.getActiveTab().getId()=="estadisticas"){
                                owner.getForm().getEl().dom.action='<?=url_for("reportesGer/impresionbl")?>';
                            }
                            owner.getForm().submit();
                }
            }]
});
tabs.render("container");

 </script>