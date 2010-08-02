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
    
    this.grid = new PanelTickets({id:idcomponent,
                      idgroup: this.idgroup,
                      idproject: this.idproject,
                      actionTicket: this.actionTicket,
                      assignedTo: this.assignedTo,
                      reportedBy: this.reportedBy,                      
                      readOnly: this.readOnly,
                      region: 'center'                      
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
        title: "Respuestas",
        cls:'preview',
        autoScroll: true,
        //listeners: FeedViewer.LinkInterceptor,

        tbar: [{
            id:'response-'+idcomponent,
            text: 'Nueva respuesta',
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

    this.usersPanel = new PanelUsers({
                                id: 'user-panel-'+idcomponent,
                                idticket: null,
                                closable: false,
                                title: "Usuarios",
                                height: 400,
                                deleteUrl: "<?=url_for("pm/eliminarUsuario")?>"
                            });

    this.usersPanel.wgUsuario.on("select", this.onSelectUser );
    this.usersPanel.wgUsuario.disable();
    this.usersPanel.wgUsuario.idcomponent = idcomponent;

    var btn = this.usersPanel.getTopToolbar().items.get(1);
    if( btn ){
        btn.handler = this.onDeleteUser;
    }
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
                this.usersPanel
            ]
    });

    this.tbar = [

                /*{
                    split:true,
                    text:'Panel Lectura',
                    tooltip: {title:'Reading Pane',text:'Show, move or hide the Reading Pane'},
                    iconCls: 'preview-bottom',
                    handler: this.movePreview.createDelegate(this, []),
                    menu:{
                        id:'reading-menu-'+idcomponent,
                        cls:'reading-menu',
                        width:100,
                        items: [{
                            text:'Abajo',
                            checked:true,
                            group:'rp-group',
                            checkHandler:this.movePreview,
                            scope:this,
                            iconCls:'preview-bottom'
                        },{
                            text:'Derecha',
                            checked:false,
                            group:'rp-group',
                            checkHandler:this.movePreview,
                            scope:this,
                            iconCls:'preview-right'
                        },{
                            text:'Ocultar',
                            checked:false,
                            group:'rp-group',
                            checkHandler:this.movePreview,
                            scope:this,
                            iconCls:'preview-hide'
                        }]
                    }
                },*/
                {
                    text: 'Nuevo ticket',
                    tooltip: '',
                    iconCls: 'add',  // reference to our css
                    scope: this,
                    handler: this.crearTicket
                },
                {
                    text: 'Recargar',
                    tooltip: 'Actualiza losdatos del panel',
                    iconCls: 'refresh',  // reference to our css
                    scope: this,
                    handler: this.recargar
                },
                {
                    text: 'Roadmap',
                    tooltip: 'Permite ver el cronograma de entrega de los tickets',
                    iconCls: 'calendar',  // reference to our css
                    scope: this,
                    handler: this.roadmap
                },

                {
                    text: 'Asignaciones',
                    tooltip: 'Agrupa los tickets por usuario',
                    iconCls: 'tux',  // reference to our css
                    scope: this,
                    handler: function(){
                        this.agruparPor('assignedto');
                    }
                }
    ]

    if( this.idproject ){
        this.tbar.push(  {
                    text: 'Asignar milestone',
                    tooltip: 'Asigna un milestone a los elementos seleccionados',
                    iconCls: 'calendar',  // reference to our css
                    scope: this,
                    handler: this.asignarMilestone
                } )
    }

    
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
                //this.tabPanel
            {

                //id:'bottom-preview-'+idcomponent,
                layout:'fit',
                items: this.tabPanel,
                height: 400,
                split: true,
                border:false,
                region:'south'
            }/*, {
                id:'right-preview-'+idcomponent,
                layout:'fit',
                border:false,
                region:'east',
                width: 400,
                split: true,
                hidden:true
            }*/]
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
       var win = new NuevaRespuestaWindow({idticket: record.data.idticket,
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
        this.idticket = record.data.idticket;
        var idcomponent = this.id;
        this.tpl.overwrite(this.preview.body, record.data);
        
        this.filePanel.setFolder( record.data.folder );        
        this.filePanel.store.reload();

        this.usersPanel.setDataUrl("<?=url_for("pm/datosUsuarioTicket")?>");
        this.usersPanel.store.setBaseParam("idticket",record.data.idticket );
        this.usersPanel.store.reload();
        this.usersPanel.idticket = record.data.idticket;     
        
        responsePanel = this.responses;

        responsePanel.body.update(" ");
        Ext.Ajax.request({
            url: '<?=url_for("pm/verRespuestas")?>',
            method: 'POST',
            //Solamente se envian los cambios
            params :	{
                idticket:record.data.idticket
            },

            callback :function(options, success, response){
                responsePanel.body.update( response.responseText );
            }
         });


        var items = this.preview.topToolbar.items;
        items.get('tab-'+idcomponent).enable();

        var items = this.responses.topToolbar.items;
        items.get('response-'+idcomponent).enable();

        this.usersPanel.wgUsuario.enable();
        
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