<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of NuevoDocumentoPorTipoForm
 *
 * @author abotero
 */
class NuevoDocumentoPorTipoForm extends BaseForm{


	public function configure(){
        sfValidatorBase::setCharset('ISO-8859-1');

		$widgets = array();
		$validator = array();

        
        $q = Doctrine_Query::create()
                             ->from("IdsTipoDocumento t")
                             ->addOrderBy("t.ca_tipo");
        
        $widgets['tipo'] = new sfWidgetFormInputHidden(array(), array("size"=>80 ));
        $widgets['iddocumentosxtipo'] = new sfWidgetFormInputHidden(array(), array("size"=>80 ));
        $widgets['idtipo'] = new sfWidgetFormDoctrineChoice(array('model' => 'IdsTipoDocumento', 'add_empty' => false, 'query' => $q), array("onChange"=>"changeTipo()"));
       
        $widgets['controladoporsig'] = new sfWidgetFormInputCheckbox();
        $widgets['solo_si_aplica'] = new sfWidgetFormInputCheckbox();
        $widgets['transporte'] = new sfWidgetFormChoice(array('choices' => array( ""=>"",
                                                                                  Constantes::AEREO=>Constantes::AEREO,
                                                                                 Constantes::MARITIMO=>Constantes::MARITIMO,
                                                                                 Constantes::TERRESTRE=>Constantes::TERRESTRE
                                                                                 
                                                                                )));

        $widgets['impoexpo'] = new sfWidgetFormChoice(array('choices' => array( ""=>"",
                                                                                  Constantes::IMPO=>Constantes::IMPO,
                                                                                 Constantes::EXPO=>Constantes::EXPO
                                                                                )));
		$this->setWidgets( $widgets );

        $validator["iddocumentosxtipo"] =new sfValidatorString( array('required' => false ));

        $validator["tipo"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El tipo de proveedor es requerido'));

        $validator["idtipo"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El tipo de documento es requerido'));

      
        $validator["controladoporsig"] =new sfValidatorBoolean( array('required' => false ),
														array('required' => 'Este campo es requerido'));
        
        $validator["solo_si_aplica"] =new sfValidatorBoolean( array('required' => false ),
														array('required' => 'Este campo es requerido'));

        
        $validator["transporte"] =new sfValidatorString( array('required' => false ),
														array('required' => 'El transporte es requerido'));

        $validator["impoexpo"] =new sfValidatorString( array('required' => false ),
														array('required' => ''));
        
        $this->setValidators( $validator );
    }
}
?>
