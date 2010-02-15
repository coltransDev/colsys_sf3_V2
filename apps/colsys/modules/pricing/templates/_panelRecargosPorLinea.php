<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">
/**
 * PanelRecargosPorLinea object definition
 **/
PanelRecargosPorLinea = function( config ){
    Ext.apply(this, config);
    
    this.editorLineas = new Ext.form.ComboBox({
		typeAhead: true,
		forceSelection: true,
		triggerAction: 'all',
		emptyText:'',
		selectOnFocus: true,
		lazyRender:true,
		allowBlank: false,
		listClass: 'x-combo-list-small',
		valueField:'idlinea',
		displayField:'linea',
		mode: 'local',
		store :  new Ext.data.SimpleStore({
					fields: ['idlinea', 'linea'],
					data : [
                        ['25','IBERIa']
						/*<?
						/*$i=0;
						foreach( $lineas as $linea ){
							if( $i++!=0 ){
								echo ",";
							}
						?>
							['<?=$linea["p_ca_idproveedor"]?>','<?=$linea["id_ca_nombre"]?>']
						<?
						}*/
						?>*/
					]
				})

	});
    /*
	var comboRecargos = new Ext.form.ComboBox({
		typeAhead: true,
		forceSelection: true,
		triggerAction: 'all',
		emptyText:'',
		selectOnFocus: true,
		lazyRender:true,
		allowBlank: false,
		listClass: 'x-combo-list-small',
		valueField:'idrecargo',
		displayField:'recargo',
		mode: 'local',
		store :  new Ext.data.SimpleStore({
					fields: ['idrecargo', 'recargo'],
					data : [
						<?
						/*$i=0;
						foreach( $recargos as $recargo ){
							if( $i++!=0){
								echo ",";
							}
						?>
							['<?=$recargo->getCaIdrecargo()?>','<?=$recargo->getCaRecargo()?>']
						<?
						}*/
						?>
					]
				})

	});


	var comboConceptos = new Ext.form.ComboBox({
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
						/*$i=0;
						foreach( $conceptos as $concepto ){
							if( $i++!=0){
								echo ",";
							}
						?>
							['<?=$concepto->getCaIdconcepto()?>','<?=str_replace( "'", "\'", $concepto->getCaConcepto())?>']
						<?
						}*/
						?>
						,['9999','Aplica para todos']
					]
				})

	});*/

    this.storeConceptos = new Ext.data.Store({
        autoLoad : false,
        url: '<?=url_for("parametros/datosConceptos")?>',
        baseParams : {
            impoexpo: this.impoexpo,
            transporte: this.transporte,
            modalidad: this.modalidad

        },
        reader: new Ext.data.JsonReader(
            {
                id: 'idconcepto',
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'idconcepto'},
                {name: 'concepto'}
            ])
        )
    });

    this.editorConceptos = new Ext.form.ComboBox({

        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        name: 'recargo',
        id: 'recargo',
        mode: 'local',
        displayField: 'concepto',
        valueField: 'idconcepto',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : this.storeConceptos

    });

    /*
    * Crea el Record
    */
    this.record = Ext.data.Record.create([
        {name: 'sel', type: 'string'},
        {name: 'id', type: 'int'},
        {name: 'idtrafico', type: 'string'},
        {name: 'idlinea', type: 'string'},
        {name: 'impoexpo', type: 'string'},
        {name: 'linea', type: 'string'},
        {name: 'idrecargo', type: 'string'},
        {name: 'recargo', type: 'string'},
        {name: 'idconcepto', type: 'string'},
        {name: 'concepto', type: 'string'},
        {name: 'inicio', type: 'date', dateFormat:'Y-m-d'},
        {name: 'vencimiento', type: 'date', dateFormat:'Y-m-d'},
        {name: 'vlrrecargo', type: 'float'},
        {name: 'vlrminimo', type: 'float'},
        {name: 'aplicacion', type: 'string'},
        {name: 'aplicacion_min', type: 'string'},
        {name: 'idmoneda', type: 'string'},
        {name: 'observaciones', type: 'string'}
    ]);

    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        url: '<?=url_for("pricing/recargosPorLineaData")?>',
        baseParams : {
            impoexpo: this.impoexpo,
            transporte: this.transporte,
            modalidad: this.modalidad,
            idtrafico: this.idtrafico
        },
        reader: new Ext.data.JsonReader(
            {
                root: 'data',
                totalProperty: 'total',
                successProperty: 'success'
            },
            this.record
        )/*,
        sortInfo:{field: 'id', direction: "ASC"}*/
    });

    this.expander = new Ext.grid.RowExpander({
        lazyRender : false,
        width: 15,
        tpl : new Ext.Template(
          '<p><div >&nbsp;&nbsp; {observaciones}</div></p>'

        )
    });

    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false});

    this.columns = [        
        this.expander,        
		this.checkColumn		,
		
		{
			header: "Linea",
			width: 100,
			sortable: false,
			hideable: false,
			dataIndex: 'linea',
			editor: this.editorLineas
		},
		{
			header: "Recargo",
			width: 150,
			sortable: false,
			hideable: false,
			dataIndex: 'recargo',
			editor: this.editorConceptos
			
		},
        /*<?
		/*,
		<?
		if( $idtrafico=="99-999" && $transporte==Constantes::MARITIMO ){
		?>
		{
			header: "Concepto",
			width: 100,
			sortable: false,
			hideable: false,
			dataIndex: 'concepto'
			<?
			if( $nivel>0 ){
			?>
			,
			editor: comboConceptos
			<?
			}
			?>
		}
		,
		<?
		}*/
		?>*/
        {
			header: "Inicio",
			width: 80,
			sortable: false,
			groupable: false,
			dataIndex: 'inicio',
			renderer: Ext.util.Format.dateRenderer('Y/m/d'),
			editor: new Ext.form.DateField({
				format: 'Y/m/d'
			})
		},{
			header: "Venc.",
			width: 80,
			sortable: false,
			groupable: false,
			dataIndex: 'vencimiento',
			renderer: Ext.util.Format.dateRenderer('Y/m/d'),
			editor: new Ext.form.DateField({
				format: 'Y/m/d'
			})
		}
		,
		{
			header: "Valor",
			width: 50,
			sortable: false,
			hideable: false,
			dataIndex: 'vlrrecargo',
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:false,
						allowNegative: false,
						decimalPrecision :3
			})
		},
		{
			header: "Aplicación",
			width: 80,
			sortable: false,
			hideable: false,
			dataIndex: 'aplicacion'
			<?
			/*if( $nivel>0 ){
			?>
			,
			editor: <?=include_component("widgets", "aplicaciones" ,array("id"=>"", "transporte"=>$transporte ))?>
			<?
			}*/
			?>
		}
		/*<?
		/*if( $modalidad!="FCL" ){
		?>
		,
		{
			header: "Mínimo",
			width: 50,
			sortable: true,
			hideable: false,
			dataIndex: 'vlrminimo',
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:true,
						allowNegative: false,
						decimalPrecision :3
			})
		},
		{
			header: "Aplicación Mín.",
			width: 80,
			sortable: false,
			hideable: false,
			dataIndex: 'aplicacion_min'
			<?
			if( $nivel>0 ){
			?>
			,
			editor: <?=include_component("widgets", "aplicaciones" ,array("id"=>"", "transporte"=>$transporte ))?>
			<?
			}
			?>
		}
		<?
		}*/
		?>*/
		,
		{
			id: 'idmoneda',
			header: "Moneda",
			width: 40,
			sortable: false,
			dataIndex: 'idmoneda',
			hideable: false,
			editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>			
		}
		

	];

    if( !this.readOnly ){
        this.tbar = [
            {
                text: 'Guardar Cambios',
                tooltip: 'Guarda los cambios realizados en el tarifario',
                iconCls:'disk',  // reference to our css
                scope: this,
                handler: this.guardar
            },
            {
                text: 'Seleccionar todo',
                tooltip: 'Selecciona todas las ciudades',
                iconCls:'tick',  // reference to our css
                scope: this,
                handler: this.seleccionarTodo
            }
        ];
    }else{
        this.tbar = [
            {
                text: 'Seleccionar todo',
                tooltip: 'Selecciona todas las ciudades',
                iconCls:'tick',  // reference to our css
                scope: this,
                handler: this.seleccionarTodo
            }
        ];
    }

    PanelRecargosPorLinea.superclass.constructor.call(this, {
        clicksToEdit: 1,
        loadMask: {msg:'Cargando...'},
        stripeRows: true,
        //autoExpandColumn: 'nconcepto',
        title: 'Rec',
        height: 500,
        plugins: [this.checkColumn, this.expander],
        closable: true,        
        tbar: this.tbar,
        view: new Ext.grid.GridView({
             forceFit :true

        }),
        listeners:{
            rowcontextmenu: this.onRowContext,
            afteredit: this.onAfterEdit,
            click: this.onClickHandler,
            validateedit: this.onValidateEdit

        }
    });


    var store = this.store;
    var idtrafico = this.idtrafico;
    var readOnly = this.readOnly;
    
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        if( readOnly ){
            return false;
        }else{
            var record = store.getAt(rowIndex);
            var field = this.getDataIndex(colIndex);
            
            if(idtrafico!="99-999"){                
                if( !record.data.idlinea && field!="linea" ){
                    return false;
                }
                if( record.data.idlinea && field=="linea" ){
                    return false;
                }
            }else{
                if( !record.data.idrecargo && field!="recargo" ){
                    return false;
                }

                if( record.data.idrecargo && field=="recargo" ){
                    return false;
                }
            }

            return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);

        }
    }
}


Ext.extend(PanelRecargosPorLinea, Ext.grid.EditorGridPanel, {

    /*
    * Handler que se dispara despues de editar una celda
    */
    onAfterEdit: function(e) {

        /**
        * Copia los datos a las columnas seleccionadas
        **/
        if(e.record.data.sel){
            var records = this.store.getModifiedRecords();
            var lenght = records.length;
            var field = e.field;

            for( var i=0; i< lenght; i++){
                r = records[i];
                if(r.data.sel){
                    if ( (field == 'linea')) {
                        continue;
                    }
                    r.set(field,e.value);

                    if ( (field == 'recargo')) {
                        r.set("idrecargo",e.record.data.idrecargo);
                    }

                }
            }
        }
    },

    /*
    * Handler que se encarga de colocar el dato recargo_id en el Record
    * cuando se inserta un nuevo recargo
    */
    onValidateEdit: function(e){

        if( e.field == "recargo"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;
            var idlinea = this.idlinea;
            store.each( function( r ){
                    if( r.data.idrecargo==e.value ){
                        
                        if(this.idtrafico=="99-999"){
                        
                            if( !rec.data.idrecargo  ){
                                /*
                                * Crea una columna en blanco adicional para permitir
                                * agregar mas items
                                */
                                var newRec = new record({
                                    id: rec.data.id+1,
                                   idtrafico: rec.data.idtrafico,
                                   idlinea: idlinea,
                                   linea: '+',
                                   idrecargo: '',
                                   recargo: '',
                                   vlrrecargo: '',
                                   vlrminimo: '',
                                   aplicacion: '',
                                   aplicacion_min: '',
                                   idmoneda: '',
                                   observaciones: ''
                                });
                                newRec.id = rec.data.id+1;
                                //Inserta una columna en blanco al final
                                storeRecargos.addSorted(newRec);

                            }
                        
                        }
                        
                        rec.set("idconcepto", '9999');
                        rec.set("concepto", 'Aplica para todos');
                        rec.set("idrecargo", r.data.idrecargo);
                        rec.set("idmoneda", "USD");
                        e.value = r.data.recargo;
                        return true;
                    }
                }
            )
        }

        if( e.field == "concepto"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            store.each( function( r ){
                    if( r.data.idconcepto==e.value ){
                        rec.set("idconcepto", r.data.idconcepto);

                        e.value = r.data.concepto;
                        return true;
                    }
                }
            )
        }

        if( e.field == "linea"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            store.each( function( r ){
                    if( r.data.idlinea==e.value ){
                        
                        if(this.idtrafico!="99-999"){
                        
                            if( !rec.data.idlinea  ){
                                /*
                                * Crea una columna en blanco adicional para permitir
                                * agregar mas items
                                */
                                var newRec = new record({
                                    id: rec.data.id+1,
                                   idtrafico: rec.data.idtrafico,
                                   idlinea: '',
                                   linea: '+',
                                   idrecargo: '',
                                   recargo: '',
                                   vlrrecargo: '',
                                   vlrminimo: '',
                                   aplicacion: '',
                                   aplicacion_min: '',
                                   idmoneda: '',
                                   observaciones: ''
                                });
                                newRec.id = rec.data.id+1;
                                //Inserta una columna en blanco al final
                                storeRecargos.addSorted(newRec);

                            }
                        }
                        
                        rec.set("idconcepto", '9999');
                        rec.set("concepto", 'Aplica para todos');
                        rec.set("idlinea", r.data.idlinea);
                        rec.set("idmoneda", "USD");
                        e.value = r.data.linea;
                        return true;
                    }
                }
            )
        }
    },

    /**
    * Muestra una ventana donde se pueden editar las observaciones
    **/
    onClickHandler:  function(e) {
        var btn = e.getTarget('.btnComentarios');
        if (btn) {
            var t = e.getTarget();
            var v = this.view;
            var rowIdx = v.findRowIndex(t);
            var record = this.getStore().getAt(rowIdx);

            activeRow = rowIdx;
            Ext.MessageBox.show({
               title: 'Observaciones',
               msg: 'Por favor coloque las observaciones:',
               width:300,
               buttons: Ext.MessageBox.OKCANCEL,
               multiline: true,
               fn: actualizarObservaciones,
               animEl: 'mb3',
               value: record.get("observaciones")
           });
        }
    },

    /*
    * Coloca las observaciones en pantalla y actualiza el datastore
    */
    actualizarObservaciones: function( btn, text ){
        if( btn=="ok" ){
            var record = store.getAt(activeRow);
            record.set("observaciones", text);

            document.getElementById("obs_"+record.get("_id")).innerHTML  = "<b>Observaciones:</b> "+text;
        }
    },

    guardar: function(){
        var success = true;
        var records = storeRecargos.getModifiedRecords();

        var lenght = records.length;
        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();

            changes['id']=r.id;
            changes['idlinea']=r.data.idlinea;
            changes['idrecargo']=r.data.idrecargo;
            changes['idmoneda']=r.data.idmoneda;
            if(changes['inicio']){
                changes['inicio']=Ext.util.Format.date(changes['inicio'],'Y-m-d');
            }

            if(changes['vencimiento']){
                changes['vencimiento']=Ext.util.Format.date(changes['vencimiento'],'Y-m-d');
            }
            
            if( this.idtrafico=="99-999" && this.transporte=="<?=Constantes::MARITIMO?>" ){
                changes['idconcepto']=r.data.idconcepto;
            }
            
            //envia los datos al servidor
            Ext.Ajax.request(
                {
                    waitMsg: 'Guardando cambios...',
                    url: '<? //url_for("pricing/observeRecargosPorLinea?idtrafico=".$idtrafico."&modalidad=".$modalidad."&impoexpo=".utf8_encode($impoexpo))?>',
                    //Solamente se envian los cambios
                    params :	changes,

                    callback :function(options, success, response){

                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.id && res.success){
                            var rec = storeRecargos.getById( res.id );
                            rec.set("sel", false); //Quita la seleccion de todas las columnas
                            rec.commit();
                        }
                    }


                 }
            );
            r.set("sel", false);//Quita la seleccion de todas las columnas
        }
    },

    /*
    * Menu contextual que se despliega sobre una fila con el boton derecho
    */
    onRowContext: function(grid, index, e){

        if( typeof(this.menu) !="undefined" ){
            this.menu.removeAll( true );
        }
        rec = this.store.getAt(index);
        this.menu = new Ext.menu.Menu({
        id:'grid_recargos-ctx',
        items: [
                {
                    text: 'Eliminar item',
                    iconCls: 'delete',
                    scope:this,
                    handler: function(){
                        if( this.ctxRecord && this.ctxRecord.data.idrecargo ){
                            var id = this.ctxRecord.id;
                            var idlinea = this.ctxRecord.data.idlinea;
                            var idrecargo = this.ctxRecord.data.idrecargo;
                            var idconcepto = this.ctxRecord.data.idconcepto;

                            if( idrecargo && confirm("Esta seguro?") ){

                                Ext.Ajax.request(
                                {
                                    waitMsg: 'Guardando cambios...',
                                    url: '<? //url_for("pricing/eliminarRecargosPorLinea?idtrafico=".$idtrafico."&modalidad=".$modalidad."&impoexpo=".utf8_encode($impoexpo))?>',
                                    //method: 'POST',
                                    //Solamente se envian los cambios
                                    params :	{
                                        idlinea: idlinea,
                                        idrecargo: idrecargo,
                                        idconcepto: idconcepto,
                                        id: id

                                    },


                                    callback :function(options, success, response){

                                        var res = Ext.util.JSON.decode( response.responseText );

                                        if( res.id && res.success){
                                            var rec = storeRecargos.getById( res.id );
                                            storeRecargos.remove(rec);
                                        }
                                    }


                                });
                            }
                        }
                    }
                }
                ]
        });
        //this.menu.on('hide', this.onContextHide, this);

        e.stopEvent();
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
        this.ctxRecord = rec;
        this.ctxRow = this.view.getRow(index);
        Ext.fly(this.ctxRow).addClass('x-node-ctx');
        this.menu.showAt(e.getXY());

    },


    seleccionarTodo: function(){
        storeRecargos.each( function(r){
                r.set("sel", true);
            }
        );
    }



  
});
</script>
