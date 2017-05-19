Ext.define('Colsys.Widgets.wgConceptosSiigo', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.Colsys.Widgets.wgConceptosSiigo',
  triggerTip: 'Click para limpiar',
  spObj:'',
  queryMode: 'local',
  triggerAction: 'all',
  spForm:'',  
  spExtraParam:'',
  displayField: 'name',
  valueField: 'id',
  minChars:3,
  typeAhead: true,
  listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item1">{name}</div></tpl>';
        }
    },
   
    store: Ext.create('Ext.data.Store', {
        fields: ['id','name'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosConceptosSiigo',
            baseParams:{
                modo:this.modo,
                transporte:this.idtransporte,
                impoexpo:this.idimpoexpo
            },
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: false
    }),
    qtip:'Listado de Conceptos',

    doQuery: function(queryString, forceAll, rawQuery) {
        queryString = queryString || '';
        var me = this,
            qe = {
                query: queryString,
                forceAll: forceAll,
                combo: me,
                cancel: false
            },
            store = me.store,
            isLocalMode = me.queryMode === 'local';

        if (me.fireEvent('beforequery', qe) === false || qe.cancel) {
            return false;
        }
        queryString = qe.query;
        forceAll = qe.forceAll;


        if (forceAll || (queryString.length >= me.minChars)) {
            me.expand();
            if ( me.lastQuery !== queryString) {
                if (isLocalMode) {
                    if (forceAll) {
                        store.clearFilter();
                    } else {
                        store.clearFilter();                        
                        store.filterBy(function(record, id) {            
                                var str=record.get("name");
                                var txt=new RegExp(queryString,"ig");                                
                                if(str.search(txt) == -1  )
                                    return false;
                                else
                                    return true;            
                        });
                    }
                }
                me.lastQuery = queryString;
            }
        }
        return true;
},
    initComponent: function() {
        var me = this; 
        Ext.applyIf(me, {
            emptyText: 'Seleccione un concepto',
            loadingText: 'Loading...',
            store: {type: 'roletemplateslocal'}
        });
        me.callParent(arguments);
        me.getStore().on('beforeload', this.beforeTemplateLoad, this);
    },
 
    beforeTemplateLoad: function(store) {
        store.proxy.extraParams = {
            modo: this.modo,
            idcomprobante: this.idcomprobante,
            transporte:this.idtransporte,
            impoexpo:this.idimpoexpo
        }
    },
    setModo: function(modo,idcomprobante)
    {
        this.modo=modo; 
        this.idcomprobante=idcomprobante;
        if(this.idcomprobante>0)
        {
            this.store.proxy.extraParams = {
                modo: this.modo,
                idcomprobante: this.idcomprobante
            };
            this.store.reload();
        }
    }

});
