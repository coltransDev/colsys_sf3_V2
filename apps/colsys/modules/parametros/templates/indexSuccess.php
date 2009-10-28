<?
/**
* Pantalla de bienvenida para el modulo de parametros
* @author Andres Botero
*/

?>
<form action="<?=url_for( "parametros/busqueda" )?>" method="post" >

<table class="tableList" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" >
	<tr>
		<th colspan="3" style='font-size: 12px; font-weight:bold;'>Modulo de conceptos</th>
    </tr>
	<tr>
		<td colspan="3" style='font-size: 10px;'>Ingrese un criterio para realizar las busqueda</td>
    </tr>
	<tr>
		<td width="88" ><b>Buscar por:</b> <br />
            <select name="criterio" size="7" >
                <option value="nombre" selected="selected">Nombre</option>                
                <option value="codigo">C&oacute;digo</option>
                <option value="cuenta">Cuenta</option>
                
            </select>
	    </td>
		<td width="337" >&nbsp;
		  <div id="visible" ><b>Que contenga la cadena:</b><br />
			<div id="cadena"><input type="text" name="cadena" id="cadena" size="60" /></div>			
          </div>
        </td>
	  <td width="64"  ><input  type='submit' name='buscar' value=' Buscar' /></td>
	</tr>
</table>
</form>