<script language="javascript" type="text/javascript">
<!--
	Ext.onReady(function(){
    // basic tabs 1, built from existing content
    var tabs = new Ext.TabPanel({
        renderTo: 'tabs1',
        width:800,
        activeTab: 0,
        frame:true,
        defaults:{autoHeight: true},
        items:[
            {contentEl:'recargosFijos', title: 'Recargos fijos'},
            {contentEl:'conceptos', title: 'Conceptos'},            
            {contentEl:'recargos', title: 'Recargos'}
            
          
            
            
        ]
    });

    // second tabs built from JS
   /* var tabs2 = new Ext.TabPanel({
        renderTo: document.body,
        activeTab: 0,
        width:600,
        height:250,
        plain:true,
        defaults:{autoScroll: true},
        items:[{
                title: 'Normal Tab',
                html: "My content was added during construction."
            },{
                title: 'Ajax Tab 1',
                autoLoad:'ajax1.htm'
            },{
                title: 'Ajax Tab 2',
                autoLoad: {url: 'ajax2.htm', params: 'foo=bar&wtf=1'}
            },{
                title: 'Event Tab',
                listeners: {activate: handleActivate},
                html: "I am tab 4's content. I also have an event listener attached."
            },{
                title: 'Disabled Tab',
                disabled:true,
                html: "Can't see me cause I'm disabled"
            }
        ]
    });

    function handleActivate(tab){
        alert(tab.title + ' was activated.');
    }*/
});

/*
var vp = new Ext.Viewport({
    	layout : 'fit',
    	items : tabs
    });*/
-->
</script>

<table class="tableForm" width="90%" >
	<tr>
		<td>
			<?=image_tag("banderas/".basename($trafico->getCaBandera()), "width=100")?><h2><?=$trafico->getCaNombre()?></h2>
		</td>
	</tr>
	
	<tr>
		<td>
			
		</td>
	</tr>
	<tr>
		<td>			
		    <div id="tabs1">		        
		        <div id="conceptos" class="x-hide-display">
					<br />
					<?=image_tag("22x22/new.gif")?> Agregar concepto<br /><br />


		           <table width="200" border="1" class="tableList">
				   <?
				   $conceptos = $trafico->getConceptos("Marítimo", "FCL");
				   foreach( $conceptos as $concepto ){
				   ?>
						<tr>
							<td><?=$concepto->getCaConcepto()?></td>	
							<td><?=image_tag("16x16/delete.gif")?></td>						
						</tr>
	


				   
				   <?
				   }
				   ?>
				   </table>
		        </div>
		        <div id="recargos" class="x-hide-display">
					<br />
					<?=image_tag("22x22/new.gif")?> Agregar recargo<br /><br />

		            <table width="200" border="1" class="tableList">
				   <?
				   $recargos = $trafico->getTipoRecargos("Marítimo");
				   foreach( $recargos as $recargo ){
				   ?>
						<tr>
							<td><?=$recargo->getCaRecargo()?></td>		
							<td><?=image_tag("16x16/delete.gif")?></td>						
						</tr>
	


				   
				   <?
				   }
				   ?>
				   </table>
		        </div>
		        <div id="recargosFijos" class="x-hide-display">
		            <div id="recargosFijosgrid"></div>
		        </div>
		    </div>	
		</td>
	</tr>
	
	<? include_partial("pricing/parametrizacionRecargosFijos", array("trafico"=>$trafico, "transporte"=>"Marítimo")) ?>
</table>
