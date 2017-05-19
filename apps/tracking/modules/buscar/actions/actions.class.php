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

            $query = "
                SELECT DISTINCT  
                    max(t.ca_consecutivo) as ca_consecutivo,
                    max(t.ca_fchcreado) as ca_fchcreado,
                    ca_transporte, 
                    o.ca_ciudad as origen, 
                    d.ca_ciudad as destino,
                    rp.proveedores as proveedor,
                    ca_orden_clie
                FROM tb_reportes t
                    INNER JOIN tb_ciudades o ON o.ca_idciudad = t.ca_origen
                    INNER JOIN tb_ciudades d ON d.ca_idciudad = t.ca_destino
                    INNER JOIN tb_concliente t2 ON t.ca_idconcliente = t2.ca_idcontacto
                    INNER JOIN vi_repproveedores rp ON t.ca_idreporte = rp.ca_idreporte
                    LEFT JOIN tb_repstatus s ON t.ca_idreporte = s.ca_idreporte
                WHERE t.ca_fchcreado >= '".$date."'
                    AND t.ca_usuanulado IS NULL
                    AND t2.ca_idcliente = ".$this->getUser()->getClienteActivo();

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
                
            $query.=" GROUP BY 
                    ca_transporte,
                    o.ca_ciudad, 
                    d.ca_ciudad,                    
                    rp.proveedores,
                    ca_orden_clie";

            $query.=" ORDER BY ca_fchcreado DESC ";

            $query.=" LIMIT 100 ";
            
            $q = Doctrine_Manager::getInstance()->connection();
            $this->stmt = $q->execute($query);
            $this->resul = $this->stmt->fetchAll();
            
            $this->setTemplate("buscar");
        }
    }
}
?>