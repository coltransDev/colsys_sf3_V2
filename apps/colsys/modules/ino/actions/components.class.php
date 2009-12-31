<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * ino components.
 *
 * @package    colsys
 * @subpackage ino
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */

class inoComponents extends sfComponents
{
    
    public function executeClientes(){
        $this->inoClientes = Doctrine::getTable("InoCliente")
                                 ->createQuery("c")
                                 ->select("c.*")
                                 ->innerJoin("c.Ids cl")
                                 ->where("c.ca_idmaestra = ?", $this->referencia->getCaIdmaestra())
                                 ->addOrderBy( "cl.ca_nombre" )
                                 ->execute();
    }

    public function executeIngresos(){

        $this->inoClientes = Doctrine::getTable("InoCliente")
                                 ->createQuery("c")
                                 ->select("c.*")
                                 ->innerJoin("c.Ids cl")
                                 ->where("c.ca_idmaestra = ?", $this->referencia->getCaIdmaestra())
                                 ->addOrderBy( "cl.ca_nombre" )
                                 ->execute();
                                 
    }

    public function executeCostos(){
        $this->costos = Doctrine::getTable("InoTransaccion")
                                 ->createQuery("t")
                                 ->select("t.*, c.ca_consecutivo, con.ca_concepto, id.ca_nombre, tp.ca_tipo, tp.ca_comprobante")
                                 ->innerJoin("t.InoComprobante c")
                                 ->innerJoin("c.InoTipoComprobante tp")
                                 ->innerJoin("t.InoConcepto con")
                                 ->innerJoin("c.Ids id")
                                 ->where("t.ca_idmaestra = ?", $this->referencia->getCaIdmaestra())
                                 //->addWhere("c.ca_estado = ?", InoComprobante::TRANSFERIDO)
                                 ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                 ->execute();

    }

    public function executeAuditoria(){
        /*$this->costos = Doctrine::getTable("InoTransaccion")
                                 ->createQuery("t")
                                 ->select("t.*, c.ca_consecutivo, con.ca_concepto, id.ca_nombre, tp.ca_tipo, tp.ca_comprobante")
                                 ->innerJoin("t.InoComprobante c")
                                 ->innerJoin("c.InoTipoComprobante tp")
                                 ->innerJoin("t.InoConcepto con")
                                 ->innerJoin("c.Ids id")
                                 ->where("t.ca_idmaestra = ?", $this->referencia->getCaIdmaestra())
                                 //->addWhere("c.ca_estado = ?", InoComprobante::TRANSFERIDO)
                                 ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                 ->execute();*/

    }


}


