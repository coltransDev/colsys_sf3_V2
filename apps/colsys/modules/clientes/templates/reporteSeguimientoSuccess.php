<?php
// auto-generated by sfPropelCrud
// date: 2008/06/09 10:06:57
error_reporting(0);
?>
<div class="content" align="center">
<? if ($reporte == "Potenciales"){ ?>
<h3>Seguimiento a Clientes Periodo: <?=$inicio?> - <?=$final?></h3>
<?} elseif ($reporte == "Activos"){ ?>
<h3>Comportamiento de Clientes Periodo: <?=$inicio?> - <?=$final?></h3>
<?} ?> 
<br />
<? if ($reporte == "Potenciales"){ ?>
<p>Reporte de <strong>Clientes Potenciales</strong> sobre el cual se se&ntilde;alar&aacute; en color amarillo aquellos clientes entre 5 y 6 meses sin ninguna actividad comercial, y en naranja los que tengan m&aacute;s de 6 meses sin dicha actividad.</p>
<? }elseif ($reporte == "Activos"){ ?>
<p>Reporte de <strong>Clientes Activos</strong> sobre el cual se podr&aacute; visualizar cual ha sido su comportamiento en t&eacute;rminos de n&uacute;meros de negocios en Impo, Expo y Aduana. Dicho comportamiento se tabula por periodos y se califica su tendencia.</p>
<? } ?>
<br />
<table class="tableList" border="1">
<? if ($reporte == "Potenciales"){ ?>
<thead>
<tr>
  <th>Id Cliente</th>
  <th>D&iacute;gito</th>
  <th>Cliente</th>
  <th>Vendedor</th>
  <th>Sucursal</th>
  <th>&Uacute;ltima<br/>Cotizaci&oacute;n</th>
  <th>&Uacute;ltimo<br/>Reporte</th>
  <th>&Uacute;ltimo<br/>Seg.Cotizaci&oacute;n</th>
  <th>&Uacute;ltimo<br/>Seg.Cliente</th>
  <th>Potencial<br/>Coltrans</th>
  <th>Potencial<br/>Colmas</th>
</tr>
</thead>
<tbody>
<?php foreach ($clientesSinSeguimiento as $cliente): ?>
<?
    $fechas = array($cliente["ca_cotizacion_last"], $cliente["ca_reporte_last"], $cliente["ca_seguimiento_last"], $cliente["ca_evento_max"]);
    rsort($fechas);
    if ($fechas[0]<$corte_dos){
        $color = "style='background-color:orange'";
    }elseif ($fechas[0]<$corte_uno){
        $color = "style='background-color:yellow'";
    }else{
        $color = "";
    }
?>
<tr <?=$color?>>
      <td><?php echo $cliente["ca_idalterno"] ?></td>
      <td><?php echo $cliente["ca_digito"] ?></td>
      <td><?php echo $cliente["ca_compania"] ?></td>
      <td><?php echo $cliente["ca_vendedor"] ?></td>
      <td><?php echo $cliente["ca_sucursal"] ?></td>
      <td><?php echo $cliente["ca_cotizacion_last"] ?></td>
      <td><?php echo $cliente["ca_reporte_last"] ?></td>
      <td><?php echo $cliente["ca_seguimiento_last"] ?></td>
      <td><?php echo $cliente["ca_evento_max"] ?></td>
      <td><?php echo $cliente["ca_coltrans_fch"] ?></td>
      <td><?php echo $cliente["ca_colmas_fch"] ?></td>
</tr>
<?php 
      endforeach;

	if( count($clientesSinSeguimiento)==0 ){
?>
    <tr>
	    <td colspan="11"><div align="center">Reporte sin Registros</div></td>
    </tr>

<?
	}
?>

</tbody>
<?} elseif ($reporte == "Activos"){ ?>
<thead>
<tr>
  <th>Sucursal</th>
  <th>Vendedor</th>
  <th>Id Cliente</th>
  <th>D&iacute;gito</th>
  <th>Cliente</th>
  <th><?= $fechas[0]."<br />".$fechas[1] ?></th>
  <th><?= $fechas[2]."<br />".$fechas[3] ?></th>
  <th><?= $fechas[4]."<br />".$fechas[5] ?></th>
  <th>Comportamiento</th>
</tr>
</thead>
<tbody>
<? $resultadosVendedor = array(); ?>
<?php foreach ($clientesActivos as $key_suc => $sucursal): ?>
    <tr><td colspan="9"><?php echo $key_suc ?></td></tr>
    <?php foreach ($sucursal as $key_ven => $vendedor): ?>
    <tr>
        <td>&nbsp;</td>
        <td colspan="8"><?php echo $key_ven ?></td>
    </tr>
        <?php 
            foreach ($vendedor as $key_cal => $calificacion):
                foreach ($calificacion as $key_cli => $cliente):
                    $resultadosVendedor[$key_ven][$key_cal]+= 1;
        ?>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td><?php echo $key_cli ?></td>
            <td><?php echo $cliente["ca_digito"] ?></td>
            <td><?php echo $cliente["ca_compania"] ?></td>
            <td style="text-align: center"><?php echo $cliente["ca_periodo_1"] ?></td>
            <td style="text-align: center"><?php echo $cliente["ca_periodo_2"] ?></td>
            <td style="text-align: center"><?php echo $cliente["ca_periodo_3"] ?></td>
            <td><?php echo $key_cal ?></td>
        </tr>
        <?php 
                endforeach;
            endforeach;
        ?>
    <?php 
        endforeach;
    ?>
<?php 
      endforeach;
?>
      <tr>
        <td colspan="9">
            <table class="tableList" border="1">
            <thead>
                <tr>
                <th>Vendedor</th>
                <th>Comportamiento</th>
                <th># Clientes</th>
                <th>%</th>
            </thead>
            <tbody>
            <?php foreach ($resultadosVendedor as $key_com => $comercial):?>
                <tr>
                    <td colspan="4"><?php echo $key_com ?></td>
                </tr>
                <?php foreach ($comercial as $key_cal => $calificacion):?>
                <tr>
                    <td>&nbsp;</td>
                    <td><?php echo $key_cal ?></td>
                    <td><?php echo $calificacion ?></td>
                    <td style="text-align: right"><?php echo round($calificacion/array_sum($comercial)*100,2) ?> %</td>
                </tr>
            <?php
                endforeach;
            endforeach;
            ?>
            </tbody>
            <?
            ?>
        </td>
    </tr>

<?
      
	if( count($clientesActivos)==0 ){
?>
    <tr>
	    <td colspan="9"><div align="center">Reporte sin Registros</div></td>
    </tr>

<?
	}
?>

</tbody>
<?} ?>
</table>

</div>