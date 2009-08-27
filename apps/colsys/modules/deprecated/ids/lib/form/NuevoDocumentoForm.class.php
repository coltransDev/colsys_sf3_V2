<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


/**
 * Description of NuevoDocumentoForm class
 *
 * @author abotero
 */
class NuevoDocumentoForm extends sfForm {
    public function configure(){

		sfValidatorBase::setCharset('ISO-8859-1');
        sfWidget::setCharset('ISO-8859-1');

        $criteriaCiudades = new Criteria();
		$criteriaCiudades->addJoin( TraficoPeer::CA_IDTRAFICO, CiudadPeer::CA_IDTRAFICO );
		$criteriaCiudades->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
        $criteriaCiudades->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );

		$widgets = array();
        $widgets['iddocumento'] = new sfWidgetFormInputHidden(array(), array("size"=>80 ));
        $widgets['inicio'] = new sfWidgetFormExtDate(array());
        $widgets['vencimiento'] = new sfWidgetFormExtDate(array());
        $widgets['archivo'] = new sfWidgetFormInputFile(array(), array("size"=>40 ));

        $widgets['idtipo'] = new sfWidgetFormPropelChoice(array('model' => 'IdsTipoDocumento', 'add_empty' => false));
        //, 'criteria' => $criteriaCiudades
        $widgets['observaciones'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>80 ) );
        $this->setWidgets( $widgets );

		$validator = array();
        $validator["id"] = new sfValidatorPropelChoice(array('model' => 'Ids', 'column' => 'ca_id', 'required' => true));
        $validator["iddocumento"] = new sfValidatorPropelChoice(array('model' => 'IdsDocumento', 'column' => 'ca_iddocumento', 'required' => false));
        $validator["idtipo"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El tipo'));
        $validator["inicio"] =new sfValidatorDate( array('required' => true ),
														array('required' => 'El inicio es requerido'));

        $validator["vencimiento"] = new sfValidatorString( array('required' => false ),
														array('required' => 'El vencimiento es requerido'));
        $validator['archivo'] = new sfValidatorFile(array('required' => false));
        $this->setValidators( $validator );

    }
}
?>
