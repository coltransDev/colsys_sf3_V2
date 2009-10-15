<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
new Ext.form.ComboBox({
    fieldLabel: 'Transporte',
    typeAhead: true,
    width: 70,
    forceSelection: true,
    triggerAction: 'all',
    emptyText:'Seleccione',
    selectOnFocus: true,
    name: '<?=$id?>',
    id: '<?=$id?>',
    allowBlank: <?=$allowBlank?>,
    lazyRender:true,
    listClass: 'x-combo-list-small',
    store : [
    <?
	$i=0;
	foreach($transportes as $transporte){
		if($i++!=0){
			echo ",";
		}
		echo "['".$transporte->getCaValor()."','".$transporte->getCaValor()."']";
	}
    ?>
	 ]})