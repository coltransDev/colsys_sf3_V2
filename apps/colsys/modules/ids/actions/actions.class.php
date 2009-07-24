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

        if($request->getParameter("id")){
            $ids = IdsPeer::retrieveByPK($request->getParameter("id"));
            $this->forward404Unless($ids);            
        }else{
            $ids = new Ids();
        }
        
        if ($request->isMethod('post')){		
		
			$bindValues = array();

            $bindValues["tipo_identificacion"] = $request->getParameter("tipo_identificacion");
            $bindValues["identificacion"] = $request->getParameter("identificacion");
            $bindValues["dv"] = $request->getParameter("dv");
            $bindValues["nombre"] = $request->getParameter("nombre");
            $bindValues["website"] = $request->getParameter("website");
            $bindValues["idgrupo"] = $request->getParameter("idgrupo");

            $this->form->bind( $bindValues );
			if( $this->form->isValid() ){
                
               
                $ids->setCaTipoidentificacion( $bindValues["tipo_identificacion"]);


                if( $bindValues["identificacion"] ){
                    
                }

                if( $bindValues["identificacion"] ){
                    $ids->setCaId( $bindValues["identificacion"]);
                }

                if( $bindValues["dv"] ){
                    $ids->setCaDv( $bindValues["dv"]);
                }
                
                $ids->setCaNombre($bindValues["nombre"]);
                $ids->setCaWebsite($bindValues["website"]);

                if($request->getParameter("id")){
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

                $this->redirect("ids/verIds?id=".$ids->getCaId() );

            }
        }

        $this->ids = $ids;
	}
}
?>