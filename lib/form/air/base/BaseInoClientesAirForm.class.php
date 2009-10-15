<?php

/**
 * InoClientesAir form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseInoClientesAirForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia'     => new sfWidgetFormInputHidden(),
      'ca_idcliente'      => new sfWidgetFormInputHidden(),
      'ca_hawb'           => new sfWidgetFormInputHidden(),
      'ca_idreporte'      => new sfWidgetFormPropelChoice(array('model' => 'Reporte', 'add_empty' => true)),
      'ca_idproveedor'    => new sfWidgetFormPropelChoice(array('model' => 'Tercero', 'add_empty' => true)),
      'ca_proveedor'      => new sfWidgetFormInput(),
      'ca_numpiezas'      => new sfWidgetFormInput(),
      'ca_peso'           => new sfWidgetFormInput(),
      'ca_volumen'        => new sfWidgetFormInput(),
      'ca_numorden'       => new sfWidgetFormInput(),
      'ca_loginvendedor'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_idbodega'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_referencia'     => new sfValidatorPropelChoice(array('model' => 'InoMaestraAir', 'column' => 'ca_referencia', 'required' => false)),
      'ca_idcliente'      => new sfValidatorPropelChoice(array('model' => 'InoClientesAir', 'column' => 'ca_idcliente', 'required' => false)),
      'ca_hawb'           => new sfValidatorPropelChoice(array('model' => 'InoClientesAir', 'column' => 'ca_hawb', 'required' => false)),
      'ca_idreporte'      => new sfValidatorPropelChoice(array('model' => 'Reporte', 'column' => 'ca_idreporte', 'required' => false)),
      'ca_idproveedor'    => new sfValidatorPropelChoice(array('model' => 'Tercero', 'column' => 'ca_idtercero', 'required' => false)),
      'ca_proveedor'      => new sfValidatorString(array('required' => false)),
      'ca_numpiezas'      => new sfValidatorInteger(array('required' => false)),
      'ca_peso'           => new sfValidatorInteger(array('required' => false)),
      'ca_volumen'        => new sfValidatorInteger(array('required' => false)),
      'ca_numorden'       => new sfValidatorString(array('required' => false)),
      'ca_loginvendedor'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'ca_idbodega'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_clientes_air[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoClientesAir';
  }


}
