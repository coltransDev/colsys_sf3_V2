<?
/*
 * Permite crear trayectos en la cotización e incluir diferentes
 * opciones de fletes y recargos
 * @author: Andres Botero
 */
include_component("pricing", "panelFletesPorTrayecto");
include_component("cotizaciones", "panelTrayectoWindow", array("cotizacion" => $cotizacion));
include_component("cotizaciones", "panelTrayectoForm", array("cotizacion" => $cotizacion));
?>
<script type="text/javascript">

    var activeRecord = null;
    var tipo = null;
    var id = null;
    PanelProductos = function(config){
        Ext.apply(this, config);
        this.storeConceptos = new Ext.data.Store({
            autoLoad : false,
            url: '<?= url_for("conceptos/datosConceptos") ?>',
            reader: new Ext.data.JsonReader({
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'idconcepto'},
                {name: 'concepto'},
                {name: 'aka'}
            ])
            )
        });
        
        this.storeEquipos = new Ext.data.Store({
            autoLoad : true,
            url: '<?= url_for("conceptos/datosConceptos") ?>',
            baseParams:{
                transporte:"<?= Constantes::MARITIMO ?>",
                modalidad:"<?= Constantes::FCL ?>",
                impoexpo:"<?= Constantes::IMPO ?>"
            },
            reader: new Ext.data.JsonReader({
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
        
        this.resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{concepto}</b><br /><span>{aka}</span> </div></tpl>'
        );

        this.editorConceptos = new Ext.form.ComboBox({
            fieldLabel: 'Concepto',
            forceSelection: true,
            triggerAction: 'all',
            selectOnFocus: true,
            mode: 'local',
            displayField: 'concepto',
            valueField: 'idconcepto',
            lazyRender:true,
            tpl: this.resultTpl,
            itemSelector: 'div.search-item',
            store : this.storeConceptos
        });
                    
        this.editorEquipos = new Ext.form.ComboBox({
            fieldLabel: 'Equipo',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            selectOnFocus: true,
            name: 'equipo',
            id: 'idequipo',
            mode: 'local',
            displayField: 'concepto',
            valueField: 'idconcepto',
            lazyRender:true,
            listClass: 'x-combo-list-small',
            store : this.storeEquipos
        })

        this.record = Ext.data.Record.create([
            {name: 'sel', type: 'bool'},
            {name: 'id', type: 'int'},
            {name: 'idcotizacion', type: 'string'},
            {name: 'idproducto', type: 'string'},
            {name: 'producto', type: 'string'},
            {name: 'idopcion', type: 'string'},
            {name: 'idcotrecargo', type: 'string'},
            {name: 'trayecto', type: 'string'},
            {name: 'item', type: 'string'}, //Texto de concepto o recargo
            {name: 'iditem', type: 'string'}, //Concepto o recargo
            {name: 'idconcepto', type: 'string'}, //Concepto al cual pertenece el recargo
            {name: 'idequipo', type: 'string'}, //Concepto al cual pertenece el recargo
            {name: 'equipo', type: 'string'}, //Concepto al cual pertenece el recargo
            {name: 'tra_origen', type: 'string'},
            {name: 'tra_origen_value', type: 'string'},
            {name: 'ciu_origen', type: 'string'},
            {name: 'ciu_origen_value', type: 'string'},
            {name: 'tra_destino', type: 'string'},
            {name: 'tra_destino_value', type: 'string'},
            {name: 'ciu_destino', type: 'string'},
            {name: 'ciu_destino_value', type: 'string'},
            {name: 'tra_escala', type: 'string'},
            {name: 'tra_escala_value', type: 'string'},
            {name: 'ciu_escala', type: 'string'},
            {name: 'ciu_escala_value', type: 'string'},
            {name: 'valor_tar', type: 'float'},
            {name: 'valor_min', type: 'float'},
            {name: 'aplica_tar', type: 'string'},
            {name: 'aplica_min', type: 'string'},
            {name: 'idmoneda', type: 'string'},
            {name: 'detalles', type: 'string'},
            {name: 'tipo', type: 'string'},
            {name: 'transporte', type: 'string'},
            {name: 'modalidad', type: 'string'},
            {name: 'frecuencia', type: 'string'},
            {name: 'ttransito', type: 'string'},
            {name: 'imprimir', type: 'string'},
            {name: 'impoexpo', type: 'string'},
            {name: 'incoterms', type: 'string'},
            {name: 'observaciones', type: 'string'},
            {name: 'idlinea', type: 'string'},
            {name: 'linea', type: 'string'},
            {name: 'postular_linea', type: 'string'},
            {name: 'consecutivo', type: 'string'},
            {name: 'vigencia', type: 'date', dateFormat:'Y-m-d'},
            {name: 'orden', type: 'string'},
            {name: 'parent', type: 'int'},
            {name: 'inSave', type: 'bool'}
        ]);
        <?
            $url1 = "cotizaciones/grillaProductosData?tipo=OTM-DTA&idcotizacion=" . $cotizacion->getCaIdcotizacion();
            $url = "cotizaciones/grillaProductosData?idcotizacion=" . $cotizacion->getCaIdcotizacion();
            if ($modo == "consulta") {
                $url.="&modo=consulta";
                $url1.="&modo=consulta";
            }
            if (isset($producto)) {
                $url.="&idproducto=" . $producto->getCaIdproducto();
                $url1.="&idproducto=" . $producto->getCaIdproducto();
            }
        ?>
        this.store = new Ext.data.GroupingStore({
            autoLoad : true,
            pruneModifiedRecords:true,
            url: (this.tipo == "OTM/DTA")?'<?= url_for($url1) ?>':'<?= url_for($url) ?>',
            reader: new Ext.data.JsonReader({              
                root: 'productos',
                totalProperty: 'total'
            },
            this.record
            ),
            sortInfo:{field: 'orden', direction: "ASC"},
            groupField: 'trayecto'
        });

        this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30});

        this.columns = [
            <?
            if ($modo == "consulta") {
                ?>
                this.checkColumn,
                <?
                }
            ?>
            {
                header: "Trayecto",
                width: 100,
                sortable: false,
                dataIndex: 'trayecto',
                hideable: false,
                hidden: true
            },
            {
                header: "Concepto",
                width: 200,
                sortable: false,
                dataIndex: 'item',
                hideable: false,
                editor: this.editorConceptos,
                renderer: this.formatItem
            },
            {
                header: "Equipo",
                width: 200,
                sortable: false,
                dataIndex: 'equipo',
                hideable: false,
                editor: this.editorEquipos
            },
            {
                header: "Valor",
                width: 80,
                sortable: false,
                dataIndex: 'valor_tar',
                hideable: false,
                editor: new Ext.form.NumberField({
                    allowBlank: false,
                    allowNegative: false,
                    style: 'text-align:left',
                    decimalPrecision :3
                })
            },
            {
                header: "Aplicación",
                width: 100,
                sortable: false,
                dataIndex: 'aplica_tar',
                hideable: false,
                editor: <?= include_component("widgets", "emptyCombo", array("id" => "")) ?>
            },
            {
                header: "Minimo",
                width: 80,
                sortable: false,
                dataIndex: 'valor_min',
                hideable: false,
                editor: new Ext.form.NumberField({
                    allowBlank: false,
                    allowNegative: false,
                    style: 'text-align:left',
                    decimalPrecision :3
                })
            },
            {
                header: "Aplicación Min",
                width: 100,
                sortable: false,
                dataIndex: 'aplica_min',
                hideable: false,
                editor: <?= include_component("widgets", "emptyCombo", array("id" => "")) ?>
            },
            {
                header: "Moneda",
                width: 65,
                sortable: false,
                dataIndex: 'idmoneda',
                hideable: false,
                editor: <?= include_component("widgets", "monedas", array("id" => "")) ?>
            },
            {
                header: "Detalles",
                width: 100,
                sortable: false,
                dataIndex: 'detalles',
                hideable: false,
                editor: new Ext.form.TextField({
                    allowBlank: false,
                    style: 'text-align:left',
                    allowBlank: true
                })
            }
            <?
            if ($modo != "consulta") {
                ?>
                ,
                {
                    xtype: 'actioncolumn',
                    width: 25,
                    items: [{
                        icon   : '/images/fam/table_add.png', // Use a URL in the icon config
                        tooltip: 'Menu contextual'
                    }]
                }
                <?
            }
            ?>
        ];

        PanelProductos.superclass.constructor.call(this, {
            loadMask: {msg:'Cargando...'},
            clicksToEdit: 1,
            stripeRows: true,
            autoExpandColumn: 'producto',
            height: 400,
            root_title: 'impoexpo',
            closable: false,
            <?
            if ($modo != "consulta") {
                ?>
                tbar: [
                    {
                        text: 'Guardar Cambios',
                        tooltip: 'Guarda los cambios hechos en la base de datos.',
                        iconCls: 'disk',
                        handler: function(){
                            Ext.getCmp("subpanel-cotizaciones").guardarDatosPaneles();
                        },
                        id:'guardarbtn' + this.tipo
                    },
                    {
                        text: 'Agregar ' + this.tipo,
                        tooltip: 'Agregar un nuevo producto a la Cotización',
                        iconCls: 'add',
                        scope: this,
                        handler: function(){
                            this.agregarTrayecto();
                        }
                    },
                    {
                        text: 'Recargar',
                        tooltip: 'Recarga los datos de la base de datos',
                        iconCls: 'refresh', // reference to our css
                        scope: this,
                        handler: this.recargar
                    }
                ],
                <?
            } else {
                ?>
                plugins: [this.checkColumn],
                <?
            }
            ?>
            view: new Ext.grid.GroupingView({
                forceFit:true,
                enableRowBody:true,
                enableGroupingMenu: false,
                getRowClass: function(record, index, rowParams, storeProductos){
                    switch (record.data.style){
                        case "yellow":
                            return "row_yellow";
                            break;
                        case "pink":
                            return "row_pink";
                            break;
                        default:
                            return "";
                            break;
                    }
                }
            })
            <?
            if ($modo != "consulta") {
                ?>
                ,
                listeners:{
                    validateedit: this.onValidateEdit,
                    rowcontextmenu:this.onRowcontextmenu,
                    cellclick:this.onRowcellclick,
                    beforeedit: this.onBeforeedit
                }
                <?
            } else {
                ?>
                , boxMinHeight: 400
                <?
            }
            ?>
        });

        var storeProductos = this.store;
        this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
            <?
            if ($modo == "consulta") {
                ?>
                return false;
                <?
            }
            ?>
            var record = storeProductos.getAt(rowIndex);
            var field = this.getDataIndex(colIndex);
            if (!record.data.iditem && field != "item"){
                return false;
            }
            if (field != "item" && record.data.tipo == "concepto" && record.data.iditem == "9999"){
                return false;
            }
            if (field == "equipo" && (record.data.transporte != "<?= Constantes::TERRESTRE ?>" && record.data.transporte != "<?= Constantes::OTMDTA ?>")){
                return false;
            }
            return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
        }
    }

    Ext.extend(PanelProductos, Ext.grid.EditorGridPanel, {
        recargar: function(){
            if (this.tipo == "OTM/DTA")
                id_new = "grid_productos1";
            else
                id_new = "grid_productos";
            if (Ext.getCmp(id_new).store.getModifiedRecords().length > 0){
                if (!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
                    return 0;
                }
            }
            Ext.getCmp(id_new).store.reload();
            Ext.getCmp('guardarbtnTrayecto').enable();
            Ext.getCmp('guardarbtnOTM/DTA').enable();
        },
        guardarItems: function (){
            try{
                tipo = this.tipo;
                var storeProductos = this.store;
                var success = true;
                var records = storeProductos.getModifiedRecords();
                var lenght = records.length;
                for (var i = 0; i < lenght; i++){
                    r = records[i];
                    if (r.data.idmoneda <= 0 && r.data.iditem != "9999"){
                        r.data.idmoneda = "USD";
                    }
                    if (!r.data.idequipo && r.data.modalidad == "FCL" && r.data.transporte == "<?= Constantes::TERRESTRE ?>"){
                        alert('Por favor indique el equipo 1 del trayecto ' + r.data.trayecto, 'Alert');
                    }
                }
                var numResponses = 0;
                Ext.getCmp('guardarbtn' + tipo).disable();
                habilita = false;
                for (var i = 0; i < lenght; i++){
                    if (i == (lenght - 1))
                        habilita = true;
                    if (records[i].data.tipo == "concepto" || (records[i].data.tipo == "recargo" && records[i].data.idopcion)){
                        this.guardarGridProductosRec(records[i], habilita);
                        habilita = "S";
                    }
                }
            }
            catch (err){
                habilita = "N";
            }
            if (habilita != "S"){
                Ext.getCmp('guardarbtnTrayecto').enable();
                Ext.getCmp('guardarbtnOTM/DTA').enable();
            }
        },
        enableButton: function(){
            Ext.getCmp('guardarbtnTrayecto').enable();
            Ext.getCmp('guardarbtnOTM/DTA').enable();
        },
        guardarGridProductosRec: function(r, habilita){
            var storeProductos = this.store;
            var changes = r.getChanges();
            tipo = this.tipo;
            if (r.data.iditem && !r.data.inSave){
                changes['id'] = r.id;
                changes['parent'] = r.data.parent;
                changes['idproducto'] = r.data.idproducto;
                changes['tipo'] = r.data.tipo;
                changes['idopcion'] = r.data.idopcion;
                changes['idconcepto'] = r.data.idconcepto;
                changes['idcotrecargo'] = r.data.idcotrecargo;
                changes['iditem'] = r.data.iditem;
                changes['modalidad'] = r.data.modalidad;
                changes['idequipo'] = r.data.idequipo;
                changes['equipo'] = r.data.equipo;
                changes['idmoneda'] = r.data.idmoneda;
                changes['aplica_tar'] = r.data.aplica_tar;
                changes['aplica_min'] = r.data.aplica_min;
                r.set("inSave", true);
                Ext.Ajax.request({
                    waitMsg: 'Guardando cambios...',
                    url: '<?= url_for("cotizaciones/observeItemsOpciones?idcotizacion=" . $cotizacion->getCaIdcotizacion()) ?>',
                    params :	changes,
                    failure:function(response, options){
                        success = false;
                        r.set("inSave", false);
                        if (habilita == true){
                            Ext.getCmp('guardarbtnTrayecto').enable();
                            Ext.getCmp('guardarbtnOTM/DTA').enable();
                        }
                    },
                    callback :function(options, success, response){
                        r.set("inSave", false);
                        var res = Ext.util.JSON.decode(response.responseText);
                        var rec = storeProductos.getById(res.id);
                        rec.set("idopcion", res.idopcion);
                        if (rec.data.tipo == "concepto"){
                            if (rec.data.idopcion != 999){
                                rec.set("orden", res.idopcion);
                            } else {
                                rec.set("orden", "Y");
                            }
                            storeProductos.each(function(r){
                                if (r.data.parent && r.data.parent == rec.data.parent && r.data.tipo == "recargo"){
                                    r.data.idopcion = res.idopcion;
                                    if (res.idopcion == "999"){
                                        r.data.orden = "Y-" + r.data.item;
                                    } else {
                                        r.data.orden = res.idopcion + "-" + r.data.item;
                                    }
                                    if (r.dirty){
                                        if (r.data.transporte == "OTM-DTA")
                                            Ext.getCmp("grid_productos1").guardarGridProductosRec(r, false);
                                        else
                                            Ext.getCmp("grid_productos").guardarGridProductosRec(r, false);
                                    }
                                }
                            });
                        }
                        if (rec.data.tipo == "recargo"){
                            rec.set("idcotrecargo", res.idcotrecargo);
                        }
                        rec.commit();
                        storeProductos.sort("orden", "ASC");
                        if (habilita == true){
                            Ext.getCmp('guardarbtnTrayecto').enable();
                                Ext.getCmp('guardarbtnOTM/DTA').enable();
                        }
                    }
                });
            }
        },
        formatItem : function(value, p, record) {
            if (record.data.tipo == "recargo"){
                return String.format(
                    '<div class="recargo">{0}</div>',
                    value
                );
            } else {
                return String.format(
                    '<b>{0}</b>',
                    value
                );
            }
        },
        /*
         * Cambia el valor que se toma de los combobox y copia el valor em otra columna,
         * tambien inserta otra columna en blanco para que el usuario continue digitando
         */
        onValidateEdit: function(e){

            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;
            storeProductos = this.store;
            recordProductos = this.record;
            iditem = "-1";
            validate = true;
            tipo = this.tipo;
            storeProductos.each(function(r){
                if (r.data.tipo == "concepto" && r.data.iditem){
                    iditem = r.data.iditem;
                }
            });
            if (validate == false)
                return false;
            if (e.field == "item"){
                store.each(function(r){
                    if (r.data.idconcepto == e.value){
                        if (!rec.data.iditem && rec.data.tipo == "concepto"){
                            var newRec = new recordProductos({
                                idcotizacion: rec.data.idcotizacion,
                                idproducto: rec.data.idproducto,
                                trayecto: rec.data.trayecto,
                                transporte: rec.data.transporte,
                                modalidad: rec.data.modalidad,
                                idconcepto: rec.data.iditem,
                                idequipo: '',
                                equipo: '',
                                idopcion: rec.data.idopcion,
                                producto: rec.data.producto,
                                tra_origen: rec.data.tra_origen,
                                tra_origen_value: rec.data.tra_origen_value,
                                ciu_origen: rec.data.ciu_origen,
                                ciu_origen_value: rec.data.ciu_origen_value,
                                tra_destino: rec.data.tra_destino,
                                tra_destino_value: rec.data.tra_destino_value,
                                ciu_destino: rec.data.ciu_destino,
                                ciu_destino_value: rec.data.ciu_destino_value,
                                tra_escala: rec.data.tra_escala,
                                tra_escala_value: rec.data.tra_escala_value,
                                ciu_escala: rec.data.ciu_escala,
                                ciu_escala_value: rec.data.ciu_escala_value,
                                impoexpo: rec.data.impoexpo,
                                incoterms: rec.data.incoterms,
                                frecuencia: rec.data.frecuencia,
                                ttransito: rec.data.ttransito,
                                imprimir: rec.data.imprimir,
                                observaciones: rec.data.observaciones,
                                idlinea: '',
                                linea: '',
                                postular_linea: '',
                                vigencia: rec.data.vigencia,
                                item: '+',
                                iditem: '',
                                tipo: 'concepto',
                                valor_tar: '',
                                valor_min: '',
                                aplica_tar: '',
                                aplica_min: '',
                                idmoneda: '',
                                detalles: '',
                                orden: 'Z'
                            });
                            newRec.data.concepto = "";
                            if (r.data.idconcepto == "9999"){
                                rec.set("orden", "Y");
                                rec.set("idopcion", "999");
                                rec.set("iditem", "9999");
                                rec.commit();
                            } else {
                                rec.set("idmoneda", "USD");
                                rec.set("iditem", r.data.idconcepto);
                                rec.set("idconcepto", r.data.idconcepto);
                                rec.set("orden", "X");
                                if (tipo == "OTM/DTA")
                                    Ext.getCmp("grid_productos1").guardarGridProductosRec(rec);
                                else
                                    Ext.getCmp("grid_productos").guardarGridProductosRec(rec);
                            }
                            storeProductos.addSorted(newRec);
                            storeProductos.sort("orden", "ASC");
                        } else if (e.field == "equipo"){
                            store.each(function(r){
                                if (r.data.idconcepto == e.value){
                                    rec.set("idequipo", r.data.idconcepto);
                                    e.value = r.data.concepto;
                                    return true;
                                }
                            });
                        } else {
                            rec.set("idmoneda", "USD");
                            rec.set("iditem", r.data.idconcepto);
                        }
                        e.value = r.data.concepto;
                        return true;
                    }
                })
            } else if (e.field == "equipo"){
                store.each(function(r){
                    if (r.data.idconcepto == e.value){
                        rec.set("idequipo", r.data.idconcepto);
                        e.value = r.data.concepto;
                        return true;
                    }
                });
            }
        },
        onContextHide: function(){
            if (this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
        },
        createMenu: function(){
            var menu = new Ext.menu.Menu({
                id:'grid_productos-ctx',
                enableScrolling : false,
                items: [{
                    text: 'Editar trayecto',
                    iconCls: 'page_white_edit',
                    scope:this,
                    handler: function(){
                        if (this.ctxRecord){
                            this.editarTrayecto(this.ctxRecord);
                        }
                    }
                },
                {
                    text: 'Importar del tarifario',
                    iconCls: 'import',
                    scope:this,
                    handler: function(){
                        if (this.ctxRecord){
                            this.ventanaTarifario(this.ctxRecord);
                        }
                    }
                },
                {
                    text: 'Nuevo recargo',
                    iconCls: 'textfield_add',
                    scope:this,
                    handler: this.nuevoRecargo
                },
                {
                    text: 'Eliminar item',
                    iconCls: 'delete',
                    scope:this,
                    handler: this.eliminarItem
                },
                {
                    text: 'Eliminar trayecto',
                    iconCls: 'delete',
                    scope:this,
                    handler: this.eliminarTrayecto
                },
                {
                    text: 'Observaciones',
                        iconCls: 'page_white_edit',
                        scope:this,
                        handler: function(){
                            if (this.ctxRecord.data.iditem){
                                this.observacionesHandler(this.ctxRecord);
                            }
                        }
                }]
            });
            return menu;
        },
        onRowcontextmenu :  function(grid, index, e){
            rec = this.store.getAt(index);
            var storeProductos = this.store;
            if (!this.menu){ // create context menu on first right click
                this.menu = this.createMenu();
                this.menu.on('hide', this.onContextHide, this);
            }
            e.stopEvent();
            if (this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
            this.ctxRecord = rec;
            this.ctxRow = this.view.getRow(index);
            Ext.fly(this.ctxRow).addClass('x-node-ctx');
            this.menu.showAt(e.getXY());
        },
        onRowcellclick: function(grid, rowIndex, columnIndex, e){
            if (columnIndex == 9){
                var store = this.store;
                this.ctxRecord = this.store.getAt(rowIndex);
                if (!this.menu){ // create context menu on first right click
                    this.menu = this.createMenu();
                    this.menu.on('hide', this.onContextHide, this);
                }
                this.menu.showAt(e.getXY());
            }
        },
        /*
         * Determina que store se debe utilizar dependiendo si es un concepto o recargo
         */
        onBeforeedit: function(e){
            if (e.field == "item"){
                var rec = e.record;
                //Si ya coloco un concepto no permite que lo cambie
                if (rec.data.iditem){
                    return false;
                }
                var ed = this.colModel.getCellEditor(e.column, e.row);
                if (rec.data.tipo == "concepto"){
                    this.storeConceptos.baseParams = {transporte:rec.data.transporte, modalidad:rec.data.modalidad};
                }
                if (rec.data.tipo == "recargo"){
                    this.storeConceptos.baseParams = {transporte:rec.data.transporte, modalidad:rec.data.modalidad, tipo:'Recargo en Origen', impoexpo:rec.data.impoexpo, modo:'recargos'};
                }
                this.storeConceptos.load();
            }
            if (e.field == "aplica_tar" || e.field == "aplica_min"){
                var dataAereo = [
                    ['']
                    <?
                    $i = 0;
                    foreach ($aplicacionesAereo as $aplicacion) {
                        echo ",";
                        ?>
                        ['<?= $aplicacion->getCaValor() ?>']
                        <?
                    }
                    ?>
                ];
                var dataMaritimo = [
                    ['']
                    <?
                    $i = 0;
                    foreach ($aplicacionesMaritimo as $aplicacion) {
                        echo ",";
                        ?>
                        ['<?= $aplicacion->getCaValor() ?>']
                        <?
                    }
                    ?>
                ];
                var ed = this.colModel.getCellEditor(e.column, e.row);
                if (e.record.data.transporte == "<?= Constantes::AEREO ?>"){
                    ed.field.store.loadData(dataAereo);
                } else {
                    ed.field.store.loadData(dataMaritimo);
                }
            }
        },
        eliminarItem: function(){
            var storeProductos = this.store;
            if (this.ctxRecord && this.ctxRecord.data.iditem && confirm("Desea continuar?")){
                if (this.ctxRecord.data.tipo == "concepto"){
                    var idconcepto = this.ctxRecord.data.iditem;
                    var idrecargo = "";
                } else {
                    var idconcepto = this.ctxRecord.data.idconcepto;
                    var idrecargo = this.ctxRecord.data.iditem;
                }
                var id = this.ctxRecord.id;
                var tipo = this.ctxRecord.data.tipo;
                var idopcion = this.ctxRecord.data.idopcion;
                var idproducto = this.ctxRecord.data.idproducto;
                var modalidad = this.ctxRecord.data.modalidad;
                var idcotrecargo = this.ctxRecord.data.idcotrecargo;
                if (tipo == "recargo" && !idcotrecargo){ // Como no se ha guardado simplemente  lo borra del store
                    storeProductos.remove(this.ctxRecord);
                    return 0;
                }
                if (tipo == "concepto" && !idopcion){ // Como no se ha guardado simplemente  lo borra del store
                    var parent = this.ctxRecord.data.parent;
                    storeProductos.each(function(r){
                        if (r.data.tipo == "recargo" && r.data.parent == parent){
                            storeProductos.remove(r);
                        }
                    });
                    storeProductos.remove(this.ctxRecord);
                    return 0;
                }
                if (idopcion){
                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '<?= url_for("cotizaciones/eliminarItemsOpciones?idcotizacion=" . $cotizacion->getCaIdcotizacion()) ?>',
                        params :{
                            id: id,
                            idconcepto: idconcepto,
                            idrecargo: idrecargo,
                            tipo: tipo,
                            idopcion: idopcion,
                            idproducto: idproducto,
                            idcotrecargo: idcotrecargo
                        },
                        failure:function(response, options){
                            alert(response.responseText);
                            success = false;
                        },
                        success:function(response, options){
                            var res = Ext.util.JSON.decode(response.responseText);
                            if (res.success){
                                record = storeProductos.getById(res.id);
                                storeProductos.remove(record);
                                if (tipo == "concepto"){
                                    storeProductos.remove(record);
                                    /*
                                     * Se deben eliminar los recargos del concepto que se elimino ya que al enviar la
                                     * petición son borrados de la base de datos.
                                     */
                                    storeProductos.each(function(r){
                                        if (r.data.tipo == "recargo" && r.data.idopcion == record.data.idopcion){
                                            storeProductos.remove(r);
                                        }
                                    });
                                }
                            }
                        }
                    });
                }
            }
        },
        eliminarTrayecto : function(){
            var storeProductos = this.store;
            if (this.ctxRecord && confirm("Desea continuar?")){
                var idproducto = this.ctxRecord.data.idproducto;
                Ext.Ajax.request({
                    waitMsg: 'Guardando cambios...',
                    url: '<?= url_for("cotizaciones/eliminarProducto?idcotizacion=" . $cotizacion->getCaIdcotizacion()) ?>',
                    params :	{
                        idproducto: idproducto
                    },
                    failure:function(response, options){
                        alert(response.responseText);
                        success = false;
                    },
                    //Ejecuta esta accion cuando el resultado es exitoso
                    success:function(response, options){
                        var res = Ext.util.JSON.decode(response.responseText);
                        if (res.success){
                            storeProductos.each(function(record){
                                if (record.data.idproducto == idproducto){
                                    storeProductos.remove(record);
                                }
                            });
                        }
                    }
                });
            }
        },
        nuevoRecargo: function(){
            rec = this.ctxRecord;                    
            var recordProductos = this.record;
            var storeProductos = this.store;
            if (rec.data.iditem && rec.data.idopcion){
                if (rec.data.tipo == "concepto"){
                    var idconcepto = rec.data.iditem;
                } else {
                    var idconcepto = rec.data.idconcepto;
                }
                if (rec.data.idopcion == "999"){
                    var orden = "Y-Z";
                } else {
                    var orden = rec.data.idopcion + "-Z";
                }
                var newRec = new recordProductos({
                    idcotizacion: rec.data.idcotizacion,
                    idproducto: rec.data.idproducto,
                    trayecto: rec.data.trayecto,
                    transporte: rec.data.transporte,
                    modalidad: rec.data.modalidad,
                    idconcepto: idconcepto,
                    idopcion: rec.data.idopcion,
                    producto: rec.data.producto,
                    tra_origen: rec.data.tra_origen,
                    tra_origen_value: rec.data.tra_origen_value,
                    ciu_origen: rec.data.ciu_origen,
                    ciu_origen_value: rec.data.ciu_origen_value,
                    tra_destino: rec.data.tra_destino,
                    tra_destino_value: rec.data.tra_destino_value,
                    ciu_destino: rec.data.ciu_destino,
                    ciu_destino_value: rec.data.ciu_destino_value,
                    tra_escala: rec.data.tra_escala,
                    tra_escala_value: rec.data.tra_escala_value,
                    ciu_escala: rec.data.ciu_escala,
                    ciu_escala_value: rec.data.ciu_escala_value,
                    idlinea: rec.data.idlinea,
                    linea: rec.data.linea,
                    impoexpo: rec.data.impoexpo,
                    incoterms: rec.data.incoterms,
                    frecuencia: rec.data.frecuencia,
                    ttransito: rec.data.ttransito,
                    imprimir: rec.data.imprimir,
                    observaciones: rec.data.observaciones,
                    vigencia: rec.data.vigencia,
                    item: '+',
                    iditem: '',
                    idcotrecargo: '',
                    tipo: 'recargo',
                    valor_tar: '',
                    valor_min: '',
                    aplica_tar: '',
                    aplica_min: '',
                    idmoneda: '',
                    detalles: '',
                    orden: orden
                });
                storeProductos.addSorted(newRec);
                newRec.set("idmoneda", "USD");
            }
        },
        observacionesHandler: function(rec){
            //crea una ventana
            win = new Ext.Window({
                width       : 500,
                height      : 200,
                closeAction :'close',
                plain       : true,
                items       : new Ext.FormPanel({
                    id: 'producto-form-obs',
                    layout: 'form',
                    frame: true,
                    title: 'Ingrese las observaciones',
                    autoHeight: true,
                    bodyStyle: 'padding: 5px 5px 0 5px;',
                    labelWidth: 100,
                    items: [
                        {
                            xtype: 'textarea',
                                width: 310,
                                fieldLabel: 'Observaciones',
                                name: 'observaciones',
                                value: rec.data.detalles,
                                allowBlank:true
                        }
                    ]
                }),
                buttons: [{
                    text     : 'Ok',
                    handler: function(){
                        var fp = Ext.getCmp("producto-form-obs");
                        if (fp.getForm().isValid()){
                            rec.set("detalles", fp.getForm().findField("observaciones").getValue());
                            win.close();
                        }
                    }
                }, {
                    text     : 'Cancelar',
                    handler  : function(){
                        win.close();
                    }
                }]
            });
            win.show();
        },
        agregarTrayecto: function(){
            this.crearVentanaTrayecto();
        },
        editarTrayecto: function(rec){
            this.crearVentanaTrayecto(rec);
        },
        /*
         * Muestra una ventana enla que se puede crear o editar un trayecto
         */
        crearVentanaTrayecto: function(record){
            storeProductos = this.store;
            //crea una ventana
            if (this.empresa == '<?= Constantes::COLTRANS ?>' || this.empresa == '<?= Constantes::TPLOGISTICS ?>'){
                this.win = new PanelTrayectoWindow({tipo:this.tipo});
            } else if (this.empresa == '<?= Constantes::COLMAS ?>'){
                this.win = new FormTrayectoAduanaWindow();
            }
            this.win.show();
            if (typeof (record) != "undefined"){ // Coloca los datos en la ventana
                var fp = Ext.getCmp("producto-form");
                form = fp.getForm().loadRecord(record);
                fp.getForm().findField("idproducto").setValue(record.data.idproducto);
                fp.getForm().findField("origen").setValue(record.data.ciu_origen_value);
                fp.getForm().findField("origen").hiddenField.value = record.data.ciu_origen;
                fp.getForm().findField("destino").setValue(record.data.ciu_destino_value);
                fp.getForm().findField("destino").hiddenField.value = record.data.ciu_destino;
                if (fp.getForm().findField("escala")){
                    fp.getForm().findField("escala").setValue(record.data.ciu_escala_value);
                    fp.getForm().findField("escala").hiddenField.value = record.data.ciu_escala;
                }
                if (fp.getForm().findField("idlinea")){
                    fp.getForm().findField("idlinea").setValue(record.data.linea);
                    fp.getForm().findField("idlinea").hiddenField.value = record.data.idlinea;
                }
                var now = new Date(<?= strtotime(date("Y-m-d")) * 1000 ?>);
                fp.getForm().findField("vigencia").setMinValue((record.data.vigencia && record.data.vigencia <= now)?record.data.vigencia:now);
                //Verifica que no hayan concepto para poder editar los campos impoexpo, transporte y modalidad
                storeProductos.each(function(r){
                    if (r.data.idproducto == record.data.idproducto){
                        fp.getForm().findField("impoexpo").disable();
                        fp.getForm().findField("transporte").disable();
                        fp.getForm().findField("modalidad").disable();
                    }
                });
            } else {
                var fp = Ext.getCmp("producto-form");
                fp.getForm().findField("vigencia").setMinValue(new Date(<?= strtotime(date("Y-m-d")) * 1000 ?>));
            }
        },
        /*
         * Muestra una ventana con la informacion del tarifario y le permite al usuario
         * seleccionar las tarifas a importar
         */
        ventanaTarifario : function(record){
            recordProductos = this.record;
            storeProductos = this.store;
            var url = '<?= url_for("pricing/grillaPorTrafico?opcion=consulta") ?>';
            activeRecord = record;
            if (record.data.impoexpo == "")
                record.data.impoexpo = "<?= Constantes::IMPO ?>";
            if (record.data.impoexpo == "<?= Constantes::IMPO ?>"){
                idciudad = record.data.ciu_origen;
                idciudad2 = record.data.ciu_destino;
                idtrafico = record.data.tra_origen;
            } else if (record.data.impoexpo == "<?= Constantes::EXPO ?>"){
                idciudad2 = record.data.ciu_origen;
                idciudad = record.data.ciu_destino;
                idtrafico = record.data.tra_destino;
            } else  {
                idciudad = record.data.ciu_origen;
                idciudad2 = record.data.ciu_destino;
                idtrafico = 'CO-057';
            }
            impoexpo = record.data.impoexpo;
            transporte = record.data.transporte;
            modalidad = record.data.modalidad;
            idlinea = record.data.idlinea;
            var newComponent = new PanelFletesPorTrayecto({
                impoexpo: impoexpo,
                idtrafico: idtrafico,
                trafico: idtrafico,
                transporte: transporte,
                modalidad: modalidad,
                idciudad: idciudad,
                idciudad2: idciudad2,
                idlinea: idlinea,
                closable: false,
                readOnly: true
            });
            //Se crea la ventana
            win = new Ext.Window({
                width       : 800,
                height      : 460,
                closeAction :'close',
                plain       : true,
                title       : "Por favor seleccion las tarifas que desea importar",
                items       : [newComponent],
                buttons: [{
                    text     : 'Importar',
                    handler  : function(){
                        storePricing = newComponent.store;
                        /*
                         * Si se seleccionas recargos generales sin seleccionar el concepto lo selecciona
                         */
                        var parentRecordId = null;
                        storePricing.each(function(r){
                            if (r.data.tipo == "recargoxciudad" || r.data.tipo == "recargoxlinea"){
                                var tipo = "recargo";
                            } else {
                                var tipo = r.data.tipo;
                            }
                            if (tipo == "concepto"){
                                idconcepto = r.data.iditem;
                                if (idconcepto == "9999"){
                                    parentRecordId = r.id;
                                }
                            }
                            if (tipo == "recargo"){
                                if (r.data.idconcepto == "9999" && r.data.sel){
                                    parentRecord = storePricing.getById(parentRecordId);
                                    parentRecord.set("sel", true);
                                }
                            }
                        });
                        /*
                         * Busca el ultimo elemento para insertar al final del grupo
                        */
                        index = storeProductos.indexOf(activeRecord);
                        var j = 0;
                        var idconcepto = null;
                        storePricing.each(function(r){
                            if (r.data.tipo == "recargoxciudad" || r.data.tipo == "recargoxlinea"){
                                var tipo = "recargo";
                            } else {
                                var tipo = r.data.tipo;
                            }
                            if (r.data.sel == true && tipo != "trayecto_obs"){
                                var flag = false;
                                var iditem = r.data.iditem;
                                //Cuando se habla de LCL se colocan los minimos
                                if (tipo == "concepto"){
                                    var valor_tar = r.data.sugerida; //Minima sugerida de venta
                                    var valor_min = ''; //No aplica
                                } else {
                                    var valor_tar = r.data.sugerida;
                                    var valor_min = r.data.minima;
                                }
                                if (tipo == "concepto"){
                                    j++;
                                    idconcepto = r.data.iditem;
                                    if (idconcepto == "9999"){
                                        var idopcion = '999'
                                        var orden = "Y";
                                        storeProductos.each(function(r2){
                                            if (r2.data.tipo == "concepto" && r2.data.idopcion == '999' && r2.data.idproducto == activeRecord.data.idproducto){
                                                flag = true;
                                            }
                                        });
                                } else {
                                    var idopcion = ''
                                        var orden = "W" + j;
                                    }
                                }
                                //Esto es importante
                                if (tipo == "recargo"){
                                    if (idconcepto != r.data.idconcepto){
                                        flag = true;
                                    }
                                    if (r.data.idconcepto == "9999"){
                                        var idopcion = '999'
                                        var orden = "Y" + "-" + r.data.nconcepto;
                                    } else {
                                        var idopcion = ''
                                        var orden = "W" + j + "-" + r.data.nconcepto;
                                    }
                                }
                                if (!flag){
                                    var newRec = new recordProductos({
                                        idcotizacion: activeRecord.data.idcotizacion,
                                        idproducto: activeRecord.data.idproducto,
                                        trayecto: activeRecord.data.trayecto,
                                        transporte: activeRecord.data.transporte,
                                        modalidad: activeRecord.data.modalidad,
                                        idconcepto: activeRecord.data.iditem,
                                        idopcion: idopcion,
                                        producto: activeRecord.data.producto,
                                        tra_origen: activeRecord.data.tra_origen,
                                        tra_origen_value: activeRecord.data.tra_origen_value,
                                        ciu_origen: activeRecord.data.ciu_origen,
                                        ciu_origen_value: activeRecord.data.ciu_origen_value,
                                        tra_destino: activeRecord.data.tra_destino,
                                        tra_destino_value: activeRecord.data.tra_destino_value,
                                        ciu_destino: activeRecord.data.ciu_destino,
                                        ciu_destino_value: activeRecord.data.ciu_destino_value,
                                        tra_escala: activeRecord.data.tra_escala,
                                        tra_escala_value: activeRecord.data.tra_escala_value,
                                        ciu_escala: activeRecord.data.ciu_escala,
                                        ciu_escala_value: activeRecord.data.ciu_escala_value,
                                        idlinea: activeRecord.data.idlinea,
                                        linea: activeRecord.data.linea,
                                        impoexpo: activeRecord.data.impoexpo,
                                        incoterms: activeRecord.data.incoterms,
                                        frecuencia: activeRecord.data.frecuencia,
                                        ttransito: activeRecord.data.ttransito,
                                        imprimir: activeRecord.data.imprimir,
                                        observaciones: activeRecord.data.observaciones,
                                        vigencia: activeRecord.data.vigencia,
                                        item: '',
                                        iditem: '',
                                        tipo: '',
                                        valor_tar: '',
                                        valor_min: '',
                                        aplica_tar: '',
                                        aplica_min: '',
                                        idmoneda: '',
                                        detalles: '',
                                        parent: j,
                                        orden: orden
                                    });
                                    newRec.set("trayecto", activeRecord.data.trayecto);
                                    storeProductos.addSorted(newRec);
                                    //Es necesario buscar de nuevo el record dentro del store
                                    //para que se activen los eventos de edición del store
                                    var newRec = storeProductos.getById(newRec.id);
                                    newRec.set("item", r.data.nconcepto);
                                    newRec.set("idconcepto", r.data.idconcepto);
                                    newRec.set("idequipo", r.data.idequipo);
                                    newRec.set("equipo", r.data.equipo);
                                    newRec.set("iditem", iditem);
                                    newRec.set("tipo", tipo);
                                    newRec.set("valor_tar", valor_tar);
                                    newRec.set("aplica_tar", r.data.aplicacion);
                                    newRec.set("aplica_min", r.data.aplicacion_min);
                                    newRec.set("valor_min", valor_min);
                                    newRec.set("idmoneda", r.data.moneda);
                                    newRec.set("consecutivo", r.data.consecutivo);
                                }
                            }
                        });
                        win.close();
                    }
                },
                {
                    text     : 'Cancelar',
                    handler  : function(){
                        win.close();
                    }
                }]
            });
            win.show();
        },
        /*
         * Muestra una ventana con la informacion de los archivos tarifario del trafico
         */
        ventanaTarifarioArchivos: function(record){
            var url = '<?= url_for("pricing/archivosPais?opcion=consulta") ?>';
            activeRecord = record;
            if (record.data.impoexpo == "<?= Constantes::IMPO ?>"){
                idtrafico = record.data.tra_origen;
            }
            if (record.data.impoexpo == "<?= Constantes::EXPO ?>"){
                idtrafico = record.data.tra_destino;
            }
            Ext.Ajax.request({
                url: url,
                params: {
                    idtrafico: idtrafico,
                    transporte: record.data.transporte,
                    impoexpo: record.data.impoexpo,
                    modalidad: record.data.modalidad
                },
                success: function(xhr) {
                    var newComponent = eval(xhr.responseText);
                    //Se crea la ventana
                    win = new Ext.Window({
                        width       : 550,
                        height      : 300,
                        closeAction :'close',
                        plain       : true,
                        items       : [newComponent]
                    });
                    win.show();
                },
                failure: function() {
                    Ext.Msg.alert("Win creation failed", "Server communication failure");
                }
            });
        }
    });
</script>