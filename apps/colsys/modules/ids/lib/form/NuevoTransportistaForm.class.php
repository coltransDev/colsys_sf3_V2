<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of NuevoTransportistaForm
 *
 * @author abotero
 */
class NuevoTransportistaForm extends sfForm{
    public function configure(){

		sfValidatorBase::setCharset('ISO-8859-1');

		$widgets = array();
		$validator = array();



        $widgets['transporte'] = new sfWidgetFormChoice(array('choices' => array(Constantes::AEREO=>Constantes::AEREO,
                                                                                 Constantes::MARITIMO=>Constantes::MARITIMO,
                                                                                 Constantes::TERRESTRE=>Constantes::TERRESTRE
                                                                                )));
        $widgets['nombre'] = new sfWidgetFormInput(array(), array("size"=>80 ) );
        $widgets['sigla'] = new sfWidgetFormInput(array(), array("size"=>10 ) );
        $widgets['activo'] = new sfWidgetFormInputCheckbox();
        $this->setWidgets( $widgets );

        $validator["transporte"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El transporte es requerido'));
        $validator["nombre"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El nombre es requerido'));
        $validator["sigla"] =new sfValidatorString( array('required' => false ) );
        $validator["activo"] =new sfValidatorString( array('required' => false ) );
        $this->setValidators( $validator );


	}


}
?>
