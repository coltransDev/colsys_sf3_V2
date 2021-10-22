<?php
/**
 */
class HdeskResponseTable extends Doctrine_Table
{
    public function getLuceneIndex() {

        ProjectConfiguration::registerZend();

        Zend_Search_Lucene_Analysis_Analyzer::setDefault(
            new Zend_Search_Lucene_Analysis_Analyzer_Common_TextNum_CaseInsensitive()
        );

        $index = $this->getLuceneIndexFile();

        if (file_exists($index)) {
            return Zend_Search_Lucene::open($index);
        } else {
            return Zend_Search_Lucene::create($index);
        }
    }

    public function getLuceneIndexFile() {

        return sfConfig::get('app_digitalFile_root') . '/indexes/responses.index';
    }

    public function getForLuceneQuery($query) {
        $pks = $this->getPksForLuceneQuery($query);

        $q = $this->createQuery('j')
                        ->whereIn('j.ca_idresponse', $pks)
                        ->limit(500);


        return $q->execute();
    }

    public function getPksForLuceneQuery($query) {
        ProjectConfiguration::registerZend();
        Zend_Search_Lucene_Search_Query_Wildcard::setMinPrefixLength(1);
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