Ext.define('Colsys.Indicadores.winPeso', {
    extend: 'Ext.window.Window',
    width: 320,
    title: 'Peso x Mes',
    autoHeight: true,
    style: {
        borderRadius: '15px'
    },
    closeAction: 'hide',
    listeners: {
        afterrender: function (ct, position) {
            //alert(indi);
            indi = this.indice;
            res1 = this.res;
            idfor = this.idform;
            Ext.getCmp('gridpie' + indi + idfor).getStore().setData(res1[indi].gridpie);
        },
        beforerender: function (ct, position) {
            //alert(this.getId());
            //this.setTitle(this.getId());
            indi = this.indice;
            res1 = this.res;
            idfor = this.idform;
            this.add(
                    Ext.create('Ext.grid.Panel', {
                        id: 'gridpie' + indi + idfor,
                        selModel: {
                            selType: 'cellmodel'
                        },
                        //id: 'gridvolumen' + indice + idform,
                        width: 500,
                        //indice: indice,
                        maxHeight: 500,
                        autoHeight: true,
                        style: {
                            marginLeft: '12%',
                            marginBottom: '12%'
                        },
                        viewConfig: {
                            getRowClass: function (record, rowIndex, rowParams, store) {

                                if ((rowIndex % 2) == 0) {
                                    return "row_gray";
                                }
                            }
                        },
                        listeners: {
                            beforerender: function (ct, position) {
                                this.setWidth(157);
                                this.id = ('gridpie' + this.up('window').indice + this.up('window').idform);
                                this.indice = this.up('window').indice;
                                this.reconfigure(
                                        store = Ext.create('Ext.data.Store', {
                                            fields: [
                                                {name: 'mes', mapping: 'mes'},
                                                {name: 'peso', mapping: 'peso'}
                                            ],
                                            autoLoad: false
                                        }),
                                        [{
                                                text: "Mes",
                                                dataIndex: 'mes',
                                                width: 70,
                                                sortable: false,
                                                hideable: false
                                            },
                                            {
                                                text: "Peso",
                                                dataIndex: 'peso',
                                                width: 85,
                                                sortable: false,
                                                hideable: false,
                                                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                    var field = view.getHeaderAtIndex(colIndex).dataIndex;
                                                    if (value != "" && value != "null" && value != 0) {
                                                        if (colIndex != 0) {
                                                            return '<a href="javascript:mostrardatos(\'' + "peso" + '\',\'' + record.get("mes") + '\',\'' + 1 + '\')" >' + ((value == null) ? 0 : value) + '</a>';
                                                        } else {
                                                            return value;
                                                        }
                                                    } else
                                                        return '0';
                                                }
                                            }

                                        ]
                                        );
                        
                            },
                            afterrender: function (ct, position) {
                                this.getStore().setData(this.up('window').res[this.up('window').indice].gridpie);
                            }
                        }
                    }
                    ))
        }
    }

});
