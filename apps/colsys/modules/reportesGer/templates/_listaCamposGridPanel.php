<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
    ListaCamposGridPanel = function( config ) {
        Ext.apply(this, config);

        this.checkColumn = new Ext.grid.CheckColumn({header:'&nbsp;', dataIndex:'sel', width:30, hideable: false});
        this.checkColumnAgrupar = new Ext.grid.CheckColumn({header:'Agrupar', dataIndex:'agrupar', width:30, hideable: false});

        this.columns = [
          //this.expander,
          this.checkColumn,
          {
            header: "Campo",
            dataIndex: 'nombre',
            hideable: false,            
            sortable: true,
            renderer: this.formatItem
          },
          this.checkColumnAgrupar,
          {
            header: "Función de Agregación",
            dataIndex: 'agregacion',
            hideable: false,
            sortable: false,
            editor: new Ext.form.ComboBox({
                typeAhead: true,
                forceSelection: true,
                triggerAction: 'all',
                selectOnFocus: true,
                listClass: 'x-combo-list-small',
                mode: 'local',
                store :  [['SUM','Suma'], ['AVG', 'Promedio']]

            })
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
            url: '<?=url_for("reportesGer/listadoCampos")?>',
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
        
        ListaCamposGridPanel.superclass.constructor.call(this, {
            
           loadMask: {msg:'Cargando...'},
           //boxMinHeight: 300,
           title: "Listado de Campos",
           plugins: [
                        this.checkColumn,
                        this.checkColumnAgrupar
                    ],
           view: new Ext.grid.GroupingView({
                forceFit:true,
                enableRowBody:true,
                hideGroupedColumn: true
           }),
           listeners:{

           }
        });
    }

    Ext.extend(ListaCamposGridPanel, Ext.grid.EditorGridPanel, {
        formatItem: function(value, p, record) {

            return String.format(
                '<b>{0}</b>',
                value
            );
        }
    });

</script>