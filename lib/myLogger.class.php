<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


class myLogger extends sfFileLogger
{
    protected function doLog($message, $priority)
    {
        
        $id = " [".(sfContext::getinstance()->getUser()?sfContext::getinstance()->getUser()->getUserId():"")." ".$_SERVER["REQUEST_METHOD"]." ".$_SERVER["REQUEST_URI"];

        if( $_SERVER["QUERY_STRING"] ){
            $id .=" query: ".$_SERVER["QUERY_STRING"];
        }

        if( $_SERVER["REQUEST_METHOD"]=="POST" && count($_POST)>0 ){
            $id .=" request: ". str_replace("\n", " ", var_export  ( $_POST, true ));
        }

        if( $_SERVER["REQUEST_METHOD"]=="GET" && count($_GET)>0 ){
            $id .=" request: ". str_replace("\n", " ", var_export  ( $_GET, true ));
        }

        $id .="]\n";
        

        parent::doLog($message.$id, $priority);
    }
}

?>
