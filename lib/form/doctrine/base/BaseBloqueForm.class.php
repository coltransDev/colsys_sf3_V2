<?php

/**
 * Bloque form base class.
 *
 * @method Bloque getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBloqueForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'             => new sfWidgetFormInputHidden(),
      'ca_idformulario'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formulario'), 'add_empty' => false)),
      'ca_titulo'         => new sfWidgetFormInputText(),
      'ca_introduccion'   => new sfWidgetFormTextarea(),
      'ca_orden'          => new sfWidgetFormInputText(),
      'ca_activo'         => new sfWidgetFormInputCheckbox(),
      'ca_tipo'           => new sfWidgetFormInputText(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInputText(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_id', 'required' => false)),
      'ca_idformulario'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Formulario'))),
      'ca_titulo'         => new sfValidatorString(array('max_length' => 250)),
      'ca_introduccion'   => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'ca_orden'          => new sfValidatorInteger(array('required' => false)),
      'ca_activo'         => new sfValidatorBoolean(array('required' => false)),
      'ca_tipo'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bloque[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bloque';
  }

}
