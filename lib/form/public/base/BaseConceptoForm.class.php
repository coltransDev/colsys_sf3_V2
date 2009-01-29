<?php

/**
 * Concepto form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseConceptoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idconcepto'   => new sfWidgetFormInputHidden(),
      'ca_concepto'     => new sfWidgetFormInput(),
      'ca_unidad'       => new sfWidgetFormInput(),
      'ca_transporte'   => new sfWidgetFormInput(),
      'ca_modalidad'    => new sfWidgetFormInput(),
      'ca_liminferior'  => new sfWidgetFormInput(),
      'rep_equipo_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Reporte')),
    ));

    $this->setValidators(array(
      'ca_idconcepto'   => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_concepto'     => new sfValidatorString(),
      'ca_unidad'       => new sfValidatorString(),
      'ca_transporte'   => new sfValidatorString(),
      'ca_modalidad'    => new sfValidatorString(),
      'ca_liminferior'  => new sfValidatorInteger(array('required' => false)),
      'rep_equipo_list' => new sfValidatorPropelChoiceMany(array('model' => 'Reporte', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('concepto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Concepto';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['rep_equipo_list']))
    {
      $values = array();
      foreach ($this->object->getRepEquipos() as $obj)
      {
        $values[] = $obj->getCaIdreporte();
      }

      $this->setDefault('rep_equipo_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveRepEquipoList($con);
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
    $c->add(RepEquipoPeer::CA_IDCONCEPTO, $this->object->getPrimaryKey());
    RepEquipoPeer::doDelete($c, $con);

    $values = $this->getValue('rep_equipo_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RepEquipo();
        $obj->setCaIdconcepto($this->object->getPrimaryKey());
        $obj->setCaIdreporte($value);
        $obj->save();
      }
    }
  }

}
