<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">


PanelCostosAduana = function( config ){

    Ext.apply(this, config);
    
    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false	});


    this.mainGroup =  [
          {header: ' ', colspan: 2, align: 'center'},
        <?
        foreach( $recargos as $recargo ){
        ?>
          {header: '<?=$recargo->getCaConcepto()?>', colspan: <?=$recargo->getCaCol2()?2:1?>, align: 'center'},
        <?
        }
        ?>
          {header: ' ', colspan: 2, align: 'center'},
    ];


    this.group = new Ext.ux.grid.ColumnHeaderGroup({
        rows: [ this.mainGroup ]
    });


    this.cols = [
        this.checkColumn,
		{			
			header: "Cliente",
			width: 180,
			sortable: true,
			dataIndex: 'cliente',
			hideable: false
		},
        
        <?
        foreach( $recargos as $recargo ){
        ?>
		{
			id: 'recargo_<?=$recargo->getCaIdconcepto()?>_col1',
			header: "<?=$recargo->getCaCol1()?$recargo->getCaCol1():"Valor"?>",
			width: 80,
			dataIndex: 'recargo_<?=$recargo->getCaIdconcepto()?>_col1',
            hidden: true,
			hideable: true,
            editor: new Ext.form.NumberField({
	                    allowBlank:true,
                        allowNegative:false
			})
		},
        <?
            if( $recargo->getCaCol2() ){
        ?>
		{
			id: 'recargo_<?=$recargo->getCaIdconcepto()?>_col2',
			header: "<?=$recargo->getCaCol2()?>",
			width: 80,
            hidden: true,
			hideable: true,
			dataIndex: 'recargo_<?=$recargo->getCaIdconcepto()?>_col2',
            editor: new Ext.form.NumberField({
	                    allowBlank:true,
                        allowNegative:false
			})
			
		},
        <?
            }
        }
        ?>        
		{			
			header: "Observaciones",
			width: 100,
			sortable: true,
			dataIndex: 'observaciones',
			//dataIndex: 'id',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'Detalles',
	                    allowBlank:true
			})
		},
        {

			header: "Vendedor",
			width: 100,
			sortable: true,
			dataIndex: 'vendedor',
			//dataIndex: 'id',
			hideable: true
		}
        
        
	];




    /*
    * Crea el Record
    */
    this.record = Ext.data.Record.create([        
        {name: 'sel', type: 'bool'},
        {name: 'idcliente', type: 'string'},
        {name: 'cliente', type: 'string' , mapping: 'compania'},
        {name: 'observaciones', type: 'string'},
        <?
        foreach( $recargos as $recargo ){
        ?>
        {name: 'recargo_<?=$recargo->getCaIdconcepto()?>_col1', type: 'string'},

        <?
            if( $recargo->getCaCol2() ){
        ?>
            {name: 'recargo_<?=$recargo->getCaIdconcepto()?>_col2', type: 'string'},
        <?
            }
        }
        ?>
        {name: 'vendedor', type: 'string'}
    ]);

    <?
    $url = 'pricing/datosPanelCostosAduana';
    if($modo=="consulta"){
        $url.="&modo=consulta";
    }
    

    ?>
    /*
    * Crea el store
    */
    this.store = new Ext.data.GroupingStore({
        url: '<?=url_for($url)?>',
        autoLoad : true,
        reader: new Ext.data.JsonReader(
            {                
                root: 'root',
                totalProperty: 'total'
            },
            this.record
        ),
        sortInfo:{field: 'cliente', direction: "ASC"}

        
    });

    this.store.load();


    PanelCostosAduana.superclass.constructor.call(this, {
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,        
        stripeRows: true,        
             
        id: 'panel-costos-aduana',
        height: 400,
        
        <?
        //if( $modo!="consulta" ){
        ?>
        tbar: [

            {
                text: 'Guardar Cambios',
                tooltip: 'Guarda los cambios realizados en Recargos',
                iconCls: 'disk',  // reference to our css
                handler: function(){
                    Ext.getCmp("panel-costos-aduana").guardarItems();
                }
            },

            {
                text: 'Ver/Ocultar',
                tooltip: 'Recarga los datos de la base de datos',
                iconCls: 'refresh',  // reference to our css
                handler: this.showWindow
                    
            }
        ],
        <?
        //}
        ?>
        //colModel: new Ext.ux.grid.LockingColumnModel( this.cols),
        colModel: new Ext.grid.ColumnModel( this.cols ),
        view: new Ext.grid.GridView({
            forceFit:true
        }),
        plugins: [this.checkColumn, this.group ], //
        <?
        if($modo!="consulta"){
        ?>
        listeners:{
            //show: this.onShow
            /*rowcontextmenu:this.onRowContextMenu,
            validateedit: this.onValidateEdit*/
            //beforeedit:this.onBeforeedit
        }
        <?
        }else{
        ?>
        boxMinHeight: 400
        
        <?
        }
        ?>

    });


    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        /*
        <?
        if($modo=="consulta"){
        ?>
        return false;
        <?
        }
        ?>

		var record = Ext.getCmp("panel-costos-aduana").store.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);

		if( !record.data.idrecargo && field!="recargo" ){
			return false;
		}

		if( record.data.idrecargo && field=="recargo" ){
			return false;
		}*/

		return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
	}

    

}

Ext.extend(PanelCostosAduana, Ext.grid.EditorGridPanel, {
    
    


    /*
    * Lanza lan función de actualización de registros modificados
    */
    guardarItems: function(){
        
        var success = true;
        
        store = this.store;

        var records = store.getModifiedRecords();

        var lenght = records.length;
        
        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();
            changes['id']=r.id;
            changes['idcliente']=r.data.idcliente;

            //envia los datos al servidor
            Ext.Ajax.request(
                {
                    waitMsg: 'Guardando cambios...',
                    url: '<?=url_for("pricing/observePanelCostosAduana" )?>',
                    //Solamente se envian los cambios
                    params :	changes,

                    callback :function(options, success, response){

                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.id ){
                            var rec = store.getById( res.id );                            
                            rec.commit();
                        }
                    }

                 }
            );
            r.set("sel", false);//Quita la seleccion de todas las columnas
        }


    },

    showWindow: function(){

        if( !this.win ){           
            this.win = new PanelCostosAduanaWindow();
        }
        this.win.show();
    },

    onShow: function(){
        //this.showWindow();
    }



});

</script>