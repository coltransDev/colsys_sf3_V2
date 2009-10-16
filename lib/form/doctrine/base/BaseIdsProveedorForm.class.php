<?php

/**
 * IdsProveedor form base class.
 *
 * @package    form
 * @subpackage ids_proveedor
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseIdsProveedorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idproveedor'      => new sfWidgetFormInputHidden(),
      'ca_tipo'             => new sfWidgetFormDoctrineSelect(array('model' => 'IdsTipo', 'add_empty' => true)),
      'ca_activo'           => new sfWidgetFormInputCheckbox(),
      'ca_critico'          => new sfWidgetFormInputCheckbox(),
      'ca_esporadico'       => new sfWidgetFormInputCheckbox(),
      'ca_controladoporsig' => new sfWidgetFormInputCheckbox(),
      'ca_fchaprobado'      => new sfWidgetFormDate(),
      'ca_usuaprobado'      => new sfWidgetFormInput(),
      'ca_sigla'            => new sfWidgetFormInput(),
      'ca_transporte'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idproveedor'      => new sfValidatorDoctrineChoice(array('model' => 'IdsProveedor', 'column' => 'ca_idproveedor', 'required' => false)),
      'ca_tipo'             => new sfValidatorDoctrineChoice(array('model' => 'IdsTipo', 'required' => false)),
      'ca_activo'           => new sfValidatorBoolean(array('required' => false)),
      'ca_critico'          => new sfValidatorBoolean(array('required' => false)),
      'ca_esporadico'       => new sfValidatorBoolean(array('required' => false)),
      'ca_controladoporsig' => new sfValidatorBoolean(array('required' => false)),
      'ca_fchaprobado'      => new sfValidatorDate(array('required' => false)),
      'ca_usuaprobado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_sigla'            => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_transporte'       => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_proveedor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsProveedor';
  }

}