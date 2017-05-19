<?
include_component("reportesNeg", "filtrosBusqueda");
?>
<script>
function importar(id,idnew)
{
    if(window.confirm("Realmente desea importar este reporte"))
    {
        Ext.MessageBox.wait('Importando reporte, Espere porf favor', 'Importar');
        Ext.Ajax.request(
        {
            waitMsg: 'Guardando cambios...',
            url: '<?=url_for("reportesNeg/importarReporte")?>',
            params :	{
                idreportenew: idnew,
                idreporte: id
            },
                failure:function(response,options){
                alert( response.responseText );
                success = false;
            },
            success:function(response,options){
                var res = Ext.util.JSON.decode( response.responseText );
                if( res.success ){
                    location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/impoexpo/"+res.impoexpo+"/modo/"+res.transporte;
                }
            }
        });
    }
}
</script>
<div align="center">
    <table width="800px" border="1" class="tableList alignLeft">
            <tr>
                    <th width="70" scope="col">Consecutivo</th>
                    <th width="668" scope="col">Trayecto</th>
            </tr>
            <?
        $consecutivo="";
        if($reportes){
            foreach( $reportes as $reporte ){

                $origen = $reporte["ca_ciuorigen"];
                $destino = $reporte["ca_ciudestino"];

                $proveedorCli = array();
                $incoterms = "";

                 if( $reporte["ca_idproveedor"] ){
                    $values = explode("|", $reporte["ca_idproveedor"]);
                    $orden = explode("|", $reporte["ca_orden_prov"]);
                    for($i=0;$i<count($values);$i++){
                        $tercero = Doctrine::getTable("Tercero")->find($values[$i]);
                        $proveedorCli[] = $tercero->getCaNombre().' - '.$orden[$i];                    
                    }

                    $incoterms = $reporte["ca_incoterms"];
                }
            ?>
            <tr style="<?=($consecutivo==$reporte["ca_consecutivo"])?"":"border-top: 3px solid #A0A0A0" ?>">
                <td rowspan="2">
                    <?
                    if($idimpo>0)
                    {
                     ?>
                    <a href="javascript:importar('<?=$idimpo?>','<?=$reporte["ca_idreporte"]?>')"><?=(($consecutivo==$reporte["ca_consecutivo"])?"":$reporte["ca_consecutivo"])." V".$reporte["ca_version"]?></a>
                    <?
                    }else
                    {
                        if($opcion=="otmmin")
                        {
                            $url = "reportesNeg/consultaReporte?id=".$reporte["ca_idreporte"]."&modo=".Constantes::TERRESTRE."&impoexpo=".Constantes::OTMDTA.($opcion?"&opcion=".$opcion:"");
                        }
                        else
                            $url = "reportesNeg/consultaReporte?id=".$reporte["ca_idreporte"]."&modo=".$reporte["ca_transporte"]."&impoexpo=".(($reporte["ca_impoexpo"]=="OTM/DTA")?"OTM-DTA":$reporte["ca_impoexpo"]).($opcion?"&opcion=".$opcion:"");
                        echo link_to((($consecutivo==$reporte["ca_consecutivo"])?"":$reporte["ca_consecutivo"])." V".$reporte["ca_version"], $url );

                    }
                    if($reporte["ca_usuanulado"]!="")
                        echo "<br>Anulado";
                    else if($reporte["ca_usucerrado"]!="")
                        echo "<br>Cerrado";


                    if(strpos($reporte["ca_propiedades_cli"], "cuentaglobal=true") !== false || strpos($reporte["ca_propiedades_cli"], "cuentaglobal=1") !== false)
                    {
                    ?>
                    <br><img src="/images/CG30.png" title="Cliente de Cuentas Globales" />
                    <?
                    }
                    if($reporte["ca_transporte"]==Constantes::AEREO)
                        $class="aereo";
                    else if($reporte["ca_transporte"]==Constantes::MARITIMO)
                        $class="maritimo";
                    else if($reporte["ca_transporte"]==Constantes::TERRESTRE)
                        $class="terrestre";
                    ?>
                    <div class="trans_<?=$class?>"></div>                
                </td>

                <td  >
                    <?="<b>".$reporte["ca_nombre_cli"]."</b> (".$reporte["ca_transporte"]." ".$reporte["ca_modalidad"].") - ".$reporte["ca_nomlinea"]?>
                    </td>
            </tr>
            <tr  >
                <td width="100%"  >
                    <table width="100%"  >
                            <tr  style="font-weight: bold;background:#D2D2D2;">
                                <td  >Origen</td>
                                <td  >Destino</td>
                                <td width="15%" >Fch.Despacho</td>
                                <td width="15%" >T.Incoterms</td>
                                <td width="15%" >Orden</td>
                                <td width="15%" >Cot</td>
                            </tr>
                            <tr>
                                <td class="listar"><?=$origen?></td>
                                <td class="listar"><?=$destino?></td>
                                <td class="listar"><?=$reporte["ca_fchdespacho"]?></td>
                                <td class="listar"><?=$incoterms?></td>
                                <td class="listar"><?=$reporte["ca_orden_clie"]?></td>
                                <td class="listar"><?=$reporte["ca_idcotizacion"]?></td>
                            </tr>
                            <tr>
                                <td class="invertir" style="font-weight: bold;">Proveedor</td><td colspan="5" class="listar">
                                    <?=$proveedorCli?implode("<br/>",$proveedorCli):"";?>
                                </td>
                            </tr>                   
                    </table></td>
            </tr>
            <?
            $consecutivo=$reporte["ca_consecutivo"];
            }
        }
        ?>
    </table>
</div>