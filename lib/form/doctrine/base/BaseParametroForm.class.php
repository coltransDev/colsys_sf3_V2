<?php

/**
 * Parametro form base class.
 *
 * @method Parametro getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseParametroForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_casouso'        => new sfWidgetFormInputHidden(),
      'ca_identificacion' => new sfWidgetFormInputHidden(),
      'ca_valor'          => new sfWidgetFormInputHidden(),
      'ca_valor2'         => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_casouso'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_casouso', 'required' => false)),
      'ca_identificacion' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_identificacion', 'required' => false)),
      'ca_valor'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_valor', 'required' => false)),
      'ca_valor2'         => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('parametro[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametro';
  }

}
