<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$cuentas = $sf_data->getRaw("cuentas");
?>

<script type="text/javascript">

    WidgetCuentaContable = function( config ){
        Ext.apply(this, config);
        
        
        this.dataCuentas = <?=json_encode(array("root"=>$cuentas))?>;
        
        this.store = new Ext.data.Store({
            autoLoad : true,
            proxy: new Ext.data.MemoryProxy( this.dataCuentas ),
            reader: new Ext.data.JsonReader(
                {
                    root: 'root',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'idcuenta',  mapping: 'ca_idcuenta'},
                    {name: 'cuenta',  mapping: 'ca_cuenta'},
                    {name: 'descripcion',  mapping: 'ca_descripcion'}
                ])
            )
        });
        
        this.resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{cuenta}</b><br /><span>{descripcion}</span> </div></tpl>'
        );

        WidgetCuentaContable.superclass.constructor.call(this, {            
            triggerAction: 'all',            
            mode: 'local',
            displayField: 'cuenta',
            valueField: 'idcuenta',
            lazyRender:true,
            listClass: 'x-combo-list-small',
            tpl: this.resultTpl,
            itemSelector: 'div.search-item'       
        });
    };

    Ext.extend(WidgetCuentaContable, Ext.form.ComboBox, {
    
        
    });

</script>