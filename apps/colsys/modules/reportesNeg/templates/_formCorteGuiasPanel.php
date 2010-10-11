<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
include_component("widgets", "widgetConsignar");
include_component("widgets", "widgetBodega",array("modo"=>$modo,"impoexpo"=>$impoexpo,"permiso"=>$permiso));
?>
<script type="text/javascript">
    FormCorteGuiasPanel = function( config ){
        Ext.apply(this, config);
        this.wgTercero=new WidgetTercero({fieldLabel:"Consignatario",
                                            tipo: 'Consignatario',
                                            width: 500,
                                            hiddenName: "consig",
                                            id:"idconsignatario"                                            
                                           });
        this.wgBodega=new WidgetBodega({fieldLabel:"Trasladar a",
                                            id: "bodega_consignar",
                                            hiddenName: "idbodega_hd",
                                            width: 500,
                                            linkTransporte: "transporte"
                                           })
		this.wgNotify=new WidgetTercero({fieldLabel:"Notificar a",
                                            tipo: 'Notify',
                                            width: 500,
                                            hiddenName: "idnotify",
                                            id:"notify"
                                           });
        var camposHija = new Array();
        <?
        if($impoexpo=="Importación"  && $modo=="Marítimo")
        {
        ?>
            this.wgBodega.fieldLabel="Usuario";
            camposHija.push( this.wgBodega );
            camposHija.push( this.wgTercero );            
            camposHija.push( this.wgNotify );
        <?
        }
		else if($impoexpo==Constantes::EXPO  && $modo==Constantes::AEREO)
		{
		?>
            camposHija.push( this.wgTercero );
            camposHija.push( this.wgNotify );
        <?
		}
        else
        {
        ?>
            camposHija.push( this.wgTercero );
            <?
            if($impoexpo!=Constantes::TRIANGULACION )
            ?>
            camposHija.push( this.wgBodega );
        <?
        }
        ?>

        var camposForm = new Array();
        obj = new Object();
        obj1 = null;

        obj.xtype='fieldset';
        obj.title='<?=$nomGuiasH?>';
        obj.autoHeight=true;
        obj.id='PCorteHija';
        obj.items=camposHija;
        

    <?
    if(($impoexpo==Constantes::IMPO  && $modo!=Constantes::AEREO) || ($impoexpo==Constantes::EXPO  && $modo==Constantes::AEREO) || ($impoexpo==Constantes::TRIANGULACION ))
    {
    ?>
        obj1 = new Object();
        obj1.xtype='fieldset';
        obj1.title='<?=$nomGuiasM?>';
        obj1.autoHeight=true;
        obj1.id='PCorteMaster';
        obj1.items=new Array();
        obj1.items.push(new WidgetTercero({fieldLabel:"Consig. Master",tipo: 'Master',width: 600, id: "idconsigmaster",hiddenName: "consigmaster"}));

        <?
        if(($impoexpo==Constantes::EXPO && $modo==Constantes::AEREO) || ($impoexpo==Constantes::TRIANGULACION ))
        {
        ?>
        obj1.items.push(new WidgetTercero({fieldLabel:"Notificar a",tipo: 'Notify',width: 600,hiddenName: "ca_informar_mast",id:"idnotify_mast"}));
        <?
        } 
    }

    if( $impoexpo==Constantes::EXPO || $impoexpo==Constantes::TRIANGULACION )
    {
    ?>
        if(obj1)
            camposForm.push(obj1);
    <?
    }
    ?>
    camposForm.push(obj);
 
        FormCorteGuiasPanel.superclass.constructor.call(this, {
            activeTab: 0,
            title: 'Corte Documentos',
            buttonAlign: 'center',
            autoHeight:true,
            deferredRender:false,
            defaults: {labelWidth: 120},
            items: camposForm
        });
    };

    Ext.extend(FormCorteGuiasPanel, Ext.Panel, {

    });
</script>