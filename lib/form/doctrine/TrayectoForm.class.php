<?php

/**
 * Trayecto form.
 *
 * @package    form
 * @subpackage Trayecto
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class TrayectoForm extends BaseTrayectoForm
{
    public function configure()
    {

        //$this->widgetSchema['pais_origen']=new sfWidgetFormCountry(array("link"=>"ino_maestra_origen", 'add_empty'=>true));
        $this->widgetSchema['ca_origen']=new sfWidgetFormCity( );

        //$this->widgetSchema['pais_destino']=new sfWidgetFormCountry(array("link"=>"ciudad_destino", 'add_empty'=>true), array("id"=>"pais_destino"));
        $this->widgetSchema['ca_destino']=new sfWidgetFormCity();

        $q = Doctrine_Query::create()->select("p.*, i.ca_nombre")->from("IdsProveedor p")->innerJoin("p.Ids i")->addOrderBy("i.ca_nombre");
        $this->widgetSchema['ca_idlinea']=new sfWidgetFormDoctrineChoice(array("model"=>"IdsProveedor",
                                                                            'add_empty' => false,
                                                                            'query' => $q
                                                                      ));
        $q = Doctrine_Query::create()->select("a.*, i.ca_nombre")->from("IdsAgente a")->innerJoin("a.Ids i")->addOrderBy("i.ca_nombre");
        $this->widgetSchema['ca_idagente']=new sfWidgetFormDoctrineChoice(array("model"=>"IdsAgente",
                                                                            'add_empty' => false,
                                                                            'query' => $q
                                                                      ));
        
        $this->validatorSchema['ca_origen'] = new sfValidatorString(array('required'=>true));
        $this->validatorSchema['ca_destino'] = new sfValidatorString(array('required'=>true));
        $this->validatorSchema['ca_idlinea'] = new sfValidatorString(array('required'=>true));
        $this->validatorSchema['ca_idagente'] = new sfValidatorString(array('required'=>false));
        /*$this->validatorSchema['ca_impoexpo'] = new sfValidatorString(array('required'=>true));
        $this->validatorSchema['ca_modalidad'] = new sfValidatorString(array('required'=>true));
        $this->validatorSchema['ca_transporte'] = new sfValidatorString(array('required'=>true));*/

    }
}