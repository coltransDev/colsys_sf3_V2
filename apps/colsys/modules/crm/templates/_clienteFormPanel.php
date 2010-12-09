<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$saludos = array( "Se�or" => "Se�or", "Se�ora" => "Se�ora", "Doctor" => "Doctor", "Doctora" => "Doctora", "Ingeniero" => "Ingeniero", "Ingeniera" => "Ingeniera", "Arquitecto" => "Arquitecto", "Arquitecta" => "Arquitecta" );
$letras  = array(" ","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P", "Q", "R", "S");
$parte_1 = array(" ","Avenida","Autopista","Calle","Carrera","Circular","Diagonal","Transversal","Kil�metro","Via");
$parte_2 = array(" ","Bis");
$parte_3 = array(" ","Norte","Sur","Este","Oeste");
$numero = array("No.","");
$localidades = array(
    "Bogot�"=>array("Usaqu�n","Chapinero","Santaf�","San Crist�bal","Usme","Tunjuelito","Bosa","Kennedy","Fontib�n","Engativa","Suba","Barrios Unidos","Teusaquillo","M�rtires","Antonio Nari�o","Puente Aranda","Candelaria","Rafael Uribe","Ciudad Bol�var"),
    "C/marca"=>array("Sumapaz","Cajic�","Chia","Cota","La Calera","Funza","Mosquera","Sibat�","Siberia","Soacha","Tocancip�"),
    "B/quilla"=>array("Zona Centro","Zona Norte","Zona Suroriente","Zona Franca BAQ","Circunvalar","V�a 40","Calle 30"),
    "Otras"=>array("Otra")
    );
$sexos = array("Femenino","Masculino");
$calificaciones = array("A","B","C","D","E");
$riesgos = array("Sin","M�nimo","Medio","Alto");
$campos = array("Nombre del Cliente" => "ca_compania", "Representante Legal" => "ca_ncompleto", "N.i.t." => "ca_idcliente", "Calificaci�n" => "ca_calificacion", "Coordinador Aduana" => "ca_coordinador", "Actividad Econ�mica" => "ca_actividad", "Sector Econ�mico" => "ca_sector", "Localidad" => "ca_localidad", "Ciudad" => "ca_ciudad", "Contrato Agenciamiento" => "ca_stdcotratoag");  // Arreglo con las opciones de busqueda
$bdatos = array("Maestra Clientes", "Mis Clientes", "Clientes Libres");  // Arreglo con los lugares donde buscar
$tipos = array("Llamada", "Visita", "Correo Electr�nico", "Correspondencia", "Cerrar Caso");
$estados = array("Potencial","Activo","Vetado");
$libestados = array("Vigente","Congelada");
$sstatus = array("","Vetado");
$empresas= array("Coltrans","Colmas");
$circular=array("Sin","Vencido","Vigente");
$presentacion=array("Detallado","Columnas");
$entidades=array("Vigente","Fusionada","Disuelta","Liquidada");
$tiposnits=array("","Agente","Proveedor");


$tipos = $sf_data->getRaw("tipos");


?>
<script type="text/javascript">
    ClienteFormPanel = function( config ) {
        Ext.apply(this, config);
        this.ctxRecord = null;


        

        this.items = [{
                xtype:'tabpanel',
                buttonAlign: 'left',
                activeTab: 0,
                defaults:{autoHeight:true, bodyStyle:'padding:10px'},
                deferredRender:false,
            
            
                items:[{
                        title:'Informaci�n General',
                        layout:'form',
                        items: [
                            {
                                xtype:'hidden',
                                name: 'idcliente'
                            },
                            {
                                xtype: 'fieldset',
                                border: true,
                                title: 'Identificaci�n',
                                defaults: {
                                    // applied to each contained panel
                                    bodyStyle:'padding-right:20px',
                                    border: false
                                },

                                items: [
                                    {                                       
                                        xtype:          'combo',
                                        mode:           'local',
                                        triggerAction:  'all',
                                        forceSelection: true,
                                        editable:       false,
                                        fieldLabel:     'Tipo Identificaci�n',
                                        name:           'tipo_identificacion',
                                        hiddenName:     'tipo_identificacion',
                                        displayField:   'name',
                                        valueField:     'value',
                                        store:          new Ext.data.JsonStore({
                                            fields : [ 'name', 'value'],
                                            data   : [
                                                <?
                                                $i=0;
                                                foreach( $tipos as $val ){
                                                    echo ($i++!=0)?",":"";
                                                    echo "{ value: '".$val->getCaIdentificacion()."', name: '".$val->getCaValor()."'}";
                                                }
                                                ?>
                                            ]
                                        })
                                    },
                                    {
                                        xtype: 'compositefield',
                                        fieldLabel: 'NIT',
                                        msgTarget : 'side',
                                        defaults: {
                                            //flex: 1
                                        },
                                        items: [
                                            {
                                                xtype:'numberfield',
                                                fieldLabel: 'ID',
                                                name: 'idalterno',
                                                value: '',
                                                allowBlank:false,
                                                allowNegative:false,
                                                decimalPrecision : 2,
                                                width: 200
                                            },
                                            {
                                               xtype: 'displayfield',
                                               value: '-'
                                            },
                                            {
                                                xtype:'numberfield',
                                                fieldLabel: 'DV',
                                                name: 'dv',
                                                value: '',
                                                allowBlank:false,
                                                allowNegative:false,
                                                decimalPrecision : 2,
                                                minValue: 0,
                                                maxValue: 9,
                                                width: 20
                                            }

                                        ]
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Cliente',
                                        name: 'compania',
                                        value: '',
                                        allowBlank:false,
                                        width: 400
                                    }
                           
                                ]
                            },

                            {
                                xtype: 'fieldset',
                                border: true,
                                title: 'Representante Legal',
                                defaults: {
                                    // applied to each contained panel
                                    bodyStyle:'padding-right:20px',
                                    border: false
                                },

                                items: [

                                    {
                                        xtype: 'compositefield',
                                        fieldLabel: 'Titulo',
                                        msgTarget : 'side',
                                        defaults: {
                                        //    flex: 1
                                        },
                                        items: [
                                            {
                                                //the width of this field in the HBox layout is set directly
                                                //the other 2 items are given flex: 1, so will share the rest of the space
                                                width:          80,
                                                xtype:          'combo',
                                                mode:           'local',
                                                triggerAction:  'all',
                                                forceSelection: true,
                                                editable:       false,
                                                fieldLabel:     'Title',
                                                name:           'title',
                                                hiddenName:     'title',
                                                displayField:   'name',
                                                valueField:     'value',
                                                allowBlank:     false,
                                                store:          new Ext.data.JsonStore({
                                                    fields : ['name', 'value'],
                                                    data   : [
                                                        <?
                                                        $i=0;
                                                        foreach( $saludos as $key=>$val ){
                                                            echo ($i++!=0)?",":"";
                                                            echo "{name : '$key',   value: '$val'}";
                                                        }
                                                        ?>
                                                    ]
                                                })
                                            },
                                            {
                                               xtype: 'displayfield',
                                               value: 'Nombre:'
                                            },
                                            {
                                                xtype     : 'textfield',
                                                name      : 'nombre',
                                                fieldLabel: 'Nombre',
                                                width: 200,
                                                allowBlank:     false
                                            },
                                            {
                                               xtype: 'displayfield',
                                               value: 'Apellido:'
                                            },
                                            {
                                                xtype     : 'textfield',
                                                name      : 'apellido',
                                                fieldLabel: 'Apellido:',
                                                width: 200,
                                                allowBlank:     false
                                            }
                                        ]
                                    },

                                    {
                                        //the width of this field in the HBox layout is set directly
                                        //the other 2 items are given flex: 1, so will share the rest of the space
                                        width:          200,
                                        xtype:          'combo',
                                        mode:           'local',
                                        value:          '',
                                        triggerAction:  'all',
                                        forceSelection: true,
                                        editable:       true,
                                        fieldLabel:     'Title',
                                        name:           'sexo',
                                        hiddenName:     'sexo',
                                        displayField:   'name',
                                        valueField:     'value',
                                        value:          'M',
                                        allowBlank:     false,
                                        store:          new Ext.data.JsonStore({
                                            fields : ['name', 'value'],
                                            data   : [
                                                {name : 'Masculino',   value: 'M'},
                                                {name : 'Femenino',  value: 'F'}
                                        
                                            ]
                                        })
                                    }
                                    ,
                                    {
                                        xtype:'datefield',
                                        fieldLabel: 'Cumplea�os',
                                        name: 'cumpleanos',
                                        value: '',
                                        allowBlank:false,
                                        width: 200,
                                        format: "Y-m-d"
                                    }

                                ]
                            },
                            {
                                xtype: 'fieldset',
                                border: true,
                                title: 'Contacto',
                                defaults: {
                                    // applied to each contained panel
                                    bodyStyle:'padding-right:20px',
                                    border: false
                                },

                                items: [

                                    {
                                        xtype: 'compositefield',
                                        fieldLabel: 'Direcci�n',
                                        msgTarget : 'side',
                                        defaults: {
                                        //    flex: 1
                                        },
                                        items: [
                                            {
                                                //the width of this field in the HBox layout is set directly
                                                //the other 2 items are given flex: 1, so will share the rest of the space
                                                width:          80,
                                                xtype:          'combo',
                                                mode:           'local',
                                                triggerAction:  'all',
                                                forceSelection: true,
                                                editable:       true,                                                
                                                name:           'dir_1',
                                                hiddenName:     'dir_1',
                                                displayField:   'value',
                                                valueField:     'value',
                                                store:          new Ext.data.JsonStore({
                                                    fields : [ 'value'],
                                                    data   : [
                                                        <?
                                                        $i=0;
                                                        foreach( $parte_1 as $key=>$val ){
                                                            echo ($i++!=0)?",":"";
                                                            echo "{ value: '$val'}";
                                                        }
                                                        ?>                                                        
                                                    ]
                                                })
                                            },                                            
                                            {
                                                xtype     : 'textfield',
                                                name      : 'dir_2',
                                                width: 30
                                            },
                                            {
                                                //the width of this field in the HBox layout is set directly
                                                //the other 2 items are given flex: 1, so will share the rest of the space
                                                width:          50,
                                                xtype:          'combo',
                                                mode:           'local',
                                                triggerAction:  'all',
                                                forceSelection: true,
                                                editable:       true,                                                
                                                name:           'dir_3',
                                                hiddenName:     'dir_3',
                                                displayField:   'value',
                                                valueField:     'value',
                                                store:          new Ext.data.JsonStore({
                                                    fields : ['value'],
                                                    data   : [
                                                        <?
                                                        $i=0;
                                                        foreach( $letras as $key=>$val ){
                                                            echo ($i++!=0)?",":"";
                                                            echo "{ value: '$val'}";
                                                        }
                                                        ?>

                                                    ]
                                                })
                                            },
                                            {
                                               xtype: 'displayfield',
                                               value: '-'
                                            },
                                            {
                                                //the width of this field in the HBox layout is set directly
                                                //the other 2 items are given flex: 1, so will share the rest of the space
                                                width:          50,
                                                xtype:          'combo',
                                                mode:           'local',
                                                triggerAction:  'all',
                                                forceSelection: true,
                                                editable:       true,                                               
                                                name:           'dir_4',
                                                hiddenName:     'dir_4',
                                                displayField:   'value',
                                                valueField:     'value',
                                                store:          new Ext.data.JsonStore({
                                                    fields : ['value'],
                                                    data   : [
                                                        <?
                                                        $i=0;
                                                        foreach( $parte_2 as $key=>$val ){
                                                            echo ($i++!=0)?",":"";
                                                            echo "{ value: '$val'}";
                                                        }
                                                        ?>

                                                    ]
                                                })
                                            },
                                            {
                                                //the width of this field in the HBox layout is set directly
                                                //the other 2 items are given flex: 1, so will share the rest of the space
                                                width:          50,
                                                xtype:          'combo',
                                                mode:           'local',
                                                triggerAction:  'all',
                                                forceSelection: true,
                                                editable:       true,                                                
                                                name:           'dir_5',
                                                hiddenName:     'dir_5',
                                                displayField:   'value',
                                                valueField:     'value',
                                                store:          new Ext.data.JsonStore({
                                                    fields : ['value'],
                                                    data   : [
                                                        <?
                                                        $i=0;
                                                        foreach( $numero as $key=>$val ){
                                                            echo ($i++!=0)?",":"";
                                                            echo "{ value: '$val'}";
                                                        }
                                                        ?>

                                                    ]
                                                })
                                            },
                                            {
                                                xtype     : 'numberfield',
                                                name      : 'dir_6',
                                                fieldLabel: 'dir_6',
                                                width: 30
                                            },
                                            {
                                                //the width of this field in the HBox layout is set directly
                                                //the other 2 items are given flex: 1, so will share the rest of the space
                                                width:          50,
                                                xtype:          'combo',
                                                mode:           'local',
                                                triggerAction:  'all',
                                                forceSelection: true,
                                                editable:       true,                                                
                                                name:           'dir_7',
                                                hiddenName:     'dir_7',
                                                displayField:   'value',
                                                valueField:     'value',
                                                store:          new Ext.data.JsonStore({
                                                    fields : ['value'],
                                                    data   : [
                                                        <?
                                                        $i=0;
                                                        foreach( $letras as $key=>$val ){
                                                            echo ($i++!=0)?",":"";
                                                            echo "{ value: '$val'}";
                                                        }
                                                        ?>

                                                    ]
                                                })
                                            },
                                            {
                                                //the width of this field in the HBox layout is set directly
                                                //the other 2 items are given flex: 1, so will share the rest of the space
                                                width:          50,
                                                xtype:          'combo',
                                                mode:           'local',
                                                triggerAction:  'all',
                                                forceSelection: true,
                                                editable:       true,                                                
                                                name:           'dir_8',
                                                hiddenName:     'dir_8',
                                                displayField:   'value',
                                                valueField:     'value',
                                                store:          new Ext.data.JsonStore({
                                                    fields : ['value'],
                                                    data   : [
                                                        <?
                                                        $i=0;
                                                        foreach( $parte_2 as $key=>$val ){
                                                            echo ($i++!=0)?",":"";
                                                            echo "{ value: '$val'}";
                                                        }
                                                        ?>

                                                    ]
                                                })
                                            },
                                            {
                                                xtype     : 'numberfield',
                                                name      : 'dir_9',
                                                fieldLabel: 'dir_9',
                                                width: 30
                                            },
                                            {
                                                //the width of this field in the HBox layout is set directly
                                                //the other 2 items are given flex: 1, so will share the rest of the space
                                                width:          80,
                                                xtype:          'combo',
                                                mode:           'local',
                                                triggerAction:  'all',
                                                forceSelection: true,
                                                editable:       true,                                                
                                                name:           'dir_10',
                                                hiddenName:     'dir_10',
                                                displayField:   'value',
                                                valueField:     'value',
                                                store:          new Ext.data.JsonStore({
                                                    fields : ['value'],
                                                    data   : [
                                                        <?
                                                        $i=0;
                                                        foreach( $parte_3 as $key=>$val ){
                                                            echo ($i++!=0)?",":"";
                                                            echo "{ value: '$val'}";
                                                        }
                                                        ?>

                                                    ]
                                                })
                                            }
                                        ]
                                    },
                                    {
                                        xtype: 'compositefield',
                                        fieldLabel: 'Oficina',
                                        msgTarget : 'side',
                                        //hideLabel: true,
                                        defaults: {
                                        //    flex: 1
                                        },
                                        items: [
                                            
                                            {
                                                xtype     : 'numberfield',
                                                name      : 'oficina',
                                                fieldLabel: 'oficina',
                                                width: 80
                                            },
                                            {
                                               xtype: 'displayfield',
                                               value: 'Torre'
                                            },
                                            {
                                                xtype     : 'numberfield',
                                                name      : 'torre',
                                                fieldLabel: 'torre',
                                                width: 80
                                            },
                                            {
                                               xtype: 'displayfield',
                                               value: 'Bloque'
                                            },
                                            {
                                                xtype     : 'numberfield',
                                                name      : 'bloque',
                                                fieldLabel: 'bloque',
                                                width: 80
                                            },
                                            
                                            {
                                               xtype: 'displayfield',
                                               value: 'Interior'
                                            },
                                            {
                                                xtype     : 'numberfield',
                                                name      : 'interior',
                                                fieldLabel: 'interior',
                                                width: 80
                                            }

                                        ]
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Complemento',
                                        name: 'complemento',
                                        value: '',
                                        allowBlank:true,
                                        width: 200
                                    },
                                    {
                                        xtype: 'compositefield',
                                        fieldLabel: 'Tel�fono',
                                        msgTarget : 'side',
                                        //hideLabel: true,
                                        defaults: {
                                        //    flex: 1
                                        },
                                        items: [

                                            {
                                                xtype     : 'textfield',
                                                name      : 'phone',
                                                fieldLabel: 'phone',
                                                width: 80
                                            },
                                            {
                                               xtype: 'displayfield',
                                               value: 'Fax'
                                            },
                                            {
                                                xtype     : 'textfield',
                                                name      : 'fax',
                                                fieldLabel: 'fax',
                                                width: 80
                                            }
                                        ]
                                    },
                                    {
                                        xtype     : 'textfield',
                                        name      : 'ciudad',
                                        fieldLabel: 'Ciudad',
                                        width: 200
                                    },
                                    {
                                        xtype     : 'textfield',
                                        name      : 'email',
                                        fieldLabel: 'e-mail',
                                        width: 200
                                    },
                                    {
                                        xtype     : 'textfield',
                                        name      : 'website',
                                        fieldLabel: 'P�gina Web',
                                        width: 200
                                    }
                                ]
                            },

                            {
                                xtype: 'fieldset',
                                border: true,
                                title: 'Actividad Econ�mica',
                                defaults: {
                                    // applied to each contained panel
                                    bodyStyle:'padding-right:20px',
                                    border: false
                                },
                                items: [
                                    
                                    {
                                        xtype:'textarea',
                                        fieldLabel: 'Actividad Econ�mica',
                                        name: 'actividad',
                                        value: '',
                                        allowBlank:true,
                                        width: 400
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Sector Econ�mico',
                                        name: 'sectoreco',
                                        value: '',
                                        allowBlank:false,
                                        width: 400
                                    },
                                    {
                                        //the width of this field in the HBox layout is set directly
                                        //the other 2 items are given flex: 1, so will share the rest of the space
                                        width:          50,
                                        xtype:          'combo',
                                        mode:           'local',
                                        triggerAction:  'all',
                                        forceSelection: true,
                                        editable:       false,
                                        fieldLabel:     'Reportado en Ley Insolvencia Eco.',
                                        name:           'leyinsolvencia',
                                        hiddenName:     'leyinsolvencia',
                                        displayField:   'name',
                                        valueField:     'value',
                                        value:          'No',
                                        store:          new Ext.data.JsonStore({
                                            fields : ['name', 'value'],
                                            data   : [
                                                {name : 'S�',   value: 'S�'},
                                                {name : 'No',  value: 'No'}
                                            ]
                                        })
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Comentario',
                                        name: 'comentario',
                                        value: '',
                                        allowBlank:true,
                                        width: 400
                                    }

                                ]
                            },
                            {
                                xtype: 'fieldset',
                                border: true,
                                title: 'Status',
                                defaults: {
                                    // applied to each contained panel
                                    bodyStyle:'padding-right:20px',
                                    border: false
                                },
                                items: [
                                    {
                                        xtype:'datefield',
                                        fieldLabel: 'Contrato Agenciamiento/�ltimo Radicado',
                                        name: 'fchcotratoag',
                                        value: 'fchcotratoag',
                                        allowBlank:true,
                                        width: 100,
                                        format: "Y-m-d"
                                    },                                    
                                    {
                                        //the width of this field in the HBox layout is set directly
                                        //the other 2 items are given flex: 1, so will share the rest of the space
                                        width:          100,
                                        xtype:          'combo',
                                        mode:           'local',
                                        triggerAction:  'all',
                                        forceSelection: true,
                                        editable:       false,
                                        fieldLabel:     'Reportado en Lista Clinton.',
                                        name:           'listaclinton',
                                        hiddenName:     'listaclinton',
                                        displayField:   'name',
                                        valueField:     'value',
                                        value:          'No',
                                        store:          new Ext.data.JsonStore({
                                            fields : ['name', 'value'],
                                            data   : [
                                                {name : 'S�',   value: 'S�'},
                                                {name : 'No',  value: 'No'}
                                            ]
                                        })
                                    },                                    
                                    {
                                        //the width of this field in the HBox layout is set directly
                                        //the other 2 items are given flex: 1, so will share the rest of the space
                                        width:          100,
                                        xtype:          'combo',
                                        mode:           'local',
                                        triggerAction:  'all',
                                        forceSelection: true,
                                        editable:       false,
                                        fieldLabel:     'Status',
                                        name:           'status',
                                        hiddenName:     'status',
                                        displayField:   'name',
                                        valueField:     'value',
                                        store:          new Ext.data.JsonStore({
                                            fields : ['name', 'value'],
                                            data   : [
                                                {name : '',   value: ''},
                                                {name : 'Vetado',  value: 'Vetado'}
                                            ]
                                        })
                                    },
                                    {
                                        //the width of this field in the HBox layout is set directly
                                        //the other 2 items are given flex: 1, so will share the rest of the space
                                        width:          100,
                                        xtype:          'combo',
                                        mode:           'local',
                                        triggerAction:  'all',
                                        forceSelection: true,
                                        editable:       false,
                                        fieldLabel:     'Calificaci�n',
                                        name:           'calificacion',
                                        hiddenName:     'calificacion',
                                        value:          'A',
                                        displayField:   'name',
                                        valueField:     'value',
                                        store:          new Ext.data.JsonStore({
                                            fields : ['name', 'value'],
                                            data   : [
                                                {name : 'A',  value: 'A'},
                                                {name : 'B',  value: 'B'},
                                                {name : 'C',  value: 'C'},
                                                {name : 'D',  value: 'D'},
                                                {name : 'E',  value: 'E'}
                                            ]
                                        })
                                    },
                                    {
                                        //the width of this field in the HBox layout is set directly
                                        //the other 2 items are given flex: 1, so will share the rest of the space
                                        width:          100,
                                        xtype:          'combo',
                                        mode:           'local',
                                        triggerAction:  'all',
                                        forceSelection: true,
                                        editable:       false,
                                        fieldLabel:     'Entidad',
                                        name:           'entidad',
                                        hiddenName:     'entidad',
                                        displayField:   'name',
                                        valueField:     'value',
                                        value:          'Vigente',
                                        store:          new Ext.data.JsonStore({
                                            fields : ['name', 'value'],
                                            data   : [
                                                {name : 'Vigente',  value: 'Vigente'},
                                                {name : 'Fusionada',  value: 'Fusionada'},
                                                {name : 'Disuelta',  value: 'Disuelta'},
                                                {name : 'Liquidada',  value: 'Liquidada'}
                                            ]
                                        })
                                    }

                                ]
                            }
                        ]
                    },{
                        title:'Preferencias',
                        layout:'form',
                        defaults: {width: 230},
                        defaultType: 'textfield',
                        labelAlign: "top",
                        items: [{
                                xtype: 'textarea',
                                width: 500,
                                autoGrow: true,
                                fieldLabel: 'Preferencias',
                                name: 'preferencias',
                                value: '',
                                allowBlank:true
                            }]
                    }]

            }];

        this.buttonns = [
            {
                text: 'Guardar',
                handler: this.guardarItem,
                scope: this
            },
            {
                text: 'Cancelar',
                handler: function(){
                    Ext.getCmp("edit-factura-win").close();
                }
            }

        ];
       
        
        ClienteFormPanel.superclass.constructor.call(this, {
            autoHeight: true,
            autoWidth: true,
            buttonAlign: "center",
            id: 'form-cliente',
            items: this.items,
            buttons: this.buttonns
        
        });

        //this.addEvents({add:true});
    }

    Ext.extend(ClienteFormPanel, Ext.form.FormPanel, {
        guardarItem: function(){
            
            var panel  = Ext.getCmp("form-cliente");
            var form = panel.getForm();
            var gridId = this.gridId;
            if( form.isValid() ){
                var gridOpener = this.gridOpener;
                form.submit({
                    url: "<?= url_for("crm/guardarCliente") ?>",
                    //scope:this,
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    success:function(form,action){
                        var win = Ext.getCmp("edit-cliente-win");
                        if( win ){
                            win.close();
                        }

                        if( gridId ){
                            var grid = Ext.getCmp( gridId );
                            if( grid ){
                                grid.recargar();
                            }
                        }



                    },
                    // standardSubmit: false,
                    failure:function(form,action){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                    }//end failure block
                });
            }else{
                Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
            }

        },


        /**
         * Form onRender override
         */
        onRender:function() {

            // call parent
            ClienteFormPanel.superclass.onRender.apply(this, arguments);

            // set wait message target
           
            if( this.idcliente ){
                this.getForm().waitMsgTarget = this.getEl();
                var form  = this.getForm();
                this.load({
                    url:'<?= url_for("crm/datosClienteFormPanel") ?>',
                    waitMsg:'Cargando...',
                    params:{idcliente:this.idcliente},

                    success:function(response,options){
                        this.res = Ext.util.JSON.decode( options.response.responseText );
                        //form.findField("ids").setRawValue(this.res.data.ids);
                        //form.findField("ids").hiddenField.value = this.res.data.ids_id;
                    }

                });
            }

        }

        



    });

</script>

