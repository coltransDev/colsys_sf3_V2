<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */





class myInoConceptoForm extends BaseInoConceptoForm
{
    public function configure()
    {
        $this->widgetSchema['ca_tipo']=new sfWidgetFormChoice( array( "choices" => array(  //Constantes::FLETE=>Constantes::FLETE,
                                                                                           Constantes::RECARGO_EN_ORIGEN=>Constantes::RECARGO_EN_ORIGEN,
                                                                                           Constantes::RECARGO_LOCAL=>Constantes::RECARGO_LOCAL,
                                                                                           //Constantes::COSTO=>Constantes::COSTO
                                                                                        ) ) );
        
                                                                                        
        $this->widgetSchema['ca_concepto']=new sfWidgetFormInputText( array(), array("size"=>80, "maxsize"=>100));

        $this->widgetSchema['ca_comisionable']=new sfWidgetFormChoice( array( "choices" => array("1"=>"S&iacute;",
                                                                                                 "0"=>"No")) );
    }
}
?>
