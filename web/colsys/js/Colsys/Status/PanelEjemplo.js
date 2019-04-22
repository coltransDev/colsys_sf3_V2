var companiesListJSONArray = [{
        "id": 1,
        "name": "Roodel",
        "phone": "602-736-2835",
        "price": 59.47,
        "change": 1.23,
        "lastChange": "10/8",
        "industry": "Manufacturing",
        "desc": "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.\n\nNulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.\n\nCras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
        "pctChange": 2.11,
        "orders": [{
                "id": 1,
                "companyId": 1,
                "productCode": "96f570a8-5218-46b3-8e71-0551bcc5ecb4",
                "quantity": 83,
                "date": "2015-10-07",
                "shipped": true
            }]
    }, {
        "id": 2,
        "name": "Voomm",
        "phone": "662-254-4213",
        "price": 41.31,
        "change": 2.64,
        "lastChange": "10/18",
        "industry": "Services",
        "desc": "Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
        "pctChange": 6.83,
        "orders": [{
                "id": 2,
                "companyId": 2,
                "productCode": "af7e56bf-09a9-4ff4-9b02-f5e6715e053b",
                "quantity": 14,
                "date": "2015-10-11",
                "shipped": false
            }]
    }];

Ext.define('Company', {
    extend: 'Ext.data.Model',
    fields: [{
            name: 'name'
        }, {
            name: 'phone'
        }, {
            name: 'price',
            type: 'float'
        }, {
            name: 'change',
            type: 'float'
        }, {
            name: 'pctChange',
            type: 'float'
        }, {
            name: 'lastChange',
            type: 'date',
            dateFormat: 'n/j'
        }, {
            name: 'industry'
        }, {
            name: 'desc'
        }]
});

/*Ext.define('Order', {
 extend: 'Ext.data.Model',
 
 fields: [{
 name: 'companyId',
 reference: 'Company'
 }, {
 name: 'productCode'
 }, {
 name: 'quantity',
 type: 'number'
 }, {
 name: 'date',
 type: 'date',
 dateFormat: 'Y-m-d'
 }, {
 name: 'shipped',
 type: 'boolean'
 }]
 });*/

Ext.define('Colsys.Status.PanelEjemplo', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Status.PanelEjemplo',
    requires: [
        'Ext.grid.plugin.RowWidget'
    ],
    width: 750,
    height: 450,
    //renderTo: 'companies_grid',
    title: "Expander Rows to show Company's orders",
    store: {
        model: 'Company',
        autoLoad: true,
        proxy: {
            type: 'memory',
            data: companiesListJSONArray
        }
    },
    columns: [{
            text: 'Id',
            dataIndex: 'id'
        }, {
            text: 'Name',
            dataIndex: 'name',
            flex: 1
        }, {
            width: 140,
            text: 'Phone',
            dataIndex: 'phone'
        }],
    plugins: [{
            ptype: 'rowwidget',
            widget: {
                xtype: 'panel',
                /*bind: {
                 store: '{record.orders}',
                 title: 'Orders for {record.name}'
                 },*/
                //html: "fasdfasdf"
                items: [
                    Ext.create('Colsys.Status.GridArchivos', {
                        id: 'form-factura-cabecera' + this.idmaster,
                        title: 'Informacion General',
                        idmaster: "cabecera" + this.idmaster
                    })
                ]
            }
        }]
});
//});