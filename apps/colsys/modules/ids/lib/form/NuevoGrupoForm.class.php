<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of NuevoTransportistaForm
 *
 * @author abotero
 */
class NuevoGrupoForm extends sfForm{
    private $modo;
    public function configure(){

		sfValidatorBase::setCharset('ISO-8859-1');

		$widgets = array();
		$validator = array();


        $q = Doctrine_Query::create()
                             ->from("Ids id")
                             //->innerJoin("c.Trafico t")
                             ->where("id.ca_id=id.ca_idgrupo")
                             ->addOrderBy("id.ca_nombre");
        if( $this->modo=="agentes" ){
            $q->innerJoin("id.IdsAgente");
        }

        if( $this->modo=="prov" ){
            $q->innerJoin("id.IdsProveedor");
        }
                                    
        $widgets['idgrupo'] = new sfWidgetFormDoctrineChoice(array('model' => 'Ids', 'add_empty' => false, 'query' => $q));
      
        $this->setWidgets( $widgets );

       
        $validator["idgrupo"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El nombre es requerido'));
       
        $this->setValidators( $validator );


	}

    public function setModo( $v ){
        $this->modo = $v;
    }

    public function getModo( $v ){
        return $this->modo;
    }

}
?>
