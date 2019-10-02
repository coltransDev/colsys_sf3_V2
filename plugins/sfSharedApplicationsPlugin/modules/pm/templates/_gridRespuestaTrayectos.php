
<?

$conceptos = $sf_data->getRaw("conceptos");
$aplicaciones1 = $sf_data->getRaw("aplicaciones");

$aplicaciones = array();
foreach( $aplicaciones1 as $aplicacion ){
    $aplicaciones[]=  $aplicacion->getCaValor();
}


include_component("widgets", "widgetLinea");
include_component("widgets", "widgetCiudad");
include_component("pricing", "panelTrayectoWindow");
?>

<script type="text/javascript"> 
    
    Ext.override(Ext.data.Store,{
	addField: function(field){
		field = new Ext.data.Field(field);
		this.recordType.prototype.fields.replace(field);
		if(typeof field.defaultValue != 'undefined'){
			this.each(function(r){
				if(typeof r.data[field.name] == 'undefined'){
					r.data[field.name] = field.defaultValue;
				}
			});
		}
	},
	removeField: function(name){
		this.recordType.prototype.fields.removeKey(name);
		this.each(function(r){
			delete r.data[name];
			if(r.modified){
				delete r.modified[name];
			}
		});
	}
    });
    Ext.override(Ext.grid.ColumnModel,{
            addColumn: function(column, colIndex){
                    if(typeof column == 'string'){
                            column = {header: column, dataIndex: column};
                    }
                    var config = this.config;
                    this.config = [];
                    if(typeof colIndex == 'number'){
                            config.splice(colIndex, 0, column);
                    }else{
                            colIndex = config.push(column);
                    }
                    this.setConfig(config);
                    return colIndex;
            },
            removeColumn: function(colIndex){
                    var config = this.config;
                    this.config = [config[colIndex]];
                    config.splice(colIndex, 1);
                    this.setConfig(config);
            }
    });
    Ext.override(Ext.grid.GridPanel,{
            addColumn: function(field, column, colIndex){
                    if(!column){
                            if(field.dataIndex){
                                    column = field;
                                    field = field.dataIndex;
                            } else{
                                    column = field.name || field;
                            }
                    }
                    this.store.addField(field);
                    return this.colModel.addColumn(column, colIndex);
            },
            removeColumn: function(name, colIndex){
                    this.store.removeField(name);
                    if(typeof colIndex != 'number'){
                            colIndex = this.colModel.findColumnIndex(name);
                    }
                    if(colIndex >= 0){
                            this.colModel.removeColumn(colIndex);
                    }
            }
    });
    
    GridRespuestaTrayectos = function (config) {
    
        Ext.apply(this, config);
        //Ext.QuickTips.init();
        //this.ctxRecord = null;

        /**
         * Handler specified for the 'Available' column renderer
         * @param {Object} value
         */
        /**
         * Custom function used for column renderer
         * @param {Object} val
         */


        this.comboConceptos = new Ext.form.ComboBox({            
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',            
            selectOnFocus: true,            
            id: 'proyecto_id',
            lazyRender:true,
            allowBlank: true,
            displayField: 'concepto',
            valueField: 'idconcepto',
            hiddenName: 'project',
            listClass: 'x-combo-list-small',
            mode: 'local',
            store : new Ext.data.Store({
                autoLoad : true,
                url: '<?= url_for("conceptos/datosConceptos") ?>',
                baseParams:{
                    transporte:"<?= Constantes::MARITIMO ?>",
                    modalidad:"<?= Constantes::FCL ?>",
                    impoexpo:"<?= Constantes::IMPO ?>",
                    modo: "recargos"                    
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
            })
        });
        
        this.editorAplicaciones = new Ext.form.ComboBox({
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            selectOnFocus: true,
            mode: 'local',
            lazyRender:true,
            listClass: 'x-combo-list-small',
            store : [
                <?
                $i=0;
                foreach( $aplicaciones as $aplicacion ){
                    if($i++!=0){
                        echo ",";
                    }
                    ?>
                ['<?=$aplicacion?>','<?=$aplicacion?>']
                <?
                }
                ?>
            ]
        });
        
        this.checkColumn = new Ext.grid.CheckColumn({header:'RL', dataIndex:'sel', width:50, hideable: false});        
        this.checkConDestino = new Ext.grid.CheckColumn({header:'CD', dataIndex:'cd', width:50, hideable: false});        
    

        this.record = Ext.data.Record.create([
            {name: 'idticket', type: 'integer'},
            {name: 'idtrayecto', type: 'integer'},
            {name: 'trayecto', type: 'string'},
            {name: 'idconcepto', type: 'integer'},
            {name: 'concepto', type: 'string'},
            {name: 'tipo', type: 'string'},
            {name: 'sel', type: 'bool'},
            {name: 'cd', type: 'bool'},
            {name: 'moneda', type: 'string'},
            {name: 'aplicacion', type: 'string'},
            {name: 'observaciones', type: 'string'},
            {name: 'id', type: "string"},            
            {name: 'equipo_tm3', type: "integer"},
            {name: 'equipo_minima', type: "integer"},            
            {name: 'equipo_10', 'type': 'integer'},
            {name: 'equipo_11', 'type': 'integer'},
            {name: 'equipo_12', 'type': 'integer'},
            {name: 'equipo_13', 'type': 'integer'},
            {name: 'equipo_14', 'type': 'integer'},
            {name: 'equipo_15', 'type': 'integer'},
            {name: 'equipo_16', 'type': 'integer'},
            {name: 'equipo_17', 'type': 'integer'},
            {name: 'equipo_18', 'type': 'integer'},
            {name: 'equipo_19', 'type': 'integer'},
            {name: 'equipo_20', 'type': 'integer'},
            {name: 'equipo_21', 'type': 'integer'},
            {name: 'equipo_54', 'type': 'integer'},
            {name: 'equipo_55', 'type': 'integer'},
            {name: 'equipo_56', 'type': 'integer'},
            {name: 'equipo_129', 'type': 'integer'},
            {name: 'equipo_132', 'type': 'integer'},
            {name: 'equipo_169', 'type': 'integer'},
            {name: 'equipo_170', 'type': 'integer'},
            {name: 'equipo_208', 'type': 'integer'},
            {name: 'equipo_244', 'type': 'integer'},
            {name: 'equipo_253', 'type': 'integer'},
            {name: 'equipo_254', 'type': 'integer'},
            {name: 'equipo_255', 'type': 'integer'},
            {name: 'equipo_260', 'type': 'integer'},
            {name: 'equipo_262', 'type': 'integer'},
            {name: 'equipo_274', 'type': 'integer'},
            {name: 'equipo_279', 'type': 'integer'},
            {name: 'equipo_314', 'type': 'integer'},
            {name: 'equipo_315', 'type': 'integer'}
        ]);
    
        this.store = new Ext.data.GroupingStore({
            autoLoad : true,        
            baseParams : {
                idticket: this.idticket
            },
            reader: new Ext.data.JsonReader({                
                    root: 'root',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                this.record
            ),
            proxy: new Ext.data.HttpProxy({
                method: 'POST',
                url: '<?=url_for("pm/datosRespuestaTarifa")?>'
            }),
            sortInfo:{field: 'trayecto', direction: "ASC"},
            groupField: 'trayecto'
        });
        
        this.columns = [{
            id: 'trayecto',
            header: "Trayecto",                        
            sortable: true,
            dataIndex: 'trayecto',
            hideable: false,
            hidden: true
        },{
            header: "Concepto",            
            id: 'concepto',
            width: 300,
            //fixed: true,
            sortable: false,
            groupable: false,
            hideable: false,
            dataIndex: 'concepto', 
            tdCls: 'no-dirty',
            hideable: false,
            renderer: this.renderConcepto,
            editor: this.comboConceptos
        },
        {
            header: "Moneda",
            id: 'moneda',
            width: 80,
            sortable: false,
            hideable: false,
            groupable: false,
            dataIndex: 'moneda',
            editor: <?=include_component("widgets", "monedas")?>
        },
        {
            header: "Aplicacion",
            dataIndex: 'aplicacion',
            id: 'aplicacion',            
            width: 100,
            hideable: true,
            sortable:false,
            editor: this.editorAplicaciones
        },        
        this.checkColumn,
        this.checkConDestino,
        {
            header: "Observaciones",
            width: 120,
            sortable: false,
            hideable: false,
            groupable: false,
            dataIndex: 'observaciones',
            editor: new Ext.form.TextField({
                allowBlank: false
            })
        },
    ];
        <?
            /*if($conceptos){
                foreach($conceptos as $concepto){                                
                    ?>
                    this.columns.push({
                        dataIndex: "<?=$concepto->getCaIdconcepto()?>",
                        id: "idequipo_<?=$concepto->getCaIdconcepto()?>",
                        header: "<?=utf8_encode($concepto->getCaConcepto())?>", 
                        width: 100,
                        //fixed: true,
                        hidden: true,
                        editor: new Ext.form.NumberField({
                            allowBlank: false,
                            allowNegative: false,
                            maxValue: 100000000
                        }),
                        summaryType: 'sum',
                        summaryRenderer: function(value, summaryData, dataIndex) {
                            return "<span style='font-weight: bold;'> "+value+"</span>";
                        }
                    })
                    <?
                }
            }*/
        ?>
    
    // create the editor grid
    GridRespuestaTrayectos.superclass.constructor.call(this, {
        store: this.store,
        id: 'panel-recargos',
        viewConfig: {
            forceFit: true,
            markDirty: false
        },/*
        colModel: {
            defaultWidth : 200
        },*/
        stripeRows: true,
        height: 200,        
        clicksToEdit: 1,
        plugins: [this.checkColumn, this.checkConDestino],
        tbar: [{
                text: 'Limpiar datos',
                iconCls: 'refresh',
                scope: this,
                handler: function(){
                    this.recargar(true);
                }
            }, {
                text: 'Recargar Datos',
                iconCls: 'refresh',
                scope: this,
                handler: function(){
                    this.recargar(false);
                }
            },{
                text: 'Agregar Trayecto',
                iconCls: 'add',
                scope: this,
                handler: this.agregarTrayecto
            },{
                text: 'Guardar Tarifas',
                iconCls: 'disk',
                scope: this,
                handler: this.guardarCambios
            },
            {
                text: 'Vista Previa Tarifas',
                iconCls: 'preview',
                scope: this,
                handler: this.vistaPrevia
            }],
        // config options for stateful behavior
        stateful: true,
        stateId: 'grid',
        features: [{           
            ftype: 'summary'
        }],
        view: new Ext.grid.GroupingView({
            forceFit:true,
            enableRowBody:true,
        }),
        listeners:{
            validateedit: this.onValidateEdit,
            rowcontextmenu: this.onRowContextMenu,
            render: this.OnRender,
            afterrender: this.onAfterRender
        }
    });
    
    this.getView().getRowClass = this.getRowClass;
    
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {            
            //var record = store.getAt(rowIndex);            
            /*if(record.data.idstage){                
                return false;                
            }*/
            return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);       
        }
    // manually trigger the data store load
    
    }    
    

    Ext.extend(GridRespuestaTrayectos, Ext.grid.EditorGridPanel, {        
        onValidateEdit: function(e){
            var record = this.record;
            var storeRecargos = this.store;
            //console.log(e.field);
            if( e.field == "linea"){
                var rec = e.record;
                var ed = this.colModel.getCellEditor(e.column, e.row);
                var store = ed.field.store;
                var idtrafico = this.idtrafico;
                store.each( function( r ){
                    //console.log(r.data.idlinea);
                    //console.log(e.value);
                    if( r.data.idlinea==e.value ){
                        /*rec.set("idconcepto", '9999');
                        rec.set("concepto", 'Todos los conceptos');
                        rec.set("idlinea", r.data.idlinea);
                        rec.set("idmoneda", "USD");*/
                        e.value = r.data.linea;
                        return true;
                    }
                })
            }
            
            if( e.field == "concepto"){
                //console.log("validate_edit");
                var rec = e.record;
                var ed = this.colModel.getCellEditor(e.column, e.row);
                var store = ed.field.store;                
                store.each( function( r ){
                    //console.log(r.data.idlinea);
                    //console.log(e.value);
                    if( r.data.idconcepto==e.value ){                        
                        rec.set("idconcepto", r.data.idconcepto);
                        /*rec.set("concepto", 'Todos los conceptos');
                        rec.set("idlinea", r.data.idlinea);
                        rec.set("idmoneda", "USD");*/                        
                        e.value = r.data.concepto;
                        return true;
                    }
                })
            }
            
            if( e.field == "origen"){
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
                        //rec.set("idmoneda", "USD");
                        e.value = r.data.ciudad;
                        return true;
                    }
                })
            }
            
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
        
        },
        onAfterRender: function(){             
            Ext.getCmp('panel-recargos').getView().refresh();
            Ext.getCmp('respuesta').height = 150;             
        },
        OnRender: function(t){
            Ext.Ajax.request({
                waitMsg: 'Guardando cambios...',
                url: '<?=url_for("pm/obtenerDatosTarifa")?>',
                params :	{
                    idticket:this.idticket,
                    tipo: 'solicitud'
                },
                failure:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.err)
                        Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                    else
                        Ext.MessageBox.alert("Mensaje",'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>'+res.texto);
                },
                success:function(response,options)
                {
                    var res = Ext.util.JSON.decode( response.responseText );                            
                    if( res.success && res.data){                                
                        var idequipos = res.data.fcl?res.data.fcl.idequipo:[];                                
                        var equipos = res.data.fcl?res.data.fcl.equipo:[]; 
                        var conceptos = res.conceptos;
                        var ocultar = true;
                        var gridIdequipos = [];
                        var gridEquipos = [];
                        //console.log(res.conceptos);
                        //console.log(idequipos);
                        //console.log(equipos);
                        
                        $.each(conceptos, function(index, objEquipos){
                            $.each(objEquipos, function(index1, value){                                
                                if($.inArray(objEquipos["idconcepto"], gridIdequipos)<0){
                                    gridIdequipos.push(objEquipos["idconcepto"])
                                    gridEquipos.push(objEquipos["concepto"])
                                }                                
                            })
                        })
                        
                        //console.log("fcl"+res.data.fcl);
                        $.each(gridIdequipos, function(index, value){
                            
                            //console.log($.inArray(value.toString(), idequipos)+'|'+value.toString());
                            if(res.data.fcl){
                                if($.inArray(value.toString(), idequipos)>=0){
                                    ocultar = false;
                                }
                            }else{
                                if(value=="tm3" || value=="minima"){
                                    ocultar = false;
                                }
                            }
                            //console.log("index->"+index+"||value->"+value+'||equipo->'+gridEquipos[index]);
                            //console.log(value+'|'+ocultar);
                            
                            var colPosition = index+2;
                                
                            Ext.getCmp('panel-recargos').addColumn(                                    
                                {name: gridEquipos[index], type: 'float', defaultValue: null}, 
                                {
                                    header: gridEquipos[index], 
                                    dataIndex: "equipo_"+value, 
                                    id: 'idequipo_'+value,
                                    width: 250,
                                    sortable: true,
                                    hidden: ocultar,
                                    editor: new Ext.form.NumberField({
                                        allowBlank: false,
                                        allowNegative: false,
                                        maxValue: 100000000
                                    })
                                },
                                colPosition      
                            );

                            var store = Ext.getCmp('panel-recargos').getStore();
                            delete store.reader.ef;
                            store.reader.buildExtractors();
                            
                            Ext.getCmp('panel-recargos').getView().refresh();                            
                            ocultar = true;
                            
                            
                            
                        })
                        
                        
                        /*if(idequipos){
                            for(var i=0; i<conceptos.length; i++){                                
                                if(conceptos[i])
                                var colPosition = i+2;
                                
                                Ext.getCmp('panel-recargos').addColumn(                                    
                                    {name: equipos[i], type: 'float', defaultValue: null}, 
                                    {
                                        header: equipos[i], 
                                        dataIndex: "equipo_"+idequipos[i], 
                                        id: 'idequipo_'+idequipos[i],
                                        width: 250,
                                        sortable: true,
                                        hidden: ocultar,
                                        editor: new Ext.form.NumberField({
                                            allowBlank: false,
                                            allowNegative: false,
                                            maxValue: 100000000
                                        })
                                    },
                                    colPosition      
                                );
                        
                                var store = Ext.getCmp('panel-recargos').getStore();
                                delete store.reader.ef;
                                store.reader.buildExtractors();

                                Ext.getCmp('panel-recargos').getView().refresh();
            
                                //Ext.getCmp('panel-recargos').getColumnModel().getColumnById('idequipo_'+idequipos[i]).hidden = false;
                                //Ext.getCmp('panel-recargos').getColumnModel().getColumnById('idequipo_'+idequipos[i]).width = 100;                                        
                                
                            }
                        }*/
                        
                       /* Ext.getCmp('panel-recargos').addColumn(
                                    {name: 'Moneda', type:'text', defaulValue: 'USD'},
                                    {
                                        header: "Moneda",
                                        width: 80,
                                        sortable: false,
                                        hideable: false,
                                        groupable: false,
                                        dataIndex: 'moneda',
                                        editor: <?=include_component("widgets", "monedas")?>
                                    });
                                    
                                    var store = Ext.getCmp('panel-recargos').getStore();
                                delete store.reader.ef;
                                store.reader.buildExtractors();
            
                                Ext.getCmp('panel-recargos').getView().refresh();*/
                        //Ext.getCmp('panel-recargos').getColumnModel().getColumnById('concepto').width = 200;
                        //Ext.getCmp('panel-recargos').getView().refresh();
                        //Ext.getCmp('panel-recargos').getColumnModel().setConfig({defaultWidth:200}, true);
                        if(res.data.fcl){
                            var columnModel = Ext.getCmp('panel-recargos').getColumnModel();
                            indexApp = columnModel.getIndexById("aplicacion");
                            columnModel.setHidden(indexApp, true);
                        }
                        
//                          
                            
                            
                    }
                    if(res.errorInfo!=null){
                        Ext.MessageBox.alert("Mensaje",'Los datos no se cargaron correctamente <br>'+res.errorInfo);
                    }
                }
            });         
    
            /*var editor = new Ext.form.NumberField({
                            allowBlank: false,
                            allowNegative: false,
                            maxValue: 100000000
                        });*/
    
            /*Ext.getCmp('panel-recargos').addColumn({name: 'age', type: 'int', defaultValue: null}, {header: 'AGE', dataIndex: 'age', sortable: true, editor: new Ext.form.NumberField({
                            allowBlank: false,
                            allowNegative: false,
                            maxValue: 100000000
                        })});
            Ext.getCmp('panel-recargos').addColumn("D");
            Ext.getCmp('panel-recargos').addColumn("E");*/
            
            
        },
        renderConcepto: function(value, metaData, record, rowIndex, colIndex, store){        
            /*var data = record.data;
            var tpAd = record.data.fchdeleted?'<tpl if="fchdeleted"><div ><h3>Eliminado: </h3>{fchdeleted}</div></tpl>':'</tpl>';

            var qtipTpl=new Ext.XTemplate(
                '<h3>Observaciones:</h3>'
               ,'<tpl for=".">'
               ,'<div>{observaciones}</div>'
               ,'<div ><h3>Actualización # {consecutivo}: </h3>{actualizado}</div>'+tpAd
            );

            var qtip = qtipTpl.apply(data);*/

            //console.log(record.data.tipo);
            //console.log(colIndex);

            switch(  record.data.tipo ){
                /*case 'trayecto_obs':
                    return '<div ext:qtip="' + qtip +'"><b>'+value+'</b></div>';
                    break;*/
                case 'flete':
                case 'Local x Contenedor':
                case 'Local x BL':
                    return '<div><b>'+value+'</b></div>';
                    break;
                case 'Días Libres':
                    return '<div><i>'+value+'</i></div>';
                    break;
                case 'recargo':
                    if( colIndex==1 ){
                        return '<div class="recargo">'+value+'</div>';
                    }else{
                        return '<div>'+value+'</div>';
                    }
                    break;
                /*case 'recargoxciudad':
                    return '<div ext:qtip="' + qtip +'" class="recargo">'+value+'</div>';
                    break;*/

            }

        },
        onRowContextMenu: function(grid, index, e){

            rec = grid.store.getAt(index);
            e.stopEvent(); //Evita que se despliegue el menu con el boton izquierdo
            
            //console.log(rec);

            if(!this.menu){
                //if( !this.readOnly ){
                    this.menu = new Ext.menu.Menu({
                        enableScrolling : false,
                        items: [                       
                        {
                                text: 'Editar Trayecto',
                                iconCls: 'add',
                                scope:this,
                                handler: function(){                                                                        
                                    record = this.ctxRecord;
                                    
                                    panelTrayecto = new PanelTrayectoWindow({idtrayecto:record.data.idtrayecto, id: "panel-trayecto-window"});
                                    panelTrayecto.show();

                                    fp= Ext.getCmp("trayecto-form");
                                    fp.getForm().load({
                                        url:'<?=url_for("pm/datosTrayecto")?>',
                                        waitMsg:'cargando...',
                                        params:{
                                            idtrayecto:record.data.idtrayecto, 
                                            idticket: record.data.idticket
                                        },
                                        success:function(response,options){
                                            var res = Ext.util.JSON.decode( options.response.responseText );
                                            
                                            console.log(res);
                                            
                                            Ext.getCmp("origen").setValue(res.data.ciudad_origen); 
                                            Ext.getCmp("origen").hiddenField.value=res.data.ciu_origen;

                                            Ext.getCmp("destino").setValue(res.data.ciudad_destino);
                                            Ext.getCmp("destino").hiddenField.value=res.data.ciu_destino;
                                            
                                            Ext.getCmp("idlinea").setValue(res.data.linea);
                                            Ext.getCmp("idlinea").hiddenField.value=res.data.idlinea;
                                            
                                            Ext.getCmp("modalidad").setValue(res.data.modalidad);                                            
                                            Ext.getCmp("observaciones").setValue(res.data.observaciones);                                            
                                            Ext.getCmp("frecuencia").setValue(res.data.frecuencia);
                                            Ext.getCmp("ttransito").setValue(res.data.ttransito);
                                            Ext.getCmp("ncontrato").setValue(res.data.ncontrato);
                                            
                                            //Ext.getCmp("origen").setDisabled(true);
                                            //Ext.getCmp("destino").setDisabled(true);
                                            Ext.getCmp("impoexpo").setDisabled(true);
                                            Ext.getCmp("transporte").setDisabled(true);
                                            Ext.getCmp("idagente").setDisabled(true);
                                            Ext.getCmp("listar_todos").setDisabled(true);
                                            fp.getForm().findField('activo').setDisabled(true);
                                            
                                            var cerradaPor = new Ext.form.TextField({                                            
                                                width: 100,
                                                fieldLabel: 'Cerrada Por',
                                                name: 'cerradapor',
                                                id: 'cerradapor',
                                                value: '',
                                                allowBlank:true
                                            });
                                            
                                            var vigenciaIni= {
                                                xtype: 'datefield',
                                                width: 100,
                                                fieldLabel: 'Vigencia Inicial',
                                                name: 'vigenciaIni',
                                                id: 'vigenciaIni',
                                                format: 'Y-m-d',
                                                value: '',
                                                allowBlank:false
                                            };
                                            
                                            var vigenciaEnd = {
                                                xtype: 'datefield',
                                                width: 100,
                                                fieldLabel: 'Vigencia Final',
                                                name: 'vigenciaEnd',
                                                id: 'vigenciaEnd',
                                                format: 'Y-m-d',
                                                value: '',
                                                allowBlank:false
                                            };
                                            
                                            fp.add(cerradaPor);
                                            fp.add(vigenciaIni);
                                            fp.add(vigenciaEnd);
                                            fp.doLayout();
                                            
                                            Ext.getCmp("cerradapor").setValue(res.data.cerradapor);
                                            Ext.getCmp("vigenciaIni").setValue(res.data.vigenciaIni);
                                            Ext.getCmp("vigenciaEnd").setValue(res.data.vigenciaEnd);
                                        }
                                    });                                    
                                    panelTrayecto.buttons[0].setHandler(this.guardarTrayecto);                                    
                                }
                                
                            },                       
                            {
                                text: 'Nuevo recargo',
                                iconCls: 'add',
                                scope:this,
                                handler: function(){
                                   /* if( this.ctxRecord.data.tipo=="trayecto_obs" ){
                                        Ext.MessageBox.alert("Atención","No puede agregar un concepto sobre las observaciones");
                                        return 0;
                                    }*/
                                    this.nuevoRecargo(this.ctxRecord, index, null);
                                }
                            },
                            {
                                text: 'Agregar Local x Contenedor',
                                iconCls: 'add',
                                scope:this,
                                handler: function(){                                    
                                    this.nuevoRecargo(this.ctxRecord, index, 'Local x Contenedor');
                                }
                            },
                            {
                                text: 'Agregar Local x BL',
                                iconCls: 'add',
                                scope:this,
                                handler: function(){                                    
                                    this.nuevoRecargo(this.ctxRecord, index, 'Local x BL');
                                }
                            },
                            {
                                text: 'Agregar Días Libres',
                                iconCls: 'add',
                                scope:this,
                                handler: function(){                                    
                                    this.nuevoRecargo(this.ctxRecord, index, 'Días Libres');
                                }
                            },
                            {
                                text: 'Eliminar',
                                iconCls: 'delete',
                                scope:this,
                                handler: function(){
                                    //console.log(this.ctxRecord);
                                    //console.log(this.ctxRecord.data.id);
                                    var idRecord = this.ctxRecord.data.id
                                    //console.log(this.store);
                                    
                                    //var record = this.ctxRecord
                                    
                                    this.store.filterBy(function (record, id) {
                                        //console.log(record);
                                        if(record.get("id")===idRecord)
                                            return false;
                                        else
                                            return true;
                                        
                                    });
                                    /*Ext.MessageBox.confirm('Confirmaci\u00F3n', 'Est\u00E1 seguro de eliminar el registro?', 
                                    function(e){
                                        if(e == 'yes'){
                                            var box = Ext.MessageBox.wait('Procesando', 'Eliminando')
                                            Ext.Ajax.request({
                                                url: '/pm/datosRespuestaTarifa',
                                                params :{
                                                    id: this.ctxRecord.data.id
                                                },
                                                success: function(response, opts) {
                                                    Ext.MessageBox.alert("Colsys", "El registro se elimin\u00F3 correctamente");                                        
                                                    Ext.getCmp("grid-hijos").getStore().reload();
                                                    box.hidebox();
                                                },
                                                failure: function(response, opts) {
                                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                    box.hidebox();
                                                }
                                            });
                                        }
                                    })*/
                                                    //this.eliminarFila(this.ctxRecord, index);
                                }
                            }
                        ]
                    });
                /*}else{
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

                }*/
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
        nuevoRecargo: function(ctxRecord, index, tipo){  
        //console.log(ctxRecord);
        
            if(tipo == null){

                var rec = new this.record({
                    idreg: '0',
                    concepto: '',
                    tipo: 'recargo',
                    idtrayecto: ctxRecord.get("idtrayecto"),
                    idconcepto: ctxRecord.get("idconcepto"),
                    idticket: ctxRecord.get("idticket"),
                    trayecto: ctxRecord.get("trayecto")
                });

            }else{
                var rec = new this.record({
                    idreg: '0',
                    concepto: tipo,
                    tipo: tipo,
                    idtrayecto: ctxRecord.get("idtrayecto"),
                    idconcepto: ctxRecord.get("idconcepto"),
                    idticket: ctxRecord.get("idticket"),
                    trayecto: ctxRecord.get("trayecto")
                });
            }
            this.store.addSorted(rec);            
        },
        guardarTrayecto: function(){
            
        
            var idticket = Ext.getCmp("panel-recargos").idticket;
            console.log(idticket);
            
            var formTrayecto = Ext.getCmp("trayecto-form");
            
            formTrayecto.getForm().submit({
                clientValidation: true,
                url: '<?=url_for("pm/actualizarTrayecto")?>',
                params: {
                    newStatus: 'delivered',
                    idticket: idticket
                },
                success: function(form, action) {
                   Ext.Msg.alert('Success', "El trayecto ha sido actualizado exitosamente");
                   Ext.getCmp('panel-recargos').store.reload();
                   Ext.getCmp("panel-trayecto-window").close();                  
                   
                },
                failure: function(form, action) {
                    switch (action.failureType) {
                        case Ext.form.Action.CLIENT_INVALID:
                            Ext.Msg.alert('Failure', 'Form fields may not be submitted with invalid values');
                            break;
                        case Ext.form.Action.CONNECT_FAILURE:
                            Ext.Msg.alert('Failure', 'Ajax communication failed');
                            break;
                        case Ext.form.Action.SERVER_INVALID:
                           Ext.Msg.alert('Failure', action.result.msg);
                   }
                }
            });
        },
        recargar: function(borrar){
            if( this.store.getModifiedRecords().length>0){
                if(!confirm("Se perderan los cambios no guardados en el directorio de agentes unicamente, desea continuar?")){
                    return 0;
                }
            }
            
            this.store.setBaseParam( "borrar", borrar);
            this.store.reload();
            //this.store.reload();
        },
        guardarCambios: function(){

            var store = Ext.getCmp('panel-recargos').store;            
            var records = store.getRange();
            var lenght = records.length;
            /*var columnsEnd = Ext.getCmp('panel-recargos').getColumnModel().config;
            var contenedores = []
            
            $.each(columnsEnd, function(index, columnData){
                
                if(columnData["dataIndex"]!="concepto" && columnData["dataIndex"]!="trayecto"){
                    contenedores[columnData["dataIndex"]] = columnData["header"];
                    
                }
            })*/
            var grid = Ext.getCmp("panel-recargos");
            var columns = grid.getColumnModel().getColumnsBy(function(c){
                return c.hidden;
              });
            
            console.log(columns);
              
              var columnsHidden = [];
              
            $.each(columns, function(index, value){
                $.each(value, function(index1, value1){
                    //console.log(index1+'- -'+value1);
                    if(index1=="dataIndex")
                        columnsHidden.push(value1);
                })
                
            });
            
            console.log(columnsHidden);
              
            changes=[];
            //console.log(records);
            for( var i=0; i< lenght; i++){
                r = records[i];
                if( r.data.idconcepto!="" && r.getChanges())
                {
                    records[i].data.id=r.id;
                    //records[i].data.idreg=r.data.idreg;
                    
                    //records[i].data.ca_recargoorigen="false";

                   /*if (records[i].data.aplicacion.constructor.toString().indexOf("Array") == -1)
                      straplica=records[i].data.aplicacion;
                   else
                      straplica=records[i].data.aplicacion[0];

                    records[i].data.aplicacion=straplica;*/

                    changes[i]=records[i].data;
                }
            }


            var str= JSON.stringify(changes);
            var columnsH = JSON.stringify(columnsHidden);


            if(str.length>5)
            {
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("pm/guardarTarifasCotizacion")?>',
                        params :	{
                            datos:str,
                            idticket: this.idticket,
                            chidden: columnsH
                        },
                        failure:function(response,options){
                            var res = Ext.util.JSON.decode( response.responseText );
                            if(res.err)
                                Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                            else
                                Ext.MessageBox.alert("Mensaje",'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>'+res.texto);
                        },
                        success:function(response,options)
                        {
                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.data && res.success)
                            {
                                var id=res.id.split(",");
                                //idreg=res.idreg.split(",");
                                for(i=0;i<id.length;i++)
                                {
                                    var rec = store.getById( id[i] );
                                    //rec.set("idreg",idreg[i]);
                                    rec.commit();
                                }
                                
                                Ext.Msg.alert('Success', "La respuesta se ha creado satisfactoriamente");
                                Ext.getCmp("panel-trayecto-window").close();
                            }
                            if(res.errorInfo!="")
                            {
                                Ext.MessageBox.alert("Mensaje",res.errorInfo);
                            }
                        }
                     }
                );
            }
    },
    vistaPrevia: function(){
        var idticket = this.idticket;
        
        Ext.IframeWindow = Ext.extend(Ext.Window, {
            onRender: function() {
                this.bodyCfg = {
                    tag: 'iframe',
                    src: this.src,
                    cls: this.bodyCls,
                    style: {
                        border: '0px none'
                    }
                };
                Ext.IframeWindow.superclass.onRender.apply(this, arguments);
            }
        });

        var w = new Ext.IframeWindow({
            id:id,
            width:600,
            height:400,
            title:"Vista Previa Tarifas Cotizadas",
            bodyStyle: {
                backgroundColor: 'white'
            },
            //src:"pm/generarTarifasPDF?idticket="+idticket+"&tipo=externo"
            src: "/pm/crearRespuestaTarifasHtml?idticket="+idticket
        })


        w.show();
        
        
    },
    agregarTrayecto: function(){
        var idticket = this.idticket;
        
        panelTrayecto = new PanelTrayectoWindow({idtrayecto:null, id: "panel-trayecto-window"});
                                    panelTrayecto.show();

                                    fp= Ext.getCmp("trayecto-form");
                                    fp.getForm().load({
                                        url:'<?=url_for("pm/datosTrayecto")?>',
                                        waitMsg:'cargando...',
                                        params:{
                                            //idtrayecto:record.data.idtrayecto, 
                                            idticket: idticket
                                        },
                                        success:function(response,options){
                                            this.res = Ext.util.JSON.decode( options.response.responseText );
                                            
                                            Ext.getCmp("origen").setValue(res.data.ciudad_origen); 
                                            Ext.getCmp("origen").hiddenField.value=res.data.ciu_origen;

                                            Ext.getCmp("destino").setValue(res.data.ciudad_destino);
                                            Ext.getCmp("destino").hiddenField.value=res.data.ciu_destino;
                                            
                                            Ext.getCmp("idlinea").setValue(res.data.linea);
                                            Ext.getCmp("idlinea").hiddenField.value=res.data.idlinea;
                                            
                                            Ext.getCmp("modalidad").setValue(res.data.modalidad);                                            
                                            Ext.getCmp("observaciones").setValue(res.data.observaciones);                                            
                                            Ext.getCmp("frecuencia").setValue(res.data.frecuencia);
                                            Ext.getCmp("ttransito").setValue(res.data.ttransito);
                                            Ext.getCmp("ncontrato").setValue(res.data.ncontrato);
                                            //Ext.getCmp("origen").setDisabled(true);
                                            //Ext.getCmp("destino").setDisabled(true);
                                            Ext.getCmp("impoexpo").setDisabled(true);
                                            Ext.getCmp("transporte").setDisabled(true);
                                            Ext.getCmp("idagente").setDisabled(true);
                                            Ext.getCmp("listar_todos").setDisabled(true);                                            
                                            fp.getForm().findField('activo').setDisabled(true);
                                            
                                            var cerradaPor = new Ext.form.TextField({                                            
                                                width: 100,
                                                fieldLabel: 'Cerrada Por',
                                                name: 'cerradapor',
                                                id: 'cerradapor',
                                                value: '',
                                                allowBlank:true
                                            });
                                            
                                            var vigenciaIni= {
                                                xtype: 'datefield',
                                                width: 100,
                                                fieldLabel: 'Vigencia Inicial',
                                                name: 'vigenciaIni',
                                                id: 'vigenciaIni',
                                                format: 'Y-m-d',
                                                value: '',
                                                allowBlank:false
                                            };
                                            
                                            var vigenciaEnd = {
                                                xtype: 'datefield',
                                                width: 100,
                                                fieldLabel: 'Vigencia Final',
                                                name: 'vigenciaEnd',
                                                id: 'vigenciaEnd',
                                                format: 'Y-m-d',
                                                value: '',
                                                allowBlank:false
                                            };
                                            
                                            fp.add(cerradaPor);
                                            fp.add(vigenciaIni);
                                            fp.add(vigenciaEnd);
                                            fp.doLayout();
                                        }
                                    });                       
                                    panelTrayecto.buttons[0].setHandler(this.guardarTrayecto);                                    
                                
        
    }
    });
</script>