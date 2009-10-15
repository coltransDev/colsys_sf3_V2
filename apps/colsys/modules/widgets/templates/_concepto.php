<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



$transporte_val = ((strpos($transporte, 'Ext.getCmp') === false)?"'".$transporte."'":$transporte.".getValue()");
$modalidad_val = ((strpos($modalidad, 'Ext.getCmp') === false)?"'".$modalidad."'":$modalidad.".getValue()");

if (!is_null($modalidad)) {
    $listeners = "listeners:{focus:function( field, newVal, oldVal ){
                            concepto = Ext.getCmp('$id');
                            concepto.store.baseParams = {transporte:$transporte_val,modalidad:$modalidad_val};
                            concepto.store.reload();
                      }
                 },";
}else{
    $listeners = "";
}

$baseparams = "baseParams:{transporte:$transporte_val,modalidad:$modalidad_val}";

?>

new Ext.form.ComboBox({
		fieldLabel: '<?=ucfirst($id)?>',
		typeAhead: true,
		forceSelection: true,
		triggerAction: 'all',
		emptyText:'',
		selectOnFocus: true,
		hiddenName:'id<?=$id?>',
		id: '<?=$id?>',
		displayField: 'concepto',
		valueField: 'idconcepto',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		<?=$listeners?>
		store : new Ext.data.Store({
			autoLoad : false,
			url: '<?=url_for("widgets/datosConceptos")?>',
			reader: new Ext.data.JsonReader(
				{
					id: 'idconcepto',
					root: 'root',
					totalProperty: 'total',
					successProperty: 'success'
				},
				Ext.data.Record.create([
					{name: 'idconcepto'},
					{name: 'concepto'}
				])
			),
			<?=$baseparams?>
		})
	})
