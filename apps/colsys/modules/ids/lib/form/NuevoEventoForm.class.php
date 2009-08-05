<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of NuevoEventoForm
 *
 * @author abotero
 */


class NuevoEventoForm extends sfForm{

    private $idproveedores;
	public function configure(){

		sfValidatorBase::setCharset('ISO-8859-1');

		$widgets = array();
		$validator = array();


        $widgets['tipo_evento'] = new sfWidgetFormChoice(array(
															  'choices' => array('Buen servicio'=>'Buen servicio',
                                                                                 'Mal servicio'=>'Mal servicio'
                                                                                ),
															)
                                                            
                                                    );

        $widgets['evento'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>80 ) );
		$this->setWidgets( $widgets );


        $validator["tipo_evento"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El tipo de evento es requerido'));

        $validator["evento"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El evento es requerido'));

        
        $this->setValidators( $validator );


	}


	public function bind(array $taintedValues = null, array $taintedFiles = null){


		parent::bind($taintedValues,  $taintedFiles);
	}


    public function setIdproveedores( array $v ){
        $this->idproveedores = $v;
    }

    public function getIdproveedores( ){
        return $this->idproveedores;
    }


}
?>