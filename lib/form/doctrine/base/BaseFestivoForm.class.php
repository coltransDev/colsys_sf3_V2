<?php

/**
 * Festivo form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseFestivoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_fchfestivo' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_fchfestivo' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_fchfestivo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('festivo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Festivo';
  }

}
