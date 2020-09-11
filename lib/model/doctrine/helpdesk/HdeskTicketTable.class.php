<?php

/**
 */
class HdeskTicketTable extends Doctrine_Table {
    /*
     * Devuelve true si el usuario tiene acceso al ticket
     * @author Andres Botero
     */

    public static function retrieveIdTicket($idticket, $nivel,$user=null) {

        if($user==null)
        {
            $user = Doctrine::getTable("Usuario")->find(sfContext::getInstance()->getUser()->getUserId());
            $iddepartamento=sfContext::getInstance()->getUser()->getIddepartamento();           
        }
        else
        {
             $departamento = Doctrine::getTable("Departamento")
                 ->createQuery("d")
                 ->where("d.ca_nombre = ?", $user->getCaDepartamento())
                 ->fetchOne();
            $iddepartamento=$departamento->getCaIddepartamento();            
        }
        

        
        
        $q = Doctrine_Query::create()->from("HdeskTicket h");
        $q->where("h.ca_idticket = ?", $idticket);
        /*$ticket = $q->fetchOne();
        /*
         * Aplica restricciones de acuerdo al nivel de acceso.
         */
        
          switch ($nivel) {
            case 0:
                $q->leftJoin("h.HdeskTicketUser hu  ");
                $q->addWhere("(h.ca_login = ? OR hu.ca_login = ?)", array($user->getCaLogin(), $user->getCaLogin()));

                break;
            case 1:
                $q->leftJoin("h.HdeskUserGroup ug "); 
                $q->leftJoin("h.HdeskTicketUser hu  ");
                $q->addWhere("(h.ca_login = ? OR ug.ca_login = ? OR hu.ca_login = ? )", array($user->getCaLogin(), $user->getCaLogin(), $user->getCaLogin()));
                break;
            case 2:                
                $depAdic = $user->getProperty("helpDesk");
                if($depAdic){
                
                    $d = Doctrine::getTable("Departamento")
                          ->createQuery("d");

                    if(strpos($depAdic,"|"))
                        $d->orWhereIn("d.ca_nombre", explode("|",$depAdic));
                    else
                        $d->orWhere("d.ca_nombre = ?", $depAdic);            

                    $departamentos = $d->execute();

                    foreach($departamentos as $d){                    
                        $deps[] = $d->getCaIddepartamento();                                        
                    }
                }
                $deps[] = $iddepartamento;
                
                $q->leftJoin("h.HdeskGroup g ");
                $q->leftJoin("h.HdeskTicketUser hu  ");    
                $q->addWhere("(h.ca_login = '".$user->getCaLogin()."' OR g.ca_iddepartament IN (".implode(",", $deps).") OR hu.ca_login = '".$user->getCaLogin()."')");                
                break;
        } 
//        echo $idticket."<br>".$user->getCaLogin()."<br>".$iddepartamento."<br>".$user->getCaLogin()."<br>";
//        print_r($deps);
//        echo $q->getSqlQuery();
//        exit;
        return $q->fetchOne();
    }
    

    public function getLuceneIndex() {

        ProjectConfiguration::registerZend();
        $index = $this->getLuceneIndexFile();
        Zend_Search_Lucene_Analysis_Analyzer::setDefault(
            new Zend_Search_Lucene_Analysis_Analyzer_Common_TextNum_CaseInsensitive()
        );
        //Zend_Search_Lucene_Search_Query_Wildcard::setMinPrefixLength(0);

        if (file_exists($index)) {
            return Zend_Search_Lucene::open($index);
        } else {
            return Zend_Search_Lucene::create($index);
        }
    }

    public function getLuceneIndexFile() {

        return sfConfig::get('app_digitalFile_root') . '/indexes/tickets.index';
    }

    public function getForLuceneQuery($query) {
        $pks = $this->getPksForLuceneQuery($query);

        $q = $this->createQuery('j')
                        ->whereIn('j.ca_idticket', $pks)
                        ->limit(500);


        return $q->execute();
    }

    public function getPksForLuceneQuery($query) {
       
        $hits = self::getLuceneIndex()->find($query);
        $pks = array();
        foreach ($hits as $hit) {
            $pks[] = $hit->pk;
        }

        if (empty($pks)) {
            return array();
        }

        return $pks;
    }

}