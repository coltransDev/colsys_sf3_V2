<?

?>
<script type="text/javascript">


PanelContViajes = function( config ){

    Ext.apply(this, config);
    
    this.editorModalidad = new Ext.form.ComboBox({
        fieldLabel: 'Concepto',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'Seleccione',
        selectOnFocus: true,
        mode: 'local',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : [['FCL','FCL'], ['LCL','LCL']]
    });


   

    
    /*
    * Crea el Record
    */
    this.record = Ext.data.Record.create([
        {name: 'id', type: 'int'},
        {name: 'idcotizacion', type: 'string'},
        {name: 'tipo', type: 'string'},
        {name: 'modalidad', type: 'string'},
        {name: 'origen', type: 'string'},
        {name: 'ciuorigen', type: 'string'},
        {name: 'destino', type: 'string'},
        {name: 'ciudestino', type: 'string'},
        {name: 'idconcepto', type: 'string'},
        {name: 'concepto', type: 'string'},
        {name: 'idequipo', type: 'string'},
        {name: 'equipo', type: 'string'},
        {name: 'valor_tar', type: 'string'},
        {name: 'valor_min', type: 'string'},
        {name: 'idmoneda', type: 'string'},
        {name: 'frecuencia', type: 'string'},
        {name: 'ttransito', type: 'string'},
        {name: 'observaciones', type: 'string'},
        {name: 'orden', type: 'int'}
    ]);

    this.columns = [
		{
			id: 'tipo',
			header: "Tipo",
			width: 40,
			sortable: false,
			dataIndex: 'tipo',
			hideable: false,
			hidden: true

		},
		{
			id: 'cotizacionId',
			header: "cotizacionId",
			width: 10,
			sortable: false,
			dataIndex: 'idcotizacion',
			hideable: false,
			hidden: true
		},
		{
			id: 'modalidad',
			header: "Modalidad",
			width: 60,
			sortable: false,
			dataIndex: 'modalidad',
			hideable: false,
			editor: this.editorModalidad
		},
		{
			id: 'ciuorigen',
			header: "Origen",
			width: 80,
			sortable: false,
			dataIndex: 'ciuorigen',
			hideable: false,
			editor: <?=include_component("widgets", "ciudades" ,array("id"=>"origen", "label"=>"Ciudad Origen", "idpais"=>"CO-057" ))?>
		},
		{
			id: 'ciudestino',
			header: "Destino",
			width: 80,
			sortable: false,
			dataIndex: 'ciudestino',
			hideable: false,
			editor: <?=include_component("widgets", "ciudades" ,array("id"=>"destino", "label"=>"Ciudad Destino", "idpais"=>"CO-057" ))?>
		},
		{
			id: 'concepto',
			header: "Concepto",
			width: 90,
			sortable: false,
			dataIndex: 'concepto',
			hideable: false,
			editor: <?=include_component("widgets", "concepto" ,array("id"=>"conceptoOtmDta", "transporte"=>Constantes::TERRESTRE, "modalidad"=>"OTM-DTA" ))?>

		},
		{
			id: 'equipo',
			header: "Equipo",
			width: 100,
			sortable: false,
			dataIndex: 'equipo',
			hideable: false,
			editor:  <?=include_component("widgets", "concepto" ,array("id"=>"equipo", "transporte"=>Constantes::MARITIMO))?>

		},
		{
			id: 'valor_tar',
			header: "Tarifa",
			width: 100,
			sortable: false,
			renderer: Ext.util.Format.usMoney,
			dataIndex: 'valor_tar',
			hideable: false,
			editor: new Ext.form.NumberField({
						name: 'valor_tar',
						allowBlank:false,
						allowNegative: false
			})
		},
		{
			id: 'valor_min',
			header: "Mínimo",
			width: 100,
			sortable: false,
			renderer: Ext.util.Format.usMoney,
			dataIndex: 'valor_min',
			hideable: false,
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:false,
						allowNegative: false
			})
		},
		{
			id: 'idmoneda',
			header: "Moneda",
			width: 100,
			sortable: false,
			dataIndex: 'idmoneda',
			hideable: false,
			editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
		},
		{
			id: 'frecuencia',
			header: "Frecuencia",
			width: 100,
			sortable: false,
			dataIndex: 'frecuencia',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'frecuencia',
						allowBlank:true
			})
		},
		{
			id: 'ttransito',
			header: "Tiempo/Transito",
			width: 100,
			sortable: false,
			dataIndex: 'ttransito',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'ttransito',
						allowBlank:true
			})
		},
		{
			id: 'observaciones',
			header: "Observaciones",
			width: 100,
			sortable: false,
			dataIndex: 'observaciones',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'observaciones',
						allowBlank:true
			})
		}
	];

     /*
    * Crea el store
    */
    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        url: '<?=url_for("cotizaciones/datosContinuacionViaje?idcotizacion=".$cotizacion->getCaIdcotizacion() )?>',
        reader: new Ext.data.JsonReader(
            {
                id: 'contviaje',
                root: 'contviajes',
                totalProperty: 'total'
            },
            this.record
        ),
        sortInfo:{field: 'orden', direction: "ASC"},
        //proxy: new Ext.data.MemoryProxy(data_contviajes),
        groupField: 'tipo'
    });

    PanelContViajes.superclass.constructor.call(this, {
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        master_column_id : 'contviaje',
        stripeRows: true,
        autoExpandColumn: 'contviaje',
        title: 'Tarifas para OTM/DTA',
        closable: false,
        id: 'grid_contviajes',
        
        tbar: [
        {
            text: 'Guardar Cambios',
            tooltip: 'Guarda los cambios realizados en el Continuación de Viaje',
            iconCls: 'disk',  // reference to our css
            handler: function(){
                Ext.getCmp("subpanel-cotizaciones").guardarDatosPaneles();
            }
        }


        ],

        view: new Ext.grid.GroupingView({
            forceFit:true,
            enableRowBody:true,
            getRowClass: function(  record,  index,  rowParams,  store ){
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
        }),
        listeners:{
            validateedit: this.onValidateEdit,
            beforeedit: this.onBeforeEdit,
            rowcontextmenu: this.onRowContextMenu
        }
    });

    var storeContViajes = this.store;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        var record = storeContViajes.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);

		//alert( record.data.modalidad+" "+field);

		if( record.data.modalidad!="+" && field=="modalidad" ){
			return false;
		}

		if( record.data.modalidad=="+" && field!="modalidad" ){
			return false;
		}


		if( record.data.modalidad!="FCL" && field=="equipo" ){
			return false;
		}

		return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
    }

}

Ext.extend(PanelContViajes, Ext.grid.EditorGridPanel, {

    onContextHide : function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    },


    onRowContextMenu : function(grid, index, e){
        var storeContViajes = this.store;
        rec = this.store.getAt(index);

        if(!this.menu){ // create context menu on first right click
            this.menu = new Ext.menu.Menu({
            id:'grid_productos-ctx',
            enableScrolling : false,
            items: [{
                        text: 'Observaciones',
                        iconCls: 'page_white_edit',
                        scope:this,
                        handler: function(){
                            Ext.getCmp("grid_contviajes").observacionesHandler( this.ctxRecord );
                        }
                    },
                    {
                        text: 'Eliminar item',
                        iconCls: 'delete',
                        scope:this,
                        handler: function(){
                            if( this.ctxRecord.data.modalidad!="+" && confirm("Desea continuar?") ){

                                if( !this.ctxRecord.data.id ){
                                    var rec = storeContViajes.getById( this.ctxRecord.id );
                                    storeContViajes.remove(rec);
                                }else{
                                    var idcontinuacion = this.ctxRecord.data.id;
                                    var id = this.ctxRecord.id;

                                    Ext.Ajax.request(
                                        {
                                            waitMsg: 'Guardando cambios...',
                                            url: '<?=url_for("cotizaciones/eliminarContViaje?idcotizacion=".$cotizacion->getCaIdcotizacion())?>',
                                            //method: 'POST',
                                            //Solamente se envian los cambios
                                            params :	{
                                                idcontinuacion: idcontinuacion,
                                                id: id
                                            },

                                            callback :function(options, success, response){

                                                var res = Ext.util.JSON.decode( response.responseText );
                                                var rec = storeContViajes.getById( res.id );
                                                storeContViajes.remove(rec);


                                            }

                                         }
                                    );//Ext.Ajax.request
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

    onBeforeEdit : function( e ){

        if( e.field == "equipo"){
             ed = this.colModel.getCellEditor(e.column, e.row );
             ed.field.store.baseParams = {transporte:"<?=Constantes::MARITIMO?>",modalidad:e.record.data.modalidad ,impoexpo:"Exportación"};
             ed.field.store.reload();
        }

    },



    /*
    * Cambia el valor que se toma de los combobox y copia el valor em otra columna,
    * tambien inserta otra columna en blanco para que el usuario continue digitando
    */
    onValidateEdit : function(e){
        var rec = e.record;
        var ed = this.colModel.getCellEditor(e.column, e.row);
        var store = ed.field.store;

        var recordContViajes = this.record;
        var storeContViajes = this.store;

        
        if( e.field == "modalidad" && rec.data.modalidad =="+" ){
            var rec = e.record;
            var newRec = new recordContViajes({
                           id: '',
                           idcotizacion: rec.data.idcotizacion,
                           tipo: rec.data.tipo,
                           modalidad: '+',
                           origen: '',
                           ciuorigen: '',
                           destino: '',
                           ciudestino: '',
                           idconcepto: '',
                           concepto: '',
                           idequipo: '',
                           equipo: '',
                           valor_tar: 0,
                           valor_min: 0,
                           idmoneda: 'COP',
                           frecuencia: '',
                           observaciones: '',
                           orden: rec.data.orden+1
                        });

            storeContViajes.addSorted(newRec);
            return true;
        }


        if( e.field == "ciuorigen"){
            store.each( function( r ){
                    if( r.data.idciudad==e.value ){
                        rec.set("origen", r.data.idciudad );
                        e.value = r.data.ciudad;
                        return true;
                    }
                }
            )
        }else if( e.field == "ciudestino"){
            store.each( function( r ){
                    if( r.data.idciudad==e.value ){
                        rec.set("destino", r.data.idciudad );
                        e.value = r.data.ciudad;
                        return true;
                    }
                }
            )
        }else if( e.field == "concepto"){
            store.each( function( r ){
                    if( r.data.idconcepto==e.value ){
                        rec.set("idconcepto", r.data.idconcepto );
                        e.value = r.data.concepto;
                        return true;
                    }
                }
            )
        }else if( e.field == "equipo"){
            store.each( function( r ){
                    if( r.data.idconcepto==e.value ){
                        rec.set("idequipo", r.data.idconcepto );
                        e.value = r.data.concepto;
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
        var success = true;
        var storeContViajes = this.store;
        var records = storeContViajes.getModifiedRecords();

        var lenght = records.length;


        for( var i=0; i< lenght; i++){
            r = records[i];
            if( r.data.modalidad!="+"   ){
                if( !r.data.origen ){
                    Ext.MessageBox.alert('Alerta', 'Por favor indique la ciudad de origen');
                    return false;
                }

                if( !r.data.destino ){
                    Ext.MessageBox.alert('Alerta', 'Por favor indique la ciudad de destino');
                    return false;
                }

                if( !r.data.idconcepto ){
                    Ext.MessageBox.alert('Alerta', 'Por favor indique el concepto');
                    return false;
                }

                if( !r.data.idequipo && r.data.modalidad =="FCL" ){
                    Ext.MessageBox.alert('Alerta', 'Por favor indique el equipo');
                    return false;
                }

            }
        }


        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();

            changes['cotizacionId']=r.data.idcotizacion;
            changes['id']=r.id;
            changes['idcontinuacion']=r.data.id;
            changes['tipo']=r.data.tipo;
            changes['modalidad']=r.data.modalidad;
            changes['idmoneda']=r.data.idmoneda;
            changes['idconcepto']=r.data.idconcepto;

            //envia los datos al servidor
            Ext.Ajax.request(
                {
                    waitMsg: 'Guardando cambios...',
                    url: '<?=url_for("cotizaciones/formContViajeGuardar")?>',
                    //Solamente se envian los cambios
                    params :	changes,

                    callback :function(options, success, response){
                        var res = Ext.util.JSON.decode( response.responseText );
                        var rec = storeContViajes.getById( res.id );
                        rec.set("id", res.idcontinuacion );
                        rec.commit();
                    }
                 }
            );

        }
    },

    observacionesHandler : function( rec ){
        //crea una ventana
        win = new Ext.Window({
            width       : 500,
            height      : 200,
            closeAction :'close',
            plain       : true,

            items       : new Ext.FormPanel({
                id: 'contviaje-form',
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
                            value: rec.data.observaciones,
                            allowBlank:true
                        }
                        ]

            }),

            buttons: [{
                text     : 'Ok',
                handler: function(){
                    var fp = Ext.getCmp("contviaje-form");
                    if( fp.getForm().isValid() ){

                        rec.set( "observaciones",  fp.getForm().findField("observaciones").getValue() );
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
    }


    
});

</script>