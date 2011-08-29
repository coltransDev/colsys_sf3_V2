<?php
 
class UtilidadesValidator extends sfValidatorBase
{    
	public function configure($options = array(), $messages = array()){
				
		$this->setMessage('invalid', 'El INO total no coincide con la suma de los INOs por sobreventa');
		
	}
  
 
	protected function doClean($values)
	{			
        
        $util = round($values["venta"] - $values["neto"]*$values["tcambio"], 0 );
        $sum = 0;
        foreach( $values as $key=>$val ){
            if( substr($key, 0, 4)=="util" ){
                $sum+=$val;
            }            
        }
        //echo $sum."  ---  " .$util;
        if( $sum!=$util ){
            throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));	
        }
        
        return $values;
	}
}
?>