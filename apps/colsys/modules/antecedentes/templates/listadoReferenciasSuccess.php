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
            <th width="70" scope="col">Ver</th>
            <th width="70" scope="col">Modalidad</th>
            <th width="70" scope="col">Origen</th>
            <th width="70" scope="col">Destino</th>
            <th width="70" scope="col">Master</th>
            <th width="70" scope="col">Motonave</th>
            <th width="70" scope="col">ETD</th>
            <th width="70" scope="col">ETA</th>
            <th width="70" scope="col">Creador</th>
        </tr>
        <?
        $i=0;

        foreach( $refBloqueadas as $referencia ){   
            //echo $referencia["ca_provisional"];
            
            
            $i++;

            $url = "antecedentes/verPlanilla?idmaster=".$referencia["ca_idmaster"];

            if( $format ){
                $url.="&format=".$format;
            }

        ?>
        <tr>
            <td  >
                <?=link_to("Ver Detalles", $url)?>
            </td>
            <td  >
                <?=$referencia["ca_modalidad"]?>
            </td>
            <td  >
                <?=$referencia["ca_ciu_origen"]?>
            </td>
            <td  >
                <?=$referencia["ca_ciu_destino"]?>
            </td>
            <td  >
                <?=$referencia["ca_master"]?>
            </td>
            <td  >
                <?=$referencia["ca_motonave"]?>
            </td>
            <td  >
                <?=$referencia["ca_fchsalida"]?>
            </td>
            <td  >
                <?=$referencia["ca_fchllegada"]?>
            </td>
            <td  >
                <?=$referencia["ca_usucreado"]?>
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
<?
if( $format=="" )
{
?>
    <br>
    <h2> Referencias rechazadas</h2>
    <br />
    <table class="tableList" width="900px" border="1" id="mainTable">
        <tr>
            <th width="70" scope="col">ver</th>
            <th width="70" scope="col">Master</th>
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
        foreach( $refRechazadas as $referencia ){            
            $i++;

            $url = "antecedentes/verPlanilla?idmaster=".$referencia["ca_idmaster"];

            if( $format ){
                $url.="&format=".$format;
            }

        ?>
        <tr>
            <td  >
                <?=link_to("Ver Detalles", $url)?>
            </td>
            <td  >
                <?=$referencia["ca_master"]?>
            </td>
            
            <td  >
                <?=$referencia["ca_modalidad"]?>
            </td>
            <td  >
                <?=$referencia["ca_ciu_origen"]?>
            </td>
            <td  >
                <?=$referencia["ca_ciu_destino"]?>
            </td>
            <td  >
                <?=$referencia["ca_motonave"]?>
            </td>
            <td  >
                <?=$referencia["ca_fchsalida"]?>
            </td>
            <td  >
                <?=$referencia["ca_fchllegada"]?>
            </td>
            <td  >
                <?=$referencia["ca_usucreado"]?>
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
<?
}
?>
    <br />

<?
if($format!="")
{

?>
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

    function radicar(ref,id)
    {
        if(window.confirm("esta seguro que desea marca esta ref como radicada?"))
        {
            Ext.MessageBox.wait('Espere por favor', '');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("antecedentes/radicarReferencia") ?>',
                params :	{
                    idmaster: ref
                },
                failure:function(response,options){
                    //alert( response.responseText );
                    Ext.Msg.hide();
                    success = false;
                    Ext.MessageBox.hide();
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        $("#"+id).html("");
                        $("#"+id).remove();
                        Ext.MessageBox.hide();
                    }
                }
            });
        }        
    }
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
<?
    //if($nivel==1)
    {
?>
            <th width="20" scope="col">&nbsp;</th>
<?
    }
?>
        </tr>
        <?
        $i=0;
        foreach( $refSinMuisca as $referencia ){


            $i++;

            $url = "antecedentes/verPlanilla?ref=".str_replace(".","|",$referencia["ca_referencia"]);
            $url = "/colsys_php/inosea.php?boton=Consultar&id=".$referencia["ca_referencia"];
            /*if( $format ){
                $url.="&format=".$format;
            }*/
            $arrRef=explode(".", $referencia["ca_referencia"]);
            //if($i==1)
            //print_r($arrRef);
        ?>
        <tr class="tipo<?=(int)$arrRef[1]?>" id="id_<?=str_replace(".","",$referencia["ca_idmaster"])?>">
            <td  >
                <?=link_to($referencia["ca_referencia"], $url)?>
            </td>
            <td  >
                <?=$referencia["ca_modalidad"]?>
            </td>
            <td  >
                <?=$referencia["ca_ciu_origen"]?>
            </td>
            <td  >
                <?=$referencia["ca_ciu_destino"]?>
            </td>
            <td  >
                <?=$referencia["ca_motonave"]?>
            </td>
            <td  >
                <?=$referencia["ca_fchembarque"]?>
            </td>
            <td  >
                <?=$referencia["ca_fcharribo"]?>
            </td>
<?
    //if($nivel==1)
    {
?>
            <td>
                <img src="/images/16x16/edit.gif" style="cursor: pointer" onclick="radicar('<?=$referencia["ca_idmaster"]?>','id_<?=$referencia["ca_idmaster"]?>')" width="16" height="16"/>
            </td>
<?
    }
?>       
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

<?
if($sucursal=="BOG" && 1==2)
{
?>
    <h2> Referencias sin crear Carpeta</h2>
    <br />
    Sufijo<div id="filtro1"></div>
    <script>
    function recargar(combo, record, index)
    {
        if(parseInt(record.data.id)!="")
        {
            $("tr[class*=clase]").hide();
            $(".clase"+record.data.id).show();
        }
        else
            $("tr[class*=clase]").show();
    };
    function limpiar()
    {
        $("tr[class*=clase]").show();
    }
    var sufijo1=new WidgetParametros({
                                id:'sufijo1',
                                name:'sufijo1',
                                caso_uso:"CU010",
                                width:100,
                                ididentificador:"identificador",
                                renderTo:"filtro1"                                
                             });
    sufijo1.addListener("select", recargar, this);
    sufijo1.addListener("clear", limpiar, this);


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
            <th width="20" scope="col">&nbsp;</th>
        </tr>
        <?
        $i=0;
        foreach( $refcarpetas as $referencia ){
            $i++;

            $url = "antecedentes/verPlanilla?ref=".str_replace(".","|",$referencia["ca_referencia"]);
            $url.="&format=".$format;
            $url = "/colsys_php/inosea.php?boton=Consultar&id=".$referencia["ca_referencia"];
            $arrRef=explode(".", $referencia["ca_referencia"]);
            //if($i==1)
            //print_r($arrRef);
        ?>
        <tr class="clase<?=(int)$arrRef[1]?>" id="id_<?=str_replace(".","",$referencia["ca_idmaster"])?>">
            <td  >
                <?=link_to($referencia["ca_referencia"], $url)?>
            </td>
            <td  >
                <?=$referencia["ca_modalidad"]?>
            </td>
            <td  >
                <?=$referencia["ca_ciu_origen"] ?>
            </td>
            <td  >
                <?=$referencia["ca_ciu_destino"]?>
            </td>
            <td  >
                <?=$referencia["ca_motonave"]?>
            </td>
            <td  >
                <?=$referencia["ca_fchembarque"]?>
            </td>
            <td  >
                <?=$referencia["ca_fcharribo"]?>
            </td>
            <td>
                <img src="/images/16x16/edit.gif" style="cursor: pointer" onclick="archivar('<?=$referencia["ca_referencia"]?>','id_<?=str_replace(".","",$referencia["ca_idmaster"])?>')" width="16" height="16"/>
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

<script>
    function archivar(ref,id)
    {
        if(window.confirm("Ya creo la carpeta para archivar?"))
        {
            Ext.MessageBox.wait('Espere por favor', '');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("antecedentes/archivarReferencia") ?>',
                params :	{
                    referencia: ref
                },
                failure:function(response,options){
                    //alert( response.responseText );
                    Ext.Msg.hide();
                    success = false;
                    Ext.MessageBox.hide();
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        $("#"+id).html("");
                        $("#"+id).remove();
                        Ext.MessageBox.hide();
                    }
                }
            });
        }        
    }
    
    
    function radicar(idmaster,id)
    {
        if(window.confirm("Ya creo la carpeta para archivar?"))
        {
            Ext.MessageBox.wait('Espere por favor', '');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("antecedentes/radicarReferencia") ?>',
                params :	{
                    "idmaster": idmaster
                },
                failure:function(response,options){
                    //alert( response.responseText );
                    Ext.Msg.hide();
                    success = false;
                    Ext.MessageBox.hide();
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        $("#"+id).html("");
                        $("#"+id).remove();
                        Ext.MessageBox.hide();
                    }
                }
            });
        }        
    }
</script>
<?
}
}
?>
</div>