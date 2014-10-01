<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>

<script type="text/javascript">

    PanelReferencias = function(config) {

        Ext.apply(this, config);
        this.checkColumn = new Ext.grid.CheckColumn({header: 'Abrir', dataIndex: 'sel', width: 30,
            renderer: function(v, p, record) {
                var content = record.data['ca_estado'];
                if (content != 'Abierto') {
                    p.css += ' x-grid3-check-col-td';
                    return '<div class="x-grid3-check-col' + (v ? '-on' : '') + ' x-grid3-cc-' + this.id + '"> </div>';
                }
            }
        });
        this.checkColumn.on('click', function(check, p, record){
            if (record.data['sel']){
                Ext.MessageBox.show({
                    title: 'Auditoría',
                    msg: 'Por favor ingrese la razón para la apertura:',
                    width:500,
                    buttons: Ext.MessageBox.OKCANCEL,
                    multiline: true,
                    fn: function(btn, text){
                        record.data['ca_observaciones'] = text;
                    }
                });
                
            }
        });
        
        this.columns = [
            new Ext.grid.RowNumberer(),
            this.checkColumn,
            {
                header: "Referencia",
                dataIndex: 'ca_referencia',
                sortable: false,
                width: 100,
                flex: 1,
                renderer: this.formatURL
            },
            {
                header: "Año",
                dataIndex: 'ca_ano',
                sortable: true,
                width: 40
            },
            {
                header: "Mes",
                dataIndex: 'ca_mes',
                sortable: true,
                width: 40
            },
            {
                header: "Ciu.Origen",
                dataIndex: 'ca_ciuorigen',
                sortable: true,
                width: 90
            },
            {
                header: "Ciu.Destino",
                dataIndex: 'ca_ciudestino',
                sortable: true,
                width: 80
            },
            {
                header: "Modalidad",
                dataIndex: 'ca_modalidad',
                sortable: true,
                width: 50
            },
            {
                header: "Línea Naviera",
                dataIndex: 'ca_sigla',
                sortable: true,
                width: 100
            },
            {
                header: "Doc.Transporte",
                dataIndex: 'ca_mbls',
                sortable: true,
                width: 80
            },
            {
                header: "Estado",
                dataIndex: 'ca_estado',
                sortable: true,
                width: 40
            },
            {
                header: "Usu.Cerrado",
                dataIndex: 'ca_usucerrado',
                sortable: true,
                width: 60
            },
            {
                header: "Fch.Cerrado",
                dataIndex: 'ca_fchcerrado',
                sortable: true,
                width: 90
            },
            {
                header: "Usu.Abrió",
                dataIndex: 'ca_usuabierto',
                sortable: true,
                width: 60
            },
            {
                header: "Fch.Abrió",
                dataIndex: 'ca_fchabierto',
                sortable: true,
                width: 90
            }
        ];
        this.record = Ext.data.Record.create([
            {name: 'sel', type: 'boolean'},
            {name: 'ca_ano', type: 'string'},
            {name: 'ca_mes', type: 'string'},
            {name: 'ca_referencia', type: 'string'},
            {name: 'ca_ciuorigen', type: 'string'},
            {name: 'ca_ciudestino', type: 'string'},
            {name: 'ca_modalidad', type: 'string'},
            {name: 'ca_sigla', type: 'string'},
            {name: 'ca_mbls', type: 'string'},
            {name: 'ca_estado', type: 'string'},
            {name: 'ca_observaciones', type: 'string'},
            {name: 'ca_usucerrado', type: 'string'},
            {name: 'ca_fchcerrado', type: 'string'},
            {name: 'ca_usuabierto', type: 'string'},
            {name: 'ca_fchabierto', type: 'string'}
        ]);
        this.store = new Ext.data.GroupingStore({
            autoLoad: true,
            url: '<?= url_for("inoMaritimo/datosPanelReferencias") ?>',
            baseParams: {
                anio: this.anio,
                mes: this.mes,
                sucursal: this.sucursal,
                sufijo: this.sufijo,
                trafico: this.trafico,
                usuario: this.usuario,
                casos: this.casos
            },
            reader: new Ext.data.JsonReader(
                    {
                        root: 'root',
                        totalProperty: 'total'
                    },
            this.record),
            sortInfo: {field: 'ca_referencia', direction: "ASC"}
        });
        this.tbar = [
            {
                id: 'abrirbtn',
                text: 'Abrir Casos',
                iconCls: 'import',
                handler: this.abrir,
                scope: this
            }
        ];
        PanelReferencias.superclass.constructor.call(this, {
            clicksToEdit: 1,
            stripeRows: true,
            loadMask: {msg: 'Cargando...'},
            id: 'listado-referencias',
            plugins: [this.checkColumn],
            view: new Ext.grid.GroupingView({
                emptyText: "No hay datos",
                forceFit: true,
                enableRowBody: true,
                hideGroupedColumn: true
            }),
            listeners: {
                rowcontextmenu: this.onRowcontextMenu,
            }
        });
    };
    Ext.extend(PanelReferencias, Ext.grid.EditorGridPanel, {
        abrir: function() {
            var storeAbrirRefs = this.store;
            var records = storeAbrirRefs.getModifiedRecords();
            var lenght = records.length;
            // Ext.getCmp('abrirbtn').disable();

            for (var i = 0; i < lenght; i++) {
                r = records[i];
                if (r.data.sel) {   // Valida que esté checkeado
                    var changes = r.getChanges();
                    changes['id'] = r.id;
                    changes['referencia'] = r.data.ca_referencia;
                    changes['observaciones'] = r.data.ca_observaciones;
                    //envia los datos al servidor
                    Ext.Ajax.request(
                            {
                                waitMsg: 'Guardando cambios...',
                                url: '<?= url_for("inoMaritimo/observeAbrirReferencias") ?>',
                                //Solamente se envian los cambios
                                params: changes,
                                callback: function(options, success, response) {

                                    var res = Ext.util.JSON.decode(response.responseText);
                                    if (res.id && res.success) {
                                        var rec = storeAbrirRefs.getById(res.id);
                                        rec.set("sel", false); //Quita la seleccion de todas las columnas
                                        rec.commit();
                                    }
                                }
                            }
                    );
                }
                r.set("sel", false); //Quita la seleccion de todas las columnas
            }
            storeAbrirRefs.load();
            Ext.getCmp('abrirbtn').enable();
        },
        onRowcontextMenu: function(grid, index, e) {
            rec = this.store.getAt(index);
            if (!this.menu) { // create context menu on first right click
                this.menu = new Ext.menu.Menu({
                    id: 'grid_referencias-ctx',
                    enableScrolling: false,
                    items: [
                        {
                            text: 'Seleccionar todo',
                            iconCls: 'refresh',
                            scope: this,
                            handler: this.seleccionarTodo
                        }
                    ]
                });
                this.menu.on('hide', this.onContextHide, this);
            }
            e.stopEvent();
            if (this.ctxRow) {
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
            this.ctxRecord = rec;
            this.ctxRow = this.view.getRow(index);
            Ext.fly(this.ctxRow).addClass('x-node-ctx');
            this.menu.showAt(e.getXY());
        },
        seleccionarTodo: function() {
            var grid = Ext.getCmp("listado-referencias");
            var store = grid.getStore();
            store.each(function(r) {
                r.set("sel", true);
            });
        },
        formatURL: function(value) {
            myURL = '';
            if (value !== '') {
                myURL = '<a href="/colsys_php/inosea.php?boton=Consultar&id=' + value + '" target="_blank">' + value + '</a>';
            }
            return myURL;
        }
    });

</script>
