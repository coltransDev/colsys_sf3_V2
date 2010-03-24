<?
$seguros = $sf_data->getRaw("seguros");
include_component("cotizaciones", "formTrayectoAduanaWindow", array("cotizacion"=>$cotizacion) );
?>
<script type="text/javascript">
PanelSeguros = function( config ){
    Ext.apply(this, config);
    
    this.data = <?=json_encode( array("seguros"=>$seguros, "total"=>count($seguros)) )?>;
    /*
    * Crea el Record
    */
    this.record = Ext.data.Record.create([
        {name: 'idcotizacion', type: 'string'},
        {name: 'idmoneda', type: 'string'},
        {name: 'prima_tip', type: 'string'},
        {name: 'prima_vlr', type: 'string'},
        {name: 'prima_min', type: 'string'},
        {name: 'obtencion', type: 'string'},
        {name: 'observaciones', type: 'string'},
        {name: 'transporte', type: 'string'},
        {name: 'oid', type: 'string'}
    ]);
    
    /*
    * Crea el store
    */
    this.store = new Ext.data.Store({
        autoLoad : true,
        reader: new Ext.data.JsonReader(
            {
                root: 'seguros',
                totalProperty: 'total'
            },
            this.record
        ),
        proxy: new Ext.data.MemoryProxy(this.data)
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
                id: 'transporte',
                header: "Transporte",
                width: 25,
                sortable: true,
                dataIndex: 'transporte',
                hideable: false,
                editor: <?=include_component("widgets", "transportes" ,array("id"=>"transporte", "allowBlank"=>"false"))?>

            },{
                id: 'prima_tip',
                header: "Tipo",
                width: 10,
                sortable: true,
                dataIndex: 'prima_tip',
                hideable: false,
                editor: new Ext.form.ComboBox({
                        fieldLabel: 'Tipo Recargo',
                        typeAhead: true,
                        forceSelection: true,
                        triggerAction: 'all',
                        emptyText:'',
                        selectOnFocus: true,
                        lazyRender:true,
                        listClass: 'x-combo-list-small',
                        store: [['$', '$'],['%', '%']]
                    })

            },{
                id: 'prima_vlr',
                header: "Prima",
                width: 25,
                sortable: true,
                renderer: Ext.util.Format.defaultValue,
                dataIndex: 'prima_vlr',
                hideable: false,
                editor: new Ext.form.NumberField({
                            name: 'prima_vlr',
                            allowBlank:false,
                            allowNegative: false
                })
            },{
                id: 'prima_min',
                header: "Mínimo",
                width: 25,
                sortable: true,
                renderer: Ext.util.Format.defaultValue,
                dataIndex: 'prima_min',
                hideable: false,
                editor: new Ext.form.NumberField({
                            name: 'prima_min',
                            allowBlank:false,
                            allowNegative: false
                })
            },{
                id: 'obtencion',
                header: "Obtención Póliza",
                width: 25,
                sortable: true,
                renderer: Ext.util.Format.defaultValue,
                dataIndex: 'obtencion',
                hideable: false,
                editor: new Ext.form.NumberField({
                            name: 'obtencion',
                            allowBlank:false,
                            allowNegative: false
                })
            },{
                id: 'idmoneda',
                header: "Moneda",
                width: 15,
                sortable: true,
                dataIndex: 'idmoneda',
                hideable: false,
                editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
            },{
                id: 'observaciones',
                header: "Observaciones",
                width: 100,
                sortable: true,
                dataIndex: 'observaciones',
                hideable: false,
                editor: new Ext.form.TextField({
                            name: 'observaciones'
                })
            }
    ];


    PanelSeguros.superclass.constructor.call(this, {
        
        master_column_id : 'seguro',        
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        stripeRows: true,
        autoExpandColumn: 'seguro',
        title: 'Tarifas para Seguro ',
        closable: false,
        id: 'grid_seguros',

        tbar: [
        {
            text: 'Guardar Cambios',
            tooltip: 'Guarda los cambios realizados en Seguros',
            iconCls: 'disk',  // reference to our css
            handler: function(){
                Ext.getCmp("subpanel-cotizaciones").guardarDatosPaneles();
            }
        }
        ,
        {
            text: 'Importar del tarifario',
            tooltip: 'Opción para agregar opciones de Seguro',
            iconCls: 'import',  // reference to our css
            scope:this,
            handler: function(){
                Ext.getCmp("grid_seguros").ventanaTarifarioSeguros();
            }
        }
        ,
        {
            text: 'Agregar Seguro',
            tooltip: 'Opción para agregar opciones de Seguro',
            iconCls: 'add',  // reference to our css
            scope:this,
            handler: function(){
                Ext.getCmp("grid_seguros").agregarFilaSeguros();
            }
        }

        ],

        view: new Ext.grid.GridView({
            forceFit:true,
            enableRowBody:false
        })	,

        listeners:{
            rowcontextmenu:this.onRowcontextMenu
        }
    });
}


Ext.extend(PanelSeguros, Ext.grid.EditorGridPanel, {
    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    },

    onRowcontextMenu: function(grid, index, e){
        var storeSegurosCot = this.store;
        rec = this.store.getAt(index);
        
        if(!this.menu){ // create context menu on first right click
            this.menu = new Ext.menu.Menu({            
            enableScrolling : false,
            items: [
                    {
                        text: 'Eliminar item',
                        iconCls: 'delete',
                        scope:this,
                        handler: function(){
                            if( this.ctxRecord && confirm("Desea continuar?") ){


                                var id = this.ctxRecord.id;
                                var oid = this.ctxRecord.data.oid;

                                if( oid ){
                                    Ext.Ajax.request(
                                    {
                                        waitMsg: 'Guardando cambios...',
                                        url: '<?=url_for("cotizaciones/eliminarGrillaSeguros?idcotizacion=".$cotizacion->getCaIdcotizacion())?>',
                                        //method: 'POST',
                                        //Solamente se envian los cambios
                                        params :	{
                                            oid: oid,
                                            id: id
                                        },

                                        callback :function(options, success, response){

                                            var res = Ext.util.JSON.decode( response.responseText );
                                            storeSegurosCot.each( function( record ){
                                                    if( record.id==res.id ){
                                                        storeSegurosCot.remove(record);
                                                    }
                                            });
                                        }
                                    });
                                }
                            }
                        }
                    }
                    ]
            });
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

    /*
    * Lanza lan función de actualización de registros modificados
    */
    guardarItems: function(){
        
        var storeSegurosCot = this.store;
        var success = true;
        var records = storeSegurosCot.getModifiedRecords();

        var lenght = records.length;

        //Validacion
        for( var i=0; i< lenght; i++){
            r = records[i];
            if( !r.data.idmoneda ){
                Ext.Msg.alert( "","Por favor coloque la moneda en todos los items en la pestaña seguros" );
                return 0;
            }

            if( !r.data.prima_tip ){
                Ext.Msg.alert( "","Por favor coloque el tipo de seguro" );
                return 0;
            }

            if( !r.data.prima_vlr ){
                Ext.Msg.alert( "","Por favor coloque el valor de la prima" );
                return 0;
            }

            if( !r.data.prima_min ){
                Ext.Msg.alert( "","Por favor coloque el valor minimo" );
                return 0;
            }

            if( !r.data.obtencion ){
                Ext.Msg.alert( "","Por favor coloque el valor de obtención de la poliza" );
                return 0;
            }

            if( !r.data.transporte ){
                Ext.Msg.alert( "","Por favor coloque el transporte" );
                return 0;
            }

        }

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
                    url: '<?=url_for("cotizaciones/observeSegurosManagement")?>',
                    //Solamente se envian los cambios
                    params :	changes,

                    callback :function(options, success, response){

                        var res = Ext.util.JSON.decode( response.responseText );
                        var rec = storeSegurosCot.getById( res.id );
                        rec.commit();
                    }
                 }
            );
            r.set("sel", false);//Quita la seleccion de todas las columnas
        }
    },

    agregarFilaSeguros: function(){
        var recordGrilla = this.record;
        var storeSegurosCot = this.store;

        var rec = new recordGrilla({idcotizacion:'<?=$cotizacion->getCaIdcotizacion()?>',
                              prima_tip:'',
                              prima_vlr:0,
                              prima_min:0,
                              obtencion: 0 ,
                              idmoneda:'',
                              observaciones:'',
                              transporte:''

                            });
        records = [];
        records.push( rec );
        storeSegurosCot.insert( 0, records );
        rec = storeSegurosCot.getAt(0);
        rec.set("prima_tip", "%");
        rec.set("idmoneda", "USD");

    },

    /*
    * Muestra una ventana con la informacion del tarifario y le permite al usuario
    * seleccionar las tarifas a importar
    */
    ventanaTarifarioSeguros: function( ){
        var recordGrilla = this.record;
        var storeSegurosCot = this.store;
        
        var url = '<?=url_for("cotizaciones/tarifarioSeguros?idcotizacion=".$cotizacion->getcaIdcotizacion())?>';
        
        Ext.Ajax.request({
            url: url,
            params: {

            },
            success: function(xhr) {
                //alert( xhr.responseText );
                var newComponent = eval(xhr.responseText);

                //Se crea la ventana

                winSeguros = new Ext.Window({
                width       : 800,
                height      : 460,
                closeAction :'close',
                plain       : true,

                items       : [newComponent],


                buttons: [
                    {
                        text     : 'Importar',
                        handler  : function( ){
                            storeSeguroPric = newComponent.store;
                            var index = 0;

                            storeSeguroPric.each( function(r){
                                if( r.data.sel==true ){

                                    var rec = new recordGrilla({idcotizacion:'<?=$cotizacion->getCaIdcotizacion()?>',
                                                          prima_tip:'',
                                                          prima_vlr:0,
                                                          prima_min:0,
                                                          obtencion:'',
                                                          idmoneda:'',
                                                          observaciones:'',
                                                          transporte:''
                                                        });
                                    records = [];
                                    records.push( rec );
                                    //storeSegurosCot.insert( index, records );
                                    storeSegurosCot.insert( 0, records );
                                    rec = storeSegurosCot.getAt(0);
                                    rec.set("prima_tip", '%' );
                                    rec.set("prima_vlr", r.data.vlrprima );
                                    rec.set("prima_min", r.data.vlrminima );
                                    rec.set("obtencion", r.data.vlrobtencionpoliza );
                                    rec.set("idmoneda", r.data.idmoneda );
                                    rec.set("transporte", r.data.transporte );
                                    index++;
                                }
                            } );

                            winSeguros.close();
                        }
                    },
                    {
                        text     : 'Cancelar',
                        handler  : function(){
                            winSeguros.close();
                        }
                    }
                ]
            });
            winSeguros.show( );
            },
            failure: function() {
                Ext.Msg.alert("Tab creation failed", "Server communication failure");
            }
        });
    }

});


</script>