Ext.override(Ext.Component, {
    addExporter: function(t, cfg, timeout){
        
        Ext.require([
            'Ext.grid.plugin.Exporter',
            'Ext.view.grid.ExporterController'
        ]);        
        
        var me = t;
        var librerias = false;
        var plugins = me.getPlugins();
        
        Ext.each(plugins, function(val, index){            
            if(val.ptype == "gridexporter"){                
                librerias = true;
            }
        });
        
        if(!librerias){
            this.showProgressDialog('Generando archivo', 'Por favor espere...');            
            setTimeout (function() {
                Ext.MessageBox.hide();

                me.addPlugin({
                    ptype: 'gridexporter'
                });
                
                me.saveDocumentAs(cfg);
            },timeout);
        }else{
            me.saveDocumentAs(cfg);
        }
    },
    addPlugin: function(p) {
        //constructPlugin is private.
        //it handles the various types of acceptable forms for
        //a plugin
        var plugin = this.constructPlugin(p);
        this.plugins = Ext.Array.from(this.plugins);

        this.plugins.push(plugin);
        
        //pluginInit could get called here but
        //the less use of private methods the better
        plugin.init(this);

        return plugin;
    },
    showProgressDialog: function(Title, message){
        
        Ext.MessageBox.show({
            title: Title,
            msg: message,
            width:300,
            wait:true,
            waitConfig:{
                interval:200,
            }
        });        
    }
});