<?php

/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * cotizaciones components.
 *
 * @package    colsys
 * @subpackage reportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class bodegaComponents extends sfComponents
{



    public function executeIndex()
	{
        $q = Doctrine::getTable("Bodega")
                ->createQuery("b")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->distinct();

        $this->tbodegas = $q->select("ca_tipo")
                ->execute();

        $this->transportes = $q->select("ca_transporte")
                ->execute();

    }
}
?>