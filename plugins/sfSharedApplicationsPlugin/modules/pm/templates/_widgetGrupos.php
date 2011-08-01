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
            displayField: 'nombre',
            valueField: 'idgrupo',
            mode: 'local',

            listClass: 'x-combo-list-small',
            store : new Ext.data.Store({
                autoLoad : false ,
                url: '<?= url_for("pm/datosAreas") ?>',
                reader: new Ext.data.JsonReader(
                {
                    id: 'idgrupo',
                    root: 'grupos',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'idgrupo'},
                    {name: 'nombre'}
                ])
            )
            }),
            listeners:{
                select: this.onSelectCombo
            }
        });
    };
    Ext.extend(WidgetGrupos, Ext.form.ComboBox, {
        onSelectCombo: function(combo,record,index){                 
            if( this.linkAsignaciones ){
                
                this.cargarDatos( record.data.idgrupo );
            }     
        },
        cargarDatos: function( idgroup ){
            Ext.getCmp(this.linkAsignaciones).setValue("");
            Ext.getCmp(this.linkAsignaciones).store.setBaseParam( "idgrupo", idgroup );
            Ext.getCmp(this.linkAsignaciones).store.load();
            
        }
        
        
    });
</script>