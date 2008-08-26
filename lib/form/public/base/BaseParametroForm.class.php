<?php

/**
 * Parametro form base class.
 *
 * @package    form
 * @subpackage parametro
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseParametroForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_casouso'        => new sfWidgetFormInputHidden(),
      'ca_identificacion' => new sfWidgetFormInputHidden(),
      'ca_valor'          => new sfWidgetFormInputHidden(),
      'ca_valor2'         => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_casouso'        => new sfValidatorPropelChoice(array('model' => 'Parametro', 'column' => 'ca_casouso', 'required' => false)),
      'ca_identificacion' => new sfValidatorPropelChoice(array('model' => 'Parametro', 'column' => 'ca_identificacion', 'required' => false)),
      'ca_valor'          => new sfValidatorPropelChoice(array('model' => 'Parametro', 'column' => 'ca_valor', 'required' => false)),
      'ca_valor2'         => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('parametro[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametro';
  }


}
