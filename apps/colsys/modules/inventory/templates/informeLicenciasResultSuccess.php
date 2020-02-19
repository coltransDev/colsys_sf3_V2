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
        
        $lastCat = null;        
        $lastLic = null;                        
        
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
        
        $totalLicAsig = array();
        foreach( $software as $s ){
            $totalLicAsig[$s["a_ca_modelo"]]+=$s["as_assigned"];            
        }

        foreach( $software as $s ){
            if( $lastLic!=$s["a_ca_modelo"] ){                
                ?>
                <tr>
                    <td>
                        <b><?=$s["a_ca_modelo"]?></b>
                    </td>
                    <td>
                        <?
                        $url3 = "inventory/informeListadoActivosResult?param=Software&idactivo=".json_encode($totalIds[$s["a_ca_modelo"]]);
                        echo link_to($cant[$s["a_ca_modelo"]], $url3, array("target"=>"_blank"));
                        ?>
                    </td>                    
                    <td>
                        <?
                        $url1 = "inventory/informeListadoActivosResult?idactivo=".json_encode($ids[$s["a_ca_modelo"]]);
                        $a = $totalLicAsig[$s["a_ca_modelo"]]<=$cant[$s["a_ca_modelo"]]?$totalLicAsig[$s["a_ca_modelo"]]:"<span class='rojo'>".$totalLicAsig[$s["a_ca_modelo"]]."</span>";                
                        echo link_to($a, $url1, array("target"=>"_blank"));
                        ?>
                    </td>
                    <?if( !$idsucursal ){
                        ?>
                        <td><?
                            if(count($cantIdSA[$s["a_ca_modelo"]])>0){
                                $url2 = "inventory/informeListadoActivosResult?param=Software&idactivo=".json_encode($idsSinAsignar[$s["a_ca_modelo"]]);
                                echo link_to($cantIdSA[$s["a_ca_modelo"]], $url2, array("target"=>"_blank"));
                            }
                            ?>
                        </td>
                        <?
                    }
                    ?>
                </tr>
                <?              
                $lastLic=$s["a_ca_modelo"];
            }
            $url = "inventory/informeListadoActivosResult?idasignacion=".$s["a_ca_idactivo"];        
        }
        ?>        
    </table>
</div>