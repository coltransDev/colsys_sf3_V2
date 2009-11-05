<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$traficos = $sf_data->getRaw("traficos");
?>
<script language="javascript">
    
    var traficos = <?=json_encode($traficos)?>;
    var cambiarImpoexpo = function(){
        var clase = document.getElementById("reporte_ca_impoexpo").value;

        //Cambia la información de los traficos dependiendo si es impo o expo
        var fldTrafico = document.getElementById("country_reporte_ca_origen");

        if( clase=="<?=Constantes::EXPO?>" ){
            fldTrafico.length=0;
            fldTrafico[fldTrafico.length] = new Option('Colombia','CO-057',false,false);
        }else{
            fldTrafico.length=0;
            for( i in traficos ){               
                if( typeof(traficos[i]['ca_idtrafico'])!="undefined" ){
                    fldTrafico[fldTrafico.length] = new Option(traficos[i]['ca_nombre'],traficos[i]['ca_idtrafico'],false,false);
                }
            }
        }

        fldTrafico.value = '<?=$reporte->getOrigen()->getCaIdtrafico()?>';
        llenarCiudades("country_reporte_ca_origen", "reporte_ca_origen", false, '<?=$reporte->getCaOrigen()?>' );


        //Hace el mismo procedimiento parqa eldestino
        var fldTrafico = document.getElementById("country_reporte_ca_destino");

        if( clase!="<?=Constantes::EXPO?>" ){
            fldTrafico.length=0;
            fldTrafico[fldTrafico.length] = new Option('Colombia','CO-057',false,false);
        }else{
            fldTrafico.length=0;
            for( i in traficos ){
                if( typeof(traficos[i]['ca_idtrafico'])!="undefined" ){
                    fldTrafico[fldTrafico.length] = new Option(traficos[i]['ca_nombre'],traficos[i]['ca_idtrafico'],false,false);
                }
            }
        }

        fldTrafico.value = '<?=$reporte->getDestino()->getCaIdtrafico()?>';
        llenarCiudades("country_reporte_ca_destino", "reporte_ca_destino", false, '<?=$reporte->getCaDestino()?>' );




        //Muestra u oculta los combos de proveedor, consignatario etc.
        if( clase=="<?=Constantes::EXPO?>"  ){
             //document.getElementById("combo-consignatario").style.display="none";
        }

        else{
             //document.getElementById("combo-consignatario").style.display="";
        }



        cambiarTransporte();
    }

    function cambiarTransporte(){
        llenarModalidades('reporte_ca_impoexpo','reporte_ca_transporte', 'reporte_ca_modalidad', null, '<?=$reporte->getCaModalidad()?>');
        llenarLineas('reporte_ca_transporte', 'reporte_ca_idlinea', null, '<?=$reporte->getCaIdlinea()?>');
        //llenarAgentes('reporte_ca_impoexpo','reporte_ca_transporte', 'reporte_ca_modalidad', null, '<?=$reporte->getCaModalidad()?>');

    }

    

</script>

<?
include_partial("ventanaTercero", array("reporte"=>$reporte));
?>

<div align="center" class="content">
    <h1>Reportes de Negocio</h1>
    <br />
    <form action="<?=url_for("reportesNeg/formReporte")?>" method="post">
        <?        
        

        echo $form->renderHiddenFields();

        if( $reporte->getCaIdreporte() ){
        ?>
        <input type="hidden" name="id" value="<?=$reporte->getCaIdreporte()?>">
        <?
        }

        ?>
        <table class="tableList" width="80%">
            <tr>
                <th colspan="4">Datos para la referencia</th>
            </tr>
            <?
            if( $form->renderGlobalErrors() ){
            ?>
            <tr>
                <td colspan="4">
                 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
            </tr>
            <?
            }
            ?>
            <tr>
                <td width="25%"><b>Clase</b></td>
                <td width="25%">
                    

                    <?
                    echo $form['ca_impoexpo']->renderError();
                    if( $reporte ){
                        $form->setDefault('ca_impoexpo', $reporte->getCaImpoexpo() );
                    }
                    echo $form['ca_impoexpo']->render();
                    ?>
                </td>
                <td width="25%"><b>Fecha de despacho</b></td>
                <td width="25%">
                    <?
                    echo $form['ca_fchdespacho']->renderError();
                    if( $reporte ){
                        $form->setDefault('ca_fchdespacho', $reporte->getCaFchdespacho() );
                    }
                    echo $form['ca_fchdespacho']->render();
                    ?>
                </td>
            </tr>
            
            <tr >
                <td colspan="4">

                    <div class="tab-pane" id="tab-pane-1">
                        <div class="tab-page">
                            <h2 class="tab">Trayecto</h2>
                            <?
                            include_component("reportesNeg", "trayecto", array("form"=>$form, "reporte"=>$reporte))
                            ?>

                        </div>
                        <div class="tab-page">
                            <h2 class="tab">Cliente</h2>
                            <table class="tableList" width="100%">
                                <tr class="row0">
                                    <th colspan="4"><b>Datos del cliente</b></th>
                                </tr>
                                <tr>
                                    <td><b>Cliente:</b></td>
                                    <td>
                                        <?
                                        echo $form['ca_idconcliente']->renderError();

                                        ?>
                                        <input type="hidden" name="ca_idconcliente" id="ca_idconcliente"  value="<?=$ca_idconcliente?$ca_idconcliente:$reporte->getCaIdconcliente()?>">
                                        <input type="text" name="idconcliente" id="idconcliente">
                                    </td>
                                    <td><b> Contacto: </b></td>
                                    <td>&nbsp;
                                        <div id="div_contacto" align="left">
                                             <?
                                            if( $reporte->getCaIdconcliente() ){
                                                echo $reporte->getContacto()->getNombre();
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Orden del Cliente:</b></td>
                                    <td>
                                        <?
                                        echo $form['ca_orden_clie']->renderError();
                                        if( $reporte ){
                                            $form->setDefault('ca_orden_clie', $reporte->getCaOrdenClie() );
                                        }
                                        echo $form['ca_orden_clie']->render();
                                        ?>
                                    </td>
                                    <td><b> &nbsp; </b></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="row0"><b>Proveedor:</b></td>
                                    <td>
                                        <?
                                        if( $idproveedor ){
                                            $value = $idproveedor;
                                        }else{
                                            $value = $reporte->getCaIdproveedor();
                                        }
                                        include_component("widgets", "comboTercero", array( "tipo"=>"Proveedor", "id"=>"idproveedor", "name"=>"idproveedor", "value"=>$value));
                                        ?>
                                    </td>
                                    <td><b> &nbsp;</b></td>
                                    <td> &nbsp; </td>
                                </tr>

                                <tr id="combo-consignatario">
                                    <td class="row0"><b>Consignatario:</b></td>
                                    <td>
                                        <?
                                        if( $idconsignatario ){
                                            $value = $idconsignatario;
                                        }else{
                                            $value = $reporte->getCaIdconsignatario();
                                        }
                                        include_component("widgets", "comboTercero", array( "tipo"=>"Consignatario", "id"=>"idconsignatario", "name"=>"idconsignatario", "value"=>$value));
                                        ?>
                                    </td>
                                    <td><b> &nbsp;</b></td>
                                    <td> &nbsp; </td>
                                </tr>

                                <tr id="combo-consignatario">
                                    <td class="row0"><b>Consigna. Master:</b></td>
                                    <td>
                                        <?
                                        if( $idmaster ){
                                            $value = $idmaster;
                                        }else{
                                            $value = $reporte->getCaIdmaster();
                                        }
                                        include_component("widgets", "comboTercero", array( "tipo"=>"Master", "id"=>"idmaster", "name"=>"idmaster", "value"=>$value));
                                        ?>
                                    </td>
                                    <td><b> &nbsp;</b></td>
                                    <td> &nbsp; </td>
                                </tr>


                                <tr>
                                    <td class="row0"><b>Notify:</b></td>
                                    <td>
                                        <?
                                        if( $idnotify ){
                                            $value = $idnotify;
                                        }else{
                                            $value = $reporte->getCaIdnotify();
                                        }
                                        include_component("widgets", "comboTercero", array( "tipo"=>"Notify", "id"=>"idnotify", "name"=>"idnotify", "value"=>$value));
                                        ?>
                                    </td>
                                    <td><b> &nbsp;</b></td>
                                    <td> &nbsp; </td>
                                </tr>
                                
                                <tr>
                                    <td class="row0"><b>Representante:</b></td>
                                    <td>
                                        <?
                                        if( $idrepresentante ){
                                            $value = $idrepresentante;
                                        }else{
                                            $value = $reporte->getCaIdrepresentante();
                                        }
                                        include_component("widgets", "comboTercero", array( "tipo"=>"Representante", "id"=>"idrepresentante", "name"=>"idrepresentante", "value"=>$value));
                                        ?>
                                    </td>
                                    <td><b> &nbsp;</b></td>
                                    <td> &nbsp; </td>
                                </tr>


                            </table>
                        </div>
                        <div class="tab-page">
                            <h2 class="tab">Preferencias</h2>
                        </div>
                        <div class="tab-page">
                            <h2 class="tab">Aduana</h2>
                            <table class="tableList" width="100%">
                                 <tr >
                                     <th colspan="4" ><b>Aduana</b></th>
                                 </tr>
                                 <tr>
                                     <td colspan="4">
                                        <?
                                        echo $form['ca_colmas']->renderError();
                                        if( $reporte ){
                                            $form->setDefault('ca_colmas', $reporte->getCaColmas() );
                                        }
                                        echo $form['ca_colmas']->render();
                                        ?>
                                    </td>
                                </tr>

                            </table>
                        </div>
                        <div class="tab-page">
                            <h2 class="tab">Seguros</h2>
                            <table class="tableList" width="100%">
                                 <tr >
                                     <th colspan="4" ><b>Seguros</b></th>
                                 </tr>
                                 <tr>
                                     <td colspan="4">
                                        <?
                                        echo $form['ca_seguro']->renderError();
                                        if( $reporte ){
                                            $form->setDefault('ca_seguro', $reporte->getCaSeguro() );
                                        }
                                        echo $form['ca_seguro']->render();
                                        ?>
                                    </td>
                                </tr>

                            </table>
                        </div>
                        <div class="tab-page">
                            <h2 class="tab">Guias</h2>
                        </div>
                        <div class="tab-page">
                            <h2 class="tab">Exportaciones</h2>
                        </div>
                    </div>
                </td>
            </tr>     
            


           
            <tr>
                <td colspan="4">
                    <div align="center">
                        <input type="submit" value="Guardar" class="button" />
                        <?
                        if( $reporte->isNew() ){
                            $url = "reportesNeg/index";
                        }else{
                            $url = "reportesNeg/consultaReporte?id=".$reporte->getCaIdreporte();
                        }
                        ?>
                        <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for($url)?>'" />
                    </div>

                </td>

            </tr>
        </table>
    </form>

    <script language="javascript">
       var ds = new Ext.data.Store({
            proxy: new Ext.data.HttpProxy({
                url: '<?=url_for('widgets/listaContactosClientesJSON')?>'
            }),
            reader: new Ext.data.JsonReader({
                root: 'clientes',
                totalProperty: 'totalCount',
                id: 'id'
            }, [
                {name: 'idcontacto', mapping: 'ca_idcontacto'},
                {name: 'compania', mapping: 'ca_compania'},
                {name: 'cargo', mapping: 'ca_cargo'},
                {name: 'nombre', mapping: 'ca_nombres'},
                {name: 'papellido', mapping: 'ca_papellido'},
                {name: 'sapellido', mapping: 'ca_sapellido'},
                {name: 'vendedor', mapping: 'ca_vendedor'},
                {name: 'nombre_ven', mapping: 'ca_nombre'},
                {name: 'listaclinton', mapping: 'ca_listaclinton'},
                {name: 'fchcircular', mapping: 'ca_fchcircular', type:'int'},
                {name: 'status', mapping: 'ca_status'}
            ])
        });

        //var data_productos = <?//json_encode();?>

        var resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{compania}</b><br /><span>{nombre} {papellido} {sapellido} <br />{cargo}</span> </div></tpl>'
    );

        <?
        if( $idconcliente ){
            $value = $idconcliente;
        }else{
            $cliente = $reporte->getCliente();
            if( $cliente ){
                $value = $reporte->getCliente()->getCaCompania();
            }else{
                $value = "";
            }
        }
        ?>
        var comboclientes =  new Ext.form.ComboBox({
                            store: ds,
                            fieldLabel: 'Cliente',
                            displayField:'compania',
                            typeAhead: false,
                            loadingText: 'Buscando...',
                            valueNotFoundText: 'No encontrado' ,
                            minChars: 1,
                            tpl: resultTpl,
                            width: 400,                            
                            applyTo: "idconcliente",
                            itemSelector: 'div.search-item',
                            emptyText:'Escriba el nombre del cliente...',
                            value: '<?=str_replace("'", "\\'", $value)?>',
                            forceSelection:true,
                            selectOnFocus:true,
                            allowBlank:false,

                            onSelect: function(record, index){ // override default onSelect to do redirect
                                if(this.fireEvent('beforeselect', this, record, index) !== false){
                                    this.setValue(record.data[this.valueField || this.displayField]);
                                    this.collapse();
                                    this.fireEvent('select', this, record, index);
                                }
                                var mensaje = "";
                                
                                document.getElementById("ca_idconcliente").value = record.get("idcontacto");
                                document.getElementById("div_contacto").innerHTML = record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") ;

                                

                            }
                        });
       
    </script>

</div>


<script language="javascript">
    cambiarImpoexpo();
    
</script>