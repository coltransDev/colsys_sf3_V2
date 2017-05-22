<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>


<div class="content" align="center">

    <h1>Sistema Administrador de Referencias</h1>
    <br />
    <form action="<?=url_for("inoF/formClientes?modo=".$modo)?>" method="post">
        <?
        
        if( $inoCliente ){
            $form->setDefault('ca_idreporte', $inoCliente->getCaIdreporte() );
        }
        echo $form['ca_idreporte']->render();

        
        if( $inoCliente ){
            $form->setDefault('ca_idinocliente', $inoCliente->getCaIdreporte() );
        }
        echo $form['ca_idinocliente']->render();

        if( $referencia->getCaIdmaestra() ){
        ?>
        <input type="hidden" name="id" value="<?=$referencia->getCaIdmaestra()?>">
        <?
        }

        if( $inoCliente && $inoCliente->getCaIdinocliente() ){
        ?>
        <input type="hidden" name="idinocliente" value="<?=$inoCliente->getCaIdinocliente()?>">
        <?
        }

        ?>
        <table class="tableList" width="80%">
            <tr>
                <th colspan="6">Datos para la referencia</th>
            </tr>
            <?
            if( $form->renderGlobalErrors() ){
            ?>
            <tr>
                <td colspan="6">
                 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
            </tr>
            <?
            }
            ?>
            <tr>
                <td width="17%"><b>Reporte</b></td>
                <td width="17%">
                    
                    <input type="text" id="combo-reporte" />
                   

                </td>
                <td width="16%"><b>Vendedor</b></td>
                <td width="16%">
                    <?
                    echo $form['ca_vendedor']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_vendedor', $inoCliente->getCaVendedor() );
                    }
                    echo $form['ca_vendedor']->render();
                    ?>
                </td>
                <td width="17%"><b>&nbsp;</b></td>
                <td width="17%">&nbsp;</td>
            </tr>
            <tr class="row0">
                <td colspan="6"><b>Datos del cliente</b></td>
            </tr>
            
             <tr>
                <td><b>Cliente</b></td>
                <td colspan="3">
                    <?
                    echo $form['ca_idcliente']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_idcliente', $inoCliente->getCaIdcliente() );
                    }
                    echo $form['ca_idcliente']->render();
                    ?>                    
                </td>
                <td><b>&nbsp;</b></td>
                <td>&nbsp;</td>
                        
            </tr>
            <tr>
                <td><b>Orden del Cliente</b></td>
                <td>
                    <?
                    echo $form['ca_numorden']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_numorden', $inoCliente->getCaNumorden() );
                    }
                    echo $form['ca_numorden']->render();
                    ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><b>&nbsp;</b></td>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td><b>Proveedor</b></td>
                <td>
                    <?
                    echo $form['ca_idproveedor']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_idproveedor', $inoCliente->getCaIdproveedor() );
                    }
                    echo $form['ca_idproveedor']->render();
                    ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><b>&nbsp;</b></td>
                <td>&nbsp;</td>
            </tr>

            <tr class="row0">
                <td colspan="6"><b>Datos de la carga</b></td>
            </tr>
            <tr>
                <td><b>Doc. transporte</b></td>
                <td>
                    <?
                    echo $form['ca_doctransporte']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_doctransporte', $inoCliente->getCaDoctransporte() );
                    }
                    echo $form['ca_doctransporte']->render();
                    ?>
                </td>
                <td><b>Fecha Doc. transporte</b></td>
                <td>
                    <?
                    echo $form['ca_fchdoctransporte']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_fchdoctransporte', Utils::parseDate($inoCliente->getCaFchdoctransporte(), "Y-m-d") );
                    }
                    echo $form['ca_fchdoctransporte']->render();
                    ?>
                </td>
                <td><b>&nbsp;</b></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><b>Piezas</b></td>
                <td>
                    <?
                    echo $form['ca_numpiezas']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_numpiezas', $inoCliente->getCaNumpiezas() );
                    }
                    echo $form['ca_numpiezas']->render();
                    ?>
                </td>
                <td><b>Peso</b></td>
                <td>
                    <?
                    echo $form['ca_peso']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_peso', $inoCliente->getCaPeso() );
                    }
                    echo $form['ca_peso']->render();
                    ?>
                </td>
                 <td><b>Volumen</b></td>
                <td>
                    <?
                    echo $form['ca_volumen']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_volumen', $inoCliente->getCaVolumen() );
                    }
                    echo $form['ca_volumen']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div align="center">
                        <input type="submit" value="Guardar" class="button" />

                        <?

                        $url = "inoF/verReferencia?id=".$referencia->getCaIdmaestra()."&modo=".$modo;

                        ?>
                        <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for($url)?>'" />
                    </div>
                </td>
            </tr>
        </table>
    </form>




</div>
<?
$modalidad = $referencia->getModalidad();
?>
<script type="text/javascript">



    Ext.onReady(function(){

        var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for(utf8_encode("widgets/datosComboReportes?extended=true&impoexpo=".$modalidad->getCaImpoexpo()."&transporte=".$modalidad->getCaTransporte()))?>'

        }),
        reader: new Ext.data.JsonReader({
            root: 'reportes',
            totalProperty: 'totalCount'
        }, [
            {name: 'idreporte', mapping: 'ca_idreporte'},
            {name: 'consecutivo', mapping: 'ca_consecutivo'},
            {name: 'piezas', mapping: 'ca_piezas'},
            {name: 'peso', mapping: 'ca_peso'},
            {name: 'volumen', mapping: 'ca_volumen'},
            {name: 'doctransporte', mapping: 'ca_doctransporte'},
            {name: 'idnave', mapping: 'ca_idnave'},
            {name: 'orden_clie', mapping: 'ca_orden_clie'},
            {name: 'login', mapping: 'ca_login'}

        ])
    });


    var comboReporte = new Ext.form.ComboBox({
        store: ds,
		id: 'reporte',
        displayField:'consecutivo',
		valueField:'consecutivo',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 160,        
		minChars: 1,
        hideTrigger:false,
		hideLabel: true	,
		allowBlank : false,
        value : '<?=isset($reporte)&&$reporte?$reporte->getCaConsecutivo():""?>',
        //tpl: resultTpl,
        applyTo: 'combo-reporte',
        //itemSelector: 'div.search-item',
	    emptyText:'',
	    forceSelection:true,
		selectOnFocus:true

    });


		Ext.getCmp("reporte").addListener("select", function(combo, record, index){ // override default onSelect to do redirect

            document.getElementById("ino_cliente_ca_idreporte").value=record.data.idreporte;
            document.getElementById("ino_cliente_ca_vendedor").value=record.data.login;
            document.getElementById("ino_cliente_ca_numorden").value=record.data.orden_clie;
            document.getElementById("ino_cliente_ca_numpiezas").value=record.data.piezas;
            document.getElementById("ino_cliente_ca_peso").value=record.data.peso;
            document.getElementById("ino_cliente_ca_volumen").value=record.data.volumen;
            document.getElementById("ino_cliente_ca_doctransporte").value=record.data.doctransporte;
            //document.getElementById("ino_cliente_ca_proveedor").value=record.data.proveedor;

          
		});
	});
</script>