<?
use_helper( "Ext2" );
?>
<style type="text/css">
.row_FLETE{	
	background-color: #DFE7FF;	
}
</style>

<link rel="stylesheet" type="text/css"
	href="/colsys_sf/css/treegrid/css/TreeGrid.css" />
<link
	rel="stylesheet" type="text/css"
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
  
<script type="text/javascript">
	
    Ext.onReady(function(){
       /*
	   * Se crea un record para almacenar los datos d elos recargos 
	   */
	   
	   /*
	   * Se crea un combo para los recargos 
	   */
	   	   
	   
	   
	   /* Inicializa los tooltips
		*/
		Ext.QuickTips.init();	
		Ext.apply(Ext.QuickTips.getQuickTip(), {	   
		   dismissDelay: 200000 //permite que los tips permanezcan por mas tiempo. 
		});
		
		/*
		* Cre un template para renderizar el tooltip
		*/
		var qtipTpl=new Ext.XTemplate(
					 '<h3>Observaciones:</h3>'
					,'<tpl for=".">'
					,'<div>{observaciones}</div>'
					,'</tpl>'
				);
		
		/**
		* Renderiza una celda incluyendo el tooltip de observaciones
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
	   
	   /*
		* Crea el expander
		*/
		var expander = new Ext.grid.myRowExpander({  	  
		  lazyRender : false, 
		  width: 15,	
		  tpl : new Ext.Template(
			  '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class=\'btnComentarios\' id=\'obs_{_id}\'><strong>Observaciones:</strong> {observaciones}</div></p>' 
			 
		  )
		});
	   
	   
       Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
       
	   var treePanelOnclickHandler = function(n){
			
			//var sn = this.selModel.selNode || {}; // selNode is null on initial selection
							
			if( n.leaf ){  // ignore clicks on folders 
				var nodeoptions = n.id.split("_");
				
				if( nodeoptions[3]=="ciudad" ){
					var idciudad = nodeoptions[4]; 				
				}else{
					var idciudad = "";
				}
				
				if( nodeoptions[3]=="linea" ){
					var idlinea = nodeoptions[4]; 					
				}else{
					var idlinea = "";
				}
				
				Ext.Ajax.request({
					url: '<?=url_for("pricing/grillaPorTrafico")?>',
					params: {						
						trafico_id: nodeoptions[2],
						transporte: nodeoptions[0],
						modalidad: nodeoptions[1],
						idciudad: idciudad,
						idlinea: idlinea
					},
					success: function(xhr) {						
						var newComponent = eval(xhr.responseText);
						Ext.getCmp('tab-panel').add(newComponent);
						//Ext.getCmp('tab-panel').setActiveTab(newComponent);
						Ext.getCmp('tab-panel').show();
					},
					failure: function() {
						Ext.Msg.alert("Grid create failed", "Server communication failure");
					}
				});
			
				/*
				Ext.getCmp('tab-panel').add({
					id: 'panel1',
					title: n.text ,
					iconCls: 'tabs',					
					closable:true					
				}).show();*/
				
				
				/*
				Ext.getCmp('content-panel').layout.setActiveItem(n.id + '-panel');
				if(!detailEl){
					var bd = Ext.getCmp('details-panel').body;
					bd.update('').setStyle('background','#fff');
					detailEl = bd.createChild(); //create default empty div
				}
				detailEl.hide().update(Ext.getDom(n.id+'-details').innerHTML).slideIn('l', {stopFx:true,duration:.2});
				*/
    		}else{
				n.expand();
			}
		}
	    
       var viewport = new Ext.Viewport({
            layout:'border',
            items:[
                new Ext.BoxComponent({ // raw
                    region:'north',
                    el: 'north',
                    height:32
                })
				,{
                    region:'south',
                    contentEl: 'south',
                    split:true,
                    height: 100,
                    minSize: 100,
                    maxSize: 200,
                    collapsible: true,
                    title:'South',
                    margins:'0 0 0 0'
                }, {
                    region:'east',
                    title: 'Información adicional',
                    collapsible: true,
                    split:true,
                    width: 225,
                    minSize: 175,
                    maxSize: 400,
                    layout:'fit',
                    margins:'0 5 0 0',
                    items:
                        new Ext.TabPanel({
                            border:false,
                            activeTab:1,
                            tabPosition:'bottom',
							
                            items:[{
                                html:'<p>A TabPanel component can be a region.</p>',
                                title: 'A Tab',
                                autoScroll:true
                            },
                            new Ext.grid.PropertyGrid({
                                title: 'Property Grid',
                                closable: true,
                                source: {
                                    "(name)": "Properties Grid",
                                    "grouping": false,
                                    "autoFitColumns": true,
                                    "productionQuality": false,
                                    "created": new Date(Date.parse('10/15/2006')),
                                    "tested": false,
                                    "version": .01,
                                    "borderWidth": 1
                                }
                            })]
                        })
                 },{
                    region:'west',
                    id:'west-panel',
                    title:'Traficos',
                    split:true,
                    width: 200,
                    minSize: 175,
                    maxSize: 400,
                    collapsible: true,
                    margins:'0 0 0 5',
                    layout:'accordion',
                    layoutConfig:{
                        animate:true
                    },
                    items: [
						<?
						$i=0;
						foreach( $modalidades_mar as $modalidad){
							if( $i++!=0 ){
								echo ",";
							} 

						?>
						new Ext.tree.TreePanel({							
							title: 'Marítimo <?=$modalidad->getCaValor()?>',							
							split: true,
							height: 300,
							minSize: 150,
							autoScroll: true,
							
							// tree-specific configs:
							rootVisible: false,
							lines: false,
							singleExpand: true,
							useArrows: true,
							iconCls:'settings',
							animate:true,

														
							loader: new Ext.tree.TreeLoader({
								dataUrl:'<?=url_for("pricing/datosCiudades?transporte=Marítimo&modalidad=".$modalidad->getCaValor())?>'
							}),
							
							root: new Ext.tree.AsyncTreeNode(),
							listeners:  {
								 click : treePanelOnclickHandler
							}
						})
						<?
						}
						
						foreach( $modalidades_aer as $modalidad){
							if( $i++!=0 ){
								echo ",";
							} 
						?>
						new Ext.tree.TreePanel({							
							title: 'Aéreo <?=$modalidad->getCaValor()?>',							
							split: true,
							height: 300,
							minSize: 150,
							autoScroll: true,
							
							// tree-specific configs:
							rootVisible: false,
							lines: false,
							singleExpand: true,
							useArrows: true,
							iconCls:'settings',
														
							loader: new Ext.tree.TreeLoader({
								dataUrl:'<?=url_for("pricing/datosCiudades?transporte=Aéreo&modalidad=".$modalidad->getCaValor())?>'
							}),
							
							root: new Ext.tree.AsyncTreeNode(),
							listeners:  {
								 click : treePanelOnclickHandler
							}
						})
						<?
						}
						foreach( $modalidades_ter as $modalidad){
							if( $i++!=0 ){
								echo ",";
							} 
						?>						
						new Ext.tree.TreePanel({							
							title: 'Terrestre <?=$modalidad->getCaValor()?>',							
							split: true,
							height: 300,
							minSize: 150,
							autoScroll: true,
							
							// tree-specific configs:
							rootVisible: false,
							lines: false,
							singleExpand: true,
							useArrows: true,
							iconCls:'settings',
							loader: new Ext.tree.TreeLoader({
								dataUrl:'<?=url_for("pricing/datosCiudades?transporte=Terrestre&modalidad=".$modalidad->getCaValor())?>'
							}),
							
							root: new Ext.tree.AsyncTreeNode(),
							listeners:  {
								 click : treePanelOnclickHandler
							}
						})
						<?
						}
						?>
						
					]
                },
                new Ext.TabPanel({
					id:'tab-panel',
                    region:'center',
                    deferredRender:false,
					enableTabScroll:true,
                    activeTab:0,
                    items:[{
                        contentEl:'center1',
                        title: 'Acerca de',
                        closable:false,
                        autoScroll:true
                    }]
                })
             ]
        });
        
		/*Ext.get("hideit").on('click', function() {
           var w = Ext.getCmp('west-panel');
           w.collapsed ? w.expand() : w.collapse(); 
        });*/
		
		
		
    
    });
	</script>

  
  
  <div id="traficos"></div>
  <div id="north">
    <h3>Sistema de administraci&oacute;n del tarifario</h3>
  </div>
  <div id="center2">
       &nbsp;        
  </div>
  <div id="center1">
 		<br />	 	
        <h3>&nbsp;&nbsp;&nbsp;Bienvenido al sistema de administracion del tarifario. </h3><br />
		<hr />
		&nbsp;&nbsp;&nbsp;Para comenzar a trabajar por favor seleccione una ciudad del panel de traficos.
		<br />
		&nbsp;&nbsp;&nbsp;Por favor tenga en cuenta las observaciones.
		

  </div>
  <div id="props-panel" style="width:200px;height:200px;overflow:hidden;">
  </div>
  <div id="south">
    <p>south - generally for informational stuff, also could be for status bar</p>
  </div>
