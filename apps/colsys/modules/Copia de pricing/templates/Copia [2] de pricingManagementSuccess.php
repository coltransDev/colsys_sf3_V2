
<script language="javascript">


Ext.grid.GroupSummary = function(config){
    Ext.apply(this, config);
};

Ext.extend(Ext.grid.GroupSummary, Ext.util.Observable, {
    init : function(grid){
        this.grid = grid;
        this.cm = grid.getColumnModel();
        this.view = grid.getView();

        var v = this.view;
        v.doGroupEnd = this.doGroupEnd.createDelegate(this);

        v.afterMethod('onColumnWidthUpdated', this.doWidth, this);
        v.afterMethod('onAllColumnWidthsUpdated', this.doAllWidths, this);
        v.afterMethod('onColumnHiddenUpdated', this.doHidden, this);
        v.afterMethod('onUpdate', this.doUpdate, this);
        v.afterMethod('onRemove', this.doRemove, this);

        if(!this.rowTpl){
            this.rowTpl = new Ext.Template(
                '<div class="x-grid3-summary-row" style="{tstyle}">',
                '<table class="x-grid3-summary-table" border="0" cellspacing="0" cellpadding="0" style="{tstyle}">',
                    '<tbody><tr>{cells}</tr></tbody>',
                '</table></div>'
            );
            this.rowTpl.disableFormats = true;
        }
        this.rowTpl.compile();

        if(!this.cellTpl){
            this.cellTpl = new Ext.Template(
                '<td class="x-grid3-col x-grid3-cell x-grid3-td-{id} {css}" style="{style}">',
                '<div class="x-grid3-cell-inner x-grid3-col-{id}" unselectable="on">{value}</div>',
                "</td>"
            );
            this.cellTpl.disableFormats = true;
        }
        this.cellTpl.compile();
    },

    toggleSummaries : function(visible){
        var el = this.grid.getGridEl();
        if(el){
            if(visible === undefined){
                visible = el.hasClass('x-grid-hide-summary');
            }
            el[visible ? 'removeClass' : 'addClass']('x-grid-hide-summary');
        }
    },

    renderSummary : function(o, cs){
        cs = cs || this.view.getColumnData();
        var cfg = this.cm.config;

        var buf = [], c, p = {}, cf, last = cs.length-1;
        for(var i = 0, len = cs.length; i < len; i++){
            c = cs[i];
            cf = cfg[i];
            p.id = c.id;
            p.style = c.style;
            p.css = i == 0 ? 'x-grid3-cell-first ' : (i == last ? 'x-grid3-cell-last ' : '');
            if(cf.summaryType || cf.summaryRenderer){
                p.value = (cf.summaryRenderer || c.renderer)(o.data[c.name], p, o);
            }else{
                p.value = '';
            }
            if(p.value == undefined || p.value === "") p.value = "&#160;";
            buf[buf.length] = this.cellTpl.apply(p);
        }

        return this.rowTpl.apply({
            tstyle: 'width:'+this.view.getTotalWidth()+';',
            cells: buf.join('')
        });
    },

    calculate : function(rs, cs){		
        var data = {}, r, c, cfg = this.cm.config, cf;
        for(var j = 0, jlen = rs.length; j < jlen; j++){
            r = rs[j];
            for(var i = 0, len = cs.length; i < len; i++){
                c = cs[i];
                cf = cfg[i];
								
                if(cf.summaryType){
				 // valor , record , campo 
                    data[c.name] = Ext.grid.GroupSummary.Calculations[cf.summaryType](data[c.name] || 0, r, c.name, data);
                }
            }
        }
        return data;
    },
	
	saveData : function(rs, cs){		
		
        var data = {}, r, c, cfg = this.cm.config, cf;
		

		
        for(var j = 0, jlen = rs.length; j < jlen; j++){
			
            r = rs[j];			
			var changes =  r.getChanges();
			
			
			
			
			
          /*  for(var i = 0, len = cs.length; i < len; i++){
                c = cs[i];
                cf = cfg[i];
				alert( data[c.name] );				
                if(cf.summaryType){
					alert( c.name );
                    data[c.name] = Ext.grid.GroupSummary.Calculations[cf.summaryType](data[c.name] || 0, r, c.name, data);
                }
            }*/
        }		
        return data;
    },
	
    doGroupEnd : function(buf, g, cs, ds, colCount){
        var data = this.calculate(g.rs, cs);
		
        buf.push('</div>', this.renderSummary({data: data}, cs), '</div>');
    },

    doWidth : function(col, w, tw){
        /*var gs = this.view.getGroups(), s;
        for(var i = 0, len = gs.length; i < len; i++){
            s = gs[i].childNodes[2];
            s.style.width = tw;
            s.firstChild.style.width = tw;
            s.firstChild.rows[0].childNodes[col].style.width = w;
        }*/
    },

    doAllWidths : function(ws, tw){
       /* var gs = this.view.getGroups(), s, cells, wlen = ws.length;
        for(var i = 0, len = gs.length; i < len; i++){
            s = gs[i].childNodes[2];
            s.style.width = tw;
            s.firstChild.style.width = tw;
            cells = s.firstChild.rows[0].childNodes;
            for(var j = 0; j < wlen; j++){
                cells[j].style.width = ws[j];
            }
        }*/
    },

    doHidden : function(col, hidden, tw){
        var gs = this.view.getGroups(), s, display = hidden ? 'none' : '';
        for(var i = 0, len = gs.length; i < len; i++){
            s = gs[i].childNodes[2];
            s.style.width = tw;
            s.firstChild.style.width = tw;
            s.firstChild.rows[0].childNodes[col].style.display = display;
        }
    },

    // Note: requires that all (or the first) record in the 
    // group share the same group value. Returns false if the group
    // could not be found.
    refreshSummary : function(groupValue){
		
        return this.refreshSummaryById(this.view.getGroupId(groupValue));
    },

    getSummaryNode : function(gid){
        var g = Ext.fly(gid, '_gsummary');
        if(g){
            return g.down('.x-grid3-summary-row', true);
        }
        return null;
    },

    refreshSummaryById : function(gid){		
        var g = document.getElementById(gid);
        if(!g){
            return false;
        }
        var rs = [];
        this.grid.store.each(function(r){
            if(r._groupId == gid){
                rs[rs.length] = r;
            }
        });
        var cs = this.view.getColumnData();
        var data = this.calculate(rs, cs);
		this.saveData(rs, cs);
        var markup = this.renderSummary({data: data}, cs);

        var existing = this.getSummaryNode(gid);
        if(existing){
            g.removeChild(existing);
        }
        Ext.DomHelper.append(g, markup);
        return true;
    },

    doUpdate : function(ds, record){		
        this.refreshSummaryById(record._groupId);
    },

    doRemove : function(ds, record, index, isUpdate){
        if(!isUpdate){
            this.refreshSummaryById(record._groupId);
        }
    },

    showSummaryMsg : function(groupValue, msg){
        var gid = this.view.getGroupId(groupValue);
        var node = this.getSummaryNode(gid);
        if(node){
            node.innerHTML = '<div class="x-grid3-summary-msg">' + msg + '</div>';
        }
    }
});

Ext.grid.GroupSummary.Calculations = {
    'sum' : function(v, record, field){
        return v + (record.data[field]||0);
    },

    'count' : function(v, record, field, data){
        return data[field+'count'] ? ++data[field+'count'] : (data[field+'count'] = 1);
    },

    'max' : function(v, record, field, data){
        var v = record.data[field];
        var max = data[field+'max'] === undefined ? (data[field+'max'] = v) : data[field+'max'];
        return v > max ? (data[field+'max'] = v) : max;
    },

    'min' : function(v, record, field, data){
        var v = record.data[field];
        var min = data[field+'min'] === undefined ? (data[field+'min'] = v) : data[field+'min'];
        return v < min ? (data[field+'min'] = v) : min;
    },

    'average' : function(v, record, field, data){
        var c = data[field+'count'] ? ++data[field+'count'] : (data[field+'count'] = 1);
        var t = (data[field+'total'] = ((data[field+'total']||0) + (record.data[field]||0)));
        return t === 0 ? 0 : t / c;
    }
}

Ext.grid.HybridSummary = Ext.extend(Ext.grid.GroupSummary, {
    calculate : function(rs, cs){
        var gcol = this.view.getGroupField();
        var gvalue = rs[0].data[gcol];
        var gdata = this.getSummaryData(gvalue);
        return gdata || Ext.grid.HybridSummary.superclass.calculate.call(this, rs, cs);
    },
	
   

    updateSummaryData : function(groupValue, data, skipRefresh){
        var json = this.grid.store.reader.jsonData;
        if(!json.summaryData){
            json.summaryData = {};
        }
        json.summaryData[groupValue] = data;
        if(!skipRefresh){
            this.refreshSummary(groupValue);
        }
    },

    getSummaryData : function(groupValue){
        var json = this.grid.store.reader.jsonData;
        if(json && json.summaryData){
            return json.summaryData[groupValue];
        }
        return null;
    }
});


function guardar(){
	
}

//-----
Ext.onReady(function(){

    Ext.QuickTips.init();
	
	/*
	* Function for updating database
	*/
	function updateModel(){
		var success = true;
		
		ds.each(function(r){
			var changes =  r.getChanges();
			if( r.dirty ){
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
							//ds.rejectChanges();//undo any changes
						},//end failure block      
						
						//The function to be called upon success of the request                                
						success:function(response,options){
							//Ext.MessageBox.alert('Success','Yeah...');
							//alert( response.responseText );						
							//commit changes (removes the red triangle which
							//indicates a 'dirty' field)
							r.commit();						
							//if this is a new record need special handling
							/*if(oGrid_Event.record.data.companyID == 0){
								var responseData = Ext.util.JSON.decode(response.responseText);//passed back from server
								
								//Extract the ID provided by the server
								var newID = responseData.newID;
								//oGrid_Event.record.id = newID;
								
								//Reset the indicator since update succeeded
								oGrid_Event.record.set('newRecord','no');
								
								//Assign the id to the record
								oGrid_Event.record.set('companyID',newID);
								//Note the set() calls do not trigger everything
								//since you may need to update multiple fields for
								//example. So you still need to call commitChanges()
								//to start the event flow to fire things like
								//refreshRow()
								
								
								ds.commitChanges();
			
								//var whatIsTheID = oGrid_Event.record.modified;
							
							//not a new record so just commit changes	
							} else {
								//commit changes (removes the red triangle
								//which indicates a 'dirty' field)
								ds.commitChanges();
							}*/
							
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
		

		//alert("asd"+grid.store.reader.jsonData);
	}
	
	
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
            {name: 'neta', type: 'float'},
            {name: 'sugerida', type: 'float'}
			<?
			foreach( $conceptos as $concepto ){			
			?>
			,{name: 'concepto_<?=$concepto->getCaIdconcepto()?>', type: 'float'}
			<?
			}
			?>
				
            
        ]

    });
	
	ds = new Ext.data.GroupingStore({
            reader: reader,
            data: xg.dummyData,
            sortInfo:{field: 'destino', direction: "ASC"},
            groupField:'origen'
        });

    // define a custom summary function
    Ext.grid.GroupSummary.Calculations['totalCost'] = function(v, record, field){
        return v + (record.data.estimate * record.data.rate);
    }

    var summary = new Ext.grid.GroupSummary(); 

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
                hideable: false,
                summaryRenderer: function(v, params, data){
                    return ((v === 0 || v > 1) ? '(' + v +' Trayectos)' : '(1 Trayecto)');
                }
				
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
                summaryType: 'count',
				
                hideable: false,
                summaryRenderer: function(v, params, data){
                    return ((v === 0 || v > 1) ? '(' + v +' Trayectos)' : '(1 Trayecto)');
                }
                /*,editor: new Ext.form.TextField({
                   allowBlank: false
                })*/ 
				
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
                header: "Vencimiento",
                width: 80,
                sortable: true,
                dataIndex: 'vencimiento',
               
                renderer: Ext.util.Format.dateRenderer('m/d/Y'),
                editor: new Ext.form.DateField({
                    format: 'm/d/Y'
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
                //renderer: Ext.util.Format.usMoney,
				 renderer: function(v){
                    return ((v == 0 ) ? '' : Ext.util.Format.usMoney(v));
                },
                dataIndex: 'concepto_<?=$concepto->getCaIdconcepto()?>',               
                editor: new Ext.form.NumberField({
                    allowBlank: false,
                    allowNegative: false,
                    style: 'text-align:left'
                })
            }
			<?
			}
			?>
        ],

        view: new Ext.grid.GroupingView({
            forceFit:false,
            showGroupName: false,
            enableNoGroups:true, // REQUIRED!
            hideGroupedColumn: true,			
			startCollapsed : true,
			sortAscText: "Orden Ascendente",
			sortDescText: "Orden Descendente",
			groupByText : "Agrupar por esta columna",
			columnsText : "Columnas"
        }),

       
		//plugins: summary,
		
        frame:false,
        width: 1200,
        //height: document.viewport.getHeight()-100,
		autoHeight :true,
		
		//autoWidth: true, 
        clicksToEdit: 1,
        collapsible: false,
        animCollapse: false,
        trackMouseOver: false,
		
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
	 * Handler to control grid editing
	 * @param {Object} oGrid_Event
	 */
	function handleEdit(editEvent) {
		//determine what column is being edited
		var gridField = editEvent.field;
		
		//start the process to update the db with cell contents
		//updateDB( editEvent);
		
		//I don't want to wait for server update to update the Total Column
		/*if (gridField == 'price'){
			getTax(editEvent);//start the process to update the Tax Field
		}*/
	}
	
	/**
	 * Add an event/listener to handle any updates to grid
	 */ 
	 grid.addListener('afteredit', handleEdit);//give event name, handler (can use 'on' shorthand for addListener) 
	 
	 
	
});
/*
grid.addListener({
	'click':{
		fn: function(event){
			alert('asd click')
		}
		,scope:this
	}

});*/








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
	{idtrayecto: <?=$trayecto->getCaIdtrayecto()?>, origen: '<?=$trayecto->getOrigen()?>', destino: '<?=$trayecto->getDestino()?>', linea: '<?=$transportador?$transportador->getCaNombre():""?>', inicio:'01/01/2008',vencimiento: '12/31/2008'    
	<?
	
	$pricFletes = $trayecto->getPricFletes();
	
	foreach( $pricFletes as $flete ){
		?>
		,concepto_<?=$flete->getCaIdconcepto()?>: <?=$flete->getCavlrneto()?>	
		<?
	}	
	?>	
	}
	<?
	/*
    {idtrayecto: <?=$tarifa->getCaIdpricflete()?>, origen: '<?=$trayecto->getOrigen()?>', destino: '<?=$trayecto->getDestino()?>', linea: '<?=$transportador?$transportador->getCaNombre():""?>', inicio:'<?=$tarifa->getCaFchInicio("m/d/Y")?>',vencimiento: '<?=$tarifa->getCaFchVencimiento("m/d/Y")?>' ,   neta: <?=$tarifa->getCaVlrneto()?>, sugerida: <?=$tarifa->getCaVlrMinimo()?>}
	<?
	*/	
	//<?=$tarifa->getCaObservaciones()
	//$tarifa->getCaVlrMinimo()
	//$tarifa->getCaIdMoneda()
}
?>
	];
	
</script>

<div id="tarifario"></div>