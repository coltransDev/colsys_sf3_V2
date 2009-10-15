<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
new Ext.form.ComboBox({
        <?
        if( isset($id) ){
        ?>
        id: '<?=$id?>',
        <?
        }
        ?>
        fieldLabel: 'Moneda',
        typeAhead: true,
        triggerAction: 'all',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : [
        <?
        $i=0;
        foreach( $monedas as $moneda ){
            if($i++!=0){
                echo ",";
            }
            echo "['".$moneda->getCaIdmoneda()."','".$moneda->getCaIdmoneda()."']";
        }
        ?>
        ]})