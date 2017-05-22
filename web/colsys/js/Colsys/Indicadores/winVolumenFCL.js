Ext.define('Colsys.Indicadores.winVolumenFCL', {
    extend: 'Ext.window.Window',
    width: 200,
    autoHeight: true,
    //maxHeight : 500,
    title: 'Volumen x Trafico',
    style: {
        borderRadius: '15px'
    },
    listeners: {
        hide: function(me, eOpts){
            this.setVisible(false);
        },
        afterrender: function (ct, position) {
            //alert(indi);
            indi = this.indice;
            res1 = this.res;
            idfor = this.idform;
            Ext.getCmp('gridvolumenFCL' + indi + idfor).getStore().setData(res1[indi].gridvolumenFCL);
        },
        beforerender: function (ct, position) {
            //alert(this.getId());
            //this.setTitle(this.getId());
            indi = this.indice;
            res1 = this.res;
            idfor = this.idform;
            this.add(
                    Ext.create('Ext.grid.Panel', {
                        id: 'gridvolumenFCL' + indi + idfor,
                        selModel: {
                            selType: 'cellmodel'
                        },
                        //id: 'gridvolumen' + indice + idform,
                        width: 210,
                        maxHeight : 350,
                        //indice: indice,
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


                                //alert(this.id);
                                //this.indice = this.up('window').indice;

                                this.setWidth(182);
                                this.reconfigure(
                                        store = Ext.create('Ext.data.Store', {
                                            fields: [
                                                {name: 'mes', mapping: 'mes'},
                                                {name: 'volumen', mapping: 'volumen'}
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
                                                text: "Volumen",
                                                dataIndex: 'volumen',
                                                width: 109,
                                                sortable: false,
                                                hideable: false,
                                                renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                                    var field = view.getHeaderAtIndex(colIndex).dataIndex;
                                                    if (value != "" && value != "null" && value != 0) {
                                                        if (colIndex != 0) {
                                                            console.log(record);                                                            
                                                            //return '<a href="javascript:mostrardatosVolumen(\'' + "volumen" + '\',\'' + record.get("mes") + '\',\'' + "FCL" + '\')" >' + ((value == null) ? 0 : value) + '</a>';
                                                            return '<a href="javascript:mostrardatosVolumen(\'' + record.get("mes") + '\',\'' + record.get("traorigen") + '\',\'' + "FCL" + '\',\'' +"volumen" + '\')" >' + ((value == null) ? 0 : value) + '</a>';
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
                        }
                    }
                    ));
        }

    }
});
