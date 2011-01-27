<div align="center" >
<br />
<h3> Reporte de cotizaciones </h3>
<br />
<br />
</div>
<div align="center" id="container"></div>
<?
if( $cotizaciones)
{
?>
<div align="center">
<br>
<h3>Estadisticas de cotizaciones <?=$fechaInicial?> <?=$fechaFinal?> <br>
<?
if( $usuario ){
	echo "Vendedor: ".$usuario->getCaNombre();
}
if( $sucursal ){
	echo " Sucursal: ".$sucursal;
}
?>
</h3>
<br />
<br />
<h1>Cotizaciones </h1>
Datos basados en <?=count($cotizaciones)?> cotizaciones
<br />
</div>
<table width="450" border="1" class="tableList" align="center">
    <tr>
        <th scope="col">No. Cotizacion</th>
        <th scope="col">Vendedor</th>
        <th scope="col">Fecha Creado</th>
        <th scope="col">Usuario Envio</th>
        <th scope="col">Fecha Envio</th>
        <th scope="col">Etapa</th>
    </tr>
    <?
    foreach( $cotizaciones as  $cotizacion)
    {
?>
        <tr>
        <td><?=$cotizacion["ca_consecutivo"]?></td>
        <td><?=$cotizacion["ca_usucreado"]?></td>
        <td><?=$cotizacion["ca_fchcreado"]?></td>
        <td><?=$cotizacion["ca_usuenvio"]?></td>
        <td><?=$cotizacion["ca_fchenvio"]?></td>
        <td><?=($cotizacion["etapa"])?$cotizacion["etapa"]:$cotizacion["etapa1"]?></td>
    </tr>
<?
    }
    ?>
</table>
<?
}
?>
<script language="javascript">
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
			title:'Estadisticas',
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
				title: 'Filtrar por vendedor',
				autoHeight:true,
				labelWidth: 75,
				defaultType: 'textfield',
				collapsed: true,
				checkboxName: "checkboxVendedor", 
				items :[
                                    new Ext.form.ComboBox({
                                        fieldLabel: 'Vendedor',
                                        typeAhead: true,
                                        forceSelection: true,
                                        triggerAction: 'all',
                                        emptyText:'Seleccione',
                                        selectOnFocus: true,
                                        name: 'vendedor',
                                        hiddenName: 'login',
                                        width: 200,
                                        valueField:'login',
                                        displayField:'nombre',
                                        mode: 'local',
                                        listClass: 'x-combo-list-small',
                                        store :  new Ext.data.SimpleStore({
                                                    fields: ['login', 'nombre'],
                                                    data : [
                                                        <?
                                                        $i = 0;
                                                        foreach( $usuarios as $usuario ){
                                                                if($i++!=0){
                                                                        echo ",";
                                                                }
                                                        ?>
                                                                ['<?=$usuario->getCaLogin()?>', '<?=$usuario->getCaNombre()?>']
                                                        <?
                                                        }
                                                        ?>
                                                     ]
                                                })
                                    })
				]
                            }
                            ,
                            {
                                xtype:'fieldset',
                                checkboxToggle:true,
                                title: 'Filtrar por sucursal',
                                autoHeight:true,

                                defaultType: 'textfield',
                                collapsed: true,
                                checkboxName: "checkboxSucursal",
                                items :[
                                    new Ext.form.ComboBox({
                                        fieldLabel: 'Nombre',
                                        typeAhead: true,
                                        forceSelection: true,
                                        triggerAction: 'all',
                                        emptyText:'Seleccione',
                                        selectOnFocus: true,
                                        hiddenName: 'sucursal_est',
                                        width: 200,
                                        lazyRender:true,
                                        listClass: 'x-combo-list-small',
                                        store: [
                                            <?
                                            $i = 0;
                                            foreach( $sucursales as $sucursal ){
                                                    if($i++!=0){
                                                            echo ",";
                                                    }
                                            ?>
                                                    ['<?=$sucursal->getCaIdsucursal()?>', '<?=$sucursal->getCaNombre()?>']
                                            <?
                                            }
                                            ?>
                                        ]
                                    })
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
                        owner.getForm().getEl().dom.action='<?=url_for("cotizaciones/reporteCotizaciones")?>';
                    }
                    owner.getForm().submit();
            }
	}]
});
tabs.render("container");
</script>

