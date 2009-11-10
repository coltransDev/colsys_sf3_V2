<?php
/**
 */
class HdeskTicketTable extends Doctrine_Table
{

     /*
	* Devuelve true si el usuario tiene acceso al ticket
	* @author Andres Botero
	*/
    public static function retrieveIdTicket( $idticket , $nivel ){
       
        $user = sfContext::getInstance()->getUser();
        $q = Doctrine_Query::create()->from("HdeskTicket h");
		$q->where("h.ca_idticket = ?", $idticket);       
        $ticket = $q->fetchOne();
        /*
		* Aplica restricciones de acuerdo al nivel de acceso.
		*/
        /*
		switch( $nivel ){
			case 0:
                $q->leftJoin("h.HdeskTicketUser hu  ");
                $q->addWhere("(h.ca_login = ? OR hu.ca_login = ?)", array($user->getUserid(), $user->getUserid()) );

				break;
			case 1:
                $q->leftJoin("h.HdeskUserGroup ug " );
                $q->leftJoin("h.HdeskTicketUser hu  ");
                $q->addWhere("(h.ca_login = ? OR ug.ca_login = ? OR hu.ca_login = ? )", array($user->getUserid(), $user->getUserid(), $user->getUserid()) );
                break;
			case 2:
                $q->leftJoin("h.HdeskGroup g " );
                $q->leftJoin("h.HdeskTicketUser hu  ");
                $q->addWhere("(h.ca_login = ? OR g.ca_iddepartament = ? OR hu.ca_login = ?)", array($user->getUserid(), $user->getIddepartamento(), $user->getUserid() ) );
				break;
		}*/
                
		return $q->fetchOne();

    }
}