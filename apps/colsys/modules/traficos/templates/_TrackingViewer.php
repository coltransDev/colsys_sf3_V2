/*
 * Ext JS Library 2.2.1
 * Copyright(c) 2006-2009, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

TrackingViewer = {};

Ext.onReady(function(){
    Ext.QuickTips.init();

    Ext.state.Manager.setProvider(new Ext.state.SessionProvider({state: Ext.appState}));

    var tpl = Ext.Template.from('preview-tpl', {
        compiled:true,
        getBody : function(v, all){
            return Ext.util.Format.stripScripts(v || all.description);
        }
    });
    TrackingViewer.getTemplate = function(){
        return tpl;
    }

    var feeds = new QueryPanel();
    var mainPanel = new MainPanel();

    feeds.on('feedselect', function(feed){
        mainPanel.loadFeed(feed);
    });
    
    var viewport = new Ext.Viewport({
        layout:'border',
        items:[
            new Ext.BoxComponent({ // raw element
                region:'north',
                el: 'header',
                height:32
            }),
            feeds,
            mainPanel
         ]
    });
   
   
});

// This is a custom event handler passed to preview panels so link open in a new windw
TrackingViewer.LinkInterceptor = {
    render: function(p){
        p.body.on({
            'mousedown': function(e, t){ // try to intercept the easy way
                t.target = '_blank';
            },
            'click': function(e, t){ // if they tab + enter a link, need to do it old fashioned way
                if(String(t.target).toLowerCase() != '_blank'){
                    e.stopEvent();
                    window.open(t.href);
                }
            },
            delegate:'a'
        });
    }
};
