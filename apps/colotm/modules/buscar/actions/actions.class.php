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
        
        if( !$this->getUser()->getClienteActivo() ){
			$this->redirect( "homepage/index");
		}

		if ($request->isMethod('post')){


			$criterio = trim($this->getRequestParameter("criterio"));
			$buscar_por = $this->getRequestParameter("buscar_por");
			$buscar_en = $this->getRequestParameter("buscar_en"); 
			
            
            $date = date("Y-m-d", time()-86400*365);




            $query = "SELECT DISTINCT  t.ca_consecutivo, ca_transporte, t.ca_fchcreado,
                        o.ca_ciudad as origen, d.ca_ciudad as destino, t3.ca_nombre as proveedor, ca_orden_clie
                      FROM tb_reportes t
                      INNER JOIN tb_ciudades o ON o.ca_idciudad = t.ca_origen
                      INNER JOIN tb_ciudades d ON d.ca_idciudad = t.ca_destino
                      INNER JOIN tb_concliente t2 ON t.ca_idconcliente = t2.ca_idcontacto
                      INNER JOIN tb_terceros t3 ON t.ca_idproveedor = t3.ca_idtercero::text
                      LEFT JOIN tb_repstatus s ON t.ca_idreporte = s.ca_idreporte
                      WHERE t.ca_fchcreado >= '".$date."'
                        AND t.ca_usuanulado IS NULL
                        AND t2.ca_idcliente = ".$this->getUser()->getClienteActivo()."
                       ";

			
	
			switch( $buscar_por ){
				case "no_pedido":
                    $query.=" AND UPPER(t.ca_orden_clie) LIKE '%".strtoupper($criterio)."%'";
					break;
				case "hbl_hawb":
                    $query.=" AND UPPER(s.ca_doctransporte) LIKE '%".strtoupper($criterio)."%'";
					break;
				case "proveedor":                    
                    $query.=" AND UPPER(t3.ca_nombre) LIKE '%".strtoupper($criterio)."%'";
					break;
				case "reporte":
                    $query.=" AND t.ca_consecutivo LIKE '%".$criterio."%'";
					break;
				default:
					exit();
					break;	
			}

            $query.=" ORDER BY t.ca_fchcreado DESC ";

            $query.=" LIMIT 100 ";

            //echo $query;
			//$q = Doctrine_Manager::getInstance()->connection();
            $con = Doctrine_Manager::getInstance()->connection();
//            echo $sql;
            $st = $con->execute($query);
            $this->resul = $st->fetchAll();           
            
			$this->setTemplate("buscar");
		}
	}
	
}
?>