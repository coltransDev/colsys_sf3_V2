<?php

/**
 * InoMaestra form base class.
 *
 * @method InoMaestra getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInoMaestraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idmaestra'      => new sfWidgetFormInputHidden(),
      'ca_fchreferencia'  => new sfWidgetFormDate(),
      'ca_referencia'     => new sfWidgetFormInputText(),
      'ca_idmodalidad'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Modalidad'), 'add_empty' => false)),
      'ca_origen'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Origen'), 'add_empty' => false)),
      'ca_destino'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Destino'), 'add_empty' => false)),
      'ca_idlinea'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('IdsProveedor'), 'add_empty' => false)),
      'ca_idagente'       => new sfWidgetFormInputText(),
      'ca_master'         => new sfWidgetFormTextarea(),
      'ca_fchmaster'      => new sfWidgetFormDate(),
      'ca_piezas'         => new sfWidgetFormInputText(),
      'ca_peso'           => new sfWidgetFormInputText(),
      'ca_volumen'        => new sfWidgetFormInputText(),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'add_empty' => true)),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'add_empty' => true)),
      'ca_fchliquidado'   => new sfWidgetFormDateTime(),
      'ca_usuliquidado'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuLiquidado'), 'add_empty' => true)),
      'ca_fchcerrado'     => new sfWidgetFormDateTime(),
      'ca_usucerrado'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCerrado'), 'add_empty' => true)),
      'ca_fchanulado'     => new sfWidgetFormDateTime(),
      'ca_usuanulado'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuAnulado'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_idmaestra'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idmaestra', 'required' => false)),
      'ca_fchreferencia'  => new sfValidatorDate(array('required' => false)),
      'ca_referencia'     => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'ca_idmodalidad'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Modalidad'))),
      'ca_origen'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Origen'))),
      'ca_destino'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Destino'))),
      'ca_idlinea'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('IdsProveedor'))),
      'ca_idagente'       => new sfValidatorInteger(array('required' => false)),
      'ca_master'         => new sfValidatorString(),
      'ca_fchmaster'      => new sfValidatorDate(),
      'ca_piezas'         => new sfValidatorNumber(array('required' => false)),
      'ca_peso'           => new sfValidatorNumber(array('required' => false)),
      'ca_volumen'        => new sfValidatorNumber(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'required' => false)),
      'ca_fchliquidado'   => new sfValidatorDateTime(array('required' => false)),
      'ca_usuliquidado'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuLiquidado'), 'required' => false)),
      'ca_fchcerrado'     => new sfValidatorDateTime(array('required' => false)),
      'ca_usucerrado'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCerrado'), 'required' => false)),
      'ca_fchanulado'     => new sfValidatorDateTime(array('required' => false)),
      'ca_usuanulado'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuAnulado'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_maestra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoMaestra';
  }

}
