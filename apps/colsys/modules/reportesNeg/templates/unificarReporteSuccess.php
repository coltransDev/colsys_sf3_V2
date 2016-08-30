<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>



<div class="content" align="center" >
    <h1>Unificaci&oacute;n de reporte <?=$reporte->getCaConsecutivo()?></h1>
    <br />
    <div class="box1" style="width: 450px">
        <?=image_tag("22x22/alert.gif")?> Es necesario que ambos reportes tengan los mismos puertos de origen y destino y la misma modalidad.
        <br />
        Se creara un enlace hacia este reporte y solo se podran acceder a las comunicaciones a traves de este reporte y se anulara el que usted digite.
    </div>
    <br />
    <br />
	<div id="panel"></div>
</div>

<script language="javascript" type="text/javascript">
Ext.onReady(function(){

	var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/datosComboReportes")?>'

        }),
        baseParams: {
            estado: "activo",
            impoexpo: "<?=$reporte->getCaImpoexpo()?>",
            transporte: "<?=$reporte->getCaTransporte()?>",
            origen: "<?=$reporte->getCaOrigen()?>",
            destino: "<?=$reporte->getCaDestino()?>",
            idcliente: "<?=$reporte->getCliente()->getCaIdcliente()?>"
        },
        reader: new Ext.data.JsonReader({
            root: 'reportes',
            totalProperty: 'totalCount'
        }, [
            {name: 'idreporte', mapping: 'ca_idreporte'},
            {name: 'consecutivo', mapping: 'ca_consecutivo'}

        ])
    });


    var comboReporte = new Ext.form.ComboBox({
        store: ds,
		 id: 'reporte',
        displayField:'consecutivo',
		valueField:'consecutivo',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 100,
        valueNotFoundText: 'No encontrado' ,
		minChars: 1,
        hideTrigger:false,		
        fieldLabel: "Reporte",
		allowBlank : false,
        //tpl: resultTpl,
        //applyTo: 'reporte',
        //itemSelector: 'div.search-item',
	    emptyText:'',
	    forceSelection:true,
		selectOnFocus:true

    });




	var mainPanel = new Ext.FormPanel({

        frame:true,
        title: 'Unificación de reportes',
        bodyStyle:'padding:5px 5px 0',
        width: 250,
        labelWidth: 80,
        
        defaultType: 'textfield',
		standardSubmit: true,
		items: [
			comboReporte
        ],
        buttons: [{
	            text: 'Continuar',
	            handler: function(){

	            	if( mainPanel.getForm().isValid() ){

						var queryStr = "";
						//alert(  mainPanel.getForm().findField("tipo").getValue() + " "+mainPanel.getForm().findField("tipo").getRawValue() );

						queryStr = "?reporte="+mainPanel.getForm().findField("reporte").getValue();


						document.location = '<?=url_for("reportesNeg/unificarReporte?id=".$reporte->getCaIdreporte())?>'+queryStr

					}else{
						Ext.MessageBox.alert('Error:', '¡Atención: La información está incompleta!');
					}
	            }
	        },
            {
	            text: 'Cancelar',
	            handler: function(){
    				document.location = '<?=url_for("reportesNeg/consultaReporte?id=".$reporte->getCaIdreporte())?>'
	            }
	        }
			]
    });

    mainPanel.render("panel");

});
</script>
