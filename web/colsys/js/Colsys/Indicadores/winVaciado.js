Ext.define('Colsys.Indicadores.winVaciado', {
    extend: 'Ext.window.Window',
    width: 320,
    autoHeight: true,
    title: 'Oportunidad en el Vaciado',
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
            Ext.getCmp('gridvaciado' + indi + idfor).getStore().setData(res1[indi].gridvaciado);
        },
        beforerender: function (ct, position) {
            //alert(this.getId());
            //this.setTitle(this.getId());
            indi = this.indice;
            res1 = this.res;
            idfor = this.idform;
            this.add(
                    Ext.create('Ext.grid.Panel', {
                        id: 'gridvaciado' + indi + idfor,
                        selModel: {
                            selType: 'cellmodel'
                        },
                        //id: 'gridvolumen' + indice + idform,
                        width: 500,
                        //indice: indice,
                        
                        autoHeight: true,
                        maxHeight: 500,
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



                                this.setWidth(230);
                                this.reconfigure(
                                        store = Ext.create('Ext.data.Store', {
                                            fields: [
                                                {name: 'mes', mapping: 'mes'},
                                                {name: 'cumple', mapping: 'cumple'},
                                                {name: 'nocumple', mapping: 'nocumple'}
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
                                                text: "Cumple",
                                                dataIndex: 'cumple',
                                                width: 70,
                                                sortable: false,
                                                hideable: false,
                                                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                    var field = view.getHeaderAtIndex(colIndex).dataIndex;
                                                    if (value != "" && value != "null" && value != 0) {
                                                        if (colIndex != 0) {
                                                            return '<a href="javascript:mostrardatos(\'' + "vaciado" + '\',\'' + record.get("mes") + '\',\'' + "1" + '\')" >' + ((value == null) ? 0 : value) + '</a>';
                                                        } else {
                                                            return value;
                                                        }
                                                    } else
                                                        return '0';
                                                }
                                            },
                                            {
                                                text: "No Cumple",
                                                dataIndex: 'nocumple',
                                                width: 85,
                                                sortable: false,
                                                hideable: false,
                                                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                    var field = view.getHeaderAtIndex(colIndex).dataIndex;
                                                    if (value != "" && value != "null" && value != 0) {
                                                        if (colIndex != 0) {
                                                            return '<a href="javascript:mostrardatos(\'' + "vaciado" + '\',\'' + record.get("mes") + '\',\'' + "0" + '\')" >' + ((value == null) ? 0 : value) + '</a>';
                                                        } else {
                                                            return value;
                                                        }
                                                    } else
                                                        return '0';
                                                }
                                            }

                                        ]
                                        );
                                
                            }

                        }
                    }
                    ))
        }
    }

});
