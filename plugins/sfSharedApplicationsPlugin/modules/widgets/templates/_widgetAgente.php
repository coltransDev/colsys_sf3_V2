<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$agentes = $sf_data->getRaw("agentes");
?>
<script type="text/javascript">
    WidgetAgente = function (config) {
        Ext.apply(this, config);

        this.store = new Ext.data.Store({
            autoLoad: true,
            reader: new Ext.data.JsonReader(
                    {
                        root: 'root'
                    },
                    Ext.data.Record.create([
                        {name: 'idagente'},
                        {name: 'nombre'},
                        {name: 'idtrafico'},
                        {name: 'pais'},
                        {name: 'ciudad'},
                        {name: 'direccion'},
                        {name: 'tplogistics'},
                        {name: 'consolcargo'},
                        {name: 'tipo'}
                    ])
                    ),
            proxy: new Ext.data.MemoryProxy(<?= json_encode(array("root" => $agentes, "total" => count($agentes), "success" => true)) ?>)
        });

        this.resultTpl = new Ext.XTemplate(
                '<tpl for="."><div class="search-item"><b>{nombre}</b><br /><span style="font-size:9px">{pais}</span> <br />',
                '<span style="font-size:9px">',
                '<tpl if="this.oficial(tipo)">',
                '<p>{tipo}</p>',
                '</tpl>',
                '<tpl if="!this.oficial(tipo)">',
                '<p><span class="rojo">{tipo}</span></p>',
                '</tpl>',
                '<tpl if="this.tplogistics(tplogistics)">',
                '<p><span class="rojo">Agente TPLogistics</span></p>',
                '</tpl>',
                '<tpl if="this.tplogistics(consolcargo)">',
                '<p><span class="rojo">Agente Consolcargo</span></p>',
                '</tpl>',
                '</span> </div></tpl>'
                , {
                    oficial: function (val) {
                        return val == 'Oficial'
                    },
                    tplogistics: function (val) {
                        return val == true
                    },
                    consolcargo: function (val) {
                        return val == true
                    }
                }

        );
        WidgetAgente.superclass.constructor.call(this, {
                valueField: 'idagente',
                displayField: 'nombre',
                forceSelection: true,
                tpl: this.resultTpl,
                triggerAction: 'all',
                emptyText: '',
                itemSelector: 'div.search-item',
                selectOnFocus: true,
                lazyRender: true,
                filterBy: this.filterFn,
                mode: 'local',
                submitValue: true,
                listClass: 'x-combo-list-small'
        });
    };

    Ext.extend(WidgetAgente, Ext.form.ComboBox, {
        doQuery: function (q, forceAll) {
            q = Ext.isEmpty(q) ? '' : q;


            if (this.linkTrafico) {
                var trafico = Ext.getCmp(this.linkTrafico).getValue();

            } else {
                var impoexpo = (Ext.getCmp(this.linkImpoExpo)) ? Ext.getCmp(this.linkImpoExpo).getValue() : this.linkImpoExpo;
                if (impoexpo == "<?= Constantes::EXPO ?>") {
                    var link = this.linkDestino;
                } else {
                    var link = this.linkOrigen;
                }
                var record;
                var trafico;
                if (link)
                {
                    record = Ext.getCmp(link).getRecord();
                    trafico = record.data.idtrafico;
                }
            }

            var listarTodos = "";

            if (this.linkListarTodos == "all")
            {
                listarTodos = true;
            } else
            {
                if (Ext.getCmp(this.linkListarTodos) && Ext.getCmp(this.linkListarTodos)) {
                    listarTodos = Ext.getCmp(this.linkListarTodos).getValue();
                }
            }


            if (!listarTodos)
            {
                this.store.filterBy(function (record, id) {
                    if (record.get("idtrafico") == trafico)
                    {
                        var str = record.get("nombre");

                        var txt = new RegExp(q, "ig");
                        if (str.search(txt) == -1)
                            return false;
                        else
                            return true;
                    } else
                        return false;
                });

            } else if (listarTodos == true)
            {
                if (q != "")
                {
                    this.store.filterBy(function (record, id) {
                        var str = record.get("nombre");
                        var str1 = record.get("pais");

                        var txt = new RegExp(q, "ig");
                        if (str.search(txt) == -1 && str1.search(txt) == -1)
                            return false;
                        else
                            return true;
                    });
                } else
                    this.store.filter("", "", true, true);
            }
            this.onLoad();
        },
        getTrigger: Ext.form.TwinTriggerField.prototype.getTrigger,
        initTrigger: Ext.form.TwinTriggerField.prototype.initTrigger,
        trigger1Class: 'x-form-clear-trigger',
        trigger2Class: 'x-form-search-trigger',
        hideTrigger1: true,
        initComponent: function () {
            WidgetAgente.superclass.initComponent.call(this);

            this.triggerConfig = {
                tag: 'span',
                cls: 'x-form-twin-triggers',
                cn: [{
                        tag: 'img',
                        src: Ext.BLANK_IMAGE_URL,
                        cls: 'x-form-trigger ' + this.trigger1Class
                    },
                    {
                        tag: 'img',
                        src: Ext.BLANK_IMAGE_URL,
                        cls: 'x-form-trigger ' + this.trigger3Class
                    }]
            };
        },
        reset: Ext.form.Field.prototype.reset.createSequence(function () {
            this.triggers[0].hide();
        }),
        onViewClick: Ext.form.ComboBox.prototype.onViewClick.createSequence(function () {
            this.triggers[0].show();
        }),
        onTrigger1Click: function (a, b, c) {
            this.clearValue();
            this.triggers[0].hide();
            this.fireEvent('clear', this);
            this.fireEvent('select', this);
        },
        onTrigger2Click: function () {
            this.onTriggerClick();
        }
    });
</script>