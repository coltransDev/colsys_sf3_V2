<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">

    PanelCuentas = function( config ){

        Ext.apply(this, config);


        this.columns = [{
                header: 'Cuenta',
                dataIndex: 'cuenta',
                width: 150,
                sorteable: false,
                hideable: false
            },{
                header: 'Descripción',
                width: 230,
                dataIndex: 'descripcion',
                sorteable: false,
                hideable: false
            },{
                header: 'Naturaleza',
                width: 150,
                dataIndex: 'naturaleza',
                sorteable: false,
                hideable: false
            },
            {
                header: 'Grupo',
                width: 150,
                dataIndex: 'grupo',
                sorteable: false,
                hideable: false,
                hidden: true                
            }

        ],

        this.record = Ext.data.Record.create([
            {name: 'idcuenta', type: 'int'},
            {name: 'cuenta', type: 'string'},
            {name: 'descripcion', type: 'string'},
            {name: 'naturaleza', type: 'string'},
            {name: 'grupo', type: 'string'}
        ]);

        this.store = new Ext.data.GroupingStore({
            autoLoad : true,
            url: '<?=url_for("inoparametros/datosPanelCuentas")?>',
            reader: new Ext.data.JsonReader(
                {
                    root: 'root',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                this.record
            ),
            sortInfo:{field: 'cuenta', direction: "ASC"},
            groupField: 'grupo'
        });

    
        PanelCuentas.superclass.constructor.call(this, {            
            view: new Ext.grid.GroupingView({
                forceFit:true,
                enableRowBody:true,
                enableGroupingMenu: false,
                startCollapsed : true
            }),
            loadMask: {msg:'Cargando...'}
        });
    
    };

    Ext.extend(PanelCuentas, Ext.grid.GridPanel, {

   
    });


</script>