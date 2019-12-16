<?
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<style>
.x-grid-cell-inner {    
    white-space: pre-line !important;
}

.x-panel-header-title-default1
{
    color: #157fcc;
    font-family: helvetica,arial,verdana,sans-serif;    
    font-weight: 300;
    line-height: 16px;
    font-size: 11px !important;
    margin: 15px;
}

.x-toolbar-spacer-default {
  width: 2px;
  height: 4px !important;
}

.x-panel-body-default {
    color: #3e4752;
    font-family: "Proxima Nova","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 13px !important;
    font-weight: 300;
}



/*nuevo*/
.thumb {
    background-color: white;
    border-radius: 3px;
    box-shadow: 1px 2px 2px 3px rgba(0, 0, 0, 0.60);
    display: table-cell;
    padding: 12px;
    box-sizing: border-box;
}

.thumb-title {
    color: #3e4752;
    font-weight: 800;
}

.thumb-title-small {
    color: #878ea2;
    font-size: 10px;
    font-weight: 500;
}

.statement-type {
    color: #878ea2;
    float: left;
    font-size: 14px;
    font-weight: bold;
    margin: 20px 5px 0;
    width: 100%;
}

.x-panel-body-default {
    /*background: #ececec none repeat scroll 0 0;*/
    /*background: #fff none repeat scroll 0 0;*/
    border-color: #cecece;
    border-style: solid;
    border-width: 1px;
    color: #3e4752;
    font-family: "Proxima Nova","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 15px;
    font-weight: 300;
}

.x-form-text-default.x-form-textarea {
    line-height: 12px;
    min-height: 40px;
}

</style>
<?
$permisos=$sf_data->getRaw("permisos");
?>

<script>


Ext.Ajax.cors = true;
Ext.Ajax.setCors (true);
Ext.Ajax.setTimeout(120000);
Ext.Loader.setConfig({
    enabled: true,
    paths: {
        //'Chart':'/js/ext5/src/',
        //'Ext.ux.exporter':'../js/ext5/examples/ux/exporter/',
        'Colsys':'/js/Colsys'
        ,'Ext.ux':'/js/ext5/examples/ux'
    }
});




comboBoxRenderer = function (combo) {
    return function (value) {

        rec=null;        
        for(i=0;i<combo.store.data.items.length;i++)
        {
            if(combo.store.data.items[i].get(combo.valueField)==value)
            {
                rec=combo.store.data.items[i];                
                break;
            }
        }
        return (rec === null ? value : rec.get(combo.displayField));
    };
};

</script>
<?php
//$permisos = $sf_data->getRaw("permisos");
//$modo = $sf_data->getRaw("modo");
//$inoMaster = $sf_data->getRaw("inoMaster");
//$idmaster=12176;
//include_component("traficos", "mainPanel");
?>
<table align="center" width="98%" cellspacing="0" border="0" cellpading="0"><tr><td>
<div id="panel"></div>
<div id="sub-panel"></div>
</td></tr></table>
<script>

Ext.onReady(function() {
    Ext.tip.QuickTipManager.init();    
    

    /*Ext.create("Ext.container.Viewport",{
        renderTo: 'panel',
        layout:'border',
        scope:this,
        items:[
            {
                region: 'west',
                xtype: 'Colsys.Traficos.FormBusqueda',
                //'permisosG1':permisosG,
                autoScroll: true
            },
            {
                region: 'center',
                xtype: 'tabpanel',
                id:'tabpanel1',
                name:'tabpanel1',
                activeTab: 0                
            },
            {
                region: 'north',
                html: '',
                border: false,
                height: 30,
                style: {
                    display: 'none'
                }
            }
        ]       
    });    
    tabpanel = Ext.getCmp('tabpanel1');            
    tabpanel.add({
            title: numRef,
            id:'tab'+ref,
            itemId:'tab'+ref,
            closable :true,
            autoScroll: true,
            items: [
                new Colsys.Traficos.Mainpanel({                    
                    region: 'north'
                })
            ]
        }).show();*/
        Ext.create('Ext.panel.Panel', {        
        autoHeight: true,
        renderTo: 'panel',
        /*onRender: function (ct, position) {
            tabs = new Array();
            //console.log("dsfdsfdsf");
            me=this;
            
            
                
                 
            
            
           
            this.superclass.onRender.call(this, ct, position);
        }*/
            items:[
                Ext.create('Ext.form.ComboBox', {
                    fieldLabel: 'Reporte Negocios',
                    queryMode: 'remote',
                    displayField: 'ca_consecutivo',
                    valueField: 'ca_consecutivo',
                    minChars: 3,
                    store: Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'consecutivo', mapping: 'ca_consecutivo'},
                            {name: 'ca_idreporte', mapping: 'ca_idreporte'}
                        ],
                        proxy: {
                            cors: true,           
                            useDefaultXhrHeader: false,
                            method: 'POST',
                            type: 'ajax',
                            url: 'https://10.192.1.70:8152?transporte=<?=$transporte?>&impoexpo=<?=$impoexpo?>',
                            reader: {
                                type: 'json',
                                rootProperty: 'reportes'
                            }
                        },
                        autoLoad: false
                    })
                })
                ,
              
                Ext.create('Ext.form.Panel', {
                    
                    title: 'Busqueda',
                    bodyPadding: 0,
                    id: 'tab-form111',
                    height:'50%',
                    autoScroll: true,
                    scrollable :true,
                    items: [
                    {
                        xtype: 'textfield',
                        textfield:"No Reporte",
                        //width: '100%',
                        name: 'q',
                        id: 'q',
                        allowBlank: true,
                        //style: 'margin-left: 5px',
                        triggers: {
                            clear: {
                                cls: 'x-form-clear-trigger',
                                handler: function () {
                                    this.setValue('');
                                }
                            },
                            search: {
                                cls: Ext.baseCSSPrefix + 'form-search-trigger',
                                handler: function () {

                                    this.up('form').buscar(this.getValue());                                
                                }
                            },
                            searchp: {
                                cls: Ext.baseCSSPrefix + 'form-searchp-trigger',
                                handler: function () {                                
                                    Ext.getCmp('bus-avan').setVisible(Ext.getCmp('bus-avan').hidden);
                                }
                            }
                        },
                        listeners: {
                            specialkey: function (field, e) {
                                if (e.getKey() == e.ENTER) {
                                    this.up('form').buscar(this.getValue());
                                }
                            }
                        }
                    }

                    ],
                    buscar: function (valor)
                    {

                        Ext.Ajax.request({
                            url: 'https://10.192.1.103:8152',
                            cors: true,           
                            useDefaultXhrHeader: false,
                            method: 'POST',
                            success: function(response, opts) {
                                var res = Ext.decode(response.responseText);
                                //console.log(res);
                                Ext.getCmp("gind1").getStore().loadData(res.reportes);
                                Ext.getCmp("gind1").setLoading(false);
                            }
                        });

                        Ext.getCmp("gind1").setLoading(true);
                        var form = this.getForm(); // get the form panel
                        //console.log(Ext.getCmp("q").getValue())
                        //Ext.getCmp("q").getValue()                

                    }
                })
            ]    
    });
});


</script>

<!--<div style="float:left;border:">-->