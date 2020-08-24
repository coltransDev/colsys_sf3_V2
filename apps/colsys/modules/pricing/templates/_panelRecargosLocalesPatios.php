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

    this.expander = new Ext.grid.RowExpander({
        lazyRender : false,
        width: 15,
        tpl : new Ext.Template(
            '<p><div class=\'btnComentarios\' id=\'obs_{_id}\'>&nbsp; {observaciones}</div></p>'
        ),
        getRowClass : function(record, rowIndex, p, ds){
            p.cols = p.cols-1;

            var content = this.bodyContent[record.id];

            //if(!content && !this.lazyRender){		//hace que los comentarios no se borren cuando se guarda
                content = this.getBodyContent(record, rowIndex);
            //}

            if(content){
               p.body = content;
            }

            var color;
            if( record.data.style ){
                color = "row_"+record.data.style;
            }

            if( record.data.observaciones!='' ){
                this.state[record.id]=true;
            }

            return this.state[record.id] ? 'x-grid3-row-expanded '+color : 'x-grid3-row-collapsed '+color;
        }
    });


    this.columns = [       
        
        this.expander,
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
        plugins: [this.checkColumn,this.expander],
        tbar: tbar,
        view: new Ext.grid.GridView({
            forceFit :true
        }),
        listeners:{
            dblclick: this.onDblclick
        }
    });

    var readOnly = this.readOnly;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {        
        if( readOnly ){
            return false;
        }
        return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
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
    },

    /**
    * Muestra una ventana donde se pueden editar las observaciones
    **/
    onDblclick: function(e) {
        //if( !this.readOnly )
        {
            var btn = e.getTarget('.btnComentarios');
            if (btn) {
                var t = e.getTarget();
                var v = this.view;
                var rowIdx = v.findRowIndex(t);
                store = this.getStore();
                var record = this.getStore().getAt(rowIdx);
                activeRow = rowIdx;
                var buttons;
                if(!this.readOnly)
                    buttons= Ext.MessageBox.OKCANCEL;
                else
                    buttons= Ext.MessageBox.CANCEL;
                Ext.MessageBox.show({
                   title: 'Observaciones',
                   msg: 'Por favor coloque las observaciones:',
                   width:600,                   
                   multiline: 300,            
                   buttons: buttons,                   
                   fn: this.actualizarObservaciones,
                   animEl: 'mb3',
                   value: record.get("observaciones")
               });
            }
        }
    },

    /*
    * Coloca las observaciones en pantalla y actualiza el datastore
    */
    actualizarObservaciones: function( btn, text ){
        if( btn=="ok" ){
            var record = store.getAt(activeRow);
            record.set("observaciones", text);

            //document.getElementById("obs_"+record.get("_id")).innerHTML  = "<b>Observaciones:</b> "+text;
        }
    }
   
});

</script>
