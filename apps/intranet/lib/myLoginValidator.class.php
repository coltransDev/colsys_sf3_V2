<?php

class myLoginValidator extends sfValidatorBase {

    public function configure($options = array(), $messages = array()) {
        $this->addOption('username_field', 'username');
        $this->addOption('password_field', 'passwd');

        $this->setMessage('invalid', 'El usuario o la clave es invalida');
    }

    protected function doClean($values) {
        $username = isset($values[$this->getOption('username_field')]) ? $values[$this->getOption('username_field')] : '';
        $passwd = isset($values[$this->getOption('password_field')]) ? $values[$this->getOption('password_field')] : '';
        //echo $username. $passwd;
        if ($username && $passwd) {
            $error = "";
            $errorno = "";

            $usuario = Doctrine::getTable("Usuario")->find($username);
            if ($usuario && $usuario->checkPasswd($passwd, $error, $errorno)) {
                sfContext::getInstance()->getUser()->signIn($username);
                return $values;
            }
        }
        switch ($errorno) {
            /* case 49:
              $this->setMessage('invalid', 'Las entradas de gracias para este usuario se acabaron, debe cambiar su clave de NOVELL');
              break; */
            case 9999:
                $this->setMessage('invalid', 'El usuario se encuentra bloqueado. Por favor comuníquese con el área de sistemas.');
                break;
            case 53:
                $this->setMessage('invalid', 'La cuenta de NOVELL se encuentra bloqueada');
                break;
            default :
                $this->setMessage('invalid', 'El usuario o la clave es invalida' . (isset($errorno) ? ', Cod: ' . $errorno : ''));
                break;
        }

        throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));
    }
}
?>