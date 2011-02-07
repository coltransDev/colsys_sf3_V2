<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">


PanelReading = function( config ){

    Ext.apply(this, config);
    
<?  if($nivel<2)
     {
?>
    cate='<?=$id_cate?>';    
    this.editable=(cate.indexOf(this.idcategory+",",0)> -1);
<?
    }
    else
    {
?>

    this.editable=true;
<?
    }
?>
    
    this.grid = new PanelActivos(
                     {id:idcomponent,
                      idcategory: this.idcategory,
                      readOnly: this.readOnly,
                      region: 'center',
                      editable:this.editable
                     });

    var idcomponent = this.id;
   
    this.preview = new Ext.Panel({
        //id: 'preview',
        title: "Vista Previa",
        cls:'preview',
        autoScroll: true,
        //listeners: FeedViewer.LinkInterceptor,

        tbar: [{
            id:'tab-'+idcomponent,
            text: 'Ver en nuevo Tab',
            iconCls: 'new-tab',
            disabled:true,
            handler : this.openTab,
            scope: this
        }],

        clear: function(){
            this.body.update('');
            var items = this.topToolbar.items;
            items.get('tab-'+idcomponent).disable();
            //items.get('win').disable();
        }
    });

    this.responses = new Ext.Panel({
        //id: 'preview',
        title: "Seguimientos",
        cls:'preview',
        autoScroll: true,
        //listeners: FeedViewer.LinkInterceptor,

        tbar: [{
            id:'response-'+idcomponent,
            text: 'Nuevo',
            iconCls: 'add',
            disabled:true,
            handler : this.newResponse,
            scope: this
        }],

        clear: function(){
            this.body.update('');
            var items = this.topToolbar.items;
            items.get('tab-'+idcomponent).disable();
            items.get('response-'+idcomponent).disable();
            //items.get('win').disable();
        }
    });

    this.filePanel = new PanelArchivos({
                                //folder: this.folder,
                                closable: false,
                                title: "Archivos",
                                height: 400

                            });

    this.asignacionesPanel = new PanelAsignaciones({
                                    closable: false,
                                    title: "Asignaciones"                                   
                                 });

    this.tabPanel = new Ext.TabPanel({
            region: 'south',
            deferredRender: false,
            activeTab: 0,     // first tab initially active
            height: 400,
            enableTabScroll:true,            
            items: [
                this.preview,
                this.responses,
                this.filePanel,
                this.asignacionesPanel
            ]
    });

    this.tbar = null;

   

    
    PanelReading.superclass.constructor.call(this, {        
        activeTab:0,        
        margins:'0 5 5 0',
        resizeTabs:true,
        tabWidth:150,
        minTabWidth: 120,
        enableTabScroll: true,        
        layout: 'fit',        
        tbar: this.tbar,
        items: {
            //id:'main-view',
            layout:'border',
            //title:'Loading...',
            hideMode:'offsets',
            items:[
                this.grid,
                {
                    layout:'fit',
                    items:this.tabPanel,
                    height: 250,
                    split: true,
                    border:false,
                    region:'south'
                }

            ]
        }

      
      
      
    });


    this.tpl = Ext.Template.from('preview-tpl', {
        compiled:true,
        getBody : function(v, all){
            return Ext.util.Format.stripScripts(v || all.description);
        }
    });


    this.gsm = this.grid.getSelectionModel();

    this.gsm.on('rowselect', this.onRowSelect, this, {buffer:250});


};

Ext.extend(PanelReading, Ext.Panel, {
    

    getTemplate: function(){
        return this.tpl;
    },
    openTab : function(record){
        
        record = (record && record.data) ? record : this.gsm.getSelected();
        var d = record.data;
        var id = !d.link ? Ext.id() : d.link.replace(/[^A-Z0-9-_]/gi, '');
        var tab;
        var tabPanel = Ext.getCmp('tab-panel');
        if(!(tab = tabPanel.getItem(id))){
            tab = new Ext.Panel({
                id: id,
                cls:'preview single-preview',
                title: d.title,
                tabTip: d.title,
                html: this.getTemplate().apply(d),
                closable:true,
                //listeners: FeedViewer.LinkInterceptor,
                autoScroll:true,
                border:true

               
            });
            tabPanel.add(tab);
        }
        tabPanel.setActiveTab(tab);
    },

    newResponse: function(record){
       record = (record && record.data) ? record : this.gsm.getSelected();
       //alert( record.data.idticket);       
       var win = new NuevoSeguimientoWindow({idactivo: record.data.idactivo,
                                           opener: this.responses.id
                                          });
       win.show();
    },

    recargar: function(){
        this.grid.recargar();
    },

    crearTicket: function(){
        this.grid.crearTicket();
    },

    roadmap: function(){
        this.grid.roadmap();
    },

    agruparPor: function( val ){
        this.grid.agruparPor( val );
    },

    asignarMilestone: function( val ){
        this.grid.asignarMilestone( val );
    },

    
    onRowSelect: function(sm, index, record){
        this.idactivo = record.data.idactivo;
        var idcomponent = this.id;
        this.tpl.overwrite(this.preview.body, record.data);
        this.filePanel.setFolder( record.data.folder ); 
        this.filePanel.store.setBaseParam("folder",record.data.folder );
        this.filePanel.store.reload();

        this.asignacionesPanel.store.setBaseParam("idactivo",record.data.idactivo );
        this.asignacionesPanel.store.reload();

       
        
        responsePanel = this.responses;

        responsePanel.body.update(" ");
        Ext.Ajax.request({
            url: '<?=url_for("inventory/verSeguimientos")?>',
            method: 'POST',
            //Solamente se envian los cambios
            params :	{
                idactivo:record.data.idactivo
            },

            callback :function(options, success, response){
                responsePanel.body.update( response.responseText );
            }
         });


        var items = this.preview.topToolbar.items;
        items.get('tab-'+idcomponent).enable();

        var items = this.responses.topToolbar.items;
        items.get('response-'+idcomponent).enable();
        
        
        
        
    },

    onSelectUser: function( combo, record, index){ // override default onSelect to do redirect

        var panel = Ext.getCmp('user-panel-'+this.idcomponent);
        
        Ext.Ajax.request({
            url: '<?=url_for("pm/agregarUsuario")?>',
            method: 'POST',
            //Solamente se envian los cambios
            params :	{
                login:record.data.login,
                idticket: panel.idticket
            },

            callback :function(options, success, response){
                panel.store.reload();
                combo.setValue("");
            }
         });

    },
    onDeleteUser: function(){
        
        var fv = this.dataView;
        records =  fv.getSelectedRecords();
        var storeView = this.store;
        for( var i=0;i< records.length; i++){
            if( confirm( 'Esta seguro que desea borrar el archivo seleccionado?') ){                
                Ext.Ajax.request({
                    url: this.deleteUrl,
                    params: {
                        login: records[i].data.login,
                        idticket: this.idticket,
                        id: records[i].id
                    },

                    callback :function(options, success, response){
                        var res = Ext.util.JSON.decode( response.responseText );
                        storeView.each(function(r){
                            if(r.id==res.id){
                                storeView.remove(r);
                                Ext.Msg.alert("Success", "Se ha eliminado el usuario");
                            }
                        });

                    }
                });
            }
        }
    }

   
});

</script>