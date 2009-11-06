<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
class myRepAduanaForm extends BaseRepAduanaForm
{
    
    public function configure(){
        
        $this->widgetSchema['ca_instrucciones']=new sfWidgetFormTextarea(array(), array("rows"=>5, "cols"=>80, "wrap"=>"virtual" ) );

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
        
    }
  


}

?>
