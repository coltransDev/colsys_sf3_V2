<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>

<script type="text/javascript">

PanelPreviewTicket = function( config ){
    Ext.apply(this, config);
    
    this.tpl = Ext.Template.from('preview-tpl', {
        compiled:true,
        getBody : function(v, all){
            return Ext.util.Format.stripScripts(v || all.description);
        }
    });

    if( this.idcomponent ){
        var idcomponent = this.idcomponent;
    }else{
        var idcomponent = this.id;
    }

    this.readOnly = true;
    
    this.preview = new Ext.Panel({
        //id: 'preview',
        title: "Vista Previa",
        cls:'preview',
        autoScroll: true,
        height: 600,
        //listeners: FeedViewer.LinkInterceptor,

        tbar: [{
            id:'edit-'+idcomponent,
            text: 'Editar Ticket',
            iconCls: 'page_white_edit',
            disabled:true,
            handler : this.editTicket,
            scope: this
        },
        {
            id:'tab-'+idcomponent,
            text: 'Ver en nuevo Tab',
            iconCls: 'new-tab',
            disabled:true,
            handler : this.openTab,
            scope: this
        },
        {
            id:'print-'+idcomponent,
            text: 'Vista de impresión',
            iconCls: 'printer',
            disabled:true,
            handler : this.viewPrinter,
            scope: this
        },
        {
            id:'percent-'+idcomponent,
            text: 'Porcentaje',
            iconCls: 'shape_align_left',
            disabled:true,
            handler : this.actualizarPorcentaje,
            scope: this
        }
        ],

        clear: function(){
            this.body.update('');
            var items = this.topToolbar.items;
            items.get('edit-'+idcomponent).disable();
            items.get('tab-'+idcomponent).disable();
            items.get('print-'+idcomponent).disable();
            items.get('percent-'+idcomponent).disable();
            //items.get('win').disable();
        }
    });

    this.responses = new Ext.Panel({
        //id: 'preview',
        title: "Respuestas",
        cls:'preview',
        autoScroll: true,
        
        //height: 400,
        
        tbar: [{
            id:'response-'+idcomponent,
            text: 'Nueva respuesta',
            iconCls: 'add',
            disabled:true,
            handler : this.newResponse,
            scope: this
        },
        {
            id:'kb-'+idcomponent,
            text: 'Buscar una solución',
            iconCls: 'search',
            disabled:true,
            handler : this.searchKb,
            scope: this
        }
        ],

        clear: function(){
            this.body.update('');
            var items = this.topToolbar.items;
            items.get('tab-'+idcomponent).disable();
            items.get('response-'+idcomponent).disable();
            items.get('kb-'+idcomponent).disable();
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
    
    this.docsPanel = new PanelDocumentos({
                                id: 'docs-panel-'+idcomponent,
                                idticket: null,
                                //folder: this.folder,
                                closable: false,
                                title: "Documentos",
                                height: 400
                            });

    this.entregasPanel = new PanelEntregas({
        id: 'entregas-panel-'+idcomponent,
        idticket: null,        
        closable: false,
        title: "Entregas",
        height: 400
    });

    PanelPreviewTicket.superclass.constructor.call(this, {
        
        activeTab:0,
        enableTabScroll: true,
        deferredRender: false,
        autoScroll: true,
        
        items: [
            this.preview,
            this.responses,
            this.filePanel,
            this.usersPanel,
            this.entregasPanel
        ]
    });
    var panel = this;
    var index = panel.items.length;
    if( this.idticket ){
        Ext.Ajax.request({
            url: "<?=url_for("pm/datosTicket")?>",
            params: {
                idticket: this.idticket
            },
            callback :function(options, success, response){
                var res = Ext.util.JSON.decode( response.responseText );
                if(res.success == true){
                    res.data.opened = Date.parseDate( res.data.opened, "Y-m-d H:i:s" );
                    res.data.vencimiento = Date.parseDate( res.data.vencimiento, "Y-m-d H:i:s" );
                    res.data.respuesta = Date.parseDate( res.data.respuesta, "Y-m-d H:i:s" );
                    res.data.idgroup = res.data.idgroup;
                    //res.data.estimated = Date.parseDate( res.data.estimated, "Y-m-d" );
                    panel.loadRecord( res );
                }else
                    location.href="<?=url_for('pm/noAccess')?>";
            }
        });
    }
    
    
    if (this.department == "Auditoría" || this.department == 'Marítimo' || this.department == 'Pricing' || this.department == 'Aduanas'){        // Habilita la pestaña de importación de documentos, para auditoría
        Ext.getCmp('docs-panel-'+idcomponent).department = this.department;
        panel.insert(index, this.docsPanel);
    }
    
    if (this.idgroup == 25){        // Tarifas de transportes internacional    
        var bar = this.responses.getTopToolbar();        
        bar.addItem({
            id:'proveedor-'+idcomponent,
            text: 'Generar Cot. Proveedor',
            iconCls: 'email',
            disabled:true,
            handler : this.proveedor,
            scope: this
        })
    }
    
    var grupoSistemas = [1,2,3,21,22,23];
    
    if (grupoSistemas.indexOf(parseInt(this.idgroup)) >= 0){        // Areas de Sistemas relacionas con riesgos    
        var bar = this.responses.getTopToolbar();        
        bar.addItem({
            id:'evento-'+idcomponent,
            text: 'Evento Riesgo',
            iconCls: 'register',
            handler : this.evento,
            scope: this
        })
    }

};

Ext.extend(PanelPreviewTicket, Ext.TabPanel, {
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
    },
    
    searchKb: function( record ){
       
       var win = new BusquedaIssueWindow( {idticket: this.idticket,
                                           opener: this.responses.id } );
       win.show();

    },
    
    proveedor: function( record ){
       
       /*var win = new BusquedaIssueWindow( {idticket: this.idticket,
                                           opener: this.responses.id } );
       win.show();*/
        var idticket = this.idticket;
        
        Ext.IframeWindow = Ext.extend(Ext.Window, {            
            onRender: function() {
                this.bodyCfg = {
                    tag: 'iframe',
                    src: this.src,
                    cls: this.bodyCls,
                    style: {
                        border: '0px none'
                    }
                };
                Ext.IframeWindow.superclass.onRender.apply(this, arguments);
            }
        });

        var w = new Ext.IframeWindow({
            id:'win-proveedor-'+idticket,
            width:870,
            height:480,
            closeAction: 'destroy',            
            title:"Pricing: Solicitud de tarifas a proveedor",
            //src:"pm/generarTarifasPDF?idticket="+idticket+"&tipo=externo"
            src: "/pm/verSolicitudProveedor?idticket="+idticket,
            buttons: [{
                text: 'Cerrar',
                handler: function(){
                    var win = Ext.getCmp("win-proveedor-"+idticket);
                    win.close();
                },
                scope: this
            }]            
        });
        w.show();        
    },
    evento: function( record ){
        var idticket = this.idticket;
        window.open("/riesgos/nuevoEventoExt5/idproceso/8/idtipo/14/documento/"+idticket);       
    },

    loadRecord: function( record ){

        var idcomponent = this.idcomponent;

        this.record = record;
        this.idticket = record.data.idticket;
        this.vencimiento = record.data.vencimiento;
        this.respuesta = record.data.respuesta;
        this.idgroup = record.data.idgroup;
        //this.estimated = record.data.estimated;        
        this.status = record.data.status;
        this.status_name = record.data.status_name;
        this.action = record.data.action;

        this.tpl.overwrite(this.preview.body, record.data);

        this.filePanel.setFolder( record.data.folder );
        this.filePanel.store.reload();

        this.usersPanel.setDataUrl("<?=url_for("pm/datosUsuarioTicket")?>");
        this.usersPanel.store.setBaseParam("idticket",record.data.idticket );
        this.usersPanel.store.reload();
        this.usersPanel.idticket = record.data.idticket;

        this.docsPanel.setDataUrl("<?=url_for("pm/datosDocumentosTicket")?>");
        this.docsPanel.store.setBaseParam("idticket",record.data.idticket );
        this.docsPanel.store.reload();
        this.docsPanel.idticket = record.data.idticket;

        this.entregasPanel.setDataUrl("<?=url_for("pm/datosEntregasTicket")?>");
        this.entregasPanel.store.setBaseParam("idticket",record.data.idticket );
        this.entregasPanel.store.reload();
        this.entregasPanel.idticket = record.data.idticket;

        responsePanel = this.responses;

        this.readOnly = true;
         
        if( typeof(record.data.readOnly)!="undefined" ){
            this.readOnly = record.data.readOnly;
        }

        //alert(record.data.readOnly+" --- "+ this.readOnly);

        responsePanel.body.update(" ");
        Ext.Ajax.request({
            url: '<?=url_for("pm/verRespuestas")?>',
            method: 'POST',
            //Solamente se envian los cambios
            params :	{
                idticket:record.data.idticket,
                opener: responsePanel.id
            },

            callback :function(options, success, response){
                responsePanel.body.update( response.responseText );
            }
         });


        var items = this.preview.topToolbar.items;
        //if( !this.readOnly ){
            items.get('edit-'+idcomponent).enable();
        /*}else{
            items.get('edit-'+idcomponent).disable();
        }*/
        items.get('tab-'+idcomponent).enable();
        items.get('print-'+idcomponent).enable();
        //if( !this.readOnly ){
            items.get('percent-'+idcomponent).enable();
        /*}else{
            items.get('percent-'+idcomponent).disable();
        }*/

        var items = this.responses.topToolbar.items;
        if(this.action == "Abierto"){
            items.get('response-'+idcomponent).enable();
            items.get('kb-'+idcomponent).enable();
            if(items.get('proveedor-'+idcomponent))
                items.get('proveedor-'+idcomponent).enable();
        }else{
            /*Deshabilita la opción de Insertar o Eliminar un adjunto cuando el ticket está cerrado*/
            this.filePanel.topToolbar.getComponent(0).disable();
            this.filePanel.topToolbar.getComponent(2).disable();
        }
        this.usersPanel.wgUsuario.enable();
    },

    viewPrinter : function(){
        var idticket = this.idticket;        
        window.open("<?=url_for("pm/verTicket?format=email")?>"+"/id/"+idticket);

    },

    openTab : function(){
        var idticket = this.idticket;

        var newComponent = new Ext.Panel({
                                            closable: true,
                                            title: 'Ticket # '+idticket,
                                            //autoHeight: true,
                                            items: new PanelPreviewTicket({
                                                 idticket: idticket
                                                })
                                          });
        Ext.getCmp('tab-panel').add(newComponent);
        Ext.getCmp('tab-panel').setActiveTab(newComponent);
    },

    newResponse: function(){
        var idticket = this.idticket;
        
        newResponse(idticket, null, this.vencimiento, this.respuesta, this.responses.id, this.status, this.status_name, this.idgroup/*, this.estimated*/ );
    },

    editTicket: function(){
        var idticket = this.idticket;
        
        if( idticket ){
            var win = Ext.getCmp("editar-ticket-win");
            if( win ){
                win.close();
            }
            var win = new EditarTicketWindow({idticket: idticket
                                        });
            win.show();
        }
    },

    actualizarPorcentaje: function(){
        var idticket = this.idticket;
        if( idticket  ){
            win = new PorcentajeTicketWindow({
                modal: true,
                title: "Actualizar Porcentaje Ticket #"+idticket,            
                idticket: idticket,
                percentage: this.record.data.percentage
            });
            win.show();
        }
    }

});

</script>