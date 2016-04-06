<?
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<style type="text/css">
    .reply-text {
        margin:5px  !important;
        white-space:normal !important;
        display:initial; 
    }
    
    .wrap .x-grid-cell-inner {
        white-space: normal;
    }
</style>

<script type="text/javascript">
    /**
     * PanelEntregas object definition
     **/

    PanelEntregas = function (config) {
        Ext.apply(this, config);

        this.columns = [            
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
            {name: 'idstage', type: 'string'},
            {name: 'stage', type: 'string'},
            {name: 'detail', type: 'string'},
            {name: 'estimated', type: 'date', dateFormat: 'Y-m-d'},
            {name: 'delivery', type: 'date', dateFormat: 'Y-m-d H:i:s'}
        ]);
        
        this.store = new Ext.data.Store({
            autoLoad: false,
            url: '<?= url_for("pm/datosEntregasTicket") ?>',
            reader: new Ext.data.JsonReader(
                    {
                        root: 'root',
                        totalProperty: 'total'
                    },
                    this.record
                    ),
            sortInfo: {field: 'estimated', direction: 'ASC'} //,

        });

        PanelEntregas.superclass.constructor.call(this, {
            loadMask: {msg: 'Cargando...'},
            clicksToEdit: 1,
            autoHeight: true,
            autoWidth: true,
            scroll: true,
            id: 'grid-panel-entregas',
            tbar: [
                {
                    text: 'Nuevo Registro',
                    iconCls: 'add',
                    scope: this,
                    handler: this.nuevoRegistro
                }, {
                    text: 'Recargar',
                    iconCls: 'refresh',
                    scope: this,
                    handler: this.recargar
                }, {
                    text: 'Guardar',
                    iconCls: 'disk',
                    scope: this,
                    handler: this.guardarCambios
                }
            ],
            viewConfig: {
                //forceFit:true,
                enableRowBody:true,
                getRowClass : this.applyRowClass
            }
        });
        
        var store = this.store;
        this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {            
            var record = store.getAt(rowIndex);            
            if(record.data.idstage){                
                return false;                
            }
            return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);       
       }       
    }

    Ext.extend(PanelEntregas, Ext.grid.EditorGridPanel, {
        height: 300,        
        nuevoRegistro: function () {
            var recordFile = this.record;
            var store = this.store;
            var record = new recordFile({
                sel: false,
                idticket: this.idticket,
                stage: '',
                details: '',
                estimated: '',
                delivery: ''
            });
            records = [];
            records.push(record);
            store.insert(0, records);
        },
        recargar: function () {

            if (this.store.getModifiedRecords().length > 0) {
                if (!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")) {
                    return 0;
                }
            }
            this.store.reload();
        },
        guardarCambios: function () {
            var store = this.store;
            var records = store.getModifiedRecords();            
            var lenght = records.length;
            
            for (var i = 0; i < lenght; i++) {
                r = records[i];
                
                var changes = r.getChanges();
                changes['id'] = r.id;
                changes['idticket'] = r.data.idticket;
                changes['idstage'] = r.data.idstage;

                //envia los datos al servidor
                Ext.Ajax.request({
                    waitMsg: 'Guardando cambios...',
                    url: '<?= url_for("pm/guardarEntregas") ?>',
                    //method: 'POST',
                    //Solamente se envian los cambios
                    params: changes,
                    success:function(response,options){
                        var res = Ext.util.JSON.decode(response.responseText);
                        console.log(res);
                        if (res.id && res.success) {
                            var rec = store.getById(res.id);

                            rec.set("sel", false); //Quita la seleccion de todas las columnas
                            rec.data.idstage = res.idstage;
                            rec.commit();

                            Ext.MessageBox.alert('Etapas', 'Se ha(n) creado el(los) registro(s) correctamente.');
                            
                            var pe = Ext.getCmp("grid-panel-entregas");
                            pe.recargar();
                            
                        } else {
                            Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + " " + (res.errorInfo ? "\n Codigo HTTP " + res.errorInfo : ""));
                        }
                    },
                    failure:function(response,options){
                        var res = Ext.util.JSON.decode(response.responseText);
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + " " + (res.errorInfo ? "\n Codigo HTTP " + res.errorInfo : ""));
                    }
                });
            }
            var win = Ext.getCmp("crear-entregas-win");
            if (win) {
                win.close();
            }
            var panel = Ext.getCmp("respuesta-ticket-panel");
            if (panel) {
                var res = panel.getForm().findField("respuesta").getValue();
                panel.getForm().findField("respuesta").setValue(res + "\n<br />" /*+ entrega*/);
            }
        },
        onContextHide: function () {
            if (this.ctxRow) {
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
        },
        setDataUrl: function (url) {
            this.dataUrl = url;
            this.store.proxy = new Ext.data.HttpProxy({url: url});
        }
    });
</script>
