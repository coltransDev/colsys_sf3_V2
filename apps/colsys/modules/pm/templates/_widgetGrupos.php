<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
WidgetGrupos = function( config ){
    Ext.apply(this, config);
    

    WidgetGrupos.superclass.constructor.call(this, {
        fieldLabel: 'Grupo',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'Seleccione',
        selectOnFocus: true,

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
                foreach( $grupos as $grupo ) {
                    if($i++!=0) {
                        echo ",";
                    }
                    ?>
                    ['<?=$grupo->getCaIdgroup()?>', '<?=$grupo->getCaName()?>']
                    <?
                }
                ?>
            ]
        })
    });
};
Ext.extend(WidgetGrupos, Ext.form.ComboBox, {
   
});
</script>