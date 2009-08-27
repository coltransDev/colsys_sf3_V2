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

        
        $c = new Criteria();                
        $c->add( IdsCriterioPeer::CA_TIPOCRITERIO, "desempeno" );        
        $widgets['tipo_evento'] = new sfWidgetFormPropelChoice(array('model' => 'IdsCriterio', 'add_empty' => false, 'criteria' => $c));

        $widgets['evento'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>80 ) );
		
        $idproveedores = $this->getIdproveedores();
        if( $idproveedores ){
            $choices = array();
            foreach( $idproveedores as $idproveedor ){
                $proveedor = TransportadorPeer::retrieveByPK( $idproveedor );
                $choices[ $proveedor->getCaIdtransportista() ]=$proveedor->getCaNombre();
            }

            $widgets['id'] = new sfWidgetFormChoice(array(
															  'choices' => $choices,
															)
                                                    );

        }
        $this->setWidgets( $widgets );

        $validator["id"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El proveedor es requerido'));
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