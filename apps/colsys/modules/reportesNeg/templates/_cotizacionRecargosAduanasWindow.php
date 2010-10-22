<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
//print_r($cotizacion);

if( $cotizacion )
{
   include_component("cotizaciones", "panelTarifarioAduana",array("cotizacion"=>$cotizacion , "modo"=>"consulta"));
?>

    <script type="text/javascript">
    CotizacionRecargosAduanasWindow = function() {

        this.grid = new PanelTarifarioAduana({
            height: 400,
            boxMinHeight: 400
        });

        CotizacionRecargosAduanasWindow.superclass.constructor.call(this, {
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

    Ext.extend(CotizacionRecargosAduanasWindow, Ext.Window, {


        show : function(){
            if(this.rendered){               
            }

            CotizacionRecargosAduanasWindow.superclass.show.apply(this, arguments);
        },

        importar: function() {
            this.el.mask('Importando...', 'x-mask-loading');

            var store = this.grid.store;
            var records = store.getRange();

            var lenght = records.length;
            msg="";

            var gridRecargos = Ext.getCmp("panel-recargos-aduana");
            var recordRecargos = gridRecargos.record;
            var lastConcepto = null;
            var lastConceptoTxt = null;

            for( var i=0; i< lenght; i++){
                var existe = false;
                r = records[i];                
                if( r.data.sel ){                
                
                recordsConceptos = gridRecargos.store.getRange();                
                for( var j=0; j< recordsConceptos.length&&!existe; j++)
                {
                    if(recordsConceptos[j].data.iditem==r.data.idconcepto){
                        msg+=("Concepto:"+r.data.concepto+" - Parametro :"+r.data.parametro+"<br/> \n");
                        
                        existe=true;
                    }

                }                
                if( !existe ){
                    
                        var newRec = new recordRecargos({
                                       idreporte: '<?=$reporte->getCaIdreporte()?>',

                                        item: '+',
                                        iditem: '',
                                        parametro: '',
                                        tipo: 'costo',
                                        vlrcosto: '',
                                        aplicacion: '',
                                        mincosto: '',
                                        aplicacionminimo: '',                                        
                                        orden: 'Z'
                                    });
                        gridRecargos.store.addSorted(newRec);
                        newRec = gridRecargos.store.getById( newRec.id );
                        newRec.set("iditem", r.data.idconcepto);
                        newRec.set("idconcepto", r.data.idconcepto);
                        newRec.set("item", r.data.concepto);
                        newRec.set("tipo", "costo");

                        newRec.set("vlrcosto", r.data.valor);
                        newRec.set("aplicacion", r.data.aplicacion);
                        newRec.set("mincosto", r.data.valorminimo);
                        newRec.set("aplicacionminimo", r.data.aplicacionminimo);
                        newRec.set("orden", "Y-Z");

                        gridRecargos.store.sort("orden", "ASC");
                    }
                }

            }
             if(msg!="")
                        {
                          Ext.Msg.alert("Conceptos","No se ingresaron los siguientes conceptos porque ya se encuentran en el Reporte de negocios <br/>"+msg);
                        }
            

            this.el.unmask();
            this.hide();
        }   
    });

    </script>
<?
}
?>