
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$permisos = $sf_data->getRaw("permisos");

//include_component("falabellaAdu2", "gridDetControl");
?>
<script>
    
    var botones=new Array();
    var consinternografica=0;

    
    
    Ext.define('GridConsCabControl',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: false,
        title: 'Archivos de Control',
        store: Ext.create('Ext.data.Store', {
            fields: [
                { name: 'sel' },
                { name: 'ca_id_fal_cab_control', mapping: 'c_ca_id_fal_cab_control' },
                { name: 'ca_file'              , mapping: 'c_ca_file'},
                { name: 'ca_hoja'              , mapping: 'c_ca_hoja'},
                { name: 'ca_muelle'            , mapping: 'c_ca_muelle'},
                { name: 'ca_fecha'             , mapping: 'c_ca_fecha'},
                { name: 'ca_transporte'             , mapping: 'c_ca_transporte'},
                { name: 'ca_usucreado'         , mapping: 'c_ca_usucreado'},
                { name: 'ca_fchcreado'         , mapping: 'c_ca_fchcreado'},
                { name: 'ca_usuactualizado'    , mapping: 'c_ca_usuactualizado'},
                { name: 'ca_fchactualizado'    , mapping: 'c_ca_fchactualizado'}
            ],
            autoLoad:true,
            remoteSort: false,
            proxy: {
                type: 'ajax',
                url: '/falabellaAdu2/consultaCabControl',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            }
        }),
        columns: [
            {xtype : 'checkcolumn', text : '', dataIndex : 'sel',width:30 },
            {text: "Transporte",       dataIndex: 'ca_transporte',           sortable: true},
            {text: "Archivo",       dataIndex: 'ca_file',           sortable: true},
            {text: "Hoja",          dataIndex: 'ca_hoja',           sortable: true, width:300},
            {text: "Muelle",        dataIndex: 'ca_muelle',         sortable: true},
            {text: "Fecha",         dataIndex: 'ca_fecha',          sortable: true},
            {text: "Creacion",      dataIndex: 'ca_usucreado',      sortable: true},            
            {text: "Fecha Creacion",dataIndex: 'ca_fchcreado',      sortable: true},
            {text: "Actualizacion", dataIndex: 'ca_fchactualizado', sortable: true},
            { header: "Opciones", width: 75, resizable: false, dataIndex: '',
	         renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                     //metaData.css = 'add';
                     return '<a href="javascript:opcion(1,\''+record.data.ca_id_fal_cab_control+'\',\''+record.data.ca_hoja+'\',\''+this.id+'\')"><img src="/images/fam/delete.png" width="16" title="Eliminar"></a>'+
                          '<a href="javascript:opcion(2,\''+record.data.ca_id_fal_cab_control+'\',\''+record.data.ca_hoja+'\',\''+this.id+'\')"><img src="/images/fam/table_go.png" width=16 title="Ver Datos"></a>';
	             return '';
	         }
	     }
        ],
        tbar: botones,        
        autoScroll:true        
        
    });


var tgrafica = Ext.create('Ext.data.Store', {
    fields: ['id', 'name'],
    data : [
        {'id':'1','name':'Pie'},
        {'id':'2','name':'Barras'}
    ]
});



function panelGraficas(id)
{
    return {
                    xtype:'panel',
                    bodyPadding: 5,
                    layout:'form',
                    title: 'Grafica',
                    id:'panel-graficas-'+id,
                    items: [
                        {
                            xtype:'form',
                            title:'Filtros',
                            layout:'table',
                            id:'form-graficas-'+id,
                            defaults: {
                                //anchor: '100%'
                                //columnWidth: 1/6,
                                labelAlign:'right',
                                labelWidth:150

                            },
                            items:[
                                {
                                    xtype:'combo',
                                    fieldLabel: 'Tipo Grafica',
                                    store: tgrafica,
                                    queryMode: 'local',
                                    displayField: 'name',
                                    valueField: 'id',
                                    id:'tgrafica'+id,
                                    name:'tgrafica'+id,
                                    listeners:{
                                        select:function( combo, record, eOpts )
                                        {
                                            var form = this.up('form').getForm();
                                            switch(combo.getValue())
                                            {
                                                case "1":
                                                    form.findField("campo1"+id).hide();
                                                break;
                                                case "2":
                                                    form.findField("campo1"+id).show();
                                                break;
                                            }
                                        }
                                    }
                                },
                                {
                                    xtype:'combo',
                                    fieldLabel: 'Variable independiente',
                                    id:'campo'+id,
                                    name:'campo'+id,
                                    store: states,
                                    queryMode: 'local',
                                    displayField: 'name',
                                    valueField: 'id',
                                    listeners:{
                                        select:function( combo, record, eOpts )
                                        {
                                            //console.log(combo);
                                            //campo=combo
                                            /*var d=combo.getStore().getAt(combo.getStore().find(combo.valueField, combo.getValue())).get('tipo');
                                            if(d=="date")
                                            {
                                                var form = this.up('form').getForm();
                                                form.findField("agrupamiento"+id).enable();
                                            }*/
                                        }
                                    }
                                },
                                /*{
                                    //xtype:'combo',
                                    xtype:'hidden',
                                    fieldLabel: 'Agrupamiento',
                                    id:'agrupamiento'+id,
                                    name:'agrupamiento'+id,
                                    store: Ext.create('Ext.data.Store', {
                                        fields: ['id', 'name'],
                                        data : [
                                            {'id':'1','name':'Dia'},
                                            {'id':'2','name':'Mes'},
                                            {'id':'3','name':'Año'}
                                        ]
                                    }),
                                    queryMode: 'local',
                                    displayField: 'name',
                                    valueField: 'id',
                                    disabled:true//,
                                    //hide:true
                                }*/,
                                {
                                    xtype:'combo',
                                    fieldLabel: 'Variable Dependiente',
                                    id:'campo1'+id,
                                    name:'campo1'+id,
                                    store: states,
                                    queryMode: 'local',
                                    displayField: 'name',
                                    valueField: 'id'//,
                                    //hide:true
                                },
                                {
                                    xtype:'combo',
                                    //xtype:'hidden',
                                    fieldLabel: 'Agrupamiento',
                                    id:'agrupamiento'+id,
                                    name:'agrupamiento'+id,
                                    store: states,
                                    queryMode: 'local',
                                    displayField: 'name',
                                    valueField: 'id'//,
                                    //disabled:true//,
                                    //hide:true
                                }
                            ],
                            buttons: [{
                                text: 'Buscar',
                                handler: function() {
                                    var form = this.up('form').getForm();                                    
                                    var tgrafica=form.findField("tgrafica"+id).getValue();
                                    
                                    campo=form.findField("campo"+id);
                                    agrupamiento=form.findField("agrupamiento"+id);
                                    campo1=form.findField("campo1"+id);
                                    var titulo=campo.getStore().getAt(campo.getStore().find(campo.valueField, campo.getValue())).get(campo.displayField);
                                    
                                    var storeGrafica=Ext.getCmp('grid-det-control'+id).getStore();
                                    var records=storeGrafica.getRange();
                                    var variable="c_"+campo.getValue();
                                    var variabled="c_"+campo1.getValue();
                                    
                                    var res = [];
                                    var indicador=[];
                                    var indicadord=[];
                                    var valores=[];
                                    var series=[];
                                    var fields=['tipo'];
                                    if(tgrafica==1)
                                    {
                                        for(i=0;i<records.length;i++)
                                        {
                                            eval("d=records[i].data."+variable+";");
                                            if(d==false)
                                                d="No";
                                            else if(d==true)
                                                d="Si";
                                             index=indicador.lastIndexOf(d);
                                             if(!indicador[index])
                                             {
                                                 indicador.push(d);
                                                 valores.push(1);
                                             }
                                             else
                                             {
                                                 valores[index]++;
                                             }
                                        }
                                        for(i=0;i<indicador.length;i++)
                                        {
                                            res.push({"indicador":indicador[i],"total":valores[i]})
                                        }
                                    }else if(tgrafica==2)
                                    {
                                        titulo+=' vs '+campo1.getStore().getAt(campo1.getStore().find(campo1.valueField, campo1.getValue())).get(campo1.displayField);
                                        var indices_agrupamiento=new Array();
                                        for(i=0;i<records.length;i++)
                                        {
                                            eval("ind=records[i].data."+variable+";");
                                            eval("dep=records[i].data."+variabled+";");
                                            
                                            if(agrupamiento.getValue()!="")
                                                eval("agr=records[i].data."+agrupamiento.getValue()+";");
                                            else
                                                agr="";
                                            //console.log(agr);
                                            if(ind==false)
                                                ind="No";
                                            else if(ind==true)
                                                ind="Si";
                                            
                                            if(dep==false)
                                                dep="No";
                                            else if(dep==true)
                                                dep="Si";

                                            encontro =false;
                                            
                                            for(j=0;j<indicador.length;j++)
                                            {
                                                if(indicador[j].ind==ind)
                                                {
                                                    encontrodep =false;
                                                    for(k=0;k<indicador[j].dep.length;k++)
                                                    {
                                                        if(indicador[j].dep[k].name==dep)
                                                        {
                                                            if(agr!="")
                                                            {
                                                                if( jQuery.inArray( agr, indices_agrupamiento ) < 0 )
                                                                {
                                                                    indicador[j].dep[k].total++;
                                                                    indices_agrupamiento.push(agr);
                                                                    break;
                                                                    
                                                                }
                                                                else
                                                                    break;
                                                            }
                                                            encontrodep = true;
                                                            
                                                            
                                                        }
                                                    }
                                                    if(!encontrodep)
                                                    {
                                                        //alert(dep);
                                                        indicador[j].dep.push({'name':dep,'total':1});
                                                        
                                                        var encontroserie=false;
                                                        for(s=0;s<series.length;s++)
                                                        {
                                                            if(series[s].name==dep)
                                                            {   
                                                                encontroserie=true;
                                                                break;
                                                            }
                                                        }
                                                        
                                                        if(!encontroserie)
                                                        {
                                                            series.push({
                                                                type : 'column',
                                                                dataIndex : dep,
                                                                name : dep
                                                            });
                                                            fields.push(dep);
                                                        }
                                                    }
                                                    encontro = true;
                                                    break;
                                                }
                                            }
                                            if(!encontro)
                                            {
                                                indicador.push({
                                                    'ind':ind,
                                                    'dep':[{'name':dep,'total':1}]
                                                });
                                                var encontroserie=false;
                                                for(s=0;s<series.length;s++)
                                                {
                                                    if(series[s].name==dep)
                                                    {   
                                                        encontroserie=true;
                                                        break;
                                                    }
                                                }
                                                if(!encontroserie)
                                                {
                                                    series.push({
                                                        type : 'column',
                                                        dataIndex : dep,
                                                        name : dep
                                                    });
                                                    fields.push(dep);
                                                }
                                                
                                            }
                                        }
                                        //console.log("dd");
                                        //console.log(indices_agrupamiento);
                                        for(i=0;i<indicador.length;i++)
                                        {
                                            inddep="";
                                            for(s=1;s<fields.length;s++)
                                            {
                                                var encontroserie=false;
                                                for(j=0;j<indicador[i].dep.length;j++)
                                                {
                                                    if(fields[s]==indicador[i].dep[j].name)
                                                    {
                                                        inddep+=',"'+ indicador[i].dep[j].name+'" : '+indicador[i].dep[j].total;
                                                        //alert(indicador[i].dep[j].name+'" : '+indicador[i].dep[j].total);
                                                        encontroserie=true;
                                                        break;
                                                    }
                                                }
                                                if(!encontroserie)
                                                {
                                                    inddep+=',"'+ fields[s]+'" : null';
                                                }
                                            }
                                            //alert(indicador[i].dep[j].name+'" : '+indicador[i].dep[j].total);
                                            eval('res.push({"tipo":indicador[i].ind'+ inddep +'} );');
                                        }
                                    }
                                    
                                    
                                    var config={"contconsulta":id+(consinternografica++),"titleGraph":"Grafica "+titulo};
                                    var graph=null;
                                    if(tgrafica==1)
                                        graph=grafica({id:'hcd'+config.contconsulta,title:((!config.titleGraph)?'Indicador':config.titleGraph),subtitle:((!config.subtitleGraph)?'Indicador':config.subtitleGraph),datos:JSON.stringify(res)});
                                    else if(tgrafica==2)
                                    {
                                        graph=graficaBarras({id:'hcd'+config.contconsulta,title:((!config.titleGraph)?'Indicador':config.titleGraph),subtitle:((!config.subtitleGraph)?'Indicador':config.subtitleGraph),datos:JSON.stringify(res),"fields":fields,"series":series });
                                    }
                                    Ext.getCmp('panel-grafica-'+id).add(                                            
                                        
                                            Ext.create('Ext.panel.Panel',{
                                                title: 'Grafica',
                                                id:"grafica11"+config.contconsulta,
                                                autoScroll: true,
                                                fixed:true,
                                                overflowY :'scroll',
                                                layout: 'column',
                                                tools: [{
                                                    type: 'close',
                                                    callback: function(panel) {
                                                        panel.close();
                                                    }
                                                }],
                                                defaults: {                                                    
                                                    columnWidth: 1/2                            
                                                },                                                
                                                items: [
                                                    graph
                                                ]
                                            })
                                    );
                                }
                            }]
                        },
                        {
                            xtype:'panel',                            
                            id:'panel-grafica-'+id,
                            items:[                                
                            ]
                        }
                    ]
                }
}
                

 function opcion(tipo,id,hoja,idg)
 {

    if(tipo==1)
    {
    
        Ext.MessageBox.confirm('Confirm', 'Esta seguro de eliminar el archivo '+hoja+'?', 
        function showResult(btn){
            if(btn=="yes")
            {
                
                var box = Ext.MessageBox.wait('Procesando', 'Eliminando Archivo')
                Ext.Ajax.request(
                {
                    waitMsg: 'Enviando...',
                    url: '/falabellaAdu2/eliminarCabControl',
                    params :	{       
                        "id": id
                    },
                    failure:function(response,options){
                        alert( response.toSource()  );
                        //Ext.Msg.hide();
                        success = false;
                        alert("Surgio un problema");
                        box.hide();
                    },
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );

                        if( res.success ){
                            Ext.getCmp(idg).getStore().reload();
                        }
                        else
                        {
                            Ext.MessageBox.alert("Mensaje de Error", res.errorInfo);
                        }
                        //store.reload();
                        box.hide();
                    }
                });
            }
            //Ext.getCmp(idg).getStore().reload();
                
        });
            
    }
    if(tipo==2)
    {
    
    
        var tabpanel=Ext.getCmp("tab-panel-id");
        obj=[
            {
                xtype: 'tabpanel',
                id:'tab-panel-id-indicadores'+id,
                activeTab: 0,            
                items: [
                    //new GridDetControl({'id':'grid-det-control'+id,'name':'grid-det-control'+id, 'idcabcontrol':id,'iditem':id,title: 'Datos'}),
                    { xtype:'Colsys.FalabellaAdu.GridDetControl','id':'grid-det-control'+id,'name':'grid-det-control'+id, 'idcabcontrol':id,'iditem':id,title: 'Datos'},
                    panelGraficas(id)
                ]
            }
        ]

        tabpanel.add(
        {
            title: hoja,
            id:'tab'+id,
            itemId:'tab'+id,
            closable :true,
            autoScroll:true,
            items: [
            {
                autoScroll:true,
                items:[
                    Ext.create('Ext.panel.Panel', {
                    title: 'Datos Cuadro Control',    
                        bodyPadding: 10,
                        //width: 350,
                        autoScroll:true,
                        id:'tab-form'+id,
                        items: obj
                    })
                ]
            }
            ]
        }).show();
        tabpanel.setActiveTab('tab'+id);    
    }
 }
</script>