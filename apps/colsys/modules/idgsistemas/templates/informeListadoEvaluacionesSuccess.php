<div class="content" align="center">

    <h2>Listado de tickets </h2>
    <h2><?=Utils::fechaMes($fchinicio)?> - <?=Utils::fechaMes($fchfin)?></h2>
    <br />

<table class="tableList alignLeft">
    <tr>
        <th>
           Ticket
        </th>        
        <th>
           Usuario
        </th>
        <th>
           Promedio
        </th>
        <th>
           Observacion
        </th>
    </tr>
<?
foreach( $eval as $e ){
    
    /*print_r($e);
    echo "<br />";
    echo "<br />";*/

    ?>
    <tr>
        <td>
            <?=link_to($e["ev_ca_titulo"], "idgsistemas/verEvaluacion?idevaluacion=".$e["ev_ca_idevaluacion"], array("target"=>"_blank"))?>
        </td>
        <td>
            <?=$e["us_ca_nombre"]?>
        </td>
        <td>
            <?=round($e["ev_promedio"],2)?>
        </td>
        <td>
            <?=$e["ev_ca_comentarios"]?>
        </td>
    </tr>

    <?
}
?>
</table>

    Generado <?=Utils::fechaMes(date("Y-m-d H:i:s"))?>

</div>