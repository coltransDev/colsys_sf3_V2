<?php


class MyQuery extends Doctrine_Query
{
  public function preQuery()
  {
      // If this is a select query then set connection to the slave  
//	echo Doctrine_Query::SELECT."-".$this->getType()."<br>";
      if (Doctrine_Query::SELECT == $this->getType()) {
          $this->_conn = Doctrine_Manager::getInstance()->getConnection('slave');      
      } else {
          $this->_conn = Doctrine_Manager::getInstance()->getConnection('master');
      }
  }
}

?>
