<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
/**
 * PanelFletesPorTrayecto object definition
 **/

PanelFletesPorTrayecto = function( config ){
    Ext.apply(this, config);
    
    /*
    *Store que carga los conceptos
    */
    this.storeConceptos = new Ext.data.Store({
        autoLoad : false,
        url: '<?=url_for("conceptos/datosConceptos")?>',
        baseParams : {
            impoexpo: this.impoexpo,
            transporte: this.transporte,
            modalidad: this.modalidad,
            readOnly: this.readOnly
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
        mode: 'local',
        displayField: 'concepto',
        valueField: 'idconcepto',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : this.storeConceptos        
    });


    this.storeEquipos = new Ext.data.Store({
        autoLoad : true,
        url: '<?=url_for("conceptos/datosConceptos")?>',
        baseParams : {
            impoexpo: "<?=Constantes::IMPO?>",
            transporte: "<?=Constantes::MARITIMO?>",
            modalidad: "<?=Constantes::FCL?>",
            readOnly: this.readOnly
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

    this.editorEquipos = new Ext.form.ComboBox({
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
        store : this.storeEquipos
    });

    


    /*
    * Crea el Record
    */
    this.record = Ext.data.Record.create([
        {name: 'consecutivo', type: 'int'},
        {name: 'idtrayecto', type: 'int'},
        {name: 'nconcepto', type: 'string'},
        {name: 'idlinea', type: 'string'},
        {name: 'origen', type: 'string'},
        {name: 'destino', type: 'string'},
        {name: 'trayecto', type: 'string'},
        {name: 'inicio', type: 'date', dateFormat:'Y-m-d'},
        {name: 'vencimiento', type: 'date', dateFormat:'Y-m-d'},
        {name: 'moneda', type: 'string'},
        {name: 'iditem', type: 'int'},
        {name: 'idconcepto', type: 'int'},
        {name: 'equipo', type: 'string'},
        {name: 'idequipo', type: 'int'},
        {name: 'observaciones', type: 'string'},
        {name: 'aplicacion', type: 'string'},
        {name: 'aplicacion_min', type: 'string'},
        {name: 'sel', type: 'bool'},
        {name: 'ttransito', type: 'string'},
        {name: 'frecuencia', type: 'string'},
        {name: 'style', type: 'string'}	,
        {name: 'tipo', type: 'string'}	,
        {name: 'neta', type: 'float'}	,
        {name: 'minima', type: 'float'},
        {name: 'sugerida', type: 'float'},
        {name: 'consecutivo', type: 'int'},
        {name: 'orden', type: 'string'},
        {name: 'actualizado', type: 'string'},
        {name: 'pkBlocked', type: 'bool'},
        {name: 'deleted', type: 'bool'},
        {name: 'fchdeleted', type: 'string'},
        {name: 'netnet', type: 'string'}

    ]);



    /*
    * Crea el store
    */
    
    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        
        baseParams : {
            impoexpo: this.impoexpo,
            transporte: this.transporte,
            modalidad: this.modalidad,
            idtrafico: this.idtrafico,
            idlinea: this.idlinea,
            idciudad: this.idciudad,
            idciudad2: this.idciudad2,
            timestamp: this.timestamp,
            fechacambio: this.fechacambio,
            horacambio: this.horacambio
        },
        reader: new Ext.data.JsonReader(
            {                
                root: 'data',
                totalProperty: 'total',
                successProperty: 'success'
            },
            this.record
        ),
        proxy: new Ext.data.HttpProxy({
            method: 'POST',
            url: '<?=url_for("pricing/datosPanelFletesPorTrayecto")?>',
            timeout: 90000
        }),
        sortInfo:{field: 'orden', direction: "ASC"},
        groupField: 'trayecto'        
    });


    /*
    * Crea la columna de chequeo
    */
    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false});

    /*
    * Crea el expander
    */
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
        },
        getBodyContent : function(record, index){

            if(!this.enableCaching){
                return this.tpl.apply(record.data);
            }
            var content = this.bodyContent[record.id];
            //if(!content){  //hace que los comentarios no se borren cuando se guarda
                content = this.tpl.apply(record.data);

                //alert( content.split("\n").join("<br />") );
                this.bodyContent[record.id] = content;
            //}
            return content;
        },
        renderer : function(v, p, record){
            if( record.data.tipo=='concepto' ){
                return '';
            }
            p.cellAttr = 'rowspan="2"';
            return '<div class="x-grid3-row-expander">&#160;</div>';
        }        
    });


    /*
    * Template to render tooltip
    */
    /*this.qtipTpl=new Ext.XTemplate(
			 '<h3>Observaciones:</h3>'
			,'<tpl for=".">'
			,'<div>{observaciones}</div>'
            ,'<div ><h3>Actualicion #</h3> {consecutivo} {actualizado}</div>'
			,'</tpl>'
    );*/

        
    this.mostrarEquipo = false;    
    if( (this.transporte=="<?=Constantes::TERRESTRE?>"|| this.transporte=="<?=Constantes::OTMDTA?>") && (this.modalidad=="<?=Constantes::FCL?>"||this.modalidad=="<?=Constantes::ADUANAFCL?>")  ){
        this.mostrarEquipo = true;
    }

    this.columns = [
		this.expander,
		this.checkColumn,
		{
                    id: 'concepto', //para aplicar estilos a esta columna
                    header: "Concepto",
                    width: 200,
                    sortable: false,
                    groupable: false,
                    hideable: false,
                    dataIndex: 'nconcepto',
                    hideable: false,
                    renderer: this.renderConcepto ,
                    editor: this.editorConceptos
		},
                {
                    id: 'equipo', //para aplicar estilos a esta columna
                    header: "Equipo",
                    width: 200,
                    sortable: false,
                    groupable: false,
                    hideable: false,
                    dataIndex: 'equipo',
                    hideable: false,
                    hidden: !this.mostrarEquipo,
                    renderer: this.renderConcepto ,
                    editor: this.editorEquipos
		},
		{
			id: 'trayecto',
			header: "Trayecto",
			width: 100,
			sortable: true,
			dataIndex: 'trayecto',
			hideable: false ,
			hidden: true
		},
		{
			header: "Inicio",
			width: 80,
			sortable: false,
			groupable: false,
            hideable: false,
			dataIndex: 'inicio',
			renderer: Ext.util.Format.dateRenderer('Y/m/d'),
			editor: new Ext.form.DateField({
				format: 'Y/m/d'
			})
		},{
			header: "Venc.",
			width: 80,
			sortable: false,
            hideable: false,
			groupable: false,
			dataIndex: 'vencimiento',
			renderer: Ext.util.Format.dateRenderer('Y/m/d'),
			editor: new Ext.form.DateField({
				format: 'Y/m/d'
			})
		}
		,{
			id: 'neta',
			header: "Neta",
			width: 80,
			sortable: false,
            hideable: false,
			groupable: false,
			dataIndex: 'neta',
            renderer: this.renderNumber,
			editor: new Ext.form.NumberField( {decimalPrecision :3} )
		}
		,
		{
			id: 'sugerida',
			header: "Sugerida",
			width: 80,
			sortable: false,
            hideable: false,
			groupable: false,
			dataIndex: 'sugerida',
            renderer: this.renderNumber,
			editor: new Ext.form.NumberField( {decimalPrecision :3} )
		}
		,
		{
			header: "Aplicación",
			width: 100,
			sortable: false,
            hideable: false,
			groupable: false,
			dataIndex: 'aplicacion',
			editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>


		},		
		{
			id: 'minima',
			header: "Minima",
			width: 80,
			sortable: false,
            hideable: false,
			groupable: false,
			dataIndex: 'minima',
            renderer: this.renderNumber,
			editor: new Ext.form.NumberField({decimalPrecision :3})
		},
		{
			header: "Aplicación Min.",
			width: 100,
			sortable: false,
            hideable: false,
			groupable: false,            
			dataIndex: 'aplicacion_min',
			editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>

		},
		{
			header: "Moneda",
			width: 80,
			sortable: false,
            hideable: false,
			groupable: false,
			dataIndex: 'moneda',
			editor: <?=include_component("widgets", "monedas")?>
		}
        /*,{
			header: "Orden",
			width: 80,
			sortable: false,
			groupable: false,
			dataIndex: 'orden'
		}*/

	];

    this.groupGrillaTpl =  '{text} <tpl if="values.rs[0].data[\'netnet\'].indexOf(\'1\')!= -1"><span class=\'rojo\'>NET-NET</span> </tpl>'+'<tpl if="values.rs[0].data[\'style\'].indexOf(\'1\')!= -1"><img src="/images/yellow_group.gif" /> </tpl>'+' <tpl if="values.rs[0].data[\'style\'].indexOf(\'2\')!= -1"><img src="/images/pink_group.gif" /> </tpl>';

    if( !this.readOnly ){
        this.tbar = [
            {
                text: 'Guardar Cambios',
                tooltip: 'Guarda los cambios realizados en el tarifario',
                iconCls: 'disk',  // reference to our css
                scope: this,
                handler: this.guardar
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
        this.tbar = {
                text: 'Recargar',
                tooltip: 'Actualiza los datos',
                iconCls:'refresh',  // reference to our css
                scope: this,
                handler: this.recargar
            };
    }

    PanelFletesPorTrayecto.superclass.constructor.call(this, {

        clicksToEdit: 1,
        loadMask: {msg:'Cargando...'},
        stripeRows: true,
        autoExpandColumn: 'nconcepto',

        plugins: [this.checkColumn, this.expander],
        closable: true,
        width: 780,
        height: 400,        
        
        view: new Ext.grid.GroupingView({
            forceFit:true,
            enableRowBody:true,
            enableGroupingMenu: false,
            startCollapsed : true,
            groupTextTpl: this.groupGrillaTpl,
            emptyText: 'No hay datos'  
            
        }),
        listeners:{
            rowcontextmenu: this.onRowContextMenu,
            afteredit: this.onAfterEdit,
            dblclick : this.onDblclick,
            validateedit: this.onValidateEdit,
            beforeedit: this.onBeforeEdit
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

            if( record.data.tipo=="recargoxciudad" ){                
                return false;
            }

            if( record.data.tipo=="concepto" && record.data.iditem=='9999' ){
                return false;
            }

            if( record.data.tipo=="concepto" && field=='equipo' && (record.data.consecutivo || record.data.pkBlocked ) ){
                return false;
            }
            
            if( record.data.tipo=="concepto"){
                if( (field=='nconcepto' && record.data.iditem) || !(field=='nconcepto' || field=='equipo' || field=='neta' || field=='sugerida'||field=='inicio' || field=='vencimiento' || field=='moneda'|| field=='aplicacion')  ){

                    return false;
                }
            }

            if( record.data.tipo=="recargo"){
                if( (field=='nconcepto' && record.data.iditem) || !( field=='nconcepto' || field=='equipo' || field=='sugerida' || field=='minima' || field=='moneda'|| field=='aplicacion'|| field=='aplicacion_min'|| field=='inicio' || field=='vencimiento')  ){
                    return false;
                }

                if( field=='equipo' && record.data.consecutivo ){
                    return false;
                }
            }



            if( record.data.tipo=="trayecto_obs"   ){
                return false;
            }

            return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);       
       }
       
    }


}

Ext.extend(PanelFletesPorTrayecto, Ext.grid.EditorGridPanel, {
    

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
                    if( !(r.data.tipo=="concepto"||r.data.tipo=="recargo") ){
                        continue;
                    }
                    if (r.data.recargo_id && (field == 'aplicacion'||field == 'inicio'||field == 'vencimiento')) {
                        continue;
                    }

                    if(field == 'nconcepto'){
                        r.set("iditem",e.record.data.iditem);
                    }
                    r.set(field,e.value);
                }
            }
        }
    },

    /*
    * Handler que se encarga de colocar el dato recargo_id en el Record
    * cuando se inserta un nuevo recargo
    */
    onValidateEdit: function(e){
        if( e.field == "nconcepto"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);

            var store = ed.field.store;
            store.each( function( r ){
                    if( r.data.idconcepto==e.value ){
                        e.value = r.data.concepto;
                        rec.set("iditem", r.data.idconcepto);                        
                        return true;
                    }
                }
            );
        }


        if( e.field == "equipo"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);

            var store = ed.field.store;
            store.each( function( r ){
                    if( r.data.idconcepto==e.value ){
                        e.value = r.data.concepto;
                        rec.set("idequipo", r.data.idconcepto);
                        return true;
                    }
                }
            );
        }
    },
    
    /*
    * Cambia los conceptos del editor
    */
    onBeforeEdit: function(e){
        var rec = e.record;
        if( e.field=="nconcepto" ){
            if( rec.data.tipo == "concepto" ){
                this.storeConceptos.setBaseParam('modo', 'concepto');
            }

            if( rec.data.tipo == "recargo" ){
                this.storeConceptos.setBaseParam('modo', 'recargos');
                this.storeConceptos.setBaseParam('tipo', '<?=Constantes::RECARGO_EN_ORIGEN?>');
            }
            this.storeConceptos.load();
        }

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

    /**
    * Muestra una ventana donde se pueden editar las observaciones
    **/
    onDblclick: function(e) {
        if( !this.readOnly ){
            var btn = e.getTarget('.btnComentarios');
            if (btn) {
                var t = e.getTarget();
                var v = this.view;
                var rowIdx = v.findRowIndex(t);
                store = this.getStore();
                var record = this.getStore().getAt(rowIdx);
                activeRow = rowIdx;

                Ext.MessageBox.show({
                   title: 'Observaciones',
                   msg: 'Por favor coloque las observaciones:',
                   width:300,
                   buttons: Ext.MessageBox.OKCANCEL,
                   multiline: true,
                   fn: this.actualizarObservaciones,
                   animEl: 'mb3',
                   value: record.get("observaciones")
               });
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

        rec = grid.store.getAt(index);
        e.stopEvent(); //Evita que se despliegue el menu con el boton izquierdo
        
        if(!this.menu){
            if( !this.readOnly ){
                this.menu = new Ext.menu.Menu({
                    enableScrolling : false,
                    items: [
                    <?
                    if($nivel=="1")
                    {
                    ?>
                    {
                            text: 'Editar Trayecto',
                            iconCls: 'add',
                            scope:this,
                            handler: function(){
                                //alert(this.ctxRecord.toSource())
                                record=this.ctxRecord;
                                panelTrayecto= new PanelTrayectoWindow({idtrayecto:record.data.idtrayecto});
                                panelTrayecto.show();

                                fp= Ext.getCmp("trayecto-form");
                                fp.getForm().load(
                                {
                                    url:'<?=url_for("pricing/datosTrayecto")?>',
                                    waitMsg:'cargando...',
                                    params:{idtrayecto:record.data.idtrayecto},
                                    success:function(response,options){
                                        this.res = Ext.util.JSON.decode( options.response.responseText );
                                        
                                       
                                        Ext.getCmp("origen").setValue(res.data.ciudad_origen); 
                                        Ext.getCmp("origen").hiddenField.value=res.data.ciu_origen;
                                        
                                        Ext.getCmp("destino").setValue(res.data.ciudad_destino);
                                        Ext.getCmp("destino").hiddenField.value=res.data.ciu_destino;

                                        Ext.getCmp("idlinea").setValue(res.data.linea);
                                        Ext.getCmp("idlinea").hiddenField.value=res.data.idlinea;

                                        Ext.getCmp("idagente").setValue(res.data.agente);
                                        Ext.getCmp("idagente").hiddenField.value=res.data.idagente;
                                        
                                        Ext.getCmp("idlinea").setDisabled(true);
                                        Ext.getCmp("origen").setDisabled(true);
                                        Ext.getCmp("destino").setDisabled(true);
                                        Ext.getCmp("impoexpo").setDisabled(true);
                                        Ext.getCmp("transporte").setDisabled(true);
                                        Ext.getCmp("modalidad").setDisabled(true);
                                    }
                                });                                
                            }
                        },
                    <?
                    }
                    ?>
                        {
                            text: 'Nuevo concepto',
                            iconCls: 'add',
                            scope:this,
                            handler: function(){
                                if( this.ctxRecord.data.tipo=="trayecto_obs" ){
                                    Ext.MessageBox.alert("Atención","No puede agregar un concepto sobre las observaciones");
                                    return 0;
                                }
                                this.agregarFila(this.ctxRecord, index, 'concepto');
                            }
                        },
                        {
                            text: 'Nuevo recargo',
                            iconCls: 'add',
                            scope:this,
                            handler: function(){
                                if( this.ctxRecord.data.tipo=="trayecto_obs" ){
                                    Ext.MessageBox.alert("Atención","No puede agregar un recargo sobre las observaciones");
                                    return 0;
                                }
                                this.agregarFila(this.ctxRecord, index, 'recargo');
                            }
                        },
                        {
                            text: 'Estado',
                            menu: {
                                items: [
                                    {
                                        text: 'Normal',
                                        checked: rec.get("style")==""?true:false,
                                        group: 'theme',
                                        scope: this,
                                        handler: function(){
                                            this.colocarEstilo( rec , "");
                                        }
                                    }, {
                                        text: 'Sugerida',
                                        checked: rec.get("style")=="yellow"?true:false,
                                        group: 'theme',
                                        scope: this,
                                        handler: function(){
                                            this.colocarEstilo( rec , "yellow");
                                        }
                                    }, {
                                        text: 'Mantenimiento',
                                        checked: rec.get("style")=="pink"?true:false,
                                        group: 'theme',
                                        scope: this,
                                        handler: function(){
                                            this.colocarEstilo( rec , "pink");
                                        }
                                    }, {
                                        text: 'Futura',
                                        checked: rec.get("style")=="green"?true:false,
                                        group: 'theme',
                                        scope: this,
                                        handler: function(){
                                            this.colocarEstilo( rec , "green");
                                        }
                                    }
                                ]
                            }
                        },

                        {
                            text: 'Eliminar',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                                this.eliminarFila(this.ctxRecord, index);
                            }
                        },
                        {
                            text: 'Seleccionar trayecto',
                            iconCls: 'new-tab',
                            scope:this,
                            handler: function(){
                                var trayecto = this.ctxRecord.data.trayecto;
                                grid.store.each(function(r){
                                    if( r.data.trayecto==trayecto){
                                        r.set('sel', true);
                                    }
                                });

                            }
                        },
                        {
                            text: 'Seleccionar este concepto',
                            iconCls: 'new-tab',
                            scope:this,
                            handler: this.seleccionarConcepto
                        },

                        {
                            text: 'Control de cambios',
                            iconCls: 'calendar_view_week',
                            scope:this,
                            handler: function(){
                                    this.ventanaControlCambios(this.ctxRecord, index);                                    
                            }
                        }
                    ]
                });
            }else{
                this.menu = new Ext.menu.Menu({

                    enableScrolling : false,
                    items: [
                        {
                            text: 'Seleccionar trayecto',
                            iconCls: 'new-tab',
                            scope:this,
                            handler: function(){
                                var trayecto = this.ctxRecord.data.trayecto;
                                grid.store.each(function(r){
                                    if( r.data.trayecto==trayecto){
                                        r.set('sel', true);
                                    }
                                });
                            }
                        },
                        {
                            text: 'Seleccionar este concepto',
                            iconCls: 'new-tab',
                            scope:this,
                            handler: this.seleccionarConcepto
                        },
                        {
                            text: 'Control de cambios',
                            iconCls: '',
                            scope:this,
                            handler: function(){
                                    this.ventanaControlCambios(this.ctxRecord, index);                                    
                            }
                        }
                    ]
                });

            }
        }
        this.menu.on('hide', this.onContextHide, this);

        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
        this.ctxRecord = rec;
        this.ctxRow = this.view.getRow(index);
        Ext.fly(this.ctxRow).addClass('x-node-ctx');
        this.menu.showAt(e.getXY());

    },

    /*
    * Coloca las observaciones en pantalla y actualiza el datastore
    */
    actualizarObservaciones: function( btn, text ){
        if( btn=="ok" ){            
            var record = store.getAt(activeRow);
            record.set("observaciones", text);

            var records = store.getModifiedRecords();
            var lenght = records.length;

            for( var i=0; i< lenght; i++){
                r = records[i];
                if(r.data.sel){
                    r.set("observaciones", text);
                }
            }

        }
    },

    /*
    * actualiza el estilo en una celda y en las celdas seleccionadas
    */
    colocarEstilo: function( rec,  val ){


        rec.set("style", val);

        if( rec.data.sel ){
            var records = this.store.getModifiedRecords();
            var lenght = records.length;

            for( var i=0; i< lenght; i++){
                r = records[i];
                if(r.data.sel && r.data.tipo=="concepto"){
                    r.set("style", val);
                }
            }
        }
    },


    seleccionarConcepto: function(){
        var iditem = this.ctxRecord.data.iditem;
        var tipo = this.ctxRecord.data.tipo;
        var idconcepto = this.ctxRecord.data.idconcepto;

        this.store.each(function(r){
            if( tipo=="concepto" ){
                if( r.data.iditem==iditem && r.data.tipo==tipo ){
                    if( !(r.data.neta=="" && r.data.sugerida=="") ){//Evita que se seleccionen escalas que no se han creado por que no se necesitan

                        r.set('sel', true);
                    }
                }
            }

            if( tipo=="recargo" ){
                if( r.data.iditem==iditem && r.data.idconcepto==idconcepto && r.data.tipo==tipo ){
                    r.set('sel', true);
                }
            }
        });

    },

    renderConcepto: function(value, metaData, record, rowIndex, colIndex, store){        
        var data = record.data;
        var tpAd = record.data.fchdeleted?'<tpl if="fchdeleted"><div ><h3>Eliminado: </h3>{fchdeleted}</div></tpl>':'</tpl>';
        
        var qtipTpl=new Ext.XTemplate(
            '<h3>Observaciones:</h3>'
           ,'<tpl for=".">'
           ,'<div>{observaciones}</div>'
           ,'<div ><h3>Actualización # {consecutivo}: </h3>{actualizado}</div>'+tpAd
        );
       
        var qtip = qtipTpl.apply(data);



        switch(  record.data.tipo ){
            case 'trayecto_obs':
                return '<div ext:qtip="' + qtip +'"><b>'+value+'</b></div>';
                break;
            case 'concepto':
                return '<div ext:qtip="' + qtip +'"><b>'+value+'</b></div>';
                break;
            case 'recargo':
                
                if( colIndex==2 ){
                    return '<div ext:qtip="' + qtip +'" class="recargo">'+value+'</div>';
                }else{
                    return '<div ext:qtip="' + qtip +'" >'+value+'</div>';
                }
                break;
            case 'recargoxciudad':
                return '<div ext:qtip="' + qtip +'" class="recargo">'+value+'</div>';
                break;

        }

    },

    eliminarFila: function(ctxRecord, index){
        if( confirm("Esta seguro?") ){
            var store = this.store;
            var params = ctxRecord.getChanges();

            params['idtrayecto'] = ctxRecord.data.idtrayecto;

            if( ctxRecord.data.tipo=='concepto' ){
                params['idconcepto'] = ctxRecord.data.iditem;
                params['idrecargo'] = null;
            }

            if( ctxRecord.data.tipo=='recargo' ){
                params['idconcepto'] = ctxRecord.data.idconcepto;
                params['idrecargo'] = ctxRecord.data.iditem;
            }

            params['idequipo'] = ctxRecord.data.idequipo;

            params['tipo'] = ctxRecord.data.tipo;
            params['id'] = ctxRecord.id;

            Ext.Ajax.request(
                {
                    waitMsg: 'Eliminando...',
                    url: '<?=url_for("pricing/eliminarPanelFletesPorTrayecto")?>',
                    method: 'POST',
                    //Solamente se envian los cambios
                    params :	params,

                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){

                            if( ctxRecord.data.tipo=='concepto' ){
                                store.each(
                                    function(r){
                                        if(r.id == res.id){
                                            var rec = store.getById( res.id );
                                            store.remove( rec );
                                            rec.set("deleted", true);
                                        }
                                        if(r.data.tipo=="recargo"&& r.data.idconcepto && r.data.idtrayecto == res.idtrayecto && r.data.idconcepto == res.idconcepto ){

                                            var rec = store.getById( r.id );
                                            store.remove( rec );
                                            rec.set("deleted", true);
                                        }
                                    }
                                );
                            }
                            if( ctxRecord.data.tipo=='recargo' ){
                                var rec = store.getById( res.id );
                                store.remove( rec );
                                rec.set("deleted", true);
                            }

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
    },

    agregarFila: function(ctxRecord, index, tipo){

        if( tipo=='recargo' ){
            var orden = ctxRecord.get("orden")+'Z';
        }else{
            var orden = 888+this.store.getCount();
        }
        idconcepto = null;
        
        if( ctxRecord.get("tipo")=="concepto" ){
            idconcepto = ctxRecord.get("iditem");
        }
        if( ctxRecord.get("tipo")=="recargo" ){
            idconcepto = ctxRecord.get("idconcepto");
        }

        //alert( ctxRecord.get("trayecto") );
        var rec = new this.record({trayecto:ctxRecord.get("trayecto"),
                              consecutivo:'',
                              nconcepto:'',
                              iditem:'',
                              idequipo: ctxRecord.get("idequipo"),
                              equipo:'',
                              idconcepto: idconcepto,
                              idtrayecto:ctxRecord.get("idtrayecto"),
                              trayecto:ctxRecord.get("trayecto"),
                              ttransito:ctxRecord.get("ttransito"),
                              frecuencia:ctxRecord.get("frecuencia"),
                              moneda:'USD',
                              neta:'',
                              minima:'',
                              aplicacion:'',
                              aplicacion_min:'',
                              tipo:tipo,
                              orden:orden,
                              pkBlocked: false //Indica si ya se agrego un recargo, encaso que no se haya guardado evita inconsistencias
                            });


        this.store.addSorted(rec);
        ctxRecord.set("pkBlocked", true);
    },
    
    recargar: function(){
        if( this.store.getModifiedRecords().length>0){
            if(!confirm("Se perderan los cambios no guardados en el directorio de agentes unicamente, desea continuar?")){
                return 0;
            }
        }
        this.store.reload();
    },

    guardar: function(){

        if( this.readOnly ){
            return false;
        }
        
        var store = this.store;
        var records = store.getModifiedRecords();
        var lenght = records.length;

        for( var i=0; i< lenght; i++){
            r = records[i];
            if(!r.data.moneda && (r.data.tipo=="concepto"||r.data.recargo=="concepto") ){
                if( r.data.iditem!=9999){
                    Ext.MessageBox.alert('Warning','Por favor coloque la moneda en todos los items');
                    return 0;
                }
            }
        }

        for( var i=0; i< lenght; i++){
            r = records[i];

            if(r.data.deleted){
                continue;
            }

            if(r.data.tipo!="trayecto_obs"){
                if(r.data.iditem=="9999"){
                    continue;
                }

                if( !r.data.iditem ){
                    continue;
                }
            }

            var changes = r.getChanges();

            //Da formato a las fechas antes de enviarlas
            if(changes['inicio']){
                changes['inicio']=Ext.util.Format.date(changes['inicio'],'Y-m-d');
            }

            if(changes['vencimiento']){
                changes['vencimiento']=Ext.util.Format.date(changes['vencimiento'],'Y-m-d');
            }

            changes['id']=r.id;
            changes['tipo']=r.data.tipo;
            changes['consecutivo']=r.data.consecutivo;
            changes['iditem']=r.data.iditem;
            changes['idconcepto']=r.data.idconcepto;
            changes['idequipo']=r.data.idequipo;
            changes['idtrayecto']=r.data.idtrayecto;
            changes['moneda']=r.data.moneda;
            
            //envia los datos al servidor
            Ext.Ajax.request({                
                waitMsg: 'Guardando cambios...',
                url: '<?=url_for("pricing/guardarPanelFletesPorTrayecto")?>', 						//method: 'POST',
                //Solamente se envian los cambios
                params :	changes,               
                
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                       
                        if( res.id ){
                            var rec = store.getById( res.id );
                            rec.set("consecutivo", res.consecutivo);
                            rec.set("actualizado", res.actualizado);
                            rec.set("sel", false); //Quita la seleccion de todas las columnas
                            rec.commit();
                        }

                    }else{
                        Ext.MessageBox.alert('Error', "Ha ocurrido el siguiente error"+res.errorInfo);
                    }
                },
                failure:function(response,options){
                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                }

            });
        }
    },


    /*
    * Muestra todos los cambios realizados en el trayecto
    */
    ventanaControlCambios: function( record , index ){
        var params = {
                        impoexpo: this.impoexpo,
                        idtrafico: this.idtrafico,
                        transporte: this.transporte,
                        modalidad: this.modalidad,
                        idlinea: record.data.idlinea,
                        idciudad: record.data.origen,
                        idciudad2: record.data.destino,
                        title: this.title,
                        readOnly: true,
                        closable: true
                     };
        win = new Ext.Window({
            width       : 400,
            height      : 200,
            closeAction :'close',
            plain       : true,

            items       : [new Ext.FormPanel({
                id: 'historial-form',
                layout: 'form',
                frame: true,
                title: 'Historial del Tarifario',
                autoHeight: true,
                labelWidth: 100,

                items: [{
                            xtype:'datefield',
                            fieldLabel: 'Fecha',
                            id: 'fecha-cambio',
                            name: 'fecha-cambio',
                            value: '',
                            format: 'Y-m-d',
                            allowBlank:false,
                            width: 150
                        },
                        {
                            xtype:'timefield',
                            fieldLabel: 'Hora',
                            id: 'hora-cambio',
                            name: 'hora-cambio',
                            value: '',
                            format: "H:i:s",
                            allowBlank:false,
                            width: 150
                        }
                    ]
            })],

            buttons: [{
                text     : 'Continuar',
                handler: function(){
                    var fp = Ext.getCmp("historial-form");
                    var fechacambio = fp.getForm().findField("fecha-cambio").getRawValue().split("-").join("|");;
                    var horacambio = fp.getForm().findField("hora-cambio").getValue();

                    if( fp.getForm().isValid() ){
                        params["title"]+=fp.getForm().findField("fecha-cambio").getRawValue()+" "+horacambio;
                        params["fechacambio"] = fechacambio;
                        params["horacambio"] = horacambio;
                        var newComponent = new PanelFletesPorTrayecto(
                                                                    params
                                                                    );
                        Ext.getCmp('tab-panel').add(newComponent);
                        Ext.getCmp('tab-panel').setActiveTab(newComponent);
                        win.close();                       

                    }else{
                        Ext.MessageBox.alert('Error:', '¡Atención: La información no es válida o está incompleta!');
                    }
                }
            },{
                text     : 'Cancelar',
                handler  : function(){
                    win.close();
                }
            }]
        });
        win.show();
     },


     /*
     *
     */
     renderNumber: function( v ){        
        if( v!=0 ){
            return v;
        }else{
            return "";
        }

     }


});
</script>