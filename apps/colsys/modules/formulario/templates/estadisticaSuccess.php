<? include_component("formulario", "formMenuEstadisticas", array("idFormulario" => $idFormulario)); ?>

<div align="center" id="container" ></div>

<script language="javascript">

    var tabs = new Ext.FormPanel({
        labelWidth: 75,
        border: true,
        frame: true,
        width: 690,
        standardSubmit: true,
        id: 'formPanel',
        items: {
            xtype: 'tabpanel',
            activeTab: 0,
            defaults: {autoHeight: true, bodyStyle: 'padding:10px'},
            id: 'tab-panel',
            items: [
                new FormMenuEstadisticas()
            ]
        },
        buttons: [{
                text: 'Continuar',
                handler: function() {
                    var tp = Ext.getCmp("tab-panel");
                    var owner = Ext.getCmp("formPanel");

                    if (tp.getActiveTab().getId() == "estadisticas") {
                        owner.getForm().getEl().dom.action = '<?= url_for("formulario/reporteDetalladoExt4?id=" . base64_encode($idFormulario)) ?>';
                    }
                    owner.getForm().submit();
                }
            }]
    });
    tabs.render("container");
</script>