<?
use_helper("MimeType");
?>
<script language="javascript">

    function ocultarMostrarReporte(id) {
        var tabla = document.getElementById('lista');
        var trs = tabla.getElementsByTagName('tr');

        for (i = 0; i < trs.length; i++) {
            if (trs[i].id.substr(0, 7) == 'infotr_') {
                if (trs[i].id != 'infotr_' + id) {
                    if (trs[i].style.display != "none") {
                        trs[i].style.display = 'none';
                    }
                }
            }
        }


        if (document.getElementById('infotr_' + id).style.display == 'none') {
            document.getElementById('infotr_' + id).style.display = '';

            histContent = document.getElementById('info_' + id);

            if (histContent.innerHTML == "") {
                actualizar(id);
            }
        } else {
            document.getElementById('infotr_' + id).style.display = 'none';
        }
    }

    function actualizar(id) {
        histContent = document.getElementById('info_' + id);
        histContent.innerHTML = "<div id='indicator'></div>";
        Ext.Ajax.request({
            url: '<?= url_for("traficos/infoReporte"); ?>',
            params: {
                idreporte: id,
                modo: '<?= $modo ?>'
            },
            success: function (xhr) {
                $('#info_' + id).html(xhr.responseText);

            },
            failure: function (response, options) {
                Ext.MessageBox.alert('Error Message', "Se ha presentado un error: " + (response.status ? "\n Codigo HTTP " + response.status : ""));
            }
        });

    }


    function actualizarListaStatus(id) {

    }


    function actualizarArchivos(idreporte) {
        Ext.Ajax.request({
            url: '<?= url_for("traficos/listaArchivosReporte?modo=" . $modo); ?>',
            params: {
                idreporte: idreporte
            },
            success: function (xhr) {
                document.getElementById('archivosReporte_' + idreporte).innerHTML = xhr.responseText;

            },
            failure: function () {
                Ext.Msg.alert("Error", "Server communication failure");
            }
        });
    }

    function eliminarArchivos(idreporte, file) {
        if (confirm("Esta seguro que desea eliminar este archivo?")) {
            Ext.Ajax.request({
                url: '<?= url_for("traficos/eliminarArchivosReporte"); ?>',
                params: {
                    idreporte: idreporte,
                    file: file
                },
                success: function (xhr) {
                    actualizarArchivos(idreporte);

                },
                failure: function () {
                    Ext.Msg.alert("Error", "Server communication failure");
                }
            });
        }
    }


    function terminarTarea(reporte, idtarea) {

        if (confirm("Esta seguro que desea terminar esta tarea?")) {
            Ext.Ajax.request({
                url: '<?= url_for("traficos/terminarSeguimiento"); ?>',
                params: {
                    reporte: reporte,
                    idtarea: idtarea,
                    modo: "<?= $modo ?>"
                },
                failure: function (response, options) {
                    var res = Ext.util.JSON.decode(response.responseText);
                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + (res.errorInfo ? ": " + res.errorInfo : "") + " - " + (response.status ? "\n Codigo HTTP " + response.status : ""));
                },
                //Ejecuta esta accion cuando el resultado es exitoso
                success: function (response, options) {
                    var res = Ext.util.JSON.decode(response.responseText);
                    if (res.success) {
                        document.getElementById("res_" + idtarea).innerHTML = " <b>OK</b>";
                    } else {
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + (res.errorInfo ? ": " + res.errorInfo : "") + " - " + (response.status ? "\n Codigo HTTP " + response.status : ""));
                    }
                }
            });
        }
    }

    function habilitar() {
        $(".hdrep").toggle();        
        $('.div_text').toggle();        
    }

    function crearOpcion() {

        if ($("#divPpal").find("img").length == 0) {

            a = $('<div></div>');
            a.attr('id','divPpal');
            a.addClass('toolbarbtnWraper');
            a.appendTo(".toolbar");                

            $('<img/>', {
                src: '/images/22x22/encrypted.gif',
                width: '18px',
                height: '18px'
            }).appendTo("#divPpal");

            $('<p/>', {
                text: 'Cerrar reportes (Sacar del tracking)'
            }).appendTo("#divPpal");

            $("#divPpal").click(function () {
                cerrarCasos()
            });
        }
    }

    function cerrarCasos() {
        if (confirm("Esta seguro que desea sacar del tracking los reportes seleccionados?")) {
            var reportes = new Array();
            <?
                foreach ($reportes as $reporte) {
                    ?>
                    var r = $('#checkbox_<?= $reporte->getCaIdreporte() ?>');
                    if (r.is(":checked")) {
                        reportes.push(<?= $reporte->getCaIdreporte() ?>);
                    }
                    <?
                }
            ?>
            var nreportes = reportes.length;            
            var tiempo = 0;
            $.each(reportes, function (index, idreporte) {
                
                Ext.Ajax.request({
                    waiting: 'Cerrando Reportes...',
                    url: '<?= url_for("traficos/cerrarCaso"); ?>',
                    params: {
                        idreporte: idreporte,
                        modo: '<?= $modo ?>',
                        tipo: '1' /*se cierran varios casos a la vez*/
                    },
                    failure: function (response, options) {
                        var res = Ext.util.JSON.decode(response.responseText);
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + (res.errorInfo ? ": " + res.errorInfo : "") + " - " + (response.status ? "\n Codigo HTTP " + response.status : ""));
                    },
                    //Ejecuta esta accion cuando el resultado es exitoso
                    success: function (response, options) {
                        tiempo++;
                        if(tiempo == nreportes){
                            setTimeout(function(){location.reload()},200);
                        }
                        if(index==(nreportes-1)){
                            var res = Ext.util.JSON.decode(response.responseText);                    
                            if (res.success) {
                                Ext.MessageBox.alert("Mensaje", "Los reportes han sido borrados correctamente.");
                            } else {
                                Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + (res.errorInfo ? ": " + res.errorInfo : "") + " - " + (response.status ? "\n Codigo HTTP " + response.status : ""));
                            }
                        }
                    }
                });
            });            
            $("#divPpal").remove();
            $("input:checkbox").attr('checked', false);
        }
    }
</script>



<div align="center" class="content" >
    <h3><?= Utils::replace(isset($cliente) ? $cliente->getCaCompania() : "" ) ?></h3>
    <br /><br />

    <table width="100%" border="1" class="tableList" id="lista">
        <tr>
            <th width="10%" scope="col"><div align="left">Fecha Rep </div></th>
            <th width="8%" scope="col"><div align="left">Reporte</div></th>
            <th width="8%" scope="col"><div align="left">Origen</div></th>
            <th width="8%" scope="col"><div align="left">Destino</div></th>
            <th width="8%" scope="col">
                <div align="left">Modalidad</div>		</th>
            <th width="32%" scope="col"><div align="left">
                    <?
                    if ($modo == "expo") {
                        echo "CCNE";
                    } else {
                        echo "Proveedor";
                    }
                    ?>
                </div></th>
            <th width="10%" scope="col"><div align="left">Orden </div></th>
            <th width="17%" scope="col"><div align="left">Etapa actual </div></th>
        </tr>
        <?
        $ultReporte = null;
        $numReportes = 0;
        $reportetmp = "";
        foreach ($reportes as $reporte) {
            /* 	if( !$reporte->esUltimaVersion($modo) ){
              continue;
              } */
            if ($reportetmp == $reporte->getCaConsecutivo())
                continue;
            $reportetmp = $reporte->getCaConsecutivo();
            $numReportes++;
            $ultReporte = $reporte->getCaIdreporte();
            $class = $reporte->getColorStatus();
            ?>
            <tr class="<?= $class ?>" id="tr_<?= $reporte->getCaIdreporte() ?>" style="cursor:pointer">
                <td onclick="ocultarMostrarReporte('<?= $reporte->getCaIdreporte() ?>')">
                    <div align="left">
                        <?= $reporte->getCaFchreporte() ?>
                    </div></td>
                <td onclick="ocultarMostrarReporte('<?= $reporte->getCaIdreporte() ?>')"><div align="left">
                        <a name="sec_<?= $reporte->getCaConsecutivo() ?>">&nbsp;</a>
                        <?= $reporte->getCaConsecutivo() . " V" . $reporte->getCaVersion() ?>
                    </div></td>
                <td onclick="ocultarMostrarReporte('<?= $reporte->getCaIdreporte() ?>')"><div align="left">
                        <?= Utils::replace($reporte->getOrigen()->getCaCiudad()) ?>
                    </div></td>
                <td onclick="ocultarMostrarReporte('<?= $reporte->getCaIdreporte() ?>')"><div align="left">
                        <?= Utils::replace($reporte->getDestino()->getCaCiudad()) ?>
                    </div></td>
                <td onclick="ocultarMostrarReporte('<?= $reporte->getCaIdreporte() ?>')"><div align="left">
                        <?= $reporte->getCaModalidad() ?>
                    </div></td>
                <td onclick="ocultarMostrarReporte('<?= $reporte->getCaIdreporte() ?>')"><?
                    if ($modo == "expo") {
                        echo $reporte->getConsignatario();
                    } else {
                        echo $reporte->getProveedoresStr();
                    }
                    ?></td>
                <td onclick="ocultarMostrarReporte('<?= $reporte->getCaIdreporte() ?>')"><div align="left">
                        <?= $reporte->getCaOrdenClie() ?>
                    </div></td>
                <td onclick="ocultarMostrarReporte('<?= $reporte->getCaIdreporte() ?>')"><div align="left">
                        <?
                        $etapa = $reporte->getTrackingEtapa();
                        if ($etapa) {
                            echo $etapa->getCaEtapa();
                        }
                        ?>
                    </div></td>
                <td style="display:none" id="td_<?= $reporte->getCaIdreporte() ?>" class="hdrep">
                    <input id="checkbox_<?= $reporte->getCaIdreporte() ?>" type="checkbox" onchange="crearOpcion()" />               
                </td>
            </tr>
            <tr  style="display:none" id="infotr_<?= $reporte->getCaIdreporte() ?>" >
                <td colspan="8"  >
                    <div id="info_<?= $reporte->getCaIdreporte() ?>"></div>
                    <?
                    //include_component("traficos", "infoReporte", array( "reporte"=>$reporte, "nivel"=>$nivel ));
                    ?>
                </td>
            </tr>
            <?
        }
        ?>
    </table>
    <br />

    <div align="left">
        <table width="200" border="1" cellspacing="0" cellpadding="0" class="tableList">
            <tr>
                <th ><b>Convenciones</b></th>		
            </tr>
            <tr>		
                <td>Sin novedad</td>
            </tr>
            <tr class="green">		
                <td>Nuevo Status</td>
            </tr>
            <tr class="yellow">		
                <td >Pendiente por instrucciones</td>
            </tr>		
            <tr class="blue">		
                <td>Carga embarcada</td>
            </tr>		
            <tr class="orange">		
                <td>Carga entregada</td>
            </tr>
            <tr class="purple">		
                <td>Carga en transito terrestre</td>
            </tr>
            <tr class="pink">
                <td>Orden Anulada </td>
            </tr>
        </table>
    </div>

</div>
<iframe name="uploadFrame" id="uploadFrame" width="600" height="400" style="display:none"  ></iframe>

<?
if ($numReportes == 1) {
    $idreporte = $ultReporte;
}

if ($idreporte) {
    ?>
    <script language="javascript" type="text/javascript" >
        ocultarMostrarReporte(<?= $idreporte ?>);

    </script>
    <?
}
?>
