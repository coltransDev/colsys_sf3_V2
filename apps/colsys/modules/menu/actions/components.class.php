<?php 
/*
* 
*/
class menuComponents extends sfComponents
{
	/*
	* 
	*/	
  	public function executeSubmenubar(){				
		$module = $this->getContext()->getModuleName ();
		$action = $this->getContext()->getActionName ();
				
		$button=array();			
        //echo sfConfig::get("sf_plugins_dir");

        
		$filename=sfConfig::get("sf_app_module_dir").DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR."_submenuBar.php";
		if( file_exists($filename) ){
			include($filename);
		}elseif ($pluginDirs = glob(sfConfig::get('sf_plugins_dir').DIRECTORY_SEPARATOR."*".DIRECTORY_SEPARATOR."modules".DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR))
        {
          foreach ($pluginDirs as $dir)
          {
             $filename = $dir."_submenuBar.php";        
             if( file_exists($filename) ){
                include($filename);
            }
          }
        }

		$this->buttons = $button;		   
					
		
	} 
	
	
	
	/*
	* 
	*/	
	public function executeMenubar(){				
	
		$usuario = Doctrine::getTable("Usuario")->find( $this->getUser()->getUserId() );
			
		$this->grupos = array();
		
		if( $usuario ){
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
                      ->execute();

			foreach( $rutinas as $rutina ){
				if( !isset( $this->grupos[$rutina->getCaGrupo()] )){
					$this->grupos[$rutina->getCaGrupo()]=array();
				}
				$this->grupos[$rutina->getCaGrupo()][]=$rutina;		
			}
		}
		$this->userid = $this->getUser()->getUserId();


	} 
	
	
	
}
?>