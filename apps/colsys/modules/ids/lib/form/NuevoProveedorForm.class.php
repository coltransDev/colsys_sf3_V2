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


        $c = new Criteria();
        $c->add(IdsTipoPeer::CA_APLICACION, 'Proveedores');
		$c->addAscendingOrderByColumn( IdsTipoPeer::CA_NOMBRE );
        $widgets['tipo_proveedor'] = new sfWidgetFormPropelChoice(array('model' => 'IdsTipo', 'add_empty' => false, 'criteria' => $c));

        $widgets['critico'] = new sfWidgetFormInputCheckbox();
        $widgets['controladoporsig'] = new sfWidgetFormInputCheckbox();
        $widgets['aprobado'] = new sfWidgetFormInputCheckbox();


		$this->setWidgets( $widgets );


        $validator["tipo_proveedor"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El tipo de proveedor es requerido'));

        $validator["critico"] =new sfValidatorBoolean( array('required' => false ),
														array('required' => 'Este campo es requerido'));


        $validator["controladoporsig"] =new sfValidatorBoolean( array('required' => false ),
														array('required' => 'Este campo es requerido'));

        $validator["aprobado"] =new sfValidatorBoolean( array('required' => false ),
														array('required' => 'Este campo es requerido'));

       

        $this->setValidators( $validator );
    }
}
?>
