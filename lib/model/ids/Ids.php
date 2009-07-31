<?php

class Ids extends BaseIds
{
    const FOLDER = "ids";
    public function getSucursalPrincipal( $con=null ){
        $c = new Criteria();
        $c->add( IdsSucursalPeer::CA_PRINCIPAL, true );
        $c->add( IdsSucursalPeer::CA_ID, $this->getCaId() );
        return IdsSucursalPeer::doSelectOne( $c, $con);
    }
}

sfPropelBehavior::add('Ids', array( 'traceable' ));

