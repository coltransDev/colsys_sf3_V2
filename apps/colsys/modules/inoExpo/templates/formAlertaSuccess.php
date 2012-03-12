<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<script type="text/javascript">
    var copiarNotificacion = function(){
        var checked = document.getElementById("copiarChkbox").checked;       
        
        if( checked ){
            document.getElementById("copiarNotificacion").style.display="";
        }else{
            document.getElementById("copiarNotificacion").style.display="none";
        }
        
    }
</script>
<div align="center">
    <h3>Sistema Administrador de Referencias Exportaciones</h3>
    <form action="<?=url_for("inoExpo/formAlerta")?>" method="post">          
        <?
        echo $form['referencia']->renderError();                                                     
        $form->setDefault('referencia', $referencia->getCaReferencia() );                        
        echo $form['referencia']->render();
        ?>
        
        <?
        echo $form['idalerta']->renderError();                                                     
        if( $expoAlerta && $expoAlerta->getCaIdalerta() ){                                     
            $form->setDefault('idalerta', $expoAlerta->getCaIdalerta() );
        }                    
        echo $form['idalerta']->render();
        ?>
        <table cellspacing="1" class="tableList">
            <tbody><tr>
                    <th colspan="2" class="titulo">Datos de la Alerta</th>
                </tr>
                <tr>
                    <td class="mostrar">Fecha de Recordatorio : </td>
                    <td class="mostrar">
                        <?
                        echo $form['fchrecordatorio']->renderError(); 
                        if( $expoAlerta && $expoAlerta->getCaFchrecordatorio() ){                                     
                            $form->setDefault('fchrecordatorio', $expoAlerta->getCaFchrecordatorio() );
                        }else{
                            $form->setDefault('fchrecordatorio', date("Y-m-d") );
                        }
                        echo $form['fchrecordatorio']->render();
                        ?>
                        
                    </td>
                </tr>
                <tr>
                    <td class="mostrar">Fecha de Vencimiento : </td>
                    <td class="mostrar">
                         <?
                        echo $form['fchvencimiento']->renderError(); 
                        if( $expoAlerta && $expoAlerta->getCaFchrecordatorio() ){                                     
                            $form->setDefault('fchvencimiento', $expoAlerta->getCaFchvencimiento() );
                        }else{
                            $form->setDefault('fchvencimiento', date("Y-m-d") );
                        }
                        echo $form['fchvencimiento']->render();
                        ?>
                        
                    </td>
                </tr>
                <tr>
                    <td class="mostrar">Información de la Alerta: </td>
                    <td class="mostrar">
                        <?
                        echo $form['cuerpoalerta']->renderError(); 
                        if( $expoAlerta && $expoAlerta->getCaCuerpoalerta() ){                                     
                            $form->setDefault('cuerpoalerta', $expoAlerta->getCaCuerpoalerta() );
                        }
                        echo $form['cuerpoalerta']->render();
                        ?>
                        
                        </td>
                </tr>
                
                <tr>
                    <td class="mostrar">Copiar Notificaci&oacute;n: </td>
                    <td class="mostrar">
                        <?
                        echo $form['copiarChkbox']->renderError(); 
                        if( $expoAlerta && $expoAlerta->getCaNotificar() ){                                     
                            $form->setDefault('copiarChkbox', true );
                        }
                        echo $form['copiarChkbox']->render();
                        ?>
                        
                        <div id="copiarNotificacion">
                            <br /><br />
                        <?
                        echo $form['notificar']->renderError(); 
                        if( $expoAlerta && $expoAlerta->getCaNotificar() ){                                     
                            $form->setDefault('notificar', $expoAlerta->getCaNotificar() );
                        }
                        echo $form['notificar']->render();
                        ?>
                        <br />
                        Copiar al jefe
                        <?
                        echo $form['notificar_jefe']->renderError(); 
                        if( $expoAlerta && $expoAlerta->getCaNotificarJefe() ){                                     
                            $form->setDefault('notificar_jefe', $expoAlerta->getCaNotificarJefe() );
                        }else{
                            $form->setDefault('notificar_jefe', true );
                        }
                        echo $form['notificar_jefe']->render();
                        ?>
                        </div>
                        </td>
                </tr>
            </tbody>
        </table>
        <br/>
        <table cellspacing="10">
            <tbody><tr>
                    <th><input type="SUBMIT" value="Registrar" name="accion" class="submit"/></th>
                    <th><input type="BUTTON" onclick='document.location="<?="/Coltrans/Expo/ConsultaReferenciaAction.do?referencia=".$referencia->getCaReferencia()?>"' value="Cancelar" name="accion" class="button"/></th>
                </tr>
            </tbody></table>
    </form>
</div>

<script type="text/javascript">
    copiarNotificacion();
</script>