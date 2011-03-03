<div align="center" >
<br />
<h3> Reporte de IDG Dpto. Sistemas </h3>
<br />
<br />
</div>
<div align="center" id="container"></div
<?
if( $idgsistemas){
?>
<table width="75%" border="1" class="tableList" align="center">
    <tr>
        <th colspan="12" style="text-align: center"><b>IDG Usuarios atendidos a tiempo&nbsp;<?=date('Y-m-d')?></b></th>
    </tr>
    <tr>
        <th scope="col">Mes</th>
        <th scope="col">No. Ticket</th>
        <th scope="col">Titulo</th>
        <th scope="col">Usuario Asignado</th>
        <th scope="col">Fecha Creado</th>
        <th scope="col">Hora Creado</th>
        <th scope="col">Fecha Respuesta</th>
        <th scope="col">Hora Respuesta</th>
        <th scope="col" style="width: 110px" >Grupo</th>
        <th scope="col">Reportado por</th>
        <th scope="col">C&aacute;lculo IDG</th>
        <th scope="col">Observaciones</th>

    </tr>
    <?
    $array = array();
    $cuantos_lcs = 0;
    $cuantos_lci = 0;
    foreach( $idgsistemas as  $idgsistema)
    {
        $group = $idgsistema["ca_name"];

        $festivos = TimeUtils::getFestivos();
        list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($idgsistema["ca_fchcreado"], "%d-%d-%d %d:%d:%d");
        $inicio = mktime($hor, $min, $seg, $mes, $dia, $ano);
        list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($idgsistema["ca_fchterminada"], "%d-%d-%d %d:%d:%d");
        $final = mktime($hor, $min, $seg, $mes, $dia, $ano);
        $calculoidg_seg = TimeUtils::calcDiff( $festivos, $inicio , $final );
        
        if ($idgsistema["ca_fchterminada"]==""){
            $calculoidg_seg = '28800';
        }elseif($calculoidg_seg==0){
            $calculoidg_seg = '60';
        }

        $calculoidg_hms = TimeUtils::tiempoSegundos($calculoidg_seg);

        if($calculoidg_hms>$lcs){
            $array_lcs[] = $calculoidg_seg;
            $cuantos_lcs = count($array_lcs);
        }elseif($calculoidg_hms<$lci){
            $array_lci[] = $calculoidg_seg;
            $cuantos_lci = count($array_lci);
        }

        $array[] = $calculoidg_seg;
        $cuantos=count($array);

    ?>
        <tr>
        <td><?=$idgsistema["mes"]?></td>
        <td><a href="https://www.coltrans.com.co<?=url_for("helpdesk/verTicket?id=".$idgsistema["ca_idticket"])?>"><?=$idgsistema["ca_idticket"]?></a></td>
        <td><?=$idgsistema["ca_title"]?></td>
        <td><?=$idgsistema["ca_assignedto"]?></td>
        <td><?=$idgsistema["fechacreado"]?></td>
        <td><?=$idgsistema["horacreado"]?></td>
        <td><?=$idgsistema["fechaterminada"]?></td>
        <td><?=$idgsistema["horaterminada"]?></td>
        <td ><?=$idgsistema["ca_name"]?></td>
        <td><?=$idgsistema["ca_login"]?></td>
        <td><?if($calculoidg_hms>$lcs){?> <font color="red"><?echo $calculoidg_hms;?></font><?}elseif($calculoidg_hms<$lci){?><font color="orange"><?echo $calculoidg_hms;?></font><?}else{echo $calculoidg_hms;}?></td>
        <td><?=$idgsistema["ca_observaciones"]?></td>

    </tr>
<?
    }
    //print_r($array);
    $promedio_seg = TimeUtils::array_avg($array);
    $promedio_hms = TimeUtils::tiempoSegundos($promedio_seg);
    $porcentaje_lcs = @round($cuantos_lcs*100/$cuantos,2);
    $porcentaje_lci = round($cuantos_lci*100/$cuantos,2);
?>
</table>
<br />
<table class="tableList" align="center" width="30%">
    <tr>
        <th colspan="4" style="text-align: center"><b>INDICADOR DE GESTION DPTO. DE SISTEMAS</b></th>
    </tr>
    <tr>
        <th colspan="1"><b>Indicador:</b></th>
        <td colspan="3">Usuarios atendidos a tiempo</td>
    </tr>
    <tr>
        <th colspan="1"><b>Periodo:</b></th>
        <td colspan="3"><b><?=$fechaInicial?></b> al <b><?=$fechaFinal?></b></td>
    </tr>
    <tr>
        <th colspan="1"><b>Grupo:</b></th>
        <td colspan="3"><?=$group?></td>
    </tr>
    <tr>
        <th><b>Producto NO Conforme:</b></th>
        <th>No. Casos&nbsp;<?=$cuantos_lcs?></th>
        <th>LCs:&nbsp;<?=$lcs?></th>
        <td><font color="red"><b><?=$porcentaje_lcs?>%</b></font></td>
    </tr>
    <tr>
        <th><b>Promedio Ponderado:</b></th>
        <th>No. Casos&nbsp;<?=$cuantos?></th>
        <th>LC:&nbsp;<?=$lc?></th>
        <td><b><?=$promedio_hms?></b></td>
    </tr>
    <tr>
        <th><b>Registros inferiores a lci:</b></th>
        <th>No. Casos&nbsp;<?=$cuantos_lci?></th>
        <th>LCi:&nbsp;<?=$lci?></th>
        <td><font color="orange"><b><?=$porcentaje_lci?>%</b></font></td>
    </tr>
</table>
    
<?
}
?>
<script language="javascript">
    asignaciones = new Ext.form.ComboBox({
            fieldLabel: 'Asignado a',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            width:120,
            id: 'usuario',
            name: 'usuario',
            lazyRender:true,
            allowBlank: true,
            displayField: 'login',
            valueField: 'login',
            hiddenName: 'login',
            listClass: 'x-combo-list-small',
            mode: 'local',
            store : new Ext.data.Store({
                autoLoad : true ,
                url: '<?=url_for("pm/datosAsignaciones")?>',
                reader: new Ext.data.JsonReader(
                {
                    id: 'login',
                    root: 'usuarios',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'login'}

                ])
            )
            })
        });

   
var tabs = new Ext.FormPanel({
	labelWidth: 75,
	border:true,
	fame:true,
	width: 650,    
	standardSubmit: true,  
        id: 'formPanel',
	items: {
		xtype: 'tabpanel',
		activeTab: 0,
		defaults:{autoHeight:true, bodyStyle:'padding:10px'},
		id: 'tab-panel', 
		items:[{
			title:'Indicadores de Gestión',
			layout:'form',			
			defaultType: 'textfield',
			id: 'estadisticas',
            labelWidth: 75,
			items: [
                    {
                        xtype:'hidden',
                        name:"opcion",
                        value:"buscar"
                    },
                    {
                            xtype:'datefield',
                            fieldLabel: 'Fecha Inicial',
                            name : 'fechaInicial',
                            format: 'Y-m-d',
                            value: '<?=date("Y-m-")."01"?>'
                    },
                    {
                            xtype:'datefield',
                            fieldLabel: 'Fecha final',
                            name : 'fechaFinal',
                            format: 'Y-m-d',
                            value: '<?=date("Y-m-d")?>'
                    }
                    ,
                    {
                            xtype:'fieldset',
                            checkboxToggle:true,
                            title: 'Filtrar por Grupo',
                            autoHeight:true,
                            labelWidth: 75,
                            defaultType: 'textfield',
                            collapsed: true,
                            checkboxName: "checkboxGrupo",
                            items :[
                                    new Ext.form.ComboBox({
                                        fieldLabel: 'Grupo',
                                        typeAhead: true,
                                        forceSelection: true,
                                        triggerAction: 'all',
                                        emptyText:'Seleccione',
                                        selectOnFocus: true,
                                        name: 'grupo',
                                        id:'grupo',
                                        hiddenName: 'idgroup',
                                        width: 200,
                                        valueField:'idgroup',
                                        displayField:'name',
                                        mode: 'local',
                                        listClass: 'x-combo-list-small',
                                        store :  new Ext.data.SimpleStore({
                                                    fields: ['idgroup', 'name'],
                                                    data : [
                                                        <?
                                                        $i = 0;
                                                        foreach( $grupos as $grupo ){
                                                                if($i++!=0){
                                                                        echo ",";
                                                                }
                                                        ?>
                                                                ['<?=$grupo->getCaIdgroup()?>', '<?=$grupo->getCaName()?>']
                                                        <?
                                                        }
                                                        ?>
                                                     ]
                                                }),
                                                listeners:{
                                                    select:function(combo,record,index)
                                                    {
                                                        asignaciones.store.setBaseParam( "idgrupo",record.data.idgroup );
                                                        asignaciones.store.load();
                                                    }
                                                },
                                    })
                            ]
                    }
                    ,                    
                    {
                            xtype:'fieldset',
                            checkboxToggle:true,
                            title: 'Filtrar por Ingeniero Asignado',
                            autoHeight:true,
                            labelWidth: 75,
                            defaultType: 'textfield',
                            collapsed: true,
                            checkboxName: "checkboxUsuario",
                            items :[
                                asignaciones
                            ]
                    },
                    {
                            xtype:'fieldset',
                            checkboxToggle:true,
                            title: 'Límites de Control',
                            autoHeight:true,
                            width: 630,
                            layout:'column',
                            labelWidth: 0.1,
                            columns: 1,                            
                            collapsed: true,
                            checkboxName: "checkboxLimite",                            
                            defaults:{
                                xtype:'fieldset',
                                columnWidth:0.33,
                                layout:'form',
                                border:false                                
                            },
                            items:[{
                                    //columnWidth:.3,                                    
                                    items: [
                                        {
                                            xtype:'timefield',
                                            name: 'lcs',
                                            id: 'lcs',
                                            value: '',
                                            width: 95,
                                            format: 'H:i:s',
                                            fieldLabel: "  LCs"
                                        }
                                    ]
                            },
                            {                                   
                                    
                                    items: [
                                        {
                                            xtype:'timefield',
                                            name: 'lc',
                                            id: 'lc',
                                            value: '',
                                            width: 95,
                                            format: 'H:i:s',
                                            fieldLabel: " LC"
                                        }
                                    ]
                            },
                            {                             
                                    items: [
                                        {
                                            xtype:'timefield',
                                            name: 'lci',
                                            id: 'lci',
                                            value: '',
                                            width: 95,
                                            format: 'H:i:s',
                                            fieldLabel: "  LCi"
                                        }
                                    ]
                            }
                        ]
                    }
              ]
		}]
	},
	buttons: [
            {
                text: 'Continuar',
                handler: function(){
                            var tp = Ext.getCmp("tab-panel");

                            var owner=Ext.getCmp("formPanel");
                            if( tp.getActiveTab().getId()=="estadisticas"){
                                owner.getForm().getEl().dom.action='<?=url_for("helpdesk/reporteIdgSistemas")?>';
                            }
                            owner.getForm().submit();
                }
            }]
});
tabs.render("container");
/*
 //información a graficar
   var data = [
            ['1erTrim','02:21:57','01:00:00'],
            ['2doTrim','02:21:57','01:00:00'],
            ['3erTrim','02:09:44','01:00:00'],
            ['4toTrim','01:44:37','01:00:00']
   ];

Ext.onReady(function(){

    var store = new Ext.data.ArrayStore({
       fields:[
           {name:'trimestre'},
           {name:'limite_sup', type: 'date', dateFormat: 'H:i:s'},
           {name:'limite_ctr', type: 'date', dateFormat: 'H:i:s'},
           {name:'limite_inf', type: 'date', dateFormat: 'H:i:s'}
       ]
    });
    store.loadData(data); // se carga la info en el store


    new Ext.Panel({
        width: 700,
        height: 400,
        renderTo: document.body,
        title: 'Column Chart with Reload - Hits per Month',
        tbar: [{
            text: 'Load new data set'
            
        }],
        items: {
            xtype: 'linechart',
            store: store,
            xField: 'trimestre',
	    url: '/css/ext/charts.swf',
            xAxis: new Ext.chart.CategoryAxis({
                title: 'Año'

            }),
            yAxis: new Ext.chart.TimeAxis({
                title: 'Limites',
                labelRenderer: function(date) { return date.format('H:i:s')}

            }),
            series: [{
                yField: 'limite_sup',
                displayName: 'LCS'
            	},{
                type: 'line',
                yField: 'limite_ctr',
                displayName: 'LC'
	            },{
                type: 'line',
                yField: 'limite_inf',
                displayName: 'LCi'
	            }],
            extraStyle: {
               xAxis: {
                   labelRotation: -90
                },
                legend: {
                    display: 'right'
            	}
            }
        }
    });
});

*/

</script>
