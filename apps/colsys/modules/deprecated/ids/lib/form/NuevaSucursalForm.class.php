<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


/**
 * Description of NuevaSucursalForm class
 *
 * @author abotero
 */
class NuevaSucursalForm extends sfForm {
    public function configure(){

		sfValidatorBase::setCharset('ISO-8859-1');


        $criteriaCiudades = new Criteria();
		$criteriaCiudades->addJoin( TraficoPeer::CA_IDTRAFICO, CiudadPeer::CA_IDTRAFICO );
		$criteriaCiudades->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
        $criteriaCiudades->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );

		$widgets = array();
        $widgets['idsucursal'] = new sfWidgetFormInputHidden(array(), array("size"=>80 ));
        $widgets['direccion'] = new sfWidgetFormInput(array(), array("size"=>80 ));
        $widgets['telefonos'] = new sfWidgetFormInput(array(), array("size"=>40 ));
        $widgets['fax'] = new sfWidgetFormInput(array(), array("size"=>40 ));
        $widgets['idciudad'] = new sfWidgetFormPropelChoice(array('model' => 'Ciudad', 'add_empty' => false, 'criteria' => $criteriaCiudades));
        $this->setWidgets( $widgets );

		$validator = array();
        $validator["idciudad"] = new sfValidatorPropelChoice(array('model' => 'IdsSucursal', 'column' => 'ca_idsucursal', 'required' => false));
        $validator["direccion"] =new sfValidatorString( array('required' => true ),
														array('required' => 'La dirección es requerida'));
        $validator["telefonos"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El teléfono es requerido'));

        $validator["fax"] = new sfValidatorString( array('required' => false ),
														array('required' => 'El fax es requerido'));
        $validator["idciudad"] = new sfValidatorPropelChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => true));
        $this->setValidators( $validator );

    }
}
?>
