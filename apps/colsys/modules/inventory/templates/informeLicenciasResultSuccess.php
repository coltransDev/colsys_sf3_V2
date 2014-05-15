<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>
<div class="content">
    <h2>Informe Listados de licencias <?=$sucursal?"Sucursal ".$sucursal->getCaNombre():""?><br /> </h2>
    <br />
    
    <h2>Licencias OEM Sistema operativo </h2>
    
    
    <table class="tableList alignLeft" width="400px" >
        <tr>
            <th width="70%">
                Software
            </th>
            <th width="30%">
                Cantidad
            </th>
        </tr>
        <?
        $total = 0;
        foreach( $soOEM as $s ){
            $total+=$s["a_q"];
            
            $url = "inventory/informeListadoActivosResult?so=".str_replace(".","_",$s["a_ca_so"]);
            if( $idsucursal ){
                $url .= "&idsucursal=".$idsucursal;
            }
        ?>
        <tr>
            <td>
                <?=$s["a_ca_so"]?>
            </td>
            <td>
                <?=link_to($s["a_q"], $url, array("target"=>"_blank"))?>
            </td>
        </tr>
        <?
        }
        ?>
        <tr class="row0">
            <td>
                Total
            </td>
            <td>
                <?=$total?>
            </td>
        </tr>
    </table>
    
    <br />
    
    <h2>Licencias OEM Office</h2>
    <table class="tableList alignLeft" width="400px" >
        <tr>
            <th width="70%">
                Software
            </th>
            <th width="30%">
                Cantidad
            </th>
        </tr>
        <?
        $total = 0;
        foreach( $ofOEM as $s ){
            $total+=$s["a_q"];
            $url = "inventory/informeListadoActivosResult?office=".str_replace(".","_",$s["a_ca_office"]);
            if( $idsucursal ){
                $url .= "&idsucursal=".$idsucursal;
            }
        ?>
        <tr>
            <td>
                <?=$s["a_ca_office"]?>
            </td>
            <td>
                <?=link_to($s["a_q"], $url, array("target"=>"_blank"))?>
            </td>
        </tr>
        <?
        }
        ?>
        <tr class="row0">
            <td >
                Total
            </td>
            <td>
                <?=$total?>
            </td>
        </tr>
    </table>
    
    <br />
    <h2>Licencias Compradas</h2>
    <table class="tableList alignLeft" width="400px" >
        <tr>
            <th width="70%">
                Software
            </th>
            <th width="15%">
                Cantidad
            </th>
            
            <?
            /*if( $idsucursal ){
            ?>
            <th width="15%">
                Asignadas Nivel Nacional
            </th>
            <?
            }*/
            ?>
            
            <th width="15%">
                Asignadas
            </th>
            <?if( !$idsucursal ){?>
            <th width="15%">
                Sin asignar
            </th>
            <?}?>
        </tr>
        <?
        $total = 0;
        $totalAs = 0;
        $totalGlob = 0;
        
        $lastCat = null;
        
        $lastLic = null;
        $countLic = 0;
        $totalLic = 0;
        $totalLicAsig = 0;
        
        //echo "<pre>";print_r($software);echo "</pre>";
        
        $cant=array();
        $id="";
        foreach( $software as $s ){
            $ids[$s["a_ca_modelo"]][] = $s["as_ca_idequipo"];
            if($s["a_ca_idactivo"]!=$id)             
                $cant[$s["a_ca_modelo"]]+= $s["a_q"];
                $totalIds[$s["a_ca_modelo"]][] = $s["a_ca_idactivo"];
            $id = $s["a_ca_idactivo"];
            
            if(!$s["as_ca_idequipo"]){
                $idsSinAsignar[$s["a_ca_modelo"]][]=$s["a_ca_idactivo"];
                $cantIdSA[$s["a_ca_modelo"]]+=$s["a_q"]; 
            }
        }
        
        foreach( $software as $s ){            
            if( $lastLic!=$s["a_ca_modelo"] ){
                if( $lastLic ){
                ?>
                <tr>
                    <td>
                        <b><?=$lastLic?></b>
                    </td>
                    <td>
                        <?
                        $url3 = "inventory/informeListadoActivosResult?param=Software&idactivo=".Utils::serializeArray($totalIds[$lastLic]);
                        echo link_to($cant[$lastLic], $url3, array("target"=>"_blank"));
                        ?>
                    </td>
                    <?
                    /*if( $idsucursal ){
                    ?>
                    <td>
                        <?=$totalGlobLic?>
                    </td>
                    <?
                    }*/
                    ?>
                    <td>
                        <?
                        $url1 = "inventory/informeListadoActivosResult?idactivo=".Utils::serializeArray($ids[$lastLic]);
                        $a = $totalLicAsig<=$totalLic?$totalLicAsig:"<span class='rojo'>".$totalLicAsig."</span>";                
                        echo link_to($a, $url1, array("target"=>"_blank"));
                        ?>
                    </td>
                    <?if( !$idsucursal ){?>
                    <td><?
                        if(count($cantIdSA[$lastLic])>0){
                            $url2 = "inventory/informeListadoActivosResult?param=Software&idactivo=".Utils::serializeArray($idsSinAsignar[$lastLic]);
                            echo link_to($cantIdSA[$lastLic], $url2, array("target"=>"_blank"));
                        }
                        ?>
                    </td>
                    <?}?>
                </tr>
                <? 
                }
                $countLic = 0;
                $totalLic = 0;
                $totalLicAsig = 0;
                $totalGlobLic = 0;
                $lastLic=$s["a_ca_modelo"];
            }
            
            
            $total+=$s["a_q"];
            $totalAs+=$s["as_assigned"];
            $totalGlob+=$s["a_q2"];
            /*if( $lastCat!= $s["c_ca_name"]){
                $lastCat = $s["c_ca_name"];
                ?>
                <tr class="row0">
                    <td colspan="4">
                        <b> <?=$lastCat?></b>
                    </td>                    
                </tr>
                <?
            }*/
            
            $url = "inventory/informeListadoActivosResult?idasignacion=".$s["a_ca_idactivo"];
            
            
            
            
            
            $countLic++;
            $totalLic+=$s["a_q"];
            $totalGlobLic+=$s["a_q2"];
            $totalLicAsig+=$s["as_assigned"];
            
        ?>
        <!--<tr>
            <td>
                <?=$s["a_ca_modelo"]?>
            </td>
            <td>
                <?=$s["a_q"]?>                
            </td>
            <?
            if( $idsucursal ){
            ?>
            <td>                
                <?                
                $a = $s["a_q2"]<=$s["a_q"]?$s["a_q2"]:"<span class='rojo'>".$s["a_q2"]."</span>";                
                echo link_to($a, $url, array("target"=>"_blank"));
                ?>
            </td>
            <?
            }
            
            if( $idsucursal ){
                $url .= "&idsucursal=".$idsucursal;
            }
            ?>
            <td>
                <?                
                $a = $s["as_assigned"]<=$s["a_q"]?$s["as_assigned"]:"<span class='rojo'>".$s["as_assigned"]."</span>";                
                echo link_to($a, $url, array("target"=>"_blank"));
                ?>
            </td>
        </tr>-->
        <?
        }
        /*
        if( $countLic>1 ){
        ?>
        <tr class="row0">
            <td>
                Subtotal <b><?=$lastLic?></b>
            </td>
            <?
            /*if( $idsucursal ){
            ?>
            <td>
                <?=$totalLic?>
            </td>
            <?
            }
            ?>
            <td>
                <?=$totalGlobLic?>
            </td>            
            <td>
                <?                
                $a = $totalLicAsig<=$totalLic?$totalLicAsig:"<span class='rojo'>".$totalLicAsig."</span>";                
                echo $a;
                ?>
            </td>
        </tr>
        <? 
        }*/
        
        ?>
        <!--<tr class="row0">
            <td>
                Gran Total
            </td>
            <td>
                <?=$total?>
            </td>
            <?
            /*if( $idsucursal ){
            ?>
            <td>
                <?=$totalGlob?>
            </td>
            <?
            }*/
            ?>
            <td>
                <?=$totalAs<=$total?$totalAs:"<span class='rojo'>".$totalAs."</span>"?>
            </td>
        </tr>-->
    </table>
</div>