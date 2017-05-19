<?php
/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
$sucursales = $sf_data->getRaw("sucursales");
$destinos = $sf_data->getRaw("destinos");
$tipo = $sf_data->getRaw("tipo");
use_helper("ExtCalendar");
?>
<div class="content" align="center">
    <h2>Informe de Facturación Proveedores </h2>
    <br />
    <form action="<?=url_for("reportesGer/listadoFacturas")?>" method="post" >
        <input type="hidden" name="tipo" id="tipo" value="<?=$tipo?>">
        <table class="tableList"  width="600px"  >
            <tr>
                <th colspan="7"> 
                    Ingrese los par&aacute;metros para el Reporte
                </th>
            </tr>
            <tr>
                <?
                if($tipo!="expo" && $tipo!="aereo")
                {
                ?>
                <td>
                    Sufijo:<br />
                    <select name="sufijo">
                        <option value="%">Todos</option>
                    <?
                    for($i=5; $i<=65;$i+=5){
                        ?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?
                    }
                    ?>
                    </select>
                </td>
                <?
                }
                ?>
                <td>
                    Fecha Inicial:
                    <?=extDatePicker("fchInicial", date("Y-m-")."01")?>
                </td>
                <td>
                    Fecha Final:
                    <?=extDatePicker("fchFinal", date("Y-m-d"))?>
                </td>
                <td>
                    Sucursal:
                    <br />
                    <select name="sucursal">
                        <option value="">Todas</option>
                    <?
                    foreach( $sucursales as $s ){
                    ?>
                        <option value="<?=$s->getCaIdsucursal()?>"><?=$s->getCaNombre()?></option>
                    <?
                    }
                    ?>
                    </select>
                </td>
                <td>
                    Elaborada por:
                    <br />
                    <select name="login"> 
                        <option value="%">Todos</option>
                    <?
                    foreach( $usuarios as $u ){
                    ?>
                        <option value="<?=$u->getCaLogin()?>"><?=$u->getCaNombre()?></option>
                    <?
                    }
                    ?>
                    </select>
                </td>
             </tr>
             <tr>
                <td colspan="2">
                    Costo:
                    <br />
                    <select name="costo[]" multiple size="5" >
                    <?
                    foreach( $costos as $c ){
                    ?>
                        <option value="<?=$c->getCaIdcosto()?>"><?=$c->getCaCosto()." (".$c->getCaModalidad().")"?></option>
                    <?
                    }
                    ?>
                    </select>
                </td>
                <td style="vertical-align:top;">
                    Proveedor:<br />
                    <input type="text" name="proveedor" />
                </td>
                <td style="vertical-align:top;">
                    N&uacute;mero Factura:<br />
                    <input type="text" name="factura" />
                </td>
                 <?
                if($tipo!="expo")
                {
                ?>
                <td style="vertical-align:top;">
                    Puerto de descarga:
                    <br />
                    <select name="destino" >
                        <option value="%">Todos</option>
                    <?
                    foreach( $destinos as $d ){
                    ?>
                        <option value="<?=$d->getCaIdciudad()?>"><?=$d->getCaCiudad()?></option>
                    <?
                    }
                    ?>
                    </select>
                </td>
                <?
                }
                ?>
             </tr>
             <tr>
                <td colspan="6" align="center">
                    <input type="submit" value="Consultar" class="button" />                
                </td>
            </tr>
        </table>
         <br />
        <br />
<!--    
<table CELLSPACING=10>
    <tr>
      <th><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='document.location="/colsys_php/reporteador.php"'></th>
    </tr>
</table>
-->
    </form>
</div>