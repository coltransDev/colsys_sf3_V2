<?php
 
class InoUtilidadesValidator extends sfValidatorBase
{    
	public function configure($options = array(), $messages = array()){
				
		$this->setMessage('invalid', 'El INO total no coincide con la suma de los INOs por sobreventa');
		
	}
  
 
	protected function doClean($values)
	{	
       
        //echo $values["venta"] ."  --       ". round(+0.1,0)."<br />";
        
        $neto = $values["neto"]*$values["tcambio"]/$values["tcambio_usd"];
        
        
        if( $neto<0 ){            
            if( abs($neto-ceil($neto))==0.5 ){
                //Al redondear un numero negativo, php hace la operacion incorrectamente y aproxima por encima de 0.5                
                $neto+=0.1;
            }
        }
                
        $util = round($values["venta"] - round($neto));
        $sum = 0;
        foreach( $values as $key=>$val ){
            if( substr($key, 0, 4)=="util" ){
                $sum+=$val;
            }            
        }
                
        if( $sum!=$util ){
            throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));	
        }
        
        return $values;
	}
}
?>