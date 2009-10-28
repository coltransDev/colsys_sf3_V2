<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">


PanelConceptosFletes = function( config ){

    Ext.apply(this, config);

    

    this.columns = [{

        header: "Concepto",
        dataIndex: 'item',
        hideable: false,
        sortable:false,
        width: 200


      },{
        header: "Cantidad",
        dataIndex: 'cantidad',
        width: 50,
        hideable: false,
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :0
			})
      },
      {
        header: "Neta",
        dataIndex: 'neta_tar',
        width: 50,
        hideable: false,
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },
      {
        header: "Minima",
        dataIndex: 'neta_min',
        width: 50,
        hideable: false,
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },
      {
        header: "Moneda",
        dataIndex: 'neta_idm',
        width: 50,
        hideable: false,
        sortable:false,
        editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
      },
      {
        header: "Reportar",
        dataIndex: 'reportar_tar',
        width: 50,
        hideable: false,
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },
      {
        header: "Minima",
        dataIndex: 'reportar_min',
        width: 50,
        hideable: false,
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },
      {
        header: "Moneda",
        dataIndex: 'reportar_idm',
        width: 50,
        hideable: false,
        sortable:false,
        editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
      },

      {
        header: "Cobrar",
        dataIndex: 'cobrar_tar',
        width: 50,
        hideable: false,
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },
      {
        header: "Minima",
        dataIndex: 'cobrar_min',
        width: 50,
        hideable: false,
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },
      {
        header: "Moneda",
        dataIndex: 'cobrar_idm',
        width: 50,
        hideable: false,
        sortable:false,
        editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
      }
     ];


    this.record = Ext.data.Record.create([
            {name: 'idreporte', type: 'int'},
            {name: 'iditem', type: 'int'},
            {name: 'item', type: 'string'},
            {name: 'neta_tar', type: 'float'},
            {name: 'neta_min', type: 'float'},
            {name: 'neta_idm', type: 'string'},
            {name: 'reportar_tar', type: 'float'},
            {name: 'reportar_min', type: 'float'},
            {name: 'reportar_idm', type: 'string'},
            {name: 'cobrar_tar', type: 'float'},
            {name: 'cobrar_min', type: 'float'},
            {name: 'cobrar_idm', type: 'string'},
            {name: 'tipo', type: 'string'}

        ]);

    this.store = new Ext.data.Store({

        autoLoad : true,
        url: '<?=url_for("reportesNeg/panelConceptosData?id=".$reporte->getCaIdreporte())?>',
        reader: new Ext.data.JsonReader(
            {

                root: 'items',
                totalProperty: 'total'
            },
            this.record
        )
    });




    PanelConceptosFletes.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       view: new Ext.grid.GridView({

            forceFit:true,
            enableRowBody:true,
            showPreview:true//,
            //getRowClass : this.applyRowClass
        })


    });


};

Ext.extend(PanelConceptosFletes, Ext.grid.EditorGridPanel, {
    guardarCambios: function(){


        var store = this.store;
        var records = store.getModifiedRecords();
			
        var lenght = records.length;
        
        /*
        for( var i=0; i< lenght; i++){
            r = records[i];
            if(!r.data.moneda && (r.data.tipo=="concepto"||r.data.recargo=="concepto") ){
                if( r.data.iditem!=9999){
                    Ext.MessageBox.alert('Warning','Por favor coloque la moneda en todos los items');
                    return 0;
                }
            }
        }	*/

        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();

            //Da formato a las fechas antes de enviarlas 
            

            changes['id']=r.id;
            changes['tipo']=r.data.tipo;
            changes['iditem']=r.data.iditem;	
            changes['idreporte']=r.data.idreporte;
            

            //envia los datos al servidor 
            Ext.Ajax.request( 
                {   
                    waitMsg: 'Guardando cambios...',						
                    url: '<?=url_for("reportesNeg/observePanelConceptoFletes")?>', 						//method: 'POST',
                    //Solamente se envian los cambios 						
                    params :	changes,

                    callback :function(options, success, response){	

                        var res = Ext.util.JSON.decode( response.responseText );	
                        if( res.id && res.success){
                            var rec = store.getById( res.id );

                            //rec.set("sel", false); //Quita la seleccion de todas las columnas
                            rec.commit();		
                        }
                    }	
                 }
            ); 

        }


    }

});

</script>