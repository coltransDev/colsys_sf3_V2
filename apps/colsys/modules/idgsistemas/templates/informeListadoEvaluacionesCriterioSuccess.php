<div class="content" align="center">

    <h2>Datos de Criterio </h2>
    <h2><?=Utils::fechaMes($fchinicio)?> - <?=Utils::fechaMes($fchfin)?></h2>
    <br />

<table class="tableList alignLeft">
    <tr>
        <th>
           Evaluaci&oacute;n
        </th>
        <th>
           Criterio
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

        foreach( $eval as $row ){
            
        ?>
        <tr>
            <td>
                <?=$row["ev_ca_titulo"]?>
            </td>
            <td>
                <?=$row["cr_ca_criterio"]?>
            </td>
            <td>
                <?=$row["exc_ca_ponderacion"]?> %
            </td>
            <td>
                <?=$row["exc_ca_valor"]?>
            </td>
            <td>
                <?=$row["exc_ca_observaciones"]?>
            </td>
        </tr>


        <?
            $sumPonderacion += $row["exc_ca_ponderacion"];
            $sumValor += ($row["exc_ca_valor"]*$row["exc_ca_ponderacion"]);
        }
        ?>
        <tr class="row0">
            <td colspan="3">
                Totales
            </td>            
            <td>
                <?=$sumValor/$sumPonderacion?>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>

       
</table>

    Generado <?=Utils::fechaMes(date("Y-m-d H:i:s"))?>

</div>