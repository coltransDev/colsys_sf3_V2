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
        this.storeLineas = new Ext.data.Store({
            autoLoad : true,
            url: '<?= url_for("pricing/datosEditorLineas") ?>',
            baseParams : {
                impoexpo: this.impoexpo,
                transporte: this.transporte,
                modalidad: this.modalidad,
                idtrafico: this.idtrafico
            },
            reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'idlinea'},
                {name: 'linea'}
            ])
        )
        });

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
            store: this.storeLineas

        });
    
        /*
         *Store que carga los conceptos
         */
        this.storeRecargos = new Ext.data.Store({
            autoLoad : false,
            url: '<?= url_for("conceptos/datosConceptos") ?>',
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
            mode: 'local',
            displayField: 'concepto',
            valueField: 'idconcepto',
            lazyRender:true,
            listClass: 'x-combo-list-small',
            store : this.storeRecargos

        });

        /*
         *Store que carga los conceptos
         */
        this.storeConceptos = new Ext.data.Store({
            autoLoad : false,
            url: '<?= url_for("pricing/datosEditorConceptos") ?>',
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

        /*
         * Crea el Record
         */
        this.record = Ext.data.Record.create([
            {name: 'sel', type: 'string'},
            {name: 'id', type: 'int'},
            {name: 'consecutivo', type: 'int'},
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
            {name: 'observaciones', type: 'string'},
            {name: 'aplicaciones', type: 'string'},
            {name: 'deleted', type: 'bool'}
        ]);

        this.store = new Ext.data.GroupingStore({
            autoLoad : true,
            url: '<?= url_for("pricing/datosPanelRecargosPorLinea") ?>',
            baseParams : {
                impoexpo: this.impoexpo,
                transporte: this.transporte,
                modalidad: this.modalidad,
                idtrafico: this.idtrafico,
                idlinea: this.idlinea,
                readOnly: this.readOnly,
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
        groupField: 'aplicaciones'    
        /*,
        sortInfo:{field: 'id', direction: "ASC"}*/
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

        this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false});

        var ocultarConcepto = true;
        if( this.idtrafico=="99-999"  ){
            ocultarConcepto = false;
        }
    
    
        this.columns = [        
            this.expander,        
            this.checkColumn,		
            {
                header: "Linea",
                width: 100,
                sortable: false,
                hideable: false,
                dataIndex: 'linea',
                hidden: !ocultarConcepto,
                editor: this.editorLineas
            },
            {
                header: "Recargo",
                width: 150,
                sortable: false,
                hideable: false,
                dataIndex: 'recargo',
                editor: this.editorRecargos
			
            },        
            {
                header: "Concepto",
                width: 100,
                sortable: false,
                hideable: false,
                hidden: ocultarConcepto,
                dataIndex: 'concepto',
                editor: this.editorConceptos
			
            },
		
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
                editor: <?= include_component("widgets", "emptyCombo", array("id" => "")) ?>
			
            }		
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
                dataIndex: 'aplicacion_min',
                editor: <?= include_component("widgets", "emptyCombo", array("id" => "")) ?>
			
            }		
            ,
            {
                id: 'idmoneda',
                header: "Moneda",
                width: 40,
                sortable: false,
                dataIndex: 'idmoneda',
                hideable: false,
                editor: <?= include_component("widgets", "monedas", array("id" => "")) ?>			
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
                    tooltip: 'Selecciona todas las ciudades',
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
                    tooltip: 'Selecciona todas las ciudades',
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
        }

        PanelRecargosPorLinea.superclass.constructor.call(this, {
            clicksToEdit: 1,
            loadMask: {msg:'Cargando...'},
            stripeRows: true,   
            height: 500,
            plugins: [this.checkColumn, this.expander],             
            tbar: this.tbar,
            view: new Ext.grid.GroupingView({
                forceFit :true,
                enableNoGroups:false,
                hideGroupedColumn: true
            }),
            listeners:{
                rowcontextmenu: this.onRowContext,
                beforeedit: this.onBeforeEdit,
                afteredit: this.onAfterEdit,            
                validateedit: this.onValidateEdit,
                dblclick: this.onDblclick
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
                    /*
                if( record.data.idlinea && field=="linea" ){
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
                    
                    if( record.data.consecutivo && field=="concepto" ){
                        return false;
                    }
                    
                }

                return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);

            }
        }

        this.actualizarEditores();
    }


    Ext.extend(PanelRecargosPorLinea, Ext.grid.EditorGridPanel, {
        /*
         * Carga los datos de los recargos y las ciudades
         */
        actualizarEditores: function(){
            if( !this.readOnly ){
                this.storeRecargos.setBaseParam('modo', 'recargos');
                if( this.idtrafico=="99-999" ){
                    this.storeRecargos.setBaseParam('tipo', '<?= Constantes::RECARGO_LOCAL ?>');
                    this.storeConceptos.load();
                }else{
                    if( this.impoexpo=="<?= Constantes::IMPO ?>" && this.transporte=="<?= Constantes::MARITIMO ?>" ){
                        this.storeRecargos.setBaseParam('tipo', '<?= Constantes::RECARGO_LOCAL ?>');
                    }else{
                        this.storeRecargos.setBaseParam('tipo', '<?= Constantes::RECARGO_EN_ORIGEN ?>');
                    }
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
$i = 0;
foreach ($aplicacionesAereo as $aplicacion) {
    if ($i++ != 0) {
        echo ",";
    }
    ?>
                                        ['<?= $aplicacion->getCaValor() ?>']
    <?
}
?>
                                ];

                                var dataMaritimo = [
<?
$i = 0;
foreach ($aplicacionesMaritimo as $aplicacion) {
    if ($i++ != 0) {
        echo ",";
    }
    ?>
                                        ['<?= $aplicacion->getCaValor() ?>']
    <?
}
?>
                                ];
            
                                var dataParametros = new Array();


<?
$i = 0;
foreach ($parametros as $aplicacion) {
    ?>                    
                                    if('<?= strtolower(trim($aplicacion->getCaValor())) ?>'==e.record.data.recargo.replace(/^\s*|\s*$/g,"").toLowerCase())
                                    {                        
    <?
    $rangos = explode("|", $aplicacion->getcaValor2());
    foreach ($rangos as $rango) {
        ?>
                                                    dataParametros.push('<?= $rango ?>');
        <?
    }
    //break;
    ?>
                            
                                            }
    <?
}
?>
            

                                var ed = this.colModel.getCellEditor(e.column, e.row);
                                //alert(e.record.data.toSource());
                                //alert(e.record.data.recargo);
                                if(dataParametros.length>0)
                                {
                                    ed.field.store.loadData( dataParametros );                
                                }
                                else if( this.transporte=="<?= Constantes::AEREO ?>" ){
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
                            var record = this.record;
                            var storeRecargos = this.store;
                            if( e.field == "recargo"){
                                var rec = e.record;
                                var ed = this.colModel.getCellEditor(e.column, e.row);
                                var store = ed.field.store;
                                var idlinea = this.idlinea; 
                                var idtrafico = this.idtrafico;           
                                store.each( function( r ){
                                    if( r.data.idconcepto==e.value ){
                        
                                        if(idtrafico=="99-999"){
                        
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
                                                    observaciones: '',
                                                    aplicaciones: ''
                                                });
                                                newRec.id = rec.data.id+1;
                                                //Inserta una columna en blanco al final
                                                storeRecargos.addSorted(newRec);

                                            }
                        
                                        }
                        
                                        rec.set("idconcepto", '9999');
                                        rec.set("concepto", 'Todos los conceptos');
                                        rec.set("idrecargo", r.data.idconcepto);
                                        rec.set("idmoneda", "USD");
                                        e.value = r.data.concepto;
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
                                var idtrafico = this.idtrafico;
                                store.each( function( r ){
                                    if( r.data.idlinea==e.value ){
                        
                                        if(idtrafico!="99-999"){
                        
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
                                                    observaciones: '',
                                                    aplicaciones: ''
                                                });
                                                newRec.id = rec.data.id+1;
                                                //Inserta una columna en blanco al final
                                                storeRecargos.addSorted(newRec);
                                            }
                                        }
                        
                                        rec.set("idconcepto", '9999');
                                        rec.set("concepto", 'Todos los conceptos');
                                        rec.set("idlinea", r.data.idlinea);
                                        rec.set("idmoneda", "USD");
                                        e.value = r.data.linea;
                                        return true;
                                    }
                                }
                            )
                            }
                        },

                        guardar: function(){
                            if( !this.readOnly ){
                                storeRecargos = this.store;
                                var success = true;
                                var records = storeRecargos.getModifiedRecords();

                                var lenght = records.length;
                                for( var i=0; i< lenght; i++){
                                    r = records[i];

                                    if(r.data.deleted){
                                        continue;
                                    }

                                    var changes = r.getChanges();

                                    changes['id']=r.id;
                                    changes['consecutivo']=r.data.consecutivo;
                                    changes['idtrafico']=this.idtrafico;
                                    changes['modalidad']=this.modalidad;
                                    changes['impoexpo']=this.impoexpo;
                                    changes['transporte']=this.transporte;
                                    changes['idlinea']=r.data.idlinea;
                                    changes['idrecargo']=r.data.idrecargo;
                                    changes['idconcepto']=r.data.idconcepto;
                                    changes['idmoneda']=r.data.idmoneda;
                                    if(changes['inicio']){
                                        changes['inicio']=Ext.util.Format.date(changes['inicio'],'Y-m-d');
                                    }

                                    if(changes['vencimiento']){
                                        changes['vencimiento']=Ext.util.Format.date(changes['vencimiento'],'Y-m-d');
                                    }

                                    if( this.idtrafico=="99-999" && this.transporte=="<?= Constantes::MARITIMO ?>" ){
                                        changes['idconcepto']=r.data.idconcepto;
                                    }

                                    if( r.data.idlinea && r.data.idrecargo ){
                                        //envia los datos al servidor
                                        Ext.Ajax.request(
                                        {
                                            waitMsg: 'Guardando cambios...',
                                            url: '<?= url_for("pricing/guardarPanelRecargosPorLinea") ?>',
                                            //Solamente se envian los cambios
                                            params :	changes,

                                            success:function(response,options){

                                                var res = Ext.util.JSON.decode( response.responseText );
                                                if( res.id && res.success){
                                                    var rec = storeRecargos.getById( res.id );
                                                    rec.set("sel", false); //Quita la seleccion de todas las columnas
                                                    rec.set("consecutivo", 1);//Para evitar que editen las llaves primarias                                                    
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
                        onRowContext: function(grid, index, e){
                            var items = [{
                                    text: 'Control de cambios',
                                    iconCls: 'calendar_view_week',
                                    scope:this,
                                    handler: function(){
                                        this.ventanaControlCambios(this.ctxRecord, index);
                                    }
                                }];

                            if( !this.readOnly ){
                                items.push({
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
                                                    url: '<?= url_for("pricing/eliminarPanelRecargosPorLinea") ?>',
                                                    //method: 'POST',
                                                    //Solamente se envian los cambios
                                                    params :	{
                                                        idtrafico: idtrafico,
                                                        modalidad: modalidad,
                                                        impoexpo: impoexpo,
                                                        transporte: transporte,
                                                        idlinea: idlinea,
                                                        idrecargo: idrecargo,
                                                        idconcepto: idconcepto,
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
                                });


                            }
                            rec = this.store.getAt(index);
                            var idtrafico = this.idtrafico;
                            var modalidad = this.modalidad;
                            var impoexpo = this.impoexpo;
                            var transporte = this.transporte;
                            var storeRecargos = this.store;
                            if( !this.menu ){
                                this.menu = new Ext.menu.Menu({
                                    items: items
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
        
                        },

                        seleccionarTodo: function(){
                            this.store.each( function(r){
                                if( r.data.idrecargo ){
                                    r.set("sel", true);
                                }
                            }
                        );
                        },

                        recargar: function(){
                            this.store.reload();
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
                         * Coloca las observaciones en pantalla y actualiza el datastore
                         */
                        actualizarObservaciones: function( btn, text ){
                            if( btn=="ok" ){
                                var record = store.getAt(activeRow);
                                record.set("observaciones", text);

                                //document.getElementById("obs_"+record.get("_id")).innerHTML  = "<b>Observaciones:</b> "+text;
                            }
                        },

                        /*
                         * Muestra todos los cambios realizados en el trayecto
                         */
                        ventanaControlCambios: function( record , index ){

                            if( this.trafico ){
                                var title = "Recargos x linea "+this.impoexpo.substring(0, 4)+"»"+this.transporte+"»"+this.modalidad+"»"+this.trafico+"»";
                            }else{
                                var title = "Recargos Locales x linea "+this.impoexpo.substring(0, 4)+"»"+this.transporte+"»"+this.modalidad+"»"+"»";
                            }

                            var params = {
                                impoexpo: this.impoexpo,
                                idtrafico: this.idtrafico,
                                transporte: this.transporte,
                                modalidad: this.modalidad,
                                idlinea: record.data.idlinea,
                                idciudad: record.data.origen,
                                idciudad2: record.data.destino,
                                title: title,
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
                                                var newComponent = new PanelRecargosPorLinea(
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
                        }
                    });
</script>
