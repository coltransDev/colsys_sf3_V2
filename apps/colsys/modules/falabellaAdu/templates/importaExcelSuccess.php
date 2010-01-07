<form method="POST" action="<?=url_for('falabellaAdu/importaExcel')?>" enctype="multipart/form-data">
<center>
<table width="30%" border="0" cellspacing="3" cellpadding="0">
    <tr>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
    </tr>
    <tr>
        <td>Archivo Aprocom</td>
        <td><input type="file" name="archivo" ></td>
    </tr>
    <tr>
        <td>Caracter de Sepación</td>
        <td><input type="radio" name="separador" value="9">Tabulador &nbsp;<input type="radio" name="separador" value="59">Punto y Coma&nbsp;<input type="radio" name="separador" value="44" checked>Coma</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="submit" value="Cargar el Archivo"></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><div id="resultadoImport"></div></td>
    </tr>
</table>
</center>
</form>