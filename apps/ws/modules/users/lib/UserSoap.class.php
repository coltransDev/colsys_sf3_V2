<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

/**
 * Description of myClass
 *
 * @author abotero
 */
class UserSoap {
    /**
     * Add method
     *
     * @param string $usuario
     * @param string $signature
     * @return string
     */
    public function updateUser( $secret, $usuario ) {
        
        
        if( $secret!=sfConfig::get("app_soap_secret") ){
            return "Remote: La clave no concuerda";     
        }
        
        try{
            $usuario = unserialize($usuario);
            $newUsuario = Doctrine::getTable("Usuario")->find( $usuario->getCaLogin() );
            if( !$newUsuario ){
                $newUsuario = new Usuario();
                $newUsuario->setCaLogin( $usuario->getCaLogin());
            }
            $newUsuario->setCaNombre( $usuario->getCaNombre());
            $newUsuario->setCaCargo( $usuario->getCaCargo());
            $newUsuario->setCaDepartamento( $usuario->getCaDepartamento());
            $newUsuario->setCaEmail( $usuario->getCaEmail());
            $newUsuario->setCaExtension( $usuario->getCaExtension());
            $newUsuario->setCaIdsucursal( $usuario->getCaIdsucursal());
            $newUsuario->setCaAuthmethod( $usuario->getCaAuthmethod());
            $newUsuario->setCaPasswd( $usuario->getCaPasswd());
            $newUsuario->setCaSalt( $usuario->getCaSalt());
            $newUsuario->setCaActivo( $usuario->getCaActivo());
            $newUsuario->setCaCumpleanos( $usuario->getCaCumpleanos());
            $newUsuario->setCaManager( $usuario->getCaManager());
            $newUsuario->setCaNombres( $usuario->getCaNombres());
            $newUsuario->setCaApellidos( $usuario->getCaApellidos());
            $newUsuario->setCaTeloficina( $usuario->getCaTeloficina());
            $newUsuario->setCaTelparticular( $usuario->getCaTelparticular());
            $newUsuario->setCaMovil( $usuario->getCaMovil());
            $newUsuario->setCaDireccion( $usuario->getCaDireccion());
            $newUsuario->setCaTiposangre( $usuario->getCaTiposangre());
            $newUsuario->setCaNombrefamiliar( $usuario->getCaNombrefamiliar());
            $newUsuario->setCaParentesco( $usuario->getCaParentesco());
            
            $newUsuario->setCaUsucreado( $usuario->getCaUsucreado());
            $newUsuario->setCaUsuactualizado( $usuario->getCaUsuactualizado());
            $newUsuario->setCaFchcreado( $usuario->getCaFchcreado());
            $newUsuario->setCaFchactualizado( $usuario->getCaFchactualizado());
            $newUsuario->stopBlaming();
            $newUsuario->save();
        }catch( Exception $e ){
            return "Remote: ".$e->getMessage();
        }
        return null;
    }
}

?>
