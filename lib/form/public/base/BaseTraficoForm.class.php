<?php

/**
 * Trafico form base class.
 *
 * @package    form
 * @subpackage trafico
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseTraficoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrafico' => new sfWidgetFormInputHidden(),
      'ca_nombre'    => new sfWidgetFormInput(),
      'ca_bandera'   => new sfWidgetFormInput(),
      'ca_idmoneda'  => new sfWidgetFormInput(),
      'ca_idgrupo'   => new sfWidgetFormInput(),
      'ca_link'      => new sfWidgetFormInput(),
      'ca_conceptos' => new sfWidgetFormInput(),
      'ca_recargos'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idtrafico' => new sfValidatorPropelChoice(array('model' => 'Trafico', 'column' => 'ca_idtrafico', 'required' => false)),
      'ca_nombre'    => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'ca_bandera'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_idmoneda'  => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'ca_idgrupo'   => new sfValidatorInteger(array('required' => false)),
      'ca_link'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_conceptos' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_recargos'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('trafico[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Trafico';
  }


}
