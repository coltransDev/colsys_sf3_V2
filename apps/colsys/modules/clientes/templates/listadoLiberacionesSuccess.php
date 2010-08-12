<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use_helper('ExtCalendar');
?>
<form action="<?=url_for( "clientes/reporteLiberaciones" )?>">

<table class="tableList" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" id="mainTable">
	<tr>
		<th colspan="7" style='font-size: 12px; font-weight:bold;'>Reporte Liberaciones de Clientes</th>
	</tr>
	<tr>
		<td colspan="7" style='font-size: 10px;'>Ingrese la fechas del periodo a consultar</td>
	</tr>
	<tr>
		<td rowspan="2">&nbsp;</td>

		<td>
			<span class="captura"><b>Fecha Inicial :</b> <br />
				<?=extDatePicker("fchStart", date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y"))) )?>
			</span>
  		</td>

		<td>
			<span ><b>Fecha Final :</b> <br />
				<?=extDatePicker("fchEnd", date("Y-m-d") )?>
			</span>
  		</td>

		<td>

			<span ><b>Sucursal :</b> <br />
                <select name="sucursal">

                    <?
                    foreach( $sucursales as $sucursal ){
                    ?>
                    <option value="<?=$sucursal['s_ca_nombre']?>"><?=$sucursal['s_ca_nombre']?></option>
                    <?
                    }
                    ?>

                </select>

			</span>
  		</td>

		<td><input class="submit" type='submit' name='buscar' value=' Buscar' /></td>
	</tr>
        <tr style="HEIGHT:5">
		<td  colspan="3"></td>
	</tr>
   </table>
</form>
