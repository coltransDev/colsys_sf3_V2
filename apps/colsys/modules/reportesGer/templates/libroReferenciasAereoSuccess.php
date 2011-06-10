<?php
/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>

<div align="center">
    <h3>Informe de Referencias Procesadas</h3>
    <form name="busquedaRepRefForm" method="post" action="<?= url_for("reportesGer/libroReferenciasAereo") ?>">
        <input name="entrada" value="0" type="hidden">
        <table width="700" cellpadding="5" cellspacing="1" border="0" class="tableList">
            <tbody><tr>
                    <th colspan="7" style="font-size: 12px; font-weight: bold;"><b>Ingrese los parámetros para el Reporte</b></th>
                </tr>

                <tr>

                    <td class="listar">Año a Consultar : <br />              
                        <select name="anio">
                            <?
                            for ($i = date("Y"); $i >= 2006; $i--) {
                                ?>  
                                <option value="<?= substr($i, -1, 1) ?>"><?= $i ?></option>
                                <?
                            }
                            ?>

                        </select>
                    </td>
                    <td class="listar">Mes a Consultar: <br>
                        <select name="mes"><option value="%">Todos los Meses</option>
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </td>

                    <td class="mostrar">Tráfico : <br />
                        <select name="idtrafico"><option value="%">Todos los Tráficos</option>
                            <?
                            foreach ($traficos as $trafico) {
                                ?>  
                                <option value="<?= $trafico->getCaIdtrafico() ?>"><?= $trafico->getCaNombre() ?></option>
                                <?
                            }
                            ?>
                        </select>
                    </td>
                    <td class="mostrar" >Listar detalle de hijas: <br />
                        <input type="checkbox" name="detalle" checked="checked" />
                    </td>
                    <td class="mostrar">
                        <input class="submit" name="buscar" value="  Buscar  " type="SUBMIT">
                    </td>

                </tr>        
            </tbody></table>
        <br>
        <table cellspacing="10">
            <tbody><tr>
                    <th>

                        <input class="button" name="boton" value="Terminar" onclick='document.location = "reporteadorAereo.php"' type="BUTTON">
                    </th>
                </tr>
            </tbody></table>
    </form>
</div>