<?php

/**
 * CotContactoAg form base class.
 *
 * @method CotContactoAg getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseCotContactoAgForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcontacto'   => new sfWidgetFormInputHidden(),
      'ca_idcotizacion' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idcontacto'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcontacto', 'required' => false)),
      'ca_idcotizacion' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcotizacion', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_contacto_ag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotContactoAg';
  }

}
