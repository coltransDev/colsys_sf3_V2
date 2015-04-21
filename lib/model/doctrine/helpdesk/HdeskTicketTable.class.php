<?php

/**
 */
class HdeskTicketTable extends Doctrine_Table {
    /*
     * Devuelve true si el usuario tiene acceso al ticket
     * @author Andres Botero
     */

    public static function retrieveIdTicket($idticket, $nivel) {

        $user = sfContext::getInstance()->getUser();
        $q = Doctrine_Query::create()->from("HdeskTicket h");
        $q->where("h.ca_idticket = ?", $idticket);
        /*$ticket = $q->fetchOne();
        /*
         * Aplica restricciones de acuerdo al nivel de acceso.
         */
        
        switch ($nivel) {
            case 0:
                $q->leftJoin("h.HdeskTicketUser hu  ");
                $q->addWhere("(h.ca_login = ? OR hu.ca_login = ?)", array($user->getUserid(), $user->getUserid()));
                break;
            case 1:
                $q->leftJoin("h.HdeskUserGroup ug ");
                $q->leftJoin("h.HdeskTicketUser hu  ");
                $q->addWhere("(h.ca_login = ? OR ug.ca_login = ? OR hu.ca_login = ? )", array($user->getUserid(), $user->getUserid(), $user->getUserid()));
                break;
            case 2:
                $q->leftJoin("h.HdeskGroup g ");
                $q->leftJoin("h.HdeskTicketUser hu  ");
                $q->addWhere("(h.ca_login = ? OR g.ca_iddepartament = ? OR hu.ca_login = ?)", array($user->getUserid(), $user->getIddepartamento(), $user->getUserid()));
                break;
        }
        //echo $q->getSqlQuery();
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