<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$recargos = $sf_data->getRaw("recargos");
?>
<script type="text/javascript">


PanelCostosAduanaRecargos = function( config ){

    Ext.apply(this, config);
    
    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false	});

    this.columns = [
        this.checkColumn,
		{			
			header: "Concepto",
			width: 180,
			sortable: true,
			dataIndex: 'concepto',
			hideable: false
		}
	];


    /*
    * Crea el Record
    */
    this.record = Ext.data.Record.create([        
        {name: 'sel', type: 'bool'},
        {name: 'idconcepto', type: 'string', mapping: 'c_ca_idconcepto'},
        {name: 'concepto', type: 'string' , mapping: 'c_ca_concepto'}        
    ]);

    this.data = <?=json_encode(array("root"=>$recargos))?>;


    /*
    * Crea el store
    */
    this.store = new Ext.data.Store({
        proxy: new Ext.data.MemoryProxy(this.data),
        autoLoad : true,
        reader: new Ext.data.JsonReader(
            {                
                root: 'root'
            },
            this.record
        ),
        sortInfo:{field: 'concepto', direction: "ASC"}
        
    });

    this.store.load();


    PanelCostosAduanaRecargos.superclass.constructor.call(this, {
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,        
        stripeRows: true,                     
        id: 'panel-costos-aduana-recargos',
        height: 400,               
        view: new Ext.grid.GridView({
            forceFit:true
        }),
        plugins: [ this.checkColumn ],
        boxMinHeight: 400
    });


    

}

Ext.extend(PanelCostosAduanaRecargos, Ext.grid.EditorGridPanel, {
    
    /*
    * Lanza lan función de actualización de registros modificados
    */
    guardarItems: function(){
        
    }



});

</script>