<center>    
    <h3>M&oacute;dulo de Apertura de Casos</h3>
    <br />


    <form method="post" id="reporteCargaForm" action="aperturaCasosList">
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
                        $sel = "selected";
                        foreach ($sucursales as $key => $sucursal) {
                            ?>
                            <option value="<?= ($key) ?>" <?=$sel?>><?= $sucursal ?></option>
                            <?
                            $sel = "";
                        }
                        ?>
                    </select>
                </td>
                <td class="listar">Sufijo : <br/>
                    <select name="selSufijo" id="selSufijo">
                        <?
                        $sel = "selected";
                        foreach ($sufijos as $key => $sufijo) {
                            ?>
                            <option value="<?= ($key) ?>" <?=$sel?>><?= $sufijo ?></option>
                            <?
                            $sel = "";
                        }
                        ?>
                    </select>
                </td>
                <td class="listar">Tráfico : <br/>
                    <select name="selTrafico" id="selTrafico">
                        <?
                        $sel = "selected";
                        foreach ($traficos as $key => $trafico) {
                            ?>
                            <option value="<?= ($key) ?>" <?=$sel?>><?= $trafico ?></option>
                            <?
                            $sel = "";
                        }
                        ?>
                    </select>
                </td>
                <td class="listar" >Estado : <br/>
                    <select name="casos" id="casos">
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
                <td class="listar">Usuario : <br/>
                    <select name="selUsuario" id="selUsuario">
                        <?
                        $sel = "selected";
                        foreach ($usuarios as $key => $usuario) {
                            ?>
                            <option value="<?= ($key) ?>" <?=$sel?>><?= substr($usuario,0,30) ?></option>
                            <?
                            $sel = "";
                        }
                        ?>
                    </select>
                </td>
                <th style='vertical-align:center;'>
                    <input class="submit" type='submit' name='buscar' value='  Buscar  ' />          </th>
            </tr>
        </table>

        <br />
        <table cellspacing="10">
            <tr>
                <th>
                    <input class="button" type='button' name='boton' value='Terminar' onClick="document.location = '/'" />          </th>
            </tr>
        </table>
    </form>

</center>
