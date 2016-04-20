<?
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">
    /**
     * PanelAgenda object definition
     **/

    PanelAgenda = function (config) {
        Ext.apply(this, config);

        this.columns = [
            {
                header: "Asignado a",
                dataIndex: 'assignedto',
                hideable: false,
                sortable: true,
                width: 80
            },
            {
                header: "Ticket #",
                dataIndex: 'idticket',
                width: 63,
                sortable: true,
                renderer: this.formatItem
            },
            {
                header: "Titulo",
                dataIndex: 'title',
                sortable: true,
                width: 280,
                summaryType: 'count',
                summaryRenderer: function (v, params, data) {
                    return ((v === 0 || v > 1) ? '(' + v + ' Tickets)' : '(1 Ticket)');
                }
            },
            {
                header: "Usuario",
                dataIndex: 'login',
                hideable: false,
                sortable: true,
                width: 80
            },
            {
                header: "Abierto",
                dataIndex: 'opened',
                hideable: false,
                width: 110,
                sortable: true,
                renderer: Ext.util.Format.dateRenderer('d/m/y H:i')
            },
            {
                header: "Etapa",
                dataIndex: 'stage',
                sortable: true,                
                width: 200,
                renderer : function (value){
                    str = '<div class="reply-text">'+value+'</div>';
                    return str;
                },
                editor: new Ext.form.TextField({
                    allowBlank: false
                })
            },
            {
                header: "Detalles",
                dataIndex: 'detail',                
                sortable: true,
                width: 400,
                renderer : function (value){
                    if(value)
                        str = '<div class="reply-text">'+value+'</div>';
                    else
                        str = '';
                    return str;
                },
                editor: new Ext.form.TextArea({
                    allowBlank: false
                })
            },
            {
                header: "Fch. Estimada Entrega",
                dataIndex: 'estimated',                
                sortable: true,                
                width: 130,                
                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                editor: new Ext.form.DateField({
                    format: 'Y-m-d',
                    allowBlank: false
                })
            },
            {
                header: "Fch. Entrega",
                dataIndex: 'delivery',                
                sortable: true,
                width: 130,
                editable: false,                
                renderer: Ext.util.Format.dateRenderer('Y-m-d H:i:s'),
                editor: new Ext.form.DateField({
                    format: 'Y-m-d H:i:s'
                })
            }
        ];

        this.record = Ext.data.Record.create([
            {name: 'sel', type: 'boolean'},
            {name: 'idticket', type: 'integer'},
            {name: 'title', type: 'string'},
            {name: 'login', type: 'string'},
            {name: 'assignedto', type: 'string'},
            {name: 'opened', type: 'date', dateFormat: 'Y-m-d H:i:s'},            
            {name: 'idstage', type: 'string'},
            {name: 'stage', type: 'string'},
            {name: 'detail', type: 'string'},
            {name: 'estimated', type: 'date', dateFormat: 'Y-m-d'},
            {name: 'delivery', type: 'date', dateFormat: 'Y-m-d H:i:s'}
        ]);
        
        this.store = new Ext.data.GroupingStore({
            autoLoad: true,
            url: '<?= url_for("pm/datosEntregasTicket") ?>',
            baseParams: {
                idgroup: this.idgroup                
            },
            reader: new Ext.data.JsonReader(
                    {
                        root: 'root',
                        totalProperty: 'total'
                    },
                    this.record
                    ),
            sortInfo: {field: 'estimated', direction: "ASC"},            
            groupField: 'assignedto'

        });
        
        this.tbar = [
                {
                    text: 'Recargar',
                    iconCls: 'refresh',
                    scope: this,
                    handler: this.recargar
                }
            ];
        
        this.tbar.push({
            text: 'Entregados',
            scope: this,
            iconCls: 'refresh',  // reference to our css            
            handler: function(btn , e){
                var store = this.store;
                
                if( btn.getText()=='Entregados'){
                    btn.setText( "Activos" );
                    store.setBaseParam("mostrarEntregas", true );
                    store.setBaseParam("idgroup", this.idgroup );
                }else{
                    btn.setText( "Entregados" );                    
                    store.setBaseParam("mostrarEntregas", false );
                    store.setBaseParam("idgroup", this.idgroup );
                }
                store.reload();
            }
        });
        
        PanelAgenda.superclass.constructor.call(this, {
            loadMask: {msg: 'Cargando...'},
            clicksToEdit: 1,            
            id: 'grid-panel-agenda',
            tbar: this.tbar,
            view: new Ext.grid.GroupingView({
                forceFit: true,
                enableRowBody: true,
                hideGroupedColumn: true

            })
        });
        this.getView().getRowClass = this.getRowClass;
        
        var store = this.store;
        this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {            
            var record = store.getAt(rowIndex);            
            if(record.data.idstage){                
                return false;                
            }
            return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);       
        }       
    }

    Ext.extend(PanelAgenda, Ext.grid.EditorGridPanel, {        
        recargar: function () {
            this.store.reload();
        }
    });
</script>
