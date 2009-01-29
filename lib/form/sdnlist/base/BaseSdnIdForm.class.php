<?php

/**
 * SdnId form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseSdnIdForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_uid'            => new sfWidgetFormInputHidden(),
      'ca_uid_id'         => new sfWidgetFormInputHidden(),
      'ca_idtype'         => new sfWidgetFormInput(),
      'ca_idnumber'       => new sfWidgetFormInput(),
      'ca_idcountry'      => new sfWidgetFormInput(),
      'ca_issuedate'      => new sfWidgetFormInput(),
      'ca_expirationdate' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_uid'            => new sfValidatorPropelChoice(array('model' => 'Sdn', 'column' => 'ca_uid', 'required' => false)),
      'ca_uid_id'         => new sfValidatorPropelChoice(array('model' => 'SdnId', 'column' => 'ca_uid_id', 'required' => false)),
      'ca_idtype'         => new sfValidatorString(array('required' => false)),
      'ca_idnumber'       => new sfValidatorString(array('required' => false)),
      'ca_idcountry'      => new sfValidatorString(array('required' => false)),
      'ca_issuedate'      => new sfValidatorString(array('required' => false)),
      'ca_expirationdate' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sdn_id[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SdnId';
  }


}
