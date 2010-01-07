<?php

/**
 * RepSeguro form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RepSeguroForm extends BaseRepSeguroForm
{
    const NUM_SEGURO = 9;

    public function configure(){
        $q = Doctrine_Query::create()->select("m.*")->from("Moneda m")->addOrderBy("m.ca_idmoneda ASC");
        $this->widgetSchema['ca_idmoneda_vlr']=new sfWidgetFormDoctrineChoice(array("model"=>"Moneda",
                                                                            'add_empty' => false,
                                                                            'method' => "getCaIdmoneda",
                                                                            'key_method' => "getCaIdmoneda",
                                                                            'query' => $q
                                                                      ));
        $this->widgetSchema['ca_idmoneda_pol']=new sfWidgetFormDoctrineChoice(array("model"=>"Moneda",
                                                                            'add_empty' => false,
                                                                            'method' => "getCaIdmoneda",
                                                                            'key_method' => "getCaIdmoneda",
                                                                            'query' => $q
                                                                      ));
        $this->widgetSchema['ca_idmoneda_vta']=new sfWidgetFormDoctrineChoice(array("model"=>"Moneda",
                                                                            'add_empty' => false,
                                                                            'method' => "getCaIdmoneda",
                                                                            'key_method' => "getCaIdmoneda",
                                                                            'query' => $q
                                                                      ));

       $this->widgetSchema['ca_seguro_conf']=new sfWidgetFormDoctrineChoice(array('model' => 'Usuario', 'add_empty' => false, 'table_method'=>"getUsuariosSeguros", "expanded"=>true));

    }
}
