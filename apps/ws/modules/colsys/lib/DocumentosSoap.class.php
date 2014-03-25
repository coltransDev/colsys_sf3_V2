<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

/**
 * Description of DocumentosSoap
 *
 * @author maquinche
 */
class DocumentosSoap {
    /**
     * ResponseDocumento method
     *
     * @param string $key_secret
     * @param string $archivoBlob     
     * @return string
     */
    public function responseDocumento( $key_secret, $archivoBlob ) {
        
        if( $key_secret!=sfConfig::get("app_soap_secret") ){
            return "Remote: La clave no concuerda";     
        }
        
        

        

        try{
            $id=0;

                
                try{
                    $file = "/home/maquinche/Desarrollo/digitalFile/Referencias/prueba.pdf";
                    $fp = fopen( $file, 'w+');
                    fwrite($fp, $archivoBlob);
                    fclose($fp);
                    
                    return "success";
                }catch(Exception $e){ 
                    return "Remote: ".$e->getMessage()." server:".$_SERVER["SERVER_ADDR"]." ticket:".$idticket;
                }
        }
        catch (Exception $e)
        {
            return "Remote: ".$e->getMessage()." server:".$_SERVER["SERVER_ADDR"]." ticket:".$idticket;
        } 
    }

 
}

?>
