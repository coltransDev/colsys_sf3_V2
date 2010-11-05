<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
    ListaFiltrosGridPanel = function( config ) {
        Ext.apply(this, config);

       

        this.columns = [      
       
          {
            header: "Campo",
            dataIndex: 'nombre',
            hideable: false,           
            sortable: true,
            renderer: this.formatItem

          },
          {
            header: "Operador",
            dataIndex: 'operador',
            hideable: false,
            sortable: false,
            editor: new Ext.form.ComboBox({
                typeAhead: true,
                forceSelection: true,
                triggerAction: 'all',
                selectOnFocus: true,
                listClass: 'x-combo-list-small',
                mode: 'local',
                store :  [['=','='], ['>', '>'], ['>=', '>='], ['<', '<'], ['<=', '<='], ['LIKE', 'COMO']]

            })
          },
          {
            header: "Filtro",
            dataIndex: 'filtro',
            hideable: false,
            sortable: false,
            editor: new Ext.form.TextField()
          }
        ];

        this.record = Ext.data.Record.create([
            {name: 'sel', type: 'bool'},
            {name: 'campo', type: 'string', mapping: 'c_ca_campo'},
            {name: 'nombre', type: 'string', mapping: 'c_ca_nombre'}
        ]);

        var idinforme = this.idinforme;
        
        this.store = new Ext.data.GroupingStore({

            autoLoad : true,
            url: '<?=url_for("reportesGer/listadoFiltros")?>',
            baseParams : {
                idinforme: idinforme
            },
            reader: new Ext.data.JsonReader(
                {
                    root: 'root',
                    totalProperty: 'total'
                },
                this.record
            ),
            sortInfo:{field: 'campo', direction: "ASC"}
            //groupOnSort: true,
            //groupField: 'action'


        });
        
        ListaFiltrosGridPanel.superclass.constructor.call(this, {
            
           loadMask: {msg:'Cargando...'},
           //boxMinHeight: 300,
           title: "Listado de Filtros",           
           view: new Ext.grid.GroupingView({
                forceFit:true,
                enableRowBody:true,
                hideGroupedColumn: true
           }),
           listeners:{

           }
        });
    }

    Ext.extend(ListaFiltrosGridPanel, Ext.grid.EditorGridPanel, {
        formatItem: function(value, p, record) {

            return String.format(
                '<b>{0}</b>',
                value
            );
        }
    });

</script>