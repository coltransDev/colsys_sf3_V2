<style>
    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;        
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 2px;        
    }
      
    #customers th {
        text-align: left;
        background-color: #3892D4;
        color: white;
    }    
    
</style>

<?php
$data = $sf_data->getRaw("data");
$asunto = $sf_data->getRaw("asunto");
?>
<!--COLDEPOSITOS LOGISTICA-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    </head>        
    <body bgcolor="">    
        <table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:tahoma,sans-serif;color: #222">
            <tr><td colspan="5">
                    <table><tbody><tr><td><img src="http://www.coltrans.com.co/logosoficiales/coldepositos/ColdepositosMed.jpg">
                        </td><td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b><div style="font-family:tahoma,sans-serif;display:inline">
                        &nbsp;&nbsp;CIRCULAR FACTURACION ELECTRONICA COLDEPOSITOS LOGISTICA S.A.S.</div></b></font></td></tr></tbody></table>
                </td></tr>
            <tr><td><hr noshade size="1"></td></tr>
            <tr>
                <td style="padding:20px">
                    <div style="text-align: justify;font-size: 12px">
                        <p align="justify">
                            Bogotá, D.C. <?= date("d") ?> de <?= Utils::mesLargo(date("m")) ?> de <?= date("Y") ?>                                                                        
                        </p><br/>
                        <p align="justify">
                            <b>Apreciados Clientes,</b>
                        </p><br/>                        
                        <p align="justify">
                            Dando cumplimiento a la resolución 000042 expedida 05 de mayo 2020 por la DIAN en la cual se&ntilde;alan los requisitos de facturación electrónica de venta con validación previa a su expedición, así como condiciones, términos y mecanismos técnicos y tecnológicos para su implementación, por medio de la presente informamos que a partir del 01 noviembre del 2020 COLDEPOSITOS LOGISTICA SAS dará inicio a la emisión de facturación electrónica a través de nuestro proveedor tecnológico OPEN ETL.
                        </p>
                        <p align="justify">                            
                            Por lo anterior agradecemos tener en cuenta los siguientes aspectos:
                        </p>
                        <p align="justify">
                            1. La factura llegará solo al correo de facturación electrónica designado previamente por cada cliente.
                        </p>
                        <p align="justify">
                            2. Los soportes de cada factura serán enviados por correo electrónico por separado una vez se haya generado.
                        </p><br/>
                        <p align="justify">
                            La facturación electrónica nos permite mejorar en el tiempo de entrega de las facturas con sus soportes, así mismo contribuir al cuidado del medio ambiente.
                        </p>
                        <br/>                                              
                        <p align="justify">
                            Cordialmente,
                        </p><br/><br/>
                        <p align="left">                            
                            <b>CLAUDIA MEDINA F.</b><br/>
                            <b>Gerente General</b><br/>                            
                        </p><br/>                        
                        <br/><br/>
                        <table width="100%"><tr><td>
                        
                        </td><td>
                        <p align="right" style="font-size: 12px;">                                                       
                            <b>Bogotá D.C.</b><br/>
                            Carrera 106 15A-25 Lote 114D Mnz 16 Bodega 2<br/>
                            Zona Franca de Bogotá S.A.<br/>
                            Pbx: (57-1) 742 2360<br/>                            
                            Cod. Postal: 110911<br/>
                            servicioalcliente@coldepositos.com.co<br/>
                            www.coldepositos.com.co<br/>
                            NIT: 900841486<br/>                            
                        </p>
                        </td></tr></table>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>