<?php

/**
 * InoMaestraAir form base class.
 *
 * @package    form
 * @subpackage ino_maestra_air
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseInoMaestraAirForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_fchreferencia'      => new sfWidgetFormDate(),
      'ca_referencia'         => new sfWidgetFormInputHidden(),
      'ca_impoexpo'           => new sfWidgetFormInput(),
      'ca_origen'             => new sfWidgetFormInput(),
      'ca_destino'            => new sfWidgetFormInput(),
      'ca_modalidad'          => new sfWidgetFormInput(),
      'ca_idlinea'            => new sfWidgetFormPropelSelect(array('model' => 'Transportador', 'add_empty' => true)),
      'ca_mawb'               => new sfWidgetFormInput(),
      'ca_piezas'             => new sfWidgetFormInput(),
      'ca_peso'               => new sfWidgetFormInput(),
      'ca_pesovolumen'        => new sfWidgetFormInput(),
      'ca_observaciones'      => new sfWidgetFormInput(),
      'ca_fchcreado'          => new sfWidgetFormDate(),
      'ca_usucreado'          => new sfWidgetFormInput(),
      'ca_fchactualizado'     => new sfWidgetFormDate(),
      'ca_usuactualizado'     => new sfWidgetFormInput(),
      'ca_fchliquidado'       => new sfWidgetFormDate(),
      'ca_usuliquidado'       => new sfWidgetFormInput(),
      'ca_fchcerrado'         => new sfWidgetFormDate(),
      'ca_usucerrado'         => new sfWidgetFormInput(),
      'ino_ingresos_air_list' => new sfWidgetFormPropelSelectMany(array('model' => 'Cliente')),
    ));

    $this->setValidators(array(
      'ca_fchreferencia'      => new sfValidatorDate(),
      'ca_referencia'         => new sfValidatorPropelChoice(array('model' => 'InoMaestraAir', 'column' => 'ca_referencia', 'required' => false)),
      'ca_impoexpo'           => new sfValidatorString(array('required' => false)),
      'ca_origen'             => new sfValidatorString(array('required' => false)),
      'ca_destino'            => new sfValidatorString(array('required' => false)),
      'ca_modalidad'          => new sfValidatorString(array('required' => false)),
      'ca_idlinea'            => new sfValidatorPropelChoice(array('model' => 'Transportador', 'column' => 'ca_idlinea', 'required' => false)),
      'ca_mawb'               => new sfValidatorString(array('required' => false)),
      'ca_piezas'             => new sfValidatorInteger(array('required' => false)),
      'ca_peso'               => new sfValidatorNumber(array('required' => false)),
      'ca_pesovolumen'        => new sfValidatorNumber(array('required' => false)),
      'ca_observaciones'      => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'          => new sfValidatorDate(array('required' => false)),
      'ca_usucreado'          => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado'     => new sfValidatorDate(array('required' => false)),
      'ca_usuactualizado'     => new sfValidatorString(array('required' => false)),
      'ca_fchliquidado'       => new sfValidatorDate(array('required' => false)),
      'ca_usuliquidado'       => new sfValidatorString(array('required' => false)),
      'ca_fchcerrado'         => new sfValidatorDate(array('required' => false)),
      'ca_usucerrado'         => new sfValidatorString(array('required' => false)),
      'ino_ingresos_air_list' => new sfValidatorPropelChoiceMany(array('model' => 'Cliente', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_maestra_air[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoMaestraAir';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['ino_ingresos_air_list']))
    {
      $values = array();
      foreach ($this->object->getInoIngresosAirs() as $obj)
      {
        $values[] = $obj->getCaIdcliente();
      }

      $this->setDefault('ino_ingresos_air_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveInoIngresosAirList($con);
  }

  public function saveInoIngresosAirList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['ino_ingresos_air_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(InoIngresosAirPeer::CA_REFERENCIA, $this->object->getPrimaryKey());
    InoIngresosAirPeer::doDelete($c, $con);

    $values = $this->getValue('ino_ingresos_air_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InoIngresosAir();
        $obj->setCaReferencia($this->object->getPrimaryKey());
        $obj->setCaIdcliente($value);
        $obj->save();
      }
    }
  }

}
