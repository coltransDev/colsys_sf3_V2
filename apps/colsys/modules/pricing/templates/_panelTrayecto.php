<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">
/**
 * PanelTrayecto object definition
 **/

PanelTrayecto = function( config ){
    Ext.apply(this, config);
    
    this.record = Ext.data.Record.create([
        {name: 'sel', type: 'bool'},
        {name: 'idtrayecto', type: 'int'},       
        {name: 'origen', type: 'string'},        
        {name: 'destino', type: 'string'},        
        {name: 'trayecto', type: 'string'},
        {name: 'agente', type: 'string'},
        {name: 'linea', type: 'string'},
        {name: 'idlinea', type: 'string'},
        {name: 'ttransito', type: 'string'},
        {name: 'frecuencia', type: 'string'},
        {name: 'activo', type: 'bool'},
        {name: 'netnet', type: 'bool'},
        {name: 'ncontrato', type: 'string'}
    ]);

    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        url: '<?=url_for("pricing/datosPanelTrayecto")?>',
        baseParams : {
            impoexpo: this.impoexpo,
            transporte: this.transporte,
            modalidad: this.modalidad,
            idtrafico: this.idtrafico

        },
        reader: new Ext.data.JsonReader(
            {
                id: 'idtrayecto',
                root: 'data',
                totalProperty: 'total',
                successProperty: 'success'
            },
            this.record
        ),
        sortInfo:{field: 'destino', direction: "ASC"},
        groupField: 'linea'
    });

    /*
    * Crea la columna de chequeo
    */

    

    
    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, groupable: false});
    this.checkColumnActivo = new Ext.grid.CheckColumn({header:'Activo', dataIndex:'activo', width:50, groupable: false});
    this.checkColumnNetNet = new Ext.grid.CheckColumn({header:'Net-Net', dataIndex:'netnet', width:50, groupable: false});

    this.columns = [
		this.checkColumn,
		{
			id: 'linea', //para aplicar estilos a esta columna
			header: "Linea",
			width: 200,
			sortable: true,
			dataIndex: 'linea',
			hideable: false
		},
		{
			id: 'origen',
			header: "Origen",
			width: 100,
			sortable: true,
			dataIndex: 'origen',
			hideable: false
		},
		{
			id: 'destino',
			header: "Destino",
			width: 100,
			sortable: true,
			dataIndex: 'destino',
			hideable: false

		},
        {
			id: 'agente',
			header: "Agente",
			width: 100,
			sortable: true,
			dataIndex: 'agente',
			hideable: false
		}
		,{
			id: 'ttransito',
			header: "Tiempo de Transito",
			width: 80,
			sortable: true,
			groupable: false,
			dataIndex: 'ttransito',
			editor: new Ext.form.TextField()
		},
		{
			id: 'frecuencia',
			header: "Frecuencia",
			width: 80,
			sortable: true,
			groupable: false,
			dataIndex: 'frecuencia'	,
			editor: new Ext.form.TextField()
		},
        {
			id: 'ncontrato',
			header: "Contrato",
			width: 80,
			sortable: true,
			groupable: false,
			dataIndex: 'ncontrato'	,
			editor: new Ext.form.TextField()
		},         
		this.checkColumnActivo

	];

    if( this.impoexpo=="<?=Constantes::EXPO?>" && this.transporte=="<?=Constantes::AEREO?>"){
        this.columns.push( this.checkColumnNetNet );
    }

    PanelTrayecto.superclass.constructor.call(this, {        
        clicksToEdit: 1,
        stripeRows: true,
        autoExpandColumn: 'origen',
        plugins: [this.checkColumn, this.checkColumnActivo, this.checkColumnNetNet],
        closable: true,        
        height: 400,
        //autoHeight : true,
        <?
        if( !$readOnly ){
        ?>
        tbar: [
        {
            text: 'Guardar Cambios',
            tooltip: 'Guarda los cambios realizados en los trayectos',
            iconCls:'disk',  // reference to our css
            scope: this,
            handler: this.guardarCambios
        }],
        <?
        }
        ?>
        view: new Ext.grid.GroupingView({
            forceFit:true,
            enableRowBody:true,
            enableNoGroups:false,
            hideGroupedColumn: true
        }),
        listeners:{
            afteredit: this.onAfterEdit            
        }
    });

    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
       <?
       if( $readOnly ){
       ?>
           return false;
       <?
       }else{
       ?>
           return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
       <?
       }
       ?>

    }
}

Ext.extend(PanelTrayecto, Ext.grid.EditorGridPanel, {
    guardarCambios: function(){
        var success = true;
        var store = this.store;
        var records = store.getModifiedRecords();
        
        var lenght = records.length;
        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();

            changes['id']=r.id;										
            changes['idtrayecto']=r.data.idtrayecto;
            //envia los datos al servidor 
            Ext.Ajax.request( 
                {   
                    waitMsg: 'Guardando cambios...',						
                    url: '<?=url_for("pricing/observeAdminTrayectos")?>', 						
                    //Solamente se envian los cambios 						
                    params :	changes,

                    //Ejecuta esta accion en caso de fallo
                    //(404 error etc, ***NOT*** success=false)
                    failure:function(response,options){							
                        alert( response.responseText );						
                        success = false;
                    },
                    //Ejecuta esta accion cuando el resultado es exitoso
                    success:function(response,options){							
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.id ){
                            var rec = store.getById( res.id );
                            rec.set("sel", false); //Quita la seleccion de todas las columnas
                            rec.commit();
                        }
                    }
                 }
            ); 
        }
    },

    /*
    * Handler que se dispara despues de editar una celda
    */
    onAfterEdit: function(e) {
        /**
        * Copia los datos a las columnas seleccionadas 
        **/
        var store = this.store;
        if(e.record.data.sel){
            var records = store.getModifiedRecords();				
            var lenght = records.length;				
            var field = e.field;				
            for( var i=0; i< lenght; i++){
                r = records[i];			
                if(r.data.sel){				
                    r.set(field,e.value);
                }
            }
        }	
    }
    
});
</script>