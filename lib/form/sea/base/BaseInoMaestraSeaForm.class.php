<?php

/**
 * InoMaestraSea form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseInoMaestraSeaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_fchreferencia'       => new sfWidgetFormDate(),
      'ca_referencia'          => new sfWidgetFormInputHidden(),
      'ca_impoexpo'            => new sfWidgetFormInput(),
      'ca_origen'              => new sfWidgetFormInput(),
      'ca_destino'             => new sfWidgetFormInput(),
      'ca_fchembarque'         => new sfWidgetFormDate(),
      'ca_fcharribo'           => new sfWidgetFormDate(),
      'ca_modalidad'           => new sfWidgetFormInput(),
      'ca_idlinea'             => new sfWidgetFormPropelChoice(array('model' => 'Transportador', 'add_empty' => true)),
      'ca_motonave'            => new sfWidgetFormInput(),
      'ca_ciclo'               => new sfWidgetFormInput(),
      'ca_mbls'                => new sfWidgetFormInput(),
      'ca_observaciones'       => new sfWidgetFormInput(),
      'ca_fchconfirmacion'     => new sfWidgetFormDate(),
      'ca_horaconfirmacion'    => new sfWidgetFormTime(),
      'ca_registroadu'         => new sfWidgetFormInput(),
      'ca_registrocap'         => new sfWidgetFormInput(),
      'ca_bandera'             => new sfWidgetFormInput(),
      'ca_fchliberacion'       => new sfWidgetFormDate(),
      'ca_nroliberacion'       => new sfWidgetFormInput(),
      'ca_anulado'             => new sfWidgetFormInput(),
      'ca_fchcreado'           => new sfWidgetFormDate(),
      'ca_usucreado'           => new sfWidgetFormInput(),
      'ca_fchactualizado'      => new sfWidgetFormDate(),
      'ca_usuactualizado'      => new sfWidgetFormInput(),
      'ca_fchliquidado'        => new sfWidgetFormDate(),
      'ca_usuliquidado'        => new sfWidgetFormInput(),
      'ca_fchcerrado'          => new sfWidgetFormDate(),
      'ca_usucerrado'          => new sfWidgetFormInput(),
      'ca_mensaje'             => new sfWidgetFormInput(),
      'ca_fchdesconsolidacion' => new sfWidgetFormInput(),
      'ca_mnllegada'           => new sfWidgetFormInput(),
      'ca_fchregistroadu'      => new sfWidgetFormInput(),
      'ca_fchconfirmado'       => new sfWidgetFormDateTime(),
      'ca_usuconfirmado'       => new sfWidgetFormInput(),
      'ca_asunto_otm'          => new sfWidgetFormInput(),
      'ca_mensaje_otm'         => new sfWidgetFormInput(),
      'ca_fchllegada_otm'      => new sfWidgetFormInput(),
      'ca_ciudad_otm'          => new sfWidgetFormInput(),
      'ca_fchconfirma_otm'     => new sfWidgetFormDateTime(),
      'ca_usuconfirma_otm'     => new sfWidgetFormInput(),
      'ca_provisional'         => new sfWidgetFormInputCheckbox(),
      'ca_sitiodevolucion'     => new sfWidgetFormInput(),
      'ino_clientes_sea_list'  => new sfWidgetFormPropelChoiceMany(array('model' => 'Cliente')),
      'ino_avisos_sea_list'    => new sfWidgetFormPropelChoiceMany(array('model' => 'Cliente')),
      'ino_ingresos_sea_list'  => new sfWidgetFormPropelChoiceMany(array('model' => 'Cliente')),
    ));

    $this->setValidators(array(
      'ca_fchreferencia'       => new sfValidatorDate(),
      'ca_referencia'          => new sfValidatorPropelChoice(array('model' => 'InoMaestraSea', 'column' => 'ca_referencia', 'required' => false)),
      'ca_impoexpo'            => new sfValidatorString(array('required' => false)),
      'ca_origen'              => new sfValidatorString(array('required' => false)),
      'ca_destino'             => new sfValidatorString(array('required' => false)),
      'ca_fchembarque'         => new sfValidatorDate(array('required' => false)),
      'ca_fcharribo'           => new sfValidatorDate(array('required' => false)),
      'ca_modalidad'           => new sfValidatorString(array('required' => false)),
      'ca_idlinea'             => new sfValidatorPropelChoice(array('model' => 'Transportador', 'column' => 'ca_idlinea', 'required' => false)),
      'ca_motonave'            => new sfValidatorString(array('required' => false)),
      'ca_ciclo'               => new sfValidatorString(array('required' => false)),
      'ca_mbls'                => new sfValidatorString(array('required' => false)),
      'ca_observaciones'       => new sfValidatorString(array('required' => false)),
      'ca_fchconfirmacion'     => new sfValidatorDate(array('required' => false)),
      'ca_horaconfirmacion'    => new sfValidatorTime(array('required' => false)),
      'ca_registroadu'         => new sfValidatorString(array('required' => false)),
      'ca_registrocap'         => new sfValidatorString(array('required' => false)),
      'ca_bandera'             => new sfValidatorString(array('required' => false)),
      'ca_fchliberacion'       => new sfValidatorDate(array('required' => false)),
      'ca_nroliberacion'       => new sfValidatorString(array('required' => false)),
      'ca_anulado'             => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'           => new sfValidatorDate(array('required' => false)),
      'ca_usucreado'           => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado'      => new sfValidatorDate(array('required' => false)),
      'ca_usuactualizado'      => new sfValidatorString(array('required' => false)),
      'ca_fchliquidado'        => new sfValidatorDate(array('required' => false)),
      'ca_usuliquidado'        => new sfValidatorString(array('required' => false)),
      'ca_fchcerrado'          => new sfValidatorDate(array('required' => false)),
      'ca_usucerrado'          => new sfValidatorString(array('required' => false)),
      'ca_mensaje'             => new sfValidatorString(array('required' => false)),
      'ca_fchdesconsolidacion' => new sfValidatorString(array('required' => false)),
      'ca_mnllegada'           => new sfValidatorString(array('required' => false)),
      'ca_fchregistroadu'      => new sfValidatorString(array('required' => false)),
      'ca_fchconfirmado'       => new sfValidatorDateTime(array('required' => false)),
      'ca_usuconfirmado'       => new sfValidatorString(array('required' => false)),
      'ca_asunto_otm'          => new sfValidatorString(array('required' => false)),
      'ca_mensaje_otm'         => new sfValidatorString(array('required' => false)),
      'ca_fchllegada_otm'      => new sfValidatorString(array('required' => false)),
      'ca_ciudad_otm'          => new sfValidatorString(array('required' => false)),
      'ca_fchconfirma_otm'     => new sfValidatorDateTime(array('required' => false)),
      'ca_usuconfirma_otm'     => new sfValidatorString(array('required' => false)),
      'ca_provisional'         => new sfValidatorBoolean(array('required' => false)),
      'ca_sitiodevolucion'     => new sfValidatorString(array('required' => false)),
      'ino_clientes_sea_list'  => new sfValidatorPropelChoiceMany(array('model' => 'Cliente', 'required' => false)),
      'ino_avisos_sea_list'    => new sfValidatorPropelChoiceMany(array('model' => 'Cliente', 'required' => false)),
      'ino_ingresos_sea_list'  => new sfValidatorPropelChoiceMany(array('model' => 'Cliente', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_maestra_sea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoMaestraSea';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['ino_clientes_sea_list']))
    {
      $values = array();
      foreach ($this->object->getInoClientesSeas() as $obj)
      {
        $values[] = $obj->getCaIdcliente();
      }

      $this->setDefault('ino_clientes_sea_list', $values);
    }

    if (isset($this->widgetSchema['ino_avisos_sea_list']))
    {
      $values = array();
      foreach ($this->object->getInoAvisosSeas() as $obj)
      {
        $values[] = $obj->getCaIdcliente();
      }

      $this->setDefault('ino_avisos_sea_list', $values);
    }

    if (isset($this->widgetSchema['ino_ingresos_sea_list']))
    {
      $values = array();
      foreach ($this->object->getInoIngresosSeas() as $obj)
      {
        $values[] = $obj->getCaIdcliente();
      }

      $this->setDefault('ino_ingresos_sea_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveInoClientesSeaList($con);
    $this->saveInoAvisosSeaList($con);
    $this->saveInoIngresosSeaList($con);
  }

  public function saveInoClientesSeaList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['ino_clientes_sea_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(InoClientesSeaPeer::CA_REFERENCIA, $this->object->getPrimaryKey());
    InoClientesSeaPeer::doDelete($c, $con);

    $values = $this->getValue('ino_clientes_sea_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InoClientesSea();
        $obj->setCaReferencia($this->object->getPrimaryKey());
        $obj->setCaIdcliente($value);
        $obj->save();
      }
    }
  }

  public function saveInoAvisosSeaList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['ino_avisos_sea_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->object->getPrimaryKey());
    InoAvisosSeaPeer::doDelete($c, $con);

    $values = $this->getValue('ino_avisos_sea_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InoAvisosSea();
        $obj->setCaReferencia($this->object->getPrimaryKey());
        $obj->setCaIdcliente($value);
        $obj->save();
      }
    }
  }

  public function saveInoIngresosSeaList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['ino_ingresos_sea_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->object->getPrimaryKey());
    InoIngresosSeaPeer::doDelete($c, $con);

    $values = $this->getValue('ino_ingresos_sea_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InoIngresosSea();
        $obj->setCaReferencia($this->object->getPrimaryKey());
        $obj->setCaIdcliente($value);
        $obj->save();
      }
    }
  }

}
