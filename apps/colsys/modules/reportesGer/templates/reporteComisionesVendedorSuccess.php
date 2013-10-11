<script type="text/javascript">
	function verReportes(){
		var modulo = document.getElementById("modulo").value;
		
		var anio = document.getElementById("anio").value;
		var mes = document.getElementById("mes").value;
		var casos = document.getElementById("casos").value;
		var tipo = document.getElementById("tipo").value;
		var selSucursal = document.getElementById("selSucursal").value;
		
		if( anio=="%" ){
			anio="%25";
		}


		if( mes=="%" ){
			mes="%25";
		}
		
		if( selSucursal=="%" ){
			selSucursal="%25";
		}
		
		var queryStr = "?entrada=1&comision=1&buscar=buscar&anio="+anio+"&mes="+mes+"&casos="+casos+"&selSucursal="+selSucursal+"&strSelCollection=<?=$userid?>&tipo="+tipo;
		switch( modulo ){
			case "aduana":
				document.location="/Coltrans/Reportes/ReporteBrkComisionAction.do"+queryStr;
				break;
			case "aereo":
				document.location="/Coltrans/Reportes/ReporteComisionAction.do"+queryStr;
				break;
			case "exportaciones":
				document.location="/Coltrans/Reportes/ReporteExpoComisionAction.do"+queryStr;
				break;				
		}
				
	}
</script>

<center>    
      <h3>Informe de Comisiones para Vendedores</h3>
	  <br />

    
    <form method="post" id="reporteCargaForm" >
      <input type="hidden" name="entrada" value="" />
      <input type="hidden" name="comision" value="1" />
      <table width="600" border="0" cellspacing="1" cellpadding="5" class="tableList">
        <tr>
          <th colspan="7" style='font-size: 12px; font-weight:bold;'>
            <b>Ingrese los par&aacute;metros para el Reporte</b>          </th>
        </tr>
        <tr>
          <td class="listar"><p>Modulo</p>
          	
          		<select name="modulo" id="modulo">
          			<option value="aduana">Aduana</option>
          			<option value="aereo">A&eacute;reo</option>
          			<option value="exportaciones">Exportaciones</option>
          			
       			</select>          	</td>
          <td class="listar">Año: <br />
            <select name="anio" id="anio">
                <option value="<?=(date("Y")%10)?>" selected><?=date("Y")?></option>
                <?
                for($i=(date("Y")-1);$i>=(date("Y")-5);$i--)
                {
                ?>
                <option value="<?=($i%10)?>"><?=$i?></option>
                <?
                }
                ?>
            </select>          
          </td>
          <td class="listar">Mes: <br />
            <select name="mes" id="mes">
            	<option value="%">Todos los Meses</option>
              <option value="01">Enero</option>

              <option value="02">Febrero</option>
              <option value="03">Marzo</option>
              <option value="04">Abril</option>
              <option value="05">Mayo</option>
              <option value="06">Junio</option>
              <option value="07">Julio</option>

              <option value="08">Agosto</option>
              <option value="09">Septiembre</option>
              <option value="10">Octubre</option>
              <option value="11">Noviembre</option>
              <option value="12">Diciembre</option></select>          </td>

          <td class="listar">Sucursal : <br/>
            <select name="selSucursal" id="selSucursal">
            	<option value="%">Todas las Sucursales</option>
              <option value="Barranquilla">Barranquilla</option>
<option value="Bogot&aacute; D.C.">Bogotá D.C.</option>
<option value="Bucaramanga">Bucaramanga</option>
<option value="Buenaventura">Buenaventura</option>
<option value="Cali">Cali</option>

<option value="Cartagena">Cartagena</option>
<option value="Medell&iacute;n">Medellín</option>
<option value="Miami">Miami</option>
<option value="Pereira">Pereira</option></select>
          </td>
          
          <td class="listar" >Estado : <br/>
            <select name="casos" id="casos">
            	<option value="cer">Casos Cerrados</option>
              <option value="abi">Casos Abiertos</option>
              <option value="todos">Todos los Casos</option></select>          </td>
            <td class="listar" style="vertical-align:center;">
              Tipo : <br/>
              <select name="tipo" id="tipo">
              	<option value="todos">Ambos</option>
                  <option value="impo">Nacionalizaci&oacute;n</option>
                  <option value="expo">Exportaci&oacute;n</option></select>

            </td>
            <th style='vertical-align:center;'>
            	<input class="submit" type='button' name='buscar' value='  Buscar  ' onclick="verReportes()" />          </th>
        </tr>
      </table>

      <br />
      <table cellspacing="10">
        <tr>
          <th>
            <input class="button" type='button' name='boton' value='Terminar' onClick="document.location='/'" />          </th>
        </tr>
      </table>
    </form>

</center>
