<?php

/**
 * Parametro form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
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
