<?
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetLinea");

$linea = $sf_data->getRaw("linea");
$resul = $sf_data->getRaw("resul");
?>

<div align="center" >
    <br />
    <h3> Informe de Comportamiento Recargos Locales </h3>
    <br />
</div>
<div align="center" id="container"></div>
<script language="javascript">
    var tabs = new Ext.FormPanel({
        labelWidth: 75,
        border: true,
        fame: true,
        deferredRender: false,
        width: 900,
        standardSubmit: true,
        buttonAlign: 'center',
        id: 'formPanel',
        items: {
            xtype: 'tabpanel',
            activeTab: 0,
            defaults: {autoHeight: true, bodyStyle: 'padding:10px'},
            id: 'tab-panel',
            items: [{
                    title: 'Recargos Locales',
                    layout: 'form',
                    defaultType: 'textfield',
                    id: 'reporteRecargosLocales',
                    labelWidth: 100,
                    items: [
                        {
                            xtype: 'fieldset',
                            title: 'filtros',
                            autoHeight: true,
                            layout: 'column',
                            defaults: {
                                columnWidth: 0.5,
                                layout: 'form',
                                border: false,
                                bodyStyle: 'padding:4px;'
                            },
                            items:
                                    [
                                        {
                                            xtype: 'hidden',
                                            name: "opcion",
                                            value: "buscar"
                                        },
                                        {
                                            xtype: "hidden",
                                            id: 'impoexpo',
                                            name: 'impoexpo',
                                            value: '<?= Constantes::IMPO ?>'
                                        },
                                        {
                                            xtype: "hidden",
                                            id: 'transporte',
                                            name: 'transporte',
                                            value: '<?= Constantes::MARITIMO ?>'
                                        },
                                        {
                                            items:
                                                    [
                                                        {
                                                            xtype: 'datefield',
                                                            fieldLabel: 'Fecha Inicial',
                                                            name: 'fechaInicial',
                                                            format: 'Y-m-d',
                                                            value: '<?= $fechaInicial ?>'
                                                        }
                                                    ]
                                        },
                                        {
                                            items:
                                                    [
                                                        {
                                                            xtype: 'datefield',
                                                            fieldLabel: 'Fecha final',
                                                            name: 'fechaFinal',
                                                            format: 'Y-m-d',
                                                            value: '<?= $fechaFinal ?>'
                                                        }
                                                    ]
                                        },
                                        {
                                            items:
                                                    [
                                                        new WidgetModalidad({fieldLabel: 'Modalidad',
                                                            id: 'modalidad',
                                                            hiddenName: "idmodalidad",
                                                            linkTransporte: "transporte",
                                                            linkImpoexpo: "impoexpo",
                                                            value: "<?= $idmodalidad ?>"
                                                        })
                                                    ]
                                        },
                                        {
                                            items:
                                                    [
                                                        new WidgetLinea({fieldLabel: 'Naviera',
                                                            linkTransporte: "transporte",
                                                            name: "linea",
                                                            id: "linea",
                                                            hiddenName: "idlinea",
                                                            value: "<?= $idlinea ?>"
                                                        })
                                                    ]
                                        },
                                        {
                                            items:
                                                    [
                                                        new WidgetPais({title: 'Pais origen',
                                                            fieldLabel: 'Pais origen',
                                                            id: 'pais_origen',
                                                            name: 'pais_origen',
                                                            hiddenName: "idpais_origen",
                                                            pais: "<?= $pais_origen ?>",
                                                            value: "<?= $idpais_origen ?>",
                                                            pais:"todos"
                                                        })
                                                    ]
                                        },
                                        {
                                            items:
                                                    [
                                                        new WidgetCiudad({fieldLabel: 'Puerto Destino',
                                                            id: 'destino',
                                                            idciudad: "destino",
                                                            hiddenName: "iddestino",
                                                            tipo: "2",
                                                            impoexpo: "impoexpo",
                                                            value: "<?= $destino ?>",
                                                            hiddenValue: "<?= $iddestino ?>"
                                                        })
                                                    ]
                                        }
                                    ]
                        }
                    ]
                }]
        },
        buttons: [
            {
                text: 'Continuar',
                handler: function() {
                    var tp = Ext.getCmp("tab-panel");
                    var owner = Ext.getCmp("formPanel");
                    if (tp.getActiveTab().getId() == "reporteRecargosLocales") {
                        owner.getForm().getEl().dom.action = '<?= url_for("reportesGer/reporteMonitoreoRecargos") ?>';
                    }
                    owner.getForm().submit();
                }
            }],
        listeners: {afterrender: function() {
                linea_sel = '<?= $linea ?>';
                idlinea_sel = '<?= $idlinea ?>';
                if (linea_sel != "")
                {
                    Ext.getCmp("linea").setValue(idlinea_sel);
                    $("#linea").val(linea_sel);
                }
            }
        }
    });
    tabs.render("container");
</script>
<?
if ($opcion) {
    ?>

    <div align="center">
        <br>
        <h3>Reporte Comportamiento de Recargos Locales<br>
            <?
            if ($fechaInicial && $fechaFinal) {
                echo " Fechas de Creacion referencia: " . $fechaInicial . " - " . $fechaFinal;
            }
            if ($idmodalidad) {
                echo " - Modalidad: " . $idmodalidad;
            }
            if ($origen) {
                echo " - Origen: " . $origen;
            }
            ?>
        </h3>
        <br />
        <br />
    </div>
    <table class="tableList" width="1150px" border="1" id="mainTable" align="center">
        <tr>
            <th>No</th>
            <th>A&ntilde;o</th>
            <th>Mes</th>
            <th>Referencia</th>
            <th>Origen</th>
            <th>Puerto</th>
            <th>Destino</th>
            <th>Total CBM</th>
            <th>Costo</th>
            <th>Factura</th>
            <th>Fecha Fac.</th>
            <th>Proveedor</th>
            <th>Neto</th>
            <th>Valor</th>
            <th>Total Recargos</th>
            <th>Recargos / CBM  </th>
        </tr>
        <?
        $nitem = 1;
        $num_ref = null;
        $imp_mem = true;
        $tot_rec = 0;
        foreach ($resul as $r) {
            if ( !is_null($num_ref) ){
                if ( $num_ref != $r["ca_referencia"] ){
                    ?>
                        <td align="right" style="font-weight: bold;"><?= number_format($tot_rec) ?></td>
                        <td align="right" style="font-weight: bold;"><?= number_format(round($tot_rec / $cmb_ref,0)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="16"></td>
                    <?
                    $num_ref = $r["ca_referencia"];
                    $cmb_ref = $r["ca_volumen"];
                    $tot_rec = 0;
                    $imp_mem = true;
                }else {
                    ?><td colspan="2">&nbsp;</td><?
                    $imp_mem = false;
                }
                ?></tr><?
            }else{
                $num_ref = $r["ca_referencia"];
                $cmb_ref = $r["ca_volumen"];
            }
            ?>
            <tr>
                <td><?= $nitem++ ?></td>
                <?
                if ($imp_mem){
                ?>
                    <td><?= $r["ca_ano"] ?></td>
                    <td><?= $r["ca_mes"] ?></td>
                    <td><a href="/colsys_php/inosea.php?boton=Consultar&id=<?= $r["ca_referencia"] ?>" target="_blank"><?= $r["ca_referencia"] ?></td>
                    <td><?= $r["ca_traorigen"] ?></td>
                    <td><?= $r["ca_ciuorigen"] ?></td>
                    <td><?= $r["ca_ciudestino"] ?></td>                
                    <td align="right"><?= $r["ca_volumen"] ?></td>
                <?
                }else{
                ?>
                    <td colspan="7"></td>
                <?
                }
                ?>
                <td><?= $r["ca_costo"] ?></td>
                <td><?= $r["ca_factura"] ?></td>
                <td><?= $r["ca_fchfactura"] ?></td>
                <td><?= $r["ca_proveedor"] ?></td>
                <td align="right"><?= $r["ca_idmoneda"]."&nbsp;".number_format($r["ca_neto"]) ?></td>
                <td align="right"><?= number_format($r["ca_total_costo"]) ?></td>
            <?
            $tot_rec+= $r["ca_total_costo"];
        }
        ?>
            <td align="right" style="font-weight: bold;"><?= number_format($tot_rec) ?></td>
            <td align="right" style="font-weight: bold;"><?= number_format(round($tot_rec / $r["ca_volumen"],0)) ?></td>
        </tr>
    </table>
    <?
}
?>