<?
/**
* Pantalla de bienvenida para el modulo de reportes
* @author Andres Botero, Mauricio Quinche
*/
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetCiudad");
?>

<div class="content" align="center">
	<table width="50%" border="0" class="tableList">
	<tr>
        <th scope="col" colspan="3" align="left"><b>Crear un nuevo reporte, seleccione el servicio</b></th>
	</tr>
    <tr><td colspan="3"><b>Importaci&oacute;n</b></td></tr>

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

        <td align="left">
            <?=link_to("OTM-DTA ", "reportesNeg/formReporte?modo=Marítimo&impoexpo=".constantes::OTMDTA )?>
	</td>
<?
	}
?>
	</tr>
    <tr><td colspan="3" ><b>Exportaci&oacute;n</b></td></tr>
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
        <td><div align="left">
            <?=link_to("Terrestre ", "reportesNeg/formReporte?modo=Terrestre&impoexpo=Exportación")?>
	</div></td>
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
			<?=link_to("Otros Servicios", "reportesNeg/formReporteOs")?>
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

		<td width="123" valign="top"  ><b>Buscar por:</b> <br />
            <select name="criterio" size="7">
                        <option selected="selected" value="ca_consecutivo">N&uacute;mero de reporte</option>
                        <option value="ca_nombre_cli">Cliente</option>
                        <option value="ca_nombre_con">Nombre del Consignatario </option>
                        <option value="ca_login">Mis Reportes </option>
                        <option value="ca_nombre_pro">Nombre del Proveedor </option>
                        <option value="ca_orden_prov">No.Orden Proveedor </option>
                        <option value="ca_orden_clie">No.Orden Cliente </option>
                        <option value="ca_idcotizacion">No. Cotización </option>
                        <option value="ca_mercancia_desc">Descripción Mercancia </option>
                        <option value="ca_login">Vendedor </option>
                        <option value="ca_traorigen">Tráficos </option>
                        <option value="ca_ciuorigen">Puerto  </option>
					</select>

		</td>
		<td  ><div id="visible" style="visibility:visible"><b>Que contenga la cadena:</b><br />
			<input type="text"  name="cadena" size="60" />
		</div>
            <br>
            <div>
            <div style="float:left;width: 33%"><b>Transporte</b> <br><span id="transpor"></span></div>
            <div style="float:left;width: 33%"><b>Origen</b> <br><span id="orig"></span></div>
            <div style="float:left;width: 33%"><b>destino</b> <br><span id="dest"></span></div>
            </div>
            <br>
            Por Fechas <input type="checkbox" onclick="habFechas(this)">
            <br>

            <div>
            <div  style="float: left;width: 50%">Fecha Inicial<div id="fecha1"></div></div>
            <div  style="float: left;width: 50%">Fecha Final<div id="fecha2"></div></div>
            </div>
            <script>
                var trasnpo=new WidgetTransporte({fieldLabel: "Transporte",id:"transporte", allowBlank:false,renderTo:'transpor',width:100});
                var orig=new WidgetCiudad({name: 'origen',hiddenName: 'idorigen',id: 'origen',width:100,renderTo:'orig'})
                var dest=new WidgetCiudad({name: 'destino',hiddenName: 'iddestino',id: 'destino',width:100,renderTo:'dest'})

                var fech1= new Ext.form.DateField(
                    {
                        fieldLabel: 'Fecha Inicial',
                        name : 'fechaInicial',
                        id   : 'fechaInicial',
                        format: 'Y-m-d',
                        value: '<?=$fechaInicial?>'
                    }
                );
                fech1.render("fecha1");
                var fech2= new Ext.form.DateField(
                    {
                        fieldLabel: 'Fecha Inicial',
                        name : 'fechaFinal',
                        id : 'fechaFinal',
                        format: 'Y-m-d',
                        value: '<?=$fechaFinal?>'
                    }
                );
                fech2.render("fecha2");
                function habFechas(obj)
                {
                    fech1.setDisabled(!obj.checked);
                    fech2.setDisabled(!obj.checked);
                }
            </script>
            <br>&nbsp;
            <div>
                <div  style="float: left;width: 50%">Seguro <select id="seguro" name="seguro"><option value="">...</option><option value="Sí" >Sí</option><option value="No" >No</option></select></div>
                <div  style="float: left;width: 50%">Aduanas <select id="colmas" name="colmas"><option value="">...</option><option value="Sí" >Sí</option><option value="No" >No</option></select></div>
            </div>
            
        </td>
		<td  ><input class="submit" type='submit' name='buscar' value=' Buscar' /></td>
	</tr>

</table>
</form>

<br />
<br />
</div>

