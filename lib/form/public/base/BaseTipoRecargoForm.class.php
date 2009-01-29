<?php

/**
 * TipoRecargo form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseTipoRecargoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idrecargo'     => new sfWidgetFormInputHidden(),
      'ca_recargo'       => new sfWidgetFormInput(),
      'ca_tipo'          => new sfWidgetFormInput(),
      'ca_transporte'    => new sfWidgetFormInput(),
      'ca_incoterms'     => new sfWidgetFormInput(),
      'ca_reporte'       => new sfWidgetFormInput(),
      'ca_impoexpo'      => new sfWidgetFormInput(),
      'ca_aplicacion'    => new sfWidgetFormInput(),
      'cot_recargo_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'CotOpcion')),
    ));

    $this->setValidators(array(
      'ca_idrecargo'     => new sfValidatorPropelChoice(array('model' => 'TipoRecargo', 'column' => 'ca_idrecargo', 'required' => false)),
      'ca_recargo'       => new sfValidatorString(),
      'ca_tipo'          => new sfValidatorString(),
      'ca_transporte'    => new sfValidatorString(),
      'ca_incoterms'     => new sfValidatorString(array('required' => false)),
      'ca_reporte'       => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'      => new sfValidatorString(array('required' => false)),
      'ca_aplicacion'    => new sfValidatorString(array('required' => false)),
      'cot_recargo_list' => new sfValidatorPropelChoiceMany(array('model' => 'CotOpcion', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipo_recargo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoRecargo';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['cot_recargo_list']))
    {
      $values = array();
      foreach ($this->object->getCotRecargos() as $obj)
      {
        $values[] = $obj->getCaIdopcion();
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
    $c->add(CotRecargoPeer::CA_IDRECARGO, $this->object->getPrimaryKey());
    CotRecargoPeer::doDelete($c, $con);

    $values = $this->getValue('cot_recargo_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CotRecargo();
        $obj->setCaIdrecargo($this->object->getPrimaryKey());
        $obj->setCaIdopcion($value);
        $obj->save();
      }
    }
  }

}
