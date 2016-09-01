<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$data = $sf_data->getRaw("data");
?>



<script type="text/javascript">
    WidgetLinea = function (config) {
        Ext.apply(this, config);

        this.resultTpl = new Ext.XTemplate(
                '<tpl for="."><div class="search-item"><b>{linea}</b><br /><br />',
                '<span style="font-size:9px">',
                '<tpl if="!this.activoImpo(activo_impo)">',
                '<p><span class="rojo">Inactivo Impo</span></p>',
                '</tpl>',
                '<tpl if="!this.activoExpo(activo_expo)">',
                '<p><span class="rojo">Inactivo Expo</span></p>',
                '</tpl>',
                '</span> </div></tpl>'
                , {
                    activoImpo: function (val) {
                        return val == true
                    },
                    activoExpo: function (val) {
                        return val == true
                    }
                }
        );
        this.data1 = <?= json_encode($data) ?>;
        this.store = new Ext.data.Store({
            autoLoad: true,
            reader: new Ext.data.JsonReader(
                    {
                        root: 'root',
                        totalProperty: 'total',
                        successProperty: 'success'
                    },
                    Ext.data.Record.create([
                        {name: 'idlinea'},
                        {name: 'linea'},
                        {name: 'activo_impo'},
                        {name: 'activo_expo'}
                    ])
                    ),
            proxy: new Ext.data.MemoryProxy(<?= json_encode(array("root" => $data, "total" => count($data), "success" => true)) ?>)
        });

        WidgetLinea.superclass.constructor.call(this, {
            valueField: 'idlinea',
            displayField: 'linea',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText: '',
            selectOnFocus: true,
            lazyRender: true,
            filterBy: this.filterFn,
            mode: 'local',
            submitValue: true,
            itemSelector: 'div.search-item',
            tpl: this.resultTpl,
            listClass: 'x-combo-list-small',
            listeners: {
                focus: this.onFocusWdg
            }
        });
    };


    Ext.extend(WidgetLinea, Ext.form.ComboBox, {
        trigger1Class: 'x-form-clear-trigger',
        trigger2Class: 'x-form-select-trigger',
        hideTrigger1: true,
        getTrigger: Ext.form.TwinTriggerField.prototype.getTrigger,
        initTrigger: Ext.form.TwinTriggerField.prototype.initTrigger,
        doQuery: function (q, forceAll) {
            q = Ext.isEmpty(q) ? '' : q;
            var qe = {
                query: q,
                forceAll: forceAll,
                combo: this,
                cancel: false
            };
            if (this.fireEvent('beforequery', qe) === false || qe.cancel) {
                return false;
            }
            q = qe.query;
            forceAll = qe.forceAll;
            if (forceAll === true || (q.length >= this.minChars)) {

                var impoexpo = this.impoexpo;
                var nomimpoexpo = (Ext.getCmp(impoexpo)) ? Ext.getCmp(impoexpo).getValue() : impoexpo;
                var activo_impo = this.activoImpo;
                var activo_expo = this.activoExpo;
                
                if (nomimpoexpo == "<?= Constantes::IMPO ?>") {                    
                    if (activo_impo) {
                        this.store.filterBy(function (record, id) {                            
                            if (record.get("activo_impo") == activo_impo) {                                
                                var str = record.get("linea");
                                var txt = new RegExp(q, "ig");
                                if (str.search(txt) == -1)
                                    return false;
                                else
                                    return true;
                            } else
                                return false;
                        });
                    }
                } else if (nomimpoexpo == "<?= Constantes::EXPO ?>") {                    
                    if (activo_expo) {
                        this.store.filterBy(function (record, id) {
                            if (record.get("activo_expo") == activo_expo) {                                
                                var str = record.get("linea");
                                var txt = new RegExp(q, "ig");
                                if (str.search(txt) == -1)
                                    return false;
                                else
                                    return true;
                            } else
                                return false;
                        });
                    }
                } else {
                    if (activo_impo || activo_expo) {
                        this.store.filterBy(function (record, id) {
                            if (record.get("activo_impo") == activo_impo || record.get("activo_expo") == activo_expo) {                                
                                var str = record.get("linea");
                                var txt = new RegExp(q, "ig");
                                if (str.search(txt) == -1)
                                    return false;
                                else
                                    return true;
                            } else
                                return false;
                        });
                    } else {
                        this.store.filterBy(function (record, id) {                            
                            var str = record.get("linea");
                            var txt = new RegExp(q, "ig");
                            if (str.search(txt) == -1)
                                return false;
                            else
                                return true;
                        });
                    }
                }
                this.onLoad();
            }
        },
        onFocusWdg: function (field, newVal, oldVal) {
            var cmp = Ext.getCmp(this.linkTransporte);
            if (cmp) {


                var cmp2 = Ext.getCmp(this.linkImpoexpo);
                if (cmp2) {
                    var impoexpo = cmp2.getValue();
                } else {
                    var impoexpo = null;
                }

                var list = new Array();
                var transporte = Ext.getCmp(this.linkTransporte).getValue();

                if (transporte == "<?= Constantes::OTMDTA ?>" || transporte == "<?= Constantes::OTMAIR ?>") {
                    transporte = "<?= Constantes::TERRESTRE ?>";
                }

                for (k in this.data1) {
                    var rec = this.data1[k];

                    if (transporte && rec.transporte == transporte) {
                        if (this.linkImpoexpo) {

                            if (impoexpo == "<?= Constantes::IMPO ?>" && rec.activo_impo) {
                                list.push(rec);

                            }

                            if (impoexpo == "<?= Constantes::EXPO ?>" && rec.activo_expo) {
                                list.push(rec);
                            }
                            
                            if (impoexpo == "<?= Constantes::OTMAIR ?>" && (rec.activo_impo || rec.activo_expo)) {
                                list.push(rec);
                            }
                        } else {
                            if(rec.activo_impo || rec.activo_expo )
                                list.push(rec);
                        }
                    }
                }

                var data = new Object();
                data.root = list;
                this.store.loadData(data);
            } else {
                alert("arrrrg: No existe el componente id: " + e.combo.linkTransporte + "!");
            }
        },
        initComponent: function () {
            WidgetLinea.superclass.initComponent.call(this);

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
                        cls: 'x-form-trigger ' + this.trigger2Class
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