<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">
ModalidadWindow = function() {


    this.ctxRecord = null;

    this.grid = new ModalidadGrid({
       
    });

    ModalidadWindow.superclass.constructor.call(this, {
        title: 'Seleccione las modalidades',        
        id: 'add-modalidad-win',
        autoHeight: true,
        width: 500,
        height: 300,
        resizable: false,
        plain:true,
        modal: true,
        y: 100,
        autoScroll: true,
        closeAction: 'hide',

        buttons:[{
            text: 'Actualizar',
            handler: this.onUpdate,
            scope: this
        },{
            text: 'Cancel',
            handler: this.hide.createDelegate(this, [])
        }],

        items: this.grid
    });

    this.addEvents({add:true});
}

Ext.extend(ModalidadWindow, Ext.Window, {
    

    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }
        ModalidadWindow.superclass.show.apply(this, arguments);
    },

    onUpdate: function() {
        this.el.mask('Actualizando...', 'x-mask-loading');
        var store = this.grid.store;
        var records = store.getModifiedRecords();

        var lenght = records.length;
        
        var str = "";
        for( var i=0; i< lenght; i++){

            r = records[i];
            if( i!=0 ){
                str+="|";
            }
            
            str+=r.data.idmodalidad;

            //alert(r.data.idmodalidad + " "+r.data.modalidad );
            
        }

        
        this.ctxRecord.set( "modalidades",  str );
        
        var grid = Ext.getCmp('panel-parametros');
        var records = grid.store.getModifiedRecords();

        var lenght = records.length;

        for( var i=0; i< lenght; i++){
            r = records[i];
            if( r.data.sel ){
                r.set( "modalidades" , str );
            }
        }


        this.el.unmask();
        this.hide();

        /*var url = this.feedUrl.getValue();
        Ext.Ajax.request({
            url: 'feed-proxy.php',
            params: {feed: url},
            success: this.validateFeed,
            failure: this.markInvalid,
            scope: this,
            feedUrl: url
        });*/
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