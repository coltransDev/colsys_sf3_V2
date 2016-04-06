<?php

/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of AdjuntarUsuarioForm
 *
 * @author abotero
 */
class AdjuntarUsuarioForm extends BaseForm {

    public function configure() {

        sfValidatorBase::setCharset('ISO-8859-1');
        sfWidget::setCharset('ISO-8859-1');


        $this->setWidgets(array(
            'ca_idticket' => new sfWidgetFormInputHidden(),
            'ca_login' => new sfWidgetFormDoctrineChoice(
                    array(
                'model' => 'Usuario',
                'add_empty' => false,
                'key_method' => 'getCaLogin',
                'order_by' => array('ca_nombre', 'ASC')
                    ))
        ));

        $this->widgetSchema->setLabels(array(
            'ca_login' => 'Usuario'
        ));



        $this->setValidators(array(
            'ca_idticket' => new sfValidatorDoctrineChoice(
                    array('required' => true,
                'model' => 'HdeskTicket',
                'column' => 'ca_idticket'
                    )
                    , array(
                'required' => 'El ticket requerido'
                    )),
            'ca_login' => new sfValidatorDoctrineUnique(
                    array('required' => true,
                'model' => 'HdeskTicketUser',
                'column' => array('ca_login', 'ca_idticket')
                    )
                    , array(
                'required' => 'El usuario requerido'
                    ))
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('required' => true,
            'model' => 'HdeskTicketUser',
            'column' => array('ca_idticket', 'ca_login')
                ))
        );
    }

}

?>
