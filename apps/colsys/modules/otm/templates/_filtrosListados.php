<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$etapas = $sf_data->getRaw("etapas");

include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetTrackingEtapa");
include_component("widgets", "widgetReporte");

?>
<script language="javascript">
var tabs = new Ext.FormPanel({
	labelWidth: 75,
	border:true,
	frame:true,
    deferredRender:false,
	width: 900,
	standardSubmit: true,
        id: 'formPanel',
	items: {		
			title:'Etapas OTM',
			layout:'form',
			defaultType: 'textfield',
			id: 'estadisticas',
            labelWidth: 75,
			items: [
                {
                    xtype:'fieldset',
                    title: 'filtros',
                    autoHeight : true,
                    layout : 'column',
                    columns : 2,
                    defaults:{
                        columnWidth:0.5,
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px;'
                    },
                    items :
                    [
                        {
                            xtype:'hidden',
                            name:"opcion",
                            value:"buscar"
                        },
                        {
                            xtype:"hidden",
                            id: 'impoexpo',
                            name: 'impoexpo',
                            value:'<?= Constantes::IMPO ?>'
                        },
                        {
                            xtype:"hidden",
                            id: 'transporte',
                            name: 'transporte',
                            value:'<?= Constantes::MARITIMO ?>'
                        },
                        {
                            columnWidth:.5,
                            border:false,
                            items:
                            [
                                {
                                    xtype:'datefield',
                                    fieldLabel: 'Fecha inicial',
                                    name : 'fechaInicial',
                                    format: "Y-m-d",
                                    value: '<?=$fechaInicial?>'
                                },
                                new WidgetModalidad({fieldLabel: 'Modalidad',
                                            id: 'modalidad',
                                            name: "modalidad",
                                            linkTransporte: "transporte",
                                            linkImpoexpo: "impoexpo",
                                            value:"<?= $modalidad ?>"
                                        }),
                                new WidgetTrackingEtapas({fieldLabel: 'Etapa',
                                            id: 'etapa',
                                            name: "etapa",
                                            hiddenName: "idetapa",
                                            departamento: "<?=constantes::OTMDTA1?>",                                            
                                            value:"<?= $etapa ?>",
                                            hiddenValue:"<?= $idetapa ?>"
                                        }),
                                        {
                                            xtype:'textfield',
                                            fieldLabel: 'Referencia',
                                            name : 'noreferencia',
                                            id : 'noreferencia',
                                            value: '<?=$noreferencia?>'
                                        }
                            ]
                        },
                        {
                            columnWidth:.5,
                            border:false,
                            items:
                            [
                                {
                                    xtype:'datefield',
                                    fieldLabel: 'Fecha final',
                                    name : 'fechaFinal',
                                    format: "Y-m-d",
                                    value: '<?=$fechaFinal?>'
                                },
                                new WidgetCiudad({fieldLabel: 'Origen',
                                            id: 'origen',
                                            idciudad:"origen",
                                            hiddenName:"idorigen",
                                            tipo:"2",                                            
                                            impoexpo: "impoexpo",
                                            value:"<?= $origen ?>",
                                            hiddenValue:"<?= $idorigen ?>"
                                        }),
                                        {
                                            xtype:'textfield',
                                            fieldLabel: 'No reporte',
                                            name : 'noreporte',
                                            id : 'noreporte',
                                            value: '<?=$noreporte?>'
                                        }
                                  /*new WidgetReporte({
                                              fieldLabel: "Reporte",
                                              name: "No Reporte",
                                              hiddenName: "idreporte",
                                              hiddenId: "idreporte",                                              
                                              tipo:1,
                                              impoexpo: this.impoexpo,
                                              transporte: this.transporte
                                              })
                                 */
                                        
                            ]
                        }
                    ]
		}]
	},
	buttons: [
            {
		text: 'Continuar',
		handler: function(){
                    var owner=Ext.getCmp("formPanel");                    
                    owner.getForm().getEl().dom.action='<?=url_for("otm/listaAprobacion")?>';
                    owner.getForm().submit();
            }
	}]
});
tabs.render("container");
</script>