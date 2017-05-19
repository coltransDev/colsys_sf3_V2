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
        $usuario = unserialize($usuario);
            $newUsuario = Doctrine::getTable("Usuario")->find( $usuario->getCaLogin() );
        try{

            
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
            
//            $newUsuario->save($con);
//            $con->commit();
        }catch( Exception $e ){
            return "Remote: ".$e->getMessage()." server:".$_SERVER["SERVER_ADDR"];//." u:".$usuario."-nu:".$newUsuario;
        }
        return $newUsuario->getCaTeloficina();
    }
    
     /**
     * getUsers method
     *     
     * @return array string
     */    
    public function getUsers( ) {
        
        try{
//->where("u.ca_activo=? and ca_email is not null and ca_departamento = 'Sistemas' ", array('TRUE'))
            $users=array();
            $usuarios = Doctrine::getTable("Usuario")
               ->createQuery("u")
               ->select("u.*,s.ca_idsucursal,e.ca_idempresa,e.ca_nombre as compania")
               ->innerJoin("u.Sucursal s")
               ->innerJoin("s.Empresa e")
               ->where("u.ca_activo=? and ca_email is not null and e.ca_idempresa=2 ", array('TRUE'))
               ->addOrderBy("u.ca_idsucursal")
               ->addOrderBy("u.ca_nombre")
               ->limit(10)
               ->execute();
            foreach($usuarios as $u)   
            {
                $users[]=array("nombre"=>$u->getCaNombres(),"apellidos"=>$u->getCaApellidos(),"cargo"=>$u->getCaCargo(),"departamento"=>$u->getCaDepartamento(),
                    "email"=>$u->getCaEmail(),"movil"=>$u->getCaMovil(),"teloficina"=>$u->getCaTeloficina(),
                     "compania"=>$u->getCompania());
            }
            return $users;
//            $newUsuario->save($con);
//            $con->commit();
        }catch( Exception $e ){
            return "Remote: ".$e->getMessage()." server:".$_SERVER["SERVER_ADDR"];//." u:".$usuario."-nu:".$newUsuario;
        }
        return null;
    }
    
    
}

?>
