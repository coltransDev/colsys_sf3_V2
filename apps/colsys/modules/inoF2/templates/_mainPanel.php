<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

//include_component("widgets4", "wgConceptosSiigo");
?>

<script>
Ext.onReady(function(){
    
Ext.define('Colsys.Ino.Mainpanel', {    
    extend:'Ext.panel.Panel',
    alias: 'widget.wCIMainpanel',
    bodyPadding: 10,
//    "idmaster":12176,
    autoHeight: true,
    onRender: function(ct, position){
     
        tabs=new Array();
        tabs.push({
                    xtype:'Colsys.Ino.FormMaster',
                    title: "General "+this.idmaster,
                    id:"form-master-"+this.idmaster,
                    name:"form-master-"+this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo
                });
        if(!isNaN(this.idmaster) && this.idmaster>0)
        {
            tabs.push(                
                {
                    xtype:'Colsys.Ino.GridHouse',
                    title: "House"+this.idmaster,
                    id:"grid-house-"+this.idmaster,
                    name:"grid-house-"+this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo
                },
                /*{
                    xtype:'Colsys.Ino.GridFacturacion',
                    title: "Facturacion"+this.idmaster,
                    id:"grid-facturacion-"+this.idmaster,
                    name:"grid-facturacion-"+this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo
                },*/
                {
                    xtype:'Colsys.Ino.PanelFacturacion',
                    title: "Facturacion"+this.idmaster,
                    id:"panel-facturacion-"+this.idmaster,
                    name:"panel-facturacion-"+this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo
                },
                {
                    xtype:'Colsys.Ino.GridCosto',
                    title: "Costos"+this.idmaster,
                    id:"costo-"+this.idmaster,
                    name:"costo-"+this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo
                },
                {
                    xtype:'Colsys.Ino.GridEvento',
                    title: "Eventos"+this.idmaster,
                    id:"Eventos-"+this.idmaster,
                    name:"Eventos-"+this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    idreferencia:this.idreferencia,
                    caso_uso: '11'
                },{
                    xtype:'Colsys.GestDocumental.treeGridFiles',
                    title: "Documentos"+this.idmaster,
                    id:"Documentos-"+this.idmaster,
                    name:"Documentos-"+this.idmaster,
                    idmaster: this.idmaster,
                    idreferencia:this.idreferencia,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo
                }
            );
                    
        }
        this.add(
        {
            xtype: 'tabpanel',
            id:'tab-panel-id-indicadores'+this.idmaster,
            activeTab: 0,
            items: tabs
        });
       this.superclass.onRender.call(this, ct, position);
   }
});
    
});
</script>
