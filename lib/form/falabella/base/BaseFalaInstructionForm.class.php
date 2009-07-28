<?php

/**
 * FalaInstruction form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseFalaInstructionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_iddoc'              => new sfWidgetFormPropelChoice(array('model' => 'FalaHeader', 'add_empty' => false)),
      'ca_instructions'       => new sfWidgetFormInput(),
      'ca_idfalainstructions' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_iddoc'              => new sfValidatorPropelChoice(array('model' => 'FalaHeader', 'column' => 'ca_iddoc')),
      'ca_instructions'       => new sfValidatorString(array('required' => false)),
      'ca_idfalainstructions' => new sfValidatorPropelChoice(array('model' => 'FalaInstruction', 'column' => 'ca_idfalainstructions', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fala_instruction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FalaInstruction';
  }


}
