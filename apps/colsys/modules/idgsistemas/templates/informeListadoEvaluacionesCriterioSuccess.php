<div class="content" align="center">

    <h2>Datos de Criterio </h2>
    <h2><?=Utils::fechaMes($fchinicio)?> - <?=Utils::fechaMes($fchfin)?></h2>
    <br />

    <table class="tableList alignLeft" border="1">
    <tr>
        <th>
           Evaluaci&oacute;n
        </th>
        <th>
           Criterio
        </th>
        <th>
           Usuario
        </th>
        <th>
           Usuario Eval.
        </th>
        <th>
           Ponderaci&oacute;n
        </th>
        <th>
           Promedio
        </th>
        <th>
           Observaciones
        </th>
    </tr>
    <?
        

        $sumPonderacion = 0;
        $sumValor = 0;
        $cantidad = 0;
        foreach( $eval as $row ){
            
        ?>
        <tr>
            <td width="300">                
                <?=link_to($row["ev_ca_titulo"], "idgsistemas/verEvaluacion?idevaluacion=".$row["ev_ca_idevaluacion"], array("target"=>"_blank"))?>
            </td>
            <td width="300">
                <?=$row["cr_ca_criterio"]?>
            </td>
            <td width="100">
                <?=$row["us2_ca_nombre"]?>
            </td>
            <td width="100">
                <?=$row["us_ca_nombre"]?>
            </td>
            <td width="50">
                <?=$row["exc_ca_ponderacion"]?> %
            </td>
            <td width="50">
                <div align="right"><?=$row["exc_ca_valor"]?></div>
            </td>
            <td width="300">
                <?=$row["exc_ca_observaciones"]?>
            </td>
        </tr>


        <?
            $sumPonderacion += $row["exc_ca_ponderacion"];
            $sumValor += ($row["exc_ca_valor"]*$row["exc_ca_ponderacion"]);
            $cantidad++;
        }
        ?>
        <tr class="row0">
            <td colspan="5">
                <b>Totales</b>
            </td>            
            <td>
                <div align="right"><b><?=round($sumValor/$sumPonderacion,2)?></b></div>
            </td>
            <td>
                <b>Total encuentas <?=$cantidad?></b>
            </td>
        </tr>

       
</table>

    Generado <?=Utils::fechaMes(date("Y-m-d H:i:s"))?>

</div>