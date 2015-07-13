<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class widgets4Actions extends sfActions {

    public function executeDatosTraficos() {
        $criterio = $this->getRequestParameter("query");
        
        if($criterio){
            $q = Doctrine::getTable('Trafico')->createQuery('t')
                    ->where('t.ca_idtrafico != ?', '99-999')
                    ->andWhere('LOWER(t.ca_nombre) like ?','%'.$criterio.'%')
                    ->addOrderBy('t.ca_nombre ASC');
                    

            /*$this->data = array();
            foreach ($traficos as $trafico) {
                $this->data[] = array("nombre" => utf8_encode($trafico->getCaNombre()),
                    "idtrafico" => $trafico->getCaIdtrafico()
                );
            }*/
            //echo $q->getSqlQuery();
            $traficos = $q->execute();
            $this->data = array();
            foreach ($traficos as $trafico) {
                $row = array();
                $row["idtrafico"] = $trafico->getCaIdtrafico();
                $row["nombre"] = utf8_encode($trafico->getCaNombre());                             
                $data[] = $row;
            }
            $this->responseArray = array("total" => count($data), "root" => $data, "success" => true,"debug"=>$sql);
        } else {
            $this->responseArray = array("total" => 0, "root" => array(), "success" => true,"debug"=>$sql);
        }
        $this->setTemplate("responseTemplate");       
    }
        

}

?>
