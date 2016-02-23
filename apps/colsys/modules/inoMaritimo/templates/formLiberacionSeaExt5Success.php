<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$referencia = $sf_data->getRaw("referencia");
$fieldset  = "";
$facturas = array();

foreach ($referencia->getInoClientesSea() as $inocliente){
    $idino = $inocliente->getCaIdinocliente();
    $alto  =  280;
    $fieldset .= "
        {
        xtype: 'fieldset',
        style: 'display:inline-block;text-align:center',
        title: '',
        hideLabel: true,
        width: 760,
        
        collapsible: false,
        defaults: {
            labelWidth: 89,
            anchor: '98%',
            layout: {
                type: 'column',
                defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
        }},
        
        items: [{
            xtype: 'fieldcontainer',
            hideLabel: true,
            combineErrors: true,
            height: 150,
            msgTarget: 'under',
            layout: 'column',
            defaults: {
                flex: 1,
                hideLabel: false
            },
            items: [{
                xtype: 'label',
                text: 'Id Cliente:',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 0.2
            }, {
                xtype: 'label',
                text: 'Nombre del Cliente:',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 0.6
            },";
    
            if ($inocliente->getCaFchliberacion() == ''){
    
                $fieldset .= "{
                    columnWidth: 0.2,
                    xtype: 'button',
                    iconCls: 'refresh',
                   // style:'background:none;color:red',
                    text: 'liberar',
                    handler: function() {";
                    $nombrecliente = "Cliente : ".$inocliente->getCliente()->getIds()->getCaNombre();
                    $fieldset .= " if (win_liberacion == null) {
                         win_liberacion = new Ext.Window({
                            title: 'Liberación',
                            width: 700,
                            height: 380,
                            closeAction: 'close',
                            items: {
                                xtype: formliberacion
                            },
                            listeners: {
                                afterrender: function (win, eOpts ){
                                    Ext.getCmp('lbl_nombre').setText('$nombrecliente');
                                    Ext.getCmp('lbl_idinocliente').setText('$idino');
                                },
                                close: function (win, eOpts ){
                                    win_liberacion = null;
                                }
                             }
                         })
                        }                               
                        win_liberacion.show();
                     }
                    }, ";
                }
                else{
                    $fieldset .= " {
                       columnWidth: 0.2,
                       xtype: 'button',
                       iconCls: 'refresh',
                       text: 'Revertir Liberación',
                       handler: function(){
                            Ext.Msg.show({
                            title:'Save Changes?',
                            msg: 'Desea Revertir la liberación?',
                            buttons: Ext.Msg.YESNOCANCEL,
                            icon: Ext.Msg.QUESTION,
                            fn: function(btn) {
                                if (btn === 'yes') {
                                    var ino = Ext.getCmp('lbl_idinocliente');
                                    Ext.Ajax.request({
                                    waitMsg: 'Guardando cambios...',
                                    url: '".url_for('inoMaritimo/revertirLiberarCarga')."',
                                    params: {
                                        idinocliente:".$inocliente->getCaIdinocliente().",
                                    },
                                    failure: function (response, options) {
                                    var res = Ext.util.JSON.decode(response.responseText);
                                    if (res.errorInfo)
                                        Ext.MessageBox.alert('Mensaje', 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                                    else
                                        Ext.MessageBox.alert('Mensaje', 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                                    },
                                    success: function (response, options) {
                                    var res = Ext.decode(response.responseText);
                                    ids = res.ids;
                                    if (res.success) {
                                        Ext.MessageBox.alert('Mensaje', 'Liberación Revertida Correctamente<br>');
                                        window.location.reload();
                                    }
                                }


                                   });
                                }   
                            }
                        });
                       }
                    },";
                }
                $fieldset .= "{
                xtype: 'label',
                text: '".$inocliente->getCliente()->getCaIdcliente()."',
                style: 'display:inline-block;text-align:left',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: '".$inocliente->getCliente()->getIds()->getCaNombre()."',
                style: 'display:inline-block;text-align:left',
                columnWidth: 0.8
            }, {
                xtype: 'tbspacer',
                height: 10,
                text: '',
                style: 'display:inline-block;text-align:left',
                columnWidth: 1
            },{
                xtype: 'label',
                text: 'Vendedor',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: 'HBL',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: 'No. piezas',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: 'Peso en kilos',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: 'Volumen CMB',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 0.2
            }, {
                xtype: 'label',
                text: '".$inocliente->getVendedor()."',
                style: 'display:inline-block;text-align:left',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: '".$inocliente->getCaHbls()."',
                style: 'display:inline-block;text-align:left',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: '".$inocliente->getCaNumpiezas()."',
                style: 'display:inline-block;text-align:left',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: '".$inocliente->getCaPeso()."',
                style: 'display:inline-block;text-align:left',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: '".$inocliente->getCaVolumen()."',
                style: 'display:inline-block;text-align:left',
                columnWidth: 0.2
            }, {
                xtype: 'tbspacer',
                height: 10,
                text: '',
                style: 'display:inline-block;text-align:left',
                columnWidth: 1
            }, {
                xtype: 'label',
                text: 'ID Reporte:',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: 'ID Proveedor:',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: 'Proveedor:',
               style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: 'Fecha Liberación:',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: 'Estado Liberación:',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: '".$inocliente->getReporte()->getCaConsecutivo()."',
                style: 'display:inline-block;text-align:left;',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: '".$inocliente->getCaIdproveedor()."',
                style: 'display:inline-block;text-align:left',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: '".$inocliente->getProveedor()."',
                style: 'display:inline-block;text-align:left',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: '".$inocliente->getCaFchliberado()."',
                style: 'display:inline-block;text-align:left',
                columnWidth: 0.2
            },{
                xtype: 'label',
                text: '".$inocliente->getCaEstadoliberacion()."',
                style: 'display:inline-block;text-align:left',
                columnWidth: 0.2
            }, {
                xtype: 'label',
                text: 'Nota Liberación:',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 1
            }, ";
            if ($inocliente->getCaNotaliberacion()){    
                $fieldset .= "{
                    xtype: 'label',
                    text: '".$inocliente->getCaNotaliberacion()."',
                    style: 'display:inline-block;text-align:left',
                    columnWidth: 1
                },";
            }
            else{
                $fieldset.= "{
                    xtype: 'tbspacer',
                    height: 20,
                    text: '',
                    style: 'display:inline-block;text-align:left',
                    columnWidth: 1
                },";    
            }
            $fieldset .= "{
                xtype: 'label',
                text: 'Detalle Liberación:',
                style: 'display:inline-block;text-align:left;font-weight:bold;background-color: #BDBDBD;',
                columnWidth: 1
            }, {
                xtype: 'textareafield',
                value: '".$inocliente->getCaDetalleliberacion()."',
                readOnly:true,
                columnWidth: 1
            }, {
                xtype: 'tbspacer',
                height: 20,
                text: '',
                style: 'display:inline-block;text-align:left',
                columnWidth: 1
            },";
            $acumulador = 0;
            
            foreach ($inocliente->getInoIngresosSea() as $factura){
                $alto += 90; 
                $valor = $factura->getCaValor();
                $reccaja = $factura->getCaReccaja();
                $fechapago = $factura->getCaFchpago();
                $fieldset.= ", {
                columnWidth: 1,
                xtype: 'fieldset',
                style: 'display:inline-block;text-align:center',
                title: 'Factura',
                width: 650,
                height: 70,
                collapsible: false,
                defaults: {
                    labelWidth: 89,
                    anchor: '90%',
                    layout: {
                        type: 'column',
                        defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                }},

                items: [{
                    xtype: 'fieldcontainer',
                    title: 'Factura',
                    combineErrors: true,
                    height: 135,
                    msgTarget: 'under',
                    layout: 'column',
                    defaults: {
                        flex: 1,
                        hideLabel: false
                    },
                    items: [{
                        xtype: 'label',
                        text: 'Factura Nro:',
                        style: 'display:inline-block;text-align:left;font-weight:bold;',
                        columnWidth: 0.18
                    }, {
                        xtype: 'label',
                        text: 'Valor factura:',
                        style: 'display:inline-block;text-align:left;font-weight:bold;',
                        columnWidth: 0.18
                    }, {
                        xtype: 'label',
                        text: 'fch. factura',
                        style: 'display:inline-block;text-align:left;font-weight:bold;',
                        columnWidth: 0.18
                    },{
                        xtype: 'label',
                        text: 'Tasa Cambio',
                        style: 'display:inline-block;text-align:left;font-weight:bold;',
                        columnWidth: 0.18
                    }, {
                        xtype: 'label',
                        text: 'Neto',
                        style: 'display:inline-block;text-align:left;font-weight:bold;',
                        columnWidth: 0.14
                    },{
                        xtype: 'label',
                        text: 'Rec. caja',
                        style: 'display:inline-block;text-align:left;font-weight:bold;',
                        columnWidth: 0.14
                    },{
                        xtype: 'label',
                        text: '".$factura->getCaFactura()."',
                        style: 'display:inline-block;text-align:left',
                        columnWidth: 0.18
                    }, {
                        xtype: 'label',
                        text: '".$valor."',
                        style: 'display:inline-block;text-align:left',
                        columnWidth: 0.18
                    }, {
                        xtype: 'label',
                        text: '".$factura->getCaFchfactura()."',
                        style: 'display:inline-block;text-align:left',
                        columnWidth: 0.18
                    },{
                        xtype: 'label',
                        text: '".$factura->getCaTcambio()."',
                        style: 'display:inline-block;text-align:left',
                        columnWidth: 0.18
                    }, {
                        xtype: 'label',
                        text: '".$factura->getCaNeto()."',
                        style: 'display:inline-block;text-align:left',
                        columnWidth: 0.14
                    },{
                        xtype: 'label',
                        text: '".$factura->getCaReccaja()."',
                        style: 'display:inline-block;text-align:left',
                        columnWidth: 0.14
                    }]
                }]";
            
            }
            
    $fieldset .= "
    }]
        }],height: ".$alto.",},";
}
?>

<table width="900" align="center">
    <td style="text-align: center">
        <div id="se-form"></div><br>
    </td>
</table>

<script type="text/javascript">
    var win_liberacion = null;

    Ext.onReady(function () {
     
    Ext.define('EstadoLiberacion', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-estadoliberacion',
        store: ['Sin Liberar', 'Retenida', 'Liberada']
    });
    
    Ext.define('NotaLiberacion', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-notaliberacion',
            store: ['Se libera sobre canje', 'Cartera al día', 'Viene carga ruteada','Liberación autorizada por Gerente Comercial',
                    'Liberación autorizada por Gerente Regional','Carga para nacionalizar en Colmas','Se libera para tránsito OTM',
                    'Acuerdo compromiso de pago','Instrucción dada por el Agente']
    });
 
 
     
 var formliberacion =  Ext.create('Ext.form.Panel', {
    id: 'formliberacion',
    bodyPadding: 5,
    width: 690,
    height: 340,
    layout: 'column',
    autoScroll: true,
    items: [{
        xtype: 'fieldset',
        title: 'Datos de Liberación',
        width: 645,
        height: 260,
        collapsible: false,
        defaults: {
            labelWidth: 89,
            anchor: '90%',
            layout: {
                type: 'column',
                defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
            }},
        items: [{
                xtype: 'fieldcontainer',
                hideLabel: true,
                combineErrors: true,
                height: 45,
                msgTarget: 'under',
                layout: 'column',
                defaults: {
                    flex: 2,
                    hideLabel: false
                },
                items: [{
                        id: 'lbl_nombre',
                        xtype: 'label',
                        style: 'display:inline-block;text-align:left;font-weight:bold;',
                        columnWidth: 1
                    }, {
                        id: 'lbl_idinocliente',
                        xtype: 'label',
                        style: 'display:inline-block;text-align:center;font-weight:bold;',
                        hidden: true 
                    }, {
                        xtype: 'tbspacer',
                        height: 10,
                        text: '',
                        style: 'display:inline-block;text-align:left',
                        columnWidth: 1
                    }, { 
                        columnWidth:1,
                        xtype: 'fieldset',
                        title: 'Datos de Liberación',
                        width: 290,
                        height: 200,
                        collapsible: false,
                        defaults: {
                            labelWidth: 89,
                            anchor: '98%',
                            layout: {
                                type: 'column',
                                defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                            }},
                        items: [{
                            xtype: 'fieldcontainer',
                            hideLabel: true,
                            combineErrors: true,
                            height: 45,
                            msgTarget: 'under',
                            layout: 'column',
                            defaults: {
                                flex: 2,
                                hideLabel: false
                            },
                            items: [{
                                xtype:'datefield',
                                columnWidth:0.5,
                                fieldLabel: 'Fecha Liberación',
                                alowBlank: false,
                                width: 120,
                                name: 'fch_liberacion',
                                id: 'fch_liberacion',
                                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                editor: new Ext.form.DateField({
                                    width: 90,
                                    format: 'Y-m-d',
                                    useStrict: undefined
                                })
                            }, {
                                xtype:'combo-estadoliberacion',
                                name: 'estado_liberacion',
                                id: 'estado_liberacion',
                                alowBlank: false,
                                fieldLabel: 'Estado Liberación',
                                style: 'display:inline-block;text-align:center;',
                                labelWidth: 105,
                                columnWidth: 0.48,
                            }, {
                                xtype: 'tbspacer',
                                height: 10,
                                text: '',
                                style: 'display:inline-block;text-align:left',
                                columnWidth: 1
                            }, {
                                xtype: 'combo-notaliberacion',
                                name: 'nota_liberacion',
                                id: 'nota_liberacion',
                                alowBlank: false,
                                fieldLabel: 'Nota Liberación',
                                columnWidth: 1,
                            }, {
                                xtype: 'tbspacer',
                                height: 10,
                                text: '',
                                style: 'display:inline-block;text-align:left',
                                columnWidth: 1
                            }, {
                                xtype: 'textareafield',
                                name: 'detalle_liberacion',
                                alowBlank: false,
                                id: 'detalle_liberacion',
                                fieldLabel: 'Detalles de Liberación',
                                columnWidth: 1
                            }]
                        }]
                    }]   
                }]
    }],
    listeners: {
       afterrender: function (win, eOpts ){
           var combo = Ext.getCmp("estado_liberacion").setValue('Sin Liberar');
       }
    },
    buttons : [{
        text: 'Guardar',
        handler: function (){
            var me = this;
            var form = me.up('form').getForm();
            if(form.isValid()){
            
                var ino = Ext.getCmp('lbl_idinocliente');
                var estado_liberacion = Ext.getCmp('estado_liberacion');
                var nota_liberacion = Ext.getCmp('nota_liberacion');
                var fch_liberacion = Ext.getCmp('fch_liberacion');
                var detalle_liberacion = Ext.getCmp('detalle_liberacion');

                    Ext.Ajax.request({
                    waitMsg: 'Guardando cambios...',
                    url: '<?= url_for('inoMaritimo/liberarCarga') ?>',
                    params: {
                        idinocliente: ino.text,
                        estado_liberacion: estado_liberacion.value,
                        nota_liberacion: nota_liberacion.value,
                        fch_liberacion: fch_liberacion.value,
                        detalle_liberacion: detalle_liberacion.value
                    },
                    failure: function (response, options) {
                        var res = Ext.util.JSON.decode(response.responseText);
                        if (res.errorInfo)
                            Ext.MessageBox.alert("Mensaje", 'Debe diligenciar completamente el formulario');
                        
                    },
                    success: function (response, options) {
                        var res = Ext.decode(response.responseText);
                        ids = res.ids;
                        if (res.success) {
                            Ext.MessageBox.alert("Mensaje", 'Liberación Ejecutada Correctamente<br>');
                            window.location.reload();
                        }
                        else{
                            Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>');
                        }
                    }
                });
            }
        }
    }]
    });
    

    Ext.create('Ext.form.Panel', {
        title: 'Sistema Administrador de Referencias Marítimas',
        bodyPadding: 5,
        width: 800,
        height: 650,
        layout: 'column',
        autoScroll: true,
        items: [
            <?= $fieldset?>     
    ],
    renderTo: Ext.get('se-form')
    });
});
</script>