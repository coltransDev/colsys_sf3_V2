<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$unidades = $sf_data->getRaw("unidades");

?>



<script type="text/javascript">


WidgetUnidades = function( config ){
    Ext.apply(this, config);
    
    this.store = [
        <?
            $i=0;
            foreach($unidades as $unidad){
                if($i++!=0){
                    echo ",";
                }
                echo "[\"".$unidad->getCaValor2()."\",\"".$unidad->getCaValor()."\"]";
            }
        ?>
        ];    

    WidgetUnidades.superclass.constructor.call(this, {
        valorField: 'valor',
        displayField: 'valor',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        //emptyText:'',
        selectOnFocus: true,        
        lazyRender:true,
        mode: 'local',
        submitValue: true,
        listClass: 'x-combo-list-small'        
    });
};


Ext.extend(WidgetUnidades, Ext.form.ComboBox, {

});

	
</script>  