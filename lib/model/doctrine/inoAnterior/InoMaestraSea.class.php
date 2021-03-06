<?php

/**
 * InoMaestraSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class InoMaestraSea extends BaseInoMaestraSea
{
    private $emails;
    private  $countemails;

    public function getEmails() {
        $this->emails = Doctrine::getTable("Email")
                        ->createQuery("e")
                        ->addWhere("ca_tipo=? and ca_subject like ?", array('Antecedentes',"%" . $this->getCaReferencia()."%" ) )
                        ->addOrderBy("e.ca_idemail DESC")
                        ->execute();
        $this->countemails=count($this->emails);
        return $this->emails;
    }
    public function getCountEmails() {
        if(!$this->countemails)
        {
            $this->countemails = Doctrine::getTable("Email")
                        ->createQuery("e")
                        ->select("count(*) as nreg")
                        ->addWhere("ca_tipo=? and ca_subject like ?", array('Antecedentes',"%" . $this->getCaReferencia()."%" ))
                        ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                        ->execute();
        }
        return $this->countemails;
    }

    public function getUltEmail() {
        if(!$this->emails)
            $this->getEmails();
        if($this->countemails>0)
            $email=$this->emails[0];
        else
            $email=null;
        return $email;
    }
    
    static public function getUltEmailR($referencia) {
 
        $email = Doctrine::getTable("Email")
                        ->createQuery("e")
                        ->select("ca_subject")
                        ->addWhere("ca_tipo=? and ca_subject like ?", array('Antecedentes',"%" . $referencia."%" ))
                        ->addOrderBy("e.ca_idemail DESC")                        
                        //->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->fetchOne();
                //print_r($email);
        return $email;
    }
}