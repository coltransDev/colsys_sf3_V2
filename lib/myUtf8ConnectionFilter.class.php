<?php
class myUtf8ConnectionFilter extends sfFilter
{
  public function execute($filterChain)
  {
    /*$con = Propel::getConnection();
    if ($con){
       $con->executeQuery("SET NAMES  'LATIN1'");
    } else {
      throw new Exception($e);
    }*/
    $filterChain->execute();
  }
}
?>