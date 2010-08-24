<?php

/**
 * tasks actions.
 *
 * @package    symfony
 * @subpackage tasks
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tasksActions extends sfActions
{
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        
    }


     /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executeDatosPanelConsulta( ){
        $this->listasTareas = Doctrine::getTable("NotListaTareas")
                         ->createQuery("l")
                         ->execute();
        $this->user = $this->getUser();
    }


    /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executeDatosPanelTareas(  $request ){
        $user = $this->getUser();
        $tareas = Doctrine::getTable("NotTarea")
                         ->createQuery("t")
                         ->select("t.*, l.ca_nombre")
                         ->innerJoin("t.NotListaTareas l")
                         ->leftJoin("t.NotTareaAsignacion a")
                         ->addWhere("a.ca_login=?", $user->getUserId())
                         ->addWhere("t.ca_fchterminada IS NULL")
                         ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                         ->execute();

        foreach( $tareas as $key=>$tarea ){
            $tareas[$key]["t_ca_texto"]=utf8_encode($tareas[$key]["t_ca_texto"]);
            $tareas[$key]["t_ca_titulo"]=utf8_encode($tareas[$key]["t_ca_titulo"]);
            $tareas[$key]["l_ca_nombre"]=utf8_encode($tareas[$key]["l_ca_nombre"]);
        }
        $this->responseArray = array("success"=>true, "root"=>$tareas);

        $this->setTemplate("responseTemplate");
    }
    
    /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executeDatosPanelTareaAsignaciones( $request ){

        $idtarea = $request->getParameter("idtarea");
        $this->forward404Unless( $idtarea );
        $asignaciones = Doctrine::getTable("Usuario")
                                ->createQuery("u")
                                ->select("u.ca_login, u.ca_nombre, u.ca_idsucursal")
                                ->innerJoin("u.NotTareaAsignacion a")
                                ->where("a.ca_idtarea = ?", $idtarea)
                                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                ->addOrderBy("u.ca_nombre ASC")
                                ->execute();
        $i=0;
        foreach( $asignaciones as $key=>$asignacion ){
            $asignaciones[$key]["u_ca_nombre"]=utf8_encode($asignaciones[$key]["u_ca_nombre"]);
            $asignaciones[$key]["orden"]=$i++;
            
        }

        $asignaciones[] = array("u_ca_nombre"=>"", "ca_idsucursal"=>"", "ca_login"=>"", "orden"=>"ZZZZZ");
        $this->responseArray = array("success"=>true, "root"=>$asignaciones);
        $this->setTemplate("responseTemplate");
    }

}
