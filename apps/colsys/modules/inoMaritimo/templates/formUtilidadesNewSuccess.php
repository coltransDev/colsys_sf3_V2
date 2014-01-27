<script type="text/javascript">
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
    
    <form action="<?=url_for("inoMaritimo/formUtilidadesNew")?>" method="post">
        <?
        echo $form['referencia']->renderError();                                  
        $form->setDefault('referencia', $referencia->getCaReferencia() );        
        echo $form['referencia']->render();
        
        ?>
         
        <table class="tableList alignLeft" width="30%" border="0">
            <tr>
                <th>
                    <div align="center">
                        Liquidación Utilidad de la Referencia<br />
                        <?=$referencia->getCaReferencia()?>
                    </div>
                </th>
            </tr>    
            
            <?
            if( $form->renderGlobalErrors() ){
            ?>
            <tr>
                <td>
                 <div align="center"><?php echo $form->renderGlobalErrors() ?>		</div>
                </td>
            </tr>
            <?
            }
            ?>	
            <tr>
                <td>
                    <b>Distribuci&oacute;n INO x Sobreventa:</b><br />
                    <div id="utils" align="center">
                        <table border="0">
                        <?                    
                        foreach( $inoClientes as $ic ){
                        ?>
                            <tr>
                                <td><div title="<?=$ic->getCliente()->getCaCompania()?>" ><?=$ic->getCaHbls()?></div></td>
                                <td>  
                                <?                                
                                echo $form['util_'.$ic->getCaIdinocliente()]->renderError();  
                                if( isset( $utilidades[ $ic->getCaIdinocliente() ] )  ){
                                    $form->setDefault('util_'.$ic->getCaIdinocliente(),  $utilidades[ $ic->getCaIdinocliente() ]  );
                                }else{
                                    $form->setDefault('util_'.$ic->getCaIdinocliente(), 0 );
                                }
                                echo $form['util_'.$ic->getCaIdinocliente()]->render();
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
                    <div align="center">
                        <input type="submit" value="Guardar" class="button" />
                        &nbsp;
                        <input type="button" value="Cancelar" class="button" onclick="document.location='/colsys_php/inosea.php?boton=Consultar&id=<?=$referencia->getCaReferencia()?>'" />
                    </div>
                </td>
            </tr>
        </table>  
    </form>
</div>

<script type="text/javascript" >
        calcular();
</script>