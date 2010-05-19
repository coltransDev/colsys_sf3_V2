<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/


/*
* Se incluyen los panales
*/
include_component("reportesNeg", "mainPanel");

include_component("reportesNeg", "formTrayectoPanel");
include_component("reportesNeg", "formClientePanel");
include_component("reportesNeg", "formPreferenciasPanel");
include_component("reportesNeg", "formCorteGuiasPanel");


include_component("widgets", "widgetTercero");


?>
<div class="content">
    <div id="panel"></div>
</div>

<script type="text/javascript">
Ext.onReady(function(){
    var bodyStyle = 'padding: 5px 5px 5px 5px;';
    

    var formPanel = new Ext.form.FormPanel({
        //border:false,
        //frame:true,
        labelWidth:80,
        buttonAlign: 'center',
        
        id: "test",
        //standardSubmit: true,
        
        items: [{
                    xtype:'tabpanel',
                    activeTab: 0,                    
                    //defaults:{autoHeight: true},
                    //deferredRender:false,
                    defaults:{
                        layout:'form'
                        // as we use deferredRender:false we mustn't
                        // render tabs into display:none containers
                        //hideMode:'offsets'
                    },
                    items:[
                        new FormTrayectoPanel() ,
                        new FormClientePanel(),
                        new FormPreferenciasPanel(),
                        new FormCorteGuiasPanel()
                    ]
        }],
        title: "Reportes de Negocio <?=$reporte->getCaIdreporte()?$reporte->getCaConsecutivo()." ".$reporte->getCaVersion()."/".$reporte->numVersiones():""?>",
        buttons: [
            {
                text   : 'Guardar',
                formBind:true,
                scope:this,
                handler: function(){
                             var form  = Ext.getCmp("test").getForm();
                             
                             if( form.isValid() ){
                                  form.submit({
                                    url: "<?=url_for("reportesNeg/guardarReporte")?>",
                                    //scope:this,
                                    waitMsg:'Guardando...',
                                    waitTitle:'Por favor espere...',
                                    success:function(response,options){

                                       alert("OK");

                                       //Ext.Msg.alert( "Msg "+response.responseText );
                                    },
                                    // standardSubmit: false,
                                    failure:function(form,action){
                                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                                    }//end failure block
                                });
                             }else{
                                 Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");

                             }
                        
                }
            },
            {
                text   : 'Cancelar'
            }
        ]
    });

    formPanel.render("panel");

});
</script>
<?



/*
* Modulos de Tooltips
*/
include_component("kbase","tooltipById", array("idcategory"=>18));
if( $opcion=="ayudas" ) {
    include_component("kbase","tooltipCreator", array("idcategory"=>18));
}
?>