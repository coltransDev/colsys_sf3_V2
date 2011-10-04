<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
?>
<script type="text/javascript">
    FormCheckListOtmPanel = function( config ){
        Ext.apply(this, config);
        FormCheckListOtmPanel.superclass.constructor.call(this, {
			items:[
                {
					xtype:'fieldset',
                    title:'Lista de chequeo',
                    autoHeight:true,
                    id:'Pchequeo',
                    items:[                                               
                       {
                            xtype:"checkbox",
                            fieldLabel:"HBL",
                            id:"cb_hbl",
							name:"cb_hbl"                            
                        },
                        {
                            xtype:"checkbox",
                            fieldLabel:"Factura",
                            id:"factura",
							name:"factura"                            
                        },
                        {
                            xtype:"checkbox",
                            fieldLabel:"Lista de Empaque",
                            id:"cb_empaque",
							name:"cb_empaque"                            
                        },
                        {
                            xtype:"checkbox",
                            fieldLabel:"Poliza de Seguros",
                            id:"cb_seguro",
							name:"cb_seguro"                            
                        },
                        {
                            xtype:"checkbox",
                            fieldLabel:"Invima",
                            id:"cb_invima",
							name:"cb_invima"                            
                        }
                    ]
				}
			]
        });
    };

    Ext.extend(FormCheckListOtmPanel, Ext.Panel, {

    });
</script>



<!--    <div id="emailForm" align="center">     
        <form name="form1" id="form1" method="post" action="<?=url_for("reportesNeg/enviarEmailInstrucciones?idreporte=".$reporte->getCaIdreporte())?>" onsubmit="return loadhtml()" >
            <input type="hidden" name="checkObservaciones" id="checkObservaciones" value="" />
            
            <table class="tableList alignCenter" width="80%" >
                <tr>
                    <td>Hbl</td><td><input type="check" name="hbl" /></td>
                </tr>
                <tr>
                    <td>Factura</td><td><input type="check" name="factura" /></td>
                </tr>
                <tr>
                    <td>Lista de Empaque</td><td><input type="check" name="empaque" /></td>
                </tr>
                <tr>
                    <td>Poliza de Seguro</td><td><input type="check" name="seguro" /></td>
                </tr>
                <tr>
                    <td>Invima</td><td><input type="check" name="invima" /></td>
                </tr>
            </table>

        <input type="submit" value="Enviar" class="button" />
        <br />
        <br />
        </form>
    </div>

-->