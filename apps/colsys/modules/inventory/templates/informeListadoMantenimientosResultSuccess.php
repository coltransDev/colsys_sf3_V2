<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$cols = 12;

?>
<div class="content" align="center">
    <h2>INFORME DE MANTENIMIENTO<br /><?=$sucursal?"SUCURSAL: ".$sucursal->getCaNombre():""?><br /><?=strtoupper(Utils::mesLargo($mes))?> </h2>
    <br />
    <table width="80%" border="1" class="tableList" align="center">
        <tr>
            <th scope="col" style=" text-align: center"><b>
                Id
            </b></th>
            <th scope="col" style=" text-align: center"><b>
                Fecha de Compra
            </b></th>
            <th scope="col" style=" text-align: center"><b>
                Marca
            </b></th>
            <th scope="col" style=" text-align: center"><b>
                Modelo
            </b></th>            
            <th scope="col" style=" text-align: center"><b>
                Asignado a
            </b></th>
            <th scope="col" style=" text-align: center"><b>
                Ubicación
            </b></th>
            <th scope="col" style=" text-align: center"><b>
                Fecha Prog. Mantenimiento
            </b></th>
            <th scope="col" style=" text-align: center"><b>
                Fecha Mantenimiento
            </b></th>
        </tr>
        <?
        
        $contador_cat = 0;
        $contador_mes = 0;
        $lastCat = null;
        $lastMes = null;
        
        foreach( $activos as $activo ){
            
            $timestamp = strtotime($activo->getCaPrgmantenimiento());
            $mes_prg = ($timestamp)?(int)(date( "m" , $timestamp )):-1;
            
            if($criterio=="mes"){
            //Totaliza la lista por mes
                if($lastMes!=$mes_prg){
                    //Antes de cambiar el mes se pintan las categorías pendientes
                    if($contador_cat>0){
                       ?>
                        <tr class="row_blue">
                            <td colspan="<?=$cols?>"><b>Subtotal =<?=$contador_cat?> </b></td>
                        </tr>
                      <?
                    }
                    //Pinta los Totales del Mes
                    if($lastMes){
                      ?>
                        <tr class="row_green">
                            <td colspan="<?=$cols?>"><b>Total <?=Utils::mesLargo($lastMes)?> = <?=$contador_mes?> </b></td>
                        </tr>
                      <?
                      $contador_mes = 0;
                      $contador_cat= 0;
                      $lastCat = null;

                    }

                }
            }
            //Subtotaliza la consulta por Categoría
            if($lastCat!=$activo->getCaIdcategory()){
                
                if($lastCat){
                   ?>
                    <tr class="row_blue">
                        <td colspan="<?=$cols?>" style="text-align: left"><b>Subtotal =<?=$contador_cat?> </b></td>
                    </tr>
                  <?
                  $contador_cat = 0;
                  
                }
                $cat = $activo->getInvCategory();
                $parent = $cat->getParent();
                ?>
                    <tr class="row0">
                        <td colspan="<?=$cols?>" style="text-align: left"><b> <?=($parent?$parent->getCaName()." - ":"").$cat->getCaName()?></b></td>
                    </tr>
                <?
                
            }
            
            $contador_cat++;
            $contador_mes++;
            $lastCat=$activo->getCaIdcategory();
            $lastMes = ($mes_prg)?$mes_prg:-1;
        ?>
        <tr>
            <td style="text-align: left">
                <?=link_to($activo->getCaIdentificador(), "inventory/detalleActivo?idactivo=".$activo->getCaIdactivo(), array("target"=>"_blank"))?>
            </td>
            <td style="text-align: left">
                <?=$activo->getCaFchcompra()?>
            </td>
            <td style="text-align: left; width: 70px ">
                <?=$activo->getCaMarca()?>
            </td>
            <td style="text-align: left">
                <?=$activo->getCaModelo().($activo->getCaVersion()?" ".$activo->getCaVersion():"")?>
            </td>
            <td style="text-align: left">
                <?=$activo->getUsuario()?$activo->getUsuario()->getCaNombre():"&nbsp;"?>
            </td>
            <td style="text-align: left; width: 130px">
                <?=$activo->getUsuario()?$activo->getUsuario()->getCaDepartamento():"&nbsp;"?>
            </td>
            <td style="text-align: right; width: 70px">
                <?=$activo->getCaPrgmantenimiento()?>
            </td>
            <td style="text-align: right; width: 70px">
                <?=$activo->getCaFchmantenimiento()?>
            </td>
        </tr>
        <?
        }
        if($contador_cat>0){
            ?>
                <tr class="row_blue">
                    <td colspan="<?=$cols?>"><b>Subtotal =<?=$contador_cat?> </b></td>
                </tr>
            <?
        }
        if($criterio=="mes"){
            if($contador_mes>0){
                ?>
                    <tr class="row_green">
                        <td colspan="<?=$cols?>"><b>Subtotal =<?=$contador_mes?> </b></td>
                    </tr>
                <?
            }   
        }
        ?>
    </table>
    <br />
    <br />
    <b>LISTADO RESUMEN MANTENIMIENTOS </b><br /><br /> 
    <table class="tableList" align="center" width="30%">
        <th> <th scope="col" style=" text-align: center"><b>Dispositivo</b></th>
        <th> <th scope="col" style=" text-align: center"><b>Cantidad</b></th>

    <?
        
        $lastCatr = null;
    $cant = 0;
    $total = 0;
    $granTotal = 0;
    foreach( $resumenes as $resumen ){
        if( $lastCatr!=$resumen->getcaIdcategory() ){
            
            if( $lastCatr!==null ){
            ?>            
            <tr class="row0">
                <td colspan="<?=$cols?>"><div align="right"><b>Total: <?=$cant?></b></div></td>
            </tr>
            <?   
            $total=$cant+$total;
            }
            $lastCatr=$resumen->getcaIdcategory();
            $catr = $resumen->getInvCategory();
            $parentr = $catr->getParent();
            
            $cant = 0;
            ?>            
            <tr class="row0">
                <td colspan="<?=$cols?>"><b><?=($parentr?$parentr->getCaName()." - ":"").$catr->getCaName()?></b></td>
            </tr>
            <?
        }
        $cant++;
    }
        $granTotal+=$cant+$total;
    ?>
        <tr class="row0">
            <td colspan="<?=$cols?>"><div align="right"><b>Total: <?=$cant?></b></div></td>
        </tr>
        <tr class="row0">
            <td colspan="<?=$cols?>"><div align="right"><b>Gran Total: <?=$granTotal?></b></div></td>
        </tr>
    </table>
</div>