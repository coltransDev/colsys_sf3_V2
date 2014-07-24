<center>    
    <h3>Reporte Comisiones Marítimo Pendientes por Cobrar</h3>
    <br />


    <form method="post" id="reporteCargaForm" action="reporteComisionesXCobrarList">
        <table width="600" border="0" cellspacing="1" cellpadding="5" class="tableList">
            <tr>
                <th colspan="8" style='font-size: 12px; font-weight:bold;'>
                    <b>Ingrese los par&aacute;metros para el Reporte</b>          </th>
            </tr>
            <tr>
                <td class="listar">Año: <br />
                    <select name="anio" id="anio">
                        <?
                        $sel = "selected";
                        foreach ($annos as $anno) {
                            ?>
                            <option value="<?= ($anno) ?>" <?=$sel?>><?= $anno ?></option>
                            <?
                            $sel = "";
                        }
                        ?>
                    </select>          
                </td>
                <td class="listar">Mes: <br />
                    <select name="mes" id="mes">
                        <?
                        $sel = "selected";
                        foreach ($meses as $key => $mes) {
                            ?>
                            <option value="<?= ($key) ?>" <?=$sel?>><?= $mes ?></option>
                            <?
                            $sel = "";
                        }
                        ?>
                    </select>
                </td>
                <td class="listar">Sucursal : <br/>
                    <select name="selSucursal" id="selSucursal">
                        <?
                        foreach ($sucursales as $key => $sucursal) {
                            ?>
                            <option value="<?= ($key) ?>" selected><?= $sucursal ?></option>
                            <?
                        }
                        ?>
                    </select>
                </td>
                <td class="listar">Vendedor : <br/>
                    <select name="selUsuario" id="selUsuario">
                        <?
                        $sel = "selected";
                        foreach ($vendedores as $key => $vendedor) {
                            ?>
                            <option value="<?= ($key) ?>" <?=$sel?>><?= substr($vendedor,0,30) ?></option>
                            <?
                            $sel = "";
                        }
                        ?>
                    </select>
                </td>
                <td class="listar" rowspan='3'>Incoterms : <br/>
                    <select name="selIncoterms[]" id="selIncoterms[]" multiple size="7">
                        <?
                        $sel = "selected";
                        foreach ($incoterms as $key => $incoterm) {
                            ?>
                            <option value="<?= ($key) ?>" <?=$sel?>><?= $incoterm ?></option>
                            <?
                            $sel = "";
                        }
                        ?>
                    </select>
                </td>
                <th style='vertical-align:center;' rowspan='3'>
                    <input class="submit" type='submit' name='buscar' value='  Buscar  ' />
                </th>
            </tr>
            <tr>
                <td class="listar" >
                    &nbsp;
                </td>
                <td class="listar" >Circular : <br/>
                    <select name="selCircular" id="selCircular">
                        <?
                        $sel = "selected";
                        foreach ($circulares as $key => $circular) {
                            ?>
                            <option value="<?= ($key) ?>" <?=$sel?>><?= $circular ?></option>
                            <?
                            $sel = "";
                        }
                        ?>
                    </select>
                </td>
                <td class="listar" >Utilidad o Pérdida : <br/>
                    <select name="selResultado" id="selResultado">
                        <?
                        $sel = "selected";
                        foreach ($resultados as $key => $resultado) {
                            ?>
                            <option value="<?= ($key) ?>" <?=$sel?>><?= $resultado ?></option>
                            <?
                            $sel = "";
                        }
                        ?>
                    </select>
                </td>
                <td class="listar" >Estado : <br/>
                    <select name="selCasos" id="selCasos">
                        <?
                        $sel = "selected";
                        foreach ($estados as $key => $estado) {
                            ?>
                            <option value="<?= ($key) ?>" <?=$sel?>><?= $estado ?></option>
                            <?
                            $sel = "";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="listar" colspan='4'>
                    &nbsp;
                </td>
            </tr>
        </table>

        <br />
        <table cellspacing="10">
            <tr>
                <th>
                    <input class="button" type='button' name='boton' value='Terminar' onClick="document.location = '/'" />
                </th>
            </tr>
        </table>
    </form>

</center>
