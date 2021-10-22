<?

$resul = $sf_data->getRaw("resul");

?>

<table class="tableList"  border="1" id="mainTable">
     [ca_referencia] => 400.05.10.0011.19
            [ca_doctransporte] => LEXBRE190908150544
            [ca_iddestino] => 
            [ca_dispocarga] => 11
            [ano] => 19
            [ca_coddeposito] => 2006
            [ca_idmuelle] => 2261
            [ca_disposicion] => Ingreso Zona Franca
            [ca_compania] => SEATECH INTERNATIONAL INC
            [ca_origen] => HAM-0040
            [ca_destino] => CTG-0005
            [ca_ciudad] => Cartagena
    <tr>
        <th>Referencia</th>
        <th>Cliente</th>
        <th>Doc Transporte</th>
        <th>Origen</th>
        <th>Destino</th>
        <th>Creacion</th>
        <th>Actualizacion</th>
    </tr>
<?
foreach($resul as $r)
{
?>
    <tr>
        <td><?=$r["ca_referencia"]?></td>
        <td><?=$r["ca_compania"]?></td>
        <td><?=$r["ca_doctransporte"]?></td>
        <td><?=$r["ciuorigen"]?></td>
        <td><?=$r["ciudestino"]?></td>
        <td><?=$r["ca_usucreado"]?></td>
        <td><?=$r["ca_fchactualizado"]?></td>        
    </tr>
<?
}
?>

</table>