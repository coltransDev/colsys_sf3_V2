<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of NuevoAgenteForm
 *
 * @author abotero
 */
class NuevoAgenteForm extends sfForm {
    public function configure(){
        sfValidatorBase::setCharset('ISO-8859-1');

		$widgets = array();
		$validator = array();


        $c = new Criteria();
        $c->add(IdsTipoPeer::CA_APLICACION, 'Proveedores');
		$c->addAscendingOrderByColumn( IdsTipoPeer::CA_NOMBRE );
       
        $widgets['tipo'] = new sfWidgetFormChoice(array(
															  'choices' => array('Oficial'=>'Oficial',
                                                                                 'No Oficial'=>'No Oficial'
                                                                                ), 'expanded'=>true,
															)
                                                    );
        $widgets['activo'] = new sfWidgetFormInputCheckbox();
		$this->setWidgets( $widgets );


        $validator["tipo"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El tipo es requerido'));
        $validator["activo"] =new sfValidatorBoolean( array('required' => false ) );
        $this->setValidators( $validator );
    }
}
?>
