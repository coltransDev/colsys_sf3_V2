<?php

/**
 * Festivo form base class.
 *
 * @package    form
 * @subpackage festivo
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseFestivoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_fchfestivo' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_fchfestivo' => new sfValidatorDoctrineChoice(array('model' => 'Festivo', 'column' => 'ca_fchfestivo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('festivo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Festivo';
  }

}