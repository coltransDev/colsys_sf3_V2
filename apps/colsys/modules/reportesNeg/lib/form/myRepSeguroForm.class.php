<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
class myRepSeguroForm extends BaseRepSeguroForm
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
        /*$this->widgetSchema['ca_instrucciones']=new sfWidgetFormTextarea(array(), array("rows"=>5, "cols"=>80, "wrap"=>"virtual" ) );

        $this->widgetSchema['ca_transnacarga']=new sfWidgetFormChoice( array( "choices" => array("Sí"=>"Si",
                                                                                                 "No"=>"No"
                                                                                              )));
        $q = Doctrine_Query::create()->select("p.ca_valor")->from("Parametro p")->where("p.ca_casouso=?", "CU056")
                                       ->addOrderBy("p.ca_identificacion");
        $this->widgetSchema['ca_transnatipo']=new sfWidgetFormDoctrineChoice(array("model"=>"Parametro",
                                                                            'add_empty' => false,
                                                                            'query' => $q,
                                                                            'method' => "getCaValor",
                                                                            'key_method' => "getCaValor"
                                                                      ));
        */
       

    }
  


}

?>
