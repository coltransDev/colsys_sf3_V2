<?php

/**
 * IdsProveedor form base class.
 *
 * @method IdsProveedor getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseIdsProveedorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idproveedor'      => new sfWidgetFormInputHidden(),
      'ca_tipo'             => new sfWidgetFormDoctrineChoice(array('model' => 'IdsTipo', 'add_empty' => true)),
      'ca_activo'           => new sfWidgetFormInputCheckbox(),
      'ca_critico'          => new sfWidgetFormInputCheckbox(),
      'ca_esporadico'       => new sfWidgetFormInputCheckbox(),
      'ca_controladoporsig' => new sfWidgetFormInputCheckbox(),
      'ca_fchaprobado'      => new sfWidgetFormDate(),
      'ca_usuaprobado'      => new sfWidgetFormInputText(),
      'ca_sigla'            => new sfWidgetFormInputText(),
      'ca_transporte'       => new sfWidgetFormInputText(),
      'ca_empresa'          => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idproveedor'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idproveedor', 'required' => false)),
      'ca_tipo'             => new sfValidatorDoctrineChoice(array('model' => 'IdsTipo', 'required' => false)),
      'ca_activo'           => new sfValidatorBoolean(array('required' => false)),
      'ca_critico'          => new sfValidatorBoolean(array('required' => false)),
      'ca_esporadico'       => new sfValidatorBoolean(array('required' => false)),
      'ca_controladoporsig' => new sfValidatorBoolean(array('required' => false)),
      'ca_fchaprobado'      => new sfValidatorDate(array('required' => false)),
      'ca_usuaprobado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_sigla'            => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_transporte'       => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'ca_empresa'          => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_proveedor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsProveedor';
  }

}
