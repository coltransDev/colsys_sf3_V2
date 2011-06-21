<div class="content" align="center">

    <h2>Listado de tickets </h2>
    <h2><?=Utils::fechaMes($fchinicio)?> - <?=Utils::fechaMes($fchfin)?></h2>
    <br />

<table class="tableList alignLeft">
    <tr>
        <th width="300">
           Ticket
        </th>        
        <th width="200">
           Usuario
        </th>
        <th width="200">
           Usuario Evaluado
        </th>
        <th width="50">
           Promedio
        </th>
        <th width="400">
           Observacion
        </th>
    </tr>
<?
$sumValor = 0;
$cantidad = 0;
foreach( $eval as $row ){
    
    /*print_r($e);
    echo "<br />";
    echo "<br />";*/

    ?>
    <tr>
        <td>
            <?=link_to($row["ev_ca_titulo"], "idgsistemas/verEvaluacion?idevaluacion=".$row["ev_ca_idevaluacion"], array("target"=>"_blank"))?>
        </td>
        <td>
            <?=$row["us2_ca_nombre"]?>
        </td>
        <td>
            <?=$row["us_ca_nombre"]?>
        </td>
        <td>
            <div align="right"><?=round($row["ev_promedio"],2)?></div>
        </td>
        <td>
            <?=$row["ev_ca_comentarios"]?>
        </td>
    </tr>
    <?
     $cantidad++;
     $sumValor += $row["ev_promedio"];
}
?>
    <tr class="row0">
            <td colspan="3">
                <b>Totales</b>
            </td>
            <td>
                <div align="right"><b><?=round($sumValor/$cantidad,2)?></b></div>
            </td>
            <td>
                <b>Total encuestas <?=$cantidad?></b>
            </td>
        </tr>
</table>

    Generado <?=Utils::fechaMes(date("Y-m-d H:i:s"))?>

</div>