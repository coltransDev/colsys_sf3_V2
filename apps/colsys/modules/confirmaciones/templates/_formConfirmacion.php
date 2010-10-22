<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
//print_r( $bodegas );
if( $modo=="otm" ){
    $bodegas = $sf_data->getRaw("bodegas");
}
?>
<a name="oid_<?=$inoCliente->getOid()?>" >&nbsp;</a>
<table id="tb_<?=$inoCliente->getOid()?>" style='display:none' cellspacing="1" width="100%">
    <tr>
        <td width="18%" class="listar"><b>Vendedor:</b><br />
                <?=$inoCliente->getCaLogin()?></td>
        <td width="8%" class="listar"><b>HBL:</b><br />
                <?=$inoCliente->getCaHbls()?></td>
        <td width="8%" class="listar"><b>No.Piezas:</b><br />
                <?=Utils::formatNumber($inoCliente->getCaNumpiezas())?></td>
        <td width="8%" class="listar"><b>Peso en Kilos:</b><br />
                <?=Utils::formatNumber($inoCliente->getCaPeso())?></td>
        <td width="8%" class="listar"><b>Volumen CMB:</b><br />
                <?=Utils::formatNumber($inoCliente->getCaVolumen())?></td>

        <td width="50%" class="listar" colspan="2" valign="top" rowspan="<?=$modo=="otm"?6:4?>" ><b>Correos Electr&oacute;nicos a enviar Confirmaci&oacute;n:</b><br />
            <?
            $i=0;
            if( count($fijos)>0 ){
            ?>
            <div class="box1 qtip" id="divfijos_<?=$inoCliente->getOid()?>" title="Debe seleccionar al menos un contacto fijo">
               &nbsp;
                <b>Contactos fijos</b><br />

                <table>

                <?
                //Contactos fijos
               
                foreach( $fijos as $fijo ){
                    $email = $fijo->getCaEmail();
                    if( $email ){
                        $i++;
                        ?>
                        
                        <tr>
                            <td>
                                <?
                                echo "".$fijo->getCaEmail()."".($fijo->getCaCargo()?" [".$fijo->getCaCargo()."]":"");
                                ?>
                                <input id="ar_<?=$inoCliente->getOid()?>_<?=$i?>" type='hidden' name='ar_<?=$inoCliente->getOid()?>_<?=$i?>' value='<?=isset($email)?$email:""?>' size="35" maxlength="50" readonly="true" />                                
                                
                            </td>
                            <td>
                                <input id="em_<?=$inoCliente->getOid()?>_<?=$i?>" type="checkbox" name='em_<?=$inoCliente->getOid()?>[]' value='<?=$i?>'  checked='checked' />
                            </td>
                        </tr>
                        <?
                    }else{
                        
                        ?>
                        <tr>
                            <td colspan="2">
                                <?=$fijo->getCaNombres();?>
                                <span class="rojo">Contacto fijo sin e-mail</span>

                            </td>
                        </tr>
                        <?
                    }
                }
                ?>
                </table>
            </div>
            <?
            }
            ?>
            <br />
            <div class="box1 qtip" title="Seleccione un contacto">
                <b>Otros contactos</b><br />
                <?
                //Contactos reporte y maestra cliente
                $emailsReporte = $reporte?explode(",", $reporte->getCaConfirmarClie()):array();
                $emailsCliente =explode(",", $cliente->getCaConfirmar());


                $emails = array_unique(array_merge($emailsReporte, $emailsCliente));
                $count = max( count($emails)+2, 8 );

                foreach( $emails as $email ){
                    if( $email ){
                        $chequear = (isset($email) and in_array($email,$emailsReporte) and $email!="")?"checked='checked'":"";
                        $i++;
                        ?>
                        <input id="ar_<?=$inoCliente->getOid()?>_<?=$i?>" type='text' name='ar_<?=$inoCliente->getOid()?>_<?=$i?>' value='<?=isset($email)?$email:""?>' size="35" maxlength="50" />
                        <input id="em_<?=$inoCliente->getOid()?>_<?=$i?>" type="checkbox" name='em_<?=$inoCliente->getOid()?>[]' value='<?=$i?>'  <?=$chequear?> />
                        <br />
                        <?
                    }
                }

                $i++;
                for($j=$i; $j<$i+3; $j++){
                ?>
                    <input id="ar_<?=$inoCliente->getOid()?>_<?=$j?>" type='text' name='ar_<?=$inoCliente->getOid()?>_<?=$j?>' value='' size="35" maxlength="50" />
                    <input id="em_<?=$inoCliente->getOid()?>_<?=$j?>" type="checkbox" name='em_<?=$inoCliente->getOid()?>[]' value='<?=$j?>'  />
                    <br />
                <?
                }
                ?>
            </div>
        </td>

    </tr>
    <tr>
        <td class="listar"><b>ID Proveedor:</b><br />
                <?=$inoCliente->getCaIdproveedor()?></td>
        <td class="listar" colspan="4"><b>Proveedor:</b><br />
                <?=$inoCliente->getCaProveedor()?></td>
        
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
        <td class="listar" style='vertical-align:bottom;' colspan="3">
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
        <td class="listar" colspan="5" style='vertical-align:bottom;'><div id="divbodega_<?=$inoCliente->getOid()?>"> <b>Bodega:</b><br />
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
        <td class="listar" colspan="5"><b>Ingrese mensaje exclusivo para este cliente:</b><br />
                <div id="divmessage_<?=$inoCliente->getOid()?>"></div>
            <textarea name='mensaje_<?=$inoCliente->getOid()?>' id='mensaje_<?=$inoCliente->getOid()?>' wrap="virtual" rows="5" cols="65"></textarea>
            <input type="hidden" id='mensajeOTM_<?=$inoCliente->getOid()?>' value="<?=$inoCliente->getCaMensaje().$mensaje?>" />
    </td>
    </tr>
    <tr>
        <td class="mostrar">Adjunto para Cliente : </td>
        <td class="mostrar" colspan="4"><input type='file' name='attachment_<?=$inoCliente->getOid()?>' size="75" /></td>
    </tr>
</table>