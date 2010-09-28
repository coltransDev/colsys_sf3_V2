<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */





?>

<script type="text/javascript">


PanelAsignaciones = function( config ){

    Ext.apply(this, config);
        
    this.columns = [
        {
            header: "Asignado a",
            dataIndex: 'login',
            //hideable: false,
            width: 110,
            sortable: false,
            renderer: this.formatItem
        },
        {
            header: "Fecha",
            dataIndex: 'fchasignacion',
            renderer: Ext.util.Format.dateRenderer('Y-m-d'),
            width: 63,
            sortable: false
        }
    ];


    this.record = Ext.data.Record.create([
           
            {name: 'login', type: 'string'},
            {name: 'fchasignacion', type: 'date', dateFormat:'Y-m-d'},
            {name: 'idactivo', type: 'integer'}
           

    ]);
    
    this.store = new Ext.data.GroupingStore({
        autoLoad : false,
        url: '<?=url_for("inventory/datosPanelAsignaciones")?>',        
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record
        ),
        sortInfo:{field: 'fchasignacion', direction: "DESC"}        
        

    });


    this.tbar = [{
        text: 'Recargar',
        tooltip: 'Actualiza losdatos del panel',
        iconCls: 'refresh',  // reference to our css
        scope: this,
        handler: this.recargar
    }];

    
    PanelAsignaciones.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},       
       //boxMinHeight: 300,
       
       autoScroll:true,       
       view: new Ext.grid.GroupingView({

            forceFit:true            
            
            
       }),
       
       tbar: this.tbar
    });

};

Ext.extend(PanelAsignaciones, Ext.grid.GridPanel, {

    crearActivo: function(){        
        this.win = new EditarActivoWindow( {idcategory:this.idcategory,
                                            gridopener: this.id} );
        this.win.show();
    },
    recargar: function(){

        if(this.store.getModifiedRecords().length>0){
            if(!confirm("Se perderan los cambios no guardados, desea continuar?")){
                return 0;
            }
        }
        this.store.reload();
    },
    


    formatItem: function(value, p, record) {
        return String.format(
            '<b>{0}</b>',
            value
        );
    }
    

});

</script>