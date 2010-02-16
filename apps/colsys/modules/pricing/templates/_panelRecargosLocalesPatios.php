<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">


PanelRecargosLocalesPatios = function( config ){
    Ext.apply(this, config);

    this.record = Ext.data.Record.create([
        {name: 'sel', type: 'bool'},
        {name: 'id', type: 'int'},
        {name: 'idpatio', type: 'string'},
        {name: 'nombre', type: 'string'},
        {name: 'direccion', type: 'string'},
        {name: 'ciudad', type: 'string'},
        {name: 'observaciones', type: 'string'}
    ]);
    
    this.store = new Ext.data.GroupingStore({
        autoLoad : true,			
        url: '<?=url_for("pricing/datosPanelRecargosLocalesPatios")?>',
        baseParams : {
            impoexpo: this.impoexpo,
            transporte: this.transporte,
            modalidad: this.modalidad,
            idlinea: this.idlinea,
            readOnly:this.readOnly
        },
        reader: new Ext.data.JsonReader(
            {			
                root: 'data',
                totalProperty: 'total',
                successProperty: 'success'
            }, 
            this.record
        ),
        sortInfo:{field: 'id', direction: "ASC"}
    });

    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false, hidden: this.readOnly});

    


    this.columns = [       
        this.checkColumn,
		{
			header: "Patio",
			width: 80,
			sortable: false,
			hideable: false,
			dataIndex: 'nombre'
		},
		{
			header: "Dirección",
			width: 150,
			sortable: false,
			hideable: false,
			dataIndex: 'direccion'
		}
		,
		{
			header: "Ciudad",
			width: 50,
			sortable: false,
			hideable: false,
			dataIndex: 'ciudad'
		}       
		,
		{
			header: "Observaciones",
			width: 200,
			sortable: false,
			hideable: false,            
			dataIndex: 'observaciones',
			editor: new Ext.form.TextField({
	                    allowBlank:true
			})
		}        

	];

    if( !this.readOnly ){
        var tbar =  [
            {
                text: 'Guardar Cambios',
                tooltip: 'Guarda los cambios realizados en el tarifario',
                iconCls:'disk',  // reference to our css
                scope: this,
                handler: this.guardar
            },
            {
                text: 'Seleccionar todo',
                tooltip: 'Selecciona todos los patios',
                iconCls:'tick',  // reference to our css
                scope: this,
                handler: this.seleccionarTodo
            }
        ];
    }else{
        var tbar = null;
    }

    PanelRecargosLocalesPatios.superclass.constructor.call(this, {
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        stripeRows: true,
        height: 500,
        plugins: [this.checkColumn],
        tbar: tbar,
        view: new Ext.grid.GridView({
            forceFit :true
        })
    });

    var readOnly = this.readOnly;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        if( readOnly ){
            return false;
        }
    }

}

Ext.extend(PanelRecargosLocalesPatios, Ext.grid.EditorGridPanel, {
    guardar: function(){
        if( !this.readOnly ){
            var storeRecargosPatios = this.store;
            var records = storeRecargosPatios.getRange();
            var lenght = records.length;
            var patios="";
            for( var i=0; i< lenght; i++){
                r = records[i];
                if( r.data.sel ){
                    if(patios!=""){
                        patios+="|";
                    }
                    patios+=r.data.idpatio+","+r.data.observaciones;
                }
            }

            Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("pricing/guardarPanelRecargosLocalesPatios")?>',                        
                        params :	{
                                        impoexpo: this.impoexpo,
                                        transporte: this.transporte,
                                        modalidad: this.modalidad,
                                        idlinea: this.idlinea,
                                        patios:patios
                                    },
                        callback :function(options, success, response){
                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.success){
                                storeRecargosPatios.commitChanges();
                            }
                        }
                     }
                );
        }
    },


    seleccionarTodo: function(){
        this.store.each( function(r){
                r.set("sel", true);
            }
        );
    }
   
});

</script>
