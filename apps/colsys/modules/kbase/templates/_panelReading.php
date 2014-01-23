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
    
    this.grid = new PanelIssues({ 
        height: 150,
        minSize: 75,
        maxSize: 250,
        idcategory: this.idcategory,
        region: 'center'
    });

    var idcategory = this.idcategory;
    this.preview = new Ext.Panel({
        //id: 'preview',
        region: 'south',
        cls:'preview',
        autoScroll: true,
        title: 'Vista previa',
        //listeners: FeedViewer.LinkInterceptor,

        tbar: [{
            id:'tab-'+idcategory,
            text: 'Ver en nuevo Tab',
            iconCls: 'new-tab',
            disabled:true,
            handler : this.openTab,
            scope: this
        }],

        clear: function(){
            this.body.update('');
            var items = this.topToolbar.items;
            items.get('tab-'+idcategory).disable();
            //items.get('win').disable();
        }
    });

    this.filePanel = new PanelArchivos({
                                //folder: this.folder,
                                closable: false,
                                title: "Archivos",
                                height: 400

                            });


    this.tabPanel = new Ext.TabPanel({
            region: 'south',
            deferredRender: false,
            activeTab: 0,     // first tab initially active
            height: 400,
            enableTabScroll:true,

            items: [
                this.preview,                
                this.filePanel
                //this.usersPanel*/
            ]
    });
    
    PanelReading.superclass.constructor.call(this, {
        //id:'main-tabs',
        activeTab:0,
        //region:'center',
        margins:'0 5 5 0',
        resizeTabs:true,
        tabWidth:150,
        minTabWidth: 120,
        enableTabScroll: true,        
        layout: 'fit',
        height: 200,
        tbar: [
          {
                    text: 'Nuevo',
                    tooltip: '',
                    iconCls: 'add',  // reference to our css
                    scope: this,
                    handler: function(){
                        window.open( "<?=url_for("kbase/formIssue")?>?idcategory="+idcategory );
                    }
                },
                {
                    text: 'Recargar',
                    tooltip: 'Actualiza losdatos del panel',
                    iconCls: 'refresh',  // reference to our css
                    scope: this,
                    handler: this.recargar
                },
                {
                    split:true,
                    text:'Panel Lectura',
                    tooltip: {title:'Reading Pane',text:'Show, move or hide the Reading Pane'},
                    iconCls: 'preview-bottom',
                    handler: this.movePreview.createDelegate(this, []),
                    menu:{
                        id:'reading-menu-'+idcategory,
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
                }
        ],
        items: {
            //id:'main-view',
            layout:'border',
            //title:'Loading...',
            hideMode:'offsets',
            items:[
                this.grid,
            {

                id:'bottom-preview-'+idcategory,
                layout:'fit',
                items:this.tabPanel,
                height: 250,
                split: true,
                border:false,
                region:'south'
            }, {
                id:'right-preview-'+idcategory,
                layout:'fit',
                border:false,
                region:'east',
                width:350,
                split: true,
                hidden:true
            }]
        }

      
      
      
    });


    this.tpl = Ext.Template.from('preview-tpl', {
        compiled:true,
        getBody : function(v, all){
            return Ext.util.Format.stripScripts(v || all.description);
        }
    });


    this.gsm = this.grid.getSelectionModel();

    this.gsm.on('rowselect', function(sm, index, record){
        this.tpl.overwrite(this.preview.body, record.data);
        var items = this.preview.topToolbar.items;

        this.filePanel.setFolder( record.data.folder );
        this.filePanel.store.reload();


        items.get('tab-'+idcategory).enable();
        //items.get('win').enable();
    }, this, {buffer:250});


};

Ext.extend(PanelReading, Ext.Panel, {
    movePreview:  function(m, pressed){
        var idcategory = this.idcategory;
        
        if(!m){ // cycle if not a menu item click
            var items = Ext.menu.MenuMgr.get('reading-menu-'+idcategory).items.items;
            var b = items[0], r = items[1], h = items[2];
            if(b.checked){
                r.setChecked(true);
            }else if(r.checked){
                h.setChecked(true);
            }else if(h.checked){
                b.setChecked(true);
            }
            return;
        }
        if(pressed){
            var preview = this.preview;
            var right = Ext.getCmp('right-preview-'+idcategory);
            var bot = Ext.getCmp('bottom-preview-'+idcategory);
            var btn = this.getTopToolbar().items.get(2);
            switch(m.text){
                case 'Abajo':
                    right.hide();
                    bot.add(preview);
                    bot.show();
                    bot.ownerCt.doLayout();
                    btn.setIconClass('preview-bottom');
                    break;
                case 'Derecha':
                    bot.hide();
                    right.add(preview);
                    right.show();
                    right.ownerCt.doLayout();
                    btn.setIconClass('preview-right');
                    break;
                case 'Ocultar':
                    preview.ownerCt.hide();
                    preview.ownerCt.ownerCt.doLayout();
                    btn.setIconClass('preview-hide');
                    break;
            }
        }
    },

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

    recargar: function(){
        this.grid.recargar();
    }

   
});

</script>