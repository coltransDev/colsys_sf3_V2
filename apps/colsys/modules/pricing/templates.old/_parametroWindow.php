<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">
ParametroWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;
    
    this.grid = new ParametroGrid({
       readOnly: this.readOnly,
       idconcepto: this.idconcepto
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

    ParametroWindow.superclass.constructor.call(this, {
        title: 'Ingrese los parametros',
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

Ext.extend(ParametroWindow, Ext.Window, {
    

    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }

        this.grid.store.setBaseParam( "parametros", this.ctxRecord.data.parametros);
        this.grid.store.load();

        ParametroWindow.superclass.show.apply(this, arguments);
    },

    onUpdate: function() {        
        var store = this.grid.store;
        var records = store.getRange();

        var lenght = records.length;
        
        var str = "";
        for( var i=0; i< lenght; i++){

            rec = records[i];

            if( rec.data.parametro && rec.data.parametro!="+" ){
                if( str!="" ){
                    str+="|";
                }
                str+=rec.data.parametro;
            }            
        }

        this.ctxRecord.set( "parametros",  str );

        //Marca la columna como si no se hubiera guardado
        var idconcepto = this.ctxRecord.get( "idconcepto" );
        this.ctxRecord.set( "idconcepto",  "" );
        this.ctxRecord.set( "idconcepto",  idconcepto );
        
        this.hide();
        
    }
});

</script>