<?
/**
* Pantalla de bienvenida para el modulo de reportes 
* @author Carlos Gilberto Lopez Mendez
*/

use_helper('ExtCalendar');
?>
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
                <td class="listar" rowspan="2">Buscar por : <br/>
                    <select name="selFiltro" id="selFiltro" size=5>
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
                <td class="listar" colspan="3">Que contenga la cadena : <br/>
                    <input id="cadena" name="cadena" type="text" value="" size="60">
                </td>
                <th style='vertical-align:center;' rowspan='3'>
                    <input class="submit" type='submit' name='buscar' value='  Buscar  ' />
                </th>
            </tr>
		<td class="listar">
                    <span><b>Fecha Inicial :</b> <br />
                        <?=extDatePicker("fchinicial", null ) //date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y"))) ?> 
                    </span>
  		</td>
		<td class="listar">
                    <span><b>Fecha Final :</b> <br />
                        <?=extDatePicker("fchfinal", null ) //date("Y-m-d") ?>
                    </span>
  		</td>
            <tr>
            </tr>
            
            <tr>
                <td class="listar" colspan='5'>
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

