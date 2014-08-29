<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("pm", "editarTicketPropiedadesPanel");


?>
<script type="text/javascript">
NuevoSeguimientoWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;


    

    this.subpanel = new Ext.FormPanel({id: "seguimiento-activo-panel",
                            url: '<?=url_for('inventory/guardarSeguimiento')?>',
                            hideLabel: true,
                            items: [
                              {
                                xtype:'hidden',
                                name: 'idactivo',
                                value: this.idactivo
                              },
                              {
                                xtype:'fieldset',
                                id:"chkmantenimiento",
                                title: 'Mantenimiento',
                                collapsed: true,
                                checkboxToggle:true,
                                listeners:{
                                    collapse: function(p){
                                        Ext.getCmp("chkseguimiento").expand();
                                    },
                                    expand: function(p){
                                        Ext.getCmp("chkseguimiento").collapse();
                                        Ext.getCmp("chkseguimiento").disable();
                                        
                                    }
                                },
                                defaults: {
                                            // applied to each contained panel
                                            bodyStyle:'padding-right:25px;background-color:#EEEEEE',
                                            bodyStyle:'padding-left:25px;background-color:#EEEEEE',
                                            border: false
                                        },
                                items:[
                                    {
                                        layout:'column',
                                        columns:2,
                                        columnWidth:.5,
                                        border: false,
                                        id:"total",
                                        defaults: {
                                            // applied to each contained panel
                                            bodyStyle:'padding-right:15px;background-color:#EEEEEE',
                                            bodyStyle:'padding-left:15px;background-color:#EEEEEE',
                                            border: false
                                        },
                                        items:[
                                            {
                                            layout: 'form',
                                            labelAlign: 'top',
                                               items:[
                                                   {
                                                    xtype:'fieldset',
                                                    autoHeight:true,
                                                    id:"chkespecificaciones",
                                                    title: 'Especificaciones Generales',
                                                    checkboxName: "checkboxEspMantenimiento",
                                                    layout:"form",
                                                    //anchor:'85%',
                                                    width: 245,
                                                    items:[
                                                        {
                                                            xtype:'fieldset',                                                              
                                                            border:false,
                                                            items:[
                                                                {
                                                                    xtype:'datefield',
                                                                    fieldLabel: 'Fecha Mantenimiento',
                                                                    name : 'fchMantenimiento',
                                                                    //anchor:'100%',
                                                                    //height: 300,
                                                                    width: 100,
                                                                    format: 'Y-m-d',
                                                                    value: '<?=date("Y-m-d")?>'
                                                                }]
                                                        },
                                                        {
                                                            layout:'table',
                                                            layoutConfig: {
                                                                columns: 1
                                                                },
                                                            border: false,
                                                            bodyStyle:'padding-right:20px;background-color:#EEEEEE',
                                                            autoHeight:true,
                                                            items:[
                                                                <?foreach ($etapas as $etapa){?>
                                                                {
                                                                    xtype: 'checkbox',
                                                                    boxLabel: '<?=$etapa->getCaEtapa()?>',
                                                                    id: '<?=$etapa->getCaIdetapa()?>',
                                                                    name: '<?=$etapa->getCaIdetapa()?>'
                                                                },
                                                                <?}?>
                                                                {
                                                                    xtype:'hidden',
                                                                    name: 'idactivo',
                                                                    value: this.idactivo
                                                                }]
                                                        }]
                                                   }]
                                           },
                                           {
                                            layout: 'form',
                                            labelAlign: 'top',
                                            items: [
                                                {
                                                    xtype:'fieldset',
                                                    id:"chkobservaciones",
                                                    title: 'Observaciones',
                                                    checkboxName: "checkboxObservaciones",
                                                    height:245,
                                                    anchor:'85%',
                                                    bodyStyle:'padding-left:5px;',
                                                    items:[
                                                        {
                                                            xtype:'htmleditor',
                                                            name:'text_mantenimiento',
                                                            height:180,
                                                            width: 400,
                                                            enableFont: false,
                                                            enableFontSize: false,
                                                            enableLinks:  false,
                                                            enableSourceEdit : false,
                                                            enableColors : false,
                                                            enableLists: false,
                                                            allowBlank: false
                                                        }]
                                                }]
                                           }]
                                   }]
                              },
                              {
                                xtype:'fieldset',
                                id:"chkseguimiento",
                                title: 'Seguimiento',
                                collapsed: false,
                                checkboxToggle:true,
                                defaults: {
                                            // applied to each contained panel
                                            bodyStyle:'padding-right:25px;background-color:#EEEEEE',
                                            bodyStyle:'padding-left:25px;background-color:#EEEEEE',
                                            border: false
                                        },
                                items:[
                                    {
                                        xtype:'htmleditor',
                                        name:'text_seguimiento',
                                        title:'Seguimiento y/o Observaciones',
                                        hideLabel: true,
                                        height:200,
                                        anchor:'98%',
                                        enableFont: false,
                                        enableFontSize: false,
                                        enableLinks:  false,
                                        enableSourceEdit : false,
                                        enableColors : false,
                                        enableLists: false,
                                        allowBlank: false
                                    }]
                              
                              }]
                        })
                                    
    this.buttons = [
        {
            text: 'Guardar',
            handler: this.guardar,
            scope: this
        },
        {
            text: 'Cancelar',
            handler: this.close.createDelegate(this, [])
        }
     ];

     

    NuevoSeguimientoWindow.superclass.constructor.call(this, {
        title: 'Nuevo Seguimiento Activo # '+this.idactivo,
        autoHeight: true,
        width: 800,
        //height: 400,
        resizable: false,
        plain:true,
        modal: true,        
        y: 100,
        autoScroll: true,
        closeAction: 'close',
        buttons: this.buttons,
        items: this.subpanel
    });

    this.addEvents({add:true});
}

Ext.extend(NuevoSeguimientoWindow, Ext.Window, {


    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }

        //this.grid.store.setBaseParam( "idproject", this.idproject);
        //this.grid.store.load();

        NuevoSeguimientoWindow.superclass.show.apply(this, arguments);
    },

    guardar: function(){
        var panel = Ext.getCmp("seguimiento-activo-panel");

        var form = panel.getForm();
        var win = this;

        var opener = this.opener;
        if( form.isValid() ){

            form.submit({
                success:function(form,action){

                    //Ext.Msg.alert( "Información" );
                    win.close();

                    if( opener ){
                        var cmp = Ext.getCmp(opener);
                        if( cmp ){
                            cmp.body.update(action.result.info);
                        }
                    }

                    Ext.MessageBox.alert('Sistema de Activos:', 'El seguimiento se ha guardado correctamente');
                },
                // standardSubmit: false,
                failure:function(form,action){
                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                }//end failure block
            });
        }else{
            Ext.MessageBox.alert('Sistema de Activos:', '¡Por favor complete los campos subrayados!');
        }
        
    }

});

</script>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
