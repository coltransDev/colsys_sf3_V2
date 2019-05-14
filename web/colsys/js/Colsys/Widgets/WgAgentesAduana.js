Ext.define('Colsys.Widgets.WgAgentesAduana', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgAgentesAduana',
    triggerTip: 'Click para limpiar',
    spObj: '',
    queryMode: 'local',
    triggerAction: 'all',
    spForm: '',
    spExtraParam: '',
    displayField: 'nombre',
    valueField: 'id',
    hiddenValue: 'idalterno',
    minChars: 3,
    typeAhead: true,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function () {
            return '<tpl for="."><div class="search-item"><strong>{nombre}</strong><br/><span>Nit: {idalterno}</span></div></tpl>';
        }
    },           
    store: Ext.create('Ext.data.Store', {
        fields: ['id', 'idalterno', 'nombre'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosAgentesAduana',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: true
//        data : ''
    }),
    qtip: 'Listado ',
    doQuery: function (queryString, forceAll, rawQuery) {
        queryString = queryString || '';
        //me=this;
        // store in object and pass by reference in 'beforequery'
        // so that client code can modify values.
        var me = this,
                qe = {
                    query: queryString,
                    forceAll: forceAll,
                    combo: me,
                    cancel: false
                },
        store = me.store,
        isLocalMode = me.queryMode === 'local';
        //console.log(store);
        if (me.fireEvent('beforequery', qe) === false || qe.cancel) {            
            return false;
        }

        // get back out possibly modified values
        queryString = qe.query;
        forceAll = qe.forceAll;

        // query permitted to run
        if (forceAll || (queryString.length >= me.minChars)) {
            // expand before starting query so LoadMask can position itself correctly
            me.expand();
            
            // make sure they aren't querying the same thing
            //if (me.lastQuery !== queryString) {
                if (isLocalMode) {
                    // forceAll means no filtering - show whole dataset.
                    if (forceAll) {
                        store.clearFilter();
                    } else {                                        
                        //console.log(store);
                        store.clearFilter();                        
                        store.filterBy(function (record, id) {                            
                            var str = record.get("nombre");
                            var str1 = record.get("idalterno");
                            var txt = new RegExp(queryString, "ig");
                            //console.log(str.search(txt));
                            if (str.search(txt) == -1 &&  str1.search(txt) == -1)
                                return false;
                            else
                                return true;
                        });
                        //me.onLoad();
                    }
                }

              //  me.lastQuery = queryString;
            //}
        }
        return true;
    },
    initComponent: function () {
        var me = this;        
        Ext.applyIf(me, {
            emptyText: 'Seleccione un agente de aduana',
            loadingText: 'Loading...',
            store: {type: 'roletemplateslocal'}
        });
        me.callParent(arguments);
        me.getStore().on('beforeload', this.beforeTemplateLoad, this);
    }
});