<?
use_helper("Javascript", "Object", "Validation");
?>
<!--

<h3>Sistema de Cotizaciones</h3>
<table class="tableForm" width="700px" border="1" id="mainTable">
	<tr>
		<th class="titulo" colspan="3">Datos de la Cotización</th>
	</tr>
	<tr>
	  <td class="captura">Datos de Control:</td>
	  <td class="invertir">
		<table cellspacing="1" width="100%">
			<tr>
				<td class="listar">Fecha de Cotización :<br /><center></center></td>
				<td class="listar">Fecha de Solicitud :<br /><center><?=$cotizacion->getCaFchsolicitud()?></center></td>
				<td class="listar">Hora de Solicitud :<br /><center><?=$cotizacion->getCaHorasolicitud()?></center></td>
				<td class="listar">No. de Cotización :<br /><center><?=$cotizacion->getCaIdcotizacion()?></center></td>
			</tr>
		</table>
	  </td>
	  <td class="mostrar" rowspan="5">
	  </td>
	</tr>
	<?
		$concliente = $cotizacion->getContacto();
		$cliente = $concliente;
		if( $concliente ) {
			$cliente = $concliente->getCliente();
	?>
	<tr>
	  <td class="titulo" style="text-align:left; vertical-align:top;">Cliente:<br></td>
	  <td class="invertir">
		<table width="100%" cellspacing="1" >
		  <tr>
		    <td class="mostrar"><b>Nombre:</b><br><?=$cliente->getCaCompania()?></td>
		    <td class="mostrar"><b>Nit:</b><br><?=$cliente->getCaIdCliente()?></td>
		  </tr>
		  <tr>
		    <td class="mostrar"><b>Contacto:</b><br><?=$concliente->getCaNombres()?></td>
		    <td class="mostrar"><b>Teléfono:</b><br><?=$concliente->getCaTelefonos()?></td>
		  </tr>
		  <tr>
		    <td class="mostrar"><b>Dirección:</b><br><?=$cliente->getCaDireccion()?></td>
		    <td class="mostrar"><b>Fax:</b><br><?=$concliente->getCaFax()?></td>
		  </tr>
		  <tr>
		    <td class="mostrar" colspan="2"><b>Correo Electr&oacute;nico:</b><br><?=$concliente->getCaEmail()?></td>
		  </tr>
		</table>
	  </td>
	</tr>
	<?
		} 
	?>
	<tr>
	  <td class=captura>Asunto:</td>
	  <td class=mostrar><?=$cotizacion->getCaAsunto()?></td>
	</tr>
	<tr>
	  <td class=captura>Saludo:</td>
	  <td class=mostrar><?=$cotizacion->getCaSaludo()?></td>
	</tr>
	<tr>
	  <td class=captura style='vertical-align:top;'>Entrada:</td>
	  <td class=mostrar><?=$cotizacion->getCaEntrada()?></td>
	</tr>
	<tr>
		<td class="invertir" colspan="2" ><div align="center"><strong>PRODUCTOS A TRANSPORTAR</strong></div></td>
		<td class="invertir"><div align="right">
			<?=$option!="productos"?link_to(image_tag("22x22/edit.gif"), "cotizaciones/consultaCotizacion?id=".$cotizacion->getCaIdcotizacion()."&editable=1&option=productos&token=".md5(time()) ):"&nbsp;"?>
		</div></td>
	</tr>
	<tr>
		<td class="invertir" colspan="7">
			<div id="productInfo"></div>	
		</td>
	</tr>

</table>-->

<link rel="stylesheet" type="text/css" 	href="/colsys_sf/css/treegrid/css/TreeGrid.css" />
<link rel="stylesheet" type="text/css"
	href="/colsys_sf/css/treegrid/css/TreeGridLevels.css" />
<script
	language="javascript" src="/colsys_sf/js/treegrid/TreeGrid.js"></script>
<script
	language="javascript" src="/colsys_sf/js/treegrid/RowExpander.js"></script>
<script
	language="javascript" src="/colsys_sf/js/treegrid/myRowExpander.js"></script>
<script
	language="javascript" src="/colsys_sf/js/treegrid/NumberFieldMin.js"></script>
<script
	language="javascript" src="/colsys_sf/js/treegrid/CheckColumn.js"></script>


<script language="javascript">

Controller = function()
{	
	
	function createGrid()
	{
	Ext.QuickTips.init();
	
	Ext.apply(Ext.QuickTips.getQuickTip(), {	   
	   dismissDelay: 200000 //permite que los tips permanezcan por mas tiempo. 
	});
	
    // create the data store
    var record = Ext.data.Record.create([   		
     	{name: 'idtrayecto', type: 'int'},
		{name: 'origen', type: 'string'},
		{name: 'destino', type: 'string'},
		{name: 'linea', type: 'string'},			
		{name: 'inicio', type: 'date', dateFormat:'m/d/Y'},
		{name: 'vencimiento', type: 'date', dateFormat:'m/d/Y'},		
		{name: 'moneda', type: 'string'},		
		{name: 'recargo_id', type: 'int'},
		{name: 'concepto_id', type: 'int'},
		{name: 'observaciones', type: 'string'},
		{name: 'aplicacion', type: 'string'},		
     	{name: '_id', type: 'int'},
     	{name: '_parent', type: 'auto'},
     	{name: '_is_leaf', type: 'bool'},
		{name: 'sel', type: 'bool'}	
		
   	]);
   
	var store = new Ext.ux.maximgb.treegrid.AdjacencyListStore({
    	autoLoad : true,			    			
		reader: new Ext.data.JsonReader(
			{
				id: '_id'
			}, 
			record
		),	
		proxy: new Ext.data.MemoryProxy(<?=json_encode($data)?>)	
		/*
		carga local
		reader: new Ext.data.JsonReader({id: '_id'}, record),
		proxy: new Ext.data.MemoryProxy(data)
		*/
    });
	
	var expander = new Ext.grid.myRowExpander({  	  
	  lazyRender : false, 
	  width: 15,	
      tpl : new Ext.Template(
          '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class=\'btnComentarios\' id=\'obs_{_id}\'><strong>Observaciones:</strong> {observaciones}</div></p>' 
         
      )
    });
	
	
	/*
	* Template to render tooltip
	*/
	var qtipTpl=new Ext.XTemplate(
                 '<h3>Observaciones:</h3>'
                ,'<tpl for=".">'
                ,'<div>{observaciones}</div>'
                ,'</tpl>'
            )
	
	/**
     * Cell rederer including tooltip with observations
     * @param {Mixed} val Value to render
     * @param {Object} cell
     * @param {Ext.data.Record} record
     */
    var renderRowTooltip=function(val, cell, record) {
 		//alert("asdasd");
        // get data
        var data = record.data;
 
         
        // create tooltip
        var qtip = qtipTpl.apply(data);
 
        // return markup
        return '<div qtip="' + qtip +'">' + val + '</div>';
    }	
	
	
	
	var checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30}); 

	var colModel = new Ext.grid.ColumnModel({
	
	  columns: [
	  		expander,				
			{
				id: 'origen',
                header: "Origen",
                width: 200,
                sortable: true,
                renderer: renderRowTooltip,	
                dataIndex: 'origen',
				hideable: false				
            },			
            {
                id: 'destino',
                header: "Destino",
                width: 100,
                sortable: true,
                dataIndex: 'destino', 
                renderer: renderRowTooltip,	              
                hideable: false               
            }
            ,checkColumn,		 
			{
                header: "Inicio",
                width: 80,
                sortable: true,
                dataIndex: 'inicio',               
                renderer: Ext.util.Format.dateRenderer('m/d/Y'),
                editor: new Ext.form.DateField({
                    format: 'm/d/Y'
                })
            },{
                header: "Venc.",
                width: 80,
                sortable: true,
                dataIndex: 'vencimiento',               
                renderer: Ext.util.Format.dateRenderer('m/d/Y'),
                editor: new Ext.form.DateField({
                    format: 'm/d/Y'
                })
            }
            ,{
                header: "Aplicacion",
                width: 100,
                sortable: false,
                dataIndex: 'aplicacion',              
              
            }
            
            ,{
                header: "Moneda",
                width: 80,
                sortable: false,
                dataIndex: 'moneda',              
               
            }
			
			
			
			
			
		
      ],
	
	  isCellEditable: function(colIndex, rowIndex) {
	
		var record = store.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);
    	if (record.data.recargo_id && (field == 'aplicacion'||field == 'inicio'||field == 'vencimiento')) {			
			return false;
		}		
	
		return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
	
	  }
	
	});

	
    // create the Grid
    var grid = new Ext.ux.maximgb.treegrid.GridPanel({
      store: store,
      master_column_id : 'origen',
      cm: colModel,
	  clicksToEdit: 1,
      stripeRows: true,
      autoExpandColumn: 'origen',
      title: 'Definición de productos',
      root_title: 'prueba',
	  sm: new Ext.grid.CellSelectionModel(),
	  //renderTo: 'productInfo',
	  plugins: [expander,checkColumn],
	  width:800,
	  height: 600,
	 
	  tbar: [
			  {
				text: 'agregar',
				tooltip: 'Guarda los cambios realizados en el tarifario',
				iconCls:'add',                      // reference to our css
				handler: agregarFila
			  } 
			] ,
	 
	
    });
	
	
  
 	//grid.getSelectionModel().selectFirstRow();
			
	/**
	* Expande las ramas cuando se seleccionan si el padre no esta expandido lo expande
	**/
	grid.getSelectionModel().on('cellselect', function(sm, rowIndex, columnIndex) {	
		var record = store.getAt(rowIndex);
		store.expandNode(record);
		if( record.data._parent ){
			var parent = store.getById(record.data._parent);
			store.expandNode(parent);
			if( parent.data._parent ){
				var parent = store.getById(parent.data._parent);
				store.expandNode(parent);
			}
		}
    }); 
	
	
	
	
	/**
	* Copia los datos a las columnas seleccionadas 
	**/
	grid.on('afteredit', function(e) {	
		
		if(e.record.data.sel){
			var records = store.getModifiedRecords();				
			var lenght = records.length;				
			var field = e.field;
					
			for( var i=0; i<lenght; i++){
				r = records[i];			
				if(r.data.sel){
					if (r.data.recargo_id && (field == 'aplicacion'||field == 'inicio'||field == 'vencimiento')) {			
						continue;
					}	
					r.set(field,e.value);
				}
			}
		}
		
    }); 
		
	
	var activeRow = null;
	
	var actualizarObservaciones=function( btn, text ){
		
		if( btn=="ok" ){			
			var record = store.getAt(activeRow); 
			record.set("observaciones", text);
			
			document.getElementById("obs_"+record.get("_id")).innerHTML  = "<strong>Observaciones:</strong> "+text;		
		}
	}
	
	/**
	* Muestra las opciones de g
	**/
	grid.on('click', function(e) {

        var btn = e.getTarget('.btnComentarios');        
		
		
        if (btn) {			
            var t = e.getTarget();

            var v = this.view;

            var rowIdx = v.findRowIndex(t);

            var record = this.getStore().getAt(rowIdx);            
			
			activeRow = rowIdx;
			
            Ext.MessageBox.show({
			   title: 'Observaciones',
			   msg: 'Por favor coloque las observaciones:',
			   width:300,
			   buttons: Ext.MessageBox.OKCANCEL,
			   multiline: true,
			   fn: actualizarObservaciones,
			   animEl: 'mb3',
			   value: record.get("observaciones")
		   });	          

        }

    }, grid); 
	
	
	function agregarFila(){
		
		//var records = store.getModifiedRecords();	
		//rec = records[0];
		//rec.data.origen="prueba";
		
		parent2 = store.getAt(0);
		parent2.set("_is_leaf", false);
		
		// create the data store
    	var rec = new record({origen:"Bog",
							  _parent: 0,
							  _is_leaf:true
								})
		
		records = [];
		records.push( rec );
		store.add( records );
		
		/*store.each(function(r){
			alert(r.data.origen);
		})*/
	}
  /*
	* Function for updating database
	*/
	function updateModel(){
		var success = true;
		var records = store.getModifiedRecords();
				
		var lenght = records.length;
		for( var i=0; i<lenght; i++){
			r = records[i];
						
			var changes = r.getChanges();
			
			//Da formato a las fechas antes de enviarlas 
			if(changes['inicio']){
				changes['inicio']=Ext.util.Format.date(changes['inicio'],'Y-m-d');									
			}	
			
			if(changes['vencimiento']){
				changes['vencimiento']=Ext.util.Format.date(changes['vencimiento'],'Y-m-d');									
			}	
			
			//Si es un recargo y lo envia como parametro
			if(r.data.recargo_id){
				changes['recargo_id']=r.data.recargo_id;
				changes['concepto_id']=r.data.concepto_id;									
			}
													
			//submit to server
			Ext.Ajax.request( 
				{   //Specify options (note success/failure below that
					//receives these same options)
					waitMsg: 'Guardando cambios...',
					//url where to send request (url to server side script)
					url: '<?=url_for("pricing/observePricingManagement")?>/id/'+r.data.idtrayecto, 
					
					//If specify params default is 'POST' instead of 'GET'
					//method: 'POST', 
					
					//params will be available server side via $_POST or $_REQUEST:
					params :	changes,
											
					//the function to be called upon failure of the request
					//(404 error etc, ***NOT*** success=false)
					failure:function(response,options){							
						alert( response.responseText );						
						success = false;
					},//end failure block      
					
					//The function to be called upon success of the request                                
					success:function(response,options){							
						alert( response.responseText );						
						//commit changes (removes the red triangle which
						//indicates a 'dirty' field)
						//r.commit();										
						
					}//end success block                                      
				 }//end request config
			); //end request 
			r.set("sel", false);				
		}
		
		if( success ){
			Ext.MessageBox.alert('Status','Los cambios se han guardado correctamente');
			store.commitChanges();
		}else{
			Ext.MessageBox.alert('Warning','Los cambios no se han guardado: ');
		}	
	}
  	
	//------ Formulario ------
	
	var actualizarEncabezado = function ( field ){
			
		Ext.Ajax.request(  
			{   //Specify options (note success/failure below that
				//receives these same options)
				waitMsg: 'Guardando cambios...', 

				//url where to send request (url to server side script) 
				url: '<?=url_for("cotizaciones/observeEncabezadoCotizacion?cotizacionId=".$cotizacion->getCaIdCotizacion())?>/'+field.name+'/'+field.value, 
				
				//If specify params default is 'POST' instead of 'GET'
				//method: 'POST', 
				
				//params will be available server side via $_POST or $_REQUEST:
				//params :	changes,
										
				//the function to be called upon failure of the request
				//(404 error etc, ***NOT*** success=false)
				failure:function(response,options){							
					alert( response.responseText );						
					success = false;
				},
				
				//The function to be called upon success of the request                                
				success:function(response,options){							
					alert( response.responseText );
				}                                      
			 }//end request config
		); //end request*
	}
	
	
    var panel = new Ext.FormPanel({
        labelAlign: 'top',
        title: 'Sistema de cotizaciones',
        bodyStyle:'padding:5px',
      //  width: 800,
        items: [{
            layout:'column',
            border:false,
            items:[{
                columnWidth:.5,
                layout: 'form',
                border:false,
                items: [{
                    xtype:'datefield',
                    fieldLabel: 'Fecha de la cotizacion',
                    name: 'fchCotizacion',
					value: '<?=$cotizacion->getCaFchcotizacion()?>',
					format: "Y-m-d", 
                    anchor:'95%',
					listeners : { "change":actualizarEncabezado }
                }, {
                    xtype:'textfield',
                    fieldLabel: 'Company',
                    name: 'company',
                    anchor:'95%'
                }]
            },{
                columnWidth:.5,
                layout: 'form',
                border:false,
                items: [{
                    xtype:'textfield',
                    fieldLabel: 'Last Name',
                    name: 'last',
                    anchor:'95%'
                },{
                    xtype:'textfield',
                    fieldLabel: 'Email',
                    name: 'email',
                    vtype:'email',
                    anchor:'95%'
                }]
            }]
        },{
            xtype:'tabpanel',
            plain:true,
            activeTab: 0,
            height:235,
            defaults:{bodyStyle:'padding:10px'},
            items:[{
                title:'Informacióin de fletes',
                layout:'form',
                defaults: {width: 800},
                defaultType: 'textfield',

                items: [grid]
            },{
                title:'OTM/DTA',
                layout:'form',
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [{
                    fieldLabel: 'Home',
                    name: 'home',
                    value: '(888) 555-1212'
                },{
                    fieldLabel: 'Business',
                    name: 'business'
                },{
                    fieldLabel: 'Mobile',
                    name: 'mobile'
                },{
                    fieldLabel: 'Fax',
                    name: 'fax'
                }]
            },{
                cls:'x-plain',
                title:'Biography',
                layout:'fit',
                items: {
                    xtype:'htmleditor',
                    id:'bio2',
                    fieldLabel:'Biography'
                }
            }]
        }],

        buttons: [{
            text: 'Save'
        },{
            text: 'Cancel'
        }]
    });
	
	panel.render(document.body);

    var vp = new Ext.Viewport({
    	layout : 'fit',
    	items : panel
    });
	}
	return {
		init : function()
		{
			//Ext.MessageBox.alert('Warning','Por favor lea las observaciones: ');
			createGrid();
		}
	}
	
	
}();




Ext.onReady(Controller.init);
</script>