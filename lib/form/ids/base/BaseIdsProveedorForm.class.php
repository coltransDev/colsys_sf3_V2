<?php

/**
 * IdsProveedor form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseIdsProveedorForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idproveedor'      => new sfWidgetFormInputHidden(),
      'ca_tipo'             => new sfWidgetFormInput(),
      'ca_critico'          => new sfWidgetFormInputCheckbox(),
      'ca_controladoporsig' => new sfWidgetFormInputCheckbox(),
      'ca_fchaprobado'      => new sfWidgetFormDateTime(),
      'ca_usuaprobado'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idproveedor'      => new sfValidatorPropelChoice(array('model' => 'Ids', 'column' => 'ca_id', 'required' => false)),
      'ca_tipo'             => new sfValidatorInteger(),
      'ca_critico'          => new sfValidatorBoolean(),
      'ca_controladoporsig' => new sfValidatorBoolean(),
      'ca_fchaprobado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuaprobado'      => new sfValidatorString(array('required' => false)),
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
