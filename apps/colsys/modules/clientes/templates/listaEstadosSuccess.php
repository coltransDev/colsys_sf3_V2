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

		<td><input class="submit" type='submit' name='buscar' value=' Buscar' /></td>
	</tr>
            <td  colspan="7">
                <span ><b>Simulaci&oacute;n :</b> Use &eacute;sta opci&oacute;n s&oacute;lo para efectos de evaluar el comportamiento del indicador frente a un eventual cambio en la forma de calcularlo.<br />
                    <center>
                    <input type='radio' name='simulacion' value='sin' checked/>Sin Simulaci&oacute;n&nbsp;&nbsp;
                    <input type='radio' name='simulacion' value='uno' />Un a&ntilde;o&nbsp;&nbsp;
                    <input type='radio' name='simulacion' value='dos' />Dos a&ntilde;os
                    </center>
            </td>

	<tr>
	</tr>

	<tr style="HEIGHT:5">
            <td  colspan="7">
                <center><b>MOTIVO DE CAMBIOS DE ESTADO EN CLIENTES</b></center>
                    <br /><b>Potencial a Activo:</b>
                    <ul>
                        <li>Coltrans: Cuando se registra en colsys el documento de transporte</li>
                        <li>Colmas - Expo.: Cuando se registra en colsys la factura de venta</li>
                    </ul>
                    <br /><b>Activo a Potencial:</b>
                    <ul>
                        <li>Coltrans-Colmas: Cuando pasado un año el cliente no registra documento de transporte o factura de venta según aplique.</li>
                    </ul>
                    <br /><b>Activo o Potencial a Vetado o viceversa:</b>
                    <ul>
                        <li>Se realiza manualmente por la Gerencia Comercial/Regional, Gerencia General o Presidencia.</li>
                    </ul>
            </td>
	</tr>


	<tr style="HEIGHT:5">
		<td  colspan="6"></td>
	</tr>
</table>
</form>