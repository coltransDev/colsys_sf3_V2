<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

if( $cotizacionotm ){
    
    include_component("cotizaciones","panelProductosotm",array("cotizacion"=>$cotizacionotm, "producto"=>$productootm , "modo"=>"consulta"));
    ?>

    <script type="text/javascript">
    CotizacionOtmWindow = function(config) {
        Ext.apply(this, config);

        this.grid = new PanelProductosOtm({tipo:'OTM/DTA'});

        CotizacionOtmWindow.superclass.constructor.call(this, {
            title: 'Seleccione las tarifas que desea importar',
            id: 'add-cotizacionotm-win',
            autoHeight: true,
            width: 800,            
            resizable: true,
            plain:true,
            modal: true,
            y: 100,
            autoScroll: true,
            closeAction: 'hide',

            buttons:[
            <?
            
            ?>
             {
                text: 'Importar',
                handler: this.importar,
                scope: this
             }
             ,
             {
                text: 'Importar Todo',
                handler: this.importarAll,
                scope: this
             },
             <?
            
             ?>
             {
                text: 'Cancel',
                handler: this.hide.createDelegate(this, [])
            }],

            items: this.grid
        });
        this.addEvents({add:true});
    }

    Ext.extend(CotizacionOtmWindow, Ext.Window, {
        show : function(){
            if(this.rendered){
                
            }
            CotizacionOtmWindow.superclass.show.apply(this, arguments);
        },
        importarAll: function() {
            this.importar("1");
        }
        ,
        importar: function(tipo) {
            if(tipo!="1")
                tipo="0";
            this.el.mask('Importando...', 'x-mask-loading');

            var store = this.grid.store;
            var records = store.getRange();
            var lenght = records.length;
            var str = "";

            var gridConceptos = Ext.getCmp("panel-recargos-otm");
            var recordConceptos = gridConceptos.record;
            var lastConcepto = null;
            var lastConceptoTxt = null;

            for( var i=0; i< lenght; i++){
                var existe = false;
                r = records[i];
                if( r.data.sel || tipo=="1" ){                    
                    recordsConceptos = gridConceptos.store.getRange();                    
                    for( var j=0; j< recordsConceptos.length&&!existe; j++){
                        if( r.data.tipo=="concepto" ){                            
                            if( recordsConceptos[j].data.iditem==r.data.iditem){
                                existe=true;                            
                            }
                        }
                        if( r.data.tipo=="recargo" ){
                            if( recordsConceptos[j].data.iditem==r.data.iditem&& recordsConceptos[j].data.idconcepto==r.data.idconcepto){
                                existe=true;
                            }
                        }
                    }
                    if( r.data.tipo=="concepto" ){
                        lastConcepto = r.data.iditem;
                        lastConceptoTxt = r.data.item;
                    }
                    else
                        continue;
                    
                    if( !existe && (r.data.tipo=="concepto" || (r.data.tipo=="recargo" && lastConcepto==r.data.idconcepto))){
                        var newRec = new recordConceptos({
                                       idreporte: '<?=$reporte->getCaIdreporte()?>',
                                       item: r.data.item,
                                       iditem: r.data.iditem,
                                       idconcepto: r.data.iditem,
                                       tipo: r.data.tipo,
                                       cantidad: '',
                                       neta_tar: '',
                                       neta_min: '',
                                       neta_idm: '',
                                       reportar_tar: '',
                                       reportar_min: '',
                                       reportar_idm: '',
                                       cobrar_tar: '',
                                       cobrar_min: '',
                                       cobrar_idm: '',
                                       aplicacion: '',
                                       tipo_app: '',
                                       detalles: '',
                                       orden: ''
                                    });
                        gridConceptos.store.addSorted(newRec);

                        newRec = gridConceptos.store.getById( newRec.id );                        
                        newRec.set("neta_idm", r.data.idmoneda);
                        newRec.set("reportar_tar", /*r.data.valor_tar*/0);
                        newRec.set("reportar_min", r.data.valor_min);
                        newRec.set("reportar_idm", r.data.idmoneda);
                        newRec.set("cobrar_tar", r.data.valor_tar);
                        newRec.set("cobrar_min", r.data.valor_min);
                        newRec.set("cobrar_idm", r.data.idmoneda);
                        newRec.set("observaciones", r.data.detalles);
                        newRec.set("equipo", r.data.equipo);
                        newRec.set("idequipo", r.data.idequipo);
                        newRec.set("tipo_app", "$");
                        newRec.set("aplicacion", r.data.aplica_tar);
                        
                        if( r.data.tipo=="recargo" ){
                            newRec.set("aplicacion", r.data.aplica_tar);
                            newRec.set("tipo_app", "$");

                            if( lastConcepto==9999){
                                newRec.set("orden", "Y"+"-"+r.data.item);
                                newRec.set("neta_tar", 0);
                                newRec.set("neta_min", 0);
                            }else{
                                newRec.set("neta_tar", 0);
                                newRec.set("neta_min", 0);
                                newRec.set("orden", lastConceptoTxt+"-"+r.data.item);
                            }
                        }

                        if( r.data.tipo=="concepto" ){
                            if( r.data.iditem==9999){
                                newRec.set("orden", "Y");
                            }else{
                                newRec.set("orden", r.data.item);
                                newRec.set("cantidad", 0);
                                newRec.set("neta_tar", 0);
                                newRec.set("neta_min", 0);
                            }
                        }
                        gridConceptos.store.sort("orden", "ASC");
                    }
                }
            }
            this.el.unmask();
            this.hide();
        }
    });
    </script>
<?
}
?>