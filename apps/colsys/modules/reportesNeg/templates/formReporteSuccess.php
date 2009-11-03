
<script language="javascript">
    var cambiarImpoexpo = function(){
        var clase = document.getElementById("reporte_ca_impoexpo").value;

        if( clase=="<?=Constantes::ADUANA?>" ){
             document.getElementById("info-trayectos").style.display="none";             
             document.getElementById("combo-consignatario").style.display="none";
        }else{
             document.getElementById("info-trayectos").style.display="";
             document.getElementById("combo-consignatario").style.display="";
        }

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
            <tr id="info-trayectos">
                <td colspan="4">
                    <table class="tableList" width="100%">
                        <tr class="row0">
                            <td colspan="4"><b>Datos del trayecto</b></td>
                        </tr>

                        <tr>
                            <td><b>Transporte</b></td>
                            <td>
                                 <?
                                echo $form['ca_transporte']->renderError();
                                if( $reporte ){
                                    $form->setDefault('ca_transporte', $reporte->getCaTransporte() );
                                }
                                echo $form['ca_transporte']->render();
                                ?>
                            </td>
                            <td><b>Modalidad</b></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>Origen</b></td>
                            <td>
                                <?
                                echo $form['ca_origen']->renderError();
                                if( $reporte ){
                                    $form->setDefault('ca_origen', $reporte->getCaOrigen() );
                                }
                                echo $form['ca_origen']->render();
                                ?>
                            </td>
                            <td>
                                <b>Destino</b>
                            </td>
                            <td>
                                <?
                                echo $form['ca_destino']->renderError();
                                if( $reporte ){
                                    $form->setDefault('destino', $reporte->getCaDestino() );
                                }
                                echo $form['ca_destino']->render();
                                ?>
                            </td>
                          </tr>

                         <tr>
                             <td><b>Linea</b></td>
                             <td colspan="3">
                                <?
                                echo $form['ca_idlinea']->renderError();
                                if( $reporte ){
                                    $form->setDefault('ca_idlinea', $reporte->getCaIdlinea() );
                                }
                                echo $form['ca_idlinea']->render();
                                ?>
                            </td>

                        </tr>
                        <tr>
                             <td><b>Agente</b></td>
                             <td colspan="3">
                                <?
                                echo $form['ca_idagente']->renderError();
                                if( $reporte ){
                                    $form->setDefault('ca_idagente', $reporte->getCaIdagente() );
                                }
                                echo $form['ca_idagente']->render();
                                ?>
                            </td>

                        </tr>
                         <tr>
                             <td><b>Aduana</b></td>
                             <td colspan="3">
                                <select name="colmas">
                                    <option value="Sí">S&iacute;</option>
                                    <option value="No">No</option>
                                </select>
                            </td>
                       </tr>
                    </table>
                 </td>
            </tr>
            <tr>
                 <td><b>Mercancia</b></td>
                 <td colspan="3">
                    <?
                    echo $form['ca_mercancia_desc']->renderError();
                    if( $reporte ){
                        $form->setDefault('ca_mercancia_desc', $reporte->getCaMercanciaDesc() );
                    }
                    echo $form['ca_mercancia_desc']->render();
                    ?>
                    <br />
                    <b>¿Es mercancia peligrosa?</b>
                    <?
                    echo $form['ca_mcia_peligrosa']->renderError();
                    if( $reporte ){
                        $form->setDefault('ca_mcia_peligrosa', $reporte->getCaMciaPeligrosa() );
                    }
                    echo $form['ca_mcia_peligrosa']->render();
                    ?>
                </td>               
           </tr>           
           <tr class="row0">
                <td colspan="4"><b>Datos del cliente</b></td>
            </tr>
            <tr>
                <td><b>Cliente:</b></td>
                <td>
                    <?
                    echo $form['ca_idconcliente']->renderError();
                    
                    ?>
                    <input type="hidden" name="ca_idconcliente" id="ca_idconcliente"  value="<?=$ca_idconcliente?$ca_idconcliente:$reporte->getCaIdconcliente()?>">
                    <input type="text" name="idconcliente" id="idconcliente" value="<?=$idconcliente?>">
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
            
            <tr>
                <td colspan="4">
                    <div align="center">
                        <input type="submit" value="Guardar" class="button" />
                        <?
                        if( $reporte->isNew() ){
                            $url = "reportesNeg/index";
                        }else{
                            $url = "reportesNeg/verReferencia?id=".$reporte->getCaIdreporte();
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
        if( $reporte->getCaIdconcliente() ){
            $value = $reporte->getCliente()->getCaCompania();
        }else{
            $value = "";
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