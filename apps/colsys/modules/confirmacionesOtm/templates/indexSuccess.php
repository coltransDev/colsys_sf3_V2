<div align="center">
    <br />
    <form action="<?= url_for("confirmacionesOtm/busqueda") ?>" method="post" >
        <table class="tableList" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" >		
            <tr>	
                <th colspan="3" style='font-size: 12px; font-weight:bold;'> Módulo de Confirmaciones de Llegada OTM</th>
            </tr>
            <tr>	
                <td colspan="3" style='font-size: 10px;'>Ingrese un criterio para realizar las busqueda</td>
            </tr>
            <tr>
                <td width="88" ><b>Buscar por:</b> <br />
                    <select name="criterio" size="7">
                        <option value="referencia" selected="selected">Número de referencia</option> 
                        <option value="reporte">Número de reporte</option>                         
                        <option value="motonave">Motonave</option>                         
                        <option value="hbl">HBL</option> 
                        <option value="cliente">Nombre del cliente</option> 
                        <option value="idcliente">NIT</option> 					
                    </select>				  
                </td>
                <td width="337" >&nbsp;
                    <b>Que contenga la cadena:</b><br />
                    <div id="cadena">
                        <input type="text" size="60" name="cadena" id="cadena" />
                    </div>				
                </td>
                <td width="64"><input  type='submit' name='buscar' value=' Buscar' /></td>
            </tr>
        </table>
    </form>	
</div>