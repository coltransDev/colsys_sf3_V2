<?php
 
/**
 * homepage actions.
 *
 * @package    colsys
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class idsActions extends sfActions
{
	/**
	* Muestra la pagina inicial del modulo, le permite al usuario hacer busquedas.
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
        $this->modo = $request->getParameter("modo");
	}


    /**
	* Permite realizar busquedas en la tabla de proveedores
	*
	* @param sfRequest $request A request object
	*/
	public function executeBusqueda(sfWebRequest $request)
	{
        $this->modo = $request->getParameter("modo");

        $criterio = $request->getParameter("criterio");
        $cadena = $request->getParameter("cadena");

        $c = new Criteria();

		switch( $criterio ){
			case "nombre":
				$c->add( IdsPeer::CA_NOMBRE, "%". strtoupper($cadena)."%", Criteria::LIKE );
				break;
		}
		//$c->add( CotizacionPeer::CA_USUANULADO, null, Criteria::ISNULL );
		$c->addAscendingOrderByColumn( IdsPeer::CA_NOMBRE );
		$c->setLimit( 200 );

		$this->pager = new sfPropelPager('Ids', 30);
		$this->pager->setCriteria($c);
		$this->pager->setPage($this->getRequestParameter('page', 1));
		$this->pager->init();


		if( count($this->pager->getResults())==1 && count($this->pager->getLinks())==1  ){
			$ids = $this->pager->getResults();
			$this->redirect("ids/verIds?id=".$ids[0]->getCaId());
		}
		$this->criterio = $criterio;
		$this->cadena = $cadena;
	}


    /**
	* Muestra el formulario de creación y edicion de proveedores
	*
	* @param sfRequest $request A request object
	*/
	public function executeVerIds(sfWebRequest $request)
	{
        $this->modo = $request->getParameter("modo");
        $this->forward404Unless($request->getParameter("id"));
        $this->ids = IdsPeer::retrieveByPK($request->getParameter("id"));
        $this->forward404Unless($this->ids);
    }

    /**
	* Muestra el formulario de creación y edicion de proveedores
	*
	* @param sfRequest $request A request object
	*/
	public function executeFormIds(sfWebRequest $request)
	{
        $this->modo = $request->getParameter("modo");
        $this->form = new NuevoIdsForm();

        $formSucursal = new NuevaSucursalForm();

        $this->form->mergeForm($formSucursal);

        $ids = null;

        if( $request->getParameter("id") ){
            $ids = IdsPeer::retrieveByPK($request->getParameter("id"));
        }

        if( !$ids ){
            $ids = new Ids();
        }
        
        if ($request->isMethod('post')){		
		
			$bindValues = array();

            $bindValues["tipo_identificacion"] = $request->getParameter("tipo_identificacion");
            $bindValues["id"] = $request->getParameter("id");
            $bindValues["dv"] = $request->getParameter("dv");
            $bindValues["nombre"] = strtoupper($request->getParameter("nombre"));
            $bindValues["website"] = $request->getParameter("website");
            $bindValues["idgrupo"] = $request->getParameter("idgrupo");
            
            $bindValues["direccion"] = $request->getParameter("direccion");
            $bindValues["telefonos"] = $request->getParameter("telefonos");
            $bindValues["fax"] = $request->getParameter("fax");
            $bindValues["idciudad"] = $request->getParameter("idciudad");
            
            $this->form->bind( $bindValues );
			if( $this->form->isValid() ){
                
                $ids->setCaTipoidentificacion( $bindValues["tipo_identificacion"]);

                if( $bindValues["id"] ){
                    $ids->setCaId( $bindValues["id"]);
                }

                if( $bindValues["dv"] ){
                    $ids->setCaDv( $bindValues["dv"]);
                }
                
                $ids->setCaNombre($bindValues["nombre"]);
                $ids->setCaWebsite($bindValues["website"]);
                
                if( $ids->isNew() ){
                    $ids->setCaUsucreado( $this->getUser()->getUserId() );
                    $ids->setCaFchcreado( time() );
                }else{
                    $ids->setCaUsuactualizado( $this->getUser()->getUserId() );
                    $ids->setCaFchactualizado( time() );
                }                
                $ids->save();

                if( $bindValues["idgrupo"] ){
                    $ids->setCaIdgrupo( $bindValues["idgrupo"]);
                }else{
                    $ids->setCaIdgrupo( $ids->getCaId() );
                }
                $ids->save();

                /*
                * Guardar Sucursal
                */
                $sucursal = $ids->getSucursalPrincipal();
                if( !$sucursal ){
                    $sucursal = new IdsSucursal();
                    $sucursal->setCaPrincipal( true );

                    $sucursal->setCaUsucreado( $this->getUser()->getUserId() );
                    $sucursal->setCaFchcreado( time() );
                }else{
                    $sucursal->setCaUsuactualizado( $this->getUser()->getUserId() );
                    $sucursal->setCaFchactualizado( time() );
                }
                $sucursal->setCaId( $ids->getCaId());
                $sucursal->setCaDireccion( $request->getParameter("direccion"));
                $sucursal->setCaTelefonos( $request->getParameter("telefonos"));
                $sucursal->setCaIdciudad( $request->getParameter("idciudad"));
                $sucursal->setCaFax( $request->getParameter("fax"));
                
                $sucursal->save();
                
                $this->redirect("ids/verIds?id=".$ids->getCaId() );

            }
        }

        $this->ids = $ids;
	}

    /**
	* Muestra el formulario de creación y edicion de proveedores
	*
	* @param sfRequest $request A request object
	*/

    public function executeFormContactosIds(sfWebRequest $request){
        
    }
}
?>