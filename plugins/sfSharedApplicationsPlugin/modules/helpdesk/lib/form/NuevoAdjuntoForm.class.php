<?php

/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of NuevoAdjuntoForm class
 *
 * @author abotero
 */
class NuevoAdjuntoForm extends BaseForm {

    public function configure() {

        sfValidatorBase::setCharset('ISO-8859-1');
        sfWidget::setCharset('ISO-8859-1');


        $widgets = array();
        $widgets['archivo'] = new sfWidgetFormInputFile(array(), array("size" => 40));
        $this->setWidgets($widgets);
        $validator = array();
        $validator['archivo'] = new sfValidatorFile(array('required' => true));
        $this->setValidators($validator);
    }

}

?>
