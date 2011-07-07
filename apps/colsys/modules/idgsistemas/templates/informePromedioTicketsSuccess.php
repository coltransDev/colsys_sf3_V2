<div class="content" align="center">

    <h2> IDG Satisfacción del Usuario - Informe promedio tickets por usuario</h2>    
    <h2><?=Utils::fechaMes($fchinicio)?> - <?=Utils::fechaMes($fchfin)?></h2>
    <br />


<table class="tableList alignLeft">
    <tr>
        <th>
           Usuario
        </th>
        <th>
           Criterio
        </th>
        <th>
           Valor
        </th>
        <th>
           # Evaluaciones
        </th>
    </tr>
<?
$lastUser = null;
$sumPromedioTotal = 0;
$countPromedioTotal = 0;
$numEvalTotal = 0;

foreach( $eval as $e ){

    /*print_r($e);
    echo "<br />";
    echo "<br />";*/

    if( $lastUser && $lastUser!=$e["us_ca_nombre"] ){
    ?>
    <tr class="row0">
        <td colspan="2">
            <b>Total</b>
        </td>
        <td>
            <b><?=round($sumPromedio/$countPromedio,2)?></b>
        </td>
        <td>
            <b><?=round($numEval,2)?></b>
        </td>
        
    </tr>
    <?
        $sumPromedioTotal += round($sumPromedio/$countPromedio,2);
        $countPromedioTotal++;
        $numEvalTotal += $numEval;
    }
    
    if( !$lastUser || $lastUser!=$e["us_ca_nombre"] ){
    ?>
    <tr class="row0">
        <td colspan="4">
            <?=$e["us_ca_nombre"]?>
        </td>
        
    </tr>
    <?
        
        $sumPromedio = 0;
        $countPromedio = 0;
    }


    $lastUser=$e["us_ca_nombre"];
    $numEval = $e["c_numeval"];

    $url = "idgsistemas/informeListadoEvaluacionesCriterio?login=".$e["us_ca_login"]."&idcriterio=".$e["c_ca_idcriterio"];
    if( $fchinicio ){
        $url.="&fchinicio=".$fchinicio;
    }
    if( $fchfin ){
        $url.="&fchfin=".$fchfin;
    }
    if( $idgroup ){
        $url.="&idgroup=".$idgroup;
    }
    ?>
    <tr>
        <td>
            &nbsp;
        </td>
        <td>
            <?=link_to($e["c_ca_criterio"], $url, array("target"=>"_blank"))?>            
        </td>
        <td>
            <?=round($e["c_promedio"],2)?>
        </td>
        <td>
            &nbsp;
        </td>
    </tr>
    <?
    $sumPromedio+=round($e["c_promedio"],2);
    $countPromedio++;

    
    ?>

    <?
}
?>
    <tr class="row0">
        <td colspan="2">
            <b>Total</b>
        </td>
        <td>
            <b><?=round($sumPromedio/$countPromedio,2)?></b>
        </td>
        <td>
            <b><?=round($numEval,2)?></b>
        </td>
    </tr>
    <?
    $sumPromedioTotal += round($sumPromedio/$countPromedio,2);
    $countPromedioTotal++;
    $numEvalTotal += $numEval;
    ?>
    
    <tr class="row0">
        <td colspan="2">
            <b>Gran Total</b>
        </td>
        <td>
            <b><?=round($sumPromedioTotal/$countPromedioTotal,2)?></b>
        </td>
        <td>
            <b><?=round($numEvalTotal,2)?></b>
        </td>
    </tr>
</table>
    Generado <?=Utils::fechaMes(date("Y-m-d H:i:s"))?>

</div>