<?php

/**
 * Formulario filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFormularioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_titulo'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ca_alias'            => new sfWidgetFormFilterInput(),
      'ca_introduccion'     => new sfWidgetFormFilterInput(),
      'ca_activo'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ca_vigencia_inicial' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ca_vigencia_final'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ca_token'            => new sfWidgetFormFilterInput(),
      'ca_nombre_formato'   => new sfWidgetFormFilterInput(),
      'ca_empresa'          => new sfWidgetFormFilterInput(),
      'ca_fchcreado'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ca_usucreado'        => new sfWidgetFormFilterInput(),
      'ca_fchactualizado'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ca_usuactualizado'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'ca_titulo'           => new sfValidatorPass(array('required' => false)),
      'ca_alias'            => new sfValidatorPass(array('required' => false)),
      'ca_introduccion'     => new sfValidatorPass(array('required' => false)),
      'ca_activo'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ca_vigencia_inicial' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ca_vigencia_final'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ca_token'            => new sfValidatorPass(array('required' => false)),
      'ca_nombre_formato'   => new sfValidatorPass(array('required' => false)),
      'ca_empresa'          => new sfValidatorPass(array('required' => false)),
      'ca_fchcreado'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ca_usucreado'        => new sfValidatorPass(array('required' => false)),
      'ca_fchactualizado'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ca_usuactualizado'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('formulario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Formulario';
  }

  public function getFields()
  {
    return array(
      'ca_id'               => 'Number',
      'ca_titulo'           => 'Text',
      'ca_alias'            => 'Text',
      'ca_introduccion'     => 'Text',
      'ca_activo'           => 'Boolean',
      'ca_vigencia_inicial' => 'Date',
      'ca_vigencia_final'   => 'Date',
      'ca_token'            => 'Text',
      'ca_nombre_formato'   => 'Text',
      'ca_empresa'          => 'Text',
      'ca_fchcreado'        => 'Date',
      'ca_usucreado'        => 'Text',
      'ca_fchactualizado'   => 'Date',
      'ca_usuactualizado'   => 'Text',
    );
  }
}
