<?php

/**
 * Resultado filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseResultadoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_cliente'   => new sfWidgetFormFilterInput(),
      'ca_resultado' => new sfWidgetFormFilterInput(),
      'ca_extra'     => new sfWidgetFormFilterInput(),
      'ca_extra2'    => new sfWidgetFormFilterInput(),
      'ca_extra3'    => new sfWidgetFormFilterInput(),
      'ca_extra4'    => new sfWidgetFormFilterInput(),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'ca_cliente'   => new sfValidatorPass(array('required' => false)),
      'ca_resultado' => new sfValidatorPass(array('required' => false)),
      'ca_extra'     => new sfValidatorPass(array('required' => false)),
      'ca_extra2'    => new sfValidatorPass(array('required' => false)),
      'ca_extra3'    => new sfValidatorPass(array('required' => false)),
      'ca_extra4'    => new sfValidatorPass(array('required' => false)),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('resultado_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Resultado';
  }

  public function getFields()
  {
    return array(
      'ca_id'        => 'Number',
      'ca_cliente'   => 'Text',
      'ca_resultado' => 'Text',
      'ca_extra'     => 'Text',
      'ca_extra2'    => 'Text',
      'ca_extra3'    => 'Text',
      'ca_extra4'    => 'Text',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
