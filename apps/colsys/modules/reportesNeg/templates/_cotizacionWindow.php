<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

if( $cotizacion ){
    
    include_component("cotizaciones","panelProductos",array("cotizacion"=>$cotizacion, "producto"=>$producto , "modo"=>"consulta"));
    ?>

    <script type="text/javascript">
    CotizacionWindow = function(config) {
        Ext.apply(this, config);

/*        if(this.tipo=="OTM/DTA")
        {
            this.grid = new PanelProductos({tipo:'OTM/DTA'
            });
        }
    else*/
        {
         this.grid = new PanelProductos();
        }

        CotizacionWindow.superclass.constructor.call(this, {
            title: 'Seleccione las tarifas que desea importar',
            id: 'add-cotizacion-win',
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
            //if( $modo=="edicion" ){
            ?>
             {
                text: 'Importar',
                handler: this.importar,
                scope: this
             }
             ,
             <?
            //}
             ?>
             {
                text: 'Cancel',
                handler: this.hide.createDelegate(this, [])
            }],

            items: this.grid
        });

        this.addEvents({add:true});
    }

    Ext.extend(CotizacionWindow, Ext.Window, {


        show : function(){
            if(this.rendered){
                
            }

            CotizacionWindow.superclass.show.apply(this, arguments);
        },

        importar: function() {
            this.el.mask('Importando...', 'x-mask-loading');

            var store = this.grid.store;
            var records = store.getRange();

            var lenght = records.length;

            var str = "";

            var gridConceptos = Ext.getCmp("panel-conceptos-fletes");
            var recordConceptos = gridConceptos.record;
            var lastConcepto = null;
            var lastConceptoTxt = null;

            for( var i=0; i< lenght; i++){
                var existe = false;
                r = records[i];
                if( r.data.sel ){
                    //Verifica que no se haya incluido
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

                    if( !existe && (r.data.tipo=="concepto" || (r.data.tipo=="recargo" && lastConcepto==r.data.idconcepto))){//De esta manera se evita que se incluya un recargo sin su concepto

                        var newRec = new recordConceptos({

                                       idreporte: '<?=$reporte->getCaIdreporte()?>',
                                       item: r.data.item,
                                       iditem: r.data.iditem,
                                       idconcepto: r.data.idconcepto,
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

                        if( r.data.tipo=="recargo" ){
                            newRec.set("aplicacion", r.data.aplica_tar);
                            newRec.set("tipo_app", "$");                          

                            if( lastConcepto==9999){
                                newRec.set("orden", "Y"+"-"+r.data.item);
                            }else{
                                newRec.set("orden", lastConceptoTxt+"-"+r.data.item);                                
                                newRec.set("neta_tar", 0);
                                newRec.set("neta_min", 0);
                            }
                        }                        

                        if( r.data.tipo=="concepto" ){
                            //alert( r.data.item );
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
        },

        markInvalid : function(){
            this.feedUrl.markInvalid('The URL specified is not a valid RSS2 feed.');
            this.el.unmask();
        },

        validateFeed : function(response, options){
            var dq = Ext.DomQuery;
            var url = options.feedUrl;

            try{
                var xml = response.responseXML;
                var channel = xml.getElementsByTagName('channel')[0];
                if(channel){
                    var text = dq.selectValue('title', channel, url);
                    var description = dq.selectValue('description', channel, 'No description available.');
                    this.el.unmask();
                    this.hide();

                    return this.fireEvent('validfeed', {
                        url: url,
                        text: text,
                        description: description
                    });
                }
            }catch(e){
            }
            this.markInvalid();
        }
    });

    </script>
<?
}
?>