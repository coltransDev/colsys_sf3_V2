<?php

/**
 * Cliente form base class.
 *
 * @package    form
 * @subpackage cliente
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseClienteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcliente'          => new sfWidgetFormInputHidden(),
      'ca_digito'             => new sfWidgetFormInput(),
      'ca_compania'           => new sfWidgetFormInput(),
      'ca_papellido'          => new sfWidgetFormInput(),
      'ca_sapellido'          => new sfWidgetFormInput(),
      'ca_nombres'            => new sfWidgetFormInput(),
      'ca_saludo'             => new sfWidgetFormInput(),
      'ca_sexo'               => new sfWidgetFormInput(),
      'ca_cumpleanos'         => new sfWidgetFormInput(),
      'ca_oficina'            => new sfWidgetFormInput(),
      'ca_vendedor'           => new sfWidgetFormInput(),
      'ca_email'              => new sfWidgetFormInput(),
      'ca_coordinador'        => new sfWidgetFormInput(),
      'ca_direccion'          => new sfWidgetFormInput(),
      'ca_localidad'          => new sfWidgetFormInput(),
      'ca_complemento'        => new sfWidgetFormInput(),
      'ca_telefonos'          => new sfWidgetFormInput(),
      'ca_fax'                => new sfWidgetFormInput(),
      'ca_preferencias'       => new sfWidgetFormInput(),
      'ca_confirmar'          => new sfWidgetFormInput(),
      'ca_idciudad'           => new sfWidgetFormPropelSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ino_ingresos_air_list' => new sfWidgetFormPropelSelectMany(array('model' => 'InoMaestraAir')),
      'ino_avisos_sea_list'   => new sfWidgetFormPropelSelectMany(array('model' => 'InoMaestraSea')),
      'ino_ingresos_sea_list' => new sfWidgetFormPropelSelectMany(array('model' => 'InoMaestraSea')),
    ));

    $this->setValidators(array(
      'ca_idcliente'          => new sfValidatorPropelChoice(array('model' => 'Cliente', 'column' => 'ca_idcliente', 'required' => false)),
      'ca_digito'             => new sfValidatorInteger(array('required' => false)),
      'ca_compania'           => new sfValidatorString(array('required' => false)),
      'ca_papellido'          => new sfValidatorString(array('required' => false)),
      'ca_sapellido'          => new sfValidatorString(array('required' => false)),
      'ca_nombres'            => new sfValidatorString(array('required' => false)),
      'ca_saludo'             => new sfValidatorString(array('required' => false)),
      'ca_sexo'               => new sfValidatorString(array('required' => false)),
      'ca_cumpleanos'         => new sfValidatorString(array('required' => false)),
      'ca_oficina'            => new sfValidatorString(array('required' => false)),
      'ca_vendedor'           => new sfValidatorString(array('required' => false)),
      'ca_email'              => new sfValidatorString(array('required' => false)),
      'ca_coordinador'        => new sfValidatorString(array('required' => false)),
      'ca_direccion'          => new sfValidatorString(array('required' => false)),
      'ca_localidad'          => new sfValidatorString(array('required' => false)),
      'ca_complemento'        => new sfValidatorString(array('required' => false)),
      'ca_telefonos'          => new sfValidatorString(array('required' => false)),
      'ca_fax'                => new sfValidatorString(array('required' => false)),
      'ca_preferencias'       => new sfValidatorString(array('required' => false)),
      'ca_confirmar'          => new sfValidatorString(array('required' => false)),
      'ca_idciudad'           => new sfValidatorPropelChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => false)),
      'ino_ingresos_air_list' => new sfValidatorPropelChoiceMany(array('model' => 'InoMaestraAir', 'required' => false)),
      'ino_avisos_sea_list'   => new sfValidatorPropelChoiceMany(array('model' => 'InoMaestraSea', 'required' => false)),
      'ino_ingresos_sea_list' => new sfValidatorPropelChoiceMany(array('model' => 'InoMaestraSea', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cliente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cliente';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['ino_ingresos_air_list']))
    {
      $values = array();
      foreach ($this->object->getInoIngresosAirs() as $obj)
      {
        $values[] = $obj->getCaReferencia();
      }

      $this->setDefault('ino_ingresos_air_list', $values);
    }

    if (isset($this->widgetSchema['ino_avisos_sea_list']))
    {
      $values = array();
      foreach ($this->object->getInoAvisosSeas() as $obj)
      {
        $values[] = $obj->getCaReferencia();
      }

      $this->setDefault('ino_avisos_sea_list', $values);
    }

    if (isset($this->widgetSchema['ino_ingresos_sea_list']))
    {
      $values = array();
      foreach ($this->object->getInoIngresosSeas() as $obj)
      {
        $values[] = $obj->getCaReferencia();
      }

      $this->setDefault('ino_ingresos_sea_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveInoIngresosAirList($con);
    $this->saveInoAvisosSeaList($con);
    $this->saveInoIngresosSeaList($con);
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
    $c->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->object->getPrimaryKey());
    InoIngresosAirPeer::doDelete($c, $con);

    $values = $this->getValue('ino_ingresos_air_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InoIngresosAir();
        $obj->setCaIdcliente($this->object->getPrimaryKey());
        $obj->setCaReferencia($value);
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
    $c->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->object->getPrimaryKey());
    InoAvisosSeaPeer::doDelete($c, $con);

    $values = $this->getValue('ino_avisos_sea_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InoAvisosSea();
        $obj->setCaIdcliente($this->object->getPrimaryKey());
        $obj->setCaReferencia($value);
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
    $c->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->object->getPrimaryKey());
    InoIngresosSeaPeer::doDelete($c, $con);

    $values = $this->getValue('ino_ingresos_sea_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InoIngresosSea();
        $obj->setCaIdcliente($this->object->getPrimaryKey());
        $obj->setCaReferencia($value);
        $obj->save();
      }
    }
  }

}
