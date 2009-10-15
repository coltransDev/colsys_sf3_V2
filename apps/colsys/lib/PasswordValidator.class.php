<?
class PasswordValidator {
    /**
     * execute validator
     *
     * @param sfValidatorBase Validator instance that calls this method
     * @param string Value of field that sfValidatorCallback checks
     * @param array Arguments for correct working
     *
     * @return value field when OK. Nothing if error (sfValidatorError exception)
     */
    public static function execute ($oValidator, $sValue, $aArguments) {
        
			
		$user = UsuarioPeer::retrieveByPk( sfContext::getInstance()->getUser()->getUserId() );
		if( $user ){	
			if( $user->checkPasswd( $sValue ) ){
				return $sValue;
			}										
		}
			    
        throw new sfValidatorError($oValidator, 'invalid', array('value' => $sValue, 'invalid' => $oValidator->getOption('invalid')));
    }
}
?>