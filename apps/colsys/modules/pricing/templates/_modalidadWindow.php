<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">
ModalidadWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;
    
    this.grid = new ModalidadGrid({
       readOnly: this.readOnly
    });

    if( !this.readOnly ){
        this.buttons = [
             {
                text: 'Actualizar',
                handler: this.onUpdate,
                scope: this
             },
             {
                text: 'Cancel',
                handler: this.hide.createDelegate(this, [])
            }
         ];
    }else{
        this.buttons = [
            {
                text: 'Cancel',
                handler: this.hide.createDelegate(this, [])
            }
        ]
    }

    ModalidadWindow.superclass.constructor.call(this, {
        title: 'Seleccione las modalidades',                
        autoHeight: true,
        width: 500,
        height: 300,
        resizable: false,
        plain:true,
        modal: true,
        y: 100,
        autoScroll: true,
        closeAction: 'hide',
        buttons: this.buttons,
                  
         

        items: this.grid
    });

    this.addEvents({add:true});
}

Ext.extend(ModalidadWindow, Ext.Window, {
    

    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }

        this.grid.store.setBaseParam( "modalidades", this.ctxRecord.data.modalidades);
        this.grid.store.load();

        ModalidadWindow.superclass.show.apply(this, arguments);
    },

    onUpdate: function() {
        
        var store = this.grid.store;
        var records = store.getRange();

        var lenght = records.length;
        
        var str = "";
        for( var i=0; i< lenght; i++){

            r = records[i];

            if( r.data.idmodalidad ){
                if( i!=0 ){
                    str+="|";
                }

                str+=r.data.idmodalidad;
            }

            //alert(r.data.idmodalidad + " "+r.data.modalidad );
            
        }

        this.ctxRecord.set( "modalidades",  str );

        //Marca la columna como si no se hubiera guardado
        var idconcepto = this.ctxRecord.get( "idconcepto" );
        this.ctxRecord.set( "idconcepto",  "" );
        this.ctxRecord.set( "idconcepto",  idconcepto );
        
        this.hide();
        
    }
});

</script>