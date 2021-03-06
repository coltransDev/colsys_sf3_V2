<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">

    PanelTiposComprobante = function( config ){

        Ext.apply(this, config);


        this.columns = [{
                header: 'Tipo',
                dataIndex: 'tipo',
                width: 150,                
                hideable: false
            },{
                header: 'Comprobante',
                width: 230,
                dataIndex: 'comprobante',                
                hideable: false
            },
            {
                header: 'Titulo',
                width: 150,
                dataIndex: 'titulo',                
                hideable: false
                  
            },
            {
                header: 'Descripción',
                width: 150,
                dataIndex: 'descripcion',
                hideable: false
            }
        ],

        this.record = Ext.data.Record.create([
            {name: 'idtipo', type: 'int'},
            {name: 'tipo', type: 'string'},
            {name: 'comprobante', type: 'string'},
            {name: 'descripcion', type: 'string'},           
            {name: 'titulo', type: 'string'}
        ]);

        this.store = new Ext.data.Store({
            autoLoad : true,
            url: '<?=url_for("inoparametros/datosPanelTiposComprobante")?>',
            reader: new Ext.data.JsonReader(
                {
                    root: 'root',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                this.record
            ),
            sortInfo:{field: 'tipo', direction: "ASC"}
        });


        this.tbar = [
            {
                text:'Nuevo',
                iconCls: 'add',
                scope:this,
                handler: this.nuevo
            },
            {
                text:'Recargar',
                iconCls: 'refresh',
                scope:this,
                handler: this.recargar
            }
        ]


        PanelTiposComprobante.superclass.constructor.call(this, {
            view: new Ext.grid.GridView({
                forceFit:true,
                enableRowBody:true,
                enableGroupingMenu: false,
                startCollapsed : true
                
            }),
            loadMask: {msg:'Cargando...'},
            listeners:{
                rowdblclick : this.onRowDblclick
            }
        });
    
    };

    Ext.extend(PanelTiposComprobante, Ext.grid.GridPanel, {

        nuevo: function(){

            this.win = new EditarTiposComprobanteWindow({gridId: this.id});
            this.win.show();

        },

        recargar: function(){
            this.store.reload();
        },
        onRowDblclick: function( grid , rowIndex, e ){
            
            record =  this.store.getAt( rowIndex );
            this.win = new EditarTiposComprobanteWindow({idtipo: record.data.idtipo,
                                                         gridId: this.id});
            this.win.show();
            
        }

   
    });


</script>