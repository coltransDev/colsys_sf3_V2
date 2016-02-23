<center>    
    <h3>M&oacute;dulo de Liberaciones Mar&iacute;timas</h3>
    <br />


    <form method="post" id="gestionDocsTransporte" action="<?= url_for('inoMaritimo/inoLiberacionSeaList') ?>">
        <table width="600" border="0" cellspacing="1" cellpadding="5" class="tableList">
            <tr>
                <th colspan="8" style='font-size: 12px; font-weight:bold;'>
                    <b>Ingrese un criterio de b&uacute;squeda para la Referencia</b>
                </th>
            </tr>
            <tr>
                <td class="listar" >Estado : <br/>
                    <select name="selFiltro" id="selFiltro">
                        <?
                        $sel = "selected";
                        foreach ($filtros as $key => $filtro) {
                            ?>
                            <option value="<?= ($key) ?>" <?=$sel?>><?= $filtro ?></option>
                            <?
                            $sel = "";
                        }
                        ?>
                    </select>
                </td>
                <td class="listar" >Que contenga la cadena : <br/>
                    <input id="cadena" name="cadena" type="text" value="" size="60">
                </td>
                <th style='vertical-align:center;' rowspan='3'>
                    <input class="submit" type='submit' name='buscar' value='  Buscar  ' />
                </th>
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

