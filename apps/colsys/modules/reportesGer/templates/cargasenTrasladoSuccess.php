<?

$resul = $sf_data->getRaw("resul");

?>

<table class="tableList"  border="1" id="mainTable">
    <tr>
        <th>Referencia</th>
        <th>Cliente</th>
        <th>Doc Transporte</th>
        <th>Origen</th>
        <th>Destino</th>
        <th>Llegada</th>
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
        <td><?=$r["ca_fchllegada"]?></td>
        <td><?=$r["ca_usucreado"]?></td>
        <td><?=$r["ca_fchactualizado"]?></td>        
    </tr>
<?
}
?>

</table>