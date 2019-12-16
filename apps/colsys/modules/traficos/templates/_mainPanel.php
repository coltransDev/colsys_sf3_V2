<script>

    Ext.define('Colsys.traficos.Mainpanel', {
        extend: 'Ext.panel.Panel',
        alias: 'widget.wCTMainpanel',
        //bodyPadding: 10,
//    "idmaster":12176,
        autoHeight: true,
        onRender: function (ct, position) {
            tabs = new Array();
            //console.log("dsfdsfdsf");
            me=this;
            
            //tabs.push();
                
                 
            
            this.add(
                    {
                        xtype: 'tabpanel',
                        id: 'tab-panel-id-reportes-neg' + this.idreporte,
                        activeTab: 0,
                        items: tabs
                    });
           
            this.superclass.onRender.call(this, ct, position);
        }
    });
</script>