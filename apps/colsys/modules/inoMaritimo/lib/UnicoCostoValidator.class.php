<?php
 
class UnicoCostoValidator extends sfValidatorBase
{    
	public function configure($options = array(), $messages = array()){
				
		$this->setMessage('invalid', 'La factura que esta ingresando ya existe');
		
	}
  
 
	protected function doClean($values)
	{			
        

        $val = Doctrine::getTable("InoCostosSea")
                    ->createQuery("c")
                    ->select("count(*)")
                    ->addWhere("c.ca_referencia = ?", $values["referencia"] )
                    ->addWhere("c.ca_factura = ?", $values["factura"] )
                    ->addWhere("c.ca_idcosto = ?", intval($values["idcosto"]) )
                    ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                    ->execute();



        if( $val>0 ){
            throw new sfValidatorErrorSchema($this, array("factura" => new sfValidatorError($this, 'invalid')));	
        }
        
        return $values;
	}
}
?>