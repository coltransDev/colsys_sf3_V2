<?
$semanas = $sf_data->getRaw("semanas");
?>
<script type="text/javascript" >
PanelFiltrosProgCargas = function( config ){
        Ext.apply(this, config);      
        this.items = [
			{
			xtype:'fieldset',title:'filtros',layoutConfig: {columns: 8},width:1000,id:'panel-filtros',layout:'table',
			items:[                
                {
                    border:false,title:"Fecha Inicial ",width:100,
                    items:[{xtype: 'datefield',name:"F_fechaini",id:"F_fechaini",format:'Y-m-d',width:100,listeners: {specialkey: this.SpecialKey}}]
                }
                ,
                {							
                    border:false,title:"Fecha Final",width:100,
                    items:[{xtype: 'datefield',name:"F_fechafin",id:"F_fechafin",format:'Y-m-d',width:100,listeners: {specialkey: this.SpecialKey}}]
                },
                {
                    border:false,title:"Sem Ini",width:80,
                    items:[new MultiWidget({                    
                    id:"F_semanaIni",name:"F_semanaIni",width:80,
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
                })]
                }
                ,
                {
                    border:false,title:"Sem Fin",width:80,
                    items:[new MultiWidget({                    
                    id:"F_semanaFin",name:"F_semanaFin",width:80,
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
                })]
                },
                {
                    border:false,title:"Doc Transporte",width:130,
                    items:[{xtype: 'textfield',name:"F_doctransporte",id:"F_doctransporte",width:130,listeners: {specialkey: this.SpecialKey}}]
                },
                {
                    border:false,title:"Transportador",width:250,
                    items:[new WidgetLinea({id:'F_transportador',name:'F_transportador',hiddenName:'idtransportador',linkTransporte: "<?=  Constantes::TERRESTRE?>",width:250})]
                },
                {
                    border:false,title:"Origen",width:120,
                    items:[new WidgetCiudad({width:120,id: 'F_origen',name: 'F_origen',hiddenName:"idorigen"})]
                },
                {
                    border:false,title:"Destino",width:120,
                    items:[new WidgetCiudad({width:120,id: 'F_destino',name: 'F_destino',hiddenName:"iddestino"})]
                }
			]
		}
			];
        this.tbar = [
        	{text:'Buscar',iconCls:'search',handler: reload},
			{text: 'Limpiar',iconCls:'delete',
				handler: function()
				{
                    Ext.getCmp("panel-filtros-carga").getForm().reset();                    
				}
			}            
        ];
        PanelFiltrosProgCargas.superclass.constructor.call(this, {
            loadMask: {msg:'Cargando...'},
            id: 'panel-filtros-carga'
            
        });
    };

    Ext.extend(PanelFiltrosProgCargas, Ext.form.FormPanel, {
		SpecialKey : function(field, e)
		{
			if (e.getKey() == e.ENTER)
				reload();
		}
    });
    
function reload()
{	
    if(Ext.getCmp("F_fechaini"))
        Ext.getCmp("cargas-aduana").store.setBaseParam("fechaini",Ext.getCmp("F_fechaini").getValue());
    
    if(Ext.getCmp("F_fechaini"))
        Ext.getCmp("cargas-aduana").store.setBaseParam("fechafin",Ext.getCmp("F_fechafin").getValue());
    
    if(Ext.getCmp("F_semanaIni"))
        Ext.getCmp("cargas-aduana").store.setBaseParam("semanaini",Ext.getCmp("F_semanaIni").getValue());
    
    if(Ext.getCmp("F_semanaFin"))
        Ext.getCmp("cargas-aduana").store.setBaseParam("semanafin",Ext.getCmp("F_semanaFin").getValue());
    
    if(Ext.getCmp("F_doctransporte"))
        Ext.getCmp("cargas-aduana").store.setBaseParam("doctransporte",Ext.getCmp("F_doctransporte").getValue());
    
    if(Ext.getCmp("F_transportador"))
        Ext.getCmp("cargas-aduana").store.setBaseParam("transportador",Ext.getCmp("F_transportador").getValue());
    
    if(Ext.getCmp("F_origen"))
        Ext.getCmp("cargas-aduana").store.setBaseParam("origen",Ext.getCmp("F_origen").getValue());
    
    if(Ext.getCmp("F_destino"))
        Ext.getCmp("cargas-aduana").store.setBaseParam("destino",Ext.getCmp("F_destino").getValue());
	
	Ext.getCmp("cargas-aduana").store.setBaseParam("start",Ext.getCmp("paging").cursor);	
	Ext.getCmp("cargas-aduana").store.load();   
}
</script>