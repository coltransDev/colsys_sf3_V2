<link rel="stylesheet" type="text/css"  href="/js/ext6/build/packages/ux/classic/classic/resources/ux-all-debug.css"/>
<style>
.app-dashboard {
    background-image: url(/js/Colsys/Status/resources/images/square.gif);
}

.imgCls{
    moz-box-shadow: 5px 5px 5px #ccc; 
    -webkit-box-shadow: 5px 5px 5px #ccc; 
    box-shadow: 5px 5px 5px #ccc; 
    -moz-border-radius:5px; 
    -webkit-border-radius:5px; 
    border-radius:5px;
}

/*.x-form-checkbox-default, .x-form-radio-default {
    width: 45px;
    height: 45px;
}*/



.smileClass .x-form-radio-default {
    background: url(/js/ext-6.5.0/build/classic/theme-crisp/resources/images/form/smile_happy.png) no-repeat;    
}

.smileClass45 .x-form-radio-default {
    background: url(/js/ext-6.5.0/build/classic/theme-crisp/resources/images/form/smile_happy45.png) no-repeat;    
    width: 45px;
    height: 45px;
}

.smileClassChecked45 .x-form-radio-default {
    background: url(/js/ext-6.5.0/build/classic/theme-crisp/resources/images/form/smiles45.png) no-repeat;
    background-position: -45px -45px;
}

.neutralClass .x-form-radio-default{
    background: url(/js/ext-6.5.0/build/classic/theme-crisp/resources/images/form/smile_neutral.png) no-repeat;    
}

.neutralClass45 .x-form-radio-default{
    background: url(/js/ext-6.5.0/build/classic/theme-crisp/resources/images/form/smile_neutral45.png) no-repeat;    
    width: 45px;
    height: 45px;
}

.neutralClassChecked45 .x-form-radio-default{
    background: url(/js/ext-6.5.0/build/classic/theme-crisp/resources/images/form/smiles45.png) no-repeat;
    background-position: 0 -45px;
}

.ungryClass .x-form-radio-default{
    background: url(/js/ext-6.5.0/build/classic/theme-crisp/resources/images/form/smile_ungry.png) no-repeat;    
}

.ungryClass45 .x-form-radio-default{
    background: url(/js/ext-6.5.0/build/classic/theme-crisp/resources/images/form/smile_ungry45.png) no-repeat;    
    width: 45px;
    height: 45px;
}

.ungryClassChecked45 .x-form-radio-default{
    background: url(/js/ext-6.5.0/build/classic/theme-crisp/resources/images/form/smiles45.png) no-repeat;
    background-position: -45px 0px;
}

</style>

<table align="center" width="98%" cellspacing="0" border="0" cellpading="0">
    <tr><td><div id="panel"></div></td></tr>
</table>

<script>
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Ext.ux.rating':'/js/ext5/examples/ux/rating/'
        }
    });

    Ext.require([
        'Ext.ux.rating.Picker'
    ]);
    
    Ext.onReady(function() {
        Ext.tip.QuickTipManager.init();
        
        var navigate = function(panel, direction){
            // This routine could contain business logic required to manage the navigation steps.
            // It would call setActiveItem as needed, manage navigation button state, handle any
            // branching logic that might be required, handle alternate actions like cancellation
            // or finalization, etc.  A complete wizard implementation could get pretty
            // sophisticated depending on the complexity required, and should probably be
            // done as a subclass of CardLayout in a real-world implementation.
            var layout = panel.getLayout();
            layout[direction]();
            Ext.getCmp('move-prev').setDisabled(!layout.getPrev());
            Ext.getCmp('move-next').setDisabled(!layout.getNext());
        };

        Ext.create('Ext.container.Viewport', {
            renderTo: 'panel',
            layout: {
                type: 'vbox',
                align: 'stretch'
            },
            items: [{
                xtype: 'panel',
                layout: 'border',
                items: [{                
                    xtype: 'panel',
                    scrollable:true,
                    region: 'center',
                    bodyCls: 'app-dashboard',
                    padding: 15,           
                    defaults:{
                        margin: '10 0 0 0'
                    },
                    layout: {
                        type: 'vbox',
                        align: 'center'
                    },
                    contentPaddingProperty: 'padding',
                    items:[{
                        xtype: 'image',
                        cls: 'imgCls',
                        id: 'logo',
                        height: 60,
                        width: 280,
                        shadow: 'sides',
                        alt: 'logo-colmas'//,
                        //src: 'http://www.colmas.com.co/templates/colmas/images/logo_colmas_transparente.png'
                    },
                    {
                        xtype: 'form',
                        id: 'formulario',
                        width: 600,
                        //height: 350,
                        itemId: 'targetPanel',
                        //layout: 'card',
                        bodyStyle: 'padding:15px',
                        defaults: {
                            // applied to each contained panel
                            //border: false,
                            bodyPadding: 15,
                        },
                        title: 'Encuesta de satisfacción del Cliente',                        
                        //bodyPadding: 15,                        
                        items: [{
                            id: 'encabezado',                            
                            //html: 'En esta encuesta queremos evaluar la calidad de nuestro servicio de Agenciamiento de Aduana. Por favor califique de 1 a 5 los siguientes aspectos en donde 1 es Deficiente y 5 es Excelente:',
                            border: 0,
                            padding: '5 2 15 2',
                            items:[
                                {
                                    xtype: 'label',
                                    text: 'En esta encuesta queremos evaluar la calidad de nuestro servicio de Agenciamiento de Aduana. Por favor califique de 1 a 5 los siguientes aspectos en donde 1 es Deficiente y 5 es Excelente:'                                    
                                },
                                {
                                    xtype: 'fieldcontainer',                                    
                                    margin: '30 0 0 0',
                                    //fieldLabel: 'Toppings',
                                    defaultType: 'checkboxfield',
                                    items: [
                                        {
                                            boxLabel  : 'Importación Aérea',
                                            name      : 'topping',
                                            inputValue: '1',
                                            id        : 'checkbox1'
                                        }, {
                                            boxLabel  : 'Importación Aérea',
                                            name      : 'topping',
                                            inputValue: '2',
                                            //checked   : true,
                                            id        : 'checkbox2'
                                        }, {
                                            boxLabel  : 'Exportaciones',
                                            name      : 'topping',
                                            inputValue: '3',
                                            id        : 'checkbox3'
                                        }
                                    ]
                                }
                            ]
                        }],
                        buttons: [{
                            text: 'Siguiente',
                            disabled: true,
                            formBind: true,
                            handler: function(){
                                console.log(this.up("form"));
                                console.log(Ext.getCmp("encabezado").setHidden(true));
                                Ext.getCmp("encabezado").setHidden(true);
                                
                                var me = this.up("form");
                                me.idformulario = <?=$idformulario?>;
                                me.idcontacto = <?=$idcontacto?>;
                                me.tipo = <?=$tipo?>;
                                me.idstatus = '<?=$idstatus?>';
                                me.idcliente = '<?=$idcliente?>';
                                //console.log(me);
                                Ext.Ajax.request({
                                    waitMsg: 'Enviando...',
                                    url: '/formulario/datosPreguntas',
                                    params: {
                                        idformulario: me.idformulario
                                    },
                                    failure: function (response, options) {
                                        alert(response.responseText);
                                        Ext.Msg.hide();
                                        alert("No fue posible cargar las preguntas del formulario!");
                                    },
                                    success: function (response, options) {
                                        var res = Ext.util.JSON.decode(response.responseText);
                                        console.log(res.data);
                                        //console.log("cant preguntas");
                                        console.log(res.data.length);
                                        var cantidad = res.data.length;
                                        $.each(res.data, function (key, objPregunta) {     
                                            var consecutivo = key+1;
                                            var pregunta = me.agregarPregunta(objPregunta, consecutivo, cantidad);
                                            me.add(pregunta);                  
                                        });

                                        me.up("panel").up("panel").setTitle(res.titulo);
                                        Ext.getCmp('formulario').setTitle(res.servicio);
//                                        Ext.getCmp('encabezado').setHtml(res.encabezado);
                                        Ext.getCmp('logo').setSrc(res.logo);
                                        
                                        //console.log(me);
                                        //me.buttons = []
                                    }
                                });

                            }
                        }],
                        listeners:{
                            afterrender: function() {                                
//                                var me = this;
//                                me.idformulario = <?=$idformulario?>;
//                                me.idcontacto = <?=$idcontacto?>;
//                                me.tipo = <?=$tipo?>;
//                                me.idstatus = '<?=$idstatus?>';
//                                me.idcliente = '<?=$idcliente?>';
//                                //console.log(me);
//                                Ext.Ajax.request({
//                                    waitMsg: 'Enviando...',
//                                    url: '/formulario/datosPreguntas',
//                                    params: {
//                                        idformulario: me.idformulario
//                                    },
//                                    failure: function (response, options) {
//                                        alert(response.responseText);
//                                        Ext.Msg.hide();
//                                        alert("No fue posible cargar las preguntas del formulario!");
//                                    },
//                                    success: function (response, options) {
//                                        var res = Ext.util.JSON.decode(response.responseText);
//                                        console.log(res.data);
//                                        //console.log("cant preguntas");
//                                        console.log(res.data.length);
//                                        var cantidad = res.data.length;
//                                        $.each(res.data, function (key, objPregunta) {     
//                                            var consecutivo = key+1;
//                                            var pregunta = me.agregarPregunta(objPregunta, consecutivo, cantidad);
//                                            me.add(pregunta);                  
//                                        });
//
//                                        me.up("panel").up("panel").setTitle(res.titulo);
//                                        Ext.getCmp('formulario').setTitle(res.servicio);
////                                        Ext.getCmp('encabezado').setHtml(res.encabezado);
//                                        Ext.getCmp('logo').setSrc(res.logo);
//                                        
//                                        //console.log(me);
//                                        //me.buttons = []
//                                    }
//                                });
                            }
                        },                            
                        agregarPregunta: function(objPregunta, consecutivo, cantidad){
                            //console.log(objPregunta);
                            var idpregunta = objPregunta["idpregunta"];
                            var preguntaTexto = objPregunta["pregunta"];                                
                            
                            switch(objPregunta["tipo"]){
                                case 8: //Preguntas con stars
                                    pregunta = Ext.create('Ext.form.FieldSet',{                                
                                        html: '<h3>Pregunta '+ consecutivo +' of '+ cantidad+'</h3><br/><br/>',
                                        title: '<span style="color:black;">'+preguntaTexto+'</span>',                                        
                                        defaultType: 'textfield',
                                        layout: 'column',
                                        defaults: {
                                            anchor: '100%'
                                        },
                                        hidden: objPregunta["oculto"],
                                        id:'fieldset-pregunta-'+idpregunta,
                                        items: [],
                                        listeners: {
                                            afterrender: function(t, eOpts){
                                                var servicios = objPregunta["servicios"];

                                                $.each(servicios, function(idservicio, servicio){
                                                    
                                                    var withColumn = 0.8;
                                                    if(!servicio["oculto"]){
                                                        withColumn = 0.5;
                                                        t.add({
                                                            xtype: 'label',
                                                            //forId: 'pregunta-'+idpregunta+"-idservicio-"+idservicio, 
                                                            text: servicio["nombre"],
                                                            margin: '30 0 0 0',
                                                            //margin: '0 10 0 0',
                                                            columnWidth:0.3, 
                                                        })
                                                    }

                                                    t.add(/*{
                                                            xtype: 'label',
                                                            //forId: 'pregunta-'+idpregunta+"-idservicio-"+idservicio, 
                                                            text: servicio["nombre"],
                                                            //margin: '0 10 0 0',
                                                            columnWidth:0.3, 
                                                        },*/{
                                                        xtype: 'rating',
                                                        columnWidth:withColumn,                                                        
                                                        label: servicio["nombre"],
                                                        id: 'pregunta-'+idpregunta+"-idservicio-"+idservicio, 
                                                        name: 'pregunta-'+idpregunta+"-idservicio-"+idservicio, 
                                                        selectedStyle: 'color: rgb(23, 23, 189);',
                                                        overStyle: 'color: rgb(96, 169, 23);',
                                                        obligatoria: objPregunta["obligatoria"],
                                                        tipo: "pregunta",
                                                        idpregunta: idpregunta,
                                                        idservicio: idservicio,                                                            
                                                        scale: '450%',                                        
                                                        tip: [
                                                            '<div style="white-space: nowrap;"><b>',
                                                                'Valor Actual: {[this.rank[values.value]]}',
                                                            '</b>',
                                                            '<tpl if="trackOver && tracking !== value">',
                                                                '<br><span style="color:#aaa">(Click para seleccionar ',
                                                                '{[this.rank[values.tracking]]}',
                                                                ')</span>',
                                                            '</tpl></span>',
//                                                            '<tpl if="trackOver && tracking !== value">',
//                                                                '<span style="color:"4169E1">',
//                                                                '{[this.rank[values.tracking]]}',
//                                                                '</span>',
//                                                            '</tpl>',
                                                            {
                                                                rank: objPregunta["opciones"]
                                                            }
                                                        ],
                                                        onClick: function (event) {
                                                            var value = this.valueFromEvent(event);
                                                            this.setValue(value);
                                                            var rank = objPregunta["opciones"];                                
                                                            this.up("form").child('fieldset[id=fieldset-pregunta-'+idpregunta+']').child('label[id=resultado-'+idpregunta+"-idservicio-"+idservicio+']').setText(rank[this.getTrackingValue()]);                                            
                                                        }
                                                    },
                                                    {
                                                        xtype: 'label',
                                                        columnWidth:0.2, 
                                                        margin: '30 0 0 0',
                                                        forId: 'resultado',
                                                        id:'resultado-'+idpregunta+"-idservicio-"+idservicio,
                                                        name:'resultado-'+idpregunta+"-idservicio-"+idservicio,
                                                        style: {                                                
                                                            fontSize: '12px',
                                                            color: 'blue'
                                                        }
                                                        //margin: '0 0 0 '
                                                    });                                                        
                                                });
                                                if(objPregunta["comentarios"]== 1){
                                                    t.add({
                                                        xtype     : 'textareafield',
                                                        grow      : true,
                                                        name      : 'comentarios-'+idpregunta,
                                                        id        : 'comentarios-'+idpregunta,
                                                        tipo      : "comentario",
                                                        fieldLabel: 'Observaciones',
                                                        anchor    : '100%'
                                                    });
                                                }
                                            }
                                        }
                                    });
                                    break;
                                case 9:
                                    pregunta = Ext.create('Ext.form.FieldSet',{                                
                                        title: '<span style="color:black;">'+preguntaTexto+'</span>',
                                        defaultType: 'textfield',
                                        defaults: {
                                            anchor: '100%'
                                        },
                                        hidden: objPregunta["oculto"],                 
                                        id:'fieldset-pregunta-'+idpregunta,
                                        items: [],
                                        defaults: {
                                            anchor: '100%'
                                        },
                                        listeners: {
                                            afterrender: function(t, eOpts){
                                                //console.log("dasdfas");
                                                var servicios = objPregunta["servicios"];
                                                //console.log(objPregunta);
//                                                console.log(servicios);
                                                $.each(servicios, function(idservicio, servicio){
//                                                    console.log(idservicio);
                                                    t.add({
                                                        xtype: 'radiogroup',
                                                        //fieldLabel: 'Auto Layout',
                                                        obligatoria: objPregunta["obligatoria"],
                                                        id:'pregunta-'+idpregunta+"-idservicio-"+idservicio,
                                                        tipo: "pregunta",
                                                        idpregunta: idpregunta,
                                                        idservicio:  idservicio,
                                                        //cls: 'x-check-group-alt',
                                                        //name: 'rb'+idpregunta,
                                                        defaults: {
                                                            name: 'ccType'+idpregunta,
                                                        },
                                                        items: objPregunta["opciones"],
                                                        listeners:{
                                                            change: function( t, newValue,){                                                                
                                                                eval("var value = newValue.ccType"+idpregunta+";");
                                                                var seleccion = t.child('radiofield[id=Item'+value+'-'+idpregunta+']');                                                                
                                                                
                                                                switch(value){
                                                                    case '1':                                                                        
                                                                        seleccion.checkedCls = 'ungryClass';                                                                        
                                                                        break;
                                                                    case '2':                                                                        
                                                                        seleccion.checkedCls = 'neutralClass'
                                                                        break;
                                                                    case '3':
                                                                        seleccion.checkedCls = 'smileClass'
                                                                        break;
                                                                }
                                                                this.up("form").child('fieldset[id=fieldset-pregunta-'+idpregunta+']').child('label[id=resultado-'+idpregunta+"-idservicio-"+idservicio+']').setText(seleccion.boxLabel);
                                                            }
                                                        }
                                                    },                                                    
                                                    {
                                                        xtype: 'label',
                                                        forId: 'resultado',
                                                        margin: '30 0 0 0',
                                                        id:'resultado-'+idpregunta+"-idservicio-"+idservicio,
                                                        name:'resultado-'+idpregunta+"-idservicio-"+idservicio,
                                                        tipo: "resultado",
                                                        style: {
                                                            fontSize: '12px',
                                                            color: 'blue'
                                                        }
                                                    });
                                                    
                                                    if(objPregunta["comentarios"]== 1){
                                                        t.add({
                                                            xtype     : 'textareafield',
                                                            grow      : true,
                                                            name      : 'comentarios-'+idpregunta,
                                                            id        : 'comentarios-'+idpregunta,
                                                            tipo      : "comentario",
                                                            fieldLabel: 'Observaciones',
                                                            anchor    : '100%'
                                                        });
                                                    }
                                                });
                                            }
                                        }
                                    });
                                    break;
                                case 10:
                                    pregunta = Ext.create('Ext.form.FieldSet',{                                
                                        title: '<span style="color:black;">'+preguntaTexto+'</span>',
                                        defaultType: 'textfield',
                                        defaults: {
                                            anchor: '100%'
                                        },
                                        hidden: objPregunta["oculto"],                 
                                        id:'fieldset-pregunta-'+idpregunta,
                                        items: [],
                                        defaults: {
                                            anchor: '100%'
                                        },
                                        listeners: {
                                            afterrender: function(t, eOpts){
                                                //console.log("dasdfas");
                                                var servicios = objPregunta["servicios"];
                                                //console.log(objPregunta);
//                                                console.log(servicios);
                                                $.each(servicios, function(idservicio, servicio){
//                                                    console.log(idservicio);
                                                    t.add({
                                                        xtype: 'radiogroup',
                                                        //fieldLabel: 'Auto Layout',
                                                        obligatoria: objPregunta["obligatoria"],
                                                        id:'pregunta-'+idpregunta+"-idservicio-"+idservicio,
                                                        tipo: "pregunta",
                                                        idpregunta: idpregunta,
                                                        idservicio:  idservicio,
                                                        //cls: 'x-check-group-alt',
                                                        //name: 'rb'+idpregunta,
                                                        defaults: {
                                                            name: 'ccType'+idpregunta,
                                                        },
                                                        items: objPregunta["opciones"],
                                                        listeners:{
                                                            change: function( t, newValue,){                                                                
                                                                eval("var value = newValue.ccType"+idpregunta+";");
                                                                var seleccion = t.child('radiofield[id=Item'+value+'-'+idpregunta+']');                                                                
                                                                
                                                                switch(value){
                                                                    case '1':                                                                        
                                                                        seleccion.checkedCls = 'ungryClassChecked45';                                                                        
                                                                        break;
                                                                    case '2':                                                                        
                                                                        seleccion.checkedCls = 'neutralClassChecked45'
                                                                        break;
                                                                    case '3':
                                                                        seleccion.checkedCls = 'smileClassChecked45'
                                                                        break;
                                                                }
                                                                this.up("form").child('fieldset[id=fieldset-pregunta-'+idpregunta+']').child('label[id=resultado-'+idpregunta+"-idservicio-"+idservicio+']').setText(seleccion.boxLabel);
                                                            }
                                                        }
                                                    },                                                    
                                                    {
                                                        xtype: 'label',
                                                        forId: 'resultado',
                                                        margin: '30 0 0 0',
                                                        id:'resultado-'+idpregunta+"-idservicio-"+idservicio,
                                                        name:'resultado-'+idpregunta+"-idservicio-"+idservicio,
                                                        tipo: "resultado",
                                                        style: {
                                                            fontSize: '12px',
                                                            color: 'blue'
                                                        }
                                                    });
                                                    
                                                    if(objPregunta["comentarios"]== 1){
                                                        t.add({
                                                            xtype     : 'textareafield',
                                                            margin    : '40 0 10 0',
                                                            grow      : true,
                                                            name      : 'comentarios-'+idpregunta,
                                                            id        : 'comentarios-'+idpregunta,
                                                            tipo      : "comentario",
                                                            fieldLabel: 'Comentarios',
                                                            anchor    : '100%'
                                                        });
                                                    }
                                                });
                                            }
                                        }
                                    });
                                    break;
                                case 6: // Preguntas de seleccion

                                    pregunta = Ext.create('Ext.form.FieldSet',{
                                        html: '<h3>Pregunta '+ consecutivo +' of '+ cantidad+'</h3>',
                                        title: '<span style="color:black;">'+preguntaTexto+'</span>',
                                        defaultType: 'textfield',
                                        defaults: {
                                            anchor: '100%'
                                        },
                                        hidden: objPregunta["oculto"],                 
                                        id:'fieldset-pregunta-'+idpregunta,
                                        items: [],
                                        listeners: {
                                            afterrender: function(t, eOpts){
                                                var servicios = objPregunta["servicios"];

                                                $.each(servicios, function(idservicio, servicio){
                                                    t.add({
                                                        xtype: 'radiogroup',
                                                        obligatoria: objPregunta["obligatoria"],
                                                        id:'pregunta-'+idpregunta+"-idservicio-"+idservicio,
                                                        tipo: "pregunta",
                                                        idpregunta: idpregunta,
                                                        idservicio: idservicio,
                                                        layout: {
                                                            autoFlex: false
                                                        },
                                                        defaults: {
                                                            name: 'ccType'+idpregunta,
                                                            margin: '0 15 0 0'
                                                        },
                                                        items: objPregunta["opciones"],
                                                        listeners:{
                                                            change: function( t, newValue, oldValue, eOpts ){
                                                                //var value = newValue.ccType;
                                                                eval("var value = newValue.ccType"+idpregunta+";");
                                                                var idpreguntaHijo = objPregunta["idhijo"];
                                                                var subservicios = objPregunta["subservicios"];
                                                                
                                                                if(value=="SI"){
                                                                    t.up("form").child('fieldset[id=fieldset-pregunta-'+idpreguntaHijo+']').setHidden(false);
                                                                    $.each(subservicios, function (idservicio, servicio){
                                                                        console.log(idservicio);
                                                                        t.up("form").child('fieldset[id=fieldset-pregunta-'+idpreguntaHijo+']').child('rating[id=pregunta-'+idpreguntaHijo+'-idservicio-'+idservicio+']').obligatoria = true;
                                                                    });
                                                                    
                                                                }else{
                                                                    t.up("form").child('fieldset[id=fieldset-pregunta-'+idpreguntaHijo+']').setHidden(true);
                                                                    $.each(subservicios, function (idservicio, servicio){
                                                                        console.log(idservicio);
                                                                        t.up("form").child('fieldset[id=fieldset-pregunta-'+idpreguntaHijo+']').child('rating[id=pregunta-'+idpreguntaHijo+'-idservicio-'+idservicio+']').obligatoria = false;
                                                                    });
                                                                }
                                                                t.up("form").child('fieldset[id=fieldset-pregunta-'+idpregunta+']').child('label[id=resultado-'+idpregunta+'-idservicio-'+idservicio+']').setText(value);
                                                            }
                                                        }
                                                    },
                                                    {
                                                        xtype: 'label',
                                                        forId: 'resultado',
                                                        margin: '30 0 0 0',
                                                        id:'resultado-'+idpregunta+"-idservicio-"+idservicio,
                                                        name:'resultado-'+idpregunta+"-idservicio-"+idservicio,
                                                        tipo: "resultado",
                                                        style: {
                                                            fontSize: '12px',
                                                            color: 'blue'
                                                        }
                                                    });
                                                });

                                                if(objPregunta["comentarios"]== 1){
                                                    t.add({
                                                        xtype     : 'textareafield',
                                                        grow      : true,
                                                        name      : 'comentarios-'+idpregunta,
                                                        id        : 'comentarios-'+idpregunta,
                                                        tipo      : "comentario",
                                                        fieldLabel: 'Observaciones',
                                                        anchor    : '100%'
                                                    });
                                                }
                                            }
                                        }
                                    });
                                    break;
                            }                            
                            return pregunta;
                        }                        
                    }]
                }],
                listeners: {
                    delay: 1,
                    afterrender: function() {                            
                        this.setHeight(this.up("container").getHeight());
                    }
                }
            }]
        });
    });
</script>