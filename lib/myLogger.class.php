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
        
        $id = " [".sfContext::getinstance()->getUser()->getUserId()." ".$_SERVER["REQUEST_METHOD"]." ".$_SERVER["REQUEST_URI"];
        
        if( $_SERVER["QUERY_STRING"] ){
            $id .=" query: ".$_SERVER["QUERY_STRING"];
        }

        if( count($_REQUEST)>0 ){
            $id .=" request: ".var_export  ( $_REQUEST, true );
        }

        $id .="]";

        parent::doLog($message.$id, $priority);
    }
}

?>
