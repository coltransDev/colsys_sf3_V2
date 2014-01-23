<?


$semanas = $sf_data->getRaw("semanas");

$campos = $sf_data->getRaw("campos");
//print_r($campos);
?>

<script type="text/javascript" >
	PanelTransportistas = function( config ){
        Ext.apply(this, config);
        
        this.wgCliente=new WidgetCliente({width:500,id:"cliente",hiddenName:"idcliente"});
        
        this.wgCiudadO=new WidgetCiudad({width:200,id: 'origen',hiddenName:"idorigen"});
        this.wgCiudadD=new WidgetCiudad({width:200,id: 'destino',hiddenName:"iddestino"});
        
        this.wgReferencia=new WidgetReferencia({width:200,id: 'ca_referencia'});
        
		this.wgReferencia.addListener("select",this.onSelectreferencia,this);
        this.checkColumn=new Ext.grid.CheckColumn({header:'Escolta', dataIndex:'escolta', width:30})
        this.columns = [
            {
                header: "Semana",
                dataIndex: 'semana',
                sortable: true,
                editable:<?=(in_array("semana", $campos))?"true":"false"?>,
                renderer:<?=(in_array("semana", $campos))?"null":"this.formatItem1"?>,
                width: 80,
                editor: new MultiWidget({
                    width:80,
                    listeners:{
                        focus:function()
                        {
                            if(this.store.data.length==0)
                            {
                                data=<?=json_encode(array("root"=>$semanas, "total"=>count($semanas), "success"=>true) )?>;//{"root":[{"valor":"Si","id":"on"},{"valor":"No","id":"0"}],"total":2,"success":true};
                                this.store.loadData(data);
                            }
                        }
                    }
                })
            },
            {
                header: "Referencia",
                dataIndex: 'referencia',
                sortable: true,
                editable:<?=  (in_array("referencia", $campos))?"true":"false"?>,
                renderer:<?=(in_array("referencia", $campos))?"null":"this.formatItem1"?>,
                width: 120,
				editor: this.wgReferencia//new Ext.form.TextField()
            },
			{
                header: "Cliente",
                dataIndex: 'cliente',
                sortable: true,
                editable:<?=  (in_array("cliente", $campos))?"true":"false"?>,
                renderer:<?=(in_array("cliente", $campos))?"null":"this.formatItem1"?>,
                width: 300,                
				editor: this.wgCliente
            },			
			{
                header: "Mercancia",
                dataIndex: 'mercancia',
                sortable: true,
                editable:<?=  (in_array("mercancia", $campos))?"true":"false"?>,
                renderer:<?=(in_array("mercancia", $campos))?"null":"this.formatItem1"?>,
                width: 180,
				editor: new Ext.form.TextField()
            },			
			{
                header: "Origen",
                dataIndex: 'origen',
                sortable: true,
                editable:<?=  (in_array("origen", $campos))?"true":"false"?>,
                renderer:<?=(in_array("origen", $campos))?"null":"this.formatItem1"?>,
                width: 120,
				editor: this.wgCiudadO
            },
			{
                header: "Destino",
                dataIndex: 'destino',
                sortable: true,
                editable:<?=  (in_array("destino", $campos))?"true":"false"?>,
                renderer:<?=(in_array("destino", $campos))?"null":"this.formatItem1"?>,
                width: 120,
				editor: this.wgCiudadD
            },
			{
                header: "Modalidad",
                dataIndex: 'modalidad',
                sortable: true,
                editable:<?=  (in_array("modalidad", $campos))?"true":"false"?>,
                renderer:<?=(in_array("modalidad", $campos))?"null":"this.formatItem1"?>,
                width: 120,
				editor: new WidgetModalidad({linkTransporte: '<?=  Constantes::TERRESTRE?>',impoexpo: '<?=  Constantes::INTERNO?>'})
            },			
			{
                header: "Piezas",
                dataIndex: 'piezas',
                sortable: true,
                editable:<?=  (in_array("piezas", $campos))?"true":"false"?>,
                renderer:<?=(in_array("piezas", $campos))?"null":"this.formatItem1"?>,
                width: 60,
				editor: new Ext.form.NumberField({decimalPrecision:0})
            },			
			{
                header: "Peso",
                dataIndex: 'peso',
                sortable: true,
                editable:<?=  (in_array("peso", $campos))?"true":"false"?>,
                renderer:<?=(in_array("peso", $campos))?"null":"this.formatItem1"?>,
                width: 60,
				editor: new Ext.form.NumberField({decimalPrecision:2})
            },			
			{
                header: "CMB",
                dataIndex: 'volumen',
                sortable: true,
                editable:<?=  (in_array("volumen", $campos))?"true":"false"?>,
                renderer:<?=(in_array("volumen", $campos))?"null":"this.formatItem1"?>,
                width: 60,
				editor: new Ext.form.NumberField({decimalPrecision:2})
            },			
			{
                header: "Observaciones",
                dataIndex: 'observaciones',
                sortable: true,
                editable:<?=  (in_array("observaciones", $campos))?"true":"false"?>,
                renderer:<?=(in_array("observaciones", $campos))?"null":"this.formatItem1"?>,
                width: 200,
				editor: new Ext.form.TextField()
            },
            {
                header: "Fecha Salida",
                dataIndex: 'fchsalida',
                sortable: true,
                editable:<?=  (in_array("fchsalida", $campos))?"true":"false"?>,
                renderer:<?=(in_array("fchsalida", $campos))?"null":"this.formatItem1"?>,
                width: 100,
                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
				editor: new Ext.form.DateField({format: 'Y-m-d'})
            },
			{
                header: "Doc Transporte",
                dataIndex: 'doctransporte',
                sortable: true,
                editable:<?=  (in_array("doctransporte", $campos))?"true":"false"?>,
                renderer:<?=(in_array("doctransporte", $campos))?"null":"this.formatItem1"?>,
                width: 200,
				editor: new Ext.form.TextField()
            },
            this.checkColumn,
			{
                header: "Neta",
                dataIndex: 'neta',
                sortable: true,
                editable:<?=  (in_array("neta", $campos))?"true":"false"?>,
                renderer:<?=(in_array("neta", $campos))?"null":"this.formatItem1"?>,
                width: 100,
				editor: new Ext.form.NumberField({decimalPrecision:2})
            },
			{
                header: "Venta",
                dataIndex: 'venta',
                sortable: true,
                editable:<?=  (in_array("venta", $campos))?"true":"false"?>,
                renderer:<?=(in_array("venta", $campos))?"null":"this.formatItem1"?>,
                width: 100,
				editor: new Ext.form.NumberField({decimalPrecision:2})
            },
            {
                header: "Transportador",
                dataIndex: 'transportador',
                sortable: true,
                editable:<?=  (in_array("transportador", $campos))?"true":"false"?>,
                renderer:<?=(in_array("transportador", $campos))?"null":"this.formatItem1"?>,
                width: 300,
				editor: new WidgetLinea({linkTransporte: "<?=  Constantes::TERRESTRE?>",width:300})
            }            
        ];
        this.record = Ext.data.Record.create([
			{name: 'idreg', type: 'string',mapping:'idreg'},
			{name: 'semana', type: 'string',mapping:'t_ca_semana'},
            {name: 'referencia' , type: 'string',mapping:'t_ca_referencia'},
            {name: 'idcliente' , type: 'string',mapping:'t_ca_idcliente'},
            {name: 'cliente' , type: 'string',mapping:'c_cliente'},
			{name: 'mercancia' , type: 'string',mapping:'t_ca_mercancia'},
            {name: 'idorigen' , type: 'string',mapping:'t_ca_origen'},
            {name: 'origen' , type: 'string',mapping:'o_origen'},
            {name: 'iddestino' , type: 'string',mapping:'t_ca_destino'},
            {name: 'destino' , type: 'string',mapping:'d_destino'},
            {name: 'modalidad' , type: 'string',mapping:'t_ca_modalidad'},
            {name: 'piezas' , type: 'string',mapping:'t_ca_piezas'},
            {name: 'peso' , type: 'string',mapping:'t_ca_peso'},
            {name: 'volumen' , type: 'string',mapping:'t_ca_volumen'},
            {name: 'observaciones' , type: 'string',mapping:'t_ca_observaciones'},
            {name: 'fchsalida' , type: 'string',mapping:'t_ca_fchsalida'},
            {name: 'doctransporte' , type: 'string',mapping:'t_ca_doctransporte'},
            {name: 'venta' , type: 'string',mapping:'t_ca_vlrventa'},
            {name: 'neta' , type: 'string',mapping:'t_ca_vlrneta'},
            {name: 'escolta' , type: 'string',mapping:'t_ca_escolta'},
            {name: 'idtransportador' , type: 'string',mapping:'t_ca_idtransportista'},
            {name: 'transportador' , type: 'string',mapping:'p_transportador'}
        ]);        

        this.store = new Ext.data.GroupingStore({
            autoLoad : true,
            url: '<?= url_for("otm/datosPanelTransportistas") ?>',
            reader: new Ext.data.JsonReader(
            {
                root: 'rows',
                totalProperty: 'totalCount'
            },
            this.record)
        });
        this.tbar = [
            {
                text: 'Guardar',
                iconCls: 'disk',
                handler: this.guardar,
                scope: this
            }
        ];
        this.bbar = [
            
            new Ext.PagingToolbar({
		 		id:'paging',
				pageSize: 50,
				store: this.store,
				displayInfo: true,
				displayMsg: 'Mostrando datos {0} - {1} of {2}',
				emptyMsg: "No topics to display"
			})
        ];
        
        PanelTransportistas.superclass.constructor.call(this, {
            clicksToEdit: 1,
			autoHeight : true,
            //stripeRows: true,
            loadMask: {msg:'Cargando...'},            
            id: 'cargas-aduana',
            plugins: [this.checkColumn],
            view: new Ext.grid.GroupingView({
                emptyText: "No hay datos",
                forceFit:true,
                enableRowBody:true,
                hideGroupedColumn: true
                
            }),
            defaults: {
		        sortable: true
			 },
            listeners:{
                rowcontextmenu: this.onRowContextMenu,
                validateedit: this.onValidateEdit,
                afteredit:this.onAfterEdit
            }
        });
        this.getView().getRowClass = this.getRowClass;
    };

    Ext.extend(PanelTransportistas, Ext.grid.EditorGridPanel, {        
        recargar: function(){

            if(this.store.getModifiedRecords().length>0){
                if(!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
                    return 0;
                }
            }
            this.store.reload();
        },

        getRowClass : function(record, rowIndex, p, ds){
            p.cols = p.cols-1;           
            return this.state[record.id] ? 'x-grid3-row-expanded ': 'x-grid3-row-collapsed ';
        },
        onAfterEdit: function(e){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;
            storeReportes = this.store;
            recordReportes = this.record;            
        },
        onValidateEdit: function(e){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;
            storeReportes = this.store;
            recordReportes = this.record;
            
            if( e.field == "semana"){
                if(rec.data.idreg=="")
				{
					var newRec = new recordReportes({
								semana: '+'
							});
					newRec.data.idreg = "";
					storeReportes.addSorted(newRec);
					storeReportes.sort("orden", "ASC");
				}
            }
            else if(e.field == "cliente")
            {            
                store.each( function( r ){
                    if( r.data.idcliente==e.value ){
                        e.value = r.data.compania;
                        rec.set( "idcliente",r.data.idcliente);                        
                        return true;
                    }
                });
            }else if(e.field == "origen")
            {            
                store.each( function( r ){
                    if( r.data.idciudad==e.value ){
                        e.value = r.data.ciudad;
                        rec.set( "idorigen",r.data.idciudad);
                        return true;
                    }
                });
            }else if(e.field == "destino")
            {            
                store.each( function( r ){
                    if( r.data.idciudad==e.value ){
                        e.value = r.data.ciudad;
                        rec.set( "iddestino",r.data.idciudad);
                        return true;
                    }
                });
            }else if(e.field == "transportador")
            {            
                store.each( function( r ){
                    if( r.data.idlinea==e.value ){
                        e.value = r.data.linea;
                        rec.set( "idtransportador",r.data.idlinea);
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
        guardar : function(){
            var store = Ext.getCmp('cargas-aduana').store;

            var records = store.getModifiedRecords();			
            var lenght = records.length;

            changes=[];
            for( var i=0; i< lenght; i++){
                r = records[i];
                if(r.semana!="+")
                {
                    records[i].data.id=r.id;
                    changes[i]=records[i].data;
                }
            }
            var str= JSON.stringify(changes);

            if(str.length>5)
            {
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?= url_for("otm/guardarDatosTransportistas") ?>',
                        params :	{
                            datos:str
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
                            
                            if( res.id && res.success)
                            {
                                id=res.id.split(",");
                                idreg=res.idreg.split(",");
                                for(i=0;i<id.length;i++)
                                {
                                    var rec = store.getById( id[i] );
                                    rec.set("idreg",idreg[i]);
                                    rec.commit();
                                }
                            }
                            if(res.errorInfo)
                            {
                                Ext.MessageBox.alert("Mensaje",'No fue posible el guardar la fila <br>'+res.errorInfo);
                            }
                            else
                            {
                                Ext.MessageBox.alert("Mensaje",'Se guardo correctamente la informacion');
                            }
                        }
                     }
                );
            }        
        },
        
        onRowContextMenu: function(grid, index, e){
            rec = grid.store.getAt(index);
            e.stopEvent(); 
            var store = this.store;
                        
            if(!this.menu){
                this.menu = new Ext.menu.Menu({
                    enableScrolling : false,
                    items: [
                        {
                            text: 'Eliminar',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                                if( confirm("Esta seguro?") ){                                    
                                    if( this.ctxRecord.data.idreg){
                                       var id=this.ctxRecord.id;
                                        Ext.Ajax.request(
                                        {
                                            waitMsg: 'Guardando cambios...',
                                            url:'modules/administracion/actions/eliminarBarrio.php',
                                            params : {                                                
                                                idreg: this.ctxRecord.data.idreg
                                            },
                                            failure:function(response,options){
                                                alert( response.responseText );
                                                success = false;
                                            },
                                            success:function(response,options){
                                                var res = Ext.util.JSON.decode( response.responseText );
                                                    r = store.getById(id );
                                                    store.remove( r );
                                            }
                                        });
                                    }else
                                    {
                                        r = store.getById( this.ctxRecord.id );
                                        store.remove( r );
                                    }
                                }
                            }
                        }
                    ]
                });
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
        onSelectReferencia: function(combo,record,index){
        alert(record.toSource());
        },
        onSelectCliente: function(combo,record,index){
            var rec = record;
            //var ed = this.colModel.get getCellEditor(e.column, e.row);
            var store = combo.store;
            
            store.each( function( r ){
                alert(r.data.toSource())
                combo.value=r.data.compania;
                //rec.set( "idcliente",r.data.idcliente);
                //rec.set( "cliente",r.data.compania);
                
                /*if( r.data.id==e.value ){
                    e.value = r.data.valor;
                    rec.set( "idcliente",r.data.id);
                    return true;
                }*/
            });
        },
        formatItem1: function(value, p, record) {
             return String.format('<div style="background-color: #E9CCE9">{0}</div>',value);
         }
    });	
</script>

