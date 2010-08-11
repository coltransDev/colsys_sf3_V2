<?php

/**
 * homepage components.
 *
 * @package    colsys
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class homepageComponents  extends sfComponents
{
	/**
	* Muestra las novedades de colsys
	*	
	*/
	public function executeNovedades()
	{

        $this->novedades = Doctrine::getTable("ColNovedad")
                                     ->createQuery("n")
                                     ->where("n.ca_fcharchivar>=?", date("Y-m-d"))
                                     ->addOrderBy("n.ca_fchpublicacion DESC ")
                                     ->execute();
		
		
	}


    /*
     *
     */
    public function executeProgramas(){

        

        $rutinas = Doctrine::getTable("Rutina")
                          ->createQuery("r")
                          ->select('r.*')
                          ->leftJoin("r.AccesoPerfil ap")
                          ->leftJoin("ap.UsuarioPerfil up")
                          ->leftJoin("r.AccesoUsuario au")
                          ->where(" (up.ca_login = ? or au.ca_login = ? )", array($this->getUser()->getUserId(), $this->getUser()->getUserId()) )
                          ->addWhere(" (ap.ca_acceso >= ? or ap.ca_acceso IS NULL )", 0 )
                          ->addWhere(" (au.ca_acceso >= ? or au.ca_acceso IS NULL )", 0 )
                          ->addOrderBy("r.ca_grupo ASC")
                          ->addOrderBy("r.ca_opcion ASC")
                          ->distinct()
                          ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                          ->execute();
        $this->grupos = array();
        foreach( $rutinas as $rutina ){           
            if( !isset( $this->grupos[$rutina["ca_grupo"]] )){
                $this->grupos[$rutina["ca_grupo"]]=array();
            }
            $this->grupos[$rutina["ca_grupo"]][]=$rutina;
        }        
    }
}
