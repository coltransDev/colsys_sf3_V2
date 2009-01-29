<?php

/**
 * ClienteStd form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseClienteStdForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcliente' => new sfWidgetFormInputHidden(),
      'ca_fchestado' => new sfWidgetFormInputHidden(),
      'ca_estado'    => new sfWidgetFormInput(),
      'ca_empresa'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idcliente' => new sfValidatorPropelChoice(array('model' => 'Cliente', 'column' => 'ca_idcliente', 'required' => false)),
      'ca_fchestado' => new sfValidatorPropelChoice(array('model' => 'ClienteStd', 'column' => 'ca_fchestado', 'required' => false)),
      'ca_estado'    => new sfValidatorString(array('required' => false)),
      'ca_empresa'   => new sfValidatorPropelChoice(array('model' => 'ClienteStd', 'column' => 'ca_empresa', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cliente_std[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClienteStd';
  }


}
