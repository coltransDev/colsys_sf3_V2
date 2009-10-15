<?php

/**
 * CotOpcion form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCotOpcionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idopcion'       => new sfWidgetFormInputHidden(),
      'ca_idcotizacion'   => new sfWidgetFormInputHidden(),
      'ca_idproducto'     => new sfWidgetFormInputHidden(),
      'ca_idconcepto'     => new sfWidgetFormPropelChoice(array('model' => 'Concepto', 'add_empty' => true)),
      'ca_valor_tar'      => new sfWidgetFormInput(),
      'ca_aplica_tar'     => new sfWidgetFormInput(),
      'ca_valor_min'      => new sfWidgetFormInput(),
      'ca_aplica_min'     => new sfWidgetFormInput(),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_recargos'       => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_consecutivo'    => new sfWidgetFormInput(),
      'cot_recargo_list'  => new sfWidgetFormPropelChoiceMany(array('model' => 'TipoRecargo')),
    ));

    $this->setValidators(array(
      'ca_idopcion'       => new sfValidatorPropelChoice(array('model' => 'CotOpcion', 'column' => 'ca_idopcion', 'required' => false)),
      'ca_idcotizacion'   => new sfValidatorPropelChoice(array('model' => 'CotProducto', 'column' => 'ca_idcotizacion', 'required' => false)),
      'ca_idproducto'     => new sfValidatorPropelChoice(array('model' => 'CotProducto', 'column' => 'ca_idproducto', 'required' => false)),
      'ca_idconcepto'     => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_valor_tar'      => new sfValidatorNumber(array('required' => false)),
      'ca_aplica_tar'     => new sfValidatorString(array('required' => false)),
      'ca_valor_min'      => new sfValidatorNumber(array('required' => false)),
      'ca_aplica_min'     => new sfValidatorString(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_recargos'       => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'ca_consecutivo'    => new sfValidatorInteger(array('required' => false)),
      'cot_recargo_list'  => new sfValidatorPropelChoiceMany(array('model' => 'TipoRecargo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_opcion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotOpcion';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['cot_recargo_list']))
    {
      $values = array();
      foreach ($this->object->getCotRecargos() as $obj)
      {
        $values[] = $obj->getCaIdrecargo();
      }

      $this->setDefault('cot_recargo_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCotRecargoList($con);
  }

  public function saveCotRecargoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['cot_recargo_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(CotRecargoPeer::CA_IDOPCION, $this->object->getPrimaryKey());
    CotRecargoPeer::doDelete($c, $con);

    $values = $this->getValue('cot_recargo_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CotRecargo();
        $obj->setCaIdopcion($this->object->getPrimaryKey());
        $obj->setCaIdrecargo($value);
        $obj->save();
      }
    }
  }

}
