<?php

/**
 * FalaInstruction form base class.
 *
 * @package    form
 * @subpackage fala_instruction
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseFalaInstructionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_iddoc'              => new sfWidgetFormPropelSelect(array('model' => 'FalaHeader', 'add_empty' => false)),
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
