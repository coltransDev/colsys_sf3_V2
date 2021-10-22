<?
$riesgos = $sf_data->getRaw("riesgos");
?>

<div>
    Favor tomar en cuenta que el siguiente factor fue eliminado: <b><?=$factor->getCaCargoiso()?></b><br/>
    Realizado por: <b><?=$user->getNombre()?></b><br/>
    Fecha: <b><?=date("Y-m-d h:i:s")?></b><br/><br/><br/>
    <table>
        <tr><th colspan="5">Resumen de Cambios</th></tr>
        <tr><th>#</th><th>Proceso</th><th>Codigo</th><th>Riesgo</th><th>Acción</th></tr>
        <?
        if($riesgos){
            $i=1;
            foreach($riesgos as $key => $riesgo){                
                echo '<tr><td>'.$i.'</td>';
                echo '<td>'.utf8_decode($riesgo["ca_proceso"]).'</td>';
                echo '<td>'.$riesgo["ca_codigo"].'</td>';
                echo '<td>'.utf8_decode($riesgo["ca_riesgo"]).'</td>';
                echo '<td style="background-color:red;">Eliminado</td>';
                echo '</tr>';                
                $i++;
            }
        }
        ?>
    </table>                                                
</div>