<?php

/**
 * subastas actions.
 *
 * @package    symfony
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class subastasComponents extends sfComponents {

    public function executeListaOfertas() {
        $maxvalor = Doctrine::getTable("SubOferta")
                ->createQuery("o")
                ->select("MAX(ca_valor)")
                ->addWhere("o.ca_idarticulo = ? ", $this->articulo->getCaIdarticulo())
                ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                ->execute();

        if (!$maxvalor) {
            $this->valor = $this->articulo->getCaValor();
        } else {
            $this->valor = $maxvalor + $this->articulo->getCaIncremento();
        }

        if ($this->valor > $this->articulo->getCaTope()) {
            $this->valor = $this->articulo->getCaTope();
        }

        $this->ofertas = Doctrine::getTable("SubOferta")
                ->createQuery("o")
                ->addWhere("o.ca_idarticulo = ? ", $this->articulo->getCaIdarticulo())
                ->addOrderBy("ca_fchcreado DESC")
                ->execute();

        $this->user = $this->getUser();
    }
    
    
    public function executeListaSubastas() {
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId()?$this->getUser()->getUserId():"Administrador");
        $grupoEmp = $usuario->getGrupoEmpresarial();
        
        $this->articulos = Doctrine::getTable("SubArticulo")
                     ->createQuery("a") 
                     ->leftJoin("a.Sucursal s")
                     ->addWhere("a.ca_usucomprador IS NULL")
                     ->addWhere("a.ca_fchvencimiento >= ? ", date("Y-m-d H:i:s"))
                     ->andWhereIn("a.ca_idempresa",$grupoEmp)  
                     ->andWhere("s.ca_nombre = ? OR a.ca_idsucursal IS NULL",array($usuario->getSucursal()->getCaNombre()))
                     ->addOrderBy("a.ca_fchcreado DESC")
                     ->limit(5)
                     ->execute();
        
        $this->user = $this->getUser();
    }

}

