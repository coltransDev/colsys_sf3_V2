<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of NuevoProveedorForm
 *
 * @author abotero
 */
class NuevoProveedorForm extends sfForm{


	public function configure(){
        sfValidatorBase::setCharset('ISO-8859-1');

		$widgets = array();
		$validator = array();

        
        $q = Doctrine_Query::create()
                             ->from("IdsTipo t")
                             ->where("t.ca_aplicacion = ? ", "Proveedores")
                             ->addOrderBy("t.ca_nombre");
        $widgets['tipo_proveedor'] = new sfWidgetFormDoctrineChoice(array('model' => 'IdsTipo', 'add_empty' => false, 'query' => $q), array("onChange"=>"changeTipo()"));

        $widgets['critico'] = new sfWidgetFormInputCheckbox();
        $widgets['esporadico'] = new sfWidgetFormInputCheckbox();
        $widgets['controladoporsig'] = new sfWidgetFormInputCheckbox();
        $widgets['aprobado'] = new sfWidgetFormExtDate();
        $widgets['activo'] = new sfWidgetFormInputCheckbox();
        $widgets['sigla'] = new sfWidgetFormInput();
        $widgets['transporte'] = new sfWidgetFormChoice(array('choices' => array( ""=>"",
                                                                                  Constantes::AEREO=>Constantes::AEREO,
                                                                                 Constantes::MARITIMO=>Constantes::MARITIMO,
                                                                                 Constantes::TERRESTRE=>Constantes::TERRESTRE
                                                                                )));

		$this->setWidgets( $widgets );


        $validator["tipo_proveedor"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El tipo de proveedor es requerido'));

        $validator["critico"] =new sfValidatorBoolean( array('required' => false ),
														array('required' => 'Este campo es requerido'));

        $validator["esporadico"] =new sfValidatorBoolean( array('required' => false ),
														array('required' => 'Este campo es requerido'));


        $validator["controladoporsig"] =new sfValidatorBoolean( array('required' => false ),
														array('required' => 'Este campo es requerido'));

        $validator["aprobado"] =new sfValidatorDate( array('required' => false ),
														array('required' => 'Este campo es requerido'));

       
        $validator["activo"] =new sfValidatorBoolean( array('required' => false ) );

        $validator["transporte"] =new sfValidatorString( array('required' => false ),
														array('required' => 'El transporte es requerido'));
        $validator["sigla"] =new sfValidatorString( array('required' => false ) );

        $this->setValidators( $validator );
    }
}
?>
