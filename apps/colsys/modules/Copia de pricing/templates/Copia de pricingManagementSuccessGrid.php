
<script language="javascript">

/**
 * @class Ext.form.NumberFieldMin
 * @extends Ext.form.NumberField
 * Numeric text field that provides automatic keystroke filtering and numeric validation.
 * @constructor
 * Creates a new NumberField
 * @param {Object} config Configuration options
 */
Ext.form.NumberFieldMin = Ext.extend(Ext.form.NumberField,  {
    
    /**
     * @cfg {String} baseChars The base set of characters to evaluate as valid numbers (defaults to '0123456789').
     */
    baseChars : "0123456789/",
    
    // private
    validateValue : function(value){
       
		if(!Ext.form.NumberField.superclass.validateValue.call(this, value)){
            return false;
        }
		 
        if(value.length < 1){ // if it's blank and textfield didn't flag it then it's valid
             return true;
        }
		var index = value.indexOf("/");
		if( index ){
			var value1 = value.substring(0, index);
			var value2 = value.substring(index+1, 20); 
			
			if(isNaN(value1)||isNaN(value2)){
				this.markInvalid(String.format(this.nanText, value));
				return false;
			}
			
		}else{
			value = String(value).replace(this.decimalSeparator, ".");
			if(isNaN(value)){
				this.markInvalid(String.format(this.nanText, value));
				return false;
			}
		}       
        return true;
    },

    getValue : function(){
		return Ext.form.NumberField.superclass.getValue.call(this);
    },

    setValue : function(v){    
        Ext.form.NumberField.superclass.setValue.call(this, v);
    }
   
});


var monedas = [
		<?
		$i=0;
		foreach( $monedas as $moneda ){
		if($i++!=0){
			echo ",";
		}
			?>
			['<?=$moneda->getcaIdMoneda()?>','<?=$moneda->getcaIdMoneda()?>']
			<?
		}
		?>  
       
    ];


//-----
Ext.onReady(function(){

    Ext.QuickTips.init();
	
	/*
	* Function for updating database
	*/
	function updateModel(){
		var success = true;
		
		ds.each(function(r){			
			if( r.dirty ){
				var changes =  r.getChanges();
				
				if(changes['inicio']){
					changes['inicio']=Ext.util.Format.date(changes['inicio'],'Y-m-d');									
				}	
				
				if(changes['vencimiento']){
					changes['vencimiento']=Ext.util.Format.date(changes['vencimiento'],'Y-m-d');									
				}				
				
				//submit to server
				Ext.Ajax.request( 
					{   //Specify options (note success/failure below that
						//receives these same options)
						waitMsg: 'Saving changes...',
						//url where to send request (url to server side script)
						url: '<?=url_for("pricing/observePricingManagement")?>/id/'+r.data.idtrayecto, 
						
						//If specify params default is 'POST' instead of 'GET'
						//method: 'POST', 
						
						//params will be available server side via $_POST or $_REQUEST:
						params :	changes,
												
						//the function to be called upon failure of the request
						//(404 error etc, ***NOT*** success=false)
						failure:function(response,options){
							success = false;
						},//end failure block      
						
						//The function to be called upon success of the request                                
						success:function(response,options){							
							//alert( response.responseText );						
							//commit changes (removes the red triangle which
							//indicates a 'dirty' field)
							r.commit();										
							
						}//end success block                                      
					 }//end request config
				); //end request 
			} // End dirty	
			
			if( success ){
				Ext.MessageBox.alert('Status','Los cambios se han guardado correctamente');
			}else{
				Ext.MessageBox.alert('Warning','Los cambios no se han guardado: ');
			}
		 });
	}
	
	
	var rendererMin=function( value ){
		
		if( value == 0 ){
			return '';
		}
		
		var index = value.indexOf("/");
		if( index!=-1 ){			
			var value1 = value.substring(0, index);
			var value2 = value.substring(index+1, 20); 		
			return formatNumber(value1)+"/Min"+formatNumber(value2);
		}else{
			return formatNumber(value);
		}	
	};
	
    var xg = Ext.grid;

    var reader = new Ext.data.JsonReader({
        idProperty:'taskId',
        fields: [
            {name: 'idtrayecto', type: 'int'},
            {name: 'origen', type: 'string'},
            {name: 'destino', type: 'string'},
			{name: 'linea', type: 'string'},			
            {name: 'inicio', type: 'date', dateFormat:'m/d/Y'},
			{name: 'vencimiento', type: 'date', dateFormat:'m/d/Y'},		
			{name: 'moneda', type: 'string'},	            
			<?
			foreach( $conceptos as $concepto ){			
			?>
			,{name: 'concepto_<?=$concepto->getCaIdconcepto()?>', type: 'string'}			
			<?
				foreach( $recargos as $recargo ){
				?>
				,{name: 'recargo_<?=$concepto->getCaIdconcepto()?>_<?=$recargo->getCaidRecargo()?>', type: 'string'}			
				<?
				}
			}
			?>
        ]
    });
	
	ds = new Ext.data.GroupingStore({
            reader: reader,
            data: xg.dummyData,
            sortInfo:{field: 'destino', direction: "ASC"},
            groupField:'linea'
        });

    var grid = new xg.EditorGridPanel({
        ds: ds,
        columns: [									
			{				
                id: 'linea',
                header: "Línea",
                width: 200,
                sortable: true,
                dataIndex: 'linea',
                summaryType: 'count',				
                hideable: false				
            },
			{
                header: "Origen",
                width: 120,
                sortable: true,
                dataIndex: 'origen'
            },			
            {
                id: 'destino',
                header: "Destino",
                width: 120,
                sortable: true,
                dataIndex: 'destino',               
                hideable: false               
            },			 
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
            },{
                header: "Moneda",
                width: 80,
                sortable: false,
                dataIndex: 'moneda',              
                editor: new Ext.form.ComboBox({
					typeAhead: true,
					triggerAction: 'all',
					//transform:'light',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					store : monedas
				 
	
				})

               
            }
				
			<?
			foreach( $conceptos as $concepto ){			
			?>
			,{
                id: 'concepto_<?=$concepto->getCaIdconcepto()?>',
                header: "<?=$concepto->getCaConcepto()?>",
                width: 80,
                sortable: true,
                groupable: false,			
				renderer: rendererMin,							
                dataIndex: 'concepto_<?=$concepto->getCaIdconcepto()?>',               
                editor: new Ext.form.NumberFieldMin({
                    allowBlank: false ,
					allowNegative: false,
					style: 'text-align:left'                                      
                })
            }
				<?
				foreach( $recargos as $recargo ){
				?>					
				,{
					id: 'recargo_<?=$concepto->getCaIdconcepto()?>_<?=$recargo->getCaidRecargo()?>',
					header: "<?=$recargo->getCaRecargo()?>",
					width: 80,
					sortable: true,
					groupable: false,
					hidden : true, 					
					renderer:  rendererMin,						
					dataIndex: 'recargo_<?=$concepto->getCaIdconcepto()?>_<?=$recargo->getCaidRecargo()?>',               
					css : 'background-color:#F3F8FC;',
					editor: new Ext.form.NumberFieldMin({
						allowBlank: false,
						allowNegative: false,
						style: 'text-align:left'
					})
				}
				<?
				}				
			}
			?>
        ],
		
		//sm: sm,
        view: new Ext.grid.GroupingView({
            forceFit:false,
            showGroupName: false,
            enableNoGroups:true, // REQUIRED!
            hideGroupedColumn: true,			
			startCollapsed : false,
			sortAscText: "Orden Ascendente",
			sortDescText: "Orden Descendente",
			groupByText : "Agrupar por esta columna",
			columnsText : "Columnas",
			scrollOffset: 100
        }),

       
		//plugins: summary,
		
        frame:true,
        width: document.viewport.getWidth()-10,
        height: document.viewport.getHeight()-100,
		//autoHeight :true,
		
		//autoWidth: true, 
        clicksToEdit: 1,
        collapsible: false,
        animCollapse: false,
	    
        //trackMouseOver: false,
		
		// autoWidth :true, 
        //enableColumnMove: false,
        title: 'Administración del tarifario',
        iconCls: 'icon-grid',
        renderTo: document.body,
		
		tbar: [
			  {
				text: 'Guardar Cambios',
				tooltip: 'Guarda los cambios realizados en el tarifario',
				iconCls:'add',                      // reference to our css
				handler: updateModel
			  } 
			  ]
    }); 
	
	/**
	* Muestra las columnas de recargos de este concepto y oculta las que no le corresponden	
	**/
	grid.getSelectionModel().on('cellselect', function(sm, rowIndex, columnIndex) {

		var cm = grid.getColumnModel();
        var row = grid.getView().getRow(rowIndex);
        //var record = this.store.getAt(rowIndex);		
		var fieldName = cm.getDataIndex(columnIndex); // Get field name
	    //var data = record.get(fieldName);
		if( fieldName.substr(0,8)=="concepto" ){
			var concepto_id = fieldName.substr(9,5);				
			for( var i = 0 ; i<cm.getColumnCount(); i++ ){								
				if( cm.getDataIndex(i).substr(0,7)=="recargo" ){
					
					
					var recargo_concepto_id = cm.getDataIndex(i).substr(8,10);
					var index = recargo_concepto_id.indexOf("_");
					recargo_concepto_id = recargo_concepto_id.substr(0,index);
					
					if( recargo_concepto_id==concepto_id ){					 	
						cm.setHidden(i, false);	
					}else{
						if( !cm.hidden ){
							cm.setHidden(i, true);
						}
					}
				}
			}						
		}
    }); 	
});


Ext.grid.dummyData = [

<?
$i = 0;

foreach( $trayectos as $trayecto ){
	if( $i!=0){
		echo ",";
	}
	$i++;
	$transportador = $trayecto->getTransportador();		
	?>
	{idtrayecto: <?=$trayecto->getCaIdtrayecto()?>, origen: '<?=$trayecto->getOrigen()?>', destino: '<?=$trayecto->getDestino()?>', linea: '<?=$transportador?$transportador->getCaNombre():""?>', inicio:'<?=$trayecto->getCaFchinicio("d/m/Y")?>',vencimiento: '<?=$trayecto->getCaFchvencimiento("d/m/Y")?>', moneda:"<?=$trayecto->getCaIdMoneda()?>"    
	<?
	
	$pricFletes = $trayecto->getPricFletes();
	
	foreach( $pricFletes as $flete ){
		?>
		,concepto_<?=$flete->getCaIdconcepto()?>: <?=$flete->getCavlrneto()?>	
		<?
		
		$recargos = $flete->getPricRecargos();
		foreach( $recargos as $recargo){
			?>
			,recargo_<?=$flete->getCaIdconcepto()?>_<?=$recargo->getCaidrecargo()?>: <?=$recargo->getCaVlrrecargo()?>	
			<?
		}
	}	
	?>	
	}
	<?	
}
?>
	];
	
</script>
