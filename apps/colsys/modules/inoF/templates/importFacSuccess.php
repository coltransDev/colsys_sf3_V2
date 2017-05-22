<?
include_component("gestDocumental", "widgetUploadButton");
?>
<table class="tableList" width="80%" id="archivos" align="center" >
    <tr>
       <th colspan="2">
           Archivos
           Se deben de configurar archivos csv separados por punto y coma (;) con los siguientes campos<br>
    <div style="font-size: 9px">
        TIPO;COMPROBANTE;CONSECUTIVO;NIT;SUCURSAL;CUENTA;FECHA;CENTRO COSTO;SCENTRO;DESCRIPCI;D/C;VALOR;BASE RETENCION;MONEDA;TASA CAMBIO;EXTRANJERA;USUARIO;REFERENCIA;REFERENCIA HIJA
</div>
       </th>
    </tr>
    <tr>
        <td >
           <div id="button1" name="button1"></div>
        </td>
        <td>
            &nbsp;
        </td>
    </tr>
</table>
<table class="tableList" width="80%" id="archivos" align="center" >
    <tr><th colspan="2">Estadisticas</th></tr>
    <tr>
        <td class="b" style="width:150px">formato Incorrecto</td><td id="formato_incorrecto"></td>
    </tr>
    <tr>
        <td class="b">Sin Referencia</td><td id="sin_factura"></td>
    </tr>
    <tr>
        <td class="b">Sin House</td><td id="sin_recibo"></td>
    </tr>
    <tr>
        <td class="b">Sin Fecha</td><td id="sin_fecha"></td>
    </tr>
    <tr>
        <td class="b">Cuenta N/A</td><td id="sin_fecha"></td>
    </tr>
    <tr>
        <td colspan="2"><hr></td>
    </tr>
    
    <tr>
        <td class="b">No Actualizado</td><td id="no_actualizado"></td>
    </tr>
    <tr>
        <td class="b">Actualizados</td><td id="actualizada"></td>
    </tr>
    <tr>
        <td class="b">TOTAL</td><td id="total"></td>
    </tr>    
</table>

<table class="tableList" width="80%" id="archivos" align="center" >
    
    <tr><td><div id="resul"></div></td></tr>
        <tr><td><div id="resul1"></div></td></tr>
</table>

<script language="javascript" type="text/javascript">
button=0;
 Ext.onReady(function(){
     
        var uploadButton = new WidgetUploadButton({
                text: "Agregar Archivo",
                iconCls: 'arrow_up',
                folder: "<?=base64_encode("Rc")?>",
                filePrefix: "",
                confirm: true,
                callback: "actualizar_file"
            });
        uploadButton.render("button1");       
});
    function actualizar_file(file)
    {
        
        Ext.MessageBox.wait('Procesando', '');

        Ext.Ajax.request(
        {
            url: '<?=url_for("inoF/procesarFacturas")?>',
            params :	{
                archivo: file
            },
            failure:function(response,options){
                //var res = Ext.util.JSON.decode( options.response.responseText );

                Ext.Msg.hide();
                success = false;
                alert("Surgio un problema al procesar el archivo")
            },
            success:function(response,options){
                var res = Ext.util.JSON.decode( response.responseText );
                //alert(res.toSource());
                if( res.success ){
                    //alert("Se Proceso correctamente");
                    $("#resul").html("<p>Resumen:</p>"+res.resultado);
                    $("#resul1").html("<p>Resumen log Importados:</p>"+res.sqlimpor);
                    
                    if(res.estadisticas.formato_incorrecto)
                        $("#formato_incorrecto").html(res.estadisticas.formato_incorrecto);
                    
                    if(res.estadisticas.direfente_sucursal)
                        $("#direfente_sucursal").html(res.estadisticas.direfente_sucursal);
                    
                    if(res.estadisticas.sin_factura)
                        $("#sin_factura").html(res.estadisticas.sin_factura);
                    
                    if(res.estadisticas.sin_recibo)
                        $("#sin_recibo").html(res.estadisticas.sin_recibo);
                    
                    if(res.estadisticas.sin_fecha)
                        $("#sin_fecha").html(res.estadisticas.sin_fecha);
                    
                    if(res.estadisticas.no_encontrado)
                        $("#no_encontrado").html(res.estadisticas.no_encontrado);
                    
                    if(res.estadisticas.no_actualizado)
                        $("#no_actualizado").html(res.estadisticas.no_actualizado);
                    
                    if(res.estadisticas.actualizada)
                        $("#actualizada").html(res.estadisticas.actualizada);
                    
                    if(res.estadisticas.total)
                        $("#total").html(res.estadisticas.total);                        
                    
                }
            }
        });
        //alert(file)
    }    
</script>


