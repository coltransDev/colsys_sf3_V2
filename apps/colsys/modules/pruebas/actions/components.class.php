<?php

/**
 * pricing components.
 *
 * @package    colsys
 * @subpackage pricing
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pruebasComponents extends sfComponents
{
    

    public function executeEnvioEmails()
    {
        echo "prueba";
    }
    
    
    public function executeReturnFiles()
    {
        /*$this->archivos = Doctrine::getTable("Archivos")
                            ->createQuery("a")
                            ->select("*")
                            ->innerJoin("a.TipoDocumental t")
                            ->where("t.ca_serie = ? AND t.ca_subserie", array("44","2") )
                            ->andWhere("ca_ref1","500.05.10.001.3")
                            ->orderBy("t.ca_iddocumental")
                            ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                            ->execute();        */
        
        /*$serie = ($this->getRequestParameter("serie")!="")?$this->getRequestParameter("serie"):"44";
        $subserie = ($this->getRequestParameter("subserie")!="")?$this->getRequestParameter("subserie"):"2";        
        
        $ref1 = str_replace("|", ".", $this->getRequestParameter("ref1"));
        $ref2 = str_replace("|", ".", $this->getRequestParameter("ref2"));
        $ref3 = str_replace("|", ".", $this->getRequestParameter("ref3"));
        */
        $this->serie = ($this->serie!="")?$this->serie:"44";
        $this->subserie = ($this->subserie!="")?$this->subserie:"2";        
        $q = Doctrine::getTable("Archivos")
                            ->createQuery("a")
                            ->select("a.*,t.ca_documento")
                            ->innerJoin("a.TipoDocumental t")
                            ->where("t.ca_serie = ? AND t.ca_subserie=?", array($this->serie,$this->subserie) )
                            ->addWhere("a.ca_fcheliminado IS NULL")
                            ->setHydrationMode(Doctrine::HYDRATE_ARRAY);
         if($this->ref1!="")
             $q->andWhere("a.ca_ref1=?",$this->ref1);
         
         if($this->ref2!="")
             $q->andWhere("a.ca_ref2=?",$this->ref2);
         
         if($this->ref3!="")
             $q->andWhere("a.ca_ref3=?",$this->ref3);
         
        //echo $q->getSqlQuery()."<br>".$this->serie."<br>".$this->subserie."<br>".$this->ref1;
        //exit;                    
         $this->archivos=$q->execute();
        
    }

}
?>