<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">


PanelRecargosLocalesParametros = function( config ){
    Ext.apply(this, config);

    this.comboConcepto = new Ext.form.ComboBox({
		typeAhead: true,
		forceSelection: true,
		triggerAction: 'all',
		emptyText:'',
		selectOnFocus: true,
		lazyRender:true,
		allowBlank: false,
		listClass: 'x-combo-list-small',
		valueField:'idconcepto',
		displayField:'concepto',
		mode: 'local',
		store :  new Ext.data.SimpleStore({
					fields: ['idconcepto', 'concepto'],
					data : [

						<?
						$i=0;
						foreach( $parametros as $parametro ){
							if( $i++!=0 ){
								echo ",";
							}
						?>
							['<?=$parametro->getCaIdentificacion()?>','<?=$parametro->getCaValor()?>']
						<?
						}
						?>
					]
				})

	});

	this.comboValores = <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>;

    


    this.record = Ext.data.Record.create([
        {name: 'id', type: 'int'},
        {name: 'modalidad', type: 'string'},
        {name: 'idlinea', type: 'string'},
        {name: 'impoexpo', type: 'string'},
        {name: 'linea', type: 'string'},
        {name: 'idconcepto', type: 'string'},
        {name: 'concepto', type: 'string'},
        {name: 'valor', type: 'string'},
        {name: 'observaciones', type: 'string'}
    ]);
    
    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        url: '<?=url_for("pricing/datosPanelRecargosLocalesParametros")?>',
        baseParams : {
            impoexpo: this.impoexpo,
            transporte: this.transporte,
            modalidad: this.modalidad,
            idlinea: this.idlinea,
            readOnly: this.readOnly
        },
        reader: new Ext.data.JsonReader(
            {
                root: 'data',
                totalProperty: 'total',
                successProperty: 'success'
            },
            this.record
        )        
    });

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

            if( record.data.observaciones!='' && record.data.tipo!='concepto' ){
                this.state[record.id]=true;
            }

            return this.state[record.id] ? 'x-grid3-row-expanded '+color : 'x-grid3-row-collapsed '+color;
        }
    });

    this.columns = [
        this.expander,
		{
			header: "Concepto",
			width: 100,
			sortable: false,
			hideable: false,
			dataIndex: 'concepto',
			editor: this.comboConcepto

		},
		{
			header: "Aplicación",
			width: 100,
			sortable: false,
			hideable: false,
			dataIndex: 'valor',
			editor: this.comboValores
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
            }
        ];
    }else{
        var tbar = null;
    }

    PanelRecargosLocalesParametros.superclass.constructor.call(this, {
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        stripeRows: true,
        height: 500,
        width: '100',
        plugins: [this.expander],
        view: new Ext.grid.GridView({
            forceFit :true
        }),
        listeners:{
            rowcontextmenu: this.onRowContextMenu,
            validateedit: this.onValidateEdit,
            beforeedit:this.onBeforeedit,
            dblclick: this.onDblclick
        },
        tbar: tbar
    });
    var storeRecargosLocalesParametros = this.store;
    var readOnly = this.readOnly;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        if( readOnly ){
            return false;
        }else{
            var record = storeRecargosLocalesParametros.getAt(rowIndex);
            var field = this.getDataIndex(colIndex);


            if( !record.data.concepto && field!="concepto" ){

                return false;
            }

            if( record.data.concepto!="+" && field=="concepto" ){
                return false;
            }

            return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
        }
    }

}

Ext.extend(PanelRecargosLocalesParametros, Ext.grid.EditorGridPanel, {

    /*
    * Handler que se encarga de colocar el dato recargo_id en el Record
    * cuando se inserta un nuevo recargo
    */
    onValidateEdit: function(e){
        var storeRecargosLocalesParametros = this.store;
        var record = this.record;
        if( e.field == "concepto"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            store.each( function( r ){
                    if( r.data.idconcepto==e.value ){

                        if( !rec.data.idconcepto  ){
                            /*
                            * Crea una columna en blanco adicional para permitir
                            * agregar mas items
                            */
                            var newRec = new record({
                               concepto: '+',
                               valor: '',
                               observaciones: ''
                            });

                            //Inserta una columna en blanco al final
                            storeRecargosLocalesParametros.addSorted(newRec);

                        }


                        rec.set("idconcepto", r.data.idconcepto);
                        e.value = r.data.concepto;
                        return true;
                    }
                }
            )
        }
    },

    onBeforeedit: function( e ){

        if( e.field=="valor" ){
            <?
            foreach( $parametros as $parametro ){
                ?>
                var datosValor<?=$parametro->getCaIdentificacion()?> = [
                    <?
                    $aplicaciones = explode("|", $parametro->getcaValor2() );
                    $i=0;
                    foreach( $aplicaciones as $aplicacion ){
                        if( $i++!=0){
                            echo ",";
                        }
                    ?>
                        ['<?=$aplicacion?>']
                    <?
                    }
                    ?>
                ];
            <?
            }
            ?>

            var ed = this.colModel.getCellEditor(e.column, e.row);

            eval("ed.field.store.loadData( datosValor"+e.record.data.idconcepto+" );");

        }

    },


    guardar: function(){
        if( !this.readOnly ){
            var storeRecargosLocalesParametros = this.store;
            var success = true;
            var records = storeRecargosLocalesParametros.getModifiedRecords();

            var lenght = records.length;
            for( var i=0; i< lenght; i++){
                r = records[i];

                var changes = r.getChanges();

                changes['id']=r.id;
                changes['concepto']=r.data.concepto;
                changes['valor']=r.data.valor;
                changes['idtrafico']=this.idtrafico;
                changes['transporte']=this.transporte;
                changes['modalidad']=this.modalidad;
                changes['impoexpo']=this.impoexpo;
                changes['idlinea']=this.idlinea;
                //envia los datos al servidor
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("pricing/guardarPanelRecargosLocalesParametros")?>',
                        //Solamente se envian los cambios
                        params :	changes,
                        callback :function(options, success, response){
                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.id && res.success){
                                var rec = storeRecargosLocalesParametros.getById( res.id );
                                rec.commit();
                            }
                        }
                     }
                );
            }
        }
    },


    /*
    * Menu contextual que se despliega sobre una fila con el boton derecho
    */
    onRowContextMenu: function(grid, index, e){
        if( !this.readOnly ){
            rec = this.store.getAt(index);
            if( !this.menu ){
                this.menu = new Ext.menu.Menu({
                    items: [
                        {
                            text: 'Eliminar item',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                                var storeRecargosLocalesParametros = this.store;
                                if( this.ctxRecord && this.ctxRecord.data.concepto ){
                                    var id = this.ctxRecord.id;
                                    var concepto = this.ctxRecord.data.concepto;

                                    var idlinea = this.idlinea;
                                    var modalidad = this.modalidad;
                                    var impoexpo = this.impoexpo;
                                    var transporte = this.transporte;

                                    if( concepto!="+" && confirm("Esta seguro?") ){

                                        Ext.Ajax.request(
                                        {
                                            waitMsg: 'Guardando cambios...',
                                            url: '<?=url_for("pricing/eliminarPanelRecargosLocalesParametros"  )?>',
                                            //method: 'POST',
                                            //Solamente se envian los cambios
                                            params :	{
                                                idlinea: idlinea,
                                                modalidad: modalidad,
                                                impoexpo: impoexpo,
                                                transporte: transporte,
                                                concepto: concepto,
                                                id: id
                                            },

                                            callback :function(options, success, response){

                                                var res = Ext.util.JSON.decode( response.responseText );

                                                if( res.id && res.success){
                                                    var rec = storeRecargosLocalesParametros.getById( res.id );
                                                    storeRecargosLocalesParametros.remove(rec);
                                                }
                                            }


                                        });
                                    }
                                }
                            }
                        }
                        ]
                });
            }
            this.menu.on('hide', this.onContextHide, this);

            e.stopEvent();
            if(this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
            this.ctxRecord = rec;
            this.ctxRow = this.view.getRow(index);
            Ext.fly(this.ctxRow).addClass('x-node-ctx');
            this.menu.showAt(e.getXY());
       }

    },

    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
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
