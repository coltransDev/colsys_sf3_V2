<?
$aduanas = $sf_data->getRaw("aduanas");
?>
<script type="text/javascript">
PanelAduanas = function( config ){
    Ext.apply(this, config);

    this.data = <?=json_encode( array("aduanas"=>$aduanas, "total"=>count($aduanas)) )?>;
    /*
    * Crea el Record
    */
    this.record = Ext.data.Record.create([
        {name: 'idcotizacion', type: 'string'},
        {name: 'transporte', type: 'string'},
        {name: 'transportes', type: 'string'},
        {name: 'consecutivo', type: 'int'},
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
                root: 'aduanas',
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
        autoLoad : false,
        id:"store-recargos",
        url: '<?=url_for("conceptos/datosConceptos")?>',
        baseParams : {
            impoexpo: this.impoexpo,
            transporte: this.transporte,
            modo: "costos"
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

    if (this.impoexpo == "Exportacion") {
        this.headerImpoexpo = "Medio de Transporte";
        this.storeTransportes = [['Maritimo', 'Marítimo'],['Aereo', 'Aéreo'],['Terrestre', 'Terrestre']];
    }else{
        this.headerImpoexpo = "Tipo de Nacionalización";
        this.storeTransportes = [['Marítimo', 'Nacionalización en Puerto'],['Aéreo', 'Nacionalización Aéreo/OTM']];
    }
    

    this.editorTransportes = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',        
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store: this.storeTransportes,
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
                id: 'transportes',
                header: this.headerImpoexpo,
                width: 170,
                sortable: true,
                dataIndex: 'transportes',
                hideable: false,
                editor: this.editorTransportes
            },{
                header: "Concepto",
                dataIndex: 'concepto',
                hideable: false,
                width: 170,
                renderer: this.formatItem,
                sortable: this.readOnly,
                editor: this.editorRecargos
            },{
                header: "Valor",
                dataIndex: 'valor',
                hideable: false,
                width: 170,       
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
                width: 170,        
                sortable: this.readOnly,
                editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
            },{
                header: "Valor Minimo",
                dataIndex: 'valorminimo',
                hideable: false,
                width: 170,
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
                width: 170,        
                sortable: this.readOnly,
                editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
            },{
                header: "Fecha Inicial",
                dataIndex: 'fchini',
                hideable: false,
                width: 170,       
                sortable: this.readOnly,
                renderer: Ext.util.Format.dateRenderer('Y/m/d'),
                editor: new Ext.form.DateField({
                        format: 'Y/m/d'
                })
            },{
                header: "Fecha Final",
                dataIndex: 'fchfin',
                hideable: false,
                width: 170,       
                sortable: this.readOnly,
                renderer: Ext.util.Format.dateRenderer('Y/m/d'),
                editor: new Ext.form.DateField({
                        format: 'Y/m/d'
                })
            },{
                id: 'observaciones',
                header: "Observaciones",
                width: 100,
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


    PanelAduanas.superclass.constructor.call(this, {
        master_column_id : 'aduana',
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        stripeRows: true,
        autoExpandColumn: 'aduana',
        title: this.title,
        closable: false,
        id: 'grid_aduanas',

        tbar: [{
                text: 'Guardar Cambios',
                tooltip: 'Guarda los cambios realizados en Aduanas',
                iconCls: 'disk',  // reference to our css
                id: 'guardarbtn-aduanas',
                handler: function(){
                    Ext.getCmp("subpanel-cotizaciones").guardarDatosPaneles();
                }
            }, {
                text: 'Agregar Aduana',
                tooltip: 'Opción para agregar opciones de Aduana',
                iconCls: 'add',  // reference to our css
                scope:this,
                handler: function(){
                    Ext.getCmp("grid_aduanas").agregarFilaAduanas();
                }
            }, {
                text: 'Importar del tarifario',
                tooltip: 'Opción para agregar opciones de Aduana',
                iconCls: 'import',  // reference to our css
                scope:this,
                handler: function(){
                    Ext.getCmp("grid_aduanas").ventanaTarifarioAduanas();
                }
            }, {
                text: 'Recargar',
                tooltip: 'Actualiza los registros y elimina modifcaciones',
                iconCls: 'refresh',  // reference to our css
                handler: function(){
                    var storeAduanas = Ext.getCmp("grid_aduanas").store;
                    if(storeAduanas.getModifiedRecords().length>0){
                        if(!confirm("Se perderan los cambios no guardados en el directorio de agentes unicamente, desea continuar?")){
                            return 0;
                        }
                    }
                    storeAduanas.reload();
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


Ext.extend(PanelAduanas, Ext.grid.EditorGridPanel, {
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
                            var storeAduanasCot = this.store;
                            if( oid ){
                                if( this.ctxRecord && confirm("Desea continuar?") ){
                                    Ext.Ajax.request(
                                    {
                                        waitMsg: 'Guardando cambios...',
                                        url: '<?=url_for("cotizaciones/eliminarGrillaAduanas?idcotizacion=".$cotizacion->getCaIdcotizacion())?>',
                                        //method: 'POST',
                                        //Solamente se envian los cambios
                                        params :	{
                                            oid: oid,
                                            id: id
                                        },

                                        callback :function(options, success, response){

                                            var res = Ext.util.JSON.decode( response.responseText );
                                            storeAduanasCot.each( function( record ){
                                                    if( record.id==res.id ){
                                                        storeAduanasCot.remove(record);
                                                    }
                                            });
                                        }
                                    });
                                }
                            } else {
                                storeAduanasCot.remove(this.ctxRecord);
                            }
                        }
                    }
                ]
        });
        return menu;
            
    },

    onRowcontextMenu: function(grid, index, e){
        var storeAduanasCot = this.store;
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
        
        if( columnIndex == 10 ){
            storeAduanasCot = grid.store;
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
        }
        else if( e.field == "concepto" ){
            this.storeRecargos.removeAll();
            this.storeRecargos.setBaseParam("transporte",e.record.data.transporte);
            this.storeRecargos.load();
        }
        else if( e.field == "parametro" ){
            this.storeParametros.removeAll();
            this.storeParametros.setBaseParam("idconcepto",e.record.data.idconcepto);
            this.storeParametros.load();
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
         }else if( e.field == "transportes"){
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

        var storeAduanasCot = this.store;
        var success = true;
        var records = storeAduanasCot.getModifiedRecords();

        var lenght = records.length;

        //Validacion
        for( var i=0; i< lenght; i++){
            r = records[i];
            if( !r.data.transportes ){
                if (this.impoexpo == "Exportacion"){
                    Ext.Msg.alert( "","Debe elegir un Medio de Transporte" );
                }else{
                    Ext.Msg.alert( "","Debe elegir una modalidad de Nacionalización" );
                }
                return 0;
            }

            if( !r.data.concepto ){
                Ext.Msg.alert( "","Debe elegir un concepto de Aduana" );
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

        Ext.getCmp('guardarbtn-aduanas').disable();
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
                    url: '<?=url_for("cotizaciones/observeAduanasManagement")?>',
                    //Solamente se envian los cambios
                    params :	changes,

                    success:function(response,options){

                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            var rec = storeAduanasCot.getById( res.id );
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
        Ext.getCmp('guardarbtn-aduanas').enable();
    },

    agregarFilaAduanas: function(){
        var recordGrilla = this.record;
        var storeAduanasCot = this.store;

        var rec = new recordGrilla({idcotizacion:'<?=$cotizacion->getCaIdcotizacion()?>',
                              transporte:'',
                              transportes:'',
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
        storeAduanasCot.insert( 0, rec );
        this.startEditing( 0, 1 );
    },

    /*
    * Muestra una ventana con la informacion del tarifario y le permite al usuario
    * seleccionar las tarifas a importar
    */
    ventanaTarifarioAduanas: function( ){
        var recordGrilla = this.record;
        var storeAduanasCot = this.store;

        var url = '<?=url_for("cotizaciones/tarifarioAduanas?idcotizacion=".$cotizacion->getcaIdcotizacion())?>';

        Ext.Ajax.request({
            url: url,
            params: {

            },
            success: function(xhr) {
                //alert( xhr.responseText );
                var newComponent = eval(xhr.responseText);

                //Se crea la ventana

                winAduanas = new Ext.Window({
                width       : 1000,
                height      : 460,
                closeAction :'close',
                plain       : true,

                items       : [newComponent],


                buttons: [
                    {
                        text     : 'Importar',
                        handler  : function( ){
                            storeAduanaPric = newComponent.store;
                            var index = 0;

                            storeAduanaPric.each( function(r){
                                if( r.data.sel==true ){

                                    var rec = new recordGrilla({idcotizacion:'<?=$cotizacion->getCaIdcotizacion()?>',
                                                          transporte:'',
                                                          transportes:'',
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
                                    //storeAduanasCot.insert( index, records );
                                    storeAduanasCot.insert( 0, records );
                                    rec = storeAduanasCot.getAt(0);
                                    rec.set("transporte", r.data.transporte );
                                    rec.set("transportes", r.data.transportes );
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

                            winAduanas.close();
                        }
                    },
                    {
                        text     : 'Cancelar',
                        handler  : function(){
                            winAduanas.close();
                        }
                    }
                ]
            });
            winAduanas.show( );
            },
            failure: function() {
                Ext.Msg.alert("Tab creation failed", "Server communication failure");
            }
        });
    }

});
</script>