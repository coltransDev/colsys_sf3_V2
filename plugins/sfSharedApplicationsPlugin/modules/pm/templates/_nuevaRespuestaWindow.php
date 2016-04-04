<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("pm", "editarTicketPropiedadesPanel");

$data = $sf_data->getRaw("data");
$status = $sf_data->getRaw("status");
?>
<style>
    .x-menu-list {       
        padding-right: 20px !important;
    }
</style>
<script type="text/javascript">
    NuevaRespuestaWindow = function (config) {
        Ext.apply(this, config);
        this.ctxRecord = null;

        this.resultTpl = new Ext.XTemplate(
            '<tpl for=".">',
                '<div class="search-item">',
                '<span style="color:#33518C;"><b>{stage}</b></span><br /><tpl if="this.entrega(delivery)"><span style="font-size:9px;"><b>Entregada: </b>{delivery}</span></tpl>',                
            '</span></div></tpl>',
            {
                entrega: function(val){
                    if(val!=null)
                        return true;
                    else
                        return false;
                }
            }
        );

        this.dataStatus = <?= json_encode(array("root" => $status)) ?>;

        this.comboEtapas = new Ext.form.ComboBox({
            fieldLabel: 'Entregas',
            typeAhead: true,
            width: 200,
            itemSelector: 'div.search-item',
            forceSelection: true,
            triggerAction: 'all',
            emptyText: 'Seleccione',
            selectOnFocus: true,
            lazyRender: true,
            id: 'stage',
            name: 'stage',
            hiddenName: 'stage_id',
            displayField: 'stage',
            valueField: 'idstage',
            tpl: this.resultTpl,
            store: new Ext.data.Store({
                autoLoad: false,
                autoDestroy: true,
                url: '<?= url_for("pm/datosEntregasTicket") ?>',
                baseParams: {
                    idticket: this.idticket,
                    modo: 'modo'
                },
                reader: new Ext.data.JsonReader({
                        id: 'idstage',
                        root: 'root',
                        totalProperty: 'total',
                        successProperty: 'success'
                    },
                    Ext.data.Record.create([
                        {name: 'idstage'},
                        {name: 'stage'},
                        {name: 'detail'},
                        {name: 'delivery'}
                    ])
                )
            })
        })
        this.comboEtapas.on("select", this.insertarEntrega);

        this.combo = new Ext.form.ComboBox({
            fieldLabel: 'Mensaje',
            typeAhead: true,
            width: 600,
            forceSelection: true,
            triggerAction: 'all',
            emptyText: 'Seleccione',
            selectOnFocus: true,
            lazyRender: true,
            displayField: 'texto',
            valueField: 'texto',
            listClass: 'x-combo-list-small',
            store: new Ext.data.Store({
                autoLoad: true,
                reader: new Ext.data.JsonReader(
                        {
                            root: 'root',
                            totalProperty: 'total',
                            successProperty: 'success'
                        },
                        Ext.data.Record.create([
                            {name: 'texto'}
                        ])
                        ),
                proxy: new Ext.data.MemoryProxy(<?= json_encode(array("root" => $data, "success" => true)) ?>)
            })


        });
        this.combo.on("select", this.completarTextos);

        this.etapas = {
            columnWidth: .5,
            layout: 'form',
            xtype: 'fieldset',
            id: 'field_entrega',
            name: 'field_entrega',
            //disabled: true,                                        
            items: [
                this.comboEtapas
            ]
        }

        this.subpanel = new Ext.FormPanel({
            id: "respuesta-ticket-panel",
            url: '<?= url_for('pm/guardarRespuestaTicket') ?>',
            hideLabel: true,
            items: [
                {
                    xtype: 'hidden',
                    name: 'idticket',
                    value: this.idticket
                },
                {
                    xtype: 'hidden',
                    name: 'idresponse',
                    value: this.idresponse
                },
                {
                    xtype: 'htmleditor',
                    name: 'respuesta',
                    hideLabel: true,
                    height: 300,
                    anchor: '100%',
                    enableFont: false,
                    enableFontSize: false,
                    enableLinks: false,
                    enableSourceEdit: false,
                    enableColors: false,
                    enableLists: false,
                    allowBlank: false

                },
                {
                    xtype: 'fieldset',
                    id: 'info',
                    autoHeight: true,
                    layout: 'column',
                    columns: 2,
                    defaults: {
                        layout: 'form',
                        border: false,
                        bodyStyle: 'padding:4px'
                    },
                    items: [{
                            columnWidth: .5,
                            layout: 'form',
                            xtype: 'fieldset',
                            items: [
                                {
                                    xtype: 'datefield',
                                    name: 'fchseguimiento',
                                    fieldLabel: "Seguimiento",
                                    format: "Y-m-d",
                                    hideLabel: false,
                                    enableFont: false,
                                    enableFontSize: false,
                                    enableLinks: false,
                                    enableSourceEdit: false,
                                    enableColors: false,
                                    enableLists: false,
                                    allowBlank: true,
                                    disabled: this.idresponse ? true : false
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'motivo',
                                    id: 'motivo',
                                    value: '',
                                    hidden: true,
                                    disabled: true,
                                    anchor: '100%',
                                    fieldLabel: "Observ. IDG",
                                    listeners: {
                                        'change': function(){
                                            Ext.getCmp("button-send").enable();
                                        }
                                    }
                                },
                                new Ext.form.ComboBox({
                                    fieldLabel: 'Status',
                                    typeAhead: true,
                                    forceSelection: true,
                                    triggerAction: 'all',
                                    emptyText: '',
                                    selectOnFocus: true,
                                    value: '',
                                    id: 'status_id',
                                    lazyRender: false,
                                    allowBlank: true,
                                    displayField: 'valor',
                                    valueField: 'status',
                                    hiddenName: 'status',
                                    listClass: 'x-combo-list-small',
                                    mode: 'local',
                                    store: new Ext.data.Store({
                                        autoLoad: true,
                                        proxy: new Ext.data.MemoryProxy(this.dataStatus),
                                        reader: new Ext.data.JsonReader(
                                                {
                                                    root: 'root',
                                                    totalProperty: 'total',
                                                    successProperty: 'success'
                                                },
                                                Ext.data.Record.create([
                                                    {name: 'status'},
                                                    {name: 'valor'}
                                                ])
                                                )
                                    })
                                })
                            ]
                    }]
                }]
        })

        this.buttons = [
            {
                text: 'Enviar',
                id: 'button-send',
                handler: this.enviarRespuesta,
                scope: this
            },
            {
                text: 'Cancelar',
                handler: this.close.createDelegate(this, [])
            }
        ];

        this.tbar = [this.combo];

        if (this.idgroup == 2) {
            Ext.getCmp('info').add(this.etapas);            
            this.tbar.push({
                text:'Agendar Entregas',
                handler: this.crearEntregas
             });
        }    

        NuevaRespuestaWindow.superclass.constructor.call(this, {
            title: 'Nueva respuesta Ticket# ' + this.idticket,
            id: "nueva-respuesta-ticket",
            autoHeight: true,
            width: 800,
            resizable: false,
            plain: true,
            y: 100,
            autoScroll: true,
            closeAction: 'close',
            buttons: this.buttons,
            items: this.subpanel,
            tbar:this.tbar,
            listeners: {
                afterrender: this.onAfterRender
            }
        });
    }

    Ext.extend(NuevaRespuestaWindow, Ext.Window, {
        enviarRespuesta: function () {
            Ext.getCmp("button-send").disable();
            
            var panel = Ext.getCmp("respuesta-ticket-panel");

            var form = panel.getForm();
            var win = this;

            var opener = this.opener;

            if (form.isValid()) {
                if (!this.respuesta && this.vencimiento <= new Date()) {

                    motivo = Ext.getCmp('motivo');
                    motivo.setVisible(true);
                    motivo.setDisabled(false);
                    if (motivo.getValue() == "") {
                        Ext.MessageBox.alert('Mensaje', 'El IDG ha sobrepasado el tiempo. Por favor indique la razón.');
                        return false;
                    }
                }

                form.submit({
                    success: function (form, action) {

                        win.close();

                        if (opener) {
                            var cmp = Ext.getCmp(opener);
                            if (cmp) {
                                cmp.body.update(action.result.info);
                            }
                        }

                        Ext.MessageBox.alert('Mensaje', 'La respuesta se ha enviado correctamente');
                    },
                    // standardSubmit: false,
                    failure: function (form, action) {
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + (action.result ? ": " + action.result.errorInfo : "") + " " + (action.response ? "\n Codigo HTTP " + action.response.status : ""));
                    }//end failure block
                });
            } else {
                Ext.MessageBox.alert('Sistema de Tickets:', '¡Por favor complete los campos subrayados!');
            }

        },
        completarTextos: function (combo, record, index) { // override default onSelect to do redirect	

            var panel = Ext.getCmp("respuesta-ticket-panel");
            var res = panel.getForm().findField("respuesta").getValue();
            panel.getForm().findField("respuesta").setValue(res + "\n<br />" + record.data.texto);
            combo.setValue("");
        },
        insertarEntrega: function (combo, record, index) { // override default onSelect to do redirect	
            
            var panel = Ext.getCmp("respuesta-ticket-panel");
            var res = panel.getForm().findField("respuesta").getValue();            
            
            var entrega = "<div style='background-color:#F6F6F6;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;'><b>Etapa: </b><span style='color: #0A2A80;'><b>" + record.data.stage+"</b></span><br/>"+ record.data.detail +"</div>";
            panel.getForm().findField("respuesta").setValue(res + entrega);            
        },
        onAfterRender: function (cmp) {
            Ext.getCmp("status_id").setRawValue(this.status_name);
            Ext.getCmp("status_id").hiddenField.value = this.status;            
        },
        crearEntregas: function(){
            var panel = Ext.getCmp("respuesta-ticket-panel");
            var res = panel.getForm().findField("respuesta").getValue();
            var id = panel.getForm().findField("idticket").getValue();
            this.grid = new PanelEntregas({
                readOnly: this.readOnly,
                idticket: null,               
                respuesta: res
            });

            this.grid.setDataUrl("<?=url_for("pm/datosEntregasTicket")?>");
            this.grid.store.setBaseParam("idticket",id );
            this.grid.store.reload();
            this.grid.idticket = id;

            var win;
            if(!win){
                win = new Ext.Window({
                    title: 'Panel de Entregas',
                    id: 'crear-entregas-win',
                    autoHeight: true,
                    width: 650,
                    height: 400,
                    resizable: false,
                    plain:true,
                    modal: true,
                    y: 100,
                    autoScroll: true,
                    closeAction: 'hide',
                    buttons: this.buttons,
                    items: this.grid
                })
            }
            win.show(this);            
        }
    });
</script>