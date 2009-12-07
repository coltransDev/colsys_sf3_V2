<?php

/**
 * InoTipoComprobante form base class.
 *
 * @method InoTipoComprobante getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInoTipoComprobanteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtipo'             => new sfWidgetFormInputHidden(),
      'ca_tipo'               => new sfWidgetFormTextarea(),
      'ca_comprobante'        => new sfWidgetFormInputText(),
      'ca_descripcion'        => new sfWidgetFormTextarea(),
      'ca_titulo'             => new sfWidgetFormTextarea(),
      'ca_numeracion_inicial' => new sfWidgetFormInputText(),
      'ca_mensaje'            => new sfWidgetFormTextarea(),
      'ca_noautorizacion'     => new sfWidgetFormTextarea(),
      'ca_fchautorizacion'    => new sfWidgetFormDate(),
      'ca_prefijo_aut'        => new sfWidgetFormTextarea(),
      'ca_inicial_aut'        => new sfWidgetFormInputText(),
      'ca_final_aut'          => new sfWidgetFormInputText(),
      'ca_activo'             => new sfWidgetFormInputCheckbox(),
      'ca_idsucursal'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('IdsSucursal'), 'add_empty' => true)),
      'ca_idcta_cierre'       => new sfWidgetFormInputText(),
      'ca_idcta_iva'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_idtipo'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idtipo', 'required' => false)),
      'ca_tipo'               => new sfValidatorString(),
      'ca_comprobante'        => new sfValidatorInteger(),
      'ca_descripcion'        => new sfValidatorString(array('required' => false)),
      'ca_titulo'             => new sfValidatorString(array('required' => false)),
      'ca_numeracion_inicial' => new sfValidatorInteger(),
      'ca_mensaje'            => new sfValidatorString(array('required' => false)),
      'ca_noautorizacion'     => new sfValidatorString(array('required' => false)),
      'ca_fchautorizacion'    => new sfValidatorDate(array('required' => false)),
      'ca_prefijo_aut'        => new sfValidatorString(array('required' => false)),
      'ca_inicial_aut'        => new sfValidatorInteger(array('required' => false)),
      'ca_final_aut'          => new sfValidatorInteger(array('required' => false)),
      'ca_activo'             => new sfValidatorBoolean(array('required' => false)),
      'ca_idsucursal'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('IdsSucursal'), 'required' => false)),
      'ca_idcta_cierre'       => new sfValidatorInteger(array('required' => false)),
      'ca_idcta_iva'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_tipo_comprobante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoTipoComprobante';
  }

}
