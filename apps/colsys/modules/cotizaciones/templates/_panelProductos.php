
<?
/*
* Permite crear trayectos en la cotización e incluir diferentes
* opciones de fletes y recargos
* @author: Andres Botero
*/
?>

<script type="text/javascript">


var activeRecord = null;

PanelProductos = function( config ){

    Ext.apply(this, config);

    /*
    *Store que carga los conceptos
    */
    this.storeConceptos = new Ext.data.Store({
        autoLoad : false,
        url: '<?=url_for("parametros/datosConceptos")?>',
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
        fieldLabel: 'Concepto',
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
    })

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
    ]);

    <?
    $url = "cotizaciones/grillaProductosData?idcotizacion=".$cotizacion->getCaIdcotizacion();
    if($modo=="consulta"){
        $url.="&modo=consulta";
    }

    if( isset($producto) ){
        $url.="&idproducto=".$producto->getCaIdproducto();
    }
    ?>
    /*
    * Crea el store
    */
    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        url: '<?=url_for($url)?>',
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
                if($modo=="consulta"){
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
                    editor: this.editorConceptos,
                    renderer: this.formatItem
                },
                {
                    id: 'valor_tar',
                    header: "Valor",
                    width: 80,
                    sortable: false,
                    dataIndex: 'valor_tar',
                    hideable: false ,
                    editor: new Ext.form.NumberField({
                        allowBlank: false ,
                        allowNegative: false,
                        style: 'text-align:left',
                        decimalPrecision :3
                    })
                },
                {
                    id: 'aplica_tar',
                    header: "Aplicación",
                    width: 100,
                    sortable: false,
                    dataIndex: 'aplica_tar',
                    hideable: false,
                    editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
                },
                {
                    id: 'valor_min',
                    header: "Minimo",
                    width: 80,
                    sortable: false,
                    dataIndex: 'valor_min',
                    hideable: false ,
                    editor: new Ext.form.NumberField({
                        allowBlank: false ,
                        allowNegative: false,
                        style: 'text-align:left',
                        decimalPrecision :3
                    })
                },
                {
                    id: 'aplica_min',
                    header: "Aplicación Min",
                    width: 100,
                    sortable: false,
                    dataIndex: 'aplica_min',
                    hideable: false,
                    editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
                },
                {
                    id: 'idmoneda',
                    header: "Moneda",
                    width: 65,
                    sortable: false,
                    dataIndex: 'idmoneda',
                    hideable: false ,
                    editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
                }		,
                {
                    id: 'detalles',
                    header: "Detalles",
                    width: 100,
                    sortable: false,
                    dataIndex: 'detalles',
                    hideable: false ,
                    editor: new Ext.form.TextField({
                        allowBlank: false ,
                        style: 'text-align:left',
                        allowBlank: true
                    })
                }
                /*
                ,{
                    header: "Orden",
                    width: 100,
                    dataIndex: 'orden'

                }
                ,{
                    header: "Opcion",
                    width: 100,
                    dataIndex: 'idopcion'
                }*/
    ];

       



    PanelProductos.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       //store: storeProductos,
        //master_column_id : 'producto',

        //sm: selModel,        
        stripeRows: true,
        autoExpandColumn: 'producto',
        title: 'Tarifas de trayectos',
        height: 400,

        root_title: 'impoexpo',
        closable: false,
        id: 'grid_productos',
        <?
        if($modo!="consulta"){
        ?>
        tbar: [
            {
                text: 'Guardar Cambios',
                tooltip: 'Guarda los cambios hechos en la base de datos.',
                iconCls: 'disk',  // reference to our css
                handler: guardarDatosPaneles,
                id     : 'guardarbtn'
            },
            {
                text: 'Agregar trayecto',
                tooltip: 'Agregar un nuevo producto a la Cotización',
                iconCls: 'add',  // reference to our css
                handler: function(){
                    Ext.getCmp("grid_productos").agregarTrayecto();
                }
            }
        ],
        <?
        }else{
        ?>
        plugins: [this.checkColumn],
        <?
        }
        ?>
        view: new Ext.grid.GroupingView({
            forceFit:true,
            enableRowBody:true,
            enableGroupingMenu: false,
            getRowClass: function(  record,  index,  rowParams,  storeProductos ){
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
        if($modo!="consulta"){
        ?>
        ,
        listeners:{
            validateedit: this.onValidateEdit,
            rowcontextmenu:this.onRowcontextmenu,
            beforeedit: this.onBeforeedit
        }        
        <?
        }else{
        ?>
        ,boxMinHeight: 400
        <?
        }
        ?>
        




    });

    var storeProductos = this.store;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        <?
        if($modo=="consulta"){
        ?>
        return false;
        <?
        }
        ?>
        var record = storeProductos.getAt(rowIndex);
        var field = this.getDataIndex(colIndex);

        if( !record.data.iditem && field!="item" ){
            return false;
        }
        return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
    }

}


Ext.extend(PanelProductos, Ext.grid.EditorGridPanel, {
    
    guardarItems: function (){        
        var storeProductos = this.store;
        var success = true;
        var records = storeProductos.getModifiedRecords();
        var lenght = records.length;

        //Se hace la valida que se hayan colocado todos los datos
        for( var i=0; i< lenght; i++){
            r = records[i];
            //alert( r.data.iditem );
            if( !r.data.idmoneda && r.data.iditem!=9999 ){
                Ext.MessageBox.alert('Warning','Por favor coloque la moneda en todos los items en la pestaña Tarifas de trayectos');
                return 0;
            }
        }

        var numResponses = 0;

        Ext.getCmp('guardarbtn').disable();

        for( var i=0; i< lenght; i++){
            if( records[i].data.tipo=="concepto" || (records[i].data.tipo=="recargo" && records[i].data.idopcion )){
                this.guardarGridProductosRec( records[i] );
            }
        }
        Ext.getCmp('guardarbtn').enable();

    },


    /*
    * Guarda un record en la Base de datos
    */
    guardarGridProductosRec: function( r ){
        var storeProductos = this.store;
        var changes = r.getChanges();
        //alert( r.data.id );
        changes['id']=r.id;
        changes['parent']=r.data.parent;
        changes['idproducto']=r.data.idproducto;
        changes['tipo']=r.data.tipo;
        changes['idopcion']=r.data.idopcion;
        changes['idconcepto']=r.data.idconcepto;
        changes['idcotrecargo']=r.data.idcotrecargo;
        changes['iditem']=r.data.iditem;
        changes['modalidad']=r.data.modalidad;

        //envia los datos al servidor
        Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?=url_for("cotizaciones/observeItemsOpciones?idcotizacion=".$cotizacion->getCaIdcotizacion())?>',
                //method: 'POST',
                //Solamente se envian los cambios
                params :	changes,

                //Ejecuta esta accion en caso de fallo
                //(404 error etc, ***NOT*** success=false)
                failure:function(response,options){
                    //alert( response.responseText );
                    success = false;
                },
                //Ejecuta esta accion cuando el resultado es exitoso
                callback :function(options, success, response){

                    var res = Ext.util.JSON.decode( response.responseText );
                    var rec = storeProductos.getById( res.id );
                    rec.set("idopcion", res.idopcion );
                    if( rec.data.tipo=="concepto" ){
                        if( rec.data.idopcion!=999 ){
                            rec.set("orden", res.idopcion );
                        }else{
                            rec.set("orden", "Y" );
                        }
                         //Se coloca el id del padre en la bd
                        storeProductos.each( function(r){
                            if(r.data.parent && r.data.parent == rec.data.parent && r.data.tipo=="recargo"  ){
                                r.data.idopcion = res.idopcion;

                                r.data.orden = res.idopcion+"-"+r.data.item;

                                if( r.dirty ){
                                    this.guardarGridProductosRec( r );
                                }
                            }
                        } );

                    }

                    if( rec.data.tipo=="recargo" ){
                        rec.set("idcotrecargo", res.idcotrecargo );
                    }

                    rec.commit();
                    storeProductos.sort("orden", "ASC");
                }
             }
        );
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
        if( e.field == "item"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;
            storeProductos = this.store;
            recordProductos = this.record;
            store.each( function( r ){
                    if( r.data.idconcepto==e.value ){
                        if( !rec.data.iditem && rec.data.tipo=="concepto" ){
                            var newRec = new recordProductos({
                               idcotizacion: rec.data.idcotizacion,
                               idproducto: rec.data.idproducto,
                               trayecto: rec.data.trayecto,
                               transporte: rec.data.transporte,
                               modalidad: rec.data.modalidad,
                               idconcepto: rec.data.iditem,
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
                               orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                            });

                            newRec.data.concepto = "";
                            if( r.data.idconcepto=="9999" ){
                                rec.set("orden", "Y");
                                rec.set("idopcion", "999");
                                rec.set("iditem", "9999");
                                rec.commit();
                            }else{
                                rec.set("idmoneda", "USD");
                                rec.set("iditem", r.data.idconcepto);
                                rec.set("idconcepto", r.data.idconcepto);
                                rec.set("orden", "X");
                                Ext.getCmp("grid_productos").guardarGridProductosRec( rec );
                            }

                            //Inserta una columna en blanco al final
                            storeProductos.addSorted(newRec);
                            storeProductos.sort("orden", "ASC");

                        }else{
                            rec.set("idmoneda", "USD");
                            rec.set("iditem", r.data.idconcepto);
                        }
                        e.value = r.data.concepto;

                        return true;
                    }
                }
            )
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

    onRowcontextmenu :  function(grid, index, e){
        rec = this.store.getAt(index);
        var storeProductos = this.store;
        if(!this.menu){ // create context menu on first right click

            this.menu = new Ext.menu.Menu({
            id:'grid_productos-ctx',
            enableScrolling : false,
            items: [{
                        text: 'Editar trayecto',
                        iconCls: 'page_white_edit',
                        scope:this,
                        handler: function(){
                            if( this.ctxRecord ){
                                this.editarTrayecto( this.ctxRecord );
                            }
                        }
                    },
                    {
                        text: 'Importar del tarifario',
                        iconCls: 'import',
                        scope:this,
                        handler: function(){
                            if( this.ctxRecord ){
                                this.ventanaTarifario( this.ctxRecord );
                            }
                        }
                    },
                    {
                        text: 'Archivos del tarifario',
                        iconCls: 'import',
                        scope:this,
                        handler: function(){
                            if( this.ctxRecord ){
                                this.ventanaTarifarioArchivos( this.ctxRecord );
                            }
                        }
                    }
                    ,
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
                            if( this.ctxRecord.data.iditem  ){
                                this.observacionesHandler( this.ctxRecord );
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

        if( e.field=="aplica_tar" || e.field=="aplica_min" ){
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
            if( e.record.data.transporte=="<?=Constantes::AEREO?>" ){
                ed.field.store.loadData( dataAereo );
            }else{
                ed.field.store.loadData( dataMaritimo );
            }
        }

    },

    eliminarItem: function(){
        var storeProductos = this.store;
        if( this.ctxRecord && this.ctxRecord.data.iditem && confirm("Desea continuar?") ){
            if( this.ctxRecord.data.tipo=="concepto" ){
                var idconcepto = this.ctxRecord.data.iditem;
                var idrecargo = "";
            }else{
                var idconcepto = this.ctxRecord.data.idconcepto;
                var idrecargo = this.ctxRecord.data.iditem;
            }



            var id = this.ctxRecord.id;
            var tipo = this.ctxRecord.data.tipo;
            var idopcion = this.ctxRecord.data.idopcion;
            var idproducto = this.ctxRecord.data.idproducto;
            var modalidad = this.ctxRecord.data.modalidad;
            var idcotrecargo = this.ctxRecord.data.idcotrecargo;

            if(tipo=="recargo" && !idcotrecargo ){ // Como no se ha guardado simplemente  lo borra del store
                storeProductos.remove(this.ctxRecord);
                return 0;
            }


            if(tipo=="concepto" && !idopcion ){ // Como no se ha guardado simplemente  lo borra del store
                var parent = this.ctxRecord.data.parent;
                storeProductos.each( function( r ){
                    if( r.data.tipo=="recargo" && r.data.parent==parent ){
                        storeProductos.remove(r);
                    }
                });
                storeProductos.remove(this.ctxRecord);
                return 0;
            }


            if( idopcion ){
                Ext.Ajax.request(
                {
                    waitMsg: 'Guardando cambios...',
                    url: '<?=url_for("cotizaciones/eliminarItemsOpciones?idcotizacion=".$cotizacion->getCaIdcotizacion())?>',
                    //method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        id: id,
                        idconcepto: idconcepto,
                        idrecargo: idrecargo,
                        tipo: tipo,
                        idopcion: idopcion,
                        idproducto: idproducto,
                        idcotrecargo: idcotrecargo
                    },

                    //Ejecuta esta accion en caso de fallo
                    //(404 error etc, ***NOT*** success=false)
                    failure:function(response,options){
                        alert( response.responseText );
                        success = false;
                    },



                    //Ejecuta esta accion cuando el resultado es exitoso
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            record = storeProductos.getById( res.id );
                            storeProductos.remove(record);
                            if(tipo=="concepto"){
                                storeProductos.remove(record);

                                /*
                                * Se deben eliminar los recargos del concepto que se elimino ya que al enviar la
                                * petición son borrados de la base de datos.
                                */
                                storeProductos.each( function( r ){
                                    if( r.data.tipo=="recargo" && r.data.idopcion==record.data.idopcion ){
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
        if( this.ctxRecord && confirm("Desea continuar?") ){
            var idproducto = this.ctxRecord.data.idproducto;

            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?=url_for("cotizaciones/eliminarProducto?idcotizacion=".$cotizacion->getCaIdcotizacion())?>',
                //method: 'POST',
                //Solamente se envian los cambios
                params :	{
                    idproducto: idproducto
                },

                //Ejecuta esta accion en caso de fallo
                //(404 error etc, ***NOT*** success=false)
                failure:function(response,options){
                    alert( response.responseText );
                    success = false;
                },
                //Ejecuta esta accion cuando el resultado es exitoso
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        storeProductos.each( function( record ){
                            if( record.data.idproducto==idproducto ){
                                 storeProductos.remove(record);
                            }
                        });
                    }
                }
             }
        );
        }
    },
    nuevoRecargo: function(){
        rec = this.ctxRecord;
        var recordProductos = this.record;
        var storeProductos = this.store;
        if( rec.data.iditem && rec.data.idopcion ){
            if( rec.data.tipo=="concepto"){
                var idconcepto = rec.data.iditem;
            }else{
                var idconcepto = rec.data.idconcepto;
            }

            if( rec.data.idopcion=="999" ){
                var orden = "Y-Z";
            }
            else{
                var orden = rec.data.idopcion+"-Z";
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
            //newRec.id = rec.data.id+1;
            storeProductos.addSorted(newRec);
            newRec.set("idmoneda", "USD");
        }
    },

    observacionesHandler: function( rec ){
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
                    if( fp.getForm().isValid() ){

                        rec.set( "detalles",  fp.getForm().findField("observaciones").getValue() );
                        win.close();

                    }
                }
            },{
                text     : 'Cancelar',
                handler  : function(){
                    win.close();
                }
            }]
        });
        win.show( );
    },

    agregarTrayecto: function(  ){
        this.crearVentanaTrayecto( );
    },
    editarTrayecto: function( rec ){
        this.crearVentanaTrayecto( rec );
    },


    /*
    * Muestra una ventana enla que se puede crear o editar un trayecto
    */
    crearVentanaTrayecto: function( record ){
        storeProductos = this.store;
        //crea una ventana
        win = new Ext.Window({
            width       : 500,
            height      : 650,
            closeAction :'close',
            plain       : true,

            items       : new Ext.FormPanel({
                id: 'producto-form',
                layout: 'form',
                frame: true,
                title: 'Ingrese los datos del trayecto',
                autoHeight: true,
                bodyStyle: 'padding: 5px 5px 0 5px;',
                labelWidth: 100,

                items: [{
                            id: 'cotizacionId',
                            xtype:'hidden',
                            name: 'cotizacionId',
                            value: '<?=$cotizacion->getCaIdcotizacion()?>',
                            allowBlank:false
                        },{
                            id: 'idproducto',
                            xtype:'hidden',
                            name: 'idproducto',
                            value: '',
                            allowBlank:false
                        },{
                            xtype:'textfield',
                            fieldLabel: 'Producto',
                            id: 'producto',
                            name: 'producto',
                            value: '',
                            allowBlank:false,
                            width: 300
                        }
                        ,<?=include_component("widgets", "impoexpo" ,array("id"=>"impoexpo", "label"=>"Impo/Expo"))?>
                        ,<?=include_component("widgets", "incoterms" ,array("id"=>"incoterms"))?>
                        ,<?=include_component("widgets", "transportes" ,array("id"=>"transporte", "allowBlank"=>"false"))?>

                        ,<?=include_component("widgets", "modalidades" ,array("id"=>"modalidad", "label"=>"Modalidad", "allowBlank"=>"false", "transporte"=>"transporte", "impoexpo"=>"impoexpo"))?>
                        ,<?=include_component("widgets", "lineas" ,array("id"=>"idlinea", "label"=>"Linea", "allowBlank"=>"true", "link"=>"transporte" ))?>
                        ,{
                            xtype:'checkbox',
                            fieldLabel: 'Postular nombre de Linea',
                            id: 'postular_linea',
                            name: 'postular_linea',
                            value: false,
                            width: 300
                        }
                        ,<?=include_component("widgets", "paises" ,array("id"=>"tra_origen", "label"=>"Pais Origen", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_origen", "label"=>"Ciudad Origen", "link"=>"tra_origen", "allowBlank"=>"false"))?>


                        ,<?=include_component("widgets", "paises" ,array("id"=>"tra_destino", "label"=>" Pais Destino", "value"=>"C0-057", "allowBlank"=>"false"))?>									,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_destino", "label"=>"Ciudad Destino", "link"=>"tra_destino", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "paises" ,array("id"=>"tra_escala", "label"=>"Pais Escala"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_escala", "label"=>"Ciudad Escala", "link"=>"tra_escala"))?>
                        ,{
                            xtype: 'textarea',
                            width: 310,
                            height: 40,
                            fieldLabel: 'Observaciones',
                            name: 'observaciones',
                            value: '',
                            allowBlank:true
                        }
                        ,{
                            xtype: 'textfield',
                            width: 100,
                            fieldLabel: 'Frecuencia',
                            name: 'frecuencia',
                            value: '',
                            allowBlank:true
                        }
                        ,{
                            xtype: 'textfield',
                            width: 100,
                            fieldLabel: 'T/Transito',
                            name: 'ttransito',
                            value: '',
                            allowBlank:true
                        }
                        ,
                        new Ext.form.ComboBox({
                            fieldLabel: 'Imprimir',
                            typeAhead: true,
                            forceSelection: true,
                            triggerAction: 'all',
                            emptyText:'',
                            selectOnFocus: true,
                            name: 'imprimir',
                            id: 'imprimir',
                            value: 'Por Item',
                            lazyRender:true,
                            listClass: 'x-combo-list-small',
                            store: [['Por Item', 'Por Item'],['Puerto', 'Puerto'],['Concepto', 'Concepto'],['Trayecto', 'Trayecto']]
                        }),
                        {
                            xtype: 'datefield',
                            width: 100,
                            fieldLabel: 'Vigencia',
                            name: 'vigencia',
                            format: 'Y-m-d',
                            value: '',
                            allowBlank:false
                        }
                    ]



            }),

            buttons: [{
                text     : 'Guardar',
                handler: function(){
                    var fp = Ext.getCmp("producto-form");
                    if( fp.getForm().isValid() ){

                        ttransito = fp.getForm().findField("ttransito").getValue();
                        frecuencia = fp.getForm().findField("frecuencia").getValue();
                        impoexpo = fp.getForm().findField("impoexpo").getValue();
                        transporte = fp.getForm().findField("transporte").getValue();

                        if( ttransito=="" && frecuencia=="" && ((impoexpo=="<?=Constantes::IMPO?>" && transporte!="<?=Constantes::AEREO?>") || impoexpo=="<?=Constantes::EXPO?>" ) ){ // Solamente cuando es importación aérea se permite en blanco
                            Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', 'Por favor indique el tiempo de transito y la frecuencia');
                        }else{

                            fp.getForm().submit({url:'<?=url_for('cotizaciones/formProductoGuardar')?>',
                                                    waitMsg:'Salvando Datos de Productos...',
                                                    // standardSubmit: false,

                                                    success:function(response,options){
                                                        //Ext.Msg.alert( "Success "+response.responseText );
                                                        storeProductos.reload();
                                                        win.close();
                                                    },
                                                    failure:function(response,options){
                                                        Ext.Msg.alert( "Error "+response.responseText );
                                                        win.close();
                                                    }//end failure block
                                                });
                        }
                    }else{
                        Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', '¡Atención: La información del Producto no es válida o está incompleta!');
                    }
                }
            },{
                text     : 'Cancelar',
                handler  : function(){
                    win.close();
                }
            }]
        });



        win.show( );

        if(typeof(record)!="undefined"){ // Coloca los datos en la ventana
            var fp = Ext.getCmp("producto-form");
            form = fp.getForm().loadRecord(record);
            fp.getForm().findField("tra_origen_id").setRawValue(record.data.tra_origen_value);
            fp.getForm().findField("tra_origen_id").hiddenField.value = record.data.tra_origen;
            fp.getForm().findField("ciu_origen_id").setRawValue(record.data.ciu_origen_value);
            fp.getForm().findField("ciu_origen_id").hiddenField.value = record.data.ciu_origen;

            fp.getForm().findField("tra_destino_id").setRawValue(record.data.tra_destino_value);
            fp.getForm().findField("tra_destino_id").hiddenField.value = record.data.tra_destino;
            fp.getForm().findField("ciu_destino_id").setRawValue(record.data.ciu_destino_value);
            fp.getForm().findField("ciu_destino_id").hiddenField.value = record.data.ciu_destino;

            fp.getForm().findField("tra_escala_id").setRawValue(record.data.tra_escala_value);
            fp.getForm().findField("tra_escala_id").hiddenField.value = record.data.tra_escala;
            fp.getForm().findField("ciu_escala_id").setRawValue(record.data.ciu_escala_value);
            fp.getForm().findField("ciu_escala_id").hiddenField.value = record.data.ciu_escala;
            fp.getForm().findField("idlinea").setRawValue(record.data.linea);
            fp.getForm().findField("idlinea").hiddenField.value = record.data.idlinea;


            //Verifica que no hayan concepto para poder editar los campos impoexpo, transporte y modalidad
            storeProductos.each( function( r ){
                                    if( r.data.idproducto==record.data.idproducto ){
                                        fp.getForm().findField("impoexpo").disable();
                                        fp.getForm().findField("transporte").disable();
                                        fp.getForm().findField("modalidad").disable();
                                    }

                            });



        }


    },

    /*
    * Muestra una ventana con la informacion del tarifario y le permite al usuario
    * seleccionar las tarifas a importar
    */
    ventanaTarifario : function( record ){
        recordProductos = this.record;
        storeProductos = this.store;
        var url = '<?=url_for("pricing/grillaPorTrafico?opcion=consulta")?>';

        activeRecord = record;
        if(record.data.impoexpo=="<?=Constantes::IMPO?>"){
            idciudad = record.data.ciu_origen;
            idciudad2 = record.data.ciu_destino;
            idtrafico = record.data.tra_origen;
        }

        if(record.data.impoexpo=="<?=Constantes::EXPO?>"){
            idciudad2 = record.data.ciu_origen;
            idciudad = record.data.ciu_destino;
            idtrafico = record.data.tra_destino;
        }

        Ext.Ajax.request({
            url: url,
            params: {
                idtrafico: idtrafico,
                idciudad: idciudad,
                idciudad2: idciudad2,
                transporte: record.data.transporte,
                impoexpo: record.data.impoexpo,
                modalidad: record.data.modalidad,
                idlinea: record.data.idlinea
            },
            success: function(xhr) {
                //alert( xhr.responseText );
                var newComponent = eval(xhr.responseText);

                //Se crea la ventana

                win = new Ext.Window({
                width       : 800,
                height      : 460,
                closeAction :'close',
                plain       : true,

                items       : [newComponent],


                buttons: [
                    {
                        text     : 'Importar',
                        handler  : function( ){
                            storePricing = newComponent.store;

                            /*
                            * Si se seleccionas recargos generales sin seleccionar el concepto lo selecciona
                            */
                            var parentRecordId = null;
                            storePricing.each( function(r){
                                                    if(r.data.tipo=="recargoxciudad" || r.data.tipo=="recargoxlinea"){
                                                        var tipo="recargo";
                                                    }else{
                                                        var tipo = r.data.tipo;
                                                    }

                                                    if(tipo=="concepto"){
                                                        idconcepto = r.data.iditem;
                                                        if( idconcepto=="9999" ){
                                                            parentRecordId = r.id;
                                                        }
                                                    }
                                                    if(tipo=="recargo"){
                                                        if( r.data.idconcepto=="9999" && r.data.sel ){
                                                           parentRecord = storePricing.getById(parentRecordId);
                                                           parentRecord.set("sel", true);
                                                        }
                                                    }
                                                });

                            /*
                            * Busca el ultimo elemento para insertar al final del grupo
                            */

                            index =  storeProductos.indexOf(activeRecord);
                            var j = 0;
                            var idconcepto = null;


                            storePricing.each( function(r){

                                if(r.data.tipo=="recargoxciudad" || r.data.tipo=="recargoxlinea"){
                                    var tipo="recargo";
                                }else{
                                    var tipo = r.data.tipo;
                                }
                                if( r.data.sel==true && tipo!="trayecto_obs"  ){
                                    var flag = false;
                                    var iditem = r.data.iditem;
                                    //Cuando se habla de LCL se colocan los minimos
                                    if( tipo=="concepto" ){
                                        var valor_tar = r.data.sugerida; //Minima sugerida de venta
                                        var valor_min = ''; //No aplica
                                    }else{
                                        var valor_tar = r.data.sugerida;
                                        var valor_min = r.data.minima;
                                    }

                                    if(tipo=="concepto"){
                                        j++;
                                        idconcepto = r.data.iditem;

                                        if( idconcepto=="9999" ){
                                            var idopcion = '999'
                                            var orden = "Y";

                                            storeProductos.each( function( r2 ){
                                                if( r2.data.tipo=="concepto" && r2.data.idopcion=='999' && r2.data.idproducto==activeRecord.data.idproducto ){
                                                    flag = true;
                                                }
                                            });

                                        }else{
                                            var idopcion = ''
                                            var orden = "W"+j;
                                        }
                                    }



                                    //Esto es importante
                                    if(tipo=="recargo"){

                                        if( idconcepto!=r.data.idconcepto ){
                                            flag = true;
                                        }

                                        if( r.data.idconcepto=="9999" ){
                                            var idopcion = '999'
                                            var orden = "Y"+"-"+r.data.nconcepto;

                                        }else{
                                            var idopcion = ''
                                            var orden = "W"+j+"-"+r.data.nconcepto;
                                        }
                                    }
                                    if( !flag ){
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

                                        newRec.set("trayecto", activeRecord.data.trayecto );

                                        storeProductos.addSorted( newRec );

                                        //Es necesario buscar de nuevo el record dentro del store
                                        //para que se activen los eventos de edición del store
                                        var newRec = storeProductos.getById( newRec.id );

                                        newRec.set("item", r.data.nconcepto );
                                        newRec.set("idconcepto", r.data.idconcepto )

                                        newRec.set("iditem", iditem );


                                        newRec.set("tipo", tipo );
                                        newRec.set("valor_tar", valor_tar );
                                        newRec.set("aplica_tar", r.data.aplicacion );
                                        newRec.set("aplica_min", r.data.aplicacion_min );
                                        newRec.set("valor_min", valor_min );
                                        newRec.set("idmoneda", r.data.moneda );
                                        newRec.set("consecutivo", r.data.consecutivo );
                                   }

                                }
                            } );

                            win.close();
                        }
                    },
                    {
                        text     : 'Cancelar',
                        handler  : function(){
                            win.close();
                        }
                    }
                ]
            });
            win.show( );
            },
            failure: function() {
                Ext.Msg.alert("Tab creation failed", "Server communication failure");
            }
        });
    },

    /*
    * Muestra una ventana con la informacion de los archivos tarifario del trafico
    */
    ventanaTarifarioArchivos: function( record ){
        var url = '<?=url_for("pricing/archivosPais?opcion=consulta")?>';

        activeRecord = record;
        if(record.data.impoexpo=="<?=Constantes::IMPO?>"){
            idtrafico = record.data.tra_origen;
        }

        if(record.data.impoexpo=="<?=Constantes::EXPO?>"){
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
                //alert( xhr.responseText );
                var newComponent = eval(xhr.responseText);

                //Se crea la ventana
                win = new Ext.Window({
                width       : 550,
                height      : 300,
                closeAction :'close',
                plain       : true,
                items       : [newComponent]
            });
            win.show( );
            },
            failure: function() {
                Ext.Msg.alert("Win creation failed", "Server communication failure");
            }
        });
    }




});




</script>