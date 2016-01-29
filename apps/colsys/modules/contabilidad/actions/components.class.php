<?php

/**
 * gestDocumental components.
 *
 * @package    colsys
 * @subpackage gestDocumental
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class contabilidadComponents extends sfComponents
{
    
    public function executeGridConceptosSiigo() {
        $perfil = "borrar-conceptos-siigo-colsys";
        $usuario = Doctrine::getTable("Usuario")
               ->createQuery("u")
               ->innerJoin("u.UsuarioPerfil up")
               ->addWhere("u.ca_login=? AND u.ca_activo=? AND up.ca_perfil=? ", array($this->getUser()->getUserId(),'TRUE',$perfil))
               ->addOrderBy("u.ca_idsucursal")
               ->addOrderBy("u.ca_nombre")
               ->fetchOne();
        $this->puedeBorrar = "true";
        if ($usuario){
            $this->puedeBorrar = "false";
        }
    }
    
    public function executeGridCuentas(){
        $perfil = "borrar-conceptos-siigo-colsys";
        $usuario = Doctrine::getTable("Usuario")
               ->createQuery("u")
               ->innerJoin("u.UsuarioPerfil up")
               ->addWhere("u.ca_login=? AND u.ca_activo=? AND up.ca_perfil=? ", array($this->getUser()->getUserId(),'TRUE',$perfil))
               ->addOrderBy("u.ca_idsucursal")
               ->addOrderBy("u.ca_nombre")
               ->fetchOne();
        $this->puedeBorrar = "true";
        if ($usuario){
            $this->puedeBorrar = "false";
        }
    }
    
    public function executeFormConsultaComprobantes() {
        
    }
    
    public function executeGridConsultaComprobantes() {
        
    }
    
    
    public function executeFormWsFactColdepositos() {
        
    }
    
    public function executeGridWsFactColdepositos() {
        
    }
    
    
    
	
	
}
?>
