<?
/**
* Pantalla de bienvenida para el modulo de reportes
* @author Andres Botero, Mauricio Quinche
*/
?>

<div class="content" align="center">
	<table width="50%" border="0" class="tableList">
	<tr>
        <th scope="col" colspan="2" align="left"><b>Crear un nuevo reporte, seleccione el servicio</b></th>
	</tr>
    <tr><td colspan="2"><b>Importaci&oacute;n</b></td></tr>

    <tr style="padding: 10px">
<?
//	if( $nivelAereo>=0 )
    {

?>
        <td align="left">
			<?=link_to("Aéreo", "reportesNeg/formReporte?modo=Aéreo&impoexpo=Importación" )?>
		</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
			<?=link_to("Marítimo", "reportesNeg/formReporte?modo=Marítimo&impoexpo=Importación")?>
		</div></td>
<?
	}
?>
	</tr>
    <tr><td colspan="2" ><b>Exportaci&oacute;n</b></td></tr>
    <tr style="padding: 10px">
<?
//	if( $nivelAereo>=0 )
    {

?>
        <td align="left">
			<?=link_to("Aéreo", "reportesNeg/formReporte?modo=Aéreo&impoexpo=Exportación" )?>
		</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
			<?=link_to("Marítimo", "reportesNeg/formReporte?modo=Marítimo&impoexpo=Exportación")?>
		</div></td>
<?
	}
?>
	</tr>
<?

//    if( $nivelAduana>=0 )
    {

	?>
    <tr style="display: none">
		<td><div align="left">
			<?=link_to("Aduana", "reportesNeg/formReporte?idcategory=21")?>
		</div></td>
	</tr>
	<?
	}
?>
    <tr><td colspan="2" ><b>Triangulaci&oacute;n</b></td></tr>
    <tr style="padding: 10px">
<?
//	if( $nivelAereo>=0 )
    {

?>
        <td align="left">
			<?=link_to("Aéreo", "reportesNeg/formReporte?modo=Aéreo&impoexpo=Triangulación" )?>
		</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
			<?=link_to("Marítimo", "reportesNeg/formReporte?modo=Marítimo&impoexpo=Triangulación")?>
		</div></td>
<?
	}
?>
	</tr>
     <tr><td colspan="2" ><b>Otros</b></td></tr>
    <tr>
        <td><div align="left">                
			<?=link_to("Ag", "reportesNeg/indexAg")?>
		</div></td>
        <td><div align="left">
			<?=link_to("Otros Servicios", "reportesNeg/indexOs")?>
		</div></td>
    </tr>

</table>

</div>
<div align="center">

<br />
<br />

<form action="<?=url_for( "reportesNeg/busquedaReporte")?>" method="post">
<table width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" class="tableList alignLeft">
	<tr>
		<th colspan="3" style='font-size: 12px; font-weight:bold;'><b>Sistema Reporte de negocios </b>		</th>
	</tr>
    <tr>
		<td colspan="3" style='font-size: 10px;'>Ingrese un criterio para realizar las busqueda</td>

    </tr>
	<tr>

		<td width="123"  ><b>Buscar por:</b> <br />
            <select name="criterio" size="7">
						<option selected="selected" value="numero_de_reporte">N&uacute;mero de reporte</option>
						<option value="cliente">Cliente</option>
                        <option value="">Nombre del Consignatario </option>
                        <option value="login">Mis Reportes </option>
                        <option value="proveedor">Nombre del Proveedor </option>
                        <option value="orden_proveedor">No.Orden Proveedor </option>
                        <option value="orden_cliente">No.Orden Cliente </option>
                        <option value="cotizacion">No. Cotización </option>
                        <option value="mercancia_desc">Descripción Mercancia </option>
                        <option value="vendedor">Vendedor </option>
                        <option value="">Borradores </option>
                        <option value="">Tráficos </option>
                        <option value="ciudadorigen">Puerto  </option>
					</select>

		</td>
		<td  ><div id="visible" style="visibility:visible"><b>Que contenga la cadena:</b><br />
			<input type="text"  name="cadena" size="60" />
		</div>
            <br>
            Por Fechas <input type="checkbox" onclick="habFechas(this)">
            <br>
            <div  style="float: left;width: 50%">Fecha Inicial<div id="fecha1"></div></div>
            <div  style="float: left;width: 50%">Fecha Final<div id="fecha2"></div></div>
            <script>
                var fech1= new Ext.form.DateField(
                    {
                        fieldLabel: 'Fecha Inicial',
                        name : 'fechaInicial',
                        id   : 'fechaInicial',
                        format: 'Y-m-d',
                        value: '<? //=date("Y-m-")."01"?>'
                    }
                );
                fech1.render("fecha1");
                var fech2= new Ext.form.DateField(
                    {
                        fieldLabel: 'Fecha Inicial',
                        name : 'fechaFinal',
                        id : 'fechaFinal',
                        format: 'Y-m-d',
                        value: '<? //=date("Y-m-d")?>'
                    }
                );
                fech2.render("fecha2");
                function habFechas(obj)
                {
                    fech1.setDisabled(!obj.checked);
                    fech2.setDisabled(!obj.checked);
                }
            </script>
            
        </td>
		<td  ><input class="submit" type='submit' name='buscar' value=' Buscar' /></td>
	</tr>

</table>
</form>

<br />
<br />
</div>

