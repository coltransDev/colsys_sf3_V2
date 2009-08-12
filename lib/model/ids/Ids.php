<?php

class Ids extends BaseIds
{
    const FOLDER = "ids";
    
    /*
     * Determina el ID a partir de la secuencia
     */
    public function setId(){
        $con = Propel::getConnection(IdsPeer::DATABASE_NAME);
        $stmt = $con->prepare("SELECT nextval('ids.tb_ids_id') as id");
        $stmt->execute();
        $row = $stmt->fetch();
        $this->setCaId( $row['id'] );

    }

    /*
     * 
     */
    public function getSucursalPrincipal( $con=null ){
        $c = new Criteria();
        $c->add( IdsSucursalPeer::CA_PRINCIPAL, true );
        $c->add( IdsSucursalPeer::CA_ID, $this->getCaId() );
        return IdsSucursalPeer::doSelectOne( $c, $con);
    }
}

sfPropelBehavior::add('Ids', array( 'traceable' ));

