<?php

/**
 * Reporte form base class.
 *
 * @package    form
 * @subpackage reporte
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseReporteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'         => new sfWidgetFormInputHidden(),
      'ca_fchreporte'        => new sfWidgetFormDate(),
      'ca_consecutivo'       => new sfWidgetFormInput(),
      'ca_version'           => new sfWidgetFormInput(),
      'ca_idcotizacion'      => new sfWidgetFormInput(),
      'ca_origen'            => new sfWidgetFormInput(),
      'ca_destino'           => new sfWidgetFormInput(),
      'ca_impoexpo'          => new sfWidgetFormInput(),
      'ca_fchdespacho'       => new sfWidgetFormDate(),
      'ca_idagente'          => new sfWidgetFormPropelSelect(array('model' => 'Agente', 'add_empty' => true)),
      'ca_incoterms'         => new sfWidgetFormInput(),
      'ca_mercancia_desc'    => new sfWidgetFormInput(),
      'ca_idproveedor'       => new sfWidgetFormPropelSelect(array('model' => 'Tercero', 'add_empty' => true)),
      'ca_orden_prov'        => new sfWidgetFormInput(),
      'ca_idconcliente'      => new sfWidgetFormInput(),
      'ca_orden_clie'        => new sfWidgetFormInput(),
      'ca_confirmar_clie'    => new sfWidgetFormInput(),
      'ca_idrepresentante'   => new sfWidgetFormInput(),
      'ca_informar_repr'     => new sfWidgetFormInput(),
      'ca_idconsignatario'   => new sfWidgetFormInput(),
      'ca_informar_cons'     => new sfWidgetFormInput(),
      'ca_idnotify'          => new sfWidgetFormInput(),
      'ca_informar_noti'     => new sfWidgetFormInput(),
      'ca_notify'            => new sfWidgetFormInput(),
      'ca_transporte'        => new sfWidgetFormInput(),
      'ca_modalidad'         => new sfWidgetFormInput(),
      'ca_seguro'            => new sfWidgetFormInput(),
      'ca_liberacion'        => new sfWidgetFormInput(),
      'ca_tiempocredito'     => new sfWidgetFormInput(),
      'ca_preferencias_clie' => new sfWidgetFormInput(),
      'ca_instrucciones'     => new sfWidgetFormInput(),
      'ca_idlinea'           => new sfWidgetFormPropelSelect(array('model' => 'Transportador', 'add_empty' => true)),
      'ca_idconsignar'       => new sfWidgetFormInput(),
      'ca_idconsignarmaster' => new sfWidgetFormInput(),
      'ca_idbodega'          => new sfWidgetFormInput(),
      'ca_mastersame'        => new sfWidgetFormInput(),
      'ca_continuacion'      => new sfWidgetFormInput(),
      'ca_continuacion_dest' => new sfWidgetFormInput(),
      'ca_continuacion_conf' => new sfWidgetFormInput(),
      'ca_etapa_actual'      => new sfWidgetFormInput(),
      'ca_login'             => new sfWidgetFormPropelSelect(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_fchcreado'         => new sfWidgetFormDateTime(),
      'ca_usucreado'         => new sfWidgetFormInput(),
      'ca_fchactualizado'    => new sfWidgetFormDateTime(),
      'ca_usuactualizado'    => new sfWidgetFormInput(),
      'ca_fchanulado'        => new sfWidgetFormDateTime(),
      'ca_usuanulado'        => new sfWidgetFormInput(),
      'ca_fchcerrado'        => new sfWidgetFormDateTime(),
      'ca_usucerrado'        => new sfWidgetFormInput(),
      'ca_colmas'            => new sfWidgetFormInput(),
      'ca_propiedades'       => new sfWidgetFormInput(),
      'rep_aviso_list'       => new sfWidgetFormPropelSelectMany(array('model' => 'Email')),
      'rep_equipo_list'      => new sfWidgetFormPropelSelectMany(array('model' => 'Concepto')),
      'rep_status_list'      => new sfWidgetFormPropelSelectMany(array('model' => 'Email')),
    ));

    $this->setValidators(array(
      'ca_idreporte'         => new sfValidatorPropelChoice(array('model' => 'Reporte', 'column' => 'ca_idreporte', 'required' => false)),
      'ca_fchreporte'        => new sfValidatorDate(array('required' => false)),
      'ca_consecutivo'       => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'ca_version'           => new sfValidatorInteger(array('required' => false)),
      'ca_idcotizacion'      => new sfValidatorInteger(array('required' => false)),
      'ca_origen'            => new sfValidatorString(array('required' => false)),
      'ca_destino'           => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'          => new sfValidatorString(array('required' => false)),
      'ca_fchdespacho'       => new sfValidatorDate(array('required' => false)),
      'ca_idagente'          => new sfValidatorPropelChoice(array('model' => 'Agente', 'column' => 'ca_idagente', 'required' => false)),
      'ca_incoterms'         => new sfValidatorString(array('required' => false)),
      'ca_mercancia_desc'    => new sfValidatorString(array('required' => false)),
      'ca_idproveedor'       => new sfValidatorPropelChoice(array('model' => 'Tercero', 'column' => 'ca_idtercero', 'required' => false)),
      'ca_orden_prov'        => new sfValidatorString(array('required' => false)),
      'ca_idconcliente'      => new sfValidatorInteger(array('required' => false)),
      'ca_orden_clie'        => new sfValidatorString(array('required' => false)),
      'ca_confirmar_clie'    => new sfValidatorString(array('required' => false)),
      'ca_idrepresentante'   => new sfValidatorInteger(array('required' => false)),
      'ca_informar_repr'     => new sfValidatorString(array('required' => false)),
      'ca_idconsignatario'   => new sfValidatorInteger(array('required' => false)),
      'ca_informar_cons'     => new sfValidatorString(array('required' => false)),
      'ca_idnotify'          => new sfValidatorInteger(array('required' => false)),
      'ca_informar_noti'     => new sfValidatorString(array('required' => false)),
      'ca_notify'            => new sfValidatorInteger(array('required' => false)),
      'ca_transporte'        => new sfValidatorString(array('required' => false)),
      'ca_modalidad'         => new sfValidatorString(array('required' => false)),
      'ca_seguro'            => new sfValidatorString(array('required' => false)),
      'ca_liberacion'        => new sfValidatorString(array('required' => false)),
      'ca_tiempocredito'     => new sfValidatorString(array('required' => false)),
      'ca_preferencias_clie' => new sfValidatorString(array('required' => false)),
      'ca_instrucciones'     => new sfValidatorString(array('required' => false)),
      'ca_idlinea'           => new sfValidatorPropelChoice(array('model' => 'Transportador', 'column' => 'ca_idlinea', 'required' => false)),
      'ca_idconsignar'       => new sfValidatorInteger(array('required' => false)),
      'ca_idconsignarmaster' => new sfValidatorInteger(array('required' => false)),
      'ca_idbodega'          => new sfValidatorInteger(array('required' => false)),
      'ca_mastersame'        => new sfValidatorString(array('required' => false)),
      'ca_continuacion'      => new sfValidatorString(array('required' => false)),
      'ca_continuacion_dest' => new sfValidatorString(array('required' => false)),
      'ca_continuacion_conf' => new sfValidatorString(array('required' => false)),
      'ca_etapa_actual'      => new sfValidatorString(array('required' => false)),
      'ca_login'             => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
      'ca_fchcreado'         => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'         => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado'    => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'    => new sfValidatorString(array('required' => false)),
      'ca_fchanulado'        => new sfValidatorDateTime(array('required' => false)),
      'ca_usuanulado'        => new sfValidatorString(array('required' => false)),
      'ca_fchcerrado'        => new sfValidatorDateTime(array('required' => false)),
      'ca_usucerrado'        => new sfValidatorString(array('required' => false)),
      'ca_colmas'            => new sfValidatorString(array('required' => false)),
      'ca_propiedades'       => new sfValidatorString(array('required' => false)),
      'rep_aviso_list'       => new sfValidatorPropelChoiceMany(array('model' => 'Email', 'required' => false)),
      'rep_equipo_list'      => new sfValidatorPropelChoiceMany(array('model' => 'Concepto', 'required' => false)),
      'rep_status_list'      => new sfValidatorPropelChoiceMany(array('model' => 'Email', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('reporte[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reporte';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['rep_aviso_list']))
    {
      $values = array();
      foreach ($this->object->getRepAvisos() as $obj)
      {
        $values[] = $obj->getCaIdemail();
      }

      $this->setDefault('rep_aviso_list', $values);
    }

    if (isset($this->widgetSchema['rep_equipo_list']))
    {
      $values = array();
      foreach ($this->object->getRepEquipos() as $obj)
      {
        $values[] = $obj->getCaIdconcepto();
      }

      $this->setDefault('rep_equipo_list', $values);
    }

    if (isset($this->widgetSchema['rep_status_list']))
    {
      $values = array();
      foreach ($this->object->getRepStatuss() as $obj)
      {
        $values[] = $obj->getCaIdemail();
      }

      $this->setDefault('rep_status_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveRepAvisoList($con);
    $this->saveRepEquipoList($con);
    $this->saveRepStatusList($con);
  }

  public function saveRepAvisoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['rep_aviso_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RepAvisoPeer::CA_IDREPORTE, $this->object->getPrimaryKey());
    RepAvisoPeer::doDelete($c, $con);

    $values = $this->getValue('rep_aviso_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RepAviso();
        $obj->setCaIdreporte($this->object->getPrimaryKey());
        $obj->setCaIdemail($value);
        $obj->save();
      }
    }
  }

  public function saveRepEquipoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['rep_equipo_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RepEquipoPeer::CA_IDREPORTE, $this->object->getPrimaryKey());
    RepEquipoPeer::doDelete($c, $con);

    $values = $this->getValue('rep_equipo_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RepEquipo();
        $obj->setCaIdreporte($this->object->getPrimaryKey());
        $obj->setCaIdconcepto($value);
        $obj->save();
      }
    }
  }

  public function saveRepStatusList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['rep_status_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RepStatusPeer::CA_IDREPORTE, $this->object->getPrimaryKey());
    RepStatusPeer::doDelete($c, $con);

    $values = $this->getValue('rep_status_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RepStatus();
        $obj->setCaIdreporte($this->object->getPrimaryKey());
        $obj->setCaIdemail($value);
        $obj->save();
      }
    }
  }

}
