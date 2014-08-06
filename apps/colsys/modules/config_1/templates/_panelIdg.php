<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets", "widgetDeptos");
include_component("widgets", "widgetSucursales");
include_component("widgets", "widgetParametros",array("caso_uso"=>"CU107,CU108"));

?>

<script type="text/javascript">

PanelIdg = function( config ){
    Ext.apply(this, config);
        this.columns = [
            {
                header: "Departamento",
                dataIndex: 'departamento',
                width: 63,
                sortable: true,
                editor: new WidgetDeptos()
            },
            {
                header: "Nombre",
                dataIndex: 'nombre',
                sortable: true,
                width: 280,
                editor: new Ext.form.TextField()
            },
            {
                header: "Tipo",
                dataIndex: "tipo",
                sortable: false,
                editor : new WidgetParametros({
                                                id:'tipo',
                                                name:'tipo',
                                                caso_uso:"CU108",
                                                width:80,
                                                idvalor:"valor"
                                                })
            }
        ];

        this.record = Ext.data.Record.create([
            {name: 'idreg', type: 'integer', mapping: 'i_idreg'},
            {name: 'iddepartamento', type: 'string', mapping: 'i_ca_iddepartamento'},
            {name: 'departamento', type: 'string', mapping: 'd_ca_nombre'},
            {name: 'nombre', type: 'string', mapping: 'i_ca_nombre'},
            {name: 'tipo', type: 'string', mapping: 'i_ca_tipo'},
            {name: 'orden', type: 'string' }
        ]);

        this.store = new Ext.data.GroupingStore({
            autoLoad : true,
            url: '<?= url_for("idg/datosPanelIdg") ?>',
            reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record),
            sortInfo:{field: 'orden', direction: "ASC"}
        });
        
        this.tbar=[
            {
				text:'Guardar',
				iconCls:'disk',
				handler: this.guardarCambios
			}
         ];

        PanelIdg.superclass.constructor.call(this, {
            clicksToEdit: 2,
            stripeRows: true,
            autoHeight:true,
            loadMask: {msg:'Cargando...'},            
            id: 'admin-idg',
            view: new Ext.grid.GroupingView({
                emptyText: "No hay datos",
                forceFit:true,
                enableRowBody:true,
                hideGroupedColumn: true
            }),
            listeners:{
                rowcontextmenu: this.onRowContextMenu,
                rowclick : this.onRowclick,
                validateedit: this.onValidateEdit
            }
        });
    };
    this.ca_idg=0;

    Ext.extend(PanelIdg, Ext.grid.EditorGridPanel, { 
        guardarCambios: function(a,b)
        {
            var store = Ext.getCmp('admin-idg').store;
            var records = store.getModifiedRecords();

            var lenght = records.length;

            changes=[];        
            for( var i=0; i< lenght; i++){
                r = records[i];

                 if( r.data.iditem!="" && r.getChanges())
                 {                
                    records[i].data.id=r.id
                    records[i].data.idreg=r.data.idreg
                    changes[i]=records[i].data;
                 }
            }

            var str= JSON.stringify(changes);
            if(str.length>5)
            {
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("idg/guardarIdg")?>',
                        params :	{
                            datos:str                            
                        },
                        failure:function(response,options){
                            var res = Ext.util.JSON.decode( response.responseText );
                            if(res.err)
                                Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                            else
                                Ext.MessageBox.alert("Mensaje",'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>'+res.texto);
                        },
                        success:function(response,options)
                        {
                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.id && res.success)
                            {
                                id=res.id.split(",");
                                idreg=res.idreg.split(",");
                                for(i=0;i<id.length;i++)
                                {
                                    var rec = store.getById( id[i] );
                                    rec.set("idreg",idreg[i]);
                                    rec.commit();
                                }
                            }
                            if(res.errorInfo!="")
                            {
                                Ext.MessageBox.alert("Mensaje",'No fue posible el guardar la fila <br>'+res.errorInfo);                                
                            }
                        }
                     }
                );
            }
        }
        ,
        recargar: function(){

            if(this.store.getModifiedRecords().length>0){
                if(!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
                    return 0;
                }
            }
            this.store.reload();
        },
        onRowclick: function(grid, rowIndex, e)
        {
            var record = grid.getStore().getAt(rowIndex);  // Get the Record

            if(this.ca_idg!=record.data.idreg)
            {
                Ext.getCmp('config-idg').store.setBaseParam("ca_idg", record.data.idreg);
                Ext.getCmp('config-idg').store.reload();
                this.ca_idg=record.data.idreg;
            }
        },
        /*
        * Menu contextual que se despliega sobre una fila con el boton derecho
        */
        onContextHide: function(){
            if(this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
        },
        onRowContextMenu: function(grid, index, e){
            rec = grid.store.getAt(index);
            e.stopEvent(); //Evita que se despliegue el menu con el boton izquierdo
            var store = this.store;
                        
            if(!this.menu){
                this.menu = new Ext.menu.Menu({
                    enableScrolling : false,
                    items: [
                        {
                            text: 'Eliminar',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                                if( confirm("Esta seguro?") ){
                                    if( this.ctxRecord.data.idreg ){
                                       // alert(this.ctxRecord.data.idreporte+"-"+ this.numRef);
                                       var id=this.ctxRecord.id;
                                        Ext.Ajax.request(
                                        {
                                            waitMsg: 'Guardando cambios...',
                                            url:'<?=url_for("idg/eliminarIdg")?>',
                                            params : {
                                                ca_idg: this.ctxRecord.data.idreg                                                
                                            },
                                            failure:function(response,options){
                                                alert( response.responseText );
                                                success = false;
                                            },
                                            success:function(response,options){
                                                var res = Ext.util.JSON.decode( response.responseText );
                                                //if( res.success ){
                                                    r = store.getById(id );
                                                    store.remove( r );
                                                //}
                                            }
                                        });
                                    }else
                                    {
                                        r = store.getById( this.ctxRecord.id );
                                        store.remove( r );
                                    }
                                }
                            }
                        },
                        {
                            text: 'Ver Reporte',
                            iconCls: 'page_white_acrobat',
                            scope:this,
                            handler: function(){
                                window.open("/idg/verReporte/id/"+this.ctxRecord.data.idreporte);
                            }
                        }
                    ]
                });
            }
            this.menu.on('hide', this.onContextHide, this);
            if(this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
            this.ctxRecord = rec;
            this.ctxRow = this.view.getRow(index);
            Ext.fly(this.ctxRow).addClass('x-node-ctx');
            this.menu.showAt(e.getXY());
        }
        ,
        onValidateEdit: function(e){

            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;
            storeReportes = this.store;
            recordReportes = this.record;
            //alert(e.value);
            if( e.field == "departamento"){               
                i=0;
                store.each( function( r ){                    
                    if( r.data.id==e.value ){                        

                        if( !rec.data.iddepartamento  ){
                            var newRec = new recordReportes({
                                departamento: '+',
                                hbl: '',
                                orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                            });

                            newRec.data.concepto = "";                            
                            //Inserta una columna en blanco al final
                            storeReportes.addSorted(newRec);
                            storeReportes.sort("orden", "ASC");
                        }                        
                        e.value = r.data.valor;
                        rec.set( "iddepartamento",r.data.id);                        
                        return true;
                    }
                });
            }
        }
        
    });

PanelConfig = function( config ){
    Ext.apply(this, config);
        this.columns = [
            {
                header: "Sucursal",
                dataIndex: 'sucursal',
                width: 63,
                sortable: true,
                editor: new WidgetSucursales()
            },
            {
                header: "Limite Control",
                dataIndex: 'lim1',
                sortable: true,
                width: 280,
                editor: new Ext.form.NumberField({minValue:0})
            },
            {
                header: "U. Tiempo",
                dataIndex: "tiempo",
                sortable: false,
                editor : new WidgetParametros({
                                                id:'tiempo',
                                                name:'tiempo',
                                                caso_uso:"CU107",
                                                width:80,
                                                idvalor:"valor"
                                                })
            },
            {
                header:"Fecha Inicio",
                dataIndex:"fechaini",
                format: 'Y-m-d',
                editor : new Ext.form.DateField({format: 'Y-m-d'}),
                renderer: Ext.util.Format.dateRenderer('Y-m-d')
            },
            {             
                header:"Fecha Fin",
                dataIndex:"fechafin",
                editor : new Ext.form.DateField({format: 'Y-m-d'}),
                renderer: Ext.util.Format.dateRenderer('Y-m-d')
            }
        ];

        this.record = Ext.data.Record.create([            
            {name: 'idreg', type: 'integer', mapping: 'c_idreg'},
            {name: 'idsucursal', type: 'string', mapping: 'c_ca_idsucursal'},
            {name: 'sucursal', type: 'string', mapping: 's_ca_nombre'},
            {name: 'lim1', type: 'string', mapping: 'c_ca_lim1'},
            {name: 'fechaini', type: 'date', mapping: 'c_ca_fchini',dateFormat:'Y-m-d'},
            {name: 'fechafin', type: 'date', mapping: 'c_ca_fchfin',dateFormat:'Y-m-d'},
            {name: 'tiempo', type: 'string', mapping: 'c_ca_tiempo'},
            {name: 'orden', type: 'string' }
        ]);

        this.store = new Ext.data.GroupingStore({
            autoLoad : false,
            url: '<?= url_for("idg/datosPanelConfig") ?>',
            reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record),
            sortInfo:{field: 'orden', direction: "ASC"}
        });
        
        this.tbar=[
            {
				text:'Guardar',
				iconCls:'disk',
				handler: this.guardarCambios
			}
         ];

        PanelConfig.superclass.constructor.call(this, {
            clicksToEdit: 2,
            stripeRows: true,
            autoHeight:true,
            loadMask: {msg:'Cargando...'},            
            id: 'config-idg',
            view: new Ext.grid.GroupingView({
                emptyText: "No hay datos",
                forceFit:true,
                enableRowBody:true,
                hideGroupedColumn: true
            }),            
            listeners:{
                rowcontextmenu: this.onRowContextMenu,
                validateedit: this.onValidateEdit
            }
        });
    };

    Ext.extend(PanelConfig, Ext.grid.EditorGridPanel, {
        guardarCambios: function(a,b)
        {
            var store = Ext.getCmp('config-idg').store;
            var records = store.getModifiedRecords();

            var lenght = records.length;

            changes=[];        
            for( var i=0; i< lenght; i++){
                r = records[i];

                if( r.data.iditem!="" && r.getChanges())
                {
                    records[i].data.id=r.id;
                    records[i].data.idreg=r.data.idreg;
                    changes[i]=records[i].data;
                }
            }

            var str= JSON. stringify(changes);        
            if(str.length>5)
            {
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("idg/guardarConfig")?>',
                        params :	{
                            datos:str,
                            ididg:Ext.getCmp("admin-idg").ca_idg
                        },
                        failure:function(response,options){
                            var res = Ext.util.JSON.decode( response.responseText );
                            if(res.err)
                                Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                            else
                                Ext.MessageBox.alert("Mensaje",'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>'+res.texto);
                        },
                        success:function(response,options)
                        {
                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.id && res.success)
                            {
                                id=res.id.split(",");
                                idreg=res.idreg.split(",");
                                for(i=0;i<id.length;i++)
                                {
                                    var rec = store.getById( id[i] );
                                    rec.set("idreg",idreg[i]);
                                    rec.commit();
                                }
                            }
                            if(res.errorInfo!="")
                            {
                                Ext.MessageBox.alert("Mensaje",'No fue posible el guardar la fila <br>'+res.errorInfo);
                            }
                        }
                     }
                );
            }
        },
        recargar: function(){
            if(this.store.getModifiedRecords().length>0){
                if(!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
                    return 0;
                }
            }
            this.store.reload();
        },
        onContextHide: function(){
            if(this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
        },
        onRowContextMenu: function(grid, index, e){
            rec = grid.store.getAt(index);
            e.stopEvent(); //Evita que se despliegue el menu con el boton izquierdo
            var store = this.store;
                        
            if(!this.menu){
                this.menu = new Ext.menu.Menu({
                    enableScrolling : false,
                    items: [
                        {
                            text: 'Eliminar',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                                if( confirm("Esta seguro?") ){
                                    if( this.ctxRecord.data.idreg)
                                    {
                                       var id=this.ctxRecord.id;
                                        Ext.Ajax.request(
                                        {
                                            waitMsg: 'Guardando cambios...',
                                            url:'<?=url_for("idg/eliminarIdgconfig")?>',
                                            params : {
                                                idconfig: this.ctxRecord.data.idreg
                                            },
                                            failure:function(response,options){
                                                alert( response.responseText );
                                                success = false;
                                            },
                                            success:function(response,options){
                                                var res = Ext.util.JSON.decode( response.responseText );
                                                //if( res.success ){
                                                    r = store.getById(id );
                                                    store.remove( r );
                                                //}
                                            }
                                        });
                                    }else
                                    {
                                        r = store.getById( this.ctxRecord.id );
                                        store.remove( r );
                                    }
                                }
                            }
                        },
                        {
                            text: 'Ver Reporte',
                            iconCls: 'page_white_acrobat',
                            scope:this,
                            handler: function(){
                                window.open("/idg/verReporte/id/"+this.ctxRecord.data.idreporte);
                            }
                        }
                    ]
                });
            }
            this.menu.on('hide', this.onContextHide, this);

            if(this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
            this.ctxRecord = rec;
            this.ctxRow = this.view.getRow(index);
            Ext.fly(this.ctxRow).addClass('x-node-ctx');
            this.menu.showAt(e.getXY());
        },        
        onValidateEdit: function(e){

            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;
            storeReportes = this.store;
            recordReportes = this.record;
            if( e.field == "sucursal"){
                
                var existe = false;
                recordsConceptos = storeReportes.getRange();
                for( var j=0; j< recordsConceptos.length&&!existe; j++){
                    if(recordsConceptos[j].data.idsucursal==e.value)
                    {
                        existe = true;
                    }
                }
                
                if( !existe ){
                    store.each( function( r ){
                        if( r.data.id==e.value )
                        {
                            if( !rec.data.idsucursal){
                                var newRec = new recordReportes({
                                    sucursal: '+',
                                    lim1: '',
                                    orden: 'Z'
                                });

                                newRec.data.concepto = "";
                                storeReportes.addSorted(newRec);
                                storeReportes.sort("orden", "ASC");
                            }
                            e.value = r.data.valor;
                            rec.set( "idsucursal",r.data.id);                        
                            return true;
                        }
                    });
                }
                else
                {
                    alert("Esta agregando una sucursal que ya existe");
                    e.value = "+";
                    return false;
                }
            }
            else if( e.field == "fechaini" || e.field == "fechafin"){
                e.value=Ext.util.Format.date(e.value, ('Y-m-d'));                
            }
        }
    });
</script>