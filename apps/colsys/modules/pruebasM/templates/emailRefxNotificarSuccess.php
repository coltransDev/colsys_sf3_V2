<?

$reportes = $sf_data->getRaw( "reportes" );

$referencias = $sf_data->getRaw( "referencias" );
//echo count($referencias)."-";
$refBloqueadas = $sf_data->getRaw( "refBloqueadas" );
//echo count($refBloqueadas)."-";
$refRechazadas = $sf_data->getRaw( "refRechazadas" );
//echo count($refRechazadas)."-";
$refSinAceptar = $sf_data->getRaw( "refSinAceptar" );
//echo count($refSinAceptar)."-";
?>
<script>
    function enviar()
    {
        obj=$("input:checked");
        /*for(i=0;i<obj.length;i++)
        {
            alert( obj.val() );
        }*/
        $("#formData").submit();
    }
</script>

<form id="formData" name="formData" method="post" action="#">
<div class="content" align="center">
    <input value="Enviar" type="button" onclick="javascript:enviar()">
</div>
<div class="content" align="center">
    
    <br>
    <h2> Reportes</h2>
    <br />
    <table class="tableList" width="900px" border="1" id="mainTable">
        <tr>
            <th width="70" scope="col">No Reporte</th>
            <th width="70" scope="col">Fecha Salida</th>
            <th width="70" scope="col">Fecha Llegada</th>
            <th width="70" scope="col">Origen</th>
            <th width="70" scope="col">Destino</th>
            <th width="70" scope="col">Cliente</th>
            <th width="70" scope="col">T.transito</th>
            <th width="70" scope="col">T. Tran. Actual</th>
            <th width="70" scope="col">% T. Transito</th>
            <th width="70" scope="col">Creador</th>
            <th width="70" scope="col">Vendedor</th>            
        </tr>
        <?
        $i=0;
        foreach( $reportes as $r ){

            $url = "reportesNeg/verReporte?consecutivo=".$r["ca_consecutivo"];
            //r.ca_idreporte,r.ca_consecutivo,r.ca_fchllegada,ca_ciuorigen,ca_ciudestino,ca_login,ca_nombre_cli,ca_usucreado
        ?>
        <tr>
            <td>
                <?=link_to($r["ca_consecutivo"], $url)?>
                <br><?=$r["ca_fchcreado"]?>
            </td>            
            <td>
                <?=$r["ca_fchsalida"]?>
            </td>
            <td>
                <?=$r["ca_fchllegada"]?>
            </td>
            <td>
                <?=$r["ca_ciuorigen"]?>
            </td>
            <td>
                <?=$r["ca_ciudestino"]?>
            </td>
            <td>
                <?=$r["ca_nombre_cli"]?>
            </td>
            <td>
                <?=$r["dtransito"]?>
            </td>
            <td>
                <?=round($r["dtransitoactual"],1)?>
            </td>
            <td style="background-color: <?=($r["%transito"]>59)?"red":""?>">
                <?=$r["%transito"]?>%
            </td>
            <td>
                <?=$r["ca_usucreado"]?>
            </td>
            <td>
                <?=$r["ca_login"]?>
            </td>
        </tr>
        <?
        }
        ?>
    </table>
    <br>
    
    <h2> Referencias Creadas sin Enviar</h2>
    <br />
    <table class="tableList" width="900px" border="1" id="mainTable">
        <tr>
            <th width="70" scope="col">Referencia</th>
            <th width="70" scope="col">Modalidad</th>
            <th width="70" scope="col">Origen</th>
            <th width="70" scope="col">Destino</th>
            <th width="70" scope="col">Motonave</th>
            <th width="70" scope="col">ETD</th>
            <th width="70" scope="col">ETA</th>
            <th width="70" scope="col">Creador</th>
            <th width="70" scope="col">F. Creacion</th>
            <th width="70" scope="col">F. Embarque</th>
            <th width="70" scope="col">F. Arribo</th>
            <th width="70" scope="col">T. Transito</th>
            <th width="70" scope="col">T. Tran. Actual</th>
            <th width="70" scope="col">% T. Transito</th>
            <th width="70" scope="col">T. Antecedentes</th>
            <th width="70" scope="col">T. Antece. Actual</th>
            <th width="70" scope="col">% T. Antecedentes</th>
            <th width="70" scope="col">Envios</th>
            <th width="30" scope="col"></th>
        </tr>
        <?
        $i=0;
        foreach( $refBloqueadas as $referencia ){   
            //echo $referencia["ca_provisional"];
            $i++;

            $url = "antecedentes/verPlanilla?ref=".str_replace(".","|",$referencia["ca_referencia"]);

            if( $format ){
                $url.="&format=".$format;
            }
        ?>
        <tr>
            <td>
                <?=link_to($referencia["ca_referencia"], $url)?>
            </td>
            <td  >
                <?=$referencia["ca_modalidad"]?>
            </td>
            <td>
                <?=$referencia["ca_ciu_origen"]?>
            </td>
            <td>
                <?=$referencia["ca_ciu_destino"]?>
            </td>
            <td>
                <?=$referencia["ca_motonave"]?>
            </td>
            <td>
                <?=$referencia["ca_fchembarque"]?>
            </td>
            <td>
                <?=$referencia["ca_fcharribo"]?>
            </td>
            <td  >
                <?=$referencia["ca_usucreado"]?>
            </td>
            
            <td>
                <?=$referencia["ca_fchcreado"]?>
            </td>
            
            <td>
                <?=$referencia["ca_fchembarque"]?>
            </td>
            <td>
                <?=$referencia["ca_fcharribo"]?>
            </td>
            <td>
                <?=$referencia["ttransito"]?>
            </td>
            <td>
                <?=round($referencia["ttransitoctual"])?>
            </td>
            <td style="background-color: <?=($referencia["%transito"]>59)?"red":""?>"  >
                <?=Utils::formatNumber($referencia["%transito"],1)?>%
            </td>
            <td>
                <?=$referencia["tantecedentes"]?>
            </td>
            <td>
                <?=round($referencia["tantecedentesctual"])?>
            </td>
            <td style="background-color: <?=($referencia["%antecedentes"]>59)?"red":""?>"  >
                <?=Utils::formatNumber($referencia["%antecedentes"],1)?>%
            </td>
            <td><?=$referencia["nenvios"]?></td>
            <td><input type="checkbox" id="ref<?=$referencia["ca_referencia"]?>" name="referencia[]" value="<?=$referencia["ca_referencia"]?>" ></td>            
        </tr>
        <?
        }
        if( $i==0 ){
            ?>
            <tr>
                <td colspan="7" >
                    <div align="center">No hay registros</div>
                </td>
            </tr>
            <?
        }
        ?>
    </table>
<?
//if( $format=="" )
{
?>
    <br>
    <h2> Referencias rechazadas</h2>
    <br />
    <table class="tableList" width="900px" border="1" id="mainTable">
        <tr>
            <th width="70" scope="col">Referencia</th>
            <th width="70" scope="col">Modalidad</th>
            <th width="70" scope="col">Origen</th>
            <th width="70" scope="col">Destino</th>
            <th width="70" scope="col">Motonave</th>
            <th width="70" scope="col">ETD</th>
            <th width="70" scope="col">ETA</th>
            <th width="70" scope="col">Creador</th>
            <th width="70" scope="col">Creador</th>
            <th width="70" scope="col">F. Envio</th>
            <th width="70" scope="col">F. Embarque</th>
            <th width="70" scope="col">F. Arribo</th>
            <th width="70" scope="col">T. Transito</th>
            <th width="70" scope="col">T. Tran. Actual</th>
            <th width="70" scope="col">% T. Transito</th>
            <th width="70" scope="col">T. Antece.</th>
            <th width="70" scope="col">T. Antece. Actual</th>
            <th width="70" scope="col">% T. Antece</th>
            <th width="70" scope="col">Envios</th>            
            <th width="30" scope="col"></th>
        </tr>
        <?
        $i=0;
        foreach( $refRechazadas as $referencia ){            
            $i++;

            $url = "antecedentes/verPlanilla?ref=".str_replace(".","|",$referencia["ca_referencia"]);

            if( $format ){
                $url.="&format=".$format;
            }
        ?>
        <tr>
            <td>
                <?=link_to($referencia["ca_referencia"], $url)?>
            </td>
            <td>
                <?=$referencia["ca_modalidad"]?>
            </td>
            <td>
                <?=$referencia["ca_ciu_origen"]?>
            </td>
            <td>
                <?=$referencia["ca_ciu_destino"]?>
            </td>
            <td>
                <?=$referencia["ca_motonave"]?>
            </td>
            <td>
                <?=$referencia["ca_fchenvio"]?>
            </td>
            <td>
                <?=$referencia["ca_fchembarque"]?>
            </td>
            <td>
                <?=$referencia["ca_fcharribo"]?>
            </td>
            <td>
                <?=$referencia["ca_usucreado"]?>
            </td>
            <td>
                <?=$referencia["ca_fchcreado"]?>
            </td>
            <td>
                <?=$referencia["ca_fchembarque"]?>
            </td>
            <td>
                <?=$referencia["ca_fcharribo"]?>
            </td>            
            <td>
                <?=$referencia["ttransito"]?>
            </td>
            <td>
                <?=round($referencia["ttransitoctual"])?>
            </td>
            <td style="background-color: <?=($referencia["%transito"]>59)?"red":""?>"  >
                <?=Utils::formatNumber($referencia["%transito"],1)?>%
            </td>
            <td>
                <?=$referencia["tantecedentes"]?>
            </td>
            <td>
                <?=round($referencia["tantecedentesctual"])?>
            </td>
            <td style="background-color: <?=($referencia["%antecedentes"]>59)?"red":""?>"  >
                <?=Utils::formatNumber($referencia["%antecedentes"],1)?>%
            </td>
            <td><?=$referencia["nenvios"]?></td>
            <td><input type="checkbox" id="ref<?=$referencia["ca_referencia"]?>" name="referencia[]" value="<?=$referencia["ca_referencia"]?>" ></td>
        </tr>
        <?
        }

        if( $i==0 ){
            ?>
            <tr>
                <td colspan="7" >
                    <div align="center">No hay registros</div>
                </td>
            </tr>
            <?
        }
        ?>
    </table>
    <br>
    <h2> Referencias Sin Aceptar</h2>
    <br />
    <table class="tableList" width="900px" border="1" id="mainTable">
        <tr>
            <th width="70" scope="col">Referencia</th>
            <th width="70" scope="col">Modalidad</th>
            <th width="70" scope="col">Origen</th>
            <th width="70" scope="col">Destino</th>
            <th width="70" scope="col">Motonave</th>
            <th width="70" scope="col">ETD</th>
            <th width="70" scope="col">ETA</th>
            <th width="70" scope="col">Creador</th>
            <th width="70" scope="col">Creador</th>
            <th width="70" scope="col">F. Envio</th>
            <th width="70" scope="col">F. Embarque</th>
            <th width="70" scope="col">F. Arribo</th>
            <th width="70" scope="col">T. Transito</th>
            <th width="70" scope="col">T. Tran. Actual</th>
            <th width="70" scope="col">% T. Transito</th>            
            <th width="70" scope="col">Envios</th>
            <th width="30" scope="col"></th>
        </tr>
        <?
        $i=0;
        foreach( $refSinAceptar as $referencia ){            
            $i++;
            $url = "antecedentes/verPlanilla?ref=".str_replace(".","|",$referencia["ca_referencia"]);
            if( $format ){
                $url.="&format=".$format;
            }
        ?>
        <tr>
            <td>
                <?=link_to($referencia["ca_referencia"], $url)?>
            </td>
            <td>
                <?=$referencia["ca_modalidad"]?>
            </td>
            <td>
                <?=$referencia["ca_ciu_origen"]?>
            </td>
            <td>
                <?=$referencia["ca_ciu_destino"]?>
            </td>
            <td>
                <?=$referencia["ca_motonave"]?>
            </td>
            <td>
                <?=$referencia["ca_fchembarque"]?>
            </td>
            <td>
                <?=$referencia["ca_fcharribo"]?>
            </td>
            <td>
                <?=$referencia["ca_usucreado"]?>
            </td>
            <td>
                <?=$referencia["ca_fchcreado"]?>
            </td>
            <td>
                <?=$referencia["ca_fchenvio"]?>
            </td>
            <td>
                <?=$referencia["ca_fchembarque"]?>
            </td>            
            <td>
                <?=$referencia["ca_fcharribo"]?>
            </td>            
            <td>
                <?=$referencia["ttransito"]?>
            </td>
            <td>
                <?=round($referencia["ttransitoctual"])?>
            </td>
            <td style="background-color: <?=($referencia["%transito"]>59)?"red":""?>">
                <?=Utils::formatNumber($referencia["%transito"],1)?>%
            </td>            
            <td><?=$referencia["nenvios"]?></td>
            <td><input type="checkbox" id="ref<?=$referencia["ca_referencia"]?>" name="referencia[]" value="<?=$referencia["ca_referencia"]?>" ></td>
        </tr>
        <?
        }
        if( $i==0 ){
        ?>
            <tr>
                <td colspan="7" >
                    <div align="center">No hay registros</div>
                </td>
            </tr>
        <?
        }
        ?>
    </table>
<?
}
?>
    <br />
</div>
</form>