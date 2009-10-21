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
                                 ->innerJoin("c.Cliente cl")
                                 ->where("c.ca_idmaestra = ?", $this->referencia->getCaIdmaestra())
                                 ->addOrderBy( "cl.ca_compania" )
                                 ->execute();
    }
}

