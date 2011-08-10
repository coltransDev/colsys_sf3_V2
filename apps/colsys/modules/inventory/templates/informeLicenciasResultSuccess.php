<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>
<div class="content">
    <h2>Licencias OEM Sistema operativo</h2>
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
        ?>
        <tr>
            <td>
                <?=$s["a_ca_so"]?>
            </td>
            <td>
                <?=link_to($s["a_q"], "inventory/informeListadoActivosResult?so=".$s["a_ca_so"], array("target"=>"_blank"))?>
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
        ?>
        <tr>
            <td>
                <?=$s["a_ca_office"]?>
            </td>
            <td>
                <?=link_to($s["a_q"], "inventory/informeListadoActivosResult?office=".$s["a_ca_office"], array("target"=>"_blank"))?>
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
        </tr>
        <?
        $total = 0;
        $totalAs = 0;
        $lastCat = null;
        
        foreach( $software as $s ){
            $total+=$s["a_q"];
            $totalAs+=$s["as_assigned"];
            if( $lastCat!= $s["c_ca_name"]){
                $lastCat = $s["c_ca_name"];
                ?>
                <tr class="row0">
                    <td colspan="3">
                        <?=$lastCat?>
                    </td>                    
                </tr>
                <?
            }
            
        ?>
        <tr>
            <td>
                <?=$s["a_ca_modelo"]?>
            </td>
            <td>
                <?=$s["a_q"]?>                
            </td>
            <td>
                <?                
                $a = $s["as_assigned"]<=$s["a_q"]?$s["as_assigned"]:"<span class='rojo'>".$s["as_assigned"]."</span>";                
                echo link_to($a, "inventory/informeListadoActivosResult?idasignacion=".$s["a_ca_idactivo"], array("target"=>"_blank"));
                ?>
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
            <td>
                <?=$totalAs<=$total?$totalAs:"<span class='rojo'>".$totalAs."</span>"?>                
            </td>
        </tr>
    </table>

</div>



