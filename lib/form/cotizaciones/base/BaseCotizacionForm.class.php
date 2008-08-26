<?php

/**
 * Cotizacion form base class.
 *
 * @package    form
 * @subpackage cotizacion
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCotizacionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcotizacion'       => new sfWidgetFormInputHidden(),
      'ca_fchcotizacion'      => new sfWidgetFormDate(),
      'ca_fchpresentacion'    => new sfWidgetFormDate(),
      'ca_idcontacto'         => new sfWidgetFormPropelSelect(array('model' => 'Contacto', 'add_empty' => false)),
      'ca_asunto'             => new sfWidgetFormInput(),
      'ca_saludo'             => new sfWidgetFormInput(),
      'ca_entrada'            => new sfWidgetFormInput(),
      'ca_despedida'          => new sfWidgetFormInput(),
      'ca_usuario'            => new sfWidgetFormPropelSelect(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_anexos'             => new sfWidgetFormInput(),
      'ca_fchcreado'          => new sfWidgetFormDate(),
      'ca_usucreado'          => new sfWidgetFormInput(),
      'ca_fchactualizado'     => new sfWidgetFormDate(),
      'ca_usuactualizado'     => new sfWidgetFormInput(),
      'ca_fchsolicitud'       => new sfWidgetFormDate(),
      'ca_horasolicitud'      => new sfWidgetFormTime(),
      'ca_fchanulado'         => new sfWidgetFormDate(),
      'ca_usuanulado'         => new sfWidgetFormInput(),
      'cot_continuacion_list' => new sfWidgetFormPropelSelectMany(array('model' => 'Concepto')),
    ));

    $this->setValidators(array(
      'ca_idcotizacion'       => new sfValidatorPropelChoice(array('model' => 'Cotizacion', 'column' => 'ca_idcotizacion', 'required' => false)),
      'ca_fchcotizacion'      => new sfValidatorDate(),
      'ca_fchpresentacion'    => new sfValidatorDate(),
      'ca_idcontacto'         => new sfValidatorPropelChoice(array('model' => 'Contacto', 'column' => 'ca_idcontacto')),
      'ca_asunto'             => new sfValidatorString(array('required' => false)),
      'ca_saludo'             => new sfValidatorString(array('required' => false)),
      'ca_entrada'            => new sfValidatorString(array('required' => false)),
      'ca_despedida'          => new sfValidatorString(array('required' => false)),
      'ca_usuario'            => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
      'ca_anexos'             => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'          => new sfValidatorDate(array('required' => false)),
      'ca_usucreado'          => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado'     => new sfValidatorDate(array('required' => false)),
      'ca_usuactualizado'     => new sfValidatorString(array('required' => false)),
      'ca_fchsolicitud'       => new sfValidatorDate(array('required' => false)),
      'ca_horasolicitud'      => new sfValidatorTime(array('required' => false)),
      'ca_fchanulado'         => new sfValidatorDate(array('required' => false)),
      'ca_usuanulado'         => new sfValidatorString(array('required' => false)),
      'cot_continuacion_list' => new sfValidatorPropelChoiceMany(array('model' => 'Concepto', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cotizacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cotizacion';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['cot_continuacion_list']))
    {
      $values = array();
      foreach ($this->object->getCotContinuacions() as $obj)
      {
        $values[] = $obj->getCaIdconcepto();
      }

      $this->setDefault('cot_continuacion_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCotContinuacionList($con);
  }

  public function saveCotContinuacionList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['cot_continuacion_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->object->getPrimaryKey());
    CotContinuacionPeer::doDelete($c, $con);

    $values = $this->getValue('cot_continuacion_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CotContinuacion();
        $obj->setCaIdcotizacion($this->object->getPrimaryKey());
        $obj->setCaIdconcepto($value);
        $obj->save();
      }
    }
  }

}
