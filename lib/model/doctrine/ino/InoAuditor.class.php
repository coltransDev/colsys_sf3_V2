<?php

/**
 * InoAuditor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class InoAuditor extends BaseInoAuditor {

    /**
     *
     * @return <type> 
     */
    public function getIdAncestroInoAuditor($idmaster) {
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "       
            select t1.*, split_part(t1.ca_camino, '/', 3) as ca_padre
            from ino.tb_auditor t1
            where (t1.ca_idmaster = " . $idmaster . ") and (t1.ca_idevento != 0)
            limit 1    
            ";
        $st = $con->execute($sql);
        $data = $st->fetchAll();
        $id=$data[0]["ca_padre"];
        return $id;
    }

}
