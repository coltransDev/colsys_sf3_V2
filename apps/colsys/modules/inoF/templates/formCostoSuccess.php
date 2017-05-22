<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

include_component("widgets", "widgetIds");
?>
<script type="text/javascript">
    function calc_utilidad(){
        var to= document.getElementById("utilidad");
        var venta = document.getElementById("venta");
        var neto = document.getElementById("neto");
        var tcambio = document.getElementById("tcambio");
        var tcambio_usd = document.getElementById("tcambio_usd");
       
        to.value = Math.round(venta.value - Math.round(neto.value * tcambio.value / tcambio_usd.value));
    }
    
    function calc_neto(){
        var netopesos= document.getElementById("netopesos");   
        var netousd= document.getElementById("netousd");     
        var neto = document.getElementById("neto");
        var tcambio = document.getElementById("tcambio");
        var tcambio_usd = document.getElementById("tcambio_usd");
        
        var idmoneda = document.getElementById("idmoneda");
        
        if( idmoneda.value=="USD" || idmoneda.value=="<?=$monedaLocal?>" ){
            tcambio_usd.value=1;
            tcambio_usd.disabled = true;
            netousd.disabled = true;
        }else{
            tcambio_usd.disabled = false;
            netousd.disabled = false;
            
        }
        
        if( idmoneda.value=="<?=$monedaLocal?>" ){
            tcambio.value=1;
            tcambio.disabled = true;
        }else{
            tcambio.disabled = false;
        }
        
        netousd.value =Math.round(eval(neto.value / tcambio_usd.value*100))/100;
        netopesos.value =Math.round(eval(neto.value * tcambio.value / tcambio_usd.value));
        
        calc_utilidad();
    }
    
    function calc_tasausd(){
        var neto = document.getElementById("neto");
        var netousd= document.getElementById("netousd");             
        var tcambio_usd = document.getElementById("tcambio_usd");
                    
        tcambio_usd.value = Math.round(eval(neto.value/netousd.value*100000))/100000;        
        
        calc_neto();
    }
    
    function calcular(){
        
        var to = document.getElementById("utilidad_sobreventa");  
        
        to.value=0;
        var utils = document.getElementById("utils");
        var elems = utils.getElementsByTagName("input");
        for (i=0; i<elems.length; i++) {
            var el = elems[i];
            if ( el.name.substr(0,4) == "util" ){
                to.value = el.value*1 + to.value*1;
                
            }
        }
    }
</script>

<div class="content" align="center">
    
    <form action="<?=url_for("inoF/formCosto?modo=".$modo->getCaIdmodo()."&idmaster=".$referencia->getCaIdmaster())?>" method="post">          
        <?
        echo $form['idinocosto']->renderError();                                          
        if( $inoCosto ){                                     
            $form->setDefault('idinocosto', $inoCosto->getCaIdinocosto() );
        } 
        echo $form['idinocosto']->render();
        
        echo $form['factura_ant']->renderError(); 
        if( $inoCosto ){                                     
            $form->setDefault('factura_ant', $inoCosto->getCaFactura() );
        }        
        echo $form['factura_ant']->render();
        
        ?>
        <table class="tableList alignLeft" width="80%" border="0">
            <tr>
                <th colspan="6">
                    <div align="center">
                        Información de la Factura<br />
                        <?=$referencia->getCaReferencia()?>
                    </div>
                </th>
            </tr>    
            
            <?
            if( $form->renderGlobalErrors() ){
            ?>
            <tr>
                <td colspan="6">				
                 <div align="center"><?php echo $form->renderGlobalErrors() ?>		</div></td>	
            </tr>
            <?
            }
            ?>	
            <tr>
                <td >
                    <b>Costo:</b>
                    <br />
                    <?
                    echo $form['idcosto']->renderError(); 
                    if( $inoCosto ){                                     
                        $form->setDefault('idcosto', $inoCosto->getCaIdcosto() );
                    }
                    echo $form['idcosto']->render();
                    ?>
                </td>
                <td>
                    <b>Factura:</b><br />
                    <?
                    echo $form['factura']->renderError(); 
                    if( $inoCosto  ){                                     
                        $form->setDefault('factura', $inoCosto->getCaFactura() );
                    }
                    echo $form['factura']->render();
                    ?>
                    
                </td>
                <td>
                    <b>Fecha Factura:</b><br />                   
                    <?
                    echo $form['fchfactura']->renderError(); 
                    if( $inoCosto && $inoCosto->getCaFchfactura() ){                                     
                        $form->setDefault('fchfactura', $inoCosto->getCaFchfactura() );
                    }else{
                        $form->setDefault('fchfactura', date("Y-m-d") );
                    }
                    echo $form['fchfactura']->render();
                    ?>
                </td>
            
                <td>
                    <b>Moneda:</b><br />
                    <?
                    echo $form['idmoneda']->renderError(); 
                    if( $inoCosto && $inoCosto->getCaIdmoneda() ){                                     
                        $form->setDefault('idmoneda', $inoCosto->getCaIdmoneda() );
                    }else{
                        $form->setDefault('idmoneda', "USD" );
                    }
                    echo $form['idmoneda']->render();
                    ?>
                </td>
                <td colspan="2" rowspan="4" valign="top">
                    <b>Distribuci&oacute;n INO x Sobreventa:</b><br />
                    <div id="utils">
                        <table border="0">
                        <?                    
                        foreach( $inoHouses as $ic ){
                        ?>
                            <tr>
                                <td><div title="<?=$ic->getCliente()->getCaCompania()?>" ><?=$ic->getCaDoctransporte()?></div></td>
                                <td>  
                                <?                                   
                                echo $form['util_'.$ic->getCaIdhouse()]->renderError();  
                                if( isset( $utilidades[ $ic->getCaIdhouse() ] )  ){
                                    $form->setDefault('util_'.$ic->getCaIdhouse(),  $utilidades[ $ic->getCaIdhouse() ]  );
                                }else{
                                    $form->setDefault('util_'.$ic->getCaIdhouse(), 0 );
                                }
                                echo $form['util_'.$ic->getCaIdhouse()]->render();
                                ?>                                
                                </td>
                            </tr>    
                        <?                        
                        }
                        ?>
                            <tr>
                                <td><b>Total<b/></td>
                                <td>  
                                <input type="text" id="utilidad_sobreventa" maxlength="15" size="15" readOnly="true" />                       
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Valor Neto:</b><br />
                    <?
                    echo $form['neto']->renderError(); 
                    if( $inoCosto  ){                                     
                        $form->setDefault('neto', $inoCosto->getCaNeto() );
                    }
                    echo $form['neto']->render();
                    ?>
                </td>
                <td>
                    <b>Tasa de Cambio a USD:</b><br />
                    <?
                    echo $form['tcambio_usd']->renderError(); 
                    if( $inoCosto && $inoCosto->getCaTcambio() ){                                     
                        $form->setDefault('tcambio_usd', $inoCosto->getCaTcambioUsd() );
                    }else{
                        $form->setDefault('tcambio_usd', 1 );                        
                    }
                    
                    echo $form['tcambio_usd']->render();
                    ?>
                </td>
                <td>                    
                   <b>Neto en USD:</b><br />
                    <input type="text" id="netousd" maxlength="15" size="14" onchange="calc_tasausd()" />

                </td>           
                </td>
                <td>
                   <b>Tasa de Cambio <?=$monedaLocal?>:</b><br />
                    <?
                    echo $form['tcambio']->renderError(); 
                    if( $inoCosto  ){                                     
                        $form->setDefault('tcambio', $inoCosto->getCaTcambio() );
                    }
                    echo $form['tcambio']->render();
                    ?>
                    
                </td>
               
            </tr> 
            <tr>
               <td>
                    <b>Neto <?=$monedaLocal?>:</b><br />
                    <input type="text" id="netopesos" maxlength="15" size="14" readOnly="true" />
                    
                </td>
                
               <td>
                    <b>Venta <?=$monedaLocal?>:</b><br />
                    <?
                    echo $form['venta']->renderError(); 
                    if( $inoCosto  ){                                     
                        $form->setDefault('venta', $inoCosto->getCaVenta() );
                    }
                    echo $form['venta']->render();
                    ?>
                    
                </td>
                <td>
                    <b>INO en Venta:</b><br />
                    <input type="text" id="utilidad" maxlength="15" size="14" readOnly="true" />

                </td>
                
                <td>
                    <b></b><br />
                   

                </td>
                
            </tr>
            <tr>
                <td colspan="4">
                    <b>Proveedor:</b><br />
                    
                    <?                    
                    echo $form['idproveedor']->renderError(); 
                    if( $inoCosto  ){                                     
                        $form->setDefault('idproveedor', $inoCosto->getCaIdproveedor() );
                    }
                    echo $form['idproveedor']->render();
                    
                    echo $form['proveedor']->renderError(); 
                    if( $inoCosto && $inoCosto->getIds() ){                                     
                        $form->setDefault('proveedor', $inoCosto->getIds()->getCaNombre() );
                    }
                    echo $form['proveedor']->render();
                    ?>
                    
                    
                </td>
            </tr>             
            <tr>
                <td colspan="6">
                    <div align="center">
                        <input type="submit" value="Guardar" class="button" />
                        &nbsp;
                        <input type="button" value="Cancelar" class="button" onclick="document.location='<?=url_for("inoF/verReferencia?modo=".$modo->getCaIdmodo()."&idmaster=".$referencia->getCaIdmaster())?>'" />
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>

<script type="text/javascript" >
    calc_neto();
    calcular();    
    
</script>

