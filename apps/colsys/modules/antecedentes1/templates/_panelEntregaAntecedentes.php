<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("widgets", "widgetImpoexpo");
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
?>

<script type="text/javascript">


   PanelEntregaAntecedentes = function( config ){

      Ext.apply(this, config);
      this.items = [{
            xtype: 'fieldset',
            title: 'General',
            autoHeight:true,
            layout:'column',
            columns: 2,
            items :
               [
               {
                  columnWidth:.5,
                  layout: 'form',
                  xtype: 'fieldset',
                  border:false,
                  defaultType: 'textfield',
                  items: [
                     new WidgetImpoexpo({
                        fieldLabel: 'Impoexpo',                        
                        id: 'impoexpo',
                        name:'impoexpo',
                        tabIndex:1,
                        value:'<?= Constantes::IMPO ?>'
                     }),
                     new WidgetPais({fieldLabel: 'Trafico',
                        name: 'trafico',
                        id: 'trafico',
                        hiddenName: 'idtrafico',
                        allowBlank: false,                                                                                                                    
                        tabIndex:5,
                        pais:"todos",
                        value: '<?= $antecedente->getCaIdtrafico(); ?>'
                     }),
                     new WidgetCiudad({fieldLabel: 'Ciudad',
                        id: 'ciudad',
                        name: 'ciudad',
                        tipo:"3",
                        impoexpo:"impoexpo",
                        traficoParent: "trafico",
                        hiddenName: 'idciudad',
                        allowBlank: true,
                        value: '<?= (($antecedente->getCaIdciudad() != "999-9999") ? $antecedente->getCiudad()->getCaCiudad() : '') ?>',
                        hiddenValue:"<?= (($antecedente->getCaIdciudad() != "999-9999") ? $antecedente->getCaIdciudad() : '') ?>"
                     }),
                     new WidgetCiudad({fieldLabel: 'Destino',
                        id: 'destino',
                        name: 'destino',
                        tipo:"2",
                        idtrafico: "CO-057",
                        hiddenName: 'iddestino',
                        allowBlank: true,
                        value: '<?= (($antecedente->getCaIddestino() != "999-9999") ? $antecedente->getDestino()->getCaCiudad() : '') ?>',
                        hiddenValue:"<?= (($antecedente->getCaIddestino() != "999-9999") ? $antecedente->getCaIddestino() : '') ?>"
                     }),
                     {
                        name: 'numdias',
                        fieldLabel: "# Días",
                        type: 'textfield',
                        allowBlank: false,
                        value: '<?= $antecedente->getCaDias(); ?>'
                     }
                  ]
               },
               {
                  columnWidth:.5,
                  layout: 'form',
                  border:false,
                  xtype: 'fieldset',
                  defaultType: 'textfield',
                  items: [  
                     new WidgetTransporte({fieldLabel: 'Transporte',
                        name: 'transporte',
                        id:'transporte', 
                        allowBlank:false,
                        value:'<?= ($antecedente->getCaTransporte() ? $antecedente->getCaTransporte() : Constantes::MARITIMO) ?>'
                     }),
                     new WidgetModalidad({fieldLabel: 'Modalidad',
                        id: 'modalidad',
                        name: 'modalidad',
                        linkTransporte: "transporte",
                        linkImpoexpo: "impoexpo",
                        allowBlank: true,
                        value: '<?= $antecedente->getCaModalidad(); ?>'
                     }),
                     {
                        name: "observaciones",
                        id: 'observaciones',
                        fieldLabel: "Observaciones",
                        type: 'textfield',
                        value: '<?= $antecedente->getCaObservaciones(); ?>',
                        width:330,
                        height:80
                     }
                  ]
               }                    
            ]
         }];        
      this.tbar = [
         {
            text: 'Guardar',
            iconCls: 'disk',
            handler: this.guardar,
            scope: this
         },
         {
            text: 'Borrar',
            iconCls: 'delete',
            handler: this.borrar,
            scope: this
         }
      ];

      PanelEntregaAntecedentes.superclass.constructor.call(this, {
         loadMask: {msg:'Cargando...'},
         id: 'master-antecedentes'           
      });
   };

   Ext.extend(PanelEntregaAntecedentes, Ext.form.FormPanel, {
      guardar : function(){            
         var form = this.getForm();

         if( form.isValid() ){
            form.submit({
               url: "<?= url_for("antecedentes/guardarPanelEntregaAntecedentes") ?>",
               waitMsg:'Guardando...',
               waitTitle:'Por favor espere...',
               success:function(form,action){
                  document.location = "<?= url_for("antecedentes/entregaOportuna") ?>";
               },
               failure:function(form,action){
                  Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
               }
            });
         }else{
            Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
         }
      },
      borrar : function(){            
         var form = this.getForm();

         if( form.isValid() ){
            form.submit({
               url: "<?= url_for("antecedentes/borrarPanelEntregaAntecedentes") ?>",
               waitMsg:'Borrando...',
               waitTitle:'Por favor espere...',
               success:function(form,action){
                  document.location = "<?= url_for("antecedentes/entregaOportuna") ?>";
               },
               failure:function(form,action){
                  Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
               }
            });
         }else{
            Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
         }
      }
   });
</script>
