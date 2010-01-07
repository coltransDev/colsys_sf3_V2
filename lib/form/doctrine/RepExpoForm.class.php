<?php

/**
 * RepExpo form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RepExpoForm extends BaseRepExpoForm
{
    public function configure()
    {
        
        
        $this->widgetSchema['ca_piezas']= new sfWidgetFormInputText(array(), array("size"=>8) );
        $q = Doctrine_Query::create()->select("p.ca_valor")->from("Parametro p")->where("p.ca_casouso=?", "CU047")
                                       ->addOrderBy("p.ca_identificacion");
        $this->widgetSchema['tipo_piezas']=new sfWidgetFormDoctrineChoice(array("model"=>"Parametro",
                                                                            'add_empty' => false,
                                                                            'method' => "getCaValor",
                                                                            'key_method' => "getCaValor",
                                                                            'query' => $q
                                                                      ));

        $this->widgetSchema['ca_peso']= new sfWidgetFormInputText(array(), array("size"=>8) );
        $q = Doctrine_Query::create()->select("p.ca_valor")->from("Parametro p")->where("p.ca_casouso=?", "CU049")
                                       ->addOrderBy("p.ca_identificacion");
        $this->widgetSchema['tipo_peso']=new sfWidgetFormDoctrineChoice(array("model"=>"Parametro",
                                                                            'add_empty' => false,
                                                                            'method' => "getCaValor",
                                                                            'key_method' => "getCaValor",
                                                                            'query' => $q
                                                                      ));

        $this->widgetSchema['ca_volumen']= new sfWidgetFormInputText(array(), array("size"=>8) );
        $q = Doctrine_Query::create()->select("p.ca_valor")->from("Parametro p")->where("p.ca_casouso=?", "CU050")
                                       ->addOrderBy("p.ca_identificacion");
        $this->widgetSchema['tipo_volumen_maritimo']=new sfWidgetFormDoctrineChoice(array("model"=>"Parametro",
                                                                            'add_empty' => false,
                                                                            'method' => "getCaValor",
                                                                            'key_method' => "getCaValor",
                                                                            'query' => $q
                                                                      ));
        $q = Doctrine_Query::create()->select("p.ca_valor")->from("Parametro p")->where("p.ca_casouso=?", "CU058")
                                       ->addOrderBy("p.ca_identificacion");
        $this->widgetSchema['tipo_volumen_aereo']=new sfWidgetFormDoctrineChoice(array("model"=>"Parametro",
                                                                            'add_empty' => false,
                                                                            'method' => "getCaValor",
                                                                            'key_method' => "getCaValor",
                                                                            'query' => $q
                                                                      ));

        $this->widgetSchema['ca_dimensiones']=new sfWidgetFormTextarea(array(), array("cols"=>22, "rows"=>3));

        $this->widgetSchema['ca_emisionbl']=new sfWidgetFormChoice(array("choices"=>array("Origen"=>"Origen","Destino"=>"Destino")
                                                                      ));
        
        $q = Doctrine_Query::create()->select("p.ca_valor")->from("Parametro p")->where("p.ca_casouso=?", "CU011")
                                       ->addOrderBy("p.ca_identificacion");
        $this->widgetSchema['ca_tipoexpo']=new sfWidgetFormDoctrineChoice(array("model"=>"Parametro",
                                                                            'add_empty' => false,
                                                                            'method' => "getCaValor",
                                                                            'key_method' => "getCaIdentificacion",
                                                                            'query' => $q
                                                                      ));

        $this->widgetSchema['ca_idsia']=new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sia'), 'add_empty' => true, 'order_by'=>array("ca_nombre","ASC")));
        $this->widgetSchema['ca_anticipo']=new sfWidgetFormChoice(array("choices"=>array("Si"=>"Si","No"=>"No")
                                                                      ));

        $this->validatorSchema['ca_piezas'] = new sfValidatorNumber(array('required' => true));
        $this->validatorSchema['ca_peso'] = new sfValidatorNumber(array('required' => true));
        $this->validatorSchema['ca_volumen'] = new sfValidatorNumber(array('required' => true));

        $this->validatorSchema['tipo_piezas'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['tipo_peso'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['tipo_volumen_maritimo'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['tipo_volumen_aereo'] = new sfValidatorString(array('required' => false));



    }
}
