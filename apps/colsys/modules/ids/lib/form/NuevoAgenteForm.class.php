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
class NuevoAgenteForm extends BaseForm {
    public function configure(){
        sfValidatorBase::setCharset('ISO-8859-1');

		$widgets = array();
		$validator = array();

        /*
        $c = new Criteria();
        $c->add(IdsTipoPeer::CA_APLICACION, 'Proveedores');
		$c->addAscendingOrderByColumn( IdsTipoPeer::CA_NOMBRE );*/
       
        $widgets['tipo'] = new sfWidgetFormChoice(array(
															  'choices' => array('Oficial'=>'Oficial',
                                                                                 'No Oficial'=>'No Oficial'
                                                                                ), 'expanded'=>true,
															)
                                                    );
        $widgets['activo'] = new sfWidgetFormInputCheckbox();
        
        $widgets['tplogistics'] = new sfWidgetFormInputCheckbox();
        $widgets['consolcargo'] = new sfWidgetFormInputCheckbox();
        $widgets['infosec'] = new sfWidgetFormTextarea(array(), array("size"=>80, "style"=>"width: 350px; height: 50px;"));
        
        $widgets['modalidad'] = new sfWidgetFormInputText(array(), array("size"=>30 ));
        $widgets['sucursal'] = new sfWidgetFormInputText(array(), array("size"=>80 ));
        $widgets['observaciones'] = new sfWidgetFormTextarea(array(), array("size"=>80, "style"=>"width: 350px; height: 50px;"));
        $q = Doctrine::getTable("MaestraClasificacion")
            ->createQuery("mc")
            ->select('mc.ca_idclasificacion, mc.ca_nombre')
            ->orWhere('mc.ca_tipo = ?', 'agente')
            ->addOrderBy("mc.ca_nombre");
        
        $widgets['idclasificacion'] = new sfWidgetFormDoctrineChoice(array('model' => 'Clasificacion', 
            'add_empty' => false, 
            'query' => $q,
            'method' => "getCaNombre",
            'key_method' => "getCaIdclasificacion",
            'add_empty'=> true));
        
        $this->setWidgets( $widgets );

        $validator["tipo"] =new sfValidatorString( array('required' => true ),array('required' => 'El tipo es requerido'));
        $validator["activo"] =new sfValidatorBoolean( array('required' => false ) );
        $validator["tplogistics"] =new sfValidatorBoolean( array('required' => false ) );
        $validator["consolcargo"] =new sfValidatorBoolean( array('required' => false ) );
        $validator["infosec"] =new sfValidatorString( array('required' => true ));
        $validator["idclasificacion"] = new sfValidatorString(array('required' => true));
        $validator["modalidad"] =new sfValidatorString( array('required' => false ));
        $validator["sucursal"] =new sfValidatorString( array('required' => false ));
        $validator["observaciones"] =new sfValidatorString( array('required' => false ));
        $this->setValidators( $validator );
    }
}
?>
