<?php

/**
 * buscar actions.
 *
 * @package    colsys
 * @subpackage buscar
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class buscarActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex( $request )
	{

		if ($request->isMethod('post')){
		
			$criterio = trim($this->getRequestParameter("criterio"));
			$buscar_por = $this->getRequestParameter("buscar_por");
			$buscar_en = $this->getRequestParameter("buscar_en"); 
								
			$c = new Criteria();
			$c->add( ContactoPeer::CA_IDCLIENTE , $this->getUser()->getClienteActivo() );	
			$c->addJoin( ReportePeer::CA_IDCONCLIENTE , ContactoPeer::CA_IDCONTACTO );					
			$c->addDescendingOrderByColumn( ReportePeer::CA_FCHREPORTE );
			$c->add( ReportePeer::CA_FCHREPORTE,"2008-04-01" , Criteria::GREATER_EQUAL );
			$c->add( ReportePeer::CA_USUANULADO, null, Criteria::ISNULL );
			$c->setDistinct();
			$c->setLimit(100);
	
			switch( $buscar_por ){
				case "no_pedido":
					$c->add(ReportePeer::CA_ORDEN_CLIE, "%".$criterio."%", Criteria::LIKE );
									
					break;
				case "hbl_hawb":
					$c->addJoin( ReportePeer::CA_IDREPORTE ,RepAvisoPeer::CA_IDREPORTE);
					$c->add( RepAvisoPeer::CA_DOCTRANSPORTE, "%".$criterio."%", Criteria::LIKE );
					
					break;
				case "proveedor":
					$c->addJoin( ReportePeer::CA_IDPROVEEDOR ,TerceroPeer::CA_IDTERCERO );
					$c->add( TerceroPeer::CA_NOMBRE, TerceroPeer::CA_NOMBRE." LIKE '%".strtoupper($criterio)."%'", Criteria::CUSTOM );
					break;
				case "reporte":					
					$c->add(ReportePeer::CA_CONSECUTIVO, "%".$criterio."%", Criteria::LIKE );
									
					break;
				default:
					exit();
					break;	
			}
			$this->reportes = ReportePeer::doSelect( $c );				
			$this->setTemplate("buscar");
		}
	}
	
	
	
	
}
?>