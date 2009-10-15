<?
/**
* Pantalla de bienvenida para el modulo de reportes 
* @author Andres Botero
*/

use_helper('ExtCalendar');
?>
<form action="<?=url_for( "clientes/reporteEstados" )?>">

<table class="tableList" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" id="mainTable">
	<tr>	
		<th colspan="7" style='font-size: 12px; font-weight:bold;'>Reporte Estado de Clientes</th>		
	</tr>
	<tr>	
		<td colspan="7" style='font-size: 10px;'>Ingrese la fecha inicial y final del peri&oacute;do a evaluar</td>
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
			<span ><b>Empresa :</b> <br />
                <select name="empresa">
                    <option value="Coltrans">Coltrans</option>
                    <option value="Colmas">Colmas</option>
                </select>
			</span>
  		</td>

		<td>
			<span ><b>Estado :</b> <br />
                <select name="estado">                   
                    <option value="Activo">Activo</option>
                    <option value="Potencial">Potencial</option>
                    <option value="Vetado">Vetado</option>
                </select>
			</span>
  		</td>

		<td>
            
			<span ><b>Sucursal :</b> <br />
                <select name="sucursal">

                     <option value="">Todas las Sucursales</option>
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

		<td rowspan="2"><input class="submit" type='submit' name='buscar' value=' Buscar' /></td>
	</tr>
	<tr style="HEIGHT:5">
		<td  colspan="6"></td>
	</tr>
</table>
</form>