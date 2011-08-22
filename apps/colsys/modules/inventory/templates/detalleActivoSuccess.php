<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="content" align="center">     
   
    <?
    if( $parameter=="Hardware" ){
    ?>
    
    <h2>Detalle de Activo</h2><br/>    
    <table class="tableList alignLeft">  
        <tr>        
            <th> 
                <b>Asignado a</b>
            </th>  
            <td>
                <?=$activo->getUsuario()?$activo->getUsuario()->getCaNombre():"&nbsp;"?>
            </td>    
        </tr>
        <tr>  
            <th>
                <b>Serial</b>
            </th>            
            <td>
                <?=$activo->getCaSerial()?>
            </td>
        </tr> 
        <tr> 
            <th>
                <b>Windows OEM</b>
            </th> 
            <td>
                <?=$activo->getCaSo()?>
            </td>    
        </tr>     
        <tr> 
            <th>
                <b>Serial</b>
            </th>
            <td>
                <?=$activo->getCaSoSerial()?>
            </td>
        </tr>
        <tr> 
            <th>
                <b>Office OEM</b>
            </th>  
            <td>
                <?=$activo->getCaOffice()?>
            </td>
        </tr>     
        <tr> 
            <th>
                <b>Serial</b>
            </th>  
            <td>
                <?=$activo->getCaOfficeSerial()?>
            </td>
        </tr>     
        <tr> 
            <th>
                <b>Departamento</b>
            </th> 
            <td>
                <?=$activo->getUsuario()?$activo->getUsuario()->getCaDepartamento():"&nbsp;"?>
            </td>
        </tr>     
        <tr> 
            <th>
                <b>Sucursal</b>
            </th>
            <td>
                <?=$activo->getSucursal()?$activo->getSucursal()->getCaNombre():"&nbsp;"?>
            </td>
        </tr>
    
    </table>
    <?
    }

    if( $parameter=="Software" ){
    ?> 
    
    <h2>Detalle de Software</h2><br/>    
    <table class="tableList alignLeft">     
        <tr>  
            <th>
                <b>Identificador</b>
            </th>            
            <td>
                <?=$activo->getCaIdentificador()?>
            </td>
        </tr>
        <tr>  
            <th>
                <b>Marca</b>
            </th>            
            <td>
                <?=$activo->getCaMarca()?>
            </td>
        </tr>
        <tr>  
            <th>
                <b>Serial</b>
            </th>            
            <td>
                <?=$activo->getCaSerial()?>
            </td>
        </tr>
    </table>
    <?
    }
    
    if( $parameter=="Hardware" || $parameter=="Software"  ){
    ?>
    
    <br />
    <h2><?=$parameter=="Hardware"?"Software asignado":"Activos Asignados"?></h2>    
    <br />
    <table class="tableList alignLeft"> 
        <tr>        
            <th> 
                <b>Identificador</b>
            </th>  
            <th> 
                <b>Marca</b>           
            </th>              
        </tr>    
     <?
     
    foreach( $asig as $a ){
        ?>
        <tr>        
            <td> 
                <?=link_to($a->getCaIdentificador(), "inventory/detalleActivo?idactivo=".$a->getCaIdactivo() )?>               
            </td>  
            <td> 
                <?=$a->getCaMarca()." ".$a->getCaModelo()?>              
            </td>  
        </tr> 
        <?        
    }
    ?>
    </table>    
    <?
    }
    ?>
        
</div>