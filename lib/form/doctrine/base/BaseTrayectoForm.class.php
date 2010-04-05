<?php

/**
 * Trayecto form base class.
 *
 * @method Trayecto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTrayectoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto'     => new sfWidgetFormInputHidden(),
      'ca_origen'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Origen'), 'add_empty' => false)),
      'ca_destino'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Destino'), 'add_empty' => false)),
      'ca_idlinea'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('IdsProveedor'), 'add_empty' => false)),
      'ca_transporte'     => new sfWidgetFormTextarea(),
      'ca_impoexpo'       => new sfWidgetFormTextarea(),
      'ca_modalidad'      => new sfWidgetFormTextarea(),
      'ca_frecuencia'     => new sfWidgetFormTextarea(),
      'ca_tiempotransito' => new sfWidgetFormTextarea(),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
      'ca_idagente'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('IdsAgente'), 'add_empty' => true)),
      'ca_activo'         => new sfWidgetFormInputCheckbox(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idtrayecto'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idtrayecto', 'required' => false)),
      'ca_origen'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Origen'))),
      'ca_destino'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Destino'))),
      'ca_idlinea'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('IdsProveedor'))),
      'ca_transporte'     => new sfValidatorString(),
      'ca_impoexpo'       => new sfValidatorString(),
      'ca_modalidad'      => new sfValidatorString(),
      'ca_frecuencia'     => new sfValidatorString(array('required' => false)),
      'ca_tiempotransito' => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_idagente'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('IdsAgente'), 'required' => false)),
      'ca_activo'         => new sfValidatorBoolean(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('trayecto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Trayecto';
  }

}
