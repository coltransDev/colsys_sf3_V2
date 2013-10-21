<?
/*
 * Permite crear trayectos en la cotización e incluir diferentes
 * opciones de fletes y recargos
 * @author: Andres Botero
 */
include_component("cotizaciones", "panelPreliquidaWindow", array("cotizacion" => $cotizacion));
include_component("cotizaciones", "panelPreliquidaForm", array("cotizacion" => $cotizacion));
?>

<script type="text/javascript">

    var activeRecord = null;
    var tipo=null;
    var id=null;
    PanelPreliquidar = function( config ){

        Ext.apply(this, config);
        /*
         *Store que carga los conceptos
         */

        this.resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><b>{concepto}</b><br /><span>{aka}</span> </div></tpl>'
    );

        /*
         * Crea el Record
         */
        this.record = Ext.data.Record.create([
            {name: 'sel', type: 'bool'},
            {name: 'id', type: 'int'},
            {name: 'idcotizacion', type: 'string'},
            {name: 'idproducto', type: 'string'},
            {name: 'producto', type: 'string'},
            {name: 'idopcion', type: 'string'},
            {name: 'idcotrecargo', type: 'string'},
            {name: 'trayecto', type: 'string'},
            {name: 'item', type: 'string'},  //Texto de concepto o recargo
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
            {name: 'cantidad_liq', type: 'float'},
            {name: 'valor_liq', type: 'float'},
            {name: 'detalles_liq', type: 'string'},
            {name: 'mostrar_liq', type: 'string'},
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
            {name: 'piezas', type: 'string'},
            {name: 'pallets', type: 'string'},
            {name: 'documentos', type: 'string'},
            {name: 'warehouse', type: 'string'},
            {name: 'preliquida', type: 'string'},
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
$url = "cotizaciones/grillaProductosData?idcotizacion=" . $cotizacion->getCaIdcotizacion();
if ($modo == "consulta") {
    $url.="&modo=consulta";
}
if (isset($producto)) {
    $url.="&idproducto=" . $producto->getCaIdproducto();
}
?>
        /*
         * Crea el store
         */
        this.store = new Ext.data.GroupingStore({
            autoLoad : true,
            pruneModifiedRecords:true,
            url: '<?= url_for($url) ?>',
            reader: new Ext.data.JsonReader(
            {
                //id: 'id',
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
                id: 'trayecto',
                header: "Trayecto",
                width: 100,
                sortable: false,
                dataIndex: 'trayecto',
                hideable: false,
                hidden: true
            },
            {
                id: 'concepto',
                header: "Concepto",
                width: 200,
                sortable: false,
                dataIndex: 'item',
                hideable: false,
                renderer: this.formatItem
            },
            {
                id: 'equipo',
                header: "Equipo",
                width: 150,
                sortable: false,
                dataIndex: 'equipo',
                hideable: false
            },
            {
                id: 'valor_tar',
                header: "Valor",
                width: 50,
                sortable: false,
                dataIndex: 'valor_tar',
                hideable: false
            },
            {
                id: 'aplica_tar',
                header: "Aplicación",
                width: 100,
                sortable: false,
                dataIndex: 'aplica_tar',
                hideable: false
            },
            {
                id: 'valor_min',
                header: "Minimo",
                width: 50,
                sortable: false,
                dataIndex: 'valor_min',
                hideable: false
            },
            {
                id: 'aplica_min',
                header: "Aplicación Min",
                width: 100,
                sortable: false,
                dataIndex: 'aplica_min',
                hideable: false
            },
            {
                id: 'idmoneda',
                header: "Moneda",
                width: 50,
                sortable: false,
                dataIndex: 'idmoneda',
                hideable: false
            },
            {
                id: 'cantidad_liq',
                header: "Cantidad",
                width: 50,
                sortable: false,
                dataIndex: 'cantidad_liq',
                hideable: false ,
                editor: new Ext.form.NumberField({
                    allowBlank: false ,
                    allowNegative: false,
                    style: 'text-align:left',
                    decimalPrecision :0
                })
            },
            {
                id: 'valor_liq',
                header: "Valor",
                width: 50,
                sortable: false,
                dataIndex: 'valor_liq',
                hideable: false ,
                editor: new Ext.form.NumberField({
                    allowBlank: false ,
                    allowNegative: false,
                    style: 'text-align:left',
                    decimalPrecision :3
                })
            },
            {
                id: 'detalles_liq',
                header: "Detalles",
                width: 100,
                sortable: false,
                dataIndex: 'detalles_liq',
                hideable: false,
                editor: new Ext.form.TextField({
                    allowBlank: false ,
                    style: 'text-align:left',
                    allowBlank: true
                })

            },
            {
                id: 'mostrar_liq',
                header: "Mostrar",
                width: 20,
                sortable: false,
                dataIndex: 'mostrar_liq',
                hideable: false
            }
        ];

        PanelPreliquidar.superclass.constructor.call(this, {
            loadMask: {msg:'Cargando...'},
            clicksToEdit: 1,

            stripeRows: true,
            autoExpandColumn: 'producto',        
            height: 400,

            root_title: 'preliquidacion',
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
                            id:'guardarbtn'+this.tipo
                        },
                        {
                            text: 'Recargar',
                            tooltip: 'Recarga los datos de la base de datos',
                            iconCls: 'refresh',  // reference to our css
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
                getRowClass: function(  record,  index,  rowParams,  storeParametros ){
                    switch( record.data.style ){
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
                        beforeedit: this.onBeforeedit
                    }
    <?
} else {
    ?>
                    ,boxMinHeight: 400
    <?
}
?>
        });

        var storeParametros = this.store;
        this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
<?
if ($modo == "consulta") {
    ?>
                    return false;
    <?
}
?>
            var record = storeParametros.getAt(rowIndex);
            var field = this.getDataIndex(colIndex);

            if( !record.data.iditem && field!="item" ){
                return false;
            }
            if( field!="item" && record.data.tipo=="concepto" && record.data.iditem =="9999"  ){
                return false;
            }        
            if( field=="equipo" && (record.data.transporte!="<?= Constantes::TERRESTRE ?>"&&record.data.transporte!="<?= Constantes::OTMDTA ?>") ){
                return false;
            }
            return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
        }
    }

    Ext.extend(PanelPreliquidar, Ext.grid.EditorGridPanel, {
        recargar: function(){
            id_new="grid_preliquidar";
            if(Ext.getCmp(id_new).store.getModifiedRecords().length>0){

                if(!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
                    return 0;
                }
            }
            Ext.getCmp(id_new).store.reload();
            Ext.getCmp('guardarbtnTrayecto').enable();
            Ext.getCmp('guardarbtnOTM/DTA').enable();
        },
        guardarItems: function (){
            try{
                tipo=this.tipo;
                var storeParametros = this.store;
                var success = true;
                var records = storeParametros.getModifiedRecords();
                var lenght = records.length;

                for( var i=0; i< lenght; i++){
                    r = records[i];
                    if( r.data.idmoneda<=0 && r.data.iditem!="9999" ){
                        r.data.idmoneda="USD";
                    }

                    if( !r.data.idequipo && r.data.modalidad =="FCL" && r.data.transporte=="<?= Constantes::TERRESTRE ?>" )
                    {
                        alert('Por favor indique el equipo 1 del trayecto '+r.data.trayecto,'Alert');
                    }
                }
                var numResponses = 0;

                Ext.getCmp('guardarbtn'+tipo).disable();
                habilita=false;
                for( var i=0; i< lenght; i++){
			
                    if(i==(lenght-1))
                        habilita=true;
                    if( records[i].data.tipo=="concepto" || (records[i].data.tipo=="recargo" && records[i].data.idopcion ))
                    {
                        this.guardarGridProductosRec( records[i],habilita );
                        habilita="S";
                    }
                }
            }
            catch(err)
            {
                habilita="N";
            }
            if(habilita!="S")
            {
                Ext.getCmp('guardarbtnTrayecto').enable();
                Ext.getCmp('guardarbtnOTM/DTA').enable();
            }
        
        },

        enableButton: function(){	
            Ext.getCmp('guardarbtnTrayecto').enable();
            Ext.getCmp('guardarbtnOTM/DTA').enable();
        },
        guardarGridProductosRec: function( r, habilita ){
            var storeParametros = this.store;
            var changes = r.getChanges();

            tipo=this.tipo;
            if( r.data.iditem && !r.data.inSave ){
                changes['id']=r.id;
                changes['parent']=r.data.parent;
                changes['idproducto']=r.data.idproducto;
                changes['tipo']=r.data.tipo;
                changes['idopcion']=r.data.idopcion;
                changes['idconcepto']=r.data.idconcepto;
                changes['idcotrecargo']=r.data.idcotrecargo;
                changes['iditem']=r.data.iditem;
                changes['modalidad']=r.data.modalidad;
                changes['idequipo']=r.data.idequipo;
                changes['equipo']=r.data.equipo;
                changes['idmoneda']=r.data.idmoneda;
                changes['cantidad_liq']=r.data.idmoneda;
                changes['valor_liq']=r.data.idmoneda;
                changes['detalles_liq']=r.data.idmoneda;
                changes['mostrar_liq']=r.data.idmoneda;
                r.set("inSave", true);

                Ext.Ajax.request(
                {
                    waitMsg: 'Guardando cambios...',
                    url: '<?= url_for("cotizaciones/observeItemsOpciones?idcotizacion=" . $cotizacion->getCaIdcotizacion()) ?>',
                    params :	changes,
                    failure:function(response,options){
                        success = false;
                        r.set("inSave", false);
                        if(habilita==true)
                        {
                            Ext.getCmp('guardarbtnTrayecto').enable();
                            Ext.getCmp('guardarbtnOTM/DTA').enable();
                        }
                    },
                    callback :function(options, success, response){
                        r.set("inSave", false);
                        var res = Ext.util.JSON.decode( response.responseText );
                        var rec = storeParametros.getById( res.id );
                        rec.set("idopcion", res.idopcion );
                        if( rec.data.tipo=="concepto" ){
                            if( rec.data.idopcion!=999 ){
                                rec.set("orden", res.idopcion );
                            }else{
                                rec.set("orden", "Y" );
                            }
                            storeParametros.each( function(r){
                                if(r.data.parent && r.data.parent == rec.data.parent && r.data.tipo=="recargo"  ){
                                    r.data.idopcion = res.idopcion;
                                    if(res.idopcion=="999"){
                                        r.data.orden = "Y-"+r.data.item;
                                    }else{
                                        r.data.orden = res.idopcion+"-"+r.data.item;
                                    }
                                    if( r.dirty ){
                                        
                                        Ext.getCmp("grid_preliquidar").guardarGridProductosRec( r,false );
                                        
                                    }
                                }
                            } );
                        }
                        if( rec.data.tipo=="recargo" ){
                            rec.set("idcotrecargo", res.idcotrecargo );
                        }
                        rec.commit();
                        storeParametros.sort("orden", "ASC");
                        if(habilita==true)
                        {
                            Ext.getCmp('guardarbtnTrayecto').enable();
                            Ext.getCmp('guardarbtnOTM/DTA').enable();
                        }
                    }
                }
            );
            }
        },

        formatItem : function(value, p, record) {
            if( record.data.tipo == "recargo" ){
                return String.format(
                '<div class="recargo">{0}</div>',
                value
            );
            }else{
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
            storeParametros = this.store;
            recordProductos = this.record;
            iditem="-1";
            validate=true;

            tipo=this.tipo;
            storeParametros.each( function( r ){
                if(r.data.tipo=="concepto" && r.data.iditem )
                {               
                    iditem=r.data.iditem;
                }
            });
            if(validate==false)
                return false;

            if( e.field == "equipo"){
           
                store.each( function( r ){
                    if( r.data.idconcepto==e.value ){
                        rec.set("idequipo", r.data.idconcepto );
                        e.value = r.data.concepto;
                        return true;
                    }
                });
            }
        },
        onContextHide: function(){
            if(this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
        },
        onRowcontextmenu :  function(grid, index, e){
            rec = this.store.getAt(index);
            var storeParametros = this.store;
            if(!this.menu){ // create context menu on first right click

                this.menu = new Ext.menu.Menu({
                    id:'grid_preliquidar-ctx',
                    enableScrolling : false,
                    items: [{
                            text: 'Editar Parámetros',
                            iconCls: 'page_white_edit',
                            scope:this,
                            handler: function(){
                                if( this.ctxRecord ){
                                    this.editarParametros( this.ctxRecord );
                                }
                            }
                        }
                    ]
                });
                this.menu.on('hide', this.onContextHide , this);
            }
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
        /*
         * Determina que store se debe utilizar dependiendo si es un concepto o recargo
         */
        onBeforeedit: function( e ){
            if(e.field=="item"){
                var rec = e.record;
                //Si ya coloco un concepto no permite que lo cambie
                if( rec.data.iditem ){
                    return false;
                }
                var ed = this.colModel.getCellEditor(e.column, e.row);
                if( rec.data.tipo == "concepto" ){
                    this.storeConceptos.baseParams={transporte:rec.data.transporte, modalidad:rec.data.modalidad};
                }

                if( rec.data.tipo == "recargo" ){
                    this.storeConceptos.baseParams={transporte:rec.data.transporte, modalidad:rec.data.modalidad, tipo:'Recargo en Origen', impoexpo:rec.data.impoexpo , modo:'recargos'};
                }
                this.storeConceptos.load();
            }
        },
        editarParametros: function( rec ){
            this.crearVentanaParametros( rec );
        },
        /*
         * Muestra una ventana enla que se puede crear o editar un trayecto
         */
        crearVentanaParametros: function( record ){
            storeParametros = this.store;
            //crea una ventana
            this.win = new PanelPreliquidaWindow();

            this.win.show( );

            var fp = Ext.getCmp("parametros-form");
            form = fp.getForm().loadRecord(record);
            fp.getForm().findField("idproducto").setValue(record.data.idproducto);
            fp.getForm().findField("piezas").setValue(record.data.piezas);
            fp.getForm().findField("pallets").setValue(record.data.pallets);
            fp.getForm().findField("documentos").setValue(record.data.documentos);
            fp.getForm().findField("warehouse").setValue(record.data.warehouse);
            fp.getForm().findField("preliquida").setValue(record.data.preliquida);
        }
    });
</script>
