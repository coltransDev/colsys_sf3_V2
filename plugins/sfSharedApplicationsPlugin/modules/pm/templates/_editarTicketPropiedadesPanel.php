<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$grupos = $sf_data->getRaw("grupos");
$status = $sf_data->getRaw("status");
$empresas = $sf_data->getRaw("empresas");

include_component("widgets", "widgetEquipo");

?>
<script type="text/javascript">
    EditarTicketPropiedadesPanel = function( config ) {
        Ext.apply(this, config);
        
        this.dataDepartamentos = <?=json_encode(array("departamentos" => $sf_data->getRaw("departamentos")))?>;
        this.dataStatus = <?=json_encode(array("root" => $status))?>;
        this.dataEmpresas = <?=json_encode(array("root" => $empresas))?>;
        
        this.resultTpl = new Ext.XTemplate(
            '<tpl for=".">',
            '<tpl if="!this.idempresa(idempresa)">',
                '<div class="search-item">',
                '<span style="color:#F89253;"><b>{nombre}</b></span><br /><span style="font-size:9px;">{empresa}</span>',                
            '</tpl>',
            '<tpl if="this.idempresa(idempresa)">',
                '<div class="search-item">',
                '<span style="color:#33518C;"><b>{nombre}</b></span><br /><span style="font-size:9px;">{empresa}</span>',                
            '</tpl>',
            '</span></div></tpl>',
            {
                idempresa: function(val){                    
                    var grupo = "<?=json_encode($sf_data->getRaw("grupoEmp"))?>";
                    
                    grupo = grupo.replace('[','').replace(']','')+',';                    
                    if(grupo.indexOf(val) >= 0)
                        return true;
                    else
                        return false;                    
                }
            }
        );
    
        this.departamentos = new Ext.form.ComboBox({
            fieldLabel: 'Departamento',
            typeAhead: true,
            forceSelection: true,
            itemSelector: 'div.search-item',
            linkListarTodos: "listar_todos",
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            hiddenName: 'departamento',
            id: 'departamento_id',
            lazyRender:true,
            allowBlank: false,
            listClass: 'x-combo-list-small',
            tpl: this.resultTpl,
            displayField: 'nombre',
            valueField: 'iddepartamento',
            forceSelection: true,            
            store : new Ext.data.Store({
                autoLoad : true ,
                proxy: new Ext.data.MemoryProxy( this.dataDepartamentos ),
                reader: new Ext.data.JsonReader(
                    {
                        id: 'iddepartamento',
                        root: 'departamentos'
                    },
                    Ext.data.Record.create([
                        {name: 'iddepartamento'},
                        {name: 'nombre'},
                        {name: 'idempresa'},
                        {name: 'empresa'}
                    ])
                )
            })
        });

        this.departamentos.on("select", this.cargarDepartamentos, this );
        
        this.departamentos.doQuery = function(q, forceAll){
            q = Ext.isEmpty(q) ? '' : q;
            var qe = {
                query: q,
                forceAll: forceAll,
                combo: this,
                cancel:false
            };            
            q = qe.query;
            forceAll = qe.forceAll;
            if(forceAll === true || (q.length >= this.minChars)){

                var listarTodos = (Ext.getCmp(this.linkListarTodos))?Ext.getCmp(this.linkListarTodos).getValue():this.linkListarTodos;
                var empresa = Ext.getCmp("grupoEmp").getValue();
                
                empresa = empresa.replace('[','').replace(']','')+',';
               
                if (!listarTodos){
                    this.store.filterBy(function (record, id) {
                        //alert(empresa.indexOf(record.get("idempresa")));
                        if(empresa.indexOf(record.get("idempresa")) >= 0){
                            var str = record.get("nombre");                            

                            var txt = new RegExp(q, "ig");
                            if (str.search(txt) == -1)
                                return false;
                            else
                                return true;
                        }
                        else
                            return false;                       
                    });                                        
                }else{
                    if (q != ""){
                        this.store.filterBy(function (record, id) {
                            var str = record.get("nombre");
                            var str1 = record.get("empresa");

                            var txt = new RegExp(q, "ig");
                            if (str.search(txt) == -1 && str1.search(txt) == -1)
                                return false;
                            else
                                return true;
                        });
                    }
                    else
                        this.store.filter("", "", true, true);
                }
                this.onLoad();
            }
        }
        
        this.areas =  new Ext.form.ComboBox({
            fieldLabel: 'Área',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            id: 'area_id',
            lazyRender:true,
            allowBlank: false,
            displayField: 'nombre',
            valueField: 'idgrupo',
            hiddenName: 'area',
            listClass: 'x-combo-list-small',

            store : new Ext.data.Store({
                autoLoad : false ,
                url: '<?=url_for("pm/datosAreas")?>',
                reader: new Ext.data.JsonReader(
                    {
                        id: 'idgrupo',
                        root: 'grupos',
                        totalProperty: 'total',
                        successProperty: 'success'
                    },
                    Ext.data.Record.create([
                        {name: 'idgrupo'},
                        {name: 'nombre'}
                    ])
                )
            }),
            
            listeners: {
                select: function(combo, record, index) {
                  // Verifica si la opción escogida es Tarifas Internacionales
                  if(combo.getValue()==25){
                      <?
                      $folder = "Tarifario/helpdesk";
                      $filename = "FORMATO_SOLICITUD_DE_TARIFAS.xls";                      
                      ?>                      
                      Ext.getCmp("title").setValue("Solicitud de Tarifas");                      
                      Ext.getCmp("text_id").setValue('<div>Para solicitar tarifas por favor diligencie el presente formulario y adjuntelo al ticket.<br /><a href="../gestDocumental/verArchivo?idarchivo=<?=base64_encode($folder.'/'.$filename)?>" target="_blank"><b> Solicitud de Tarifas</b></a><br /></div>');
                  }
                }
            }
        });

        this.areas.on("select", this.cargarAreas, this );

        this.projectos = new Ext.form.ComboBox({
            fieldLabel: 'Proyecto',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            id: 'proyecto_id',
            lazyRender:true,
            allowBlank: true,
            displayField: 'nombre',
            valueField: 'idproyecto',
            hiddenName: 'project',
            listClass: 'x-combo-list-small',
            mode: 'local',

            store : new Ext.data.Store({
                autoLoad : true ,
                url: '<?=url_for("pm/datosProyectos")?>',
                reader: new Ext.data.JsonReader(
                {
                    id: 'idproyecto',
                    root: 'proyectos',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'idproyecto'},
                    {name: 'nombre'}
                ])
            )
            })
        });

        this.projectos.on("select", this.cargarProyectos, this );

        this.milestones = new Ext.form.ComboBox({
            fieldLabel: 'Status',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            id: 'milestone_id',
            lazyRender:true,
            allowBlank: true,
            displayField: 'valor',
            valueField: 'status',
            hiddenName: 'status',
            listClass: 'x-combo-list-small',
            mode: 'local',

            store : new Ext.data.Store({                
                autoLoad : true ,
                proxy: new Ext.data.MemoryProxy( this.dataStatus ),
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
        });

        this.asignaciones = new Ext.form.ComboBox({
            fieldLabel: 'Asignado a',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            id: 'assignedto_id',
            lazyRender:true,
            allowBlank: true,
            displayField: 'login',
            valueField: 'login',
            hiddenName: 'assignedto',
            listClass: 'x-combo-list-small',
            mode: 'local',
            store : new Ext.data.Store({
                autoLoad : true ,
                url: '<?=url_for("pm/datosAsignaciones")?>',
                reader: new Ext.data.JsonReader(
                {
                    id: 'login',
                    root: 'usuarios',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'login'}

                ])
            )
            })
        });

        this.reportadoPor = new Ext.form.ComboBox({
            fieldLabel: 'Reportado por',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            id: 'reportedby_id',
            name: 'login',
            lazyRender:true,
            allowBlank: true,
            displayField: 'nombre',
            valueField: 'login',
            hiddenName: 'reportedby',
            listClass: 'x-combo-list-small',
            mode: 'local',
            store : new Ext.data.Store({
                autoLoad : true ,
                url: '<?=url_for("pm/datosUsuarios")?>',
                reader: new Ext.data.JsonReader(
                {
                    root: 'usuarios',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'login'},
                    {name: 'nombre'}

                ])
            )
            })
        });

        this.prioridades = new Ext.form.ComboBox({
            fieldLabel: 'Prioridad',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: 'Baja',
            name: 'priority',
            id: 'priority_id',
            lazyRender:true,
            allowBlank: true,
            listClass: 'x-combo-list-small',
            store : [
                ["Baja", "Baja"],
                ["Media", "Media"],
                ["Alta", "Alta"]
            ]
        });

        this.tipos = new Ext.form.ComboBox({
            fieldLabel: 'Tipo',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: 'Tarea',
            name: 'type',
            id: 'type_id',
            lazyRender:true,
            allowBlank: true,
            listClass: 'x-combo-list-small',
            displayField: 'clasification',
            valueField: 'clasification',
            store : new Ext.data.Store({
                autoLoad : false ,
                url: '<?=url_for("pm/datosClasificacion")?>',
                reader: new Ext.data.JsonReader(
                {
                    root: 'root',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'iddepartamento'},
                    {name: 'clasification'}
                ])
            )
            })
        });

        this.acciones = new Ext.form.ComboBox({
            fieldLabel: 'Estado',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: 'Abierto',
            name: 'actionTicket',
            id: 'actionTicket_id',
            lazyRender:true,
            allowBlank: true,
            listClass: 'x-combo-list-small',
            store : [
                ["Abierto", "Abierto"],
                ["Cerrado", "Cerrado"]
            ]
        });

        this.reportedoThrough = new Ext.form.ComboBox({
            fieldLabel: 'Medio reportado',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: 'Web',
            name: 'reportedthrough',
            id: 'reportedthrough_id',
            lazyRender:true,
            allowBlank: true,
            listClass: 'x-combo-list-small',
            store : [
                <?
                $i = 0;
                foreach( $reportedThroughtParams as $param ){
                    if( $i++!=0){
                        echo ",";
                    }
                    ?>
                    ["<?=$param->getCaValor()?>", "<?=$param->getCaValor()?>"]
                    <?
                }
                ?>
                
            ]
        });

        this.activo = new WidgetEquipo({
            fieldLabel: 'Activo',
            name: 'activo',
            hiddenName: 'idactivo',
            id: 'activo_id'
        });

        this.empresas = new Ext.form.ComboBox({
            fieldLabel: 'Empresa',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            id: 'empresa_id',
            lazyRender:true,
            allowBlank: true,
            displayField: 'nombre',
            valueField: 'idempresa',
            hiddenName: 'idempresa',
            listClass: 'x-combo-list-small',
            mode: 'local',

            store : new Ext.data.Store({                
                autoLoad : true ,
                proxy: new Ext.data.MemoryProxy( this.dataEmpresas ),
                reader: new Ext.data.JsonReader(
                {

                    root: 'root',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'idempresa'},
                    {name: 'nombre'}
                ])
            )
            })
        });


        EditarTicketPropiedadesPanel.superclass.constructor.call(this, {            
            id: 'form-ticket-panel',
            autoHeight: true,            
            bodyStyle:'padding:5px 5px 0',
            url: '<?=url_for('pm/formTicketGuardar')?>',
            fileUpload : true,

            items: [
                {
                    xtype:'fieldset',
                    title: 'Clasificación',
                    autoHeight:true,
                    layout:'column',
                    columns: 3,
                    defaults:{
                        //columnWidth:0.5,
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px'
                    },
                    items:[{
                            columnWidth:.44,
                            layout: 'form',
                            xtype:'fieldset',
                            items: [
                                this.departamentos,
                                this.projectos,
                                this.tipos,
                                this.asignaciones,
                                this.reportadoPor,
                                this.activo
                            ]
                        },{
                            columnWidth:.09 ,
                            layout: 'form',
                            xtype:'fieldset',
                            items: [
                                {
                                    xtype: "checkbox",
                                    hideLabel: "true",                                    
                                    id: "listar_todos",
                                    name:"listar_todos",                                    
                                },
                                {
                                    xtype:"hidden",
                                    id: 'grupoEmp',
                                    name: 'empresa',
                                    value:'<?=json_encode($sf_data->getRaw("grupoEmp"))?>'
                                }
                            ]
                        },{
                            columnWidth:.44,
                            layout: 'form',
                            xtype:'fieldset',
                            items: [
                                this.areas,
                                this.prioridades,
                                this.acciones,
                                this.milestones,
                                this.reportedoThrough,
                                this.empresas
                            ]
                        }]
                },
                {
                    xtype:'fieldset',
                    title: 'Detalles',
                    autoHeight:true,                    
                    defaults:{
                        columnWidth:0.5,
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px'
                    },
                    items:[

                        {
                            xtype:'textfield',
                            fieldLabel: 'Titulo',
                            name: 'title',
                            id: 'title',
                            anchor:'95%',
                            allowBlank: false
                        },

                        {
                            xtype:'htmleditor',
                            id:'text_id',
                            name:'text',
                            fieldLabel:'Descripción',
                            height:120,
                            anchor:'98%',
                            enableFont: false,
                            enableFontSize: false,
                            enableLinks:  false,
                            enableSourceEdit : false,
                            enableColors : false,
                            enableLists: false,
                            allowBlank: false

                        },
                        {
                            xtype: 'fileuploadfield',
                            id: 'archivo',
                            width: 250,
                            fieldLabel: 'Adjuntar',
                            emptyText: 'Seleccione un archivo',
                            buttonCfg: {
                                text: '',
                                iconCls: 'upload-icon'
                            }
                        },
                        {
                            xtype:'hidden',
                            name: 'idticket',
                            value: this.idticket,
                            anchor:'95%'
                        }
                    ]
                }
            ]
        });

        this.addEvents({add:true});
        
    }

    Ext.extend(EditarTicketPropiedadesPanel, Ext.FormPanel, {

        validarVigencia:function(){
            //alert( this.nivel );
            if( this.nivel==0 || !this.nivel  ){
                this.bloquearCampos();
            }
        },

        bloquearCampos: function(){
            Ext.getCmp('priority_id').setDisabled(true);
            Ext.getCmp('type_id').setDisabled(true);
            Ext.getCmp('assignedto_id').setDisabled(true);
            Ext.getCmp('type_id').setDisabled(true);
            Ext.getCmp('actionTicket_id').setDisabled(true);
            Ext.getCmp('proyecto_id').setDisabled(true);
            Ext.getCmp('milestone_id').setDisabled(true);
            Ext.getCmp('reportedby_id').setDisabled(true);
            Ext.getCmp('reportedthrough_id').setDisabled(true);
            Ext.getCmp('reportedthrough_id').setValue("Web");
            Ext.getCmp('reportedby_id').setValue("");
            Ext.getCmp('activo_id').setValue("");
            Ext.getCmp('activo_id').setDisabled(true);
            Ext.getCmp('empresa_id').setValue("");
            Ext.getCmp('empresa_id').setDisabled(true);
        },

        desbloquearCampos: function(){
            Ext.getCmp('priority_id').setDisabled(false);
            Ext.getCmp('type_id').setDisabled(false);
            Ext.getCmp('assignedto_id').setDisabled(false);
            Ext.getCmp('type_id').setDisabled(false);
            Ext.getCmp('actionTicket_id').setDisabled(false);
            Ext.getCmp('proyecto_id').setDisabled(false);
            Ext.getCmp('milestone_id').setDisabled(false);
            Ext.getCmp('reportedby_id').setDisabled(false);
            Ext.getCmp('reportedthrough_id').setDisabled(false);            
            Ext.getCmp('activo_id').setDisabled(false);
            Ext.getCmp('empresa_id').setDisabled(false);
        },

        renombrarCampos: function(){
            this.changeLabel( 'area_id', 'Procesos:');
            this.changeLabel( 'proyecto_id', 'Tema:');
            this.changeLabel( 'type_id', 'Hallazgo:');
            this.changeLabel( 'reportedby_id', 'Reportado a:');
        },
            
        desnombrarCampos: function(){
            this.changeLabel( 'area_id', 'Área:');
            this.changeLabel( 'proyecto_id', 'Proyecto:');
            this.changeLabel( 'type_id', 'Tipo:');
            this.changeLabel( 'reportedby_id', 'Reportado por:');
        },

        desbloquearAsignado: function(){
            Ext.getCmp('assignedto_id').setDisabled(false);
        },

        mostrarEmpresa: function(){
            Ext.getCmp('empresa_id').setDisabled(false);
            Ext.getCmp('empresa_id').setVisible(true);
        },

        ocultarEmpresa: function(){
            Ext.getCmp('empresa_id').setDisabled(true);
            Ext.getCmp('empresa_id').setVisible(false);
        },

        changeLabel: function(fieldId, newLabel){
            var label = Ext.DomQuery.select(String.format('label[for="{0}"]', fieldId));
            if (label){
                label[0].childNodes[0].nodeValue = newLabel;
            }
        },
            
        onRender: function(){
            // call parent
            EditarTicketPropiedadesPanel.superclass.onRender.apply(this, arguments);

            // set wait message target
            this.getForm().waitMsgTarget = this.getEl();
            this.validarVigencia();
            var actionTicket =  this.actionTicket;
            var panel = this;            
            if(typeof(this.idticket)!="undefined" && this.idticket!="" )
            {
                this.load({
                    url:'<?=url_for("pm/datosTicket")?>',
                    waitMsg:'Cargando...',
                    params:{idticket:this.idticket},

                    success:function(response,options){
                        this.res = Ext.util.JSON.decode( options.response.responseText );
                        Ext.getCmp("departamento_id").setRawValue(this.res.data.departamento);
                        Ext.getCmp("departamento_id").hiddenField.value = this.res.data.iddepartament;
                        panel.cargarDepartamentos();

                        area = Ext.getCmp("area_id");
                        area.setValue(this.res.data.group);
                        area.hiddenField.value = this.res.data.idgroup;
                        panel.cargarAreas();

                        proyecto = Ext.getCmp('proyecto_id');
                        proyecto.setValue(this.res.data.project);
                        proyecto.hiddenField.value = this.res.data.idproject;
                        panel.cargarProyectos();

                        Ext.getCmp('assignedto_id').setValue( this.res.data.assignedto );
                        Ext.getCmp('reportedby_id').setValue( this.res.data.loginName );
                        Ext.getCmp('reportedby_id').hiddenField.value = this.res.data.login;
                        if( actionTicket ){
                            Ext.getCmp('actionTicket_id').setValue( actionTicket );
                        }else{
                            Ext.getCmp('actionTicket_id').setValue( this.res.data.action );
                        }
                        
                        Ext.getCmp('type_id').setValue( this.res.data.type );
                                                
                        Ext.getCmp("milestone_id").setRawValue(this.res.data.status_name);
                        Ext.getCmp("milestone_id").hiddenField.value = this.res.data.status;
                        
                        Ext.getCmp("activo_id").setRawValue(this.res.data.activo);
                        Ext.getCmp("activo_id").hiddenField.value = this.res.data.idactivo;
                    }
                });
            }
        },

        guardar: function(){
            var gridId = this.gridId;
            var panel = Ext.getCmp("form-ticket-panel");
            var form = panel.getForm();

            var idticket = this.idticket;

            if( form.isValid() ){
                if( (!Ext.getCmp('proyecto_id').getValue() || !Ext.getCmp('type_id').getValue()) && Ext.getCmp('actionTicket_id').getValue()=="Cerrado" ){
                    Ext.MessageBox.alert('Error Message', "Es necesario clasificar el ticket antes de cerrarlo");
                }else{
                    form.submit({
                        success:function(form,action){
                            //Ext.Msg.alert( "Información" );
                            Ext.getCmp("editar-ticket-win").close();                            
                            if( !idticket ){
                                Ext.MessageBox.alert('Mensaje', 'El ticket se ha enviado al área correspondiente, el numero de ticket es: '+action.result.idticket);
                                location.href="<?=url_for('helpdesk/verTicket')?>"+"/id/"+action.result.idticket;
                            } else {
                                if(action.result.change){
                                    Ext.MessageBox.alert('Mensaje', action.result.txt);
                                    location.href="<?=url_for('pm/index')?>";
                                }
                                Ext.getCmp(gridId).store.reload();
                            }
                        },
                        // standardSubmit: false,
                        failure:function(form,action){
                            Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                        }//end failure block
                    });
                }
            }else{
                Ext.MessageBox.alert('Sistema de Tickets:', '¡Por favor complete los campos subrayados!');
            }

        },

        cargarDepartamentos: function(  ){           
            var iddepartamento =  Ext.getCmp('departamento_id').hiddenField.value;
            area = Ext.getCmp('area_id');
            area.store.setBaseParam( "departamento",iddepartamento );
            area.store.load();
            area.setValue("");

            type = Ext.getCmp('type_id');
            type.store.setBaseParam( "departamento",iddepartamento );
            type.store.load();
            type.setValue("");

            proyecto = Ext.getCmp('proyecto_id');
            proyecto.setValue("");

            assignedto = Ext.getCmp('assignedto_id');
            assignedto.setValue("");
           
            if(iddepartamento==4){      // Si Departamento es Auditoría, renombra los campos
                this.renombrarCampos();
                this.mostrarEmpresa();
                this.desbloquearAsignado();
            }else{
                this.desnombrarCampos();
                this.ocultarEmpresa();
            }

            if( this.nivel==2 || this.nivel==3 ){
                if( iddepartamento!=<?=$iddepartamento?> ){
                    this.bloquearCampos();
                }else{
                    this.desbloquearCampos();
                }
            }

            if( this.nivel<2 ){
                this.bloquearCampos();
            }
        },

        cargarAreas: function(   ){
            var idgrupo = Ext.getCmp('area_id').hiddenField.value;
            proyecto = Ext.getCmp('proyecto_id');
            proyecto.store.baseParams = {
                idgrupo: idgrupo
            };
            proyecto.store.load();

            assignedto = Ext.getCmp('assignedto_id');
            assignedto.store.baseParams = {
                idgrupo: idgrupo
            };
            assignedto.store.load();

            proyecto = Ext.getCmp('proyecto_id');
            proyecto.setValue("");

            assignedto = Ext.getCmp('assignedto_id');
            assignedto.setValue("");

            if( this.nivel==1 ){               

                var grupos = <?=json_encode($grupos)?>;
                var encontro = false;
                for(i in grupos ){                    
                    if( grupos[i] == idgrupo ){
                        encontro = true;
                    }
                }
                if( !encontro ){
                    this.bloquearCampos();
                }else{
                    this.desbloquearCampos();
                }

            }
        },

        cargarProyectos: function( ){
            var idproyecto = Ext.getCmp('proyecto_id').hiddenField.value;
            milestone = Ext.getCmp('milestone_id');
            milestone.store.baseParams = {
                idproject: idproyecto
            };
            milestone.store.load();

        }
    
    });
</script>