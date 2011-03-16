<?php

/**
 * general actions.
 *
 * @package    colsys
 * @subpackage general
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class generalActions extends sfActions
{
 
 	public function executeFileViewer(){
		$idx = $this->getRequestParameter("idx"); 
		$this->name = $this->getUser()->getFile( $idx );		
	}
	
	public function executeAttachmentViewer(){
		$idx = $this->getRequestParameter("idx"); 
		$this->attachment = EmailAttachmentPeer::retrieveByPk( $idx );				
		
	}
	
	/*
	* 
	*/
	
	public function executeListaClientesJSON( $request ){




        $criterio =  $request->getParameter("query");

        if( $criterio ){
            $q = Doctrine_Query::create()
                            ->select(" cl.ca_idcliente, cl.ca_compania,cl.ca_tipo,
                                      cl.ca_preferencias, cl.ca_confirmar, cl.ca_vendedor, cl.ca_coordinador,
                                      v.ca_nombre, cl.ca_listaclinton, cl.ca_fchcircular
                                      ,cl.ca_status, cl.ca_vendedor, lc.ca_cupo, lc.ca_diascredito
                                     ")
                            ->from("Cliente cl")
                            ->leftJoin("cl.LibCliente lc")
                            ->leftJoin("cl.Usuario v")
                            ->where("UPPER(cl.ca_compania) like ?", "%".strtoupper( $criterio )."%")
                            ->addOrderBy("cl.ca_compania ASC")
                            ->setHydrationMode( Doctrine::HYDRATE_SCALAR )
                            ->limit(40);
            
            $rows=$q->execute();



            $clientes = array();

            foreach ( $rows as $row ) {
                $result = array();
                $result["ca_idcliente"]=utf8_encode($row["cl_ca_idcliente"]);
                $result["ca_compania"]=utf8_encode($row["cl_ca_compania"]);
                $clientes[]=$result;

            }
            $this->responseArray = array( "totalCount"=>count( $clientes ), "clientes"=>$clientes  );
        }else{
            $this->responseArray = array( "totalCount"=>0, "clientes"=>array()  );
        }
        $this->setTemplate("responseTemplate");



	}
}
?>