<?php
/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

use_helper("ExtCalendar");
?>
<div class="content" align="center" >
    <h3>Listado de Comprobantes</h3>
    <form action="<?=url_for("inoReportes/listadoComprobantes")?>" method="post" >
        
        <table class="tableList" border="0" cellpadding="5" cellspacing="1" width="600">
            <tbody>
                <tr>
                    <th colspan="7" style="font-size: 12px; font-weight: bold;">
                        <b>Ingrese los parámetros para el Reporte</b>
                    </th>
                </tr>
                <tr>      
                    <td class="listar" colspan="2">Tipo de Comprobante: 
                        <br />
                        <select name="tipo">
                            <option value="F">Factura de cliente</option>
                            <option value="P">Factura de proveedor</option>
                        </select>
                    </td>
                    <td class="listar" colspan="2">Fecha Inicial: 
                        <?
                        echo extDatePicker('fecIni');
                        ?>
                    </td>
                    <td class="listar" colspan="2">Fecha Final: 
                        <?
                        echo extDatePicker('fecFin');
                        ?>                        
                    </td>
                    <th style="" rowspan="2">
                        <input class="submit" name="buscar" value="  Buscar  " type="submit">
                    </th>

                </tr>
                
                <tr>      
                    <td class="listar" colspan="2">No factura
                        <br>
                        <input class="submit" name="nofactura" id="nofactura" value="" type="text">
                    </td>
                    <td class="listar" colspan="2">Emitido a
                        <br>
                        <input class="submit" name="emitido" id="emitido" value="" type="text">
                    </td>
                    <td class="listar" colspan="2">Ordenar por 
                        <br />
                        <select name="orden">
                            <option value="referencia">Referencia</option>
                            <option value="comprobante">Comprobante</option>
                            <option value="fchcomprobante">Fch. Comprobante</option>
                            <option value="nombre">Emitida a</option>
                            <option value="doctransporte">Doc. Transporte</option>
                        </select>
                    </td>
                </tr>

            </tbody>
        </table>
        <br>
        <table cellspacing="10">
            <tbody><tr>
                    <th>

                        <input class="button" name="boton" value="Terminar" onclick='redirect("../../Reporteador.php")' type="BUTTON">
                    </th>
                </tr>
            </tbody></table>
    </form>
</div>   