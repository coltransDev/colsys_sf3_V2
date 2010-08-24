<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">
EditarTareaAlarmasPanel = function( config ) {
    Ext.apply(this, config);
    
    this.columns = [
      {
        header: "Cuando",
        dataIndex: 'login',
        hideable: false,
        sortable:false
      },
      {
        header: "Fecha",
        dataIndex: 'nombre',
        hideable: false,
        sortable:false
      },
      {
        header: "Hora",
        dataIndex: 'idsucursal',
        hideable: false,
        sortable:false
      },
      {
        header: "Tipo",
        dataIndex: 'idsucursal',
        hideable: false,
        sortable:false
      },
      {
        header: "e-mail",
        dataIndex: 'email',
        hideable: false,
        sortable:false
      }
    ];

    this.record = Ext.data.Record.create([            
            {name: 'idalarma', type: 'string', mapping: 'u_ca_login'},
            {name: 'nombre', type: 'string', mapping: 'u_ca_nombre'},
            {name: 'idsucursal', type: 'string', mapping: 'u_ca_idsucursal'},
            {name: 'orden', type: 'string'}
    ]);

    this.store = new Ext.data.Store({

        autoLoad : true,
        url: '<?=url_for("tasks/datosPanelTareaAlarmas")?>',
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
    
    EditarTareaAlarmasPanel.superclass.constructor.call(this, {
        title: 'Alarmas',
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

Ext.extend(EditarTareaAlarmasPanel, Ext.grid.GridPanel, {


    
});

</script>