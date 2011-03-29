<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets", "widgetParametros",array("caso_uso"=>"CU010"));
?>
<div class="content" align="center">
    <h2> Referencias sin desbloquear</h2>
    <br />
    <table class="tableList" width="900px" border="1" id="mainTable">
        <tr>
            <th width="70" scope="col">Referencia</th>
            <th width="70" scope="col">Modalidad</th>
            <th width="70" scope="col">Origen</th>
            <th width="70" scope="col">Destino</th>
            <th width="70" scope="col">Motonave</th>
            <th width="70" scope="col">ETD</th>
            <th width="70" scope="col">ETA</th>
            <th width="70" scope="col">Creador</th>
        </tr>
        <?
        $i=0;
        foreach( $referencias as $referencia ){
            if( !$referencia->getCaProvisional() ){
                continue;
            }
            $email=$referencia->getUltEmail();
            
            if($format=="maritimo" )
            {
                if($email==null || strpos($email->getCaSubject(), 'Envio de Antecedentes')===false  )
                //echo $referencia->getCaReferencia()."".$referencia->getCountEmails();
                    continue;
            }
            else
            {
                if($email)
                {
                    if(strpos($email->getCaSubject(), 'Envio de Antecedentes')!==false)
                    {
                        continue;
                    }
                }
            }
            $i++;

            $url = "antecedentes/verPlanilla?ref=".str_replace(".","|",$referencia->getCaReferencia());

            if( $format ){
                $url.="&format=".$format;
            }

        ?>
        <tr>
            <td  >
                <?=link_to($referencia->getCaReferencia(), $url)?>
            </td>
            <td  >
                <?=$referencia->getCaModalidad()?>
            </td>
            <td  >
                <?=$referencia->getOrigen()->getCaCiudad()?>
            </td>
            <td  >
                <?=$referencia->getDestino()->getCaCiudad()?>
            </td>
            <td  >
                <?=$referencia->getCaMotonave()?>
            </td>
            <td  >
                <?=$referencia->getCaFchembarque()?>
            </td>
            <td  >
                <?=$referencia->getCaFcharribo()?>
            </td>
            <td  >
                <?=$referencia->getCaUsucreado()?>
            </td>
        </tr>
        <?
        }

        if( $i==0 ){
            ?>
            <tr>
                <td colspan="7" >
                    <div align="center">No hay registros</div>
                </td>
            </tr>
            <?
        }
        ?>
    </table>

    <br>
    <h2> Referencias rechazadas</h2>
    <br />
    <table class="tableList" width="900px" border="1" id="mainTable">
        <tr>
            <th width="70" scope="col">Referencia</th>
            <th width="70" scope="col">Modalidad</th>
            <th width="70" scope="col">Origen</th>
            <th width="70" scope="col">Destino</th>
            <th width="70" scope="col">Motonave</th>
            <th width="70" scope="col">ETD</th>
            <th width="70" scope="col">ETA</th>
            <th width="70" scope="col">Creador</th>

        </tr>
        <?
        $i=0;
        foreach( $referencias as $referencia ){
            if( !$referencia->getCaProvisional() ){
                continue;
            }
            $email=$referencia->getUltEmail();
            if($email == null || strpos($email->getCaSubject(), 'Rechazo de Antecedentes') === false)
            {
                //if($email)
                    //echo $email->getCaSubject();
//                echo $referencia->getCaReferencia()."".$referencia->getCountEmails();
                continue;
            }
            $i++;

            $url = "antecedentes/verPlanilla?ref=".str_replace(".","|",$referencia->getCaReferencia());

            if( $format ){
                $url.="&format=".$format;
            }

        ?>
        <tr>
            <td  >
                <?=link_to($referencia->getCaReferencia(), $url)?>
            </td>
            <td  >
                <?=$referencia->getCaModalidad()?>
            </td>
            <td  >
                <?=$referencia->getOrigen()->getCaCiudad()?>
            </td>
            <td  >
                <?=$referencia->getDestino()->getCaCiudad()?>
            </td>
            <td  >
                <?=$referencia->getCaMotonave()?>
            </td>
            <td  >
                <?=$referencia->getCaFchembarque()?>
            </td>
            <td  >
                <?=$referencia->getCaFcharribo()?>
            </td>
            <td  >
                <?=$referencia->getCaUsucreado()?>
            </td>
        </tr>
        <?
        }

        if( $i==0 ){
            ?>
            <tr>
                <td colspan="7" >
                    <div align="center">No hay registros</div>
                </td>
            </tr>
            <?
        }
        ?>
    </table>

    <br />


    <h2> Referencias sin reportar a Muisca</h2>
    <br />
    Sufijo<div id="filtro"></div>
    <script>
    function recargar(combo, record, index)
    {
        if(parseInt(record.data.id)!="")
        {
            $("tr[class*=tipo]").hide();
            $(".tipo"+record.data.id).show();
        }
        else
            $("tr[class*=tipo]").show();
    };
    function limpiar()
    {
        $("tr[class*=tipo]").show();
    }
    var sufijo=new WidgetParametros({
                                id:'sufijo',
                                name:'sufijo',
                                caso_uso:"CU010",
                                width:100,
                                ididentificador:"identificador",
                                renderTo:"filtro"                                
                             });
    sufijo.addListener("select", recargar, this);
    sufijo.addListener("clear", limpiar, this);


    </script>

    <table class="tableList" width="900px" border="1" id="mainTable">
        <tr>
            <th width="70" scope="col">Referencia</th>
            <th width="70" scope="col">Modalidad</th>
            <th width="70" scope="col">Origen</th>
            <th width="70" scope="col">Destino</th>
            <th width="70" scope="col">Motonave</th>
            <th width="70" scope="col">ETD</th>
            <th width="70" scope="col">ETA</th>
        </tr>
        <?
        $i=0;
        foreach( $referencias as $referencia ){

            if( $referencia->getCaProvisional() ){
                continue;
            }

            $i++;

            $url = "antecedentes/verPlanilla?ref=".str_replace(".","|",$referencia->getCaReferencia());

            if( $format ){
                $url.="&format=".$format;
            }
            $arrRef=explode(".", $referencia->getCaReferencia());
            //if($i==1)
            //print_r($arrRef);
        ?>
        <tr class="tipo<?=(int)$arrRef[1]?>" id="tipos">
            <td  >
                <?=link_to($referencia->getCaReferencia(), $url)?>
            </td>
            <td  >
                <?=$referencia->getCaModalidad()?>
            </td>
            <td  >
                <?=$referencia->getOrigen()->getCaCiudad()?>
            </td>
            <td  >
                <?=$referencia->getDestino()->getCaCiudad()?>
            </td>
            <td  >
                <?=$referencia->getCaMotonave()?>
            </td>
            <td  >
                <?=$referencia->getCaFchembarque()?>
            </td>
            <td  >
                <?=$referencia->getCaFcharribo()?>
            </td>
        </tr>
        <?
        }

        if( $i==0 ){
            ?>
            <tr>
                <td colspan="7" >
                    <div align="center">No hay registros</div>
                </td>
            </tr>
            <?
        }
        ?>
    </table>
</div>