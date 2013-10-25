<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">
    PanelCostosAduanaWindow = function() {

        this.grid = new PanelCostosAduanaRecargos({

        });

        PanelCostosAduanaWindow.superclass.constructor.call(this, {
            title: 'Seleccione las columnas que desea ver',
            //id: 'costos-aduana-win',
            autoHeight: true,
            width: 800,
            //height: 600,
            resizable: true,
            plain:true,
            modal: true,
            y: 100,
            autoScroll: true,
            closeAction: 'hide',

            buttons:[
            
             {
                text: 'Actualizar',
                handler: this.actualizar,
                scope: this
             }
             /*,
             
             {
                text: 'Cancel',
                handler: this.hide.createDelegate(this, [])
            }*/],

            items: this.grid
            
        });

        this.addEvents({add:true});
    }

    Ext.extend(PanelCostosAduanaWindow, Ext.Window, {


        show : function(){
            if(this.rendered){
                var store = this.grid.store;
                var records = store.getRange();

                var lenght = records.length;



                var grid = Ext.getCmp("panel-costos-aduana");
                var colModel = grid.getColumnModel();
                for( i=0; i<lenght; i++){


                    r = records[i];
                    idx1 = colModel.getIndexById( "recargo_"+r.data.idconcepto+"_col1" );

                    if( !colModel.isHidden(idx1) ){

                        rec = store.getById(r.id);
                        rec.set("sel", true);
                        //alert(r.data.concepto);
                        //r.set('sel', true);
                        //alert(r.get("sel"));

                    }
                }
            }

            PanelCostosAduanaWindow.superclass.show.apply(this, arguments);
        },


        
        actualizar: function() {
            this.el.mask('Actualizando...', 'x-mask-loading');

            
            var store = this.grid.store;
            var records = store.getRange();

            var lenght = records.length;
            

            var grid = Ext.getCmp("panel-costos-aduana");
            var colModel = grid.getColumnModel();
            for( var i=0; i< lenght; i++){
                r = records[i];
                idx1 = colModel.getIndexById( "recargo_"+r.data.idconcepto+"_col1" );
                idx2 = colModel.getIndexById( "recargo_"+r.data.idconcepto+"_col2" );
                
                if( r.data.sel ){
                    if(colModel.isHidden(idx1)){
                        colModel.setHidden(idx1, false);
                    }
                    if(colModel.isHidden(idx2)){
                        colModel.setHidden(idx2, false);
                    }
                }else{
                    if(!colModel.isHidden(idx1)){
                        colModel.setHidden(idx1, true);
                    }
                    if(!colModel.isHidden(idx2)){
                        colModel.setHidden(idx2, true);
                    }
                }
            }

            this.el.unmask();
            this.hide();
        }

       
    });

    </script>