<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<div class="content">
    <form action="<?=url_for("antecedentes/enviarCorreo?master=".$master)?>" method="post">
        <?
        $subject ="Entrega de Antecedentes";
        $message = "";
        
        if($user->getEmail()=="sercliente-mar1@coltrans.com.co" || $user->getEmail()=="sercliente-mar2@coltrans.com.co" || $user->getEmail()=="sercliente-mar3@coltrans.com.co" || $user->getEmail()=="sercliente-mar4@coltrans.com.co" || $user->getEmail()=="sercliente-mar5@coltrans.com.co" ){
            $from = array('sercliente-mar1@coltrans.com.co'=>'sercliente-mar1@coltrans.com.co', 'sercliente-mar2@coltrans.com.co'=>'sercliente-mar2@coltrans.com.co',
                'sercliente-mar3@coltrans.com.co'=>'sercliente-mar3@coltrans.com.co', 'sercliente-mar4@coltrans.com.co'=>'sercliente-mar4@coltrans.com.co', 'sercliente-mar5@coltrans.com.co'=>'sercliente-mar5@coltrans.com.co');
        }else{
            $from=array();
        }

        $contactos = "";
        include_component("email", "formEmail", array("subject"=>$subject, "message"=>$message, "contacts"=>$contactos, "from"=> $from ));

        ?>
        <br />
        <div align="center">
            <input type="submit" value="enviar" class="button" />
        </div>
        <br />
       
        <?
        include_component("antecedentes", "listaReportesMaster", array("master"=>$master));
        ?>

   
    </form>
    
</div>


