<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
//print_r( $bodegas );
$bodegas = $sf_data->getRaw("bodegas");
?>

<table id="tb_<?=$inoCliente->getOid()?>" style='display:none' cellspacing="1" width="100%">
    <tr>
        <td width="24%" class="listar"><b>Vendedor:</b><br />
                <?=$inoCliente->getCaLogin()?></td>
        <td width="13%" class="listar"><b>HBL:</b><br />
                <?=$inoCliente->getCaHbls()?></td>
        <td width="26%" class="listar"><b>No.Piezas:</b><br />
                <?=Utils::formatNumber($inoCliente->getCaNumpiezas())?></td>
        <td width="6%" class="listar"><b>Peso en Kilos:</b><br />
                <?=Utils::formatNumber($inoCliente->getCaPeso())?></td>
        <td width="31%" class="listar"><b>Volumen CMB:</b><br />
                <?=Utils::formatNumber($inoCliente->getCaVolumen())?></td>
    </tr>
    <tr>
        <td class="listar"><b>ID Proveedor:</b><br />
                <?=$inoCliente->getCaIdproveedor()?></td>
        <td class="listar" colspan="2"><b>Proveedor:</b><br />
                <?=$inoCliente->getCaProveedor()?></td>
        <td class="listar" colspan="2" valign="top" rowspan="<?=$modo=="otm"?4:2?>" ><b>Correos Electr&oacute;nicos a enviar Confirmaci&oacute;n:</b><br />
                <?
                    $confirmar = $reporte?explode(",", $reporte->getCaConfirmarClie()):array();
                    $emails = explode(",", $cliente->getCaConfirmar());

                    $count = max( count($confirmar)+2, 8 );
                    for ($i= 0; $i< $count; $i++){
                       $chequear = (isset($confirmar[$i]) and in_array($confirmar[$i],$emails) and $confirmar[$i]!="")?"checked='checked'":"";

                    ?>
                <input id="ar_<?=$inoCliente->getOid()?>_<?=$i?>" type='text' name='ar_<?=$inoCliente->getOid()?>_<?=$i?>' value='<?=isset($confirmar[$i])?$confirmar[$i]:""?>' size="35" maxlength="50" />
                <input id="em_<?=$inoCliente->getOid()?>_<?=$i?>" type="checkbox" name='em_<?=$inoCliente->getOid()?>[]' value='<?=$i?>'  <?=$chequear?> />
                <br />
                <?
                    }
                    ?>
        </td>
    </tr>
    <?
            if( $modo=="otm" ){
            ?>
    <tr>
        <td class="listar"><?
            //if( $reporte->getCaIdetapa()!='99999' ){
                $i = 0;
                foreach( $etapas as $etapa ){

                ?>
                    <input name='tipo_<?=$inoCliente->getOid()?>' id='tipo_<?=$inoCliente->getOid()?>' type='radio' value = '<?=$etapa->getCaIdetapa()?>' <?=($i++==0)?'checked="checked"':''?> onclick="mostrar('<?=$inoCliente->getOid()?>');" />
                    <?=Utils::replace($etapa->getCaEtapa())?>
                    <br />
                    <?
                }
            ?>
            <input name='tipo_<?=$inoCliente->getOid()?>'  id='tipo_<?=$inoCliente->getOid()?>' type='radio'  value = '00000' onclick="mostrar('<?=$inoCliente->getOid()?>');" />
            Orden anulado<br />
            <input name='tipo_<?=$inoCliente->getOid()?>'  id='tipo_<?=$inoCliente->getOid()?>' type='radio'  value = '99999' onclick="mostrar('<?=$inoCliente->getOid()?>');" />
            Cierre<br />
        <?
        //}
        ?>
                <input name='tipo_<?=$inoCliente->getOid()?>' id='tipo_<?=$inoCliente->getOid()?>' type='radio' value = '88888' checked="checked" onclick="mostrar('<?=$inoCliente->getOid()?>');" />


            Status						 </td>
        <td class="listar" style='vertical-align:bottom;'><b>Destino OTM:</b><br />
                <?=$inoCliente->getDestinoCont()?$inoCliente->getDestinoCont()->getcaCiudad():""?></td>
        <td class="listar" style='vertical-align:bottom;'>
            <div id="divfchllegada_<?=$inoCliente->getOid()?>"> <b>Fecha llegada:</b><br />

                        <?
                        echo extDatePicker('fchllegada_'.$inoCliente->getOid(), date("Y-m-d"));
                        ?>
            </div>

            <div id="divfchplanilla_<?=$inoCliente->getOid()?>" style="display:none;"> <b>Fecha Planilla:</b><br />

                        <?
                        echo extDatePicker('fchplanilla_'.$inoCliente->getOid(), date("Y-m-d"));
                        ?>
            </div>

              </td>
    </tr>
    <tr>
        <td class="listar" colspan="3" style='vertical-align:bottom;'><div id="divbodega_<?=$inoCliente->getOid()?>"> <b>Bodega:</b><br />
                        <select name='bodega_<?=$inoCliente->getOid()?>'>
                            <?
                            foreach($bodegas as $bodega){
                            ?>
                                    <option value='<?=$bodega->getCaIdbodega()?>'>
                                    <?=substr($bodega->getCaNombre(),0,65)?>
                                    </option>
                                    <?
                            }
                            ?>
                        </select>
            </div>
              </td>
    </tr>
    <?
                }


                if( $modo=="otm" ){
                    $mensaje = "";
                }else{

                    if( isset($coordinadores[$inoCliente->getCaContinuacionDest()]) && $coordinadores[$inoCliente->getCaContinuacionDest()] ){
                        $coord = $coordinadores[$inoCliente->getCaContinuacionDest()];
                    }else{
                        $coord = $coordinadores["COL-0000"];
                    }

                    if( $inoCliente->getCaContinuacion()!='N/A' ){
                        $mensaje = chr(13).chr(13).$textos['mensajeConfOTMCliente'].$coord;
                    }else{
                        $mensaje = "";
                    }

                }

            ?>
    <tr>
        <td class="listar" colspan="3"><b>Ingrese mensaje exclusivo para este cliente:</b><br />
                <div id="divmessage_<?=$inoCliente->getOid()?>"></div>
            <textarea name='mensaje_<?=$inoCliente->getOid()?>' id='mensaje_<?=$inoCliente->getOid()?>' wrap="virtual" rows="5" cols="65"><?=$inoCliente->getCaMensaje().$mensaje?>
    </textarea></td>
    </tr>
    <tr>
        <td class="invertir">Adjunto para Cliente : </td>
        <td class="mostrar" colspan="4"><input type='file' name='attachment_<?=$inoCliente->getOid()?>' size="75" /></td>
    </tr>
</table>