<script>
    
Ext.define('Colsys.Ino.Mainpanel', {    
    extend:'Ext.panel.Panel',
    alias: 'widget.wCIMainpanel',
    //bodyPadding: 10,
//    "idmaster":12176,
    autoHeight: true,
    onRender: function(ct, position){        
        
        tabs=new Array();
        if(this.permisos.General == true){
            tabs.push({
                        xtype:'Colsys.Ino.FormMaster',
                        title: "General ",
                        id:"form-master-"+this.idmaster,
                        name:"form-master-"+this.idmaster,
                        idmaster: this.idmaster,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        permisos: this.permisos
                    });
        }
        if(!isNaN(this.idmaster) && this.idmaster>0)
        {
            if(this.permisos.House == true){
                tabs.push(                
                {
                    xtype:'Colsys.Ino.GridHouse',
                    title: "House",
                    id:"grid-house-"+this.idmaster,
                    name:"grid-house-"+this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    permisos: this.permisos
                });
            }
            if(this.permisos.Facturacion == true){
                tabs.push({
                    xtype:'Colsys.Ino.GridFacturacion',
                    title: "Facturacion",
                    id:"grid-facturacion-"+this.idmaster,
                    name:"grid-facturacion-"+this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    permisos: this.permisos
                });
            }
            if(this.permisos.Facturacion == true){
                tabs.push({
                    xtype:'Colsys.Ino.PanelFacturacion',
                    title: "Facturacion",
                    id:"panel-facturacion-"+this.idmaster,
                    name:"panel-facturacion-"+this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    permisos: this.permisos
                });
            }
            if(this.permisos.Costos == true){
             
                tabs.push({
                    xtype:'Colsys.Ino.GridCosto',
                    title: "Costos",
                    id:"costo-"+this.idmaster,
                    name:"costo-"+this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    permisos: this.permisos
                });
            }
            
             if (this.idimpoexpo == "<?=Constantes::EXPO?>"){
                tabs.push({
                    xtype:'Colsys.Ino.GridEvento',
                    title: "Eventos",
                    id:"Eventos-"+this.idmaster,
                    name:"Eventos-"+this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    idreferencia:this.idreferencia,
                    //caso_uso: '11',
                    permisos: this.permisos
                });
            }
            
            if(this.permisos.Documentos == true){
               // alert(this.idtransporte + " "+ this.idimpoexpo);
                
                tabs.push({
                    xtype:'Colsys.GestDocumental.treeGridFiles',
                    title: "Documentos",
                    id:"Documentos-"+this.idmaster,
                    name:"Documentos-"+this.idmaster,
                    idmaster: this.idmaster,
                    idreferencia:this.idreferencia,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    permisos: this.permisos
                });
            }            
            
            tabs.push({
                    xtype:'Colsys.Ino.PanelBalance',
                    title: "Balance",
                    id:"balance-"+this.idmaster,
                    name:"balance-"+this.idmaster,
                    idmaster: this.idmaster,
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    idreferencia:this.idreferencia,                    
                    permisos: this.permisos
                });
                    
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
</script>