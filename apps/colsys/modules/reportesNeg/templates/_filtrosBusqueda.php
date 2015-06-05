<?
/*
* Muestra los resultados de la busqueda del reporte de negocios
* @author Andres Botero , Mauricio Quinche
*/

include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetSucursales");
include_component("widgets", "widgetImpoexpo");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetIncoterms");
$sucursal=$sf_data->getRaw("sucursal");

?>
<div align="center">

<br />
<br />

<form action="<?=url_for( "reportesNeg/busquedaReporte".($opcion!=""?"?opcion=".$opcion:""))?>" method="post">
    <input type="hidden" name="idimpo" id="idimpo" value="<?=$idimpo?>"/>
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
                <option value="ca_consecutivo" <?=($criterio=="ca_consecutivo")?"selected":""?>>N&uacute;mero de reporte</option>
                        
                        <?
                        if($this->opcion=="otmmin")
                        {
                        ?>
                        <option value="ca_nombre_cli_otm" <?=($criterio=="ca_nombre_cli")?"selected":""?>>Cliente</option>
                        <option value="ca_importador" <?=($criterio=="importador")?"selected":""?>>Importador</option>
                        <?
                        }
                        else
                        {
                        ?>
                        <option value="ca_nombre_cli" <?=($criterio=="ca_nombre_cli")?"selected":""?>>Cliente</option>
                        <?
                        }
                        ?>
                        <option value="ca_nombre_con" <?=($criterio=="ca_nombre_con")?"selected":""?>>Nombre del Consignatario </option>
                        <option value="ca_login" <?=($criterio=="ca_login")?"selected":""?>>Mis Reportes </option>
                        <option value="ca_nombre_pro" <?=($criterio=="ca_nombre_pro")?"selected":""?>>Nombre del Proveedor </option>
                        <option value="ca_orden_prov" <?=($criterio=="ca_orden_prov")?"selected":""?>>No.Orden Proveedor </option>
                        <option value="ca_orden_clie" <?=($criterio=="ca_orden_clie")?"selected":""?>>No.Orden Cliente </option>
                        <option value="ca_idcotizacion" <?=($criterio=="ca_idcotizacion")?"selected":""?>>No. Cotización </option>
                        <option value="ca_mercancia_desc" <?=($criterio=="ca_mercancia_desc")?"selected":""?>>Descripción Mercancia </option>
                        <option value="ca_login" <?=($criterio=="ca_login")?"selected":""?>>Vendedor </option>
                        <option value="ca_traorigen" <?=($criterio=="ca_traorigen")?"selected":""?>>Tráficos </option>
                        <option value="ca_ciuorigen" <?=($criterio=="ca_ciuorigen")?"selected":""?>>Puerto  </option>
                        <!--<option value="ca_hbls" <?=($criterio=="ca_hbls")?"selected":""?>>Hbl</option>-->
            </select>
            <div ><b>Sucursal</b><br><span id="divsucursales"></span>
            </div>
            <script>
                var sucur=new WidgetSucursales({fieldLabel: "Sucursal",id:"sucursal",name:"sucursal", renderTo:'divsucursales',width:100,value:'<?=$sucursal?>'});
            </script>

		</td>
		<td  ><div id="visible" style="visibility:visible"><b>Que contenga la cadena:</b><br />
			<input type="text"  name="cadena" size="60" value="<?=$cadena?>" />
		</div>
            <br>
            Por Fechas <input type="checkbox" onclick="habFechas(this)">
            <br>
            <div id="divfechas" style="display: none">
            <div  style="float: left;width: 50%">Fecha Inicial<div id="fecha1"></div></div>
            <div  style="float: left;width: 50%">Fecha Final<div id="fecha2"></div></div>
            </div>
            <br>
             <div>
            <div style="float:left;width: 28%"><b>Transporte</b> <br><span id="transpor"></span></div>
            <div style="float:left;width: 28%"><b>Modalidad</b> <br><span id="mod"></span></div>
            <div style="float:left;width: 22%"><b>Origen</b> <br><span id="orig"></span></div>
            <div style="float:left;width: 22%"><b>Destino</b> <br><span id="dest"></span></div>
            </div>
            <br>            
            <script>
                var trasnpo=new WidgetTransporte({fieldLabel: "Transporte",id:"transporte", renderTo:'transpor',width:100,value:'<?=$transporte?>'});
                var impoexpo =new WidgetImpoexpo({fieldLabel: 'Impo/Expo', id: 'impoexpo', hiddenName: "impoexpo", value:"<?=Constantes::IMPO ?>"});
                var modalidad=new WidgetModalidad({fieldLabel: "Modalidad",id:"modalidad", name: 'modalidad', linkTransporte: "transporte", linkImpoexpo: "impoexpo", allowBlank: true,renderTo:'mod',width:100,value:'<?=$modalidad?>'});
                var orig=new WidgetCiudad({name: 'origen',hiddenName: 'idorigen',id: 'origen',width:80,renderTo:'orig',value:'<?=$origen?>',hiddenValue:'<?=$idorigen?>'});
                var dest=new WidgetCiudad({name: 'destino',hiddenName: 'iddestino',id: 'destino',width:80, renderTo:'dest', value:'<?=$destino?>', hiddenValue:'<?=$iddestino?>'});

                var fech1= new Ext.form.DateField(
                    {
                        fieldLabel: 'Fecha Inicial',
                        name : 'fechaInicial',
                        id   : 'fechaInicial',
                        format: 'Y-m-d',
                        value: '<?=$fechaInicial?>',
                        width: '90'
                    }
                );
                fech1.render("fecha1");
                var fech2= new Ext.form.DateField(
                    {
                        fieldLabel: 'Fecha Inicial',
                        name : 'fechaFinal',
                        id : 'fechaFinal',
                        format: 'Y-m-d',
                        value: '<?=$fechaFinal?>',
                        width: '90'
                    }
                );
                fech2.render("fecha2");
                function habFechas(obj)
                {
                    if($("#divfechas").css("display")=="none")
                        $("#divfechas").show();
                    else
                    {
                        $("#divfechas").hide();
                        fech1.setValue("");
                        fech2.setValue("");
                    }

                    fech1.setDisabled(!obj.checked);
                    fech2.setDisabled(!obj.checked);


                }
            </script>
            <br>&nbsp;
            <div>
                <div style="float:left;width: 28%"><b>Incoterms</b> <br><span id="terms"></span></div>
                <div  style="float: left;width: 22%"><b>Seguro</b><br><select id="seguro" name="seguro"><option value="">...</option><option value="Sí" <?=($seguro=="Sí")?"selected":""?>>Sí</option><option value="No" <?=($seguro=="No")?"selected":""?>>No</option></select></div>
                <div  style="float: left;width: 25%"><b>Aduanas</b> <br><select id="colmas" name="colmas"><option value="">...</option><option value="Sí" <?=($colmas=="Sí")?"selected":""?>>Sí</option><option value="No" <?=(cadena=="No")?"selected":""?>>No</option></select></div>
                <div  style="float: left;width: 25%"><b>Continuacion</b> <br>
                        <select id="continuacion" name="continuacion">
                            <option value="">...</option>
                            <option value="OTM" <?=($continuacion=="OTM")?"selected":""?>>OTM</option>
                            <option value="DTA" <?=($continuacion=="DTA")?"selected":""?>>DTA</option>
                            <option value="CABOTAJE" <?=($continuacion=="CABOTAJE")?"selected":""?>>CABOTAJE</option>
                        </select>
                </div>
            </div>
            <script>
                var incoterms=new WidgetIncoterms({name:"incoterms",id:"incoterms",renderTo:'terms',width:100, value:'<?=$incoterm?>'});
            </script>

        </td>
		<td  ><input class="submit" type='submit' name='buscar' value=' Buscar' /></td>
	</tr>

</table>
</form>

<br />
<br />
</div>
