<style>
/*Inicio Julio*/

.x-panel-header-default-horizontal {
    padding: 0;
}

.x-panel-header-title-default {
    color: #157fcc;
    font-family: helvetica,arial,verdana,sans-serif;
    font-size: 12px;
    font-weight: 100;
    line-height: 14px;
}

.x-tab-bar-default-top > .x-tab-bar-body-default {
    padding: 0;
}

.x-autocontainer-innerCt {
    display: table-cell;
    height: 100%;
    vertical-align: top;
}
.x-border-box, .x-border-box * {
    box-sizing: border-box;
}


.x-border-box, .x-border-box * {
    box-sizing: border-box;
}
.x-autocontainer-innerCt {
    display: table-cell;
    height: 100%;
    vertical-align: top;
}
.x-autocontainer-innerCt {
    display: table-cell;
    height: 100%;
    vertical-align: top;
}
.x-border-box, .x-border-box * {
    box-sizing: border-box;
}

.x-panel-body-default {
    color: #3e4752;
    font-family: "Proxima Nova","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 12px;
    font-weight: 300;
}

.x-tab-inner-default {
    color: black;
    font: 300 12px/16px helvetica,arial,verdana,sans-serif;
    max-width: 100%;
}
.tool_in_tabpanel {
    right: 0px !important;
    left: auto !important;
    top: 3px !important;
}

/*Fin Julio*/
</style>

<table width="100%" align="center">
    <td><div id="idPrincipal" style="margin: 5px"></div></td>
</table>

<script>   
Ext.onReady(function(){
    
    var filterPanel = Ext.create('Ext.panel.Panel', {
        renderTo: 'idPrincipal',
        items: [            
            {
                xtype:'Colsys.Crm.FormPrincipal',
                title: "CRM"
            }
         ]
         
    });
});
</script>