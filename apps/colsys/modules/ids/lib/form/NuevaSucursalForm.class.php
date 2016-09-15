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
class NuevaSucursalForm extends BaseForm {
    public function configure(){

		sfValidatorBase::setCharset('ISO-8859-1');

       
        $q = Doctrine_Query::create()
                             ->from("Ciudad c")
                             ->innerJoin("c.Trafico t")
                             ->addOrderBy("t.ca_nombre")
                             ->addOrderBy("c.ca_ciudad");
		$widgets = array();
        $widgets['nombre'] = new sfWidgetFormInputText(array(), array("size"=>200 ));
        
        $widgets['idsucursal'] = new sfWidgetFormInputHidden(array(), array("size"=>80 ));
        $widgets['direccion'] = new sfWidgetFormInputText(array(), array("size"=>80, "maxlength"=>100 ));
        $widgets['telefonos'] = new sfWidgetFormInputText(array(), array("size"=>40, "maxlength"=>50 ));
        $widgets['fax'] = new sfWidgetFormInputText(array(), array("size"=>40, "maxlength"=>50 ));
        $widgets['idciudad'] = new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => false, 'query' => $q));
        $widgets['idciudaddes'] = new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true, 'query' => $q));
        $this->setWidgets( $widgets );

        $validator = array();
        $validator["idciudad"] = new sfValidatorDoctrineChoice(array('model' => 'IdsSucursal', 'column' => 'ca_idsucursal', 'required' => false));
        $validator["idciudaddes"] = new sfValidatorDoctrineChoice(array('model' => 'IdsSucur    sal', 'column' => 'ca_idsucursal', 'required' => false));
        $validator["nombre"] =new sfValidatorString( array('required' => false, "max_length"=>200 ));
        $validator["direccion"] =new sfValidatorString( array('required' => true, "max_length"=>100 ), array('required' => 'La dirección es requerida'));
        $validator["telefonos"] =new sfValidatorString( array('required' => true, "max_length"=>50 ), array('required' => 'El teléfono es requerido'));
        $validator["fax"] = new sfValidatorString( array('required' => false ), array('required' => 'El fax es requerido'));
        $validator["idciudad"] = new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => true));
        $validator["idciudaddes"] = new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => false));
        $this->setValidators( $validator );

    }
}
?>