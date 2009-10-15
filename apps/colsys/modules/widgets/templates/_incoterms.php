<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>


new Ext.form.ComboBox({
                fieldLabel: 'Incoterms',
                typeAhead: true,
                forceSelection: true,
                triggerAction: 'all',
                emptyText:'',
                selectOnFocus: true,
                name: '<?=$id?>',
                id: '<?=$id?>',
                allowBlank: <?=$allowBlank?>,
                lazyRender:true,
                listClass: 'x-combo-list-small',
                store : [
<?
$i=0;
foreach($incoterms as $incoterm){
    if($i++!=0){
        echo  ",";
    }
    echo "['".$incoterm->getCaValor()."','".$incoterm->getCaValor()."']";
}
?>
]})
	
