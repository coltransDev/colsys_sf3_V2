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

.smileClass .x-form-radio-default {
    background: url(/js/ext-6.5.0/build/classic/theme-crisp/resources/images/form/smile_happy.png) no-repeat;
}

.neutralClass .x-form-radio-default{
    background: url(/js/ext-6.5.0/build/classic/theme-crisp/resources/images/form/smile_neutral.png) no-repeat;
}

.ungryClass .x-form-radio-default{
    background: url(/js/ext-6.5.0/build/classic/theme-crisp/resources/images/form/smile_ungry.png) no-repeat;
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
        //Ext.tip.QuickTipManager.init();

        Ext.create('Ext.panel.Panel', {
            renderTo: 'panel',
            layout: {
                type: 'vbox',
                align: 'stretch'
            },
            
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
                    height: 60,
                    width: 280,
                    shadow: 'sides',
                    alt: 'logo-colmas'//,
                    //src: 'http://www.colmas.com.co/templates/colmas/images/logo_colmas_transparente.png'
                }
                ,{
                    xtype: 'form',
                        id: 'formulario',
                    itemId: 'targetPanel',
                    //title: 'Servicio de Desaduanamiento',
                    url: '/formulario/guardarDatosEncuesta',
                    bodyPadding: 15,
                    width: 300,
                    items: [{                        
                            id: 'encabezado',
                        //html: 'En esta encuesta queremos evaluar la calidad de nuestro servicio de Agenciamiento de Aduana. Por favor califique de 1 a 5 los siguientes aspectos en donde 1 es Deficiente y 5 es Excelente:',
                        border: 0,
                        padding: '5 2 15 2'
                    }],
                    buttons: [{
                        text: 'Enviar',
                        disabled: true,
                        formBind: true,
                        handler: function(){
                            var form = this.up('form');

                            var items = form.items.items;
                            var error = 0;
                            var resultado = [];
                            $.each(items, function(key, val){
                                var preguntas = val.items.items;
                                $.each(preguntas, function(key, field){                                                                                        
                                    if(field.tipo == "pregunta"){                  
                                        switch(field.xtype){
                                            case "rating":
                                                valor = field._value;                                                        
                                                break;
                                            case "radiogroup":
                                                //valor = Ext.getCmp(field.id).getValue().ccType;                                                                                                                
                                                eval("var valor = Ext.getCmp(field.id).getValue().ccType"+field.idpregunta+";");
                                                break;
                                            default:
                                                valor = null;
                                                break;
                                        }
                                        row = new Object();
                                        row.id = field.idpregunta;
                                        row.valor = valor;
                                        row.idservicio = field.idservicio;

                                        resultado.push(row);

                                        if(field.obligatoria){
                                            title = val.title;
                                            var newTitle = null;
                                            if(!valor){
                                                error++;
                                                newTitle = title.replace("black", "red");                                                        
                                            }else{
                                                newTitle = title.replace("red", "black");
                                            }
                                            Ext.getCmp(val.id).setTitle(newTitle);                                                    
                                        }
                                    }                                            
                                });
                            });

                            if (error==0) {
                                var str = JSON.stringify(resultado);
                                //console.log(resultado);
                                var me = form;
                                if(form.idcontacto){
                                    form.submit({
                                        //url: '/formulario/guardarDatosEncuesta',
                                        waitMsg: 'Enviando...',
                                        waitTitle: 'Por favor espere...',
                                        params: {
                                            idformulario: form.idformulario,
                                            idcontacto: form.idcontacto,
                                                tipo: form.tipo,
                                                idstatus: form.idstatus,
                                                idcliente: form.idcliente,
                                            datos: str
                                        },
                                        success: function (response, options) {
                                            var res = Ext.JSON.decode(options.response.responseText);                                                       
                                            if(res.success){
                                                me.disable();
                                                alert('Muchas gracias por su tiempo!!!. Sus datos han sido diligenciados correctamente.');
                                                window.location.href = 'http://www.coltrans.com.co';
                                            }else{                                                        
                                                alert(res.errorInfo);
                                                window.location.href = 'http://www.coltrans.com.co';
                                            }
                                        },
                                        failure: function(form, action) {
                                             alert(action.result.errorInfo);
                                             window.location.href = 'http://www.coltrans.com.co';
                                        }
                                    });
                                }else{
                                    alert('Por favor seleccione la encuesta desde el enlace enviado en el correo!');
                                }
                            }else{

                               alert('Por favor complete todos los campos resaltados en rojo!');
                            }
                        }
                    }],
                    listeners:{
                        afterrender: function() {
                            var me = this;
                            me.idformulario = <?=$idformulario?>;
                            me.idcontacto = <?=$idcontacto?>;
                                me.tipo = <?=$tipo?>;
                                me.idstatus = '<?=$idstatus?>';
                                me.idcliente = '<?=$idcliente?>';
                                console.log(me);
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

                                    $.each(res.data, function (key, objPregunta) {                                                
                                        var pregunta = me.agregarPregunta(objPregunta);                                                
                                        me.add(pregunta);                                                
                                    });

                                    me.up("panel").up("panel").setTitle(res.titulo);
                                    Ext.getCmp('formulario').setTitle(res.servicio);
                                    Ext.getCmp('encabezado').setHtml(res.encabezado);
                                    Ext.getCmp('logo').setSrc(res.logo);
                                }
                            });
                        }
                    },
                    agregarPregunta: function(objPregunta){

                        var idpregunta = objPregunta["idpregunta"];
                        var preguntaTexto = objPregunta["pregunta"];                                
                            
                        switch(objPregunta["tipo"]){
                            case 8: //Preguntas con stars
                                pregunta = Ext.create('Ext.form.FieldSet',{                                
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
                                                    xtype: 'rating',
                                                    id: 'pregunta-'+idpregunta+"-idservicio-"+idservicio, 
                                                    name: 'pregunta-'+idpregunta+"-idservicio-"+idservicio, 
                                                    selectedStyle: 'color: rgb(23, 23, 189);',
                                                    overStyle: 'color: rgb(96, 169, 23);',
                                                    obligatoria: objPregunta["obligatoria"],
                                                    tipo: "pregunta",
                                                    idpregunta: idpregunta,
                                                    idservicio: idservicio,                                                            
                                                    scale: '400%',                                        
                                                    tip: [                                            
                                                        '<tpl if="trackOver && tracking !== value">',
                                                            '<span style="color:"4169E1">',
                                                            '{[this.rank[values.tracking]]}',
                                                            '</span>',
                                                        '</tpl>',
                                                        {
                                                            rank: objPregunta["opciones"]
                                                        }
                                                    ],
                                                    onClick: function (event) {
                                                        var value = this.valueFromEvent(event);
                                                        this.setValue(value);
                                                        var rank = objPregunta["opciones"];                                                                
                                                        this.up("form").child('fieldset[id=fieldset-pregunta-'+idpregunta+']').child('label[id=resultado-'+idpregunta+"-idservicio-"+idservicio+']').setText(rank[value]);                                            
                                                        //Ext.getCmp('resultado-'+idpregunta+"-idservicio-"+idservicio).setText("andrea");
                                                        //$('#resultado-'+idpregunta+"-idservicio-"+idservicio).val("andrea");
                                                    }
                                                },
                                                {
                                                    xtype: 'label',
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
                                            $.each(servicios, function(idservicio, servicio){

                                                t.add({
                                                    xtype: 'radiogroup',
                                                    //fieldLabel: 'Auto Layout',
                                                    obligatoria: objPregunta["obligatoria"],
                                                    id:'pregunta-'+idpregunta+"-idservicio-"+idservicio,
                                                    tipo: "pregunta",
                                                    idpregunta: idpregunta,
                                                    idservicio:  idservicio,
                                                    columns: 1,
                                                    //cls: 'x-check-group-alt',
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
                            case 6: // Preguntas de seleccion

                                pregunta = Ext.create('Ext.form.FieldSet',{                                
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
                                                            if(value=="SI"){                                                                        
                                                                t.up("form").child('fieldset[id=fieldset-pregunta-'+idpreguntaHijo+']').setHidden(false);
                                                                t.up("form").child('fieldset[id=fieldset-pregunta-'+idpreguntaHijo+']').child('rating[id=pregunta-'+idpreguntaHijo+'-idservicio-'+idservicio+']').obligatoria = true;
                                                            }else{
                                                                t.up("form").child('fieldset[id=fieldset-pregunta-'+idpreguntaHijo+']').setHidden(true);
                                                                t.up("form").child('fieldset[id=fieldset-pregunta-'+idpreguntaHijo+']').child('rating[id=pregunta-'+idpreguntaHijo+'-idservicio-'+idservicio+']').obligatoria = false;
                                                            }
                                                            t.up("form").child('fieldset[id=fieldset-pregunta-'+idpregunta+']').child('label[id=resultado-'+idpregunta+'-idservicio-'+idservicio+']').setText(value);
                                                        }
                                                    }
                                                },                                                        
                                                {
                                                    xtype: 'label',
                                                    forId: 'resultado',
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
            }]
        });       
    });    
</script>