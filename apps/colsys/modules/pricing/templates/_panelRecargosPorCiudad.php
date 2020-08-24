<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">
/**
 * PanelRecargosPorCiudad object definition
 **/

PanelRecargosPorCiudad = function( config ){
    Ext.apply(this, config);

    /*
    *Store que carga los conceptos
    */
    this.storeCiudades = new Ext.data.Store({
        autoLoad : false,
        url: '<?=url_for("pricing/datosEditorCiudades")?>',        
        baseParams : {            
            idtrafico: this.idtrafico

        },
        reader: new Ext.data.JsonReader(
            {                
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'idciudad'},
                {name: 'ciudad'}
            ])
        )
    });

    this.editorCiudades = new Ext.form.ComboBox({
		typeAhead: true,
		forceSelection: true,
		triggerAction: 'all',
		emptyText:'Seleccione',
		selectOnFocus: true,
		lazyRender:true,
		allowBlank: false,
		listClass: 'x-combo-list-small',
		valueField:'idciudad',
		displayField:'ciudad',
		mode: 'local',
		store : this.storeCiudades

	});

    /*
    *Store que carga los conceptos
    */
    this.storeRecargos = new Ext.data.Store({
        autoLoad : false,
        url: '<?=url_for("conceptos/datosConceptos")?>',
        baseParams : {
            impoexpo: this.impoexpo,
            transporte: this.transporte,
            modalidad: this.modalidad

        },
        reader: new Ext.data.JsonReader(
            {                
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

    this.editorRecargos = new Ext.form.ComboBox({

        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        name: 'recargo',        
        mode: 'local',
        displayField: 'concepto',
        valueField: 'idconcepto',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : this.storeRecargos

    });


    this.record = Ext.data.Record.create([
        {name: 'sel', type: 'string'},
        {name: 'id', type: 'int'},
        {name: 'consecutivo', type: 'int'},
        {name: 'idtrafico', type: 'string'},
        {name: 'idciudad', type: 'string'},
        {name: 'impoexpo', type: 'string'},
        {name: 'ciudad', type: 'string'},
        {name: 'idrecargo', type: 'string'},
        {name: 'recargo', type: 'string'},
        {name: 'facturacion', type: 'string'},
        {name: 'idconcepto', type: 'string'},
        {name: 'concepto', type: 'string'},
        {name: 'inicio', type: 'date', dateFormat:'Y-m-d'},
        {name: 'vencimiento', type: 'date', dateFormat:'Y-m-d'},
        {name: 'vlrrecargo', type: 'float'},
        {name: 'vlrminimo', type: 'float'},
        {name: 'aplicacion', type: 'string'},
        {name: 'aplicacion_min', type: 'string'},
        {name: 'idmoneda', type: 'string'},
        {name: 'observaciones', type: 'string'},
        {name: 'idlinea', type: 'string'},
        {name: 'linea', type: 'string'},
        {name: 'aplicaciones', type: 'string'},
        {name: 'deleted', type: 'bool'}
    ]);



    /*
    * Crea el store
    */
    <?
    /*$url = "?modalidad=".$modalidad."&transporte=".utf8_encode($transporte)."&idtrafico=".$idtrafico."&impoexpo=".utf8_encode($impoexpo);
    if( $opcion=="consulta" ){
        $url.= "&opcion=consulta";
    }	*/
    ?>
    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        url: '<?=url_for("pricing/datosPanelRecargosPorCiudad")?>',
        baseParams : {
            impoexpo: this.impoexpo,
            transporte: this.transporte,
            modalidad: this.modalidad,
            idtrafico: this.idtrafico,
            idcotizacion: this.idcotizacion, //Si se llama de una cotizacion se mezcla con los recargos por naviera
            readOnly: this.readOnly
        },
        reader: new Ext.data.JsonReader(
            {
                root: 'data',
                totalProperty: 'total',
                successProperty: 'success'
            },
            this.record
        ),
        groupField: 'aplicaciones'
        //,sortInfo:{field: 'id', direction: "ASC"}
    });

    this.storeConceptos = new Ext.data.Store({
        autoLoad : false,
        url: '<?=url_for("pricing/datosEditorConceptos")?>',
        baseParams : {
            impoexpo: this.impoexpo,
            transporte: this.transporte,
            modalidad: this.modalidad
        },
        reader: new Ext.data.JsonReader(
            {
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
        mode: 'local',
        displayField: 'concepto',
        valueField: 'idconcepto',
        listClass: 'x-combo-list-small',
        lazyRender:true,
        store : this.storeConceptos

    });


    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false});
    var ocultarCiudad = false;
    if( this.idtrafico=="99-999" ){
        ocultarCiudad = true;
    }

    this.expander = new Ext.grid.RowExpander({
        lazyRender : true,
        width: 15,
        tpl : new Ext.Template(
            '<p><div style="position: relative;">  <div class=\'btnComentarios\' id=\'obs_{_id}\' style=\'z-index: 1000\'>&nbsp; {observaciones}</div> </div></p>'
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
		this.checkColumn,
		{
			header: "Ciudad",
			width: 100,
			sortable: false,
                        hidden: ocultarCiudad,
			hideable: false,
			dataIndex: 'ciudad',
			editor: this.editorCiudades
		},
        {
			header: "Recargo",
			width: 100,
			sortable: false,
			hideable: false,
			dataIndex: 'recargo',
			editor: this.editorRecargos
		}
        ,

        {
			header: "Concepto",
			width: 100,
			sortable: false,
			hideable: false,
            hidden: <?=(isset($ocultarConcepto) && $ocultarConcepto!="" )?$ocultarConcepto:"false"?>,
			dataIndex: 'concepto',
			editor: this.editorConceptos

		}
      ,
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
			dataIndex: 'aplicacion',
			editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
		},
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
						decimalPrecision : 3
			})
		},
		{
			header: "Aplicación Mín.",
			width: 80,
			sortable: false,
			hideable: false,            
			dataIndex: 'aplicacion_min',
            editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
		},
		{
			id: 'idmoneda',
			header: "Moneda",
			width: 40,
			sortable: false,
			dataIndex: 'idmoneda',
			hideable: false,
			editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
			
		},
        {
			id: 'linea',
			header: "Linea",
			width: 100,
			sortable: false,
			dataIndex: 'linea',
			hideable: false,
            hidden: this.idcotizacion?false:true

		},
        {
            header: "Clasificación",
            width: 80,
            sortable: false,
            hideable: false,
            dataIndex: 'aplicaciones'			
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
                iconCls:'tick',  // reference to our css
                scope: this,
                handler: this.seleccionarTodo
            },
            {
                text: 'Recargar',
                tooltip: 'Actualiza los datos',
                iconCls:'refresh',  // reference to our css
                scope: this,
                handler: this.recargar
            }
        ];
    }else{
        this.tbar = [
            {
                text: 'Seleccionar todo',                
                iconCls:'tick',  // reference to our css,
                scope: this,
                handler: this.seleccionarTodo
            }
        ];
    }

    PanelRecargosPorCiudad.superclass.constructor.call(this, {
        clicksToEdit: 1,
        loadMask: {msg:'Cargando...'},
        stripeRows: true,
        height: 400,
        width: 780,
        plugins: [this.checkColumn, this.expander], //expander,
        closable: true,
        view: new Ext.grid.GroupingView({
             forceFit :true,
             enableNoGroups:false,
             hideGroupedColumn: true
        }),
        listeners:{
            rowcontextmenu: this.onRowContextMenu,
            afteredit: this.onAfterEdit,            
            validateedit: this.onValidateEdit,
            beforeedit: this.onBeforeEdit,
            dblclick: this.onDblclick
        },
        tbar: this.tbar
    });



    var store = this.store;
    var readOnly = this.readOnly;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        if( readOnly ){
            return false;        
        }else{        

            var record = store.getAt(rowIndex);
            var field = this.getDataIndex(colIndex);
            
            if( this.idtrafico!="99-999" ){

                if( !record.data.idciudad && field!="ciudad" ){
                    return false;
                }
/*
                if( record.data.idciudad && field=="ciudad" ){
                    return false;
                }
*/
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

    this.actualizarEditores();
    
}

Ext.extend(PanelRecargosPorCiudad, Ext.grid.EditorGridPanel, {
    /*
    * Carga los datos de los recargos y las ciudades
    */
    actualizarEditores: function(){
        if( !this.readOnly ){
            if( this.idtrafico=="99-999" ){
                this.storeRecargos.setBaseParam('modo', 'recargos');
                this.storeRecargos.setBaseParam('tipo', '<?=Constantes::RECARGO_LOCAL?>');
            }else{
                this.storeRecargos.setBaseParam('modo', 'recargos');
                this.storeRecargos.setBaseParam('tipo', '<?=Constantes::RECARGO_EN_ORIGEN?>');

                this.storeCiudades.load();
            }

            this.storeRecargos.load();
        }
    },
    /*
    * Cambia los conceptos del editor
    */
    onBeforeEdit: function(e){
        //var rec = e.record;
        

        if( e.field=="aplicacion" || e.field=="aplicacion_min" ){
            var dataAereo = [
                <?
                $i=0;
                foreach( $aplicacionesAereo as $aplicacion ){
                    if( $i++!=0){
                        echo ",";
                    }
                ?>
                    ['<?=$aplicacion->getCaValor()?>']
                <?
                }
                ?>
            ];

            var dataMaritimo = [
                <?
                $i=0;
                foreach( $aplicacionesMaritimo as $aplicacion ){
                    if( $i++!=0){
                        echo ",";
                    }
                ?>
                    ['<?=$aplicacion->getCaValor()?>']
                <?
                }
                ?>
            ];

            var ed = this.colModel.getCellEditor(e.column, e.row);
            if( this.transporte=="<?=Constantes::AEREO?>" ){
                ed.field.store.loadData( dataAereo );
            }else{
                ed.field.store.loadData( dataMaritimo );
            }
        }
    },

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
                if(r.data.sel && r.data.idrecargo ){
                    if ( (field == 'ciudad')) {
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
        var record = this.record;
        var storeRecargos = this.store;
        var idtrafico = this.idtrafico;
        if( e.field == "recargo"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            store.each( function( r ){
                    if( r.data.idconcepto==e.value ){
                        
                        if( idtrafico=="99-999" ){                            
                            if( !rec.data.idrecargo  ){
                                /*
                                * Crea una columna en blanco adicional para permitir
                                * agregar mas items
                                */
                                var newRec = new record({
                                   id: rec.data.id+1,
                                   idtrafico: rec.data.idtrafico,
                                   idciudad: '999-9999',
                                   ciudad: '',
                                   idrecargo: '',
                                   recargo: '+',
                                   vlrrecargo: '',
                                   vlrminimo: '',
                                   aplicacion: '',
                                   aplicacion_min: '',
                                   idmoneda: '',
                                   observaciones: '',
                                   aplicaciones: ''
                                });
                                newRec.id = rec.data.id+1;
                                //Inserta una columna en blanco al final
                                storeRecargos.addSorted(newRec);

                            }
                        }
                        
                        rec.set("idrecargo", r.data.idconcepto);
                        if( !rec.get("idmoneda") ){
                            rec.set("idmoneda", "COP");
                        }
                        e.value = r.data.concepto;
                        return true;
                    }
                }
            )
        }

        if( e.field == "ciudad"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            store.each( function( r ){
                    if( r.data.idciudad==e.value ){
                        
                        if( this.idtrafico!="99-999" ){
                        
                            if( !rec.data.idciudad  ){
                                /*
                                * Crea una columna en blanco adicional para permitir
                                * agregar mas items
                                */
                                var newRec = new record({
                                    
                                   idtrafico: rec.data.idtrafico,
                                   idciudad: '',
                                   ciudad: '+',
                                   idrecargo: '',
                                   recargo: '',
                                   vlrrecargo: '',
                                   vlrminimo: '',
                                   aplicacion: '',
                                   aplicacion_min: '',
                                   idmoneda: '',
                                   observaciones: '',
                                    aplicaciones: ''
                                });                                
                                //Inserta una columna en blanco al final
                                storeRecargos.addSorted(newRec);
                            }                        
                        }
                        
                        rec.set("idciudad", r.data.idciudad);
                        rec.set("idmoneda", "USD");
                        e.value = r.data.ciudad;
                        return true;
                    }
                }
            )
        }

    },


    

    guardar: function(){
        if( !this.readOnly ){
            storeRecargos = this.store;
            var records = storeRecargos.getModifiedRecords();

            var lenght = records.length;
            for( var i=0; i< lenght; i++){
                r = records[i];
                if(r.data.deleted){
                    continue;
                }

                if( r.data.idrecargo ){
                    var changes = r.getChanges();
                    changes['id']=r.id;
                    changes['consecutivo']=r.data.consecutivo;
                    changes['idtrafico']=this.idtrafico;
                    changes['modalidad']=this.modalidad;
                    changes['transporte']=this.transporte;
                    changes['impoexpo']=this.impoexpo;
                    changes['idciudad']=r.data.idciudad;
                    changes['idrecargo']=r.data.idrecargo;
                    changes['idmoneda']=r.data.idmoneda;


                    //Da formato a las fechas antes de enviarlas
                    if(changes['inicio']){
                        changes['inicio']=Ext.util.Format.date(changes['inicio'],'Y-m-d');
                    }

                    if(changes['vencimiento']){
                        changes['vencimiento']=Ext.util.Format.date(changes['vencimiento'],'Y-m-d');
                    }

                    if( r.data.idciudad && r.data.idrecargo ){

                        //envia los datos al servidor
                        Ext.Ajax.request(
                            {
                                waitMsg: 'Guardando cambios...',
                                url: '<?=url_for("pricing/guardarPanelRecargosPorCiudad")?>',
                                //Solamente se envian los cambios
                                params :	changes,

                                success:function(response,options){

                                    var res = Ext.util.JSON.decode( response.responseText );
                                    if( res.id && res.success){
                                        var rec = storeRecargos.getById( res.id );
                                        rec.set("sel", false); //Quita la seleccion de todas las columnas
                                        rec.commit();
                                    }else{
                                        Ext.MessageBox.alert('Error', "Ha ocurrido el siguiente error"+res.errorInfo);
                                    }
                                },
                                failure:function(response,options){
                                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                                }


                             }
                        );
                    }
                    r.set("sel", false);//Quita la seleccion de todas las columnas
                }
            }
        }
    },

    /*
    * Menu contextual que se despliega sobre una fila con el boton derecho
    */
    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    },
    onRowContextMenu: function(grid, index, e){
        if( !this.readOnly ){
            rec = this.store.getAt(index);

            var idtrafico = this.idtrafico;
            var modalidad = this.modalidad;
            var impoexpo = this.impoexpo;
            var transporte = this.transporte;
            var storeRecargos = this.store;
            if( !this.menu ){
                this.menu = new Ext.menu.Menu({
                        items: [
                        {
                            text: 'Eliminar item',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                                if( this.ctxRecord && this.ctxRecord.data.idrecargo ){


                                    var id = this.ctxRecord.id;
                                    var idciudad = this.ctxRecord.data.idciudad;
                                    var idrecargo = this.ctxRecord.data.idrecargo;

                                    if( idrecargo && confirm("Esta seguro?") ){

                                        Ext.Ajax.request(
                                        {
                                            waitMsg: 'Guardando cambios...',
                                            url: '<?=url_for("pricing/eliminarPanelRecargosPorCiudad")?>',
                                            //method: 'POST',
                                            //Solamente se envian los cambios
                                            params :	{
                                                idtrafico: idtrafico,
                                                modalidad: modalidad,
                                                impoexpo: impoexpo,
                                                transporte: transporte,
                                                idciudad: idciudad,
                                                idrecargo: idrecargo,
                                                id: id

                                            },


                                            success:function(response,options){

                                                var res = Ext.util.JSON.decode( response.responseText );

                                                if( res.id && res.success){
                                                    var rec = storeRecargos.getById( res.id );
                                                    storeRecargos.remove(rec);
                                                    rec.set("deleted", true);
                                                }else{
                                                    Ext.MessageBox.alert('Error', "Ha ocurrido el siguiente error"+res.errorInfo);
                                                }
                                            },
                                            failure:function(response,options){
                                                Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
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

    seleccionarTodo: function(){
        this.store.each( function(r){
                if( r.data.idrecargo ){
                    r.set("sel", true);
                }
            }
        );
    }
    ,
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
                {
                    buttons= Ext.MessageBox.OKCANCEL;
                }
                else
                {
                    buttons= Ext.MessageBox.CANCEL;
                }
                console.log(buttons);
                
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
    },
    recargar: function(){
        this.store.reload();
    }



});
</script>