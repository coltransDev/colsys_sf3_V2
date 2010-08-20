<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component('widgets', 'widgetCliente');
include_component('widgets', 'widgetSucursales');
?>

<div class="content" align="center">

    <table align="center" width="500">
        <tr>
            <td><div id="panel" ></div></td>
        </tr>
    </table>
</div>
<script language="javascript" type="text/javascript">
	Ext.onReady(function(){

        var comboClientes = new WidgetCliente(
            {
                fieldLabel:'Cliente',
                hiddenName: 'idcliente',
                width: 330
               
            }
        );

        var comboSucursales = new WidgetSucursales(
            {
                fieldLabel:'Sucursal',
                hiddenName: 'idsucursal',
                width: 150
                      

            }
        );



        var mainPanel = new Ext.FormPanel({

            frame:true,
            title: 'Modulo de Liberaciones',
            bodyStyle:'padding:5px 5px 0',
            width: 500,
            defaultType: 'textfield',
            standardSubmit: true,
            url: "<?=url_for("clientes/reporteLiberaciones")?>",
            


            items: [
                
                comboClientes,
                comboSucursales,
                {
                    width: 150,
                    xtype:'datefield',
                    id: 'fchStart',
                    name: 'fchStart',
                    fieldLabel: 'Fecha Inicial',
                    value: '<?=date("Y-m-d")?>'

                },
                {
                    width: 150,
                    xtype:'datefield',
                    id: 'fchEnd',
                    name: 'fchEnd',
                    fieldLabel: 'Fecha final',
                    //value: '<?=date('Y-m-d')?>'

                }
                
            ],

           buttons: [{
                    text: 'Continuar',
                    handler: function(){

                        if( mainPanel.getForm().isValid() ){
                            mainPanel.getForm().submit();
                        }else{
                            Ext.MessageBox.alert('Error:', '¡Atención: La información está incompleta!');
                        }
                    }
                }
                ]
        });

        mainPanel.render("panel");
});
</script>
