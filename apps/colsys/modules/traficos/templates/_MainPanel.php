/*
 * Ext JS Library 2.2.1
 * Copyright(c) 2006-2009, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

MainPanel = function(){
    this.preview = new Ext.Panel({
        id: 'preview',
        region: 'south',
        cls:'preview',
        autoScroll: true,
        listeners: TrackingViewer.LinkInterceptor,

        tbar: [{
            id:'tab',
            text: 'Ver en Nuevo Tab',
            iconCls: 'new-tab',
            disabled:true,
            handler : this.openTab,
            scope: this
        },
        '-',
        {
            id:'win',
            text: 'Nuevo Rep. al Ext',
            iconCls: 'new-win',
            disabled:true,
            scope: this,
            handler : function(){
                window.open(this.gsm.getSelected().data.link);
            }
        }],

        clear: function(){
            this.body.update('');
            var items = this.topToolbar.items;
            items.get('tab').disable();
            items.get('win').disable();
        }
    });

    this.grid = new StatusGrid(this, {
        tbar:[
        {
            split:true,
            text:'Nuevo',
            tooltip: {title:'Nuevo status',text:'Nueva confirmación de llegada'},
            iconCls: 'preview-bottom',
            handler: this.movePreview.createDelegate(this, []),
            menu:{
                id:'reading-menu',
                cls:'reading-menu',
                width:170,
                items: [{
                    text:'Confirmación de llegada',
                   
                    
                      toggle:this.movePreview,
                    scope:this,
                    iconCls:'preview-bottom'
                },{
                    text:'Confirmación OTM',
                   
                    
                    checkHandler:this.movePreview,
                    scope:this,
                    iconCls:'preview-right'
                }
				
				]
            }
        },
        '-',
        {
            pressed: false,
            enableToggle:true,
            text:'Vista previa',
            tooltip: {title:'Post Summary',text:'View a short summary of each item in the list'},
            iconCls: 'summary',
            scope:this,
            toggleHandler: function(btn, pressed){
                this.grid.togglePreview(pressed);
            }
        }]
    });

    MainPanel.superclass.constructor.call(this, {
        id:'main-tabs',
        activeTab:0,
        region:'center',
        margins:'0 5 5 0',
        resizeTabs:true,
        tabWidth:150,
        minTabWidth: 120,
        enableTabScroll: true,
        plugins: new Ext.ux.TabCloseMenu(),
        items: {
            id:'main-view',
            layout:'border',
            title:'Loading...',
            hideMode:'offsets',
            items:[
                this.grid, {
                id:'bottom-preview',
                layout:'fit',
                items:this.preview,
                height: 250,
                split: true,
                border:false,
                region:'south'
            }, {
                id:'right-preview',
                layout:'fit',
                border:false,
                region:'east',
                width:350,
                split: true,
                hidden:true
            }]
        }
    });

    this.gsm = this.grid.getSelectionModel();

    this.gsm.on('rowselect', function(sm, index, record){
        TrackingViewer.getTemplate().overwrite(this.preview.body, record.data);
        var items = this.preview.topToolbar.items;
        items.get('tab').enable();
        items.get('win').enable();
		
		var statusListPanel = new StatusList();			
		statusListPanel.render("status-list-div");			
		statusListPanel.loadGrid( record.data.reporte );	
		
    }, this, {buffer:250});

    this.grid.store.on('beforeload', this.preview.clear, this.preview);
    this.grid.store.on('load', this.gsm.selectFirstRow, this.gsm);

    this.grid.on('rowdblclick', this.openTab, this);
};

Ext.extend(MainPanel, Ext.TabPanel, {

    loadFeed : function(feed){
        this.grid.loadFeed(feed.url);
        Ext.getCmp('main-view').setTitle(feed.text);
    },

    movePreview : function(m, pressed){
		
        if(!m){ // cycle if not a menu item click
            var readMenu = Ext.menu.MenuMgr.get('reading-menu');
            readMenu.render();
            var items = readMenu.items.items;
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
            var right = Ext.getCmp('right-preview');
            var bot = Ext.getCmp('bottom-preview');
            var btn = this.grid.getTopToolbar().items.get(2);
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
                case 'No visible':
                    preview.ownerCt.hide();
                    preview.ownerCt.ownerCt.doLayout();
                    btn.setIconClass('preview-hide');
                    break;
            }
        }
    },

    openTab : function(record){
        record = (record && record.data) ? record : this.gsm.getSelected();
        var d = record.data;
        var id = !d.link ? Ext.id() : d.link.replace(/[^A-Z0-9-_]/gi, '');
        var tab;
        if(!(tab = this.getItem(id))){
            tab = new Ext.Panel({
                id: id,
                cls:'preview single-preview',
                title: d.reporte,
                tabTip: d.reporte,
                html: TrackingViewer.getTemplate().apply(d),
                closable:true,
                listeners: TrackingViewer.LinkInterceptor,
                autoScroll:true,
                border:true,

                tbar: [{
                    text: 'Go to Post',
                    iconCls: 'new-win',
                    handler : function(){
                        window.open(d.link);
                    }
                }]
            });
            this.add(tab);
        }
        this.setActiveTab(tab);
    },

    openAll : function(){
        this.beginUpdate();
        this.grid.store.data.each(this.openTab, this);
        this.endUpdate();
    }
});
