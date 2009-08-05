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
		$c->addJoin( TraficoPeer::CA_IDTRAFICO, CiudadPeer::CA_IDTRAFICO );
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
        $c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );

        $widgets['tipo_proveedor'] = new sfWidgetFormChoice(array(
															  'choices' => array('1'=>'R.U.T',
                                                                                 '2'=>'C.C.',
                                                                                 '3'=>'Consecutivo Interno Colsys',
                                                                                 '4'=>'Otro'
                                                                                ),
															),
                                                            array("onChange"=>"getDV()")
                                                    );

        $widgets['critico'] = new sfWidgetFormChoice(array(
															  'choices' => array('0'=>'No',
                                                                                 '1'=>'Sí'
                                                                                ),
															)
                                                    );
        $widgets['ca_controladoporsig'] = new sfWidgetFormChoice(array(
															  'choices' => array('0'=>'No',
                                                                                 '1'=>'Sí'
                                                                                ),
															)
                                                    );

        $widgets['ca_aprobado'] = new sfWidgetFormChoice(array(
															  'choices' => array('0'=>'No',
                                                                                 '1'=>'Sí'
                                                                                ),
															)
                                                    );


		$this->setWidgets( $widgets );


        $validator["tipo_proveedor"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El tipo de proveedor es requerido'));

        $validator["critico"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));


        $validator["ca_controladoporsig"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));

        $validator["ca_aprobado"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));

       

        $this->setValidators( $validator );
    }
}
?>
