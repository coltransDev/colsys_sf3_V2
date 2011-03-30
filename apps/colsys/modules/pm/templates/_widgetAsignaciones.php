<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
WidgetAsignaciones = function( config ){
    Ext.apply(this, config);
    

    WidgetAsignaciones.superclass.constructor.call(this, {
        fieldLabel: 'Asignado a',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        value: '',
        width:120,
        
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
};
Ext.extend(WidgetAsignaciones, Ext.form.ComboBox, {
   
});
</script>