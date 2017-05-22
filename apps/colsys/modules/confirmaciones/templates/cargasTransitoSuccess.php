<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$datos = $sf_data->getRaw("datos");
?>


<table class="tableList" width="80%">
    <tr>
        <th>Ciudad</th><th>Disposicion de carga</th><th>Referencia</th><th>Hbl</th><th>Cliente</th><th>Deposito</th>
    </tr>
<?
foreach($datos as $d)
{
?>
    <tr>
        <td><?=$d["ca_ciudad"]?></td><td><?=$d["ca_disposicion"]?></td><td><?=$d["ca_referencia"]?></td><td><?=$d["ca_hbls"]?></td><td><?=$d["ca_compania"]?></td><td><?=$d["ca_coddeposito"]?></td>
    </tr>
<?
}
?>
</table>