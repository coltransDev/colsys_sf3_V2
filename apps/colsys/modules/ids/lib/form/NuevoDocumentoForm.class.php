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
class NuevoDocumentoForm extends BaseForm {

    public function configure() {

        sfValidatorBase::setCharset('ISO-8859-1');
        sfWidget::setCharset('ISO-8859-1');


        $widgets = array();
        $widgets['iddocumento'] = new sfWidgetFormInputHidden(array(), array("size" => 80));
        $widgets['inicio'] = new sfWidgetFormExtDate(array());
        $widgets['vencimiento'] = new sfWidgetFormExtDate(array());
        $widgets['archivo'] = new sfWidgetFormInputFile(array(), array("size" => 40));
        
        $q = Doctrine_Query::create()
                ->from("IdsTipoDocumento t")
                ->addOrderBy("t.ca_tipo");
        $widgets['idtipo'] = new sfWidgetFormDoctrineChoice(array('model' => 'IdsTipoDocumento', 'add_empty' => false, 'query'=>$q));

        $widgets['observaciones'] = new sfWidgetFormTextarea(array(), array("rows" => 1, "cols" => 30));
        
        
        $this->setWidgets($widgets);

        $validator = array();
        $validator["id"] = new sfValidatorDoctrineChoice(array('model' => 'Ids', 'column' => 'ca_id', 'required' => true));
        $validator["iddocumento"] = new sfValidatorDoctrineChoice(array('model' => 'IdsDocumento', 'column' => 'ca_iddocumento', 'required' => false));
        $validator["idtipo"] = new sfValidatorString( array('required' => true ),array('required' => 'El tipo'));
        $validator['observaciones'] = new sfValidatorString( array('required' => false));
        
        $validator["inicio"] = new sfValidatorDate(array('required' => true), array('required' => 'El inicio es requerido'));

        $validator["vencimiento"] = new sfValidatorString(array('required' => false), array('required' => 'El vencimiento es requerido'));
        $validator['archivo'] = new sfValidatorFile(array('required' => false));
        $this->setValidators($validator);
    }

}

?>
