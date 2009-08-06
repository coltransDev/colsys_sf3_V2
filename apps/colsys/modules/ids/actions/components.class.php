<?php

/**
 * ids components.
 *
 * @package    colsys
 * @subpackage ids
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class idsComponents  extends sfComponents
{
	/**
	* Muestra los contactos
	*	
	*/
	public function executeContactos()
	{
		$c = new Criteria();
        $c->addJoin(IdsSucursalPeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD );
        $c->add(IdsSucursalPeer::CA_ID, $this->ids->getCaId() );
        $c->addDescendingOrderByColumn(IdsSucursalPeer::CA_PRINCIPAL);
        $c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );
        $this->sucursales = IdsSucursalPeer::doSelect( $c );
		
		
	}

    /**
	* Muestra los documentos
	*
	*/
    public function executeDocumentos()
	{
		$c = new Criteria();
        $c->addJoin(IdsDocumentoPeer::CA_IDTIPO, IdsTipoDocumentoPeer::CA_IDTIPO );
        $c->add(IdsDocumentoPeer::CA_ID, $this->ids->getCaId() );
       
        $c->addAscendingOrderByColumn( IdsTipoDocumentoPeer::CA_TIPO );
        $c->addDescendingOrderByColumn( IdsDocumentoPeer::CA_FCHCREADO );
        $this->documentos = IdsDocumentoPeer::doSelect( $c );


	}

    /**
	* Muestra las evaluaciones
	*
	*/
    public function executeEvaluaciones()
	{
		$c = new Criteria();
       
        $c->add(IdsEvaluacionPeer::CA_ID, $this->ids->getCaId() );        
        $c->addDescendingOrderByColumn( IdsEvaluacionPeer::CA_FCHEVALUACION );
        $this->evaluaciones = IdsEvaluacionPeer::doSelect( $c );


	}

    /**
	* Muestra los eventos
	*
	*/
    public function executeEventos()
	{
		$c = new Criteria();

        $c->add(IdsEventoPeer::CA_ID, $this->ids->getCaId() );
        $c->addDescendingOrderByColumn( IdsEventoPeer::CA_FCHCREADO );
        $this->eventos = IdsEventoPeer::doSelect( $c );


	}
}
