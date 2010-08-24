<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">
EditarTareaAsignacionesPanel = function( config ) {
    Ext.apply(this, config);
    
    this.columns = [
      {
        header: "Login",
        dataIndex: 'login',
        hideable: false,
        sortable:false
      },
      {
        header: "Usuario",
        dataIndex: 'nombre',
        hideable: false,
        sortable:false
      },
      {
        header: "Sucursal",
        dataIndex: 'idsucursal',
        hideable: false,
        sortable:false
      }
    ];

    this.record = Ext.data.Record.create([            
            {name: 'login', type: 'string', mapping: 'u_ca_login'},
            {name: 'nombre', type: 'string', mapping: 'u_ca_nombre'},
            {name: 'idsucursal', type: 'string', mapping: 'u_ca_idsucursal'},
            {name: 'orden', type: 'string'}
    ]);

    this.store = new Ext.data.Store({

        autoLoad : true,
        url: '<?=url_for("tasks/datosPanelTareaAsignaciones")?>',
        baseParams: {
            idtarea: this.idtarea
        },
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'totalCount'
            },
            this.record
        ),
        sortInfo:{field: 'orden', direction: "ASC"}
    });
    
    EditarTareaAsignacionesPanel.superclass.constructor.call(this, {
        title: 'Asignaciones',
        //id: 'asignar-milestone-win',
        autoHeight: true,        
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 2,
        view: new Ext.grid.GridView({
            forceFit:true
        })
        
        
    });

    this.addEvents({add:true});
}

Ext.extend(EditarTareaAsignacionesPanel, Ext.grid.GridPanel, {


    
});

</script>