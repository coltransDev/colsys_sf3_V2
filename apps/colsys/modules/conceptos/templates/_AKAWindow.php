<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">
AKAWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;
    
    this.grid = new AKAGrid({
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

    AKAWindow.superclass.constructor.call(this, {
        title: 'Ingrese los posibles Alias',
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

Ext.extend(AKAWindow, Ext.Window, {
    

    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }
        var data = new Array();
        if( this.aka ){
            var akaArray = this.aka.split("|");
            
            var i;
            for( i=0; i<akaArray.length; i++ ){
                var row = [ akaArray[i], i];
                data.push(row);
            }
        }

        data.push(['+','Z']);
        this.grid.store.loadData( data );

        AKAWindow.superclass.show.apply(this, arguments);
    },

    onUpdate: function() {        
        var store = this.grid.store;
        var records = store.getRange();

        var lenght = records.length;
        
        var str = "";
        for( var i=0; i< lenght; i++){

            rec = records[i];

            if( rec.data.alias && rec.data.alias!="+" ){
                if( str!="" ){
                    str+="|";
                }
                str+=rec.data.alias;
            }            
        }

        this.ctxRecord.set( "aka",  str );

        //Marca la columna como si no se hubiera guardado
        var idconcepto = this.ctxRecord.get( "idconcepto" );
        this.ctxRecord.set( "idconcepto",  "" );
        this.ctxRecord.set( "idconcepto",  idconcepto );
        
        this.hide();
        
    }
});

</script>