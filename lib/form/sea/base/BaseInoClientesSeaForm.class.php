<?php

/**
 * InoClientesSea form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseInoClientesSeaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'oid'                  => new sfWidgetFormInput(),
      'ca_referencia'        => new sfWidgetFormInputHidden(),
      'ca_idcliente'         => new sfWidgetFormInputHidden(),
      'ca_hbls'              => new sfWidgetFormInputHidden(),
      'ca_idreporte'         => new sfWidgetFormPropelChoice(array('model' => 'Reporte', 'add_empty' => true)),
      'ca_idproveedor'       => new sfWidgetFormPropelChoice(array('model' => 'Tercero', 'add_empty' => true)),
      'ca_proveedor'         => new sfWidgetFormInput(),
      'ca_numpiezas'         => new sfWidgetFormInput(),
      'ca_peso'              => new sfWidgetFormInput(),
      'ca_volumen'           => new sfWidgetFormInput(),
      'ca_numorden'          => new sfWidgetFormInput(),
      'ca_confirmar'         => new sfWidgetFormInput(),
      'ca_login'             => new sfWidgetFormInput(),
      'ca_observaciones'     => new sfWidgetFormInput(),
      'ca_fchliberacion'     => new sfWidgetFormDate(),
      'ca_notaliberacion'    => new sfWidgetFormInput(),
      'ca_fchcreado'         => new sfWidgetFormDateTime(),
      'ca_usucreado'         => new sfWidgetFormInput(),
      'ca_fchactualizado'    => new sfWidgetFormDateTime(),
      'ca_usuactualizado'    => new sfWidgetFormInput(),
      'ca_fchliberado'       => new sfWidgetFormDateTime(),
      'ca_usuliberado'       => new sfWidgetFormInput(),
      'ca_mensaje'           => new sfWidgetFormInput(),
      'ca_continuacion'      => new sfWidgetFormInput(),
      'ca_continuacion_dest' => new sfWidgetFormInput(),
      'ca_idbodega'          => new sfWidgetFormInput(),
      'ino_avisos_sea_list'  => new sfWidgetFormPropelChoiceMany(array('model' => 'InoMaestraSea')),
    ));

    $this->setValidators(array(
      'oid'                  => new sfValidatorInteger(array('required' => false)),
      'ca_referencia'        => new sfValidatorPropelChoice(array('model' => 'InoMaestraSea', 'column' => 'ca_referencia', 'required' => false)),
      'ca_idcliente'         => new sfValidatorPropelChoice(array('model' => 'Cliente', 'column' => 'ca_idcliente', 'required' => false)),
      'ca_hbls'              => new sfValidatorPropelChoice(array('model' => 'InoClientesSea', 'column' => 'ca_hbls', 'required' => false)),
      'ca_idreporte'         => new sfValidatorPropelChoice(array('model' => 'Reporte', 'column' => 'ca_idreporte', 'required' => false)),
      'ca_idproveedor'       => new sfValidatorPropelChoice(array('model' => 'Tercero', 'column' => 'ca_idtercero', 'required' => false)),
      'ca_proveedor'         => new sfValidatorString(array('required' => false)),
      'ca_numpiezas'         => new sfValidatorNumber(array('required' => false)),
      'ca_peso'              => new sfValidatorNumber(array('required' => false)),
      'ca_volumen'           => new sfValidatorNumber(array('required' => false)),
      'ca_numorden'          => new sfValidatorString(array('required' => false)),
      'ca_confirmar'         => new sfValidatorString(array('required' => false)),
      'ca_login'             => new sfValidatorString(array('required' => false)),
      'ca_observaciones'     => new sfValidatorString(array('required' => false)),
      'ca_fchliberacion'     => new sfValidatorDate(array('required' => false)),
      'ca_notaliberacion'    => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'         => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'         => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado'    => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'    => new sfValidatorString(array('required' => false)),
      'ca_fchliberado'       => new sfValidatorDateTime(array('required' => false)),
      'ca_usuliberado'       => new sfValidatorString(array('required' => false)),
      'ca_mensaje'           => new sfValidatorString(array('required' => false)),
      'ca_continuacion'      => new sfValidatorString(array('required' => false)),
      'ca_continuacion_dest' => new sfValidatorString(array('required' => false)),
      'ca_idbodega'          => new sfValidatorInteger(array('required' => false)),
      'ino_avisos_sea_list'  => new sfValidatorPropelChoiceMany(array('model' => 'InoMaestraSea', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_clientes_sea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoClientesSea';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['ino_avisos_sea_list']))
    {
      $values = array();
      foreach ($this->object->getInoAvisosSeas() as $obj)
      {
        $values[] = $obj->getCaReferencia();
      }

      $this->setDefault('ino_avisos_sea_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveInoAvisosSeaList($con);
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
    $c->add(InoAvisosSeaPeer::CA_HBLS, $this->object->getPrimaryKey());
    InoAvisosSeaPeer::doDelete($c, $con);

    $values = $this->getValue('ino_avisos_sea_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InoAvisosSea();
        $obj->setCaHbls($this->object->getPrimaryKey());
        $obj->setCaReferencia($value);
        $obj->save();
      }
    }
  }

}
