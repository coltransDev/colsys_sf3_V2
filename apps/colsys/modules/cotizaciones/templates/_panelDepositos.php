<?
$depositos = $sf_data->getRaw("depositos");
?>
<script type="text/javascript">
PanelDepositos = function( config ){
    Ext.apply(this, config);

    this.data = <?=json_encode( array("depositos"=>$depositos, "total"=>count($depositos)) )?>;
    /*
    * Crea el Record
    */
    this.record = Ext.data.Record.create([
        {name: 'idcotizacion', type: 'string'},
        {name: 'transporte', type: 'string'},
        {name: 'consecutivo', type: 'int'},
        {name: 'parametros', type: 'string'},
        {name: 'idconcepto', type: 'int'},
        {name: 'concepto', type: 'string'},
        {name: 'parametro', type: 'string'},
        {name: 'valor', type: 'float'},
        {name: 'aplicacion', type: 'string'},
        {name: 'valorminimo', type: 'float'},
        {name: 'aplicacionminimo', type: 'string'},
        {name: 'observaciones', type: 'string'},
        {name: 'fchini', type: 'date'},
        {name: 'fchfin', type: 'date'},
        {name: 'idcotizacion', type: 'int'},
        {name: 'orden', type: 'string'},
        {name: 'oid', type: 'string'}
    ]);

    /*
    * Crea el store
    */
    this.store = new Ext.data.Store({
        autoLoad : true,
        reader: new Ext.data.JsonReader(
            {
                root: 'depositos',
                totalProperty: 'total'
            },
            this.record
        ),
        sortInfo:{field: 'transporte', direction: "ASC"},
        proxy: new Ext.data.MemoryProxy(this.data)
    });

    /*
    *Store que carga los conceptos
    */
    this.storeRecargos = new Ext.data.Store({
        autoLoad : true,
        id:"store-recargos",
        url: '<?=url_for("conceptos/datosConceptos")?>',
        baseParams : {
            impoexpo: "Depósitos", //[FIX-ME] Organizar todos los conceptos
            parametro: this.parametros,
            modo: "parametros"
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
        id:"editor-recargos",
        name:"editor-recargos",
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        displayField: 'concepto',
        valueField: 'idconcepto',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : this.storeRecargos/*,
        listeners:{
            select:function(combo, record, index)
            {
                Ext.getCmp("editor-recargos").store.setBaseParam("transporte",record.data.field1);
                Ext.getCmp("editor-recargos").store.reload();
            }
        }*/
    });

    this.editorModalidad = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',        
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store: [['Carga Aérea y Carga Suelta','Carga Aérea y Carga Suelta'],['Contenedor 20 pies','Contenedor 20 pies'],['Contenedor 40 pies','Contenedor 40 pies']]
    });

    this.columns = [
            {
                id: 'oid',
                header: "Oid",
                width: 10,
                sortable: true,
                dataIndex: 'oid',
                hideable: false,
                hidden: true
            },{
                id: 'parametros',
                header: "Modalidad",
                width: 170,
                sortable: true,
                dataIndex: 'parametros',
                hideable: false,
                editor: this.editorModalidad
            },{
                header: "Concepto",
                dataIndex: 'concepto',
                hideable: false,
                width: 170,
                renderer: this.formatItem,
                sortable: this.readOnly,
                editor: this.editorRecargos
            },{
                id: 'parametro',
                header: "Parámetro",
                width: 140,
                sortable: true,
                dataIndex: 'parametro',
                hideable: false,
                editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
            },{
                header: "Valor",
                dataIndex: 'valor',
                hideable: false,
                width: 100,       
                sortable: this.readOnly,
                renderer: this.formatNumber,
                editor: new Ext.form.NumberField({
                            allowBlank: false ,
                            style: 'text-align:left',
                            allowNegative: false,
                            decimalPrecision :2
                        })
            },{
                header: "Aplicacion",
                dataIndex: 'aplicacion',
                hideable: false,
                width: 140,        
                sortable: this.readOnly,
                editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
            },{
                header: "Valor Minimo",
                dataIndex: 'valorminimo',
                hideable: false,
                width: 100,
                sortable: this.readOnly,
                renderer: this.formatNumber,
                editor: new Ext.form.NumberField({
                            allowBlank: false ,
                            style: 'text-align:left',
                            decimalPrecision :2
                        })
            },{
                header: "Aplicacion Min",
                dataIndex: 'aplicacionminimo',
                hideable: false,
                width: 140,        
                sortable: this.readOnly,
                editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
            },{
                header: "Fecha Inicial",
                dataIndex: 'fchini',
                hideable: false,
                width: 120,       
                sortable: this.readOnly,
                renderer: Ext.util.Format.dateRenderer('Y/m/d'),
                editor: new Ext.form.DateField({
                        format: 'Y/m/d'
                })
            },{
                header: "Fecha Final",
                dataIndex: 'fchfin',
                hideable: false,
                width: 120,       
                sortable: this.readOnly,
                renderer: Ext.util.Format.dateRenderer('Y/m/d'),
                editor: new Ext.form.DateField({
                        format: 'Y/m/d'
                })
            },{
                id: 'observaciones',
                header: "Observaciones",
                width: 180,
                sortable: true,
                dataIndex: 'observaciones',
                hideable: false,
                editor: new Ext.form.TextArea({
                            name: 'observaciones'
                })
            }
            <?
            if($modo!="consulta"){
            ?>
            ,
            {
                xtype: 'actioncolumn',
                width: 25,
                items: [{
                    icon   : '/images/fam/table_add.png',  // Use a URL in the icon config
                    tooltip: 'Menu contextual'
                }]
            }
            <?
            }
            ?>
    ];


    PanelDepositos.superclass.constructor.call(this, {

        master_column_id : 'deposito',
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        stripeRows: true,
        autoExpandColumn: 'deposito',
        title: this.title,
        closable: false,
        id: 'grid_depositos',

        tbar: [
        {
            text: 'Guardar Cambios',
            tooltip: 'Guarda los cambios realizados en Depositos',
            iconCls: 'disk',  // reference to our css
            id: 'guardarbtn-depositos',
            handler: function(){
                Ext.getCmp("subpanel-cotizaciones").guardarDatosPaneles();
            }
        }
        ,
        {
            text: 'Importar del tarifario',
            tooltip: 'Opción para agregar opciones de Deposito',
            iconCls: 'import',  // reference to our css
            scope:this,
            handler: function(){
                Ext.getCmp("grid_depositos").ventanaTarifarioDepositos();
            }
        }
        ,
        {
            text: 'Concepto de Depósito',
            tooltip: 'Opción para agregar opciones de Deposito',
            iconCls: 'add',  // reference to our css
            scope:this,
            handler: function(){
                Ext.getCmp("grid_depositos").agregarFilaDepositos();
            }
        }
        ,
        {
            text: 'Recargar Conceptos',
            tooltip: 'Descarta las modificaciones no salvadas',
            iconCls: 'refresh',  // reference to our css
            scope:this,
            handler: function(){
                Ext.getCmp("grid_depositos").getStore().removeAll();
                Ext.getCmp("grid_depositos").getStore().reload();
            }
        }

        ],

        view: new Ext.grid.GridView({
            forceFit:true,
            enableRowBody:false
        })	,

        listeners:{
            beforeedit: this.onBeforeEdit,
            validateedit: this.onValidateEdit,
            rowcontextmenu:this.onRowcontextMenu,
            cellclick:this.onRowcellclick
        }
    });
}


Ext.extend(PanelDepositos, Ext.grid.EditorGridPanel, {
    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    },
    
    createMenu: function(){
        var menu = new Ext.menu.Menu({
            enableScrolling : false,
            items: [
                    {
                        text: 'Eliminar item',
                        iconCls: 'delete',
                        scope:this,
                        handler: function(){
                            var id = this.ctxRecord.id;
                            var oid = this.ctxRecord.data.oid;
                            var storeDepositosCot = this.store;
                            if( oid ){
                                if( this.ctxRecord && confirm("Desea continuar?") ){
                                    Ext.Ajax.request(
                                    {
                                        waitMsg: 'Guardando cambios...',
                                        url: '<?=url_for("cotizaciones/eliminarGrillaDepositos?idcotizacion=".$cotizacion->getCaIdcotizacion())?>',
                                        //method: 'POST',
                                        //Solamente se envian los cambios
                                        params :	{
                                            oid: oid,
                                            id: id
                                        },

                                        callback :function(options, success, response){

                                            var res = Ext.util.JSON.decode( response.responseText );
                                            storeDepositosCot.each( function( record ){
                                                    if( record.id==res.id ){
                                                        storeDepositosCot.remove(record);
                                                    }
                                            });
                                        }
                                    });
                                }
                            } else {
                                storeDepositosCot.remove(this.ctxRecord);
                            }
                        }
                    }
                ]
        });
        return menu;
            
    },

    onRowcontextMenu: function(grid, index, e){
        var storeDepositosCot = this.store;
        rec = this.store.getAt(index);

        if(!this.menu){ // create context menu on first right click
            this.menu = this.createMenu();
            this.menu.on('hide', this.onContextHide, this);
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
    
    onRowcellclick: function( grid, rowIndex, columnIndex, e ){    
        if( columnIndex == 11 ){
            storeDepositosCot = grid.store;
            var store = this.store;
            this.ctxRecord = this.store.getAt( rowIndex );

            if(!this.menu){ // create context menu on first right click

                this.menu = this.createMenu();

                this.menu.on('hide', this.onContextHide , this);
            }
            this.menu.showAt(e.getXY());
        }
    },
    
    onBeforeEdit: function(e){
        if( e.field=="aplicacion" || e.field=="aplicacionminimo" ){
            var data = [
                <?
                $i=0;
                foreach( $aplicaciones as $aplicacion ){
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
            ed.field.store.loadData( data );            
        }else if( e.field == "parametro" ){
            var data = [
                <?
                $i=0;
                foreach( $parametros as $key => $parametro ){
                    if( $i++!=0){
                        echo ",";
                    }
                ?>
                    ['<?=$parametro["ca_parametro"]?>']
                <?
                }
                ?>
            ];

            var ed = this.colModel.getCellEditor(e.column, e.row);            
            ed.field.store.loadData( data );            
        }else if( e.field == "concepto" ){
            this.storeRecargos.removeAll();
            this.storeRecargos.setBaseParam("parametro",e.record.data.parametros);
            this.storeRecargos.load();
        }
    },

    onValidateEdit : function(e){
    
        var rec = e.record;
        var ed = this.colModel.getCellEditor(e.column, e.row);
        var store = ed.field.store;
        var recordConcepto = this.record;
        var storeGrid = this.store;
        recordsConceptos = storeGrid.getRange();
        if( e.field == "concepto"){
            for( var j=0; j< recordsConceptos.length; j++){
                if( recordsConceptos[j].data.tipo=="concepto" ){
                    if(recordsConceptos[j].data.idconcepto==e.value)
                    {
                        alert(r.data.idconcepto);
                    }
                }
            }
        
            store.each( function( r ){            
                if( r.data.idconcepto==e.value ){
                    rec.set("idconcepto", r.data.idconcepto );
                    e.value = r.data.concepto;
                    return true;
                }
            });
         }else if( e.field == "nacionalizacion"){
             store.each( function( r ){
                 if( r.data.field1==e.value ){
                    rec.set("transporte", r.data.field1 );
                    e.value = r.data.field2;
                    return true;
                 }
             }
             )
         }
    },

    /*
    * Lanza lan función de actualización de registros modificados
    */
    guardarItems: function(){

        var storeDepositosCot = this.store;
        var success = true;
        var records = storeDepositosCot.getModifiedRecords();

        var lenght = records.length;

        //Validacion
        for( var i=0; i< lenght; i++){
            r = records[i];
            if( !r.data.parametros ){
                Ext.Msg.alert( "","Debe elegir una modalidad de Depósito" );
                return 0;
            }

            if( !r.data.concepto ){
                Ext.Msg.alert( "","Debe elegir un concepto de Deposito" );
                return 0;
            }

            if( !r.data.fchini ){
                Ext.Msg.alert( "","Por favor ingrese el inicio de la vigencia" );
                return 0;
            }

            if( !r.data.fchfin ){
                Ext.Msg.alert( "","Por favor ingrese el final de la vigencia" );
                return 0;
            }

        }

        Ext.getCmp('guardarbtn-depositos').disable();
        window.setTimeout(this.enableButton, 3000);

        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();

            changes['cotizacionId']=r.data.idcotizacion;
            changes['oid']=r.data.oid;
            changes['id']=r.id;

            //envia los datos al servidor
            Ext.Ajax.request(
                {
                    waitMsg: 'Guardando cambios...',
                    url: '<?=url_for("cotizaciones/observeDepositosManagement")?>',
                    //Solamente se envian los cambios
                    params :	changes,

                    success:function(response,options){

                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            var rec = storeDepositosCot.getById( res.id );
                            rec.set( "oid", res.oid);
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
            r.set("sel", false);//Quita la seleccion de todas las columnas
        }
    },

    enableButton: function(){
        Ext.getCmp('guardarbtn-depositos').enable();
    },

    agregarFilaDepositos: function(){
        var recordGrilla = this.record;
        var storeDepositosCot = this.store;

        var rec = new recordGrilla({idcotizacion:'<?=$cotizacion->getCaIdcotizacion()?>',
                              nacionalizacion:'',
                              idconcepto:0,
                              concepto:'',
                              parametro:'',
                              valor:0,
                              aplicacion:'',
                              valorminimo:0,
                              aplicacionminimo:'',
                              fchini:'',
                              fchfin:'',
                              observaciones:'',
                              orden:'Z'
                            });
        storeDepositosCot.insert( 0, rec );
        this.startEditing( 0, 1 );
    },

    /*
    * Muestra una ventana con la informacion del tarifario y le permite al usuario
    * seleccionar las tarifas a importar
    */
    ventanaTarifarioDepositos: function( ){
        var recordGrilla = this.record;
        var storeDepositosCot = this.store;

        var url = '<?=url_for("cotizaciones/tarifarioDepositos?idcotizacion=".$cotizacion->getcaIdcotizacion())?>';

        Ext.Ajax.request({
            url: url,
            params: {

            },
            success: function(xhr) {
                //alert( xhr.responseText );
                var newComponent = eval(xhr.responseText);

                //Se crea la ventana

                winDepositos = new Ext.Window({
                width       : 1000,
                height      : 460,
                closeAction :'close',
                plain       : true,

                items       : [newComponent],


                buttons: [
                    {
                        text     : 'Importar',
                        handler  : function( ){
                            storeDepositoPric = newComponent.store;
                            var index = 0;

                            storeDepositoPric.each( function(r){
                                if( r.data.sel==true ){

                                    var rec = new recordGrilla({idcotizacion:'<?=$cotizacion->getCaIdcotizacion()?>',
                                                          transporte:'',
                                                          parametros:'',
                                                          idconcepto:0,
                                                          concepto:'',
                                                          parametro:'',
                                                          valor:0,
                                                          aplicacion:'',
                                                          valorminimo:0,
                                                          aplicacionminimo:'',
                                                          fchini:'',
                                                          fchfin:'',
                                                          observaciones:'',
                                                          orden:'Z'
                                                        });
                                    records = [];
                                    records.push( rec );
                                    //storeDepositosCot.insert( index, records );
                                    storeDepositosCot.insert( 0, records );
                                    rec = storeDepositosCot.getAt(0);
                                    rec.set("transporte", r.data.transporte );
                                    rec.set("parametros", r.data.parametros );
                                    rec.set("idconcepto", r.data.idconcepto );
                                    rec.set("concepto", r.data.concepto );
                                    rec.set("parametro", r.data.parametro );
                                    rec.set("valor", r.data.valor );
                                    rec.set("valorminimo", r.data.valorminimo );
                                    rec.set("aplicacion", r.data.aplicacion );
                                    rec.set("aplicacionminimo", r.data.aplicacionminimo );
                                    rec.set("fchini", r.data.fchini );
                                    rec.set("fchfin", r.data.fchfin );
                                    rec.set("observaciones", r.data.observaciones );
                                    index++;
                                }
                            } );

                            winDepositos.close();
                        }
                    },
                    {
                        text     : 'Cancelar',
                        handler  : function(){
                            winDepositos.close();
                        }
                    }
                ]
            });
            winDepositos.show( );
            },
            failure: function() {
                Ext.Msg.alert("Tab creation failed", "Server communication failure");
            }
        });
    }

});
</script>