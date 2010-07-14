<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
include_component("widgets", "widgetConsignar");
include_component("widgets", "widgetTipoBodega");
include_component("widgets", "widgetBodega");
//echo $impoexpo.".".$modo;
?>
<script type="text/javascript">
    FormCorteGuiasPanel = function( config ){
        Ext.apply(this, config);
        this.wgTercero=new WidgetTercero({fieldLabel:"Consignatario",
                                            tipo: 'Consignatario',
                                            width: 600,
                                            hiddenName: "consig",
                                            id:"idconsignatario"
                                           });
        this.wgBodega=new WidgetBodega({fieldLabel:"",
                                            id: "bodega_consignar",
                                            hiddenName: "idbodega_hd",
                                            width: 600,
                                            linkTransporte: "transporte"
                                           })
                                           
        var camposHija = new Array();
        <?
        if($impoexpo=="Importación"  && $modo=="Marítimo")
        {
        ?>
            this.wgBodega.fieldLabel="Usuario";
            camposHija.push( this.wgBodega );
            camposHija.push( this.wgTercero );
        <?
        }
        else
        {
        ?>
            camposHija.push( this.wgTercero );
            camposHija.push( this.wgBodega );
        <?
        }
        ?>
        FormCorteGuiasPanel.superclass.constructor.call(this, {
            activeTab: 0,
            title: 'Corte Documentos',
            buttonAlign: 'center',
            autoHeight:true,
            deferredRender:false,
            defaults: {labelWidth: 120},
            items: [
                {
                    xtype:'fieldset',
                    title: '<?=$nomGuiasH?>',
                    autoHeight:true,
                    items: camposHija
                }
                <?
                if($impoexpo=="Importación"  && $modo!="Aéreo")
                {
                ?>
                ,
                {
                    xtype:'fieldset',
                    title: '<?=$nomGuiasM?>',
                    autoHeight:true,
                    items: [
                        new WidgetTercero({fieldLabel:"Consig. Master",
                                            tipo: 'Master',
                                            width: 600,
                                            id: "idconsigmaster",
                                            hiddenName: "consigmaster"
                                           })
                    ]
                }
                <?
                }
                ?>
            ]
        });
    };

    Ext.extend(FormCorteGuiasPanel, Ext.Panel, {
    });
</script>