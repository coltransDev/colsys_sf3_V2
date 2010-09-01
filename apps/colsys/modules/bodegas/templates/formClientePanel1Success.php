<?
/**
 * Pantalla de bienvenida para el modulo de bodega
 * @author Andrea Ramirez
 */
//print_r($bodegas);
//include_component("widgets", "widgetTipoBodega");
$transportesJ = $sf_data->getRaw("transportes");
$tbodegaJ = $sf_data->getRaw("tbodegas");
//print_r($tbodegaJ);
//print_r($transportesJ)

?>
<div class="content" align="center">
<h1>Nueva Bodega</h1>
</div>
<table align="center" width="500"><td><div id="formulario_bodegas" style="width: 500px"></div></td></table>


<script type="text/javascript">
    FormBodegaPanel = function( config ){
        Ext.apply(this, config);

            var store = new Ext.data.Store({
                proxy: new Ext.data.HttpProxy({
                    url: '<?=url_for("bodegas/datosComboNombreBodega")?>'
                }),
                baseParams: {tipo: this.tipo},
                reader: new Ext.data.JsonReader({
                    root: 'root',
                    totalProperty: 'totalCount'
                }, [
                    {name: 'nombre', mapping: 'ca_nombre'}



                ])
            });


            var combo = new Ext.form.ComboBox({
                fieldLabel: "Nombre",
                valueField:'nombre',
                displayField:'nombre',
                typeAhead: true,
                loadingText: 'Buscando...',
                forceSelection: false,
                minChars: 3,
                triggerAction: 'all',
                emptyText:'',
                selectOnFocus: true,
                lazyRender:true,
                store: store,
                id: "nombre",
                name: "nombre",
                width: 300
             });
        
        FormBodegaPanel.superclass.constructor.call(this, {
            title: 'Bodegas',
            buttonAlign: 'center',
            autoHeight:true,
            id:"form_bodegas",
            <?
             if(!$noeditable ||  $noeditable=="false" )
             {
            ?>
            tbar: [
            {
                text: 'Verificar Cambios',
                tooltip: 'Verifica que la bodega ya este creada.',
                iconCls: 'disk',  // reference to our css
                handler:this.verificar,
                id     : 'verificarbtn'
            },
			{
                text: 'Guardar Cambios',
                tooltip: 'Guarda los cambios hechos en la base de datos.',
                iconCls: 'disk',  // reference to our css
                handler:this.submit,
                id     : 'guardarbtn'
            }
            ],
            <?
            }
            ?>
            items:
            {

                xtype:'fieldset',
                title: 'Información del Cliente',
                autoHeight:true,
                //defaults: {width: 210},
                items: [
                    combo,
                    {
                        xtype: "hidden",
                        name: "idbodega",
                        id: "idbodega"
                    },
                   
                    {
                        xtype: "combo",
                        disabled:<?=$noeditable?>,
                        fieldLabel: "Tipo",
                        name: "tipo",
                        id: "tipo",
                        displayField: 'name1',
                        valueField: 'name1',
                        lazyRender:true,
                        mode:'local',
                        forceSelection: true,
                        triggerAction: 'all',
                        selectOnFocus: true,
                        store : new Ext.data.Store({
                            autoLoad : true,
                            reader: new Ext.data.JsonReader(
                            {
                                root: 'root',
                                totalProperty: 'total',
                                successProperty: 'success'
                            },
                            Ext.data.Record.create([
                                {name: 'name1'},
                            ])
                        ),
                            proxy: new Ext.data.MemoryProxy
                            (<?=json_encode(array("root" => $tbodegaJ, "total" => count($tbodegas), "success" => true))?> )
                        })

                    },
                    {
                        xtype: "combo",
                        fieldLabel: "Transporte",
                        disabled:<?=$noeditable?>,
                        name: "transporte",
                        id: "transporte",
                        displayField: 'name',
                        valueField: 'name',
                        lazyRender:true,
                        mode:'local',
                        forceSelection: true,
                        triggerAction: 'all',
                        selectOnFocus: true,
                        store : new Ext.data.Store({
                            autoLoad : true,
                            reader: new Ext.data.JsonReader(
                            {
                                root: 'root',
                                totalProperty: 'total',
                                successProperty: 'success'
                            },
                            Ext.data.Record.create([
                                {name: 'name'},
                            ])
                        ),
                            proxy: new Ext.data.MemoryProxy
                            (<?=json_encode(array("root" => $transportesJ, "total" => count($transportes), "success" => true))?> )
                        })

                    }


                ]
            }
            <?
            if($idbodega)
            {
            ?>
            //listeners: Definición del conjunto de eventos
            ,listeners:
                {
                    //render: Evento cuando muestra el componente
                    render:function()
                    {
                        this.load({
                        url:'<?=url_for("bodegas/cargarDatosBodega")?>'
                        ,waitMsg:'Cargando...'
                        ,params:{idbodega:'<?=$idbodega?>'}
                        });
                    }
                }
            <?
            }
            ?>

        });

    };

    Ext.extend(FormBodegaPanel, Ext.FormPanel, {

        verificar:function()
			 {
                Ext.Ajax.request(
                {
                    waitMsg: 'Verificando...',
                    url: '<?=url_for("bodegas/verificarBodega")?>',
                    method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        bodega: $('#nombre').val(),
                        tipo: $('#tipo').val(),
                        transporte: $('#transporte').val()
                    },

                    callback :function(options, success, response){
                        document.getElementById("resultados").innerHTML = response.responseText;
                    }
                });
				
			},
		
		submit:function()
            {
                Ext.getCmp('form_bodegas').getForm().submit({
                    url:'<?=url_for("bodegas/guardarDatosBodega")?>'
                    ,scope:this
                    ,success: function(a,b)
                        {
                            alert("Bodega Guardada correctamente");
                            location.href="<?=url_for("bodegas/index")?>";
//                            alert(a.toSource())
//                            alert(b.toSource())
                            
                        }
                    ,failure:function(a,b)
                        {
                            var res = Ext.util.JSON.decode( b.response.responseText );
                            if(res.error!="")
                                alert(res.error);
                         }
                     ,error:function()
                        {
                            alert("error")
                        }
                    ,params:{
                        //cmd:'save'
                    }
                    ,waitMsg:'Guardando...'
                });
            }
	});
    FormBodega= new FormBodegaPanel();
    FormBodega.render('formulario_bodegas');


</script>

<div id="resultados"></div>
