<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

if( $cotizacion ){
    
    include_component("cotizaciones","panelRecargosCotizacion",array("cotizacion"=>$cotizacion, "producto"=>$producto , "modo"=>"consulta"));
    ?>

    <script type="text/javascript">
    CotizacionRecargosWindow = function() {

        this.grid = new PanelRecargosCotizacion({

        });

        CotizacionRecargosWindow.superclass.constructor.call(this, {
            title: 'Seleccione las tarifas que desea importar',
            id: 'add-cotizacion-recargos-win',
            autoHeight: true,
            width: 800,
            height: 600,
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

    Ext.extend(CotizacionRecargosWindow, Ext.Window, {


        show : function(){
            if(this.rendered){
            }
            CotizacionRecargosWindow.superclass.show.apply(this, arguments);
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

            var gridRecargos = Ext.getCmp("panel-recargos");
            var recordRecargos = gridRecargos.record;
            var lastConcepto = null;
            var lastConceptoTxt = null;

            for( var i=0; i< lenght; i++){
                var existe = false;
                r = records[i];
                if( r.data.sel || tipo=="1" ){
                recordsConceptos = gridRecargos.store.getRange();
                for( var j=0; j< recordsConceptos.length&&!existe; j++){

                    if( recordsConceptos[j].data.iditem==r.data.idrecargo){
                        existe=true;
                    }
                }
                if( !existe ){
                    
                        var newRec = new recordRecargos({
                                       idreporte: '<?=$reporte->getCaIdreporte()?>',
                                       item: '+',
                                       iditem: '',
                                       idconcepto: '9999',
                                       tipo: 'recargo',
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
                        gridRecargos.store.addSorted(newRec);


                        newRec = gridRecargos.store.getById( newRec.id );


                        newRec.set("aplicacion", r.data.aplica_tar);
                        newRec.set("tipo", "recargo");
                        newRec.set("observaciones", r.data.detalles);

                        if(r.data.aplica_tar.indexOf('%',0)<0)
                            newRec.set("tipo_app", "$");
                        else
                            newRec.set("tipo_app", "%");                        
                        newRec.set("iditem", r.data.idrecargo);
                        newRec.set("item", r.data.recargo);
                        newRec.set("orden", "Y-"+r.data.recargo);
                        newRec.set("cobrar_tar", r.data.valor_tar);
                        newRec.set("cobrar_min", r.data.valor_min);
                        newRec.set("cobrar_idm", r.data.idmoneda);

                        gridRecargos.store.sort("orden", "ASC");
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